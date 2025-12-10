<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::factory()->admin()->create();

        $this->command->info("Admin: admin@admin.com | Senha: 123456");
    }
}
