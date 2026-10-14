<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = request()->user();

        if ($user->hasRole(\App\UserRole::SYSTEM_ADMINISTRATOR)) {
            $companies = \App\Models\Company::orderBy('name')->get();
        } else {
            $companies = \App\Models\Company::where('id', $user->company_id)->get();
        }

        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50', 'unique:companies,code'],
            'industry' => ['nullable', 'string', 'max:255'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'contact_phone' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string'],
            'city' => ['nullable', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
        ]);

        \App\Models\Company::create($validated);

        return redirect()
            ->route('companies.index')
            ->with('success', 'Company created successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show(\App\Models\Company $company)
    {
        $user = request()->user();

        if (
            $user->hasRole(\App\UserRole::COMPANY_ADMINISTRATOR) &&
            $user->company_id !== $company->id
        ) {
            abort(403);
        }

        $company->load('users');

        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(\App\Models\Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, \App\Models\Company $company)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => [
                'required',
                'string',
                'max:50',
                \Illuminate\Validation\Rule::unique('companies', 'code')
                    ->ignore($company->id),
            ],
            'industry' => ['nullable', 'string', 'max:255'],
            'contact_email' => ['nullable', 'email', 'max:255'],
            'contact_phone' => ['nullable', 'string', 'max:50'],
            'address' => ['nullable', 'string'],
            'city' => ['nullable', 'string', 'max:255'],
            'country' => ['required', 'string', 'max:255'],
        ]);

        $company->update($validated);

        return redirect()
            ->route('companies.index')
            ->with('success', 'Company updated successfully.');
    }


    public function toggleStatus(\App\Models\Company $company)
    {
        $company->update([
            'is_active' => !$company->is_active,
        ]);

        return redirect()
            ->route('companies.index')
            ->with('success', 'Company status updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
