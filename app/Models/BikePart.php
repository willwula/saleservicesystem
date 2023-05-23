<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BikePart extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function bikeMaterials()
    {
        $this->hasMany(BikeMaterial::class);
    }
}
