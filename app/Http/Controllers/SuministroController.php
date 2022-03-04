<?php

namespace App\Http\Controllers;

use App\Suministro;
use Illuminate\Http\Request;
use App\Http\Requests\SuministroRequest;

class SuministroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $suministroQuery = Suministro::query();
        $suministros = $suministroQuery->latest()->paginate();
        $countCinta = $suministroQuery->get('conteo_monto_cinta');
        $countCinta = $suministroQuery->get('conteo_monto_holograma');

        $cinta = $countCinta[0]->conteo_monto_cinta / 300;
        $holograma = $countCinta[0]->conteo_monto_holograma / 300;

        // dd();

        return view('admin.template.suministros.index', compact('suministros', 'cinta', 'holograma'));
    }

    public function create()
    {
        return view('admin.template.suministros.create', [
            'suministro' => new Suministro
        ]);
    }

    public function store(SuministroRequest $request)
    {
        // $data = array_merge($request->validated(), [
        //     'conteo_monto_pvc' => $request->monto_pvc,
        //     'conteo_monto_cinta' => $request->monto_cinta,
        //     'conteo_monto_holograma' => $request->monto_holograma
        // ]);

        $socio = Suministro::create($request->validated());

        return redirect()->route('suministros.index')->with('status', $socio->nombre . ' fue registrado!');
    }

    public function show(Suministro $suministro)
    {
        //
    }

    public function edit(Suministro $suministro)
    {
        return view('admin.template.suministros.edit', [
            'suministro' => $suministro
        ]);
    }

    public function update(SuministroRequest $request, Suministro $suministro)
    {
        $suministro->update($request->validated());

        return redirect()->route('suministros.index')->with('status', $suministro->nombre . ' fue Editado!');
    }

    public function destroy(Suministro $suministro)
    {
        //
    }
}
