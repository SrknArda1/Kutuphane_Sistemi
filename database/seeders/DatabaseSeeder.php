<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Uygulama veritabanını doldur.
     */
    public function run(): void
    {
        $this->call([
            KutuphaneSeeder::class,
        ]);
    }
}
