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
        $questions = Pergunta::orderBy('id', 'desc')->paginate(env('PER_PAGE'));
        return view('question.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('question.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'texto' => 'required|max:255',
        ]);

        Pergunta::create($request->all());
        
        return redirect()->route('pergunta.index')
            ->with('success', 'Pergunta criada com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pergunta $pergunta)
    {
        return view('question.show', compact('pergunta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pergunta $perguntum)
    {
        return view('question.edit', compact('perguntum'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pergunta $perguntum)
    {
        $request->validate([
            'texto' => 'required|max:255',
        ]);

        $perguntum->update($request->all());
        
        return redirect()->route('pergunta.index')
            ->with('success', 'Pergunta atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pergunta $perguntum)
    {
        $perguntum->delete();
        
        return redirect()->route('pergunta.index')
            ->with('success', 'Pergunta excluída com sucesso.');
    }
}
