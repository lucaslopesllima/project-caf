<?php

namespace App\Http\Controllers;

use App\Models\Pergunta;
use Illuminate\Http\Request;

class PerguntaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perguntas = Pergunta::all();
        return view('perguntas.index', compact('perguntas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('perguntas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'text' => 'required|max:255',
        ]);

        Pergunta::create($request->all());
        
        return redirect()->route('perguntas.index')
            ->with('success', 'Pergunta criada com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pergunta $pergunta)
    {
        return view('perguntas.show', compact('pergunta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pergunta $pergunta)
    {
        return view('perguntas.edit', compact('pergunta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pergunta $pergunta)
    {
        $request->validate([
            'texto' => 'required|max:255',
        ]);

        $pergunta->update($request->all());
        
        return redirect()->route('perguntas.index')
            ->with('success', 'Pergunta atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pergunta $pergunta)
    {
        $pergunta->delete();
        
        return redirect()->route('perguntas.index')
            ->with('success', 'Pergunta excluída com sucesso.');
    }
}
