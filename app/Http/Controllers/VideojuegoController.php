<?php

namespace App\Http\Controllers;

use App\Models\Genero;
use App\Models\Videojuego;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class VideojuegoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('videojuegos.index', [
            'videojuegos' => Videojuego::with('desarrolladora')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $desarrolladoras = \App\Models\Desarrolladora::all();
        return view('videojuegos.create', compact('desarrolladoras'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'nombre' => 'required|max:255',
        'precio' => 'required|numeric|decimal:2|min:-999999.99|max:999999.99',
        'lanzamiento' => 'required|date',
        'desarrolladora_id' => 'required|exists:desarrolladoras,id',
    ]);
    Videojuego::create($validated);
    return redirect()->route('videojuegos.index');
}
    /**
     * Display the specified resource.
     */
    public function show(Videojuego $videojuego)
    {
        //$otros_generos = Genero::whereNotIn('id', $videojuego->generos->pluck('id'))->get();
        $otros_generos = Genero::whereDoesntHave('videojuegos', function(Builder $q)use($videojuego){
            $q->where('videojuegos.id', $videojuego->id);
        })->get();

        return view('videojuegos.show', ['videojuego'=>$videojuego,
                                         'otros_generos'=>$otros_generos,]);
     }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Videojuego $videojuego)
    {
        return view('videojuegos.edit', compact('videojuego'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Videojuego $videojuego)
    {
         $validated = $request->validate([
        'nombre' => 'required|max:255',
        'precio' => 'required|numeric',
        'lanzamiento' => 'nullable|date',
        'desarrolladora_id' => 'nullable|exists:desarrolladoras,id',
    ]);

    $videojuego->update($validated);

    return redirect('/videojuegos');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Videojuego $videojuego)
    {
        //
    }

    public function agregar_genero(Request $request, Videojuego $videojuego)
    {
        $genero = Genero::findOrFail($request->genero_id);
        if ($videojuego->generos()->where('id', $genero->id)->exists())
        {
            return back()->withErrors(['genero_id' => 'El videojuego ya tiene ese género.']);
        }
        $videojuego->generos()->attach($genero);
        return redirect()
            ->route('videojuegos.show', $videojuego)
            ->with('exito', 'Género agregado');
    }

    public function quitar_genero(Videojuego $videojuego, Genero $genero)
    {
        if (!$videojuego->generos()->where('id', $genero->id)->exists()) {
            return back()->withErrors(['genero_id' => 'El videojuego no tiene ese género.']);
        }
        $videojuego->generos()->detach($genero);
        return redirect()
            ->route('videojuegos.show', $videojuego)
            ->with('exito', 'Género quitado');
    }
}
