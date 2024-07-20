<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'ar'            => [
                'name'          => 'ملابس'
            ],
            'en'            => [
                'name'          => 'Clothes'
            ],
            'slug'              => 'ملابس-clothes-category',
            'icon'              => 'bi bi-airplane',
        ]);
    }
}
