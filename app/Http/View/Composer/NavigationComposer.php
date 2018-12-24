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
        $view->with('displayName', $user->getDisplayName());
        $view->with('displayPosition', 'System Admin');
        $view->with('navigation', 'all');
    }
}