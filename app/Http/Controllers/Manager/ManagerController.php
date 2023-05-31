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
     * @urlParam  paginate 如果是 true 提供每 20 筆分頁
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', [Manager::class]);

        $user = Auth::user();
        $managers = Manager::orderBy('id', 'desc');

        if ($user->isServiceCenter()) {
            $managers->where('service_center_id', $user->getKey());
        }

        if ($request->boolean('paginate')) {
            return ManagerCollection::make($managers->paginate(20));
        }

        return ManagerCollection::make($managers->get());
    }
    /**
     * 查看單一 manager 內容
     *
     * @urlParam id manager_id
     */
    public function show(Manager $manager)  //$id =  url id
    {
        $this->authorize('view', [Manager::class, $manager]);

        if ($manager->isDealer()) {
            $manager->load('serviceCenter');
        }

        return ManagerResource::make($manager);
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
            'role' => 'required|integer',
            'status' => 'required|integer',
            'name' => 'required|string|max:255',
            'email' => 'email|required|max:255',
            'password' => 'required|alpha_num:ascii|min:6|max:12|confirmed',
            'service_center_id' => 'required_if:role,2|integer',
            'address' => 'nullable|max:255',
            'phone' => 'nullable|max:255',
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

        if ($manager->isDealer()) {
            $manager->load('serviceCenter');
        }

        return ManagerResource::make($manager);

    }

    /**
     * 更新一筆 manager 內容
     *
     * @urlParam id
     */
    public function update(Request $request,Manager $manager)
    {
        $this->authorize('update', $manager);
        $validated = $request->validate([
            'role' => 'required|integer',
            'name' => 'required|string|max:255',
            'email' => [
                'nullable',
                Rule::unique('managers')->ignore($manager),
            ],
            'password' => 'nullable|alpha_num:ascii|min:6|max:12|confirmed'
        ]);

        if ($request->input('password')) {
            array_merge(
                $validated, ['password' => Hash::make($validated['password'])]
            );
        }
        $manager->update($validated);

        if ($manager->isDealer()) {
            $manager->load('serviceCenter');
        }

        return ManagerResource::make($manager);
    }

    /**
     * 刪除一個 manager
     *
     * @urlParam id
     */
    public function destroy(Manager $manager)
    {
        $this->authorize('delete', [Manager::class, $manager]);

        $manager->delete();

        return '刪除成功';
    }
}
