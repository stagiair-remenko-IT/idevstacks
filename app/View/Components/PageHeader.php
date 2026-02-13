<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class PageHeader extends Component
{
    public function __construct(
        public string $icon = 'document',
        public string $iconColor = 'indigo',
    ) {}

    public function render(): View
    {
        return view('components.page-header');
    }
}
