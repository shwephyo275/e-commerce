<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileApi extends Controller
{
    public function changePassword()
    {
        $current_password = request()->old_password;
        $new_password = request()->new_password;

        $hashedPassword =   User::where('id', auth()->id())->first()->password;
        $checkPassword =  Hash::check($current_password, $hashedPassword);
        if (!$checkPassword) {
            return 'wrong_password';
        }

        User::where('id', auth()->id())->update([
            'password' => Hash::make($new_password)
        ]);
        return 'success';
    }
}
