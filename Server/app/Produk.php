<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $connection = 'mysql2';
    protected $guarded = [''];

    public function city()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }
}
