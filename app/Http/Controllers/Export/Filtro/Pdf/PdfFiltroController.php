<?php

namespace App\Http\Controllers\Export\Filtro\Pdf;

use App\Area;
use App\Socio;
use App\Tarjeta;
use App\Fotocheck;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Exports\filtroSociosExport;
use App\Http\Controllers\Controller;

class PdfFiltroController extends Controller
{
    public function pdfFiltroSocioInfo()
    {
        // dd(request()->all());
        $validated = request()->validate([
            'vehiculo_id' => 'required',
            'print' => 'required',
        ]);

        $isTarjeta = request()->isTarjeta;
        $isFotocheck = request()->isFotocheck;

        $vehiculo_id = request()->vehiculo_id;
        $print = request()->print;
        $dateStart = request()->dateStart;
        $dateLast = request()->dateLast;
        $dateStartVigencia = request()->dateStartVigencia;
        $dateLastVigencia = request()->dateLastVigencia;

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

        // dd(request()->isTarjeta);
        if ($isTarjeta && $isFotocheck) {

            if ($isTarjeta && $isFotocheck && request()->socio) {
                $socio = true;
            }
    
            if ($isTarjeta && $isFotocheck && request()->natural) {
                $natural = true;
            }
    
            if ($isTarjeta && $isFotocheck && request()->juridica) {
                $juridica = true;
            }
    
            if ($isTarjeta && $isFotocheck && request()->socio && request()->natural) {
                $socioNatural = true;
                $socio = false;
                $natural = false;
                $juridica = false;
            }
    
            if ($isTarjeta && $isFotocheck && request()->socio && request()->juridica) {
                $socioJuridica = true;
                $socio = false;
                $natural = false;
                $juridica = false;
            }
    
            if ($isTarjeta && $isFotocheck && request()->natural && request()->juridica) {
                $naturalJuridica = true;
                $socioJuridica = false;
                $socioNatural = false;
                $natural = false;
                $juridica = false;
                $socio = false;
            }

            if ($isTarjeta && $isFotocheck && request()->socio && request()->natural && request()->juridica) {
                $todos = true;
                $naturalJuridica = false;
                $socioJuridica = false;
                $socioNatural = false;
                $natural = false;
                $juridica = false;
                $socio = false;
            }

            $datas = Socio::when($socio, function ($query) use ($vehiculo_id, $print, $dateStart, $dateLast, $dateStartVigencia, $dateLastVigencia) {
                $query
                    ->orWhereHas('tarjetas', function($query) use ($print, $vehiculo_id, $dateStartVigencia, $dateLastVigencia, $dateStart, $dateLast) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereNotNull('asociacione_id');
                            })
                            ->whereIn('status', $print)
                            ->whereIn('vehiculo_id', $vehiculo_id)
                            ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia])
                            ->whereBetween('created_at', [$dateStart, $dateLast])
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                    })
                    ->orWhereHas('fotochecks', function($query) use ($print, $vehiculo_id, $dateStartVigencia, $dateLastVigencia, $dateStart, $dateLast) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereNotNull('asociacione_id');
                            })
                            ->whereIn('status', $print)
                            ->whereIn('vehiculo_id', $vehiculo_id)
                            ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia])
                            ->whereBetween('created_at', [$dateStart, $dateLast])
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                    });
            })
            ->when($natural, function ($query) use ($vehiculo_id, $print, $dateStart, $dateLast, $dateStartVigencia, $dateLastVigencia) {
                $query
                    ->orWhereHas('tarjetas', function($query) use ($print, $vehiculo_id, $dateStartVigencia, $dateLastVigencia, $dateStart, $dateLast) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereNull('asociacione_id')
                                    ->where('tipo_persona', 2);
                            })
                            ->whereIn('status', $print)
                            ->whereIn('vehiculo_id', $vehiculo_id)
                            ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia])
                            ->whereBetween('created_at', [$dateStart, $dateLast])
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                    })
                    ->orWhereHas('fotochecks', function($query) use ($print, $vehiculo_id, $dateStartVigencia, $dateLastVigencia, $dateStart, $dateLast) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereNull('asociacione_id')
                                    ->where('tipo_persona', 2);
                            })
                            ->whereIn('status', $print)
                            ->whereIn('vehiculo_id', $vehiculo_id)
                            ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia])
                            ->whereBetween('created_at', [$dateStart, $dateLast])
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                });
            })
            ->when($juridica, function ($query) use ($vehiculo_id, $print, $dateStart, $dateLast, $dateStartVigencia, $dateLastVigencia) {
                $query
                    ->orWhereHas('tarjetas', function($query) use ($print, $vehiculo_id, $dateStartVigencia, $dateLastVigencia, $dateStart, $dateLast) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereNull('asociacione_id')
                                    ->where('tipo_persona', 3);
                            })
                            ->whereIn('status', $print)
                            ->whereIn('vehiculo_id', $vehiculo_id)
                            ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia])
                            ->whereBetween('created_at', [$dateStart, $dateLast])
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                    })
                    ->orWhereHas('fotochecks', function($query) use ($print, $vehiculo_id, $dateStartVigencia, $dateLastVigencia, $dateStart, $dateLast) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereNull('asociacione_id')
                                    ->where('tipo_persona', 3);
                            })
                            ->whereIn('status', $print)
                            ->whereIn('vehiculo_id', $vehiculo_id)
                            ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia])
                            ->whereBetween('created_at', [$dateStart, $dateLast])
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                });
            })
            ->when($socioNatural, function ($query) use ($vehiculo_id, $print, $dateStart, $dateLast, $dateStartVigencia, $dateLastVigencia) {
                $query
                    ->orWhereHas('tarjetas', function($query) use ($print, $vehiculo_id, $dateStartVigencia, $dateLastVigencia, $dateStart, $dateLast) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereIn('tipo_persona', [1,2]);
                            })
                            ->whereIn('status', $print)
                            ->whereIn('vehiculo_id', $vehiculo_id)
                            ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia])
                            ->whereBetween('created_at', [$dateStart, $dateLast])
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                    })
                    ->orWhereHas('fotochecks', function($query) use ($print, $vehiculo_id, $dateStartVigencia, $dateLastVigencia, $dateStart, $dateLast) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereIn('tipo_persona', [1,2]);
                            })
                            ->whereIn('status', $print)
                            ->whereIn('vehiculo_id', $vehiculo_id)
                            ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia])
                            ->whereBetween('created_at', [$dateStart, $dateLast])
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                });
            })
            ->when($socioJuridica, function ($query) use ($vehiculo_id, $print, $dateStart, $dateLast, $dateStartVigencia, $dateLastVigencia) {
                $query
                    ->orWhereHas('tarjetas', function($query) use ($print, $vehiculo_id, $dateStartVigencia, $dateLastVigencia, $dateStart, $dateLast) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereIn('tipo_persona', [1,3]);
                            })
                            ->whereIn('status', $print)
                            ->whereIn('vehiculo_id', $vehiculo_id)
                            ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia])
                            ->whereBetween('created_at', [$dateStart, $dateLast])
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                    })
                    ->orWhereHas('fotochecks', function($query) use ($print, $vehiculo_id, $dateStartVigencia, $dateLastVigencia, $dateStart, $dateLast) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereIn('tipo_persona', [1,3]);
                            })
                            ->whereIn('status', $print)
                            ->whereIn('vehiculo_id', $vehiculo_id)
                            ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia])
                            ->whereBetween('created_at', [$dateStart, $dateLast])
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                });
            })
            ->when($naturalJuridica, function ($query) use ($vehiculo_id, $print, $dateStart, $dateLast, $dateStartVigencia, $dateLastVigencia) {
                $query
                    ->orWhereHas('tarjetas', function($query) use ($print, $vehiculo_id, $dateStartVigencia, $dateLastVigencia, $dateStart, $dateLast) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereNull('asociacione_id')
                                    ->whereIn('tipo_persona', [2,3]);
                            })
                            ->whereIn('status', $print)
                            ->whereIn('vehiculo_id', $vehiculo_id)
                            ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia])
                            ->whereBetween('created_at', [$dateStart, $dateLast])
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                    })
                    ->orWhereHas('fotochecks', function($query) use ($print, $vehiculo_id, $dateStartVigencia, $dateLastVigencia, $dateStart, $dateLast) {
                        $query->whereHas('socio', function ($query) {
                                $query->whereNull('asociacione_id')
                                    ->whereIn('tipo_persona', [2,3]);
                            })
                            ->whereIn('status', $print)
                            ->whereIn('vehiculo_id', $vehiculo_id)
                            ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia])
                            ->whereBetween('created_at', [$dateStart, $dateLast])
                            ->select(['id', 'socio_id', 'vehiculo_id', 'revalidacion']);
                });
            })
            ->whereNull('asociacione_id')
            ->whereIn('vehiculo_id', $vehiculo_id)
            ->get(['id', 'nombre_socio', 'dni_socio', 'url', 'num_placa', 'vehiculo_id', 'asociacione_id', 'tipo_documento_id']);

            $area = Area::first();

            $isModelo = $isTarjeta;
        
            $pdf = PDF::loadView('admin.template.filtros.tarjetasFotochecksPdfInfo', compact('datas', 'area', 'isModelo'));

            $pdf->setPaper('a4', 'landscape');
    
            return $pdf->stream();
        
        } elseif($isFotocheck) {

            // dd($vehiculo_id);
    
            if ($isFotocheck && request()->socio) {
                $socio = true;
            }
    
            if ($isFotocheck && request()->natural) {
                $natural = true;
            }
    
            if ($isFotocheck && request()->juridica) {
                $juridica = true;
            }
    
            if ($isFotocheck && request()->socio && request()->natural) {
                $socioNatural = true;
                $socio = false;
                $natural = false;
                $juridica = false;
            }
    
            if ($isFotocheck && request()->socio && request()->juridica) {
                $socioJuridica = true;
                $socio = false;
                $natural = false;
                $juridica = false;
            }
    
            if ($isFotocheck && request()->natural && request()->juridica) {
                $naturalJuridica = true;
                $socioJuridica = false;
                $socioNatural = false;
                $natural = false;
                $juridica = false;
                $socio = false;
            }

            if ($isFotocheck && request()->socio && request()->natural && request()->juridica) {
                $todos = true;
                $naturalJuridica = false;
                $socioJuridica = false;
                $socioNatural = false;
                $natural = false;
                $juridica = false;
                $socio = false;
            }
            
            $datas = Fotocheck::when($socio, function ($query) use ($vehiculo_id, $print, $dateStart, $dateLast, $dateStartVigencia, $dateLastVigencia) {
                $query->whereIn('vehiculo_id', $vehiculo_id)
                    ->whereIn('status', $print)
                    ->whereBetween('created_at', [$dateStart, $dateLast])
                    ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia])
                    ->whereHas('socio', function($query) {
                        $query->whereNotNull('asociacione_id')->select(['id', 'asociacione_id']);
                    });
            })
            ->when($natural, function ($query) use ($vehiculo_id, $print, $dateStart, $dateLast, $dateStartVigencia, $dateLastVigencia) {
                $query->whereIn('vehiculo_id', $vehiculo_id)
                    ->whereIn('status', $print)
                    ->whereBetween('created_at', [$dateStart, $dateLast])
                    ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia])
                    ->whereHas('socio', function($query) {
                        $query->whereNull('asociacione_id')
                            ->where('tipo_documento_id', '!=', 3)
                            ->select(['id', 'asociacione_id', 'tipo_documento_id']);
                    });
            })
            ->when($juridica, function ($query) use ($vehiculo_id, $print, $dateStart, $dateLast, $dateStartVigencia, $dateLastVigencia) {
                $query->whereIn('vehiculo_id', $vehiculo_id)
                    ->whereIn('status', $print)
                    ->whereBetween('created_at', [$dateStart, $dateLast])
                    ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia])
                    ->whereHas('socio', function($query) {
                        $query->whereNull('asociacione_id')
                            ->where('tipo_documento_id', 3)
                            ->select(['id', 'asociacione_id', 'tipo_documento_id']);
                    });
            })
            ->when($socioNatural, function ($query) use ($vehiculo_id, $print, $dateStart, $dateLast, $dateStartVigencia, $dateLastVigencia) {
                $query->whereIn('vehiculo_id', $vehiculo_id)
                    ->whereIn('status', $print)
                    ->whereBetween('created_at', [$dateStart, $dateLast])
                    ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia])
                    ->whereHas('socio', function($query) {
                        $query->where('tipo_documento_id', '!=', 3)->select(['id', 'tipo_documento_id']);
                    });
            })
            ->when($socioJuridica, function ($query) use ($vehiculo_id, $print, $dateStart, $dateLast, $dateStartVigencia, $dateLastVigencia) {
                $query->whereIn('vehiculo_id', $vehiculo_id)
                    ->whereIn('status', $print)
                    ->whereBetween('created_at', [$dateStart, $dateLast])
                    ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia]);
            })
            ->when($naturalJuridica, function ($query) use ($vehiculo_id, $print, $dateStart, $dateLast, $dateStartVigencia, $dateLastVigencia)  {
                $query->whereIn('vehiculo_id', $vehiculo_id)
                    ->whereIn('status', $print)
                    ->whereBetween('created_at', [$dateStart, $dateLast])
                    ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia])
                    ->whereHas('socio', function($query) {
                        $query->whereNull('asociacione_id')->select(['id', 'asociacione_id']);
                    });
            })
            ->when($todos, function ($query) use ($vehiculo_id, $print, $dateStart, $dateLast, $dateStartVigencia, $dateLastVigencia)  {
                $query->whereIn('vehiculo_id', $vehiculo_id)
                    ->whereIn('status', $print)
                    ->whereBetween('created_at', [$dateStart, $dateLast])
                    ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia]);
            })
            ->get(['id', 'url', 'num_placa', 'revalidacion', 'socio_id', 'status', 'vehiculo_id', 'created_at']);

            $area = Area::first();

            $isModelo = $isFotocheck;
        
            // return view('admin.template.filtros.socioSearch', compact('datas'));
            $pdf = PDF::loadView('admin.template.filtros.sociosPdfInfo', compact('datas', 'area', 'isModelo'));

            $pdf->setPaper('a4', 'landscape');
    
            return $pdf->stream();

        } elseif($isTarjeta) {
    
            if ($isTarjeta && request()->socio) {
                $socio = true;
            }
    
            if ($isTarjeta && request()->natural) {
                $natural = true;
            }
    
            if ($isTarjeta && request()->juridica) {
                $juridica = true;
            }
    
            if ($isTarjeta && request()->socio && request()->natural) {
                $socioNatural = true;
                $socio = false;
                $natural = false;
                $juridica = false;
            }
    
            if ($isTarjeta && request()->socio && request()->juridica) {
                $socioJuridica = true;
                $socio = false;
                $natural = false;
                $juridica = false;
            }
    
            if ($isTarjeta && request()->natural && request()->juridica) {
                $naturalJuridica = true;
                $socioJuridica = false;
                $socioNatural = false;
                $natural = false;
                $juridica = false;
                $socio = false;
            }

            if ($isTarjeta && request()->socio && request()->natural && request()->juridica) {
                $todos = true;
                $naturalJuridica = false;
                $socioJuridica = false;
                $socioNatural = false;
                $natural = false;
                $juridica = false;
                $socio = false;
            }
            
            $datas = Tarjeta::when($socio, function ($query) use ($vehiculo_id, $print, $dateStart, $dateLast, $dateStartVigencia, $dateLastVigencia) {
                $query->whereIn('vehiculo_id', $vehiculo_id)
                    ->whereIn('status', $print)
                    ->whereBetween('created_at', [$dateStart, $dateLast])
                    ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia])
                    ->whereHas('socio', function($query) {
                        $query->whereNotNull('asociacione_id')->select(['id', 'asociacione_id']);
                    });
            })
            ->when($natural, function ($query) use ($vehiculo_id, $print, $dateStart, $dateLast, $dateStartVigencia, $dateLastVigencia) {
                $query->whereIn('vehiculo_id', $vehiculo_id)
                    ->whereIn('status', $print)
                    ->whereBetween('created_at', [$dateStart, $dateLast])
                    ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia])
                    ->whereHas('socio', function($query) {
                        $query->whereNull('asociacione_id')
                            ->where('tipo_documento_id', '!=', 3)
                            ->select(['id', 'asociacione_id', 'tipo_documento_id']);
                    });
            })
            ->when($juridica, function ($query) use ($vehiculo_id, $print, $dateStart, $dateLast, $dateStartVigencia, $dateLastVigencia) {
                $query->whereIn('vehiculo_id', $vehiculo_id)
                    ->whereIn('status', $print)
                    ->whereBetween('created_at', [$dateStart, $dateLast])
                    ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia])
                    ->whereHas('socio', function($query) {
                        $query->whereNull('asociacione_id')
                            ->where('tipo_documento_id', 3)
                            ->select(['id', 'asociacione_id', 'tipo_documento_id']);
                    });
            })
            ->when($socioNatural, function ($query) use ($vehiculo_id, $print, $dateStart, $dateLast, $dateStartVigencia, $dateLastVigencia) {
                $query->whereIn('vehiculo_id', $vehiculo_id)
                    ->whereIn('status', $print)
                    ->whereBetween('created_at', [$dateStart, $dateLast])
                    ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia])
                    ->whereHas('socio', function($query) {
                        $query->where('tipo_documento_id', '!=', 3)->select(['id', 'tipo_documento_id']);
                    });
            })
            ->when($socioJuridica, function ($query) use ($vehiculo_id, $print, $dateStart, $dateLast, $dateStartVigencia, $dateLastVigencia) {
                $query->whereIn('vehiculo_id', $vehiculo_id)
                    ->whereIn('status', $print)
                    ->whereBetween('created_at', [$dateStart, $dateLast])
                    ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia]);
            })
            ->when($naturalJuridica, function ($query) use ($vehiculo_id, $print, $dateStart, $dateLast, $dateStartVigencia, $dateLastVigencia)  {
                $query->whereIn('vehiculo_id', $vehiculo_id)
                    ->whereIn('status', $print)
                    ->whereBetween('created_at', [$dateStart, $dateLast])
                    ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia])
                    ->whereHas('socio', function($query) {
                        $query->whereNull('asociacione_id')->select(['id', 'asociacione_id']);
                    });
            })
            ->when($todos, function ($query) use ($vehiculo_id, $print, $dateStart, $dateLast, $dateStartVigencia, $dateLastVigencia)  {
                $query->whereIn('vehiculo_id', $vehiculo_id)
                    ->whereIn('status', $print)
                    ->whereBetween('created_at', [$dateStart, $dateLast])
                    ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia]);
            })
            ->get(['id', 'url', 'num_placa', 'revalidacion', 'socio_id', 'status', 'vehiculo_id', 'created_at']);

            $area = Area::first();

            $isModelo = $isTarjeta;
        
            // return view('admin.template.filtros.socioSearch', compact('datas'));
            $pdf = PDF::loadView('admin.template.filtros.sociosPdfInfo', compact('datas', 'area', 'isModelo'));

            $pdf->setPaper('a4', 'landscape');
    
            return $pdf->stream();
        }
        // dd(request()->all());
    }

    public function excelFiltroSocioInfo()
    {
        $validated = request()->validate([
            'vehiculo_id' => 'required',
            'print' => 'required',
        ]);

        $isTarjeta = request()->isTarjeta;
        $isFotocheck = request()->isFotocheck;

        $vehiculo_id = request()->vehiculo_id;
        $print = request()->print;
        $dateStart = request()->dateStart;
        $dateLast = request()->dateLast;
        $dateStartVigencia = request()->dateStartVigencia;
        $dateLastVigencia = request()->dateLastVigencia;

        return (new filtroSociosExport)->forDate($isTarjeta, $isFotocheck, $vehiculo_id, $print, $dateStart, $dateLast, $dateStartVigencia, $dateLastVigencia)->download('FILTRADO-DE-TARJETAS-FOTOCHECKS.xlsx');
    }

    public function pdfFiltroSocioGrafico()
    {
        $validated = request()->validate([
            'vehiculo_id' => 'required',
            'print' => 'required',
        ]);

        $isTarjeta = request()->isTarjeta;
        $isFotocheck = request()->isFotocheck;

        $vehiculo_id = request()->vehiculo_id;
        $print = request()->print;
        $dateStart = request()->dateStart;
        $dateLast = request()->dateLast;
        $dateStartVigencia = request()->dateStartVigencia;
        $dateLastVigencia = request()->dateLastVigencia;

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

        // dd(request()->isTarjeta);
        if ($isTarjeta && $isFotocheck) {

            dd('All');
        
        } elseif($isFotocheck) {

            // dd($vehiculo_id);
    
            if ($isFotocheck && request()->socio) {
                $socio = true;
            }
    
            if ($isFotocheck && request()->natural) {
                $natural = true;
            }
    
            if ($isFotocheck && request()->juridica) {
                $juridica = true;
            }
    
            if ($isFotocheck && request()->socio && request()->natural) {
                $socioNatural = true;
                $socio = false;
                $natural = false;
                $juridica = false;
            }
    
            if ($isFotocheck && request()->socio && request()->juridica) {
                $socioJuridica = true;
                $socio = false;
                $natural = false;
                $juridica = false;
            }
    
            if ($isFotocheck && request()->natural && request()->juridica) {
                $naturalJuridica = true;
                $socioJuridica = false;
                $socioNatural = false;
                $natural = false;
                $juridica = false;
                $socio = false;
            }

            if ($isFotocheck && request()->socio && request()->natural && request()->juridica) {
                $todos = true;
                $naturalJuridica = false;
                $socioJuridica = false;
                $socioNatural = false;
                $natural = false;
                $juridica = false;
                $socio = false;
            }
            
            $datas = Fotocheck::when($socio, function ($query) use ($vehiculo_id, $print, $dateStart, $dateLast, $dateStartVigencia, $dateLastVigencia) {
                $query->whereIn('vehiculo_id', $vehiculo_id)
                    ->whereIn('status', $print)
                    ->whereBetween('created_at', [$dateStart, $dateLast])
                    ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia])
                    ->whereHas('socio', function($query) {
                        $query->whereNotNull('asociacione_id')->select(['id', 'asociacione_id']);
                    });
            })
            ->when($natural, function ($query) use ($vehiculo_id, $print, $dateStart, $dateLast, $dateStartVigencia, $dateLastVigencia) {
                $query->whereIn('vehiculo_id', $vehiculo_id)
                    ->whereIn('status', $print)
                    ->whereBetween('created_at', [$dateStart, $dateLast])
                    ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia])
                    ->whereHas('socio', function($query) {
                        $query->whereNull('asociacione_id')
                            ->where('tipo_documento_id', '!=', 3)
                            ->select(['id', 'asociacione_id', 'tipo_documento_id']);
                    });
            })
            ->when($juridica, function ($query) use ($vehiculo_id, $print, $dateStart, $dateLast, $dateStartVigencia, $dateLastVigencia) {
                $query->whereIn('vehiculo_id', $vehiculo_id)
                    ->whereIn('status', $print)
                    ->whereBetween('created_at', [$dateStart, $dateLast])
                    ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia])
                    ->whereHas('socio', function($query) {
                        $query->whereNull('asociacione_id')
                            ->where('tipo_documento_id', 3)
                            ->select(['id', 'asociacione_id', 'tipo_documento_id']);
                    });
            })
            ->when($socioNatural, function ($query) use ($vehiculo_id, $print, $dateStart, $dateLast, $dateStartVigencia, $dateLastVigencia) {
                $query->whereIn('vehiculo_id', $vehiculo_id)
                    ->whereIn('status', $print)
                    ->whereBetween('created_at', [$dateStart, $dateLast])
                    ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia])
                    ->whereHas('socio', function($query) {
                        $query->where('tipo_documento_id', '!=', 3)->select(['id', 'tipo_documento_id']);
                    });
            })
            ->when($socioJuridica, function ($query) use ($vehiculo_id, $print, $dateStart, $dateLast, $dateStartVigencia, $dateLastVigencia) {
                $query->whereIn('vehiculo_id', $vehiculo_id)
                    ->whereIn('status', $print)
                    ->whereBetween('created_at', [$dateStart, $dateLast])
                    ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia]);
            })
            ->when($naturalJuridica, function ($query) use ($vehiculo_id, $print, $dateStart, $dateLast, $dateStartVigencia, $dateLastVigencia)  {
                $query->whereIn('vehiculo_id', $vehiculo_id)
                    ->whereIn('status', $print)
                    ->whereBetween('created_at', [$dateStart, $dateLast])
                    ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia])
                    ->whereHas('socio', function($query) {
                        $query->whereNull('asociacione_id')->select(['id', 'asociacione_id']);
                    });
            })
            ->when($todos, function ($query) use ($vehiculo_id, $print, $dateStart, $dateLast, $dateStartVigencia, $dateLastVigencia)  {
                $query->whereIn('vehiculo_id', $vehiculo_id)
                    ->whereIn('status', $print)
                    ->whereBetween('created_at', [$dateStart, $dateLast])
                    ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia]);
            })
            ->get(['id', 'url', 'num_placa', 'revalidacion', 'socio_id', 'status', 'vehiculo_id', 'created_at']);

            $area = Area::first();

            $isModelo = $isFotocheck;
        
            // return view('admin.template.filtros.socioSearch', compact('datas'));
            $pdf = PDF::loadView('admin.template.filtros.sociosPdfInfo', compact('datas', 'area', 'isModelo'));

            $pdf->setPaper('a4', 'landscape');
    
            return $pdf->stream();

        } elseif($isTarjeta) {
    
            if ($isTarjeta && request()->socio) {
                $socio = true;
            }
    
            if ($isTarjeta && request()->natural) {
                $natural = true;
            }
    
            if ($isTarjeta && request()->juridica) {
                $juridica = true;
            }
    
            if ($isTarjeta && request()->socio && request()->natural) {
                $socioNatural = true;
                $socio = false;
                $natural = false;
                $juridica = false;
            }
    
            if ($isTarjeta && request()->socio && request()->juridica) {
                $socioJuridica = true;
                $socio = false;
                $natural = false;
                $juridica = false;
            }
    
            if ($isTarjeta && request()->natural && request()->juridica) {
                $naturalJuridica = true;
                $socioJuridica = false;
                $socioNatural = false;
                $natural = false;
                $juridica = false;
                $socio = false;
            }

            if ($isTarjeta && request()->socio && request()->natural && request()->juridica) {
                $todos = true;
                $naturalJuridica = false;
                $socioJuridica = false;
                $socioNatural = false;
                $natural = false;
                $juridica = false;
                $socio = false;
            }
            
            $datas = Tarjeta::when($socio, function ($query) use ($vehiculo_id, $print, $dateStart, $dateLast, $dateStartVigencia, $dateLastVigencia) {
                $query->whereIn('vehiculo_id', $vehiculo_id)
                    ->whereIn('status', $print)
                    ->whereBetween('created_at', [$dateStart, $dateLast])
                    ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia])
                    ->whereHas('socio', function($query) {
                        $query->whereNotNull('asociacione_id')->select(['id', 'asociacione_id']);
                    });
            })
            ->when($natural, function ($query) use ($vehiculo_id, $print, $dateStart, $dateLast, $dateStartVigencia, $dateLastVigencia) {
                $query->whereIn('vehiculo_id', $vehiculo_id)
                    ->whereIn('status', $print)
                    ->whereBetween('created_at', [$dateStart, $dateLast])
                    ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia])
                    ->whereHas('socio', function($query) {
                        $query->whereNull('asociacione_id')
                            ->where('tipo_documento_id', '!=', 3)
                            ->select(['id', 'asociacione_id', 'tipo_documento_id']);
                    });
            })
            ->when($juridica, function ($query) use ($vehiculo_id, $print, $dateStart, $dateLast, $dateStartVigencia, $dateLastVigencia) {
                $query->whereIn('vehiculo_id', $vehiculo_id)
                    ->whereIn('status', $print)
                    ->whereBetween('created_at', [$dateStart, $dateLast])
                    ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia])
                    ->whereHas('socio', function($query) {
                        $query->whereNull('asociacione_id')
                            ->where('tipo_documento_id', 3)
                            ->select(['id', 'asociacione_id', 'tipo_documento_id']);
                    });
            })
            ->when($socioNatural, function ($query) use ($vehiculo_id, $print, $dateStart, $dateLast, $dateStartVigencia, $dateLastVigencia) {
                $query->whereIn('vehiculo_id', $vehiculo_id)
                    ->whereIn('status', $print)
                    ->whereBetween('created_at', [$dateStart, $dateLast])
                    ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia])
                    ->whereHas('socio', function($query) {
                        $query->where('tipo_documento_id', '!=', 3)->select(['id', 'tipo_documento_id']);
                    });
            })
            ->when($socioJuridica, function ($query) use ($vehiculo_id, $print, $dateStart, $dateLast, $dateStartVigencia, $dateLastVigencia) {
                $query->whereIn('vehiculo_id', $vehiculo_id)
                    ->whereIn('status', $print)
                    ->whereBetween('created_at', [$dateStart, $dateLast])
                    ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia]);
            })
            ->when($naturalJuridica, function ($query) use ($vehiculo_id, $print, $dateStart, $dateLast, $dateStartVigencia, $dateLastVigencia)  {
                $query->whereIn('vehiculo_id', $vehiculo_id)
                    ->whereIn('status', $print)
                    ->whereBetween('created_at', [$dateStart, $dateLast])
                    ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia])
                    ->whereHas('socio', function($query) {
                        $query->whereNull('asociacione_id')->select(['id', 'asociacione_id']);
                    });
            })
            ->when($todos, function ($query) use ($vehiculo_id, $print, $dateStart, $dateLast, $dateStartVigencia, $dateLastVigencia)  {
                $query->whereIn('vehiculo_id', $vehiculo_id)
                    ->whereIn('status', $print)
                    ->whereBetween('created_at', [$dateStart, $dateLast])
                    ->whereBetween('revalidacion', [$dateStartVigencia, $dateLastVigencia]);
            })
            ->get(['id', 'url', 'num_placa', 'revalidacion', 'socio_id', 'status', 'vehiculo_id', 'created_at']);
        }

        

        $area = Area::first();

        $pdf = PDF::loadView('admin.template.filtros.sociosPdfGrafi', compact('area', 'datas'));

        $pdf->setPaper('a4', 'landscape');

        return $pdf->stream();
    }
}
