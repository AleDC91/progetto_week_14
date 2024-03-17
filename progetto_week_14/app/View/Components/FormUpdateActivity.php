<?php

namespace App\View\Components;

use App\Models\Activity;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class FormUpdateActivity extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Activity $activity, public Collection $users){}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-update-activity');
    }
}
