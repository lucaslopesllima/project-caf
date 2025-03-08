<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pessoas = Pessoa::all();
        return view('pessoas.index', compact('pessoas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pessoas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'idade' => 'required|numeric|min:0',
            'quantidade_filhos' => 'required|numeric|min:0',
            'naturalidade' => 'required',
            'bairro' => 'required',
            'escolaridade' => 'required',
        ]);

        Pessoa::create($request->all());
        return redirect()->route('pessoas.index')
            ->with('success', 'Pessoa criada com sucesso.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pessoa $pessoa)
    {
        return view('pessoas.show', compact('pessoa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pessoa $pessoa)
    {
        return view('pessoas.edit', compact('pessoa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pessoa $pessoa)
    {
        $request->validate([
            'nome' => 'required',
            'idade' => 'required|numeric|min:0',
            'quantidade_filhos' => 'required|numeric|min:0',
            'naturalidade' => 'required',
            'bairro' => 'required',
            'escolaridade' => 'required',
        ]);

        $pessoa->update($request->all());
        return redirect()->route('pessoas.index')
            ->with('success', 'Pessoa atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pessoa $pessoa)
    {
        $pessoa->delete();
        return redirect()->route('pessoas.index')
            ->with('success', 'Pessoa excluída com sucesso.');
    }
}
