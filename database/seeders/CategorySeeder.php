<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            'catNombre' => 'Especial',
        ]);
        DB::table('categories')->insert([
            'catNombre' => 'Premium',
        ]);
        DB::table('categories')->insert([
            'catNombre' => 'De origen',
        ]);
        DB::table('categories')->insert([
            'catNombre' => 'Común',
        ]);
        DB::table('categories')->insert([
            'catNombre' => 'Otros',
        ]);
    }
}
