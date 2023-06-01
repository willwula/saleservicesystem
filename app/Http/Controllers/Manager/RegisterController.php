<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Resources\ManagerResource;
use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * Manager Register
 * 經銷商註冊
 *
 * @subgroup 經銷商註冊
 */

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validated = $this->validate($request, [
            'role' => 'required|integer',
            'status' => 'required|integer',
            'name' => 'required|string|max:255',
            'email' => 'email|required|max:255',
            'password' => 'required|alpha_num:ascii|min:6|max:12|confirmed',
            'phone' => 'nullable|string|max:14',
            'address' => 'nullable|string|max:255',
            'service_center_id' => 'required_if:role,2|integer',
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

        return ManagerResource::make($manager->load('serviceCenter'));

    }
}
