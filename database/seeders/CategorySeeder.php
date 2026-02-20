<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Category::insert([
            ['name' => 'Work', 'color' => '#FC8181'],
            ['name' => 'Personal', 'color' => '#68D391'],
            ['name' => 'Shopping', 'color' => '#F6E05E'],
            ['name' => 'Health', 'color' => '#63B3ED'],
        ]);
    }
}
