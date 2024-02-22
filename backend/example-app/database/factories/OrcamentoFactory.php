<?php

namespace Database\Factories;

use Faker\Core\Number;
use Faker\Guesser\Name;
use Illuminate\Database\Eloquent\Factories\Factory;

use function Laravel\Prompts\text;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Models\Orcamento>
 */
class OrcamentoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'descricao' => $this->faker->text(),
            'cliente_id' => $this->faker->randomNumber(2,false),
            'vendedores_id' =>$this->faker->randomNumber(1, false),
            'valor' => $this->faker->randomNumber(5, false)
            
        ];
    }
}
