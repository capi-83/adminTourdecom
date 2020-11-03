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
    public $badge;
    public $badgeType;
    public $badgeText;

    /**
     * Create a new component instance.
     *
     * @param $href
     * @param $active
     * @param bool $icon
     * @param bool $sub
     * @param bool $badge
     * @param string $badgeType
     * @param int $badgeText
     */
    public function __construct($href, $active, $icon = false, $sub = false, $badge =false, $badgeType='info', $badgeText=0)
    {
        $this->sub = $sub;
        $this->href = $href;
        $this->icon = $icon;
        $this->active = $active;
        $this->badge = $badge;
        $this->badgeType = $badgeType;
        $this->badgeText = $badgeText;
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
