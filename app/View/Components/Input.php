<?php
namespace App\View\Components;
use Illuminate\View\Component;
use Illuminate\View\View;

class Input extends Component
{
    public $name;
    public $label;
    public $disabled;
    public $value;
    public $type;
    public $message;

    /**
     * Create a new component instance.
     *
     * @param $name
     * @param $label
     * @param bool $disabled
     * @param string $value
     * @param string $type
     * @param string $message
     */
    public function __construct($name, $label, $disabled = false, $value ='', $type='text', $message='')
    {
        $this->name = $name;
        $this->label = $label;
        $this->disabled = $disabled;
        $this->value = $value;
        $this->type = $type;
        $this->message = $message;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.input');
    }
}
