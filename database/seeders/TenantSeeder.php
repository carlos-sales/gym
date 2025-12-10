<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Stancl\Tenancy\Facades\Tenancy;
// use Stancl\Tenancy\Database\Models\Tenant;
use App\Models\Tenant;
use App\Models\User;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $tenants = [
            [
                'nome' => 'Academia 1',
                'database' => 'academia1',
                'email' => 'admin@academia1.com',
                'password' => '123456'
            ],
            [
                'nome' => 'Academia 2',
                'database' => 'academia2',
                'email' => 'admin@academia2.com',
                'password' => '123456'
            ],
        ];

        foreach ($tenants as $data)
        {
            $tenant = Tenant::create([
                'id' => $data['database'],
                'name' => $data['nome']
            ]);

            Tenancy::initialize($tenant);

            User::create([
                'name' => 'Administrador',
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            Tenancy::end();

            $tenant->domains()->create([
                'domain' => $data['database'] . '.localhost',
            ]);
        }
    }

}
