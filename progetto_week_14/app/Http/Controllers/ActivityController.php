<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Models\Activity;
use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
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
    public function create(Project $project)
    {

        try {

            $this->authorize('create', [Activity::class, $project]);

            return view('activities.create', ['project' => $project, 'users' => User::all()]);
        } catch (\Exception $e) {
            if ($e instanceof AuthorizationException) {
                return redirect()->back()->with('error', "You're not allowed to create activities!");
            } else {
                return redirect()->back()->with('error', "Error while creating Activity: " . $e->getMessage());
                // dd($e);
            }
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreActivityRequest $request, Project $project)
    {
        try {

            $this->authorize('create', [Activity::class, $project]);
            DB::beginTransaction();

            $validatedData = $request->validate([

                'activity_name' => 'required|string|max:255',
                'activity_description' => 'string',
                'activity_start_date' => "required|date",
                'activity_end_date' => 'nullable|date|after:project_start_date',
                'activity_priority' => 'required|string|in:low,medium,high',
                'activity_hours' => 'integer',
                'activity_status' => 'required|string|in:pending,in_progress,completed',
                'selected-users-data' => 'string',
                'selected-users-data.*.id' => 'string',
                'selected-users-data.*.name' => 'string',
            ]);

            $activity = new Activity();
            $activity->name = $validatedData['activity_name'];
            $activity->description = $validatedData['activity_description'];
            $activity->start_date = $validatedData['activity_start_date'];
            $activity->end_date = $validatedData['activity_end_date'];
            $activity->priority = $validatedData['activity_priority'];
            $activity->estimated_hours = $validatedData['activity_hours'];
            $activity->status = $validatedData['activity_status'];
            $activity->project_id = $project->id;

            $activity->save();

            $selectedUsersData = json_decode($validatedData['selected-users-data'], true);
            $userIds = array_column($selectedUsersData, 'id');
            $activity->users()->sync($userIds);
            DB::commit();

            return redirect(route('projects.show', ['project' => $activity->project]))->with(['project' => $activity->project, 'usersWorking' => $activity->users, 'users' => User::all()])->with('success', 'New activity added successfully.');
        
        } catch (\Exception $e) {

            if ($e instanceof AuthorizationException) {
                return redirect()->back()->with('error', "You're not allowed to create activities!");
           
            } else {
                return redirect()->back()->with('error', "Error while creating Activity: " . $e->getMessage());
                // dd($e);
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity)
    {
        $users = User::all();
        try {
            $this->authorize('update', $activity);
            return view('activities.edit', ['activity' => $activity, 'users' => $users]);
        } catch (\Exception $e) {
            if ($e instanceof AuthorizationException) {
                return redirect()->back()->with('error', "You're not allowed to update this activity!.");
            }
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateActivityRequest $request, Activity $activity)
    {
        try {
            $this->authorize('update', $activity);

            // dd($request);
            DB::beginTransaction();

            $validatedData = $request->validate([

                'activity_name' => 'required|string|max:255',
                'activity_description' => 'string',
                'activity_start_date' => "required|date",
                'activity_end_date' => 'nullable|date|after:project_start_date',
                'activity_priority' => 'required|string|in:low,medium,high',
                'activity_hours' => 'integer',
                'activity_status' => 'required|string|in:pending,in_progress,completed',
                'selected-users-data' => 'string',
                'selected-users-data.*.id' => 'string',
                'selected-users-data.*.name' => 'string',
            ]);


            $activity->update([
                'name' => $validatedData['activity_name'],
                'description' => $validatedData['activity_description'],
                'start_date' => $validatedData['activity_start_date'],
                'end_date' => $validatedData['activity_end_date'],
                'priority' => $validatedData['activity_priority'],
                'estimated_hours' => $validatedData['activity_hours'],
                'status' => $validatedData['activity_status'],
            ]);

            // Aggiorna gli utenti assegnati all'attività

            $selectedUsersData = json_decode($validatedData['selected-users-data'], true);
            $userIds = array_column($selectedUsersData, 'id');

            $activity->users()->sync($userIds);

            DB::commit();

            return redirect(route('projects.show', ['project' => $activity->project]))->with(['project' => $activity->project, 'usersWorking' => $activity->users, 'users' => User::all()])->with('success', 'Activity updated successfully.');
        
        } catch (\Exception $e) {

            if ($e instanceof AuthorizationException) {
                return redirect()->back()->with('error', "You're not allowed to update this activity!.");
           
            } else {

                return redirect()->back()->with('error', "Error while updating Activity: " . $e->getMessage());
                // dd($e);
            }
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        try {
            $this->authorize('delete', $activity);

            $activity->delete();
            return redirect()->back()->with('success', "Activity deleted successfully!");
        
        } catch (\Exception $e) {

            if ($e instanceof AuthorizationException) {
                return redirect()->back()->with('error', "You're not allowed to delete this activity!");
            }
            
            return redirect()->back()->with('error', "Error while deleting Activity.");
        }
    }
}
