<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function showRoleSelectionForm()
    {
        return view('auth.register-role');
    }

    public function processRoleSelection(Request $request)
    {
        $request->validate([
            'role' => 'required|in:tenant,landlord'
        ]);

        return redirect()->route('register.form', ['role' => $request->role]);
    }

    public function showRegistrationForm($role = null)
{
    // Если роль не передана, перенаправляем на выбор роли
    if (!$role || !in_array($role, ['tenant', 'landlord'])) {
        return redirect()->route('register.role');
    }

    return view('auth.register', compact('role'));
}

    public function register(Request $request, $role)
    {
        // Общие правила валидации
        $rules = [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'legal_name' => 'required|string|max:255',
            'with_vat' => 'required|boolean',
            'inn' => 'required|string|max:12',
            'kpp' => 'nullable|string|max:9',
            'ogrn' => 'required|string|max:15',
            'okpo' => 'nullable|string|max:10',
            'legal_address' => 'required|string|max:500',
            'actual_address_same' => 'required|boolean',
            'bank_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:20',


            'bik' => 'required|string|max:9',
            'correspondent_account' => 'nullable|string|max:20',
            'director' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'manager' => 'nullable|string|max:255',
        ];

        // Если фактический адрес отличается
        if (!$request->actual_address_same) {
            $rules['actual_address'] = 'required|string|max:500';
        }

        $validated = $request->validate($rules);

        // Создаем пользователя
        $user = User::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $role,
            'name' => $validated['legal_name'], // Используем юридическое название как имя
        ]);

        // Создаем профиль
        $profileData = [
            'legal_name' => $validated['legal_name'],
            'with_vat' => $validated['with_vat'],
            'inn' => $validated['inn'],
            'kpp' => $validated['kpp'] ?? null,
            'ogrn' => $validated['ogrn'],
            'okpo' => $validated['okpo'] ?? null,
            'legal_address' => $validated['legal_address'],
            'actual_address' => $validated['actual_address_same']
                ? $validated['legal_address']
                : ($validated['actual_address'] ?? ''),
            'actual_address_same' => $validated['actual_address_same'],
            'bank_name' => $validated['bank_name'],
            'account_number' => $validated['account_number'],
            'bik' => $validated['bik'],
            'correspondent_account' => $validated['correspondent_account'] ?? null,
            'director' => $validated['director'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'manager' => $validated['manager'] ?? null,
        ];

        $user->profile()->create($profileData);

        event(new Registered($user));

        Auth::login($user);

        return redirect($this->redirectPath());
    }

    protected function redirectPath()
    {
        return match(auth()->user()->role) {
            'tenant' => route('tenant.dashboard'),
            'landlord' => route('landlord.dashboard'),
            default => '/home'
        };
    }
}
