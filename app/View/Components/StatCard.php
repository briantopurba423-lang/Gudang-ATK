<?php

namespace App\View\Components;

use Illuminate\View\Component;

class StatCard extends Component
{
    public string $label;
    public $value;
    public string $color;
    public string $icon;

    public function __construct(
        string $label,
        $value,
        string $color = '#1e73d8',
        string $icon = '📦'
    ) {
        $this->label = $label;
        $this->value = $value;
        $this->color = $color;
        $this->icon  = $icon;
    }

    public function render()
    {
        return view('components.stat-card');
    }
}
