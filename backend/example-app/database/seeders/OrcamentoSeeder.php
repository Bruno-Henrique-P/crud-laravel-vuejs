<?php

namespace Database\Seeders;

use App\Models\Cliente;
use App\Models\Orcamento;
use App\Models\Vendedores;
use Carbon\Factory;
use Database\Factories\OrcamentoFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrcamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Orcamento::factory(500)->create(); 
  
    }
}
