<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Pessoa;
use App\Models\Questionario;
use App\Models\PessoaQuestionario;
use App\Models\PerguntaQuestionario;
use App\Models\Resposta;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class PessoaQuestionarioControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(\App\Models\User::factory()->create());
    }

    /** @test */
    public function can_list_all_questionnaires_answers()
    {
        // Arrange
        $pessoa = Pessoa::factory()->create();
        $questionario = Questionario::factory()->create();
        $pessoaQuestionario = PessoaQuestionario::create([
            'pessoa_id' => $pessoa->id,
            'questionario_id' => $questionario->id
        ]);

        // Act
        $response = $this->get(route('solved_questionnairies'));

        // Assert
        $response->assertStatus(200);
        $response->assertViewIs('reponseQuestionnaires.index');
        $response->assertViewHas('answers');
    }

    /** @test */
    public function can_get_all_questionnaires_answered_json()
    {
        // Arrange
        $pessoa = Pessoa::factory()->create();
        $questionario = Questionario::factory()->create();
        $pessoaQuestionario = PessoaQuestionario::create([
            'pessoa_id' => $pessoa->id,
            'questionario_id' => $questionario->id
        ]);

        // Act
        $response = $this->getJson('/api/questionnaires-answered');

        // Assert
        $response->assertStatus(200);
        $response->assertJsonStructure([
            '*' => ['id', 'pessoa_id', 'questionario_id']
        ]);
    }

    /** @test */
    public function can_store_new_questionnaire_answer()
    {
        // Arrange
        $pessoa = Pessoa::factory()->create();
        $questionario = Questionario::factory()->create();
        $data = [
            'pessoa_id' => $pessoa->id,
            'questionario_id' => $questionario->id,
            'respostas' => ['resposta1', 'resposta2']
        ];

        // Act
        $response = $this->postJson(route('pessoa-questionario.store'), $data);

        // Assert
        $response->assertStatus(201);
        $this->assertDatabaseHas('pessoa_questionarios', [
            'pessoa_id' => $pessoa->id,
            'questionario_id' => $questionario->id
        ]);
    }

    /** @test */
    public function cannot_store_questionnaire_answer_with_invalid_data()
    {
        // Act
        $response = $this->postJson(route('pessoa-questionario.store'), []);

        // Assert
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['pessoa_id', 'questionario_id', 'respostas']);
    }

    /** @test */
    public function can_get_questionnaires_by_pessoa()
    {
        // Arrange
        $pessoa = Pessoa::factory()->create();
        $questionario = Questionario::factory()->create();
        $pessoaQuestionario = PessoaQuestionario::create([
            'pessoa_id' => $pessoa->id,
            'questionario_id' => $questionario->id
        ]);

        // Act
        $response = $this->getJson("/api/pessoa/{$pessoa->id}/questionarios");

        // Assert
        $response->assertStatus(200);
        $response->assertJsonCount(1);
    }

    /** @test */
    public function can_get_pessoas_by_questionario()
    {
        // Arrange
        $pessoa = Pessoa::factory()->create();
        $questionario = Questionario::factory()->create();
        $pessoaQuestionario = PessoaQuestionario::create([
            'pessoa_id' => $pessoa->id,
            'questionario_id' => $questionario->id
        ]);

        // Act
        $response = $this->getJson("/api/questionario/{$questionario->id}/pessoas");

        // Assert
        $response->assertStatus(200);
        $response->assertJsonCount(1);
    }

    /** @test */
    public function can_delete_questionnaire_answer()
    {
        // Arrange
        $pessoa = Pessoa::factory()->create();
        $questionario = Questionario::factory()->create();
        $pessoaQuestionario = PessoaQuestionario::create([
            'pessoa_id' => $pessoa->id,
            'questionario_id' => $questionario->id
        ]);

        // Act
        $response = $this->delete(route('pessoa-questionario.destroy', $pessoaQuestionario->id));

        // Assert
        $response->assertRedirect(route('solved_questionnairies'));
        $this->assertDatabaseMissing('pessoa_questionarios', ['id' => $pessoaQuestionario->id]);
    }

    /** @test */
    public function can_get_answers_data_for_modal()
    {
        // Arrange
        $pessoa = Pessoa::factory()->create();
        $questionario = Questionario::factory()->create();
        $pessoaQuestionario = PessoaQuestionario::create([
            'pessoa_id' => $pessoa->id,
            'questionario_id' => $questionario->id
        ]);

        // Criar algumas perguntas e respostas
        $pergunta = \App\Models\Pergunta::factory()->create();
        PerguntaQuestionario::create([
            'questionario_id' => $questionario->id,
            'pergunta_id' => $pergunta->id
        ]);

        Resposta::create([
            'pessoa_id' => $pessoa->id,
            'pergunta_id' => $pergunta->id,
            'questionario_id' => $questionario->id,
            'texto' => 'Resposta teste'
        ]);

        // Act
        $response = $this->getJson(route('pessoa-questionario.answers-data', ['id' => $pessoaQuestionario->id]));

        // Assert
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'pessoa' => ['nome'],
            'questionario' => ['nome'],
            'questoes_respostas' => [
                '*' => ['pergunta', 'resposta']
            ]
        ]);
    }

    /** @test */
    public function can_update_questionnaire_answers()
    {
        // Arrange
        $pessoa = Pessoa::factory()->create();
        $questionario = Questionario::factory()->create();
        $pessoaQuestionario = PessoaQuestionario::create([
            'pessoa_id' => $pessoa->id,
            'questionario_id' => $questionario->id
        ]);

        $pergunta = \App\Models\Pergunta::factory()->create();
        PerguntaQuestionario::create([
            'questionario_id' => $questionario->id,
            'pergunta_id' => $pergunta->id
        ]);

        $data = [
            'respostas' => [
                $pergunta->id => 'Nova resposta'
            ]
        ];

        // Act
        $response = $this->put(route('pessoa-questionario.update', $pessoaQuestionario->id), $data);

        // Assert
        $response->assertRedirect(route('solved_questionnairies'));
        $this->assertDatabaseHas('respostas', [
            'pessoa_id' => $pessoa->id,
            'questionario_id' => $questionario->id,
            'pergunta_id' => $pergunta->id,
            'texto' => 'Nova resposta'
        ]);
    }
} 