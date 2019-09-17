<?php
namespace Lift;

use Lift\Controller\IndexController;
use Lift\Controller\UserController;
use Lift\Form\UserRegistrationForm;
use Zend\Filter\Callback;
use Zend\Validator\StringLength;

return [
    'service_manager' => [

    ],
    'validators' => [
        'factories' => [
            'GreaterThan5' => function($pm){
                return new StringLength(['min' => 5]);
            }
        ]
    ],
    'filters' => [
        'factories' => [
            'UppercaseFirst' => function($pm){
                $filter = new Callback();
                $filter->setCallback(function($val){
                    return ucfirst($val);
                });
                return $filter;
            }
        ]
    ],
    'form_elements' => [
        'invokables' => [
            'Lift\Form\UserRegistrationForm' => UserRegistrationForm::class
        ]
    ],
    'controllers' => [
        'invokables' => [
            'Lift\Controller\Index' => IndexController::class,
            //'Lift\Controller\User'  => UserController::class
        ],
        'factories' => [
            'Lift\Controller\User' => function($serviceLocator){
                $userRegistrationForm = $serviceLocator
                    ->getServiceLocator()
                    ->get('FormElementManager')
                    ->get('Lift\Form\UserRegistrationForm');
                return new UserController($userRegistrationForm);
            }
        ]
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
                'may_terminate' => true,
                'child_routes' => [
                    'register' => [
                        'type' => 'Zend\Mvc\Router\Http\Literal',
                        'options' => [
                            'route'    => '/register',
                            'defaults' => [
                                'controller' => 'Lift\Controller\User',
                                'action'     => 'register',
                            ],
                        ],
                    ],
//                    'user' => [
////                        'type' => 'Zend\Mvc\Router\Http\Literal',
////                        'options' => [
////                            'route'    => '/user',
////                            'defaults' => [
//////                                'controller' => 'Lift\Controller\Index',
//////                                'action'     => 'index',
////                            ],
////                        ],
////                        'may_terminate' => false,
//////                        'child_routes' => [
//////                            'register' => [
//////                                'type' => 'Zend\Mvc\Router\Http\Literal',
//////                                'options' => [
//////                                    'route'    => '/register',
//////                                    'defaults' => [
//////                                        //'controller' => 'Lift\Controller\Index',
//////                                        //'action'     => 'index',
//////                                    ],
//////                                ],
//////                            ]
//////                        ]
////                    ]
                ]
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