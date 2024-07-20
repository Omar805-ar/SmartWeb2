<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Size::create(['size' => 'S']);
        Size::create(['size' => 'M']);
        Size::create(['size' => 'L']);
        Size::create(['size' => 'XL']);
        Size::create(['size' => 'XXL']);
        Size::create(['size' => 'XXXL']);
        Size::create(['size' => 'XXXXL']);
        Size::create(['size' => 'XXXXXL']);
        Size::create(['size' => 'XXXXXXL']);
    }
}
