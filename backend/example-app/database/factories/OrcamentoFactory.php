<?php

namespace Database\Factories;

use App\Models\Cliente;
use App\Models\Vendedores;
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
        $cliente = Cliente::find(rand(1,100));
        $vendedor = Vendedores::find(rand(1,10));
        return [
            'descricao' => $this->faker->text(),
            'cliente_id' => $cliente->id,
            'nameCliente' => $cliente->name,
            'vendedores_id' =>$vendedor->id,
            'nameVendedor' =>$vendedor->name,
            'valor' => $this->faker->randomNumber(5, false)
            
        ];
    }
}
