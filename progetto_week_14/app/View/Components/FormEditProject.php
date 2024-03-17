<?php

namespace App\View\Components;

use App\Models\Project;
use Closure;
use GuzzleHttp\Handler\Proxy;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormEditProject extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Project $project)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-edit-project');
    }
}
