<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $userProjects = [];
        foreach ($user->activities as $activity) {
            if (!in_array($activity->project, $userProjects)) {
                $userProjects[] = $activity->project;
            }
        }
        $users = User::whereNotIn('id', [$user])->get();
        // dd($userProjects);
        return view('dashboard', ['user' => $user, 'userProjects' => $userProjects, 'users' => $users]);
    }
}
