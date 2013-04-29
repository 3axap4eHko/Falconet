<?php

return [
    'router' => [
        'system-default' => [
            'module'     => 'System',
            'controller' => 'Index',
            'actions'    => [
                'index' => '(get|post)/{page:\d+}?',
                'edit'  => '(get|post)/edit/{id:\d+}',
            ]
        ]
    ]
];