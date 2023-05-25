<?php

namespace App\Http\Controllers;

use App\Http\Resources\BikeModelCollection;
use App\Http\Resources\BikeModelResource;
use App\Models\BikeBrand;
use App\Models\BikeModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


/**
 * @group bike_columns
 *
 * bike_models CRUD
 *
 * @subgroup bike_models
 * @subgroupDescription 僅管理員能 Create, Update, Delete，其餘人員皆僅能 Read
 * @authenticated
 */
class BikeModelController extends Controller
{
    /**
     * 取得 bike_models 清單
     *
     * 車款列表，可用於下拉式選單或廠牌清單
     * 需提供所屬廠牌id
     * @urlParam  bikeBrand 所屬廠牌的id Example: ?bikeBrand=1
     * @urlParam  paginate 如果是 1 提供每 20 筆分頁 Example: ?paginate=1
     *
     */
    public function index(Request $request)
    {
//        $this->authorize('viewAny', [BikeModel::class]); //policy
        $bikeBrandId = $request->input('bikeBrand');

        abort_if(
            $bikeBrandId === null || BikeBrand::find($bikeBrandId) === null,
            Response::HTTP_BAD_REQUEST,
            __('請先選擇廠牌')
        );

        $bikeModels = BikeModel::where('bike_brand_id', $bikeBrandId)->with('bikeBrand')->orderBy('order');

        // 如果前端想要分頁顯示
        if ($request->boolean('paginate') === true) {
            return BikeModelCollection::make($bikeModels->paginate('20'));
        }

        return BikeModelCollection::make($bikeModels->get());
    }

    /**
     * 查看單一 bike_model 內容
     *
     * @urlParam id 車款id Example: 1
     */
    public function show(BikeModel $bikeModel)
    {
//        $this->authorize('view', [BikeModel::class]); //policy
        return BikeModelResource::make($bikeModel);
    }

    /**
     * 新增 bike_model
     *
     * @bodyparam bike_brand_id 所屬廠牌id Example: 1
     * @bodyparam name string:255 車款名稱 Example: 登山車
     */
    public function store(Request $request)
    {
//        $this->authorize('create', [BikeModel::class]); //policy
        $validated = $request->validate([
            'bike_brand_id' => 'int|required',
            'name'          => 'string|required|max:255',
        ]);

        // brand id 錯誤
        abort_if(
            BikeBrand::find($validated['bike_brand_id']) === null,
            Response::HTTP_BAD_REQUEST,
            __('無此廠牌，請重新確認')
        );

        // 相同 brand 下，新增相同 model
        $target = BikeModel::where('bike_brand_id', '=', $validated['bike_brand_id'], 'and')
            ->where('name', '=', $validated['name'])
            ->count();
        abort_if(
            $target > 0,
            Response::HTTP_BAD_REQUEST,
            __('該廠牌已有相同車款，請重新確認')
        );

        return BikeModelResource::make(BikeModel::create($validated));
    }

    /**
     * 更新一筆 bike_model 內容
     *
     * @urlParam id 車款id Example: 1
     * @bodyparam bike_brand_id int 所屬廠牌id Example: 1
     * @bodyparam name string:255 車款名稱 Example: 登山車
     */
    public function update(Request $request, BikeModel $bikeModel)
    {
//        $this->authorize('update', [BikeModel::class]); //policy
        $validated = $request->validate([
            'bike_brand_id' => 'int|required',
            'name'          => 'string|max:255|required',
        ]);

        // brand id 錯誤
        abort_if(
            BikeBrand::find($validated['bike_brand_id']) === null,
            Response::HTTP_BAD_REQUEST,
            __('無此廠牌，請重新確認')
        );

        // 相同 brand 下已有同名 model
        $target = BikeModel::where('bike_brand_id', '=', $validated['bike_brand_id'], 'and')
            ->where('name', '=', $validated['name'])
            ->count();
        abort_if(
            $target > 0,
            Response::HTTP_BAD_REQUEST,
            __('該廠牌已有相同車款，請重新確認')
        );

        $bikeModel->update($validated);

        return BikeModelResource::make($bikeModel);
    }

    /**
     * 刪除一個 bike_model
     *
     * @urlParam id 車款 id Example: 1
     */
    public function destroy(BikeModel $bikeModel)
    {
//        $this->authorize('delete', [BikeModel::class]); //policy
        $bikeModel->delete();

        // 尚未加入刪除底下所屬 bike_materials

        return 'successful';
    }
}
