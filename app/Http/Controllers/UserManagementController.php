<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rule;

class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if ($user->hasRole(UserRole::SYSTEM_ADMINISTRATOR)) {
            $users = User::whereIn('role', [
                UserRole::SYSTEM_ADMINISTRATOR->value,
                UserRole::COMPANY_ADMINISTRATOR->value,
            ])->get();
        } else {
            $users = User::where('company_id', $user->company_id)->get();
        }

        return view('users.index', compact('users'));
    }


    public function create()
    {
        $user = request()->user();

        if ($user->hasRole(UserRole::SYSTEM_ADMINISTRATOR)) {
            $companies = \App\Models\Company::where('is_active', true)
                ->orderBy('name')
                ->get();
        } else {
            $companies = \App\Models\Company::where('id', $user->company_id)
                ->where('is_active', true)
                ->get();
        }

        return view('users.create', compact('companies'));
    }


    public function store(Request $request)
    {
        $currentUser = $request->user();

        $allowedRoles = $currentUser->hasRole(UserRole::SYSTEM_ADMINISTRATOR)
            ? [
                UserRole::SYSTEM_ADMINISTRATOR->value,
                UserRole::COMPANY_ADMINISTRATOR->value,
            ]
            : [
                UserRole::COMPANY_ADMINISTRATOR->value,
                UserRole::QUALITY_MANAGER->value,
                UserRole::QUALITY_ENGINEER->value,
                UserRole::PRODUCTION_SUPERVISOR->value,
            ];

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:' . User::class,
            ],

            'password' => [
                'required',
                'confirmed',
                Rules\Password::defaults(),
            ],

            'role' => [
                'required',
                'string',
                Rule::in($allowedRoles),
            ],

            'company_id' => [
                'nullable',
                'integer',
                'exists:companies,id',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Company Administrator restrictions
        |--------------------------------------------------------------------------
        */

        if ($currentUser->hasRole(UserRole::COMPANY_ADMINISTRATOR)) {

            if ((int) $validated['company_id'] !== (int) $currentUser->company_id) {
                abort(403);
            }

            $validated['company_id'] = $currentUser->company_id;
        }

        /*
        |--------------------------------------------------------------------------
        | System Administrator must not belong to a company
        |--------------------------------------------------------------------------
        */

        if ($validated['role'] === UserRole::SYSTEM_ADMINISTRATOR->value) {
            $validated['company_id'] = null;
        }

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
            'company_id' => $validated['company_id'] ?? null,
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User created successfully.');
    }


    public function edit(User $user)
    {
        $currentUser = request()->user();

        /*
        |--------------------------------------------------------------------------
        | System Administrator
        |--------------------------------------------------------------------------
        */

        if ($currentUser->hasRole(UserRole::SYSTEM_ADMINISTRATOR)) {

            if (!in_array($user->role?->value, [
                UserRole::SYSTEM_ADMINISTRATOR->value,
                UserRole::COMPANY_ADMINISTRATOR->value,
            ], true)) {
                abort(403);
            }

            $companies = \App\Models\Company::where('is_active', true)
                ->orderBy('name')
                ->get();
        }

        /*
        |--------------------------------------------------------------------------
        | Company Administrator
        |--------------------------------------------------------------------------
        */ else {

            if ((int) $user->company_id !== (int) $currentUser->company_id) {
                abort(403);
            }

            if ($user->role?->value === UserRole::SYSTEM_ADMINISTRATOR->value) {
                abort(403);
            }

            $companies = \App\Models\Company::where('id', $currentUser->company_id)
                ->where('is_active', true)
                ->get();
        }

        return view('users.edit', compact('user', 'companies'));
    }


    public function update(Request $request, User $user)
    {
        $currentUser = $request->user();

        /*
        |--------------------------------------------------------------------------
        | Determine permissions and allowed roles
        |--------------------------------------------------------------------------
        */

        if ($currentUser->hasRole(UserRole::SYSTEM_ADMINISTRATOR)) {

            if (!in_array($user->role?->value, [
                UserRole::SYSTEM_ADMINISTRATOR->value,
                UserRole::COMPANY_ADMINISTRATOR->value,
            ], true)) {
                abort(403);
            }

            $allowedRoles = [
                UserRole::SYSTEM_ADMINISTRATOR->value,
                UserRole::COMPANY_ADMINISTRATOR->value,
            ];
        } else {

            if ((int) $user->company_id !== (int) $currentUser->company_id) {
                abort(403);
            }

            if ($user->role?->value === UserRole::SYSTEM_ADMINISTRATOR->value) {
                abort(403);
            }

            $allowedRoles = [
                UserRole::COMPANY_ADMINISTRATOR->value,
                UserRole::QUALITY_MANAGER->value,
                UserRole::QUALITY_ENGINEER->value,
                UserRole::PRODUCTION_SUPERVISOR->value,
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:' . User::class . ',email,' . $user->id,
            ],

            'role' => [
                'required',
                'string',
                Rule::in($allowedRoles),
            ],

            'company_id' => [
                'nullable',
                'integer',
                'exists:companies,id',
            ],
        ]);

        /*
        |--------------------------------------------------------------------------
        | System Administrator must not belong to a company
        |--------------------------------------------------------------------------
        */

        if ($validated['role'] === UserRole::SYSTEM_ADMINISTRATOR->value) {
            $validated['company_id'] = null;
        }

        /*
        |--------------------------------------------------------------------------
        | Company Administrator must stay inside own company
        |--------------------------------------------------------------------------
        */

        if ($currentUser->hasRole(UserRole::COMPANY_ADMINISTRATOR)) {

            if ((int) $validated['company_id'] !== (int) $currentUser->company_id) {
                abort(403);
            }

            $validated['company_id'] = $currentUser->company_id;
        }

        $user->update($validated);

        return redirect()
            ->route('users.index')
            ->with('success', 'User updated successfully.');
    }


    public function toggleStatus(User $user)
    {
        $currentUser = request()->user();

        /*
        |--------------------------------------------------------------------------
        | System Administrator rules
        |--------------------------------------------------------------------------
        */

        if ($currentUser->hasRole(UserRole::SYSTEM_ADMINISTRATOR)) {

            // System Admin can only manage System Admins
            // and Company Administrators.
            if (!in_array($user->role?->value, [
                UserRole::SYSTEM_ADMINISTRATOR->value,
                UserRole::COMPANY_ADMINISTRATOR->value,
            ], true)) {
                abort(403);
            }

            /*
            |--------------------------------------------------------------------------
            | A System Administrator cannot deactivate
            | another System Administrator.
            |--------------------------------------------------------------------------
            */

            if (
                $user->role?->value === UserRole::SYSTEM_ADMINISTRATOR->value
                && $user->id !== $currentUser->id
            ) {
                abort(403);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Company Administrator rules
        |--------------------------------------------------------------------------
        */ elseif ($currentUser->hasRole(UserRole::COMPANY_ADMINISTRATOR)) {

            if ((int) $user->company_id !== (int) $currentUser->company_id) {
                abort(403);
            }
        }

        /*
        |--------------------------------------------------------------------------
        | Other roles cannot use this management action
        |--------------------------------------------------------------------------
        */ else {
            abort(403);
        }

        /*
        |--------------------------------------------------------------------------
        | Toggle account status
        |--------------------------------------------------------------------------
        */

        if ($user->is_active) {

            $user->update([
                'is_active' => false,
                'deactivated_at' => now(),
            ]);
        } else {

            $user->update([
                'is_active' => true,
                'deactivated_at' => null,
            ]);
        }

        return redirect()
            ->route('users.index')
            ->with('success', 'User status updated successfully.');
    }

    public function destroy(User $user)
    {
        $currentUser = request()->user();

        /*
    |--------------------------------------------------------------------------
    | System Administrator rules
    |--------------------------------------------------------------------------
    */

        if ($currentUser->hasRole(UserRole::SYSTEM_ADMINISTRATOR)) {

            // System Admin can delete only Company Administrators.
            if ($user->role?->value !== UserRole::COMPANY_ADMINISTRATOR->value) {
                abort(403);
            }
        }

        /*
    |--------------------------------------------------------------------------
    | Company Administrator rules
    |--------------------------------------------------------------------------
    */ elseif ($currentUser->hasRole(UserRole::COMPANY_ADMINISTRATOR)) {

            // Company Admin can delete users only from their own company.
            if ((int) $user->company_id !== (int) $currentUser->company_id) {
                abort(403);
            }
        }

        /*
    |--------------------------------------------------------------------------
    | Other roles cannot delete users
    |--------------------------------------------------------------------------
    */ else {
            abort(403);
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User deleted successfully.');
    }
}
