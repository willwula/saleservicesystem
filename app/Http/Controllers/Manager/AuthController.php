<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

/**
 * Manager Login
 *
 * @subgroup 後台管理者登入登出
 * @bodyparam password 密碼為kkkkkk
 */

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credential = $this->validate($request, [
            'email' => 'email|required|max:255',
            'password' => 'required|alpha_num:ascii|min:6|max:12'
        ]);

        $token = Auth::guard('manager')->attempt($credential);
        abort_if( !$token,Response::HTTP_BAD_REQUEST, "帳號密碼錯誤");

        return response(['data' => $token]);
    }

    public function logout()
    {
        Auth::logout();
        return response()->noContent();
    }
}
