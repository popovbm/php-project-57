<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewPassword;

class PasswordController extends Controller
{
    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ], [
            'password.confirmed' => 'Поля: "Пароль" и "Подтверждения пароля" не совпадают',
            'password.min' => 'Пароль не должен быть менее 8 символов',
            'password.required' => 'Поле: "Новый пароль" не должно быть пустым',
            'current_password.required' => 'Поле: "Текущий пароль" не должно быть пустым',
            'current_password.current_password' => 'Неверный пароль',
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        session()->flash('message', 'Password successfully changed');

        // Mail::to($request->user())->send(new NewPassword($validated['password']));

        return back()->with('status', 'password-updated');
    }
}
