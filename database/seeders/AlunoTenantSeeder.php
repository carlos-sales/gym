<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Stancl\Tenancy\Facades\Tenancy;
use App\Models\Tenant;
use Faker\Factory as Faker;

class AlunoTenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('pt_BR');

        $tenants = [
            'academia1',
            'academia2',
        ];

        foreach($tenants as $tenantId)
        {
            $tenant = Tenant::find($tenantId);

            if(!$tenant)
            {
                echo "Tenant $tenantId não encontrado! Skipping...\n";
                continue;
            }

            Tenancy::initialize($tenant);

            for ($i = 0; $i < 15; $i++)
            {
                $sexo = $faker->randomElement(['M', 'F']);

                DB::table('alunos')->insert([
                    'nome'            => $faker->name($sexo === 'M' ? 'male' : 'female'),
                    'sexo'            => $sexo,
                    'email'           => $faker->unique()->safeEmail(),
                    'telefone'        => $faker->cellphoneNumber(),
                    'data_nascimento' => $faker->date('Y-m-d', '-15 years'),
                    'created_at'      => now(),
                    'updated_at'      => now(),
                ]);
            }

            Tenancy::end();
        }
    }
}
