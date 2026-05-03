<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Navbar extends Component
{
    public string $active;
    public string $colorHome;
    public string $colorAbout;
    public string $colorProduct;
    public string $weightHome;
    public string $weightAbout;
    public string $weightProduct;

    public function __construct(string $active = 'home')
    {
        $this->active = $active;

        $this->colorHome    = request()->routeIs('home', 'pages.home')  ? '#4f46e5' : '#64748b';
        $this->colorAbout   = request()->routeIs('about')               ? '#4f46e5' : '#64748b';
        $this->colorProduct = request()->routeIs('pages.product')       ? '#4f46e5' : '#64748b';
        $this->weightHome    = request()->routeIs('home', 'pages.home') ? 'bold' : 'normal';
        $this->weightAbout   = request()->routeIs('about')              ? 'bold' : 'normal';
        $this->weightProduct = request()->routeIs('pages.product')      ? 'bold' : 'normal';
    }

    public function render()
    {
        return view('components.navbar');
    }
}
