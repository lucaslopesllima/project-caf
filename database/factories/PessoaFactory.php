<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pessoa>
 */
class PessoaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome' => fake()->name(),
            'idade' => fake()->numberBetween(0, 100),
            'quantidade_filhos' => fake()->numberBetween(0, 10),
            'naturalidade' => fake()->city(),
            'bairro' => fake()->streetName(),
            'escolaridade' => fake()->randomElement([
                'Fundamental Incompleto',
                'Fundamental Completo',
                'Médio Incompleto',
                'Médio Completo',
                'Superior Incompleto',
                'Superior Completo',
                'Pós-graduação'
            ]),
            'created_at' => fake()->dateTimeBetween('-1 year', 'now'),
            'updated_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
