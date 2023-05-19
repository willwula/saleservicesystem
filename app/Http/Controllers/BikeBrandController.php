<?php

namespace App\Http\Controllers;

use App\Models\BikeBrandModel;
use Illuminate\Http\Request;

class BikeBrandController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', [BikeBrandModel::class]); //policy
        $bikeBrands = BikeBrandModel::latest();
        return $bikeBrands->paginate();
    }
}
