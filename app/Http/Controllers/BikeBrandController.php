<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use App\Models\BikeBrand;
use Illuminate\Http\Request;

/**
 * @group bike_columns
 *
 * bike_brands CRUD
 *
 * @subgroup bike_brands
 * @subgroupDescription 僅管理員能 Create, Update, Delete，其餘人員皆僅能 Read
 * @authenticated
 */

class BikeBrandController extends Controller
{

    /**
     * 取得 bike_brands 清單
     *
     * 廠牌列表，可用於下拉式選單或廠牌清單
     * @urlParam  paginate 如果是 1 提供每 20 筆分頁 Example: ?paginate=1
     *
     * @return mixed
     */
    public function index(Request $request)
    {
//        $this->authorize('viewAny', [BikeBrandModel::class]); //policy
        $bikeBrands = BikeBrand::orderBy('order');

        // 如果前端想要分頁顯示
        $paginate = (int) $request->paginate;
        if ($paginate === 1 ) {
            return $bikeBrands->paginate('20');
        }

        return $bikeBrands->get();
    }

    /**
     * 查看單一 bike_brand 內容
     *
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
//        $this->authorize('view', [BikeBrand::class]); //policy
        $bikeBrand = BikeBrand::find($id);
        return $bikeBrand;
    }

    /**
     * 新增 bike_brand
     *
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
//        $this->authorize('create', [BikeBrand::class]); //policy

        $validated = $request->validate([
            'name' => 'string|required|max:255',
            'description' => 'string|nullable|max:255',
        ]);

        $bikeBrand =  BikeBrand::create($validated);

        return $bikeBrand;
    }

    /**
     * 更新一筆 bike_brand 內容
     *
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
//        $this->authorize('update', [BikeBrand::class]); //policy
        $validated = $request->validate([
            'name' => 'string|required|max:255',
            'description' => 'string|nullable|max:255',
        ]);

        BikeBrand::find($id)->update($validated);

        return BikeBrand::find($id);

    }

    /**
     * 刪除一個 bike_brand
     *
     * @param $id
     * @return string
     */
    public function destroy($id)
    {
//        $this->authorize('delete', [BikeBrand::class]); //policy
        $bikeBrand = BikeBrand::find($id);

        $bikeBrand->delete();

        return 'successful';
    }

}
