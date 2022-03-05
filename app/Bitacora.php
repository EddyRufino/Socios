<?php

namespace App;

use App\User;
use App\Vehiculo;
use App\Asociacione;
use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    protected $fillable = [
        'id',
        'url',
        'nombre_socio',
        'dni_socio',
        'nombre_propietario',
        'dni_propietario',
        'asociacione_id',
        'vehiculo_id',
        'tipo_documento_id',
        'tipo_persona',
        'num_placa',
        'expedicion',
        'revalidacion',
        'num_operacion',
        'vigencia_operacion',
        'num_autorizacion',
        'vigencia_autorizacion',
        'status',
        'fecha_print',
        'tipo',
        'num_correlativo',
        'socio_id',
        'user_id',
        'descripcion',
        'renovado',
        'disenio_id',
        'renovado_count',
        'suministro_id',
        'user_modifico',
        'image',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public $timestamps = false;

    public function getAsociacion($id)
    {
        $name = Asociacione::where('id', $id)->get('nombre');
        return $name[0]->nombre;
    }

    public function getAsociacionDelete($id)
    {
        $socioQuery = Socio::query();

        $asociacione = clone($socioQuery)->where('id', $id)->with('asociacione')->get('asociacione_id');
        $tipoPersona = clone($socioQuery)->where('id', $id)->get('tipo_persona');

        if (isset($asociacione[0]->asociacione_id) && $tipoPersona[0]->tipo_persona == 1) {
            return $asociacione[0]->asociacione->nombre;
        }

        if (is_null($asociacione[0]->asociacione_id) && $tipoPersona[0]->tipo_persona == 2) {
            return 'Persona Natural';
        } else {
            return 'Persona Jurídica';
        }
    }

    public function getVehiculo($id)
    {
        $vehiculo = Vehiculo::where('id', $id)->get('nombre');
        return $vehiculo[0]->nombre;
    }

    public function getUser($id)
    {
        if (!isset($id)) return '';
        
        $user = User::where('id', $id)->get('name');
        return $user[0]->name;
    }

    function getNombreSocioDelete($id) {
        $name = Socio::where('id', $id)->get('nombre_socio');
        return $name[0]->nombre_socio;
    }

    function getPropietarioDelete($id) {
        $name = Socio::where('id', $id)->get('nombre_propietario');
        return $name[0]->nombre_propietario;
    }

    function getDniDelete($id) {
        $name = Socio::where('id', $id)->get('dni_socio');
        // dd($name);
        return $name[0]->dni_socio;
    }
}
