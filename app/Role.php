<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    const ADMIN_ID = 1;
    const USER_ID = 2;

    public $timestamps = false;

    protected $fillable = [
        'name', 'tariff'
    ];
}
