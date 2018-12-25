<?php

namespace Tests\Unit\Domain\System\NavigationTree\Stub\FileSource;

class HasNonModuleBoundFlatSourceStub
{
    public static function get() : array
    {
        return [
            [                
                'icon_class'    => 'fa fa-dashboard', 
                'text'          => 'Dashboard',                
                'route'         => '/'
            ],
            [                
                'icon_class'    => 'fa fa-users', 
                'text'          => 'User Management',                
                'route'         => 'users',
                'module'        => 'u'
            ],
            [                
                'icon_class'    => 'fa fa-file-alt', 
                'text'          => 'Tracking Numbers',                
                'route'         => 'tracking-numbers',
                'module'        => 'TN'
            ],
        ];
    }
}