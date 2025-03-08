<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Questionario;
use App\Models\Pessoa;

class QuestionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $questionarios = Questionario::with('pessoa')->get();
        return view('questionarios.index', compact('questionarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pessoas = Pessoa::all();
        return view('questionarios.create', compact('pessoas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pergunta' => 'required',
            'resposta' => 'required',
            'pessoa_id' => 'required|exists:pessoas,id'
        ]);

        Questionario::create($request->all());
        return redirect()->route('questionarios.index')
            ->with('success', 'Questionário criado com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Questionario $questionario)
    {
        return view('questionarios.show', compact('questionario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Questionario $questionario)
    {
        $pessoas = Pessoa::all();
        return view('questionarios.edit', compact('questionario', 'pessoas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Questionario $questionario)
    {
        $request->validate([
            'pergunta' => 'required',
            'resposta' => 'required',
            'pessoa_id' => 'required|exists:pessoas,id'
        ]);

        $questionario->update($request->all());
        return redirect()->route('questionarios.index')
            ->with('success', 'Questionário atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Questionario $questionario)
    {
        $questionario->delete();
        return redirect()->route('questionarios.index')
            ->with('success', 'Questionário excluído com sucesso.');
    }
}
