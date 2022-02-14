<?php

namespace App\Http\Controllers\Export\Filtro;

use App\Fotocheck;
use Carbon\Carbon;
use App\Socio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tarjeta;

class ViewFiltroController extends Controller
{
    public function createSocios()
    {
        return view('admin.template.filtros.socios');
    }

    public function storeSocios(Request $request)
    {
        $validated = $request->validate([
            'vehiculo_id' => 'required',
            'print' => 'required',
        ]);

        $vehiculo_id = $request->vehiculo_id;
        $print = $request->print;
        $dateStart = $request->dateStart;
        $dateLast = $request->dateLast;
        $dateStartVigencia = $request->dateStartVigencia;
        $dateLastVigencia = $request->dateLastVigencia;

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

            dd('All');

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
            ->paginate(15, ['id', 'url', 'num_placa', 'revalidacion', 'socio_id', 'status', 'vehiculo_id', 'created_at']);
        
            return view('admin.template.filtros.socioSearch', compact('datas'));

        } elseif($request->tarjeta) {
            
            // $socio = false;
            // $natural = false;
            // $juridica = false;
            // $socioNatural = false;
            // $socioJuridica = false;
            // $naturalJuridica = false;
            // $todos = false;
            // $vigenciaTarjeta = false;
            // $vigenciaFotocheck = false;
            // $vigenciaTodos = false;
    
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
