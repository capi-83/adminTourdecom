<?php
namespace App\View\Components;
use Illuminate\View\Component;
use Illuminate\View\View;

class MenuItem extends Component
{
    public $sub;
    public $href;
    public $icon;
    public $active;

    /**
     * Create a new component instance.
     *
     * @param $href
     * @param $active
     * @param bool $icon
     * @param bool $sub
     */
    public function __construct($href, $active, $icon = false, $sub = false)
    {
        $this->sub = $sub;
        $this->href = $href;
        $this->icon = $icon;
        $this->active = $active;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.menu-item');
    }
}
