<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'car_id', 'paid', 'road_id'
    ];

    public function road()
    {
        return $this->belongsTo(Road::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
