<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SelectList extends Component
{
    public $options;
    public $tags;

    /**
     * Create a new component instance.
     *
     * @param mixed $options
     * @param mixed $id
     */
    public function __construct($options, $tags = false)
    {
        $this->options = $options;
        $this->tags = $tags;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.select-list');
    }
}
