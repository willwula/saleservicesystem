<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Resources\ManagerCollection;
use App\Http\Resources\ManagerResource;
use App\Mail\RegisterSuccessMail;
use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

        return ManagerResource::make($manager);

    }
}
