<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Stack;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = config('projects');

        foreach ($projects as $projectData) {
            $stack = Stack::where('name', $projectData['stack'])->first();
            Project::create([
                'title' => $projectData['title'],
                'stack_id' => $stack->id,
                'description' => $projectData['description'],
                'thumb' => $projectData['thumb'],
            ]);
        }
    }
}
