<?php

namespace App\Http\Livewire;

use Livewire\Component;

class FormAccordion extends Component
{
    public bool $show = false;

    public function toggle() {
        $this->show = !$this->show;
    }

    public function mount(bool $show = false)
    {
        $this->show = $show;
    }

    public function render()
    {
        return view('livewire.form-accordion');
    }
}
