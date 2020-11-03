<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavNotification extends Component
{
    public $count;
    public $link;
    public $icon;

    /**
     * Create a new component instance.
     *
     * @param $count
     * @param $route
     * @param $icon
     */
    public function __construct(int $count, string $route, string $icon)
    {
        $this->count = $count;
        $this->link = $route;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.nav-notification');
    }
}
