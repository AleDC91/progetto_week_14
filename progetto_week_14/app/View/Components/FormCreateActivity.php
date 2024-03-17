<?php

namespace App\View\Components;

use App\Models\Project;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class FormCreateActivity extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Collection | array $users, public Project $project){}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-create-activity');
    }
}
