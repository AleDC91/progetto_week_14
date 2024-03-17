<?php

namespace App\Policies;

use App\Models\ActivityUser;
use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProjectPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return !is_null($user);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Project $project): bool
    {
        $isUserPartOfProject = false;
        foreach ($project->activities as $activity) {
            if (ActivityUser::where(['user_id'=> $user->id, 'activity_id'=> $activity->id])->get()->count() > 0){
                $isUserPartOfProject = true;
                break;
            }
        }
        
        if ($user->isAdmin() || $user->id === $project->owner_id || $isUserPartOfProject) {
            return true;
        } else {
            return false;
        }
        // abort(403, "you're not allowed to view this project");
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Project $project): bool
    {
        if ($user->isAdmin() || $user->id === $project->owner_id) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Project $project): bool
    {
        if ($user->id === $project->owner_id) {
            return true;
        } else {
            return false;
        }
        // abort(403, "You can modify only your Projects!");
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Project $project): bool
    {
        if ($user->id === $project->owner_id) {
            return true;
        } else {
            return false;
        }
        // abort(403, "You can delete only your Projects!");
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Project $project): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Project $project): bool
    {
        //
    }
}
