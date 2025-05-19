<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use Illuminate\Http\Request;

class PessoaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filters = $request->all();

        $tipo = $request->query('tipo');

        $query = Pessoa::orderBy('id','desc');

        if($tipo=='voluntario'){
            $query->where('is_volunteer','=',1);
        }

        if(isset($filters["namePerson"])){
            $query->where('nome','like','%'.$filters["namePerson"].'%');
        } 

        if(isset($filters["cpfPerson"])){

            $query->where('cpf','=',removeMask($filters["cpfPerson"]));   
        }
        

        $people = $query->paginate(10);
                        
        return view('people.index', ['people'=>$people,'is_volunteer' => $tipo]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        
        return view('people.create',
            [
                'is_volunteer' => $request->query('tipo')
            ]);
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
            'cpf' => 'required|min:14',
        ]);

        $cpfCleaned = preg_replace('/\D/', '', $request->cpf);

        $data = $request->all();
        $data['cpf'] = $cpfCleaned;

        Pessoa::create($data);

        return redirect()->route('pessoa.index')
            ->with('success', 'Pessoa criada com sucesso.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pessoa $pessoa)
    {
        return view('people.edit', compact('pessoa'));
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
        return redirect()->route('pessoa.index')
            ->with('success', 'Pessoa atualizada com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pessoa $pessoa)
    {
        $pessoa->delete();
        return redirect()->route('pessoa.index')
            ->with('success', 'Pessoa excluída com sucesso.');
    }


    /**
     * Display how much people there are.
     * return int
     */
    public function getQuantityNotVolunteer()
    {
        return Pessoa::where('is_volunteer', 0)->count();
    }

    /**
     * Display how much people there are.
     * return int
     */
    public function getQuantityVolunteer()
    {
        return Pessoa::where('is_volunteer', 1)->count();
    }

    public function getEachPeopleRegisteredPerMonth(){
        $countable = Pessoa::getEachPeopleRegisteredPerMonth();
        $monthMap = [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
            6 => 0,
            7 => 0,
            8 => 0,
            9 => 0,
            10 => 0,
            11 => 0,
            12 => 0
        ];

        foreach($countable as $month => $value){
            $monthMap[$month] = $value["count"];
        }
        
        return array_values($monthMap);
    }


    public function getLastRegisteredPeople(){
        return Pessoa::getLastRegisteredPeople();
    }
}
