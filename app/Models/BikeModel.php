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
        return $this->belongsTo(BikeBrand::class, 'bike_brand_id');
    }

    public function bikeMaterials()
    {
        return $this->belongsToMany(BikeMaterial::class)->withTimestamps();
    }

}
