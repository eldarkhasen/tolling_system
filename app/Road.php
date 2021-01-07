<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Road extends Model
{
    protected $fillable = [
        'name', 'tariff'
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
