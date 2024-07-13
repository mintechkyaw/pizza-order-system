<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class UpdateUserPassword implements UpdatesUserPasswords
{
    use PasswordValidationRules;

    /**
     * Validate and update the user's password.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input)
    {
        $validator = Validator::make($input, [
            'current_password' => ['required', 'string', 'current_password:web'],
            'new_password' => $this->passwordRules(),
            'new_password_confirmation' => ['required', 'same:new_password'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user->forceFill([
            'password' => Hash::make($input['new_password']),
        ])->save();

        return null; // No validation errors
    }
}
