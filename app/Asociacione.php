<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asociacione extends Model
{
    use SoftDeletes;

    protected $fillable = ['nombre'];

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
