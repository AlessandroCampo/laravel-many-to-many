<?php

namespace Database\Seeders;

use App\Models\Stack;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StackSeeder extends Seeder
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
        ];

        foreach ($my_stacks as $element) {
            Stack::create([
                'name' => $element['name'],
                'logo_url' => $element['logo_url'],
            ]);
        }
    }
}
