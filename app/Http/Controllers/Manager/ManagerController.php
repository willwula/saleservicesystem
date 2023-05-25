<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

/**
 * @GROUP manager
 *
 * manger_CRUD
 *
 * @subgroup 帳號管理
 * @description manager_CRUD
*/
class ManagerController extends Controller
{
    public function store(Request $request)
    {
        $this->authorize('create', [Manager::class]);
        $manager = Auth::guard('manager')->user();
        $validated = $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'email|required|max:255',
            'password' => 'required|alpha_num:ascii|min:6|max:12'

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
