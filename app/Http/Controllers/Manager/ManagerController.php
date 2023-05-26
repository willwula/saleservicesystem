<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Resources\BikeBrandCollection;
use App\Http\Resources\ManagerCollection;
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
 * @description 管理員可對所有對象Creat,Read,Update,Delete，
 *              服務中心可對旗下經銷商Read, Update,
 *              經銷商可對自己Create, Update,
 *              自己可對自己Update.
*/
class ManagerController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', [Manager::class]);
        $managers = Manager::orderBy('order', 'desc');

        if ($request->boolean('paginate') === true) {
            return ManagerCollection::make($managers->paginate('20'));
        }

        return ManagerCollection::make($managers->get());
    }

    public function store(Request $request)
    {
        $this->authorize('create', [Manager::class]);
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

        return ManagerCollection::make($managers->get());

//        return response([
//            'data' => $manager,
//            'message' => "註冊成功"
//        ], 201);
    }
}
