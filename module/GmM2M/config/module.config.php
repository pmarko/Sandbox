<?php

use GmM2M\Controller\HttpClientController;

return [
    'controllers' => [
        'invokables' => [
            HttpClientController::class => HttpClientController::class
        ]
    ],
    'router' => [
        'routes' => [
            'gm_m2m' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route'    => '/gmm2m',
                    'defaults' => [
                        '__NAMESPACE__'  => 'GmM2M\Controller',
                        'controller'  => 'HttpClientController',
                        'action'      => 'index'
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'execute' => [
                        'type' => 'Zend\Mvc\Router\Http\Literal',
                        'options' => [
                            'route'    => '/execute',
                            'defaults' => [
                                'action'      => 'execute'
                            ],
                        ],
                    ],
                ]
            ],
        ]
    ]
];