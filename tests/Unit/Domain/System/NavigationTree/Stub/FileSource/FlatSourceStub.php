<?php

namespace Tests\Unit\Domain\System\NavigationTree\Stub\FileSource;

class FlatSourceStub
{
    public static function get() : array
    {
        return [
            [                
                'icon_class'    => 'fa fa-users', 
                'text'          => 'User Management',
                'module'        => 'u', 
                'route'         => 'users'
            ],
            [                
                'icon_class'    => 'fa fa-file-alt', 
                'text'          => 'Tracking Numbers',
                'module'        => 'TN',
                'route'         => 'tracking-numbers'
            ],
        ];
    }
}