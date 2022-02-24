<?php

namespace App;

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
}
