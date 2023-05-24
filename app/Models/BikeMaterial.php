<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BikeMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'bike_part_id',
        'partial_number',
        'price',
        'warranty_month',
    ];

    public function bikeModels()
    {
        return $this->belongsToMany(BikeModel::class);
    }

    public function bikePart()
    {
        return $this->belongsTo(BikePart::class);
    }

}
