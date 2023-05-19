<?php

namespace App\Http\Controllers;

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
    public function index()
    {
        $this->authorize('viewAny', [BikeBrandModel::class]); //policy
        $bikeBrands = BikeBrandModel::latest();
        return $bikeBrands->paginate();
    }
}
