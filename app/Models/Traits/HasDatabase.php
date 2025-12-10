<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\DB;

trait HasDatabase
{
    public function createDatabase()
    {
        $dbName = $this->database;
        DB::statement("CREATE DATABASE `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    }

    public function runMigrations()
    {
        $db = $this->database;

        config(['database.connections.tenant.database' => $db]);

        \Artisan::call('migrate', [
            '--path' => 'database/migrations/tenant',
            '--database' => 'tenant',
            '--force' => true,
        ]);
    }
}
