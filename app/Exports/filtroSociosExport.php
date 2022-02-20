<?php

namespace App\Exports;

use App\Area;
use App\Socio;
use App\Tarjeta;
use App\Fotocheck;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class filtroSociosExport implements FromView
{
    use Exportable;

    private $isTarjeta;
    private $isFotocheck;
    private $vehiculo_id;
    private $print;
    private $dateStart;
    private $dateLast;
    private $dateStartVigencia;
    // private $isTarjeta;

    public function forDate($isTarjeta, $isFotocheck, $vehiculo_id, $print, $dateStart, $dateLast, $dateStartVigencia, $dateLastVigencia)
    {
        $this->isTarjeta = $isTarjeta;
        $this->isFotocheck = $isFotocheck;
        $this->vehiculo_id = $vehiculo_id;
        $this->print = $print;
        $this->dateStart = $dateStart;
        $this->dateLast = $dateLast;
        $this->dateStartVigencia = $dateStartVigencia;
        $this->dateLastVigencia = $dateLastVigencia;

        return $this;
    }

    public function view(): View
    {
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
        
        if ($this->isTarjeta && $this->isFotocheck) {

            if ($this->isTarjeta && $this->isFotocheck && request()->socio) {
                $socio = true;
            }
    
            if ($this->isTarjeta && $this->isFotocheck && request()->natural) {
                $natural = true;
            }
    
            if ($this->isTarjeta && $this->isFotocheck && request()->juridica) {
                $juridica = true;
            }
    
            if ($this->isTarjeta && $this->isFotocheck && request()->socio && request()->natural) {
                $socioNatural = true;
                $socio = false;
                $natural = false;
                $juridica = false;
            }
    
            if ($this->isTarjeta && $this->isFotocheck && request()->socio && request()->juridica) {
                $socioJuridica = true;
                $socio = false;
                $natural = false;
                $juridica = false;
            }
    
            if ($this->isTarjeta && $this->isFotocheck && request()->natural && request()->juridica) {
                $naturalJuridica = true;
                $socioJuridica = false;
                $socioNatural = false;
                $natural = false;
                $juridica = false;
                $socio = false;
            }

            if ($this->isTarjeta && $this->isFotocheck && request()->socio && request()->natural && request()->juridica) {
                $todos = true;
                $naturalJuridica = false;
                $socioJuridica = false;
                $socioNatural = false;
                $natural = false;
                $juridica = false;
                $socio = false;
            }

            $datas = Socio::when($socio, function ($query) {
                $query
                    ->orWhereHas('tarjetas', function($query) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereNotNull('asociacione_id');
                            })
                            ->whereIn('status', $this->print)
                            ->whereIn('vehiculo_id', $this->vehiculo_id)
                            ->whereBetween('revalidacion', [$this->dateStartVigencia, $this->dateLastVigencia])
                            ->whereBetween('created_at', [$this->dateStart, $this->dateLast])
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                    })
                    ->orWhereHas('fotochecks', function($query) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereNotNull('asociacione_id');
                            })
                            ->whereIn('status', $this->print)
                            ->whereIn('vehiculo_id', $this->vehiculo_id)
                            ->whereBetween('revalidacion', [$this->dateStartVigencia, $this->dateLastVigencia])
                            ->whereBetween('created_at', [$this->dateStart, $this->dateLast])
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                    });
            })
            ->when($natural, function ($query) {
                $query
                    ->orWhereHas('tarjetas', function($query) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereNull('asociacione_id')
                                    ->where('tipo_persona', 2);
                            })
                            ->whereIn('status', $this->print)
                            ->whereIn('vehiculo_id', $this->vehiculo_id)
                            ->whereBetween('revalidacion', [$this->dateStartVigencia, $this->dateLastVigencia])
                            ->whereBetween('created_at', [$this->dateStart, $this->dateLast])
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                    })
                    ->orWhereHas('fotochecks', function($query) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereNull('asociacione_id')
                                    ->where('tipo_persona', 2);
                            })
                            ->whereIn('status', $this->print)
                            ->whereIn('vehiculo_id', $this->vehiculo_id)
                            ->whereBetween('revalidacion', [$this->dateStartVigencia, $this->dateLastVigencia])
                            ->whereBetween('created_at', [$this->dateStart, $this->dateLast])
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                });
            })
            ->when($juridica, function ($query) {
                $query
                    ->orWhereHas('tarjetas', function($query) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereNull('asociacione_id')
                                    ->where('tipo_persona', 3);
                            })
                            ->whereIn('status', $this->print)
                            ->whereIn('vehiculo_id', $this->vehiculo_id)
                            ->whereBetween('revalidacion', [$this->dateStartVigencia, $this->dateLastVigencia])
                            ->whereBetween('created_at', [$this->dateStart, $this->dateLast])
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                    })
                    ->orWhereHas('fotochecks', function($query) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereNull('asociacione_id')
                                    ->where('tipo_persona', 3);
                            })
                            ->whereIn('status', $this->print)
                            ->whereIn('vehiculo_id', $this->vehiculo_id)
                            ->whereBetween('revalidacion', [$this->dateStartVigencia, $this->dateLastVigencia])
                            ->whereBetween('created_at', [$this->dateStart, $this->dateLast])
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                });
            })
            ->when($socioNatural, function ($query) {
                $query
                    ->orWhereHas('tarjetas', function($query) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereIn('tipo_persona', [1,2]);
                            })
                            ->whereIn('status', $this->print)
                            ->whereIn('vehiculo_id', $this->vehiculo_id)
                            ->whereBetween('revalidacion', [$this->dateStartVigencia, $this->dateLastVigencia])
                            ->whereBetween('created_at', [$this->dateStart, $this->dateLast])
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                    })
                    ->orWhereHas('fotochecks', function($query) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereIn('tipo_persona', [1,2]);
                            })
                            ->whereIn('status', $this->print)
                            ->whereIn('vehiculo_id', $this->vehiculo_id)
                            ->whereBetween('revalidacion', [$this->dateStartVigencia, $this->dateLastVigencia])
                            ->whereBetween('created_at', [$this->dateStart, $this->dateLast])
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                });
            })
            ->when($socioJuridica, function ($query) {
                $query
                    ->orWhereHas('tarjetas', function($query) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereIn('tipo_persona', [1,3]);
                            })
                            ->whereIn('status', $this->print)
                            ->whereIn('vehiculo_id', $this->vehiculo_id)
                            ->whereBetween('revalidacion', [$this->dateStartVigencia, $this->dateLastVigencia])
                            ->whereBetween('created_at', [$this->dateStart, $this->dateLast])
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                    })
                    ->orWhereHas('fotochecks', function($query) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereIn('tipo_persona', [1,3]);
                            })
                            ->whereIn('status', $this->print)
                            ->whereIn('vehiculo_id', $this->vehiculo_id)
                            ->whereBetween('revalidacion', [$this->dateStartVigencia, $this->dateLastVigencia])
                            ->whereBetween('created_at', [$this->dateStart, $this->dateLast])
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                });
            })
            ->when($naturalJuridica, function ($query) {
                $query
                    ->orWhereHas('tarjetas', function($query) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereNull('asociacione_id')
                                    ->whereIn('tipo_persona', [2,3]);
                            })
                            ->whereIn('status', $this->print)
                            ->whereIn('vehiculo_id', $this->vehiculo_id)
                            ->whereBetween('revalidacion', [$this->dateStartVigencia, $this->dateLastVigencia])
                            ->whereBetween('created_at', [$this->dateStart, $this->dateLast])
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                    })
                    ->orWhereHas('fotochecks', function($query) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereNull('asociacione_id')
                                    ->whereIn('tipo_persona', [2,3]);
                            })
                            ->whereIn('status', $this->print)
                            ->whereIn('vehiculo_id', $this->vehiculo_id)
                            ->whereBetween('revalidacion', [$this->dateStartVigencia, $this->dateLastVigencia])
                            ->whereBetween('created_at', [$this->dateStart, $this->dateLast])
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                });
            })
            ->whereNull('asociacione_id')
            ->whereIn('vehiculo_id', $this->vehiculo_id)
            ->get(['id', 'nombre_socio', 'dni_socio', 'url', 'num_placa', 'vehiculo_id', 'asociacione_id', 'tipo_documento_id']);
            
            $area = Area::first();

            return view('admin.template.filtros.tarjetasFotochecksExcelInfo', compact('datas', 'area'));
        
        } elseif($this->isFotocheck) {

            // dd($vehiculo_id);
    
            if ($this->isFotocheck && request()->socio) {
                $socio = true;
            }
    
            if ($this->isFotocheck && request()->natural) {
                $natural = true;
            }
    
            if ($this->isFotocheck && request()->juridica) {
                $juridica = true;
            }
    
            if ($this->isFotocheck && request()->socio && request()->natural) {
                $socioNatural = true;
                $socio = false;
                $natural = false;
                $juridica = false;
            }
    
            if ($this->isFotocheck && request()->socio && request()->juridica) {
                $socioJuridica = true;
                $socio = false;
                $natural = false;
                $juridica = false;
            }
    
            if ($this->isFotocheck && request()->natural && request()->juridica) {
                $naturalJuridica = true;
                $socioJuridica = false;
                $socioNatural = false;
                $natural = false;
                $juridica = false;
                $socio = false;
            }

            if ($this->isFotocheck && request()->socio && request()->natural && request()->juridica) {
                $todos = true;
                $naturalJuridica = false;
                $socioJuridica = false;
                $socioNatural = false;
                $natural = false;
                $juridica = false;
                $socio = false;
            }
            
            $datas = Fotocheck::when($socio, function ($query) {
                $query->whereIn('vehiculo_id', $this->vehiculo_id)
                    ->whereIn('status', $this->print)
                    ->whereBetween('created_at', [$this->dateStart, $this->dateLast])
                    ->whereBetween('revalidacion', [$this->dateStartVigencia, $this->dateLastVigencia])
                    ->whereHas('socio', function($query) {
                        $query->whereNotNull('asociacione_id')->select(['id', 'asociacione_id']);
                    });
            })
            ->when($natural, function ($query) {
                $query->whereIn('vehiculo_id', $this->vehiculo_id)
                    ->whereIn('status', $this->print)
                    ->whereBetween('created_at', [$this->dateStart, $this->dateLast])
                    ->whereBetween('revalidacion', [$this->dateStartVigencia, $this->dateLastVigencia])
                    ->whereHas('socio', function($query) {
                        $query->whereNull('asociacione_id')
                            ->where('tipo_documento_id', '!=', 3)
                            ->select(['id', 'asociacione_id', 'tipo_documento_id']);
                    });
            })
            ->when($juridica, function ($query) {
                $query->whereIn('vehiculo_id', $this->vehiculo_id)
                    ->whereIn('status', $this->print)
                    ->whereBetween('created_at', [$this->dateStart, $this->dateLast])
                    ->whereBetween('revalidacion', [$this->dateStartVigencia, $this->dateLastVigencia])
                    ->whereHas('socio', function($query) {
                        $query->whereNull('asociacione_id')
                            ->where('tipo_documento_id', 3)
                            ->select(['id', 'asociacione_id', 'tipo_documento_id']);
                    });
            })
            ->when($socioNatural, function ($query) {
                $query->whereIn('vehiculo_id', $this->vehiculo_id)
                    ->whereIn('status', $this->print)
                    ->whereBetween('created_at', [$this->dateStart, $this->dateLast])
                    ->whereBetween('revalidacion', [$this->dateStartVigencia, $this->dateLastVigencia])
                    ->whereHas('socio', function($query) {
                        $query->where('tipo_documento_id', '!=', 3)->select(['id', 'tipo_documento_id']);
                    });
            })
            ->when($socioJuridica, function ($query) {
                $query->whereIn('vehiculo_id', $this->vehiculo_id)
                    ->whereIn('status', $this->print)
                    ->whereBetween('created_at', [$this->dateStart, $this->dateLast])
                    ->whereBetween('revalidacion', [$this->dateStartVigencia, $this->dateLastVigencia]);
            })
            ->when($naturalJuridica, function ($query)  {
                $query->whereIn('vehiculo_id', $this->vehiculo_id)
                    ->whereIn('status', $this->print)
                    ->whereBetween('created_at', [$this->dateStart, $this->dateLast])
                    ->whereBetween('revalidacion', [$this->dateStartVigencia, $this->dateLastVigencia])
                    ->whereHas('socio', function($query) {
                        $query->whereNull('asociacione_id')->select(['id', 'asociacione_id']);
                    });
            })
            ->when($todos, function ($query)  {
                $query->whereIn('vehiculo_id', $this->vehiculo_id)
                    ->whereIn('status', $this->print)
                    ->whereBetween('created_at', [$this->dateStart, $this->dateLast])
                    ->whereBetween('revalidacion', [$this->dateStartVigencia, $this->dateLastVigencia]);
            })
            ->get(['id', 'url', 'num_placa', 'revalidacion', 'socio_id', 'status', 'vehiculo_id', 'created_at']);

            $area = Area::first();

            $isModelo = $this->isFotocheck;

            return view('admin.template.filtros.sociosExcelInfo', compact('datas', 'area', 'isModelo'));
        
            // return view('admin.template.filtros.socioSearch', compact('datas'));
            // $pdf = PDF::loadView('admin.template.filtros.sociosPdfInfo', compact('datas', 'area', 'isModelo'));

            // $pdf->setPaper('a4', 'landscape');
    
            // return $pdf->stream();

        } elseif($this->isTarjeta) {
            // dd(request()->socio);
            if ($this->isTarjeta && request()->socio) {
                $socio = true;
            }
    
            if ($this->isTarjeta && request()->natural) {
                $natural = true;
            }
    
            if ($this->isTarjeta && request()->juridica) {
                $juridica = true;
            }
    
            if ($this->isTarjeta && request()->socio && request()->natural) {
                $socioNatural = true;
                $socio = false;
                $natural = false;
                $juridica = false;
            }
    
            if ($this->isTarjeta && request()->socio && request()->juridica) {
                $socioJuridica = true;
                $socio = false;
                $natural = false;
                $juridica = false;
            }
    
            if ($this->isTarjeta && request()->natural && request()->juridica) {
                $naturalJuridica = true;
                $socioJuridica = false;
                $socioNatural = false;
                $natural = false;
                $juridica = false;
                $socio = false;
            }

            if ($this->isTarjeta && request()->socio && request()->natural && request()->juridica) {
                $todos = true;
                $naturalJuridica = false;
                $socioJuridica = false;
                $socioNatural = false;
                $natural = false;
                $juridica = false;
                $socio = false;
            }
            
            $datas = Tarjeta::when($socio, function ($query) {
                $query->whereIn('vehiculo_id', $this->vehiculo_id)
                    ->whereIn('status', $this->print)
                    ->whereBetween('created_at', [$this->dateStart, $this->dateLast])
                    ->whereBetween('revalidacion', [$this->dateStartVigencia, $this->dateLastVigencia])
                    ->whereHas('socio', function($query) {
                        $query->whereNotNull('asociacione_id')->select(['id', 'asociacione_id']);
                    });
            })
            ->when($natural, function ($query) {
                $query->whereIn('vehiculo_id', $this->vehiculo_id)
                    ->whereIn('status', $this->print)
                    ->whereBetween('created_at', [$this->dateStart, $this->dateLast])
                    ->whereBetween('revalidacion', [$this->dateStartVigencia, $this->dateLastVigencia])
                    ->whereHas('socio', function($query) {
                        $query->whereNull('asociacione_id')
                            ->where('tipo_documento_id', '!=', 3)
                            ->select(['id', 'asociacione_id', 'tipo_documento_id']);
                    });
            })
            ->when($juridica, function ($query) {
                $query->whereIn('vehiculo_id', $this->vehiculo_id)
                    ->whereIn('status', $this->print)
                    ->whereBetween('created_at', [$this->dateStart, $this->dateLast])
                    ->whereBetween('revalidacion', [$this->dateStartVigencia, $this->dateLastVigencia])
                    ->whereHas('socio', function($query) {
                        $query->whereNull('asociacione_id')
                            ->where('tipo_documento_id', 3)
                            ->select(['id', 'asociacione_id', 'tipo_documento_id']);
                    });
            })
            ->when($socioNatural, function ($query) {
                $query->whereIn('vehiculo_id', $this->vehiculo_id)
                    ->whereIn('status', $this->print)
                    ->whereBetween('created_at', [$this->dateStart, $this->dateLast])
                    ->whereBetween('revalidacion', [$this->dateStartVigencia, $this->dateLastVigencia])
                    ->whereHas('socio', function($query) {
                        $query->where('tipo_documento_id', '!=', 3)->select(['id', 'tipo_documento_id']);
                    });
            })
            ->when($socioJuridica, function ($query) {
                $query->whereIn('vehiculo_id', $this->vehiculo_id)
                    ->whereIn('status', $this->print)
                    ->whereBetween('created_at', [$this->dateStart, $this->dateLast])
                    ->whereBetween('revalidacion', [$this->dateStartVigencia, $this->dateLastVigencia]);
            })
            ->when($naturalJuridica, function ($query)  {
                $query->whereIn('vehiculo_id', $this->vehiculo_id)
                    ->whereIn('status', $this->print)
                    ->whereBetween('created_at', [$this->dateStart, $this->dateLast])
                    ->whereBetween('revalidacion', [$this->dateStartVigencia, $this->dateLastVigencia])
                    ->whereHas('socio', function($query) {
                        $query->whereNull('asociacione_id')->select(['id', 'asociacione_id']);
                    });
            })
            ->when($todos, function ($query)  {
                $query->whereIn('vehiculo_id', $this->vehiculo_id)
                    ->whereIn('status', $this->print)
                    ->whereBetween('created_at', [$this->dateStart, $this->dateLast])
                    ->whereBetween('revalidacion', [$this->dateStartVigencia, $this->dateLastVigencia]);
            })
            ->get(['id', 'url', 'num_placa', 'revalidacion', 'socio_id', 'status', 'vehiculo_id', 'created_at']);
        }
        $area = Area::first();

        $isModelo = $this->isTarjeta;

        return view('admin.template.filtros.sociosExcelInfo', compact('datas', 'area', 'isModelo'));
    }
}
