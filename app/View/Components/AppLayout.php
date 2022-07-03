<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    private $back;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($back = null)
    {
        $this->back = request()->back ?? $back;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layouts.app', ['back' => $this->back, 'is_active' => function(bool $active){#
            return ($active == true) ? 'class="active"' : null;
            // return ($active == true) ? 'style="color: green; text-decoration: underline"' : null;
        }]);
    }
}
