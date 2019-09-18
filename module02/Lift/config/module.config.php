<?php
namespace Lift;

use Lift\Controller\AuthController;
use Lift\Controller\IndexController;
use Lift\Controller\UserController;
use Lift\Form\Fieldset\UserFieldset;
use Lift\Form\Fieldset\UserRegistrationFieldset;
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
            'Lift\Form\Fieldset\UserFieldset' => UserFieldset::class,
            'Lift\Form\Fieldset\UserRegistrationFieldset' => UserRegistrationFieldset::class,
            'Lift\Form\UserRegistrationForm' => UserRegistrationForm::class
        ]
    ],
    'controllers' => [
        'invokables' => [
            'Lift\Controller\Index' => IndexController::class,
            'Lift\Controller\Auth'  => AuthController::class
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
                    'login' => [
                        'type' => 'Zend\Mvc\Router\Http\Literal',
                        'options' => [
                            'route'    => '/login',
                            'defaults' => [
                                'controller' => 'Lift\Controller\Auth',
                                'action'     => 'login',
                            ],
                        ],
                    ],
                    'logout' => [
                        'type' => 'Zend\Mvc\Router\Http\Literal',
                        'options' => [
                            'route'    => '/logout',
                            'defaults' => [
                                'controller' => 'Lift\Controller\Auth',
                                'action'     => 'logout',
                            ],
                        ],
                    ]
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