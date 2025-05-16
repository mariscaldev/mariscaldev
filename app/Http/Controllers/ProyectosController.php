<?php

namespace App\Http\Controllers;

use App\Models\Proyecto;
use Illuminate\Http\Request;

class ProyectosController extends Controller
{
    public function index()
    {
        $proyectos = Proyecto::where('estado', true)->orderByDesc('fecha')->get();

        return view('main.proyectos.index', compact('proyectos'));
    }

    public function create()
    {
        return view('main.proyectos.agregar');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'imagen' => 'nullable|image',
            'img_creador' => 'nullable|image',
            'creador' => 'required|string|max:255',
            'url_proyecto' => 'nullable|url',
        ]);

        if ($request->hasFile('imagen')) {
            $validated['imagen'] = $request->file('imagen')->store('proyectos', 'public');
        }

        if ($request->hasFile('img_creador')) {
            $validated['img_creador'] = $request->file('img_creador')->store('creadores', 'public');
        }

        $validated['estado'] = true;

        Proyecto::create($validated);

        return redirect()->route('proyectos')->with('success', 'Proyecto agregado exitosamente.');
    }
}
