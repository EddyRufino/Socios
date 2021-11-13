<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarjeta extends Model
{
    protected $guarded = [];

    //protected $with = ['asociacione'];

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    public function asociacione()
    {
        return $this->belongsTo(Asociacione::class);
    }
}
