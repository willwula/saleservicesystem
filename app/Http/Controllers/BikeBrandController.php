<?php

namespace App\Http\Controllers;

use App\Models\BikeBrand;
use App\Models\BikeBrandModel;

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
     * 適用於下拉式選單等
     */
    public function index()
    {
//        $this->authorize('viewAny', [BikeBrandModel::class]); //policy
        $bikeBrands = BikeBrand::orderBy('order');
        return $bikeBrands->paginate('20');
    }
}
