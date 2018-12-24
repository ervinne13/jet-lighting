<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use Jet\Domain\System\Service\ModuleRepository;

class NavigationComposer
{

    /** @var ModuleRepository */
    private $moduleRepository;

    public function __construct(ModuleRepository $moduleRepository)
    {
        $this->moduleRepository = $moduleRepository;
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

        $view->with('modules', $moduleRepository->getAllActive());

    }
}