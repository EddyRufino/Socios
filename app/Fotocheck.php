<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fotocheck extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public $with = ['vehiculo', 'socio'];

    public function getRouteKeyName()
    {
      return 'url';
    }

    public function getNumPlacaAttribute($value)
    {
        return strtoupper($value);
    }

    public function getNumAutorizacionAttribute($value)
    {
        return strtoupper($value);
    }

    public function setNombreSocioAttribute($nombre_socio) {

        $this->attributes['nombre_socio'] = ucwords($nombre_socio);

        $url = Str::of($nombre_socio)->slug('-');

        if (static::whereUrl($url)->exists()) {

            $this->attributes['url'] = Str::of($nombre_socio .'-'. now()->format('d'))->slug('-');

        } else {

            $this->attributes['url'] = Str::of($nombre_socio)->slug('-');
        }
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
