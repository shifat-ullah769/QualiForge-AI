<?php

namespace App\Http\Controllers\ProductionSupervisor;

use App\Http\Controllers\Controller;
use App\Models\CorrectiveAction;
use App\Models\CorrectiveActionEvidence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\File;

class CorrectiveActionEvidenceController extends Controller
{
    private function authorizeAction(Request $request, CorrectiveAction $action): void
    {
        $user = $request->user();

        abort_unless(
            $action->company_id === $user->company_id &&
                $action->recorded_by === $user->id,
            404
        );

        $authorized = $user->assignments()
            ->where('company_id', $user->company_id)
            ->where('factory_id', $action->factory_id)
            ->where('status', 'active')
            ->get()
            ->contains(function ($assignment) use ($action) {
                if (
                    $assignment->production_line_id !== null &&
                    (int) $assignment->production_line_id !==
                    (int) $action->production_line_id
                ) {
                    return false;
                }

                if (
                    $assignment->machine_id !== null &&
                    (int) $assignment->machine_id !==
                    (int) $action->machine_id
                ) {
                    return false;
                }

                return true;
            });

        abort_unless($authorized, 403);
    }

    public function store(Request $request, CorrectiveAction $correctiveAction)
    {
        $this->authorizeAction($request, $correctiveAction);

        $validated = $request->validate([
            'evidence' => [
                'required',
                File::types(['jpg', 'jpeg', 'png', 'webp', 'pdf'])
                    ->max('10mb'),
            ],
        ]);

        $file = $validated['evidence'];

        $extension = $file->extension();
        $filename = Str::uuid() . '.' . $extension;

        $path = $file->storeAs(
            'corrective-action-evidence/' . $correctiveAction->id,
            $filename,
            'local'
        );

        abort_unless($path, 500, 'Evidence upload failed.');

        try {
            $correctiveAction->evidences()->create([
                'company_id' => $request->user()->company_id,
                'original_name' => $file->getClientOriginalName(),
                'file_path' => $path,
                'mime_type' => $file->getMimeType(),
                'file_size' => $file->getSize(),
                'uploaded_by' => $request->user()->id,
            ]);
        } catch (\Throwable $exception) {
            Storage::disk('local')->delete($path);
            throw $exception;
        }

        return redirect()
            ->route('production-supervisor.corrective-actions.index')
            ->with('success', 'Execution evidence uploaded successfully.');
    }

    public function download(Request $request, CorrectiveActionEvidence $evidence)
    {
        $action = $evidence->correctiveAction;

        abort_unless(
            $action &&
                $evidence->company_id === $request->user()->company_id &&
                $evidence->uploaded_by === $request->user()->id,
            404
        );

        $this->authorizeAction($request, $action);

        abort_unless(
            Storage::disk('local')->exists($evidence->file_path),
            404
        );

        $filePath = Storage::disk('local')->path($evidence->file_path);

        return response()->download(
            $filePath,
            $evidence->original_name,
            [
                'Content-Type' => $evidence->mime_type,
                'X-Content-Type-Options' => 'nosniff',
            ]
        );
    }

    public function destroy(Request $request, CorrectiveActionEvidence $evidence)
    {
        $action = $evidence->correctiveAction;

        abort_unless(
            $action &&
                $evidence->company_id === $request->user()->company_id &&
                $evidence->uploaded_by === $request->user()->id,
            404
        );

        $this->authorizeAction($request, $action);

        $disk = Storage::disk('local');

        if ($disk->exists($evidence->file_path)) {
            abort_unless(
                $disk->delete($evidence->file_path),
                500,
                'Evidence file could not be deleted.'
            );
        }

        $evidence->delete();

        return redirect()
            ->route('production-supervisor.corrective-actions.index')
            ->with('success', 'Execution evidence removed successfully.');
    }
}
