<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tarjeta extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public $with = ['vehiculo'];

    public function getRouteKeyName()
    {
      return 'url';
    }

    public function setNumPlacaAttribute($value)
    {
        $this->attributes['num_placa'] = strtoupper($value);
    }

    //public function setNombreSocioAttribute($nombre_socio) {

        //$this->attributes['nombre_socio'] = $nombre_socio;

        //$url = Str::of($nombre_socio)->slug('-');

        //if (static::whereUrl($url)->exists()) {

            //$this->attributes['url'] = Str::of($nombre_socio .'-'. now()->format('d'))->slug('-');

        //} else {

            //$this->attributes['url'] = Str::of($nombre_socio)->slug('-');
        //}
    //}

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    public function socio()
    {
        return $this->belongsTo(Socio::class);
    }
}
