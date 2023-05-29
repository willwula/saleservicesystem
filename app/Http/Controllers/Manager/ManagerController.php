<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Resources\ManagerCollection;
use App\Http\Resources\ManagerResource;
use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

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
    /**
     * 取得manager清單
     * @urlParam  paginate 如果是 1 提供每 3 筆分頁
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', [Manager::class]);
        $managers = Manager::orderBy('id', 'desc');

        if ($request->boolean('paginate') === true) {
            return ManagerCollection::make($managers->paginate('3'));
        }

        return ManagerCollection::make($managers->get());
    }
    /**
     * 查看單一 manager 內容
     *
     * @urlParam id manager_id
     */
    public function show($id)  //$id =  url id
    {
        $managerModel = Manager::findOrFail($id);
//        dd($managerModel);
        $this->authorize('view', [Manager::class, $managerModel]);

        return ManagerResource::make($managerModel);
    }
    /**
     * 新增 manager
     *
     * @bodyparam name string:255
     * @bodyparam email string:255
     *
     */
    public function store(Request $request)
    {
        $this->authorize('create', [Manager::class]);
        $validated = $this->validate($request, [
            'role' => 'required|Integer',
            'status' => 'required|Integer',
            'name' => 'required|string|max:255',
            'email' => 'email|required|max:255',
            'password' => 'required|alpha_num:ascii|min:6|max:12|confirmed',
            'serviceCenter_id' => 'Integer',
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

    /**
     * 更新一筆 manager 內容
     *
     * @urlParam id
     */
    public function update(Request $request,Manager $manager)
    {
//        dd($manager->id);
        $this->authorize('update', $manager);
        $validated = $request->validate([
            'role' => 'readonly|tinyInteger',
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                Rule::unique('managers')->ignore($manager),
            ],
            'password' => 'required|alpha_num:ascii|min:6|max:12|confirmed'
        ]);

        $manager->update(
            array_merge(
                $validated, ['password' => Hash::make($validated['password'])]
            )
        );

        return ManagerResource::make($manager);
    }

    /**
     * 刪除一個 manager
     *
     * @urlParam id
     */
    public function destroy($id)
    {
        $managerModel = Manager::find($id);

        abort_if(! $managerModel,Response::HTTP_BAD_REQUEST,__('auth.not found'));

        $this->authorize('delete', [Manager::class, $managerModel]);

        $managerModel->delete();

        return '刪除成功';
    }
}
