<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fotocheck extends Model
{
    use SoftDeletes;

    // protected $table = 'fotochecks';

    // protected $primaryKey = 'id';

    protected $guarded = [];

    // public $with = ['vehiculo', 'socio'];

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

    public function getAsociacion($id)
    {
        $name = Asociacione::where('id', $id)->get('nombre');
        return $name[0]->nombre;
    }

    public function getAsociacionDewlete($id)
    {
        $socioQuery = Socio::query();

        $asociacione = clone($socioQuery)->where('id', $id)->with('asociacione')->pluck('asociacione_id');
        $tipoPersona = clone($socioQuery)->where('id', $id)->pluck('tipo_persona');

        if ($tipoPersona->implode('') == '1') {
            return $this->getAsociacion($asociacione->implode(''));
        }

        if ($tipoPersona->implode('') == '2') {
            return 'Persona Natural';
        } else {
            return 'Persona Jurídica';
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
