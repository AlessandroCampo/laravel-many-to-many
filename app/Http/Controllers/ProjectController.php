<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Project;
use App\Models\Stack;

class ProjectController extends Controller
{
    public function index()
    {
    }

    public function create()
    {

        $stacks = Stack::all();
        return view('projects.create', compact('stacks'));
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate(
            [
                'title' =>  'required|unique:projects|max:100',
                'stack_id' => 'nullable|integer|exists:stacks,id',
                'description' => 'max:8192',
                'thumb' => 'max:250|active_url|nullable',

            ]
        );
        Project::create($validated_data);
        return redirect()->route('dashboard');
    }

    public function show(Project $project)
    {
        // Accessing the 'stack' relationship to retrieve related stack records
        $stack = $project->stack->first();

        // Pass the $project and $stack variables to the view
        return view('projects.show', compact('project', 'stack'));
    }


    public function edit(Project $project)
    {
        $stacks = Stack::all();
        return view('projects.edit', compact('project', 'stacks'));
    }

    public function update(Request $request, Project $project)
    {
        $validated_data = $request->validate(
            [
                'title' =>  ['required', 'max:100', Rule::unique('projects')->ignore($project->id)],
                'stack_id' => 'nullable|integer|exists:stacks,id',
                'description' => 'max:8192',
                'thumb' => 'max:250|active_url|nullable'
            ]
        );
        $project->update($validated_data);
        return view('projects.show', compact('project'));
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('dashboard');
    }
}
