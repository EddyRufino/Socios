<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asociacione extends Model
{
    protected $guarded = [];

    protected $with = ['tarjetas', 'fotochecks'];

    public function tarjetas()
    {
        return $this->hasMany(Tarjeta::class);
    }

    public function fotochecks()
    {
        return $this->hasMany(Fotocheck::class);
    }
}
