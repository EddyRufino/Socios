<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tarjeta extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function getRouteKeyName()
    {
      return 'url';
    }

    public function setNombreSocioAttribute($nombre_socio) {

        $this->attributes['nombre_socio'] = $nombre_socio;

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

    public function asociacione()
    {
        return $this->belongsTo(Asociacione::class);
    }
}
