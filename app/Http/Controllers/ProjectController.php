<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Project;
use App\Models\Stack;
use App\Models\Technology;
use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;

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

    public function store(ProjectStoreRequest $request)
    {
        $project = Project::create(
            $request->only(['title', 'thumb', 'description'])
        );
        if ($request->has('technologies')) {
            $project->technologies()->sync($request->technologies);
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

    public function update(ProjectUpdateRequest $request, Project $project)
    {
        // $validated_data = $request->validated();

        $project->update($request->only(['title', 'thumb', 'description']));


        if ($request->has('technologies')) {
            $project->technologies()->sync($request->technologies);
        }

        return redirect()->route('projects.show', $project);
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('dashboard');
    }
}
