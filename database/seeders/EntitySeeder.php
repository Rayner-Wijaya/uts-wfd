<?php

namespace Database\Seeders;

use App\Models\Entity;
use Illuminate\Database\Seeder;

class EntitySeeder extends Seeder
{
    public function run(): void
    {
        Entity::create(['name' => 'Penerbangan']);
        Entity::create(['name' => 'Pemesanan Hotel']);
        Entity::create(['name' => 'Pendaftaran Kursus']);
        
    }
}
