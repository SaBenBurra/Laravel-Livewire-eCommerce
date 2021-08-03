<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\Rules\Password;

class UserController extends Controller
{
    public function updateUserData(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
            'name' => 'required|string|max:255'
        ]);

        auth()->user()->update($request->all());

        return back();
    }

    public function updateUserPassword(Request $request)
    {
        $request->validate([
            'oldPassword' => [function ($attribute, $value, $fail) {
                if (!Hash::check($value, auth()->user()->password))
                    $fail('Old password is not valid');
            }],
            'newPassword' => ['required', 'string', new Password, 'confirmed']
        ]);

        auth()->user()->password = Hash::make($request->newPassword);
        auth()->user()->save();

        return back();
    }
}
