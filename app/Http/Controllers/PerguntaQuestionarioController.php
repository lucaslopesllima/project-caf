<?php

namespace App\Http\Controllers;

use App\Models\PerguntaQuestionario;
use Illuminate\Http\Request;

class PerguntaQuestionarioController extends Controller
{
    
    public function store(Request $request)
    {
        $request->validate([
            'questionario_id' => 'required|exists:questionarios,id',
            'pergunta_id' => 'required|exists:perguntas,id'
        ]);

    
        $relacao = PerguntaQuestionario::create([
            'questionario_id' => $request->questionario_id,
            'pergunta_id' => $request->pergunta_id
        ]);

        return response()->json([
            'message' => 'Pergunta Adicionada',
            'data' => $relacao
        ], 201);
    }

   
    public function destroy(Request $request)
    {
        try {

            $relacao = PerguntaQuestionario::where('id', $request->id)->first();
            
            $relacao->delete();
            
            return response()->json([
                'message' => 'Pergunta removida do questionário com sucesso'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Erro ao remover a pergunta do questionário'
            ], 500);
        }
    }
}
