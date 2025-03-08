<?php

namespace Database\Seeders;

use App\Models\Pergunta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerguntaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $perguntas = [
            "Qual é a sua faixa etária?",
            "Qual é o seu estado civil?",
            "Qual é a sua escolaridade?",
            "Qual é a sua ocupação atual?",
            "Qual é a sua renda familiar mensal?",
            "Quantas pessoas moram na sua residência?",
            "Você possui imóvel próprio ou mora de aluguel?",
            "Qual é o seu principal meio de transporte?",
            "Você tem acesso à internet em casa?",
            "Você possui plano de saúde privado?",
            "Quantas refeições você faz por dia?",
            "Você recebe algum tipo de benefício social?",
            "Você tem alguma deficiência ou necessidade especial?",
            "Qual é a principal fonte de renda da sua família?",
            "Você já fez algum curso técnico ou profissionalizante?",
            "Qual é a sua religião, se houver?",
            "Você tem filhos? Se sim, quantos?",
            "Qual é o tipo de moradia em que você vive?",
            "Quais são suas principais despesas mensais?",
            "Com que frequência você realiza consultas médicas?",
            "Você possui conta bancária?",
            "Você já passou por alguma situação de insegurança alimentar?",
            "Em sua casa, há acesso a água tratada?",
            "O esgoto da sua casa é ligado à rede pública?",
            "Qual é a principal fonte de energia da sua casa?",
            "Você possui computador ou notebook em casa?",
            "Algum morador da sua casa tem emprego formal?",
            "Você possui dívidas ou empréstimos em aberto?",
            "Você tem condições de economizar dinheiro mensalmente?",
            "A escola mais próxima da sua casa é pública ou privada?",
            "Você já precisou adiar ou cancelar tratamentos médicos por falta de dinheiro?",
            "A sua casa está localizada em uma área urbana ou rural?",
            "Você tem acesso a transporte público próximo da sua casa?",
            "Qual é a sua principal fonte de informação (TV, rádio, internet, jornais, etc.)?",
            "Você já teve dificuldades para pagar contas básicas, como luz e água?",
            "Você trabalha atualmente com carteira assinada?",
            "Você já enfrentou dificuldades para encontrar emprego?",
            "Você já participou de algum programa social do governo?",
            "Você tem acesso a serviços culturais e de lazer na sua comunidade?",
            "Você se sente seguro no seu bairro durante o dia e à noite?",
            "Na sua casa há acesso regular a frutas, verduras e proteínas?",
            "Você já precisou pedir ajuda financeira para amigos ou familiares?",
            "Qual é a principal dificuldade econômica que você enfrenta no momento?",
            "Os jovens da sua família têm acesso ao ensino superior?",
            "Você já teve que vender algum bem para pagar despesas básicas?",
            "Você acredita que suas condições de vida melhoraram nos últimos anos?",
            "Você tem acesso a atendimento odontológico regular?",
            "Você ou alguém da sua família já deixou de estudar por falta de dinheiro?"
        ];

        foreach ($perguntas as $pergunta) {
            Pergunta::create(['texto' => $pergunta]);
        }
    }
}
