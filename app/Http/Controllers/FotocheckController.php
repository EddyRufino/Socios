<?php

namespace App\Http\Controllers;

use App\Fotocheck;
use Illuminate\Http\Request;

class FotocheckController extends Controller
{
    public function index()
    {
       $fotochecks = Fotocheck::latest()->paginate();

        return view('admin.fotochecks.index', compact('fotochecks'));
    }

    public function create()
    {
        return view('admin.fotochecks.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Fotocheck $fotocheck)
    {
        //
    }

    public function edit(Fotocheck $fotocheck)
    {
        //
    }

    public function update(Request $request, Fotocheck $fotocheck)
    {
        //
    }

    public function destroy(Fotocheck $fotocheck)
    {
        //
    }
}
