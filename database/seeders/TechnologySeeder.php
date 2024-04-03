<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $my_stacks = [
            [
                'name' => 'laravel',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/9/9a/Laravel.svg'
            ],
            [
                'name' => 'vue',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/9/95/Vue.js_Logo_2.svg'
            ],
            [
                'name' => 'Javascript Plain',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/6/6a/JavaScript-logo.png'
            ],
            [
                'name' => 'Tailwind',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/d/d5/Tailwind_CSS_Logo.svg'
            ],
            [
                'name' => 'Bootstrap',
                'logo_url' => 'https://upload.wikimedia.org/wikipedia/commons/b/b2/Bootstrap_logo.svg'
            ],
            [
                'name' => 'Phaser 3',
                'logo_url' => 'https://en.wikipedia.org/wiki/Phaser_%28game_framework%29#/media/File:Phaser_Logo.png'
            ],
        ];

        foreach ($my_stacks as $element) {
            Technology::create([
                'name' => $element['name'],
                'logo_url' => $element['logo_url'],
            ]);
        }
    }
}
