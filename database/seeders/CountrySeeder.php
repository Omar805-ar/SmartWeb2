<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Country::create([
            'ar'            => [
                'name'  => 'مصر'
            ],
            'en'            => [
                'name'  => 'Egypt'
            ],
            'iso'           => 'EGY',
            'currency_code' => 'EGP',
            'flag'          => '<span class="fi fi-eg"></span>',
        ]);
        Country::create([
            'ar'            => [
                'name'  => 'السعودية'
            ],
            'en'            => [
                'name'  => 'Saudi Arabia'
            ],
            'iso'           => 'KSA',
            'currency_code' => 'SAR',
            'flag'          => '<span class="fi fi-sa"></span>',
        ]);
        Country::create([
            'ar'            => [
                'name'  => 'الإمارات'
            ],
            'en'            => [
                'name'  => 'United Arab Emirates'
            ],
            'iso'           => 'UAE',
            'currency_code' => 'AED',
            'flag'          => '<span class="fi fi-ae"></span>',
        ]);
    }
}
