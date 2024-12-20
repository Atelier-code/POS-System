<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class input extends Component
{

    public $name, $label,$type,$placeholder, $required, $value, $step;

    public function __construct($name, $label, $type, $placeholder =" ", $required = false,$value = null, $step="any")
    {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->required = $required;
        $this->value = $value;
        $this->step = $step;

    }


    public function render(): View|Closure|string
    {
        return view('components.input');
    }
}
