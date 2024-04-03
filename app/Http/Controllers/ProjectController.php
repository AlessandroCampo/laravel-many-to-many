<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Project;
use App\Models\Stack;
use App\Models\Technology;

class ProjectController extends Controller
{
    public function index()
    {
    }

    public function create()
    {
        $technologies = Technology::all();
        $stacks = Stack::all();
        return view('projects.create', compact('stacks', 'technologies'));
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate(
            [
                'title' =>  'required|unique:projects|max:100',
                'description' => 'max:8192',
                'thumb' => 'max:250|active_url|nullable',
                'technologies' => 'nullable|array',

            ]
        );
        $project = Project::create([
            'title' => $validated_data['title'],
            'description' => $validated_data['description'],
            'thumb' => $validated_data['thumb'],
        ]);
        if ($request->has('technologies')) {
            $technologies = $request->input('technologies');
            $project->technologies()->attach($technologies);
        }
        return redirect()->route('dashboard');
    }

    public function show(Project $project)
    {

        $technologies = $project->technologies()->get();


        return view('projects.show', compact('project', 'technologies'));
    }


    public function edit(Project $project)
    {
        // $stacks = Stack::all();
        $technologies = Technology::all();
        $project_technologies = $project->technologies()->get();
        return view('projects.edit', compact('project', 'technologies', 'project_technologies'));
    }

    public function update(Request $request, Project $project)
    {
        $validated_data = $request->validate(
            [
                'title' =>  ['required', 'max:100', Rule::unique('projects')->ignore($project->id)],
                'description' => 'max:8192',
                'thumb' => 'max:250|active_url|nullable'
            ]
        );
        $project->update($validated_data);
        if ($request->has('technologies')) {
            $technologies = $request->input('technologies');
            $project->technologies()->sync($technologies);
        }
        return redirect()->route('projects.show', $project);
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('dashboard');
    }
}
