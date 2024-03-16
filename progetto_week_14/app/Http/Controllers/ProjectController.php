<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Activity;
use App\Models\Project;
use App\Models\User;
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

        $this->authorize('viewAny', Project::class);
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

                return redirect()->route('projects.show', ['project' => $project->id])->with('success', 'New project created! Remember to fill assign tasks and add info to tje activities"');
            
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
        $this->authorize('view', $project);
        $users = User::all();
        return view('projects.show', ['project' => $project, 'users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }
}
