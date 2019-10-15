<?php

namespace App\Http\Controllers\ViewComposers;

use App\Entity\Category;
use Illuminate\View\View;

class MenuPagesComposer
{
    public function compose(View $view): void
    {
        $view->with('menuPages', Category::get()->all());
    }
}
