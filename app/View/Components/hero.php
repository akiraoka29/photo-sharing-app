<?php

namespace App\View\Components;

use Illuminate\View\Component;

class hero extends Component
{
    /**
     * The title hero.
     *
     * @var string
     */
    public $title;

    /**
     * The description hero.
     *
     * @var string
     */
    public $description;

    /**
     * The image hero.
     *
     * @var string
     */
    public $image;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $description, $image)
    {
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.hero');
    }
}
