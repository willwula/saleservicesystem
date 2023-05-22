<?php

namespace App\Http\Controllers;

use App\Http\Resources\BikeBrandCollection;
use App\Http\Resources\BikeBrandResource;
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
     */
    public function index(Request $request)
    {
//        $this->authorize('viewAny', [BikeBrandModel::class]); //policy
        $bikeBrands = BikeBrand::orderBy('order');

        // 如果前端想要分頁顯示
        if ($request->boolean('paginate') === true) {
            return BikeBrandCollection::make($bikeBrands->paginate('20'));
        }

        return BikeBrandCollection::make($bikeBrands->get());
    }

    /**
     * 查看單一 bike_brand 內容
     *
     * @urlParam id 廠牌id Example: 1
     */
    public function show(BikeBrand $bikeBrand)
    {
//        $this->authorize('view', [BikeBrand::class]); //policy

        return BikeBrandResource::make($bikeBrand);
    }

    /**
     * 新增 bike_brand
     *
     * @bodyparam name string:255 廠牌名稱 Example: Giant
     * @bodyparam description string:255 廠牌描述 Example: 臺灣創立的世界級自行車製造商
     */
    public function store(Request $request)
    {
//        $this->authorize('create', [BikeBrand::class]); //policy

        $validated = $request->validate([
            'name' => 'string|required|max:255',
            'description' => 'string|nullable|max:255',
        ]);

        return BikeBrandResource::make(BikeBrand::create($validated));
    }

    /**
     * 更新一筆 bike_brand 內容
     *
     * @urlParam id 廠牌id Example: 1
     * @bodyparam name string:255 廠牌名稱 Example: Giant
     * @bodyparam description string:255 廠牌描述 Example: 臺灣創立的世界級自行車製造商
     */
    public function update(Request $request, BikeBrand $bikeBrand)
    {
//        $this->authorize('update', [BikeBrand::class]); //policy
        $validated = $request->validate([
            'name' => 'string|required|max:255',
            'description' => 'string|nullable|max:255',
        ]);

        $bikeBrand->update($validated);

        return BikeBrandResource::make($bikeBrand);
    }

    /**
     * 刪除一個 bike_brand
     *
     * @urlParam id 廠牌id Example: 1
     */
    public function destroy(BikeBrand $bikeBrand)
    {
//        $this->authorize('delete', [BikeBrand::class]); //policy

        $bikeBrand->delete();

        return 'successful';
    }

}
