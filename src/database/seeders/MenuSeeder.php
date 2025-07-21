<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        Menu::create([
            'name' => 'Kebab Original',
            'description' => 'Kebab daging sapi dengan saus spesial.',
            'price' => 15000,
            'image' => 'kebab-original.jpg'
        ]);
        Menu::create([
            'name' => 'Kebab Mozarella',
            'description' => 'Kebab dengan tambahan keju mozarella meleleh.',
            'price' => 20000,
            'image' => 'kebab-mozarella.jpg'
        ]);
        Menu::create([
            'name' => 'Kebab Spesial',
            'description' => 'Kebab dengan topping lengkap dan ekstra daging.',
            'price' => 25000,
            'image' => 'kebab-spesial.jpg'
        ]);
    }
}
