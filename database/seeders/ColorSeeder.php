<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Color::create(['hex' => '#1abc9c']);
        Color::create(['hex' => '#16a085']);
        Color::create(['hex' => '#f1c40f']);
        Color::create(['hex' => '#f39c12']);
        Color::create(['hex' => '#2ecc71']);
        Color::create(['hex' => '#27ae60']);
        Color::create(['hex' => '#e67e22']);
        Color::create(['hex' => '#d35400']);
        Color::create(['hex' => '#3498db']);
        Color::create(['hex' => '#2980b9']);
        Color::create(['hex' => '#e74c3c']);
        Color::create(['hex' => '#c0392b']);
        Color::create(['hex' => '#9b59b6']);
        Color::create(['hex' => '#8e44ad']);
        Color::create(['hex' => '#ecf0f1']);
        Color::create(['hex' => '#bdc3c7']);
        Color::create(['hex' => '#34495e']);
        Color::create(['hex' => '#2c3e50']);
        Color::create(['hex' => '#95a5a6']);
        Color::create(['hex' => '#7f8c8d']);
    }
}
