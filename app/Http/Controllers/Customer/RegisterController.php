<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

/**
 * @group CUSTOMER
 * CUSTOMER Register
 * 客戶註冊
 *
 * @subgroup 客戶註冊
 */

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validated = $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'email|required|max:255',
            'password' => 'required|alpha_num:ascii|min:6|max:12|confirmed',
        ]);
        abort_if(
            Customer::where('email', $request->input('email'))->first(),
            Response::HTTP_BAD_REQUEST,
            __('auth.duplicate email')
        );

        $customer = Customer::create(
            array_merge(
                $validated, ['password' => Hash::make($validated['password'])]
            )
        );

        return CustomerResource::make($customer);

    }
}
