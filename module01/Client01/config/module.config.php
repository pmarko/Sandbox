<?php
namespace Client01;

use Client01\Controller\IndexController;

return [
    'router' => [
        'routes' => [
            'client' => [
                'child_routes' => [
                    'presence-check' => [
                        'type' => 'Zend\Mvc\Router\Http\Literal',
                        'options' => [
                            'route'    => '/presence-check',
                            'defaults' => [
                                '__NAMESPACE__'  => 'Client01\Controller',
                                'controller'  => 'IndexController',
                                'action'      => 'index',
                                'client_type' => 'presence-check'
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
