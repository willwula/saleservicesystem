<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BikeModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'bike_brand_id',
        'name'
    ];

    public function bikeBrand()
    {
        $this->belongsTo(BikeBrand::class);
    }

    public function bikeMaterials()
    {
        $this->belongsToMany(BikeMaterial::class);
    }

}
