<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Activity;
use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {

        //non vorrei mai che venisse salvato il progetto senza le relative attività, visto che sono più processi separati!
        DB::beginTransaction();

        $userId = Auth::user()->id;
        $validatedData = $request->validate([
            'project_owner_id' => [
                'required',
                function ($attribute, $value, $fail) use ($userId) {
                    if ($value != $userId) {
                        $fail("Il proprietario del progetto non corrisponde all'utente autenticato.");
                    }
                },
            ],
            'project_name' => 'required|string|max:255',
            'project_description' => 'string',
            'project_start_date' => "required|date",
            'project_end_date' => 'nullable|date|after:project_start_date',
            'project_client' => 'string|max:255',
            'project_priority' => 'required|string|in:low,medium,high',
            // ricordati che l'asterisco è la validazione per tutti gli elementi dell'array!
            // in questo caso va bene perchè sono tutti dati dello stesso tipo
            'activity_name.*' => 'required|string|max:255'
        ]);

        if ($validatedData) {
            try {
                $project = new Project();

                $project->name = $validatedData['project_name'];
                $project->description = $validatedData['project_description'];
                $project->owner_id = $validatedData['project_owner_id'];
                $project->start_date = $validatedData['project_start_date'];
                $project->end_date = $validatedData['project_end_date'];
                $project->client_name = $validatedData['project_client'];
                $project->priority = $validatedData['project_priority'];

                $project->save();

                foreach ($request->activity_name as $activityName) {
                    $newActivity = new Activity();

                    $newActivity->name = $activityName;
                    $newActivity->project_id = $project->id;
                    $newActivity->start_date = $validatedData['project_start_date'];
                    $newActivity->save();
                }

                DB::commit();

                return redirect()->route('projects.show', ['project' => $project->id])->with('success', 'New project created! Remember to assign tasks and add activities info');
            } catch (\Exception $e) {

                DB::rollBack();
                return redirect()->back()->with('error', "Si è verificato un errore durante la creazione del Progetto");
            }
        } else {

            return redirect()->back()->with('error', "Dati inseriti non validi");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        try {
            $this->authorize('view', $project);
            return view('projects.show', [
                'project' => $project,
                'users' => User::all(),
                'usersWorking' => $this->getUsersWorking($project)
            ]);
        } catch (\Exception $e) {
            if ($e instanceof AuthorizationException) {
                return redirect()->back()->with('error', "You are not allowed to view this project!");
            }
        }
    }

    private function getUsersWorking(Project $project)
    {
        $usersWorking = [];
        foreach ($project->activities as $activity) {
            foreach ($activity->users as $user) {
                $usersWorking[$user->id] = $user;
            }
        }
        return array_values($usersWorking);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        try {
            $this->authorize('update', $project);
            return view('projects.edit', ['project' => $project]);
        } catch (\Exception $e) {

            if ($e instanceof AuthorizationException) {
                return redirect()->back()->with('error', "You're not allowed to update this project!.");
            } else {

                return redirect()->back()->with('error', "Error while updating project: " . $e->getMessage());
            }
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        try {
            $this->authorize('update', $project);

            DB::beginTransaction();

            $userId = Auth::user()->id;
            $validatedData = $request->validate([
                'project_owner_id' => [
                    'required',
                    function ($attribute, $value, $fail) use ($userId) {
                        if ($value != $userId) {
                            $fail("Il proprietario del progetto non corrisponde all'utente autenticato.");
                        }
                    },
                ],
                'project_name' => 'required|string|max:255',
                'project_description' => 'string',
                'project_start_date' => "required|date",
                'project_end_date' => 'nullable|date|after:project_start_date',
                'project_client' => 'string|max:255',
                'project_priority' => 'required|string|in:low,medium,high',
            ]);


            $project->update([
                'name' => $validatedData['project_name'],
                'description' => $validatedData['project_description'],
                'start_date' => $validatedData['project_start_date'],
                'end_date' => $validatedData['project_end_date'],
                'client_name' => $validatedData['project_client'],
                'priority' => $validatedData['project_priority'],
                'owner_id' => $validatedData['project_owner_id']
            ]);


            DB::commit();

            return redirect(route('projects.show', ['project' => $project]))->with(['project' => $project, 'usersWorking' => $project->users, 'users' => User::all()])->with('success', 'Activity updated successfully.');
        } catch (\Exception $e) {

            if ($e instanceof AuthorizationException) {
                return redirect()->back()->with('error', "You're not allowed to update this project!.");
            } else {

                return redirect()->back()->with('error', "Error while updating project: " . $e->getMessage());
                // dd($e);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        try {
            $this->authorize('delete', $project);
            $project->delete();
            return redirect('dashboard')->with('success', "Project $project->name deleted successfully!");
        } catch (\Exception $e) {
            if ($e instanceof AuthorizationException) {
                return redirect()->back()->with('error', "You are not allowed to delete this project!");
            } else {
                return redirect()->back()->with('error', "An error occurred while deleting this project");
            }
        }
    }
}
