<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::with('responsible');

        if ($request->has('nameProject') && !empty($request->nameProject)) {
            $query->where('name', 'like', '%' . $request->nameProject . '%');
        }

        if ($request->has('dateStarted') && !empty($request->dateStarted)) {
            $query->whereDate('date_started', '=', $request->dateStarted);
        }

        $projects = $query->paginate(10);

        return view('project.index', compact('projects'));
    }

    public function create()
    {
        return view('project.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'date_started' => 'required|date',
            'date_finished' => 'nullable|date|after_or_equal:date_started',
            'description' => 'nullable|string',
            'responsible_id' => 'required|integer',
            'responsible_type' => 'required|in:App\\Models\\User,App\\Models\\Person',
            'is_activated' => 'boolean',
            'people' => 'nullable|array',
            'users' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $responsibleType = $request->responsible_type;
        $responsibleId = $request->responsible_id;
        $responsible = $responsibleType::find($responsibleId);

        if (!$responsible) {
            return response()->json(['error' => 'Responsible not found'], 404);
        }

        $project = Project::create($request->all());

        if ($request->has('people') && is_array($request->people)) {
            foreach ($request->people as $personData) {
                $isVolunteer = $personData['is_volunteer'] ?? false;
                $project->people()->attach($personData['id'], ['is_volunteer' => $isVolunteer]);
            }
        }

        if ($request->has('users') && is_array($request->users)) {
            $project->users()->attach($request->users);
        }

        if ($responsibleType === 'App\\Models\\Person') {
            $project->people()->syncWithoutDetaching([
                $responsibleId => ['is_volunteer' => 1]
            ]);
        }

        return redirect()->route('project.index')->with('success', 'Project created successfully');
    }

    public function show(Project $project)
    {
        return view('project.show', compact('project'));
    }

    public function edit(Project $project)
    {
        return view('project.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|max:255',
            'date_started' => 'date',
            'date_finished' => 'nullable|date|after_or_equal:date_started',
            'description' => 'nullable|string',
            'responsible_id' => 'integer',
            'responsible_type' => 'in:App\\Models\\User,App\\Models\\Person',
            'is_activated' => 'boolean',
            'people' => 'nullable|array',
            'users' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Check if responsible exists if being updated
        if ($request->has('responsible_id') && $request->has('responsible_type')) {
            $responsibleType = $request->responsible_type;
            $responsibleId = $request->responsible_id;
            $responsible = $responsibleType::find($responsibleId);

            if (!$responsible) {
                return response()->json(['error' => 'Responsible not found'], 404);
            }
        }

        // Update project
        $project->update($request->all());

        // Update people if provided
        if ($request->has('people') && is_array($request->people)) {
            $peopleSync = [];
            foreach ($request->people as $personData) {
                $peopleSync[$personData['id']] = ['is_volunteer' => $personData['is_volunteer'] ?? false];
            }
            $project->people()->sync($peopleSync);
        }

        // Update users if provided
        if ($request->has('users') && is_array($request->users)) {
            $project->users()->sync($request->users);
        }

        // If responsible is a Person, mark as volunteer in the pivot table
        if ($request->has('responsible_type') && $request->responsible_type === 'App\\Models\\Person') {
            $project->people()->syncWithoutDetaching([
                $request->responsible_id => ['is_volunteer' => 1]
            ]);
        }

        return redirect()->route('project.index')->with('success', 'Project updated successfully');
    }

    public function destroy(Project $project)
    {
        $project->people()->detach();
        $project->users()->detach();
        $project->delete();

        return redirect()->route('project.index')->with('success', 'Project deleted successfully');
    }

    public function active()
    {
        $projects = Project::active()->with('responsible')->get();
        return view('project.active', compact('projects'));
    }

    public function volunteers(Project $project)
    {
        return view('project.volunteers', ['volunteers' => $project->volunteers]);
    }

    public function toggleActivation(Project $project)
    {
        $project->is_activated = !$project->is_activated;
        $project->save();

        return redirect()->back()->with('success', 'Project status updated successfully');
    }
}