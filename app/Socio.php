<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Socio extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    // protected $table = 'socios';

    // public $with = ['tarjetas', 'fotochecks', 'asociacione'];
    // public $with = [];

    public function getRouteKeyName()
    {
      return 'url';
    }

    public function setNombrePropietarioAttribute($value)
    {
        $this->attributes['nombre_propietario'] = ucwords($value);
    }

    public function setNumPlacaAttribute($value)
    {
        $this->attributes['num_placa'] = strtoupper($value);
    }

    public function setNombreSocioAttribute($nombre_socio) {

        $this->attributes['nombre_socio'] = ucwords($nombre_socio);

        $url = Str::of($nombre_socio)->slug('-');

        if (static::whereUrl($url)->exists()) {

            $this->attributes['url'] = Str::of($nombre_socio .'-'. now()->format('H:i:s'))->slug('-');

        } else {

            $this->attributes['url'] = Str::of($nombre_socio)->slug('-');
        }
    }

    public function asociacione()
    {
        return $this->belongsTo(Asociacione::class);
    }

    public function tarjetas()
    {
        return $this->hasMany(Tarjeta::class);
    }

    public function fotochecks()
    {
        return $this->hasMany(Fotocheck::class);
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    public function documento()
    {
        return $this->belongsTo(TipoDocumento::class, 'tipo_documento_id');
    }
}
