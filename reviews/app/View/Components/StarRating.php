<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StarRating extends Component
{
    /**
     * 
     * The rating value
     * @var float
     */
    public $rating;

    /** 
     * Create a new component instance.
     * @param float $rating
     * @return void
     */
    public function __construct(?float $rating)
    {
        $this->rating = $rating;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

        return view('components.star-rating');
    }
}
