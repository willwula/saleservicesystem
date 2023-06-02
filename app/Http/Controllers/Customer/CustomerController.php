<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * 取得customer清單
     * @urlParam  paginate 如果是 true 提供每 20 筆分頁
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', [Customer::class, $request->user()]);

        $user = Auth::user();
        $customers = Customer::orderBy('id', 'desc');

//        if ($user->isServiceCenter()) {
//            $managers->where('service_center_id', $user->getKey());
//        }

        //經銷商帳號管理列表中，待審經銷商帳號，帳號狀態與關鍵字搜尋 ex.啟用和停用
//        if ($request->has('status')) {
//            $status = $request->input('status');
//            $managers->where('status', $status);
//        }

        //關鍵字搜尋
        if ($request->has('keyword')) {
            $keyword = $request->input('keyword');
            $managers->where(function ($query) use ($keyword) {
                $query->where('name', 'LIKE', "%$keyword%")
                    ->orWhere('email', 'LIKE', "%$keyword%");
            });
        }

        if ($request->boolean('paginate')) {
            return CustomerCollection::make($customers->paginate(20));
        }

        return CustomerCollection::make($customers->get());
    }
}
