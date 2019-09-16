<?php
namespace Client02;

use Client02\Controller\IndexController;

return [
    'router' => [
        'routes' => [
            'client' => [
                'child_routes' => [
                    'rework' => [
                        'type' => 'Zend\Mvc\Router\Http\Segment',
                        'options' => [
                            'route'    => '/rework',
                            'defaults' => [
                                '__NAMESPACE__'  => 'Client02\Controller',
                                'controller'  => 'IndexController',
                                'action'      => 'index',
                                'client_type' => 'rework'
                            ],
                        ],
                    ],
                ]
            ],

        ],
    ],
    'service_manager' => [
        'abstract_factories' => [
        ],
        'factories' => [
        ],
    ],
    'controllers' => [
        'invokables' => [
            IndexController::class => IndexController::class
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ]
];
