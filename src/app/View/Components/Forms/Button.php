<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;

class Button extends Component
{
    public $type;
    public $value;
    public $name;
    public $class;

    public function __construct($type, $name, $value, $class)
    {
        $this->type = $type;
        $this->name = $name;
        $this->value = $value;
        $this->class = $class;
    }


    public function render()
    {
        return view('components.forms.button');
    }
}
