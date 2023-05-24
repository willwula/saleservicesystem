<?php

namespace App\Http\Controllers;

use App\Http\Resources\BikeModelCollection;
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
}
