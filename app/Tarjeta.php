<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tarjeta extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    // public $with = ['vehiculo', 'socio'];

    public function getRouteKeyName()
    {
      return 'url';
    }

    public function setNumPlacaAttribute($value)
    {
        $this->attributes['num_placa'] = strtoupper($value);
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    public function socio()
    {
        return $this->belongsTo(Socio::class);
    }

    public function disenio()
    {
        return $this->belongsTo(Disenio::class);
    }
}
