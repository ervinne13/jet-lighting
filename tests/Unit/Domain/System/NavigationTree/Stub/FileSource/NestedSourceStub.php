<?php

namespace Tests\Unit\Domain\System\NavigationTree\Stub\FileSource;

class NestedSourceStub
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
                'children'      => [
                    [                
                        'icon_class'    => 'fa fa-file', 
                        'text'          => 'File Management',
                        'module'        => 'file', 
                        'route'         => 'files'
                    ],
                    [                
                        'icon_class'    => 'fa fa-file', 
                        'text'          => 'Dummy Management',
                        'module'        => 'dummy', 
                        'route'         => 'dummies'
                    ],                    
                ]
            ],
        ];
    }
}