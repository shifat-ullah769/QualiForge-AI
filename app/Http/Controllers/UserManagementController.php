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
            $users = User::all();
        } else {
            $users = User::where('company_id', $user->company_id)->get();
        }

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $companies = \App\Models\Company::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('users.create', compact('companies'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],

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
                Rule::in(
                    array_column(UserRole::cases(), 'value')
                ),
            ],

            'company_id' => [
                'nullable',
                'integer',
                'exists:companies,id',
            ],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'company_id' => $request->company_id,
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User created successfully.');
    }
}
