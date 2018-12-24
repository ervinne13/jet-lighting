<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Jet\Domain\System\Service\ModuleRepository;
use Jet\Domain\System\ValueObject\NavigationTree;

class NavigationComposer
{

    /** @var ModuleRepository */
    private $moduleRepository;

    /** @var NavigationTree */
    private $navTree;

    public function __construct(ModuleRepository $moduleRepository, NavigationTree $navTree)
    {
        $this->moduleRepository = $moduleRepository;
        $this->navTree = $navTree;
    }

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

        $view->with('navigationTree', $this->navTree);

    }
}