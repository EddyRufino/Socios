<?php

namespace App\Http\Controllers\Export\Filtro;

use App\Socio;
use App\Disenio;
use App\Tarjeta;
use App\Fotocheck;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ViewFiltroController extends Controller
{
    public function createSocios()
    {
        $disenios = Disenio::get(['id', 'nombre']);

        return view('admin.template.filtros.socios', compact('disenios'));
    }

    public function storeSocios(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'vehiculo_id' => 'required',
            'print' => 'required',
        ]);

        $vehiculo_id = $request->vehiculo_id;
        $print = $request->print;
        $disenio_id = $request->disenio_id;
        $dateStart = $request->dateStart;
        $dateLast = $request->dateLast;
        $dateStartVigencia = $request->dateStartVigencia;
        $dateLastVigencia = $request->dateLastVigencia;
        $dateStartPrint = $request->dateStartPrint;
        $dateLastPrint = $request->dateLastPrint;

        $socio = false;
        $natural = false;
        $juridica = false;
        $socioNatural = false;
        $socioJuridica = false;
        $naturalJuridica = false;
        $todos = false;
        $vigenciaTarjeta = false;
        $vigenciaFotocheck = false;
        $vigenciaTodos = false;

        if ($request->tarjeta && $request->fotocheck) {

            if ($request->tarjeta && $request->fotocheck && $request->socio) {
                $socio = true;
            }
    
            if ($request->tarjeta && $request->fotocheck && $request->natural) {
                $natural = true;
            }
    
            if ($request->tarjeta && $request->fotocheck && $request->juridica) {
                $juridica = true;
            }
    
            if ($request->tarjeta && $request->fotocheck && $request->socio && $request->natural) {
                $socioNatural = true;
                $socio = false;
                $natural = false;
                $juridica = false;
            }
    
            if ($request->tarjeta && $request->fotocheck && $request->socio && $request->juridica) {
                $socioJuridica = true;
                $socio = false;
                $natural = false;
                $juridica = false;
            }
    
            if ($request->tarjeta && $request->fotocheck && $request->natural && $request->juridica) {
                $naturalJuridica = true;
                $socioJuridica = false;
                $socioNatural = false;
                $natural = false;
                $juridica = false;
                $socio = false;
            }

            if ($request->tarjeta && $request->fotocheck && $request->socio && $request->natural && $request->juridica) {
                $todos = true;
                $naturalJuridica = false;
                $socioJuridica = false;
                $socioNatural = false;
                $natural = false;
                $juridica = false;
                $socio = false;
            }

            $datas = Socio::when($socio, function ($query) use ($request) {
                $query
                    ->orWhereHas('tarjetas', function($query) use ($request) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereNotNull('asociacione_id');
                            })
                            ->whereIn('status', $request->print)
                            ->whereIn('vehiculo_id', $request->vehiculo_id)
                            ->whereIn('disenio_id', $request->disenio_id)
                            ->whereBetween('revalidacion', [$request->dateStartVigencia, $request->dateLastVigencia])
                            ->whereBetween('created_at', [$request->dateStart, $request->dateLast])
                            ->when($request->checkDatePrint, function ($query) use ($request) {
                                $query->whereBetween('fecha_print', [$request->dateStartPrint, $request->dateLastPrint]);
                            })
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                    })
                    ->orWhereHas('fotochecks', function($query) use ($request) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereNotNull('asociacione_id');
                            })
                            ->whereIn('status', $request->print)
                            ->whereIn('vehiculo_id', $request->vehiculo_id)
                            ->whereIn('disenio_id', $request->disenio_id)
                            ->whereBetween('revalidacion', [$request->dateStartVigencia, $request->dateLastVigencia])
                            ->whereBetween('created_at', [$request->dateStart, $request->dateLast])
                            ->when($request->checkDatePrint, function ($query) use ($request) {
                                $query->whereBetween('fecha_print', [$request->dateStartPrint, $request->dateLastPrint]);
                            })
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                    });
            })
            ->when($natural, function ($query) use ($request) {
                $query
                    ->orWhereHas('tarjetas', function($query) use ($request) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereNull('asociacione_id')
                                    ->where('tipo_persona', 2);
                            })
                            ->whereIn('status', $request->print)
                            ->whereIn('vehiculo_id', $request->vehiculo_id)
                            ->whereIn('disenio_id', $request->disenio_id)
                            ->whereBetween('revalidacion', [$request->dateStartVigencia, $request->dateLastVigencia])
                            ->whereBetween('created_at', [$request->dateStart, $request->dateLast])
                            ->when($request->checkDatePrint, function ($query) use ($request) {
                                $query->whereBetween('fecha_print', [$request->dateStartPrint, $request->dateLastPrint]);
                            })
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                    })
                    ->orWhereHas('fotochecks', function($query) use ($request) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereNull('asociacione_id')
                                    ->where('tipo_persona', 2);
                            })
                            ->whereIn('status', $request->print)
                            ->whereIn('vehiculo_id', $request->vehiculo_id)
                            ->whereIn('disenio_id', $request->disenio_id)
                            ->whereBetween('revalidacion', [$request->dateStartVigencia, $request->dateLastVigencia])
                            ->whereBetween('created_at', [$request->dateStart, $request->dateLast])
                            ->when($request->checkDatePrint, function ($query) use ($request) {
                                $query->whereBetween('fecha_print', [$request->dateStartPrint, $request->dateLastPrint]);
                            })
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                });
            })
            ->when($juridica, function ($query) use ($request) {
                $query
                    ->orWhereHas('tarjetas', function($query) use ($request) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereNull('asociacione_id')
                                    ->where('tipo_persona', 3);
                            })
                            ->whereIn('status', $request->print)
                            ->whereIn('vehiculo_id', $request->vehiculo_id)
                            ->whereIn('disenio_id', $request->disenio_id)
                            ->whereBetween('revalidacion', [$request->dateStartVigencia, $request->dateLastVigencia])
                            ->whereBetween('created_at', [$request->dateStart, $request->dateLast])
                            ->when($request->checkDatePrint, function ($query) use ($request) {
                                $query->whereBetween('fecha_print', [$request->dateStartPrint, $request->dateLastPrint]);
                            })
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                    })
                    ->orWhereHas('fotochecks', function($query) use ($request) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereNull('asociacione_id')
                                    ->where('tipo_persona', 3);
                            })
                            ->whereIn('status', $request->print)
                            ->whereIn('vehiculo_id', $request->vehiculo_id)
                            ->whereIn('disenio_id', $request->disenio_id)
                            ->whereBetween('revalidacion', [$request->dateStartVigencia, $request->dateLastVigencia])
                            ->whereBetween('created_at', [$request->dateStart, $request->dateLast])
                            ->when($request->checkDatePrint, function ($query) use ($request) {
                                $query->whereBetween('fecha_print', [$request->dateStartPrint, $request->dateLastPrint]);
                            })
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                });
            })
            ->when($socioNatural, function ($query) use ($request) {
                $query
                    ->orWhereHas('tarjetas', function($query) use ($request) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereIn('tipo_persona', [1,2]);
                            })
                            ->whereIn('status', $request->print)
                            ->whereIn('vehiculo_id', $request->vehiculo_id)
                            ->whereIn('disenio_id', $request->disenio_id)
                            ->whereBetween('revalidacion', [$request->dateStartVigencia, $request->dateLastVigencia])
                            ->whereBetween('created_at', [$request->dateStart, $request->dateLast])
                            ->when($request->checkDatePrint, function ($query) use ($request) {
                                $query->whereBetween('fecha_print', [$request->dateStartPrint, $request->dateLastPrint]);
                            })
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                    })
                    ->orWhereHas('fotochecks', function($query) use ($request) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereIn('tipo_persona', [1,2]);
                            })
                            ->whereIn('status', $request->print)
                            ->whereIn('vehiculo_id', $request->vehiculo_id)
                            ->whereIn('disenio_id', $request->disenio_id)
                            ->whereBetween('revalidacion', [$request->dateStartVigencia, $request->dateLastVigencia])
                            ->whereBetween('created_at', [$request->dateStart, $request->dateLast])
                            ->when($request->checkDatePrint, function ($query) use ($request) {
                                $query->whereBetween('fecha_print', [$request->dateStartPrint, $request->dateLastPrint]);
                            })
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                });
            })
            ->when($socioJuridica, function ($query) use ($request) {
                $query
                    ->orWhereHas('tarjetas', function($query) use ($request) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereIn('tipo_persona', [1,3]);
                            })
                            ->whereIn('status', $request->print)
                            ->whereIn('vehiculo_id', $request->vehiculo_id)
                            ->whereIn('disenio_id', $request->disenio_id)
                            ->whereBetween('revalidacion', [$request->dateStartVigencia, $request->dateLastVigencia])
                            ->whereBetween('created_at', [$request->dateStart, $request->dateLast])
                            ->when($request->checkDatePrint, function ($query) use ($request) {
                                $query->whereBetween('fecha_print', [$request->dateStartPrint, $request->dateLastPrint]);
                            })
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                    })
                    ->orWhereHas('fotochecks', function($query) use ($request) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereIn('tipo_persona', [1,3]);
                            })
                            ->whereIn('status', $request->print)
                            ->whereIn('vehiculo_id', $request->vehiculo_id)
                            ->whereIn('disenio_id', $request->disenio_id)
                            ->whereBetween('revalidacion', [$request->dateStartVigencia, $request->dateLastVigencia])
                            ->whereBetween('created_at', [$request->dateStart, $request->dateLast])
                            ->when($request->checkDatePrint, function ($query) use ($request) {
                                $query->whereBetween('fecha_print', [$request->dateStartPrint, $request->dateLastPrint]);
                            })
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                });
            })
            ->when($naturalJuridica, function ($query) use ($request) {
                $query
                    ->orWhereHas('tarjetas', function($query) use ($request) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereNull('asociacione_id')
                                    ->whereIn('tipo_persona', [2,3]);
                            })
                            ->whereIn('status', $request->print)
                            ->whereIn('vehiculo_id', $request->vehiculo_id)
                            ->whereIn('disenio_id', $request->disenio_id)
                            ->whereBetween('revalidacion', [$request->dateStartVigencia, $request->dateLastVigencia])
                            ->whereBetween('created_at', [$request->dateStart, $request->dateLast])
                            ->when($request->checkDatePrint, function ($query) use ($request) {
                                $query->whereBetween('fecha_print', [$request->dateStartPrint, $request->dateLastPrint]);
                            })
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                    })
                    ->orWhereHas('fotochecks', function($query) use ($request) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereNull('asociacione_id')
                                    ->whereIn('tipo_persona', [2,3]);
                            })
                            ->whereIn('status', $request->print)
                            ->whereIn('vehiculo_id', $request->vehiculo_id)
                            ->whereIn('disenio_id', $request->disenio_id)
                            ->whereBetween('revalidacion', [$request->dateStartVigencia, $request->dateLastVigencia])
                            ->whereBetween('created_at', [$request->dateStart, $request->dateLast])
                            ->when($request->checkDatePrint, function ($query) use ($request) {
                                $query->whereBetween('fecha_print', [$request->dateStartPrint, $request->dateLastPrint]);
                            })
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                });
            })
            ->when($todos, function ($query) use ($request)  {
                $query
                    ->orWhereHas('tarjetas', function($query) use ($request) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereIn('tipo_persona', [1,2,3]);
                            })
                            ->whereIn('status', $request->print)
                            ->whereIn('vehiculo_id', $request->vehiculo_id)
                            ->whereIn('disenio_id', $request->disenio_id)
                            ->whereBetween('revalidacion', [$request->dateStartVigencia, $request->dateLastVigencia])
                            ->whereBetween('created_at', [$request->dateStart, $request->dateLast])
                            ->when($request->checkDatePrint, function ($query) use ($request) {
                                $query->whereBetween('fecha_print', [$request->dateStartPrint, $request->dateLastPrint]);
                            })
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                    })
                    ->orWhereHas('fotochecks', function($query) use ($request) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereIn('tipo_persona', [1,2,3]);
                            })
                            ->whereIn('status', $request->print)
                            ->whereIn('vehiculo_id', $request->vehiculo_id)
                            ->whereIn('disenio_id', $request->disenio_id)
                            ->whereBetween('revalidacion', [$request->dateStartVigencia, $request->dateLastVigencia])
                            ->whereBetween('created_at', [$request->dateStart, $request->dateLast])
                            ->when($request->checkDatePrint, function ($query) use ($request) {
                                $query->whereBetween('fecha_print', [$request->dateStartPrint, $request->dateLastPrint]);
                            })
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                    });
            })
            ->whereNull('asociacione_id')
            ->whereIn('vehiculo_id', $vehiculo_id)
            // ->get();
            ->paginate(15, ['id', 'nombre_socio', 'dni_socio', 'url', 'num_placa', 'vehiculo_id', 'asociacione_id', 'tipo_documento_id']);

            // dd($datas);
            return view('admin.template.filtros.tarjetasFotochecks', compact('datas'));

        } elseif($request->fotocheck) {

            // dd($vehiculo_id);
    
            if ($request->fotocheck && $request->socio) {
                $socio = true;
            }
    
            if ($request->fotocheck && $request->natural) {
                $natural = true;
            }
    
            if ($request->fotocheck && $request->juridica) {
                $juridica = true;
            }
    
            if ($request->fotocheck && $request->socio && $request->natural) {
                $socioNatural = true;
                $socio = false;
                $natural = false;
                $juridica = false;
            }
    
            if ($request->fotocheck && $request->socio && $request->juridica) {
                $socioJuridica = true;
                $socio = false;
                $natural = false;
                $juridica = false;
            }
    
            if ($request->fotocheck && $request->natural && $request->juridica) {
                $naturalJuridica = true;
                $socioJuridica = false;
                $socioNatural = false;
                $natural = false;
                $juridica = false;
                $socio = false;
            }

            if ($request->fotocheck && $request->socio && $request->natural && $request->juridica) {
                $todos = true;
                $naturalJuridica = false;
                $socioJuridica = false;
                $socioNatural = false;
                $natural = false;
                $juridica = false;
                $socio = false;
            }
            
            $datas = Fotocheck::when($socio, function ($query) use ($request) {
                $query->whereIn('vehiculo_id', $request->vehiculo_id)
                    ->whereIn('status', $request->print)
                    ->whereIn('disenio_id', $request->disenio_id)
                    ->whereBetween('created_at', [$request->dateStart, $request->dateLast])
                    ->whereBetween('revalidacion', [$request->dateStartVigencia, $request->dateLastVigencia])
                    ->when($request->checkDatePrint, function ($query) use ($request) {
                        $query->whereBetween('fecha_print', [$request->dateStartPrint, $request->dateLastPrint]);
                    })
                    ->whereHas('socio', function($query) {
                        $query->whereNotNull('asociacione_id')->select(['id', 'asociacione_id']);
                    });
            })
            ->when($natural, function ($query) use ($request) {
                $query->whereIn('vehiculo_id', $request->vehiculo_id)
                    ->whereIn('status', $request->print)
                    ->whereIn('disenio_id', $request->disenio_id)
                    ->whereBetween('created_at', [$request->dateStart, $request->dateLast])
                    ->whereBetween('revalidacion', [$request->dateStartVigencia, $request->dateLastVigencia])
                    ->when($request->checkDatePrint, function ($query) use ($request) {
                        $query->whereBetween('fecha_print', [$request->dateStartPrint, $request->dateLastPrint]);
                    })
                    ->whereHas('socio', function($query) {
                        $query->whereNull('asociacione_id')
                            ->where('tipo_documento_id', '!=', 3)
                            ->select(['id', 'asociacione_id', 'tipo_documento_id']);
                    });
            })
            ->when($juridica, function ($query) use ($request) {
                $query->whereIn('vehiculo_id', $request->vehiculo_id)
                    ->whereIn('status', $request->print)
                    ->whereIn('disenio_id', $request->disenio_id)
                    ->whereBetween('created_at', [$request->dateStart, $request->dateLast])
                    ->whereBetween('revalidacion', [$request->dateStartVigencia, $request->dateLastVigencia])
                    ->when($request->checkDatePrint, function ($query) use ($request) {
                        $query->whereBetween('fecha_print', [$request->dateStartPrint, $request->dateLastPrint]);
                    })
                    ->whereHas('socio', function($query) {
                        $query->whereNull('asociacione_id')
                            ->where('tipo_documento_id', 3)
                            ->select(['id', 'asociacione_id', 'tipo_documento_id']);
                    });
            })
            ->when($socioNatural, function ($query) use ($request) {
                $query->whereIn('vehiculo_id', $request->vehiculo_id)
                    ->whereIn('status', $request->print)
                    ->whereIn('disenio_id', $request->disenio_id)
                    ->whereBetween('created_at', [$request->dateStart, $request->dateLast])
                    ->whereBetween('revalidacion', [$request->dateStartVigencia, $request->dateLastVigencia])
                    ->when($request->checkDatePrint, function ($query) use ($request) {
                        $query->whereBetween('fecha_print', [$request->dateStartPrint, $request->dateLastPrint]);
                    })
                    ->whereHas('socio', function($query) {
                        $query->where('tipo_documento_id', '!=', 3)->select(['id', 'tipo_documento_id']);
                    });
            })
            ->when($socioJuridica, function ($query) use ($request) {
                $query->whereIn('vehiculo_id', $request->vehiculo_id)
                    ->whereIn('status', $request->print)
                    ->whereIn('disenio_id', $request->disenio_id)
                    ->whereBetween('created_at', [$request->dateStart, $request->dateLast])
                    ->whereBetween('revalidacion', [$request->dateStartVigencia, $request->dateLastVigencia])
                    ->when($request->checkDatePrint, function ($query) use ($request) {
                        $query->whereBetween('fecha_print', [$request->dateStartPrint, $request->dateLastPrint]);
                    })
                    ->whereHas('socio', function ($query) {
                        $query->whereIn('tipo_persona', [1, 3])
                            ->select(['id', 'tipo_persona']);
                    });
            })
            ->when($naturalJuridica, function ($query) use ($request)  {
                $query->whereIn('vehiculo_id', $request->vehiculo_id)
                    ->whereIn('status', $request->print)
                    ->whereIn('disenio_id', $request->disenio_id)
                    ->whereBetween('created_at', [$request->dateStart, $request->dateLast])
                    ->whereBetween('revalidacion', [$request->dateStartVigencia, $request->dateLastVigencia])
                    ->when($request->checkDatePrint, function ($query) use ($request) {
                        $query->whereBetween('fecha_print', [$request->dateStartPrint, $request->dateLastPrint]);
                    })
                    ->whereHas('socio', function($query) {
                        $query->whereNull('asociacione_id')->select(['id', 'asociacione_id']);
                    });
            })
            ->when($todos, function ($query) use ($request)  {
                $query->whereIn('vehiculo_id', $request->vehiculo_id)
                    ->whereIn('status', $request->print)
                    ->whereIn('disenio_id', $request->disenio_id)
                    ->whereBetween('created_at', [$request->dateStart, $request->dateLast])
                    ->whereBetween('revalidacion', [$request->dateStartVigencia, $request->dateLastVigencia])
                    ->when($request->checkDatePrint, function ($query) use ($request) {
                        $query->whereBetween('fecha_print', [$request->dateStartPrint, $request->dateLastPrint]);
                    });
            })
            ->paginate(15, ['id', 'url', 'num_placa', 'revalidacion', 'socio_id', 'status', 'vehiculo_id', 'created_at']);
        
            return view('admin.template.filtros.socioSearch', compact('datas'));

        } elseif($request->tarjeta) {
    
            if ($request->tarjeta && $request->socio) {
                $socio = true;
            }
    
            if ($request->tarjeta && $request->natural) {
                $natural = true;
            }
    
            if ($request->tarjeta && $request->juridica) {
                $juridica = true;
            }
    
            if ($request->tarjeta && $request->socio && $request->natural) {
                $socioNatural = true;
                $socio = false;
                $natural = false;
                $juridica = false;
            }
    
            if ($request->tarjeta && $request->socio && $request->juridica) {
                $socioJuridica = true;
                $socio = false;
                $natural = false;
                $juridica = false;
            }
    
            if ($request->tarjeta && $request->natural && $request->juridica) {
                $naturalJuridica = true;
                $socioJuridica = false;
                $socioNatural = false;
                $natural = false;
                $juridica = false;
                $socio = false;
            }

            if ($request->tarjeta && $request->socio && $request->natural && $request->juridica) {
                $todos = true;
                $naturalJuridica = false;
                $socioJuridica = false;
                $socioNatural = false;
                $natural = false;
                $juridica = false;
                $socio = false;
            }
            
            $datas = Tarjeta::when($socio, function ($query) use ($request) {
                $query->whereIn('vehiculo_id', $request->vehiculo_id)
                    ->whereIn('status', $request->print)
                    ->whereIn('disenio_id', $request->disenio_id)
                    ->whereBetween('created_at', [$request->dateStart, $request->dateLast])
                    ->whereBetween('revalidacion', [$request->dateStartVigencia, $request->dateLastVigencia])
                    ->when($request->checkDatePrint, function ($query) use ($request) {
                        $query->whereBetween('fecha_print', [$request->dateStartPrint, $request->dateLastPrint]);
                    })
                    ->whereHas('socio', function($query) {
                        $query->whereNotNull('asociacione_id')->select(['id', 'asociacione_id']);
                    });
            })
            ->when($natural, function ($query) use ($request) {
                $query->whereIn('vehiculo_id', $request->vehiculo_id)
                    ->whereIn('status', $request->print)
                    ->whereIn('disenio_id', $request->disenio_id)
                    ->whereBetween('created_at', [$request->dateStart, $request->dateLast])
                    ->whereBetween('revalidacion', [$request->dateStartVigencia, $request->dateLastVigencia])
                    ->when($request->checkDatePrint == 'on', function ($query) use ($request) {
                        $query->whereBetween('fecha_print', [$request->dateStartPrint, $request->dateLastPrint]);
                    })
                    ->whereHas('socio', function($query) {
                        $query->whereNull('asociacione_id')
                            ->where('tipo_documento_id', '!=', 3)
                            ->select(['id', 'asociacione_id', 'tipo_documento_id']);
                    });
            })
            ->when($juridica, function ($query) use ($request) {
                $query->whereIn('vehiculo_id', $request->vehiculo_id)
                    ->whereIn('status', $request->print)
                    ->whereIn('disenio_id', $request->disenio_id)
                    ->whereBetween('created_at', [$request->dateStart, $request->dateLast])
                    ->whereBetween('revalidacion', [$request->dateStartVigencia, $request->dateLastVigencia])
                    ->when($request->checkDatePrint, function ($query) use ($request) {
                        $query->whereBetween('fecha_print', [$request->dateStartPrint, $request->dateLastPrint]);
                    })
                    ->whereHas('socio', function($query) {
                        $query->whereNull('asociacione_id')
                            ->where('tipo_documento_id', 3)
                            ->select(['id', 'asociacione_id', 'tipo_documento_id']);
                    });
            })
            ->when($socioNatural, function ($query) use ($request) {
                $query->whereIn('vehiculo_id', $request->vehiculo_id)
                    ->whereIn('status', $request->print)
                    ->whereIn('disenio_id', $request->disenio_id)
                    ->whereBetween('created_at', [$request->dateStart, $request->dateLast])
                    ->whereBetween('revalidacion', [$request->dateStartVigencia, $request->dateLastVigencia])
                    ->when($request->checkDatePrint, function ($query) use ($request) {
                        $query->whereBetween('fecha_print', [$request->dateStartPrint, $request->dateLastPrint]);
                    })
                    ->whereHas('socio', function($query) {
                        $query->where('tipo_documento_id', '!=', 3)->select(['id', 'tipo_documento_id']);
                    });
            })
            ->when($socioJuridica, function ($query) use ($request) {
                $query->whereIn('vehiculo_id', $request->vehiculo_id)
                    ->whereIn('status', $request->print)
                    ->whereIn('disenio_id', $request->disenio_id)
                    ->whereBetween('created_at', [$request->dateStart, $request->dateLast])
                    ->whereBetween('revalidacion', [$request->dateStartVigencia, $request->dateLastVigencia])
                    ->when($request->checkDatePrint, function ($query) use ($request) {
                        $query->whereBetween('fecha_print', [$request->dateStartPrint, $request->dateLastPrint]);
                    })
                    ->whereHas('socio', function ($query) {
                        $query->whereIn('tipo_persona', [1, 3])
                            ->select(['id', 'tipo_persona']);
                    });
            })
            ->when($naturalJuridica, function ($query) use ($request)  {
                $query->whereIn('vehiculo_id', $request->vehiculo_id)
                    ->whereIn('status', $request->print)
                    ->whereIn('disenio_id', $request->disenio_id)
                    ->whereBetween('created_at', [$request->dateStart, $request->dateLast])
                    ->whereBetween('revalidacion', [$request->dateStartVigencia, $request->dateLastVigencia])
                    ->when($request->checkDatePrint, function ($query) use ($request) {
                        $query->whereBetween('fecha_print', [$request->dateStartPrint, $request->dateLastPrint]);
                    })
                    ->whereHas('socio', function($query) {
                        $query->whereNull('asociacione_id')->select(['id', 'asociacione_id']);
                    });
            })
            ->when($todos, function ($query) use ($request)  {
                $query->whereIn('vehiculo_id', $request->vehiculo_id)
                    ->whereIn('status', $request->print)
                    ->whereIn('disenio_id', $request->disenio_id)
                    ->whereBetween('created_at', [$request->dateStart, $request->dateLast])
                    ->whereBetween('revalidacion', [$request->dateStartVigencia, $request->dateLastVigencia])
                    ->when($request->checkDatePrint, function ($query) use ($request) {
                        $query->whereBetween('fecha_print', [$request->dateStartPrint, $request->dateLastPrint]);
                    });
            })
            ->paginate(15, ['id', 'url', 'num_placa', 'revalidacion', 'socio_id', 'status', 'vehiculo_id', 'created_at']);
        
            return view('admin.template.filtros.socioSearch', compact('datas'));
        }
        
        return back(); // Cuando no elijan(dejen en blanco) ni tarjeta ni fotocheck

    }

        // return view('admin.template.filtros.socioSearch', compact('socios'));
    //}

    // public function getTarjetas()
    // {
    //     return view('admin.template.filtros.socios');
    // }

    // public function getFotochecks()
    // {
    //     return view('admin.template.filtros.socios');
    // }
}
