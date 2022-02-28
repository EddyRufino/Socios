<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class Tarjeta extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function getRouteKeyName()
    {
      return 'url';
    }

    public function getNumPlacaAttribute($value)
    {
        return strtoupper($value);
    }

    public function getVigenciaOperacionAttribute($value)
    {
        return strtoupper($value);
    }

    public function getNumAutorizacionAttribute($value)
    {
        return strtoupper($value);
    }

    public function getVigenciaAutorizacionAttribute($value)
    {
        return strtoupper($value);
    }

    public function setNumPlacaAttribute($value)
    {
        $this->attributes['num_placa'] = strtoupper($value);
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

    // protected static function boot() {
    //     parent::boot();
    
    //     self::updating(function($tarjeta) {
    //         // dd($tarjeta);
    //         Log::info($tarjeta);
    //     });
    // }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    // protected static function booted()
    // {
    //     static::updated(function ($socio) {
    //         Log::info($this->socio);
    //         // bitacora::create($tarjeta);
    //     });
    // }
}
