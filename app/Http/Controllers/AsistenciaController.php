<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Miembro;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;

class AsistenciaController extends Controller
{
    public function index()
    {
        $asistencias = Asistencia::paginate();

        return view('asistencia.index', compact('asistencias'))
            ->with('i', (request()->input('page', 1) - 1) * $asistencias->perPage());
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function create()
    {
        $asistencia = new Asistencia();
        $miembros = Miembro::pluck('nombre_apellido', 'id');
        return view('asistencia.create', compact('asistencia', 'miembros'));
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function store(Request $request)
    {
        request()->validate(Asistencia::$rules);

        $asistencia = Asistencia::create($request->all());

        return redirect()->route('asistencias.index')->with('mensaje', 'Asistencia añadida correctamente.');
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function show($id)
    {
        $asistencia = Asistencia::find($id);

        return view('asistencia.show', compact('asistencia'));
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function edit($id)
    {
        $asistencia = Asistencia::find($id);
        $miembros = Miembro::pluck('nombre_apellido', 'id');
        return view('asistencia.edit', compact('asistencia', 'miembros'));
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function update(Request $request, Asistencia $asistencia)
    {
        request()->validate(Asistencia::$rules);

        $asistencia->update($request->all());

        return redirect()->route('asistencias.index')->with('mensaje', 'Asistencia actualizada correctamente');
    }

/* ---------------------------------------------------------------------------------------------------------------- */

    public function destroy($id)
    {
        $asistencia = Asistencia::find($id)->delete();
        $miembro = Miembro::find($id);
        return redirect()->route('asistencias.index')->with('mensaje', 'Asistencia eliminada correctamente');
    }
}
