<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buy extends Model
{
    protected $guarded = [''];

    public function produk()
    {
        return $this->hasOne(Produk::class, 'id', 'produk_id');
    }
}
