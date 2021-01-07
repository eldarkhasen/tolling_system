<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'name', 'model',  'number', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function purchases(){
        return $this->hasMany(Purchase::class);
    }
}
