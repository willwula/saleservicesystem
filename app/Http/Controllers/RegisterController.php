<?php

namespace App\Http\Controllers;

use App\Mail\RegisterSuccessMail;
use App\Models\Manager;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Auth\Events\Registered;

/**
 * Manager Register
 *
 */

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validated = $this->validate($request, [
            'name' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'password' => 'required|alpha_num:ascii|min:6|max:255|confirmed'
        ]);

        abort_if(
            Manager::where('email', $request->input('email'))->first(),
            Response::HTTP_BAD_REQUEST,
            __('auth.duplicate email')
        );

            $manager = Manager::create(
                array_merge(
                    $validated, ['password' => Hash::make($validated['password'])]
                )
            );

            Auth::login($manager);

        return response([
            'data' => $manager,
            'message' => "註冊成功"
        ], 201);
    }
}
