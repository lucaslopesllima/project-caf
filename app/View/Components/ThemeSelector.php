<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ThemeSelector extends Component
{
    public array $themes = [
            'light',
            'dark',
            'cupcake'
    ];

    public function render()
    {
        return view('components.theme-selector');
    }
}
