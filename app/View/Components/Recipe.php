<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Recipe extends Component
{
    public \App\Recipe $recipe;

    /**
     * Create a new component instance.
     *
     * @param \App\Recipe $recipe
     */
    public function __construct(\App\Recipe $recipe)
    {
        $this->recipe = $recipe;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render()
    {
        return view('components.recipe');
    }
}
