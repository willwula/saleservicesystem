<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BikeMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        'bike_model_id',
        'bike_part_id',
        'partial_number',
        'price',
        'warranty_month',
    ];

    public function bikeModel()
    {
        $this->belongsTo(BikeModel::class);
    }

    public function bikeParts()
    {
        $this->belongsTo(BikePart::class);
    }

}
