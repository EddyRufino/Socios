<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Socio extends Model
{
    protected $guarded = [];

    public function getRouteKeyName()
    {
      return 'url';
    }

    public function setNombrePropietarioAttribute($value)
    {
        $this->attributes['nombre_propietario'] = ucwords($value);
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

    //public static function create(array $attributes = []) {

        //$socio = static::query()->create($attributes);

        //$url = \Str::slug($attributes['nombre_socio']);

        //if (static::whereUrl($url)->exists()) {

            //$socio->url = \Str::slug($attributes['nombre_socio']) . "-{$socio->id}";
        //} else {

            //$socio->url = \Str::slug($attributes['nombre_socio']);
        //}

        //if (!empty($attributes['image'])) {
            //$socio->image = '/storage/'.request()->file('image')->store('fotos', 'public');
        //}

        //$socio->save();

        //return $socio;
    //}

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
}
