<?php

namespace App\Http\View\Composers;

use App\Repositories\UserRepository;
use Illuminate\View\View;

class NavigationComposer
{

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $user = current_user();        
        $view->with('userName', $user->getName());
        $view->with('userPosition', 'System Admin');
        $view->with('navigation', 'all');
    }
}