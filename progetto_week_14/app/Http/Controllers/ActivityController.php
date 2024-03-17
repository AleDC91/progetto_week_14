<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Models\Activity;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;

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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreActivityRequest $request)
    {
        //
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
        return 'ciao';
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateActivityRequest $request, Activity $activity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity)
    {
        // if (!$this->authorize('delete', $activity)) {
        //     return redirect()->back()->with('error', "You are not allowed to delete this activity!");
        // }
    
        try {
            $this->authorize('delete', $activity);
            $activity->delete();
            return redirect()->back()->with('success', "Activity deleted successfully!");
        } catch (\Exception $e) {
            if($e instanceof AuthorizationException){
            return redirect()->back()->with('error', "You're not allowed to delete this project!.");
            }
            return redirect()->back()->with('error', "Error while deleting Activity.");
        }
    }
}
