<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class application-logo extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the views / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.application-logo');
    }
}
