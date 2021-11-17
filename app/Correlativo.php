<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Correlativo extends Model
{
    public $timestamps = false;

    protected $fillable = ['num_inicio', 'num_correlativo', 'tipo'];
}
