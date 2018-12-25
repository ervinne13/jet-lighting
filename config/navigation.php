<?php

return [
    [                
        'icon_class'    => 'fa fa-dashboard', 
        'text'          => 'Dashboard',                
        'route'         => 'dashboard'
    ],
    [                
        'icon_class'    => 'fa fa-lock', 
        'text'          => 'Role Management',
        'module'        => 'R',
        'route'         => 'roles.index'
    ],
    [                
        'icon_class'    => 'fa fa-file', 
        'text'          => 'Tracking Numbers',
        'module'        => 'TN',
        'route'         => 'tracking-numbers.index'
    ],
];