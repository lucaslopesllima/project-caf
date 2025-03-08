<?php

namespace Database\Factories;

use App\Models\Pergunta;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pergunta>
 */
class QuestionarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return  [
            'nome'=>fake()->randomElement([
                "Perfil Social e Econômico",
                "Panorama Socioeconômico",
                "Censo Familiar e Financeiro",
                "Diagnóstico Socioeconômico",
                "Mapa da Realidade Socioeconômica",
                "Indicadores de Condição Social e Econômica",
                "Análise de Situação Socioeconômica",
                "Cadastro de Perfil Socioeconômico",
                "Estudo de Condição de Vida",
                "Questionário de Inclusão e Desenvolvimento",
                'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
                'updated_at' => fake()->dateTimeBetween('-1 year', 'now'),
            ])  
           
        ];

    }
}
