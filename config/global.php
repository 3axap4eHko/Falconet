<?php

return [
    'loader' => [
        'namespaces' => [
            'Falconet' => dirname(__DIR__) . '/vendor/Falconet'
        ]
    ],
    'module' => [
        'dir' => dirname(__DIR__) . '/module',
        'list' => [
            'System'
        ]
    ]
];