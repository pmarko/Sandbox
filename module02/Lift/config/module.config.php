<?php
namespace Lift;

use Lift\Controller\IndexController;

return [
    'controllers' => [
        'invokables' => [
            'Lift\Controller\Index' => IndexController::class
        ],
    ],
    'router' => [
        'routes' => [
            'lift' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route'    => '/lift',
                    'defaults' => [
                        'controller' => 'Lift\Controller\Index',
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view'
        ],
        'template_map' => [
            'layout/lift' => __DIR__ . '/../view/layout/layout.phtml',
        ],
    ],
];