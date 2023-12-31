<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BikeBrand extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'order',
        'description',
    ];

    public function bikeModels()
    {
        return $this->hasMany(BikeModel::class);
    }
}
