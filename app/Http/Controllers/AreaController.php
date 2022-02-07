<?php

namespace App\Http\Controllers;

use App\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $areas = Area::all();

        return view('admin.template.areas.index', compact('areas'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Area $area)
    {
        //
    }

    public function edit(Area $area)
    {
        return view('admin.template.areas.edit', compact('area'));
    }

    public function update(Request $request, Area $area)
    {
        $this->validate($request, [
            'title' => 'required|min:6|max:26',
            'sub_title' => 'max:26',
        ]);

        $area->update($request->all());

        return redirect()->route('areas.index')->with('status', 'Fue modificado!');
    }

    public function destroy(Area $area)
    {
        //
    }
}
