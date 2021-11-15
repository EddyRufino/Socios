<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fotocheck extends Model
{
    protected $guarded = [];

    public function getRouteKeyName()
    {
      return 'url';
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    public function asociacione()
    {
        return $this->belongsTo(Asociacione::class);
    }
}
