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
    ];

    public $timestamps = false;

    public function getAsociacion($id)
    {
        $name = Asociacione::where('id', $id)->get('nombre');
        return $name[0]->nombre;
    }

    public function getVehiculo($id)
    {
        $vehiculo = Vehiculo::where('id', $id)->get('nombre');
        return $vehiculo[0]->nombre;
    }

    public function getUser($id)
    {
        $user = User::where('id', $id)->get('name');
        return $user[0]->name;
    }
}
