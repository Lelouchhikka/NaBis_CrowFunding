<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Type::create(['name' => 'Technology']);
        Type::create(['name' => 'Art']);
        Type::create(['name' => 'Film']);
        // Add more types as needed

    }
}
