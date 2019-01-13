<?php

return [
    [                
        'icon_class'    => 'fa fa-dashboard', 
        'text'          => 'Dashboard',                
        'route'         => 'dashboard'
    ],    
    [                
        'icon_class'    => 'fa fa-users', 
        'text'          => 'CRM',
        'children'      => [
            [                
                'icon_class'    => 'fa fa-users', 
                'text'          => 'Client/Lead Management',
                'module'        => 'C',
                'route'         => 'clients.index'
            ],
            [                
                'icon_class'    => 'fa fa-address-card', 
                'text'          => 'Quotations',
                'module'        => 'CQ',
                'route'         => 'quotations.index'
            ],
        ]
    ],
    [                
        'icon_class'    => 'fa fa-truck', 
        'text'          => 'Items',
        'children'      => [
            [                
                'icon_class'    => 'fa fa-list', 
                'text'          => 'Item Management',
                'module'        => 'I',
                'route'         => 'items.index'
            ],
            [                
                'icon_class'    => 'fa fa-question', 
                'text'          => 'Stock Inquiry',
                'module'        => 'ISI',
                'route'         => 'stock-inquiries.index'
            ],
        ]
    ],
    [                
        'icon_class'    => 'fa fa-gears', 
        'text'          => 'Administration',
        'children'      => [
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
            ]
        ]
    ]    
];
