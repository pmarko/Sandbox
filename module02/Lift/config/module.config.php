<?php
namespace Lift;

use http\Exception\UnexpectedValueException;
use Lift\Auth\TestAdapter;
use Lift\Controller\AuthController;
use Lift\Controller\FoundAtOptionsAdminController;
use Lift\Controller\IndexController;
use Lift\Controller\UserControllerFactory;
use Lift\Filter\UppercaseFirst;
use Lift\Form\Element\FoundAtSelectFactory;
use Lift\Form\Fieldset\FoundAtOptionsAdminFieldset;
use Lift\Form\Fieldset\UserLoginFieldset;
use Lift\Form\FoundAtOptionsAdminForm;
use Lift\Form\UserLoginForm;
use Lift\Repository\FoundAtOptionsRepo;
use Lift\Validator\GreaterThan5;
use Lift\Form\Fieldset\UserFieldset;
use Lift\Form\Fieldset\UserRegistrationFieldset;
use Lift\Form\UserRegistrationForm;
use Lift\View\Helper\AuthElement;
use Lift\View\Helper\AuthElementFactory;
use Zend\Authentication\AuthenticationService as ZendAuthService;
use Zend\Filter\Callback;
use Zend\Form\Element\Select;


return [
    'service_manager' => [
        'invokables' => [
            //TestAdapter::class => TestAdapter::class
        ],
        'factories' => [
            ZendAuthService::class => function($sm){
                return new ZendAuthService(null, new TestAdapter());
            },
            FoundAtOptionsRepo::class => function($sm){
                $config = $sm->get('Config');
                if(!array_key_exists('lift', $config)){
                    throw new \UnexpectedValueException("lift config required");
                }
                if(!array_key_exists('db_file', $config['lift'])){
                    throw new \UnexpectedValueException("lift/db_file config required");
                }
                return new FoundAtOptionsRepo($config['lift']['db_file']);
            }
        ]
    ],
    'validators' => [
        'invokables' => [
          GreaterThan5::class => GreaterThan5::class
        ],
        'factories' => [
        ],
        'aliases' => [
            'GreaterThan5' => GreaterThan5::class
        ]
    ],
    'filters' => [
        'invokables' => [
            UppercaseFirst::class => UppercaseFirst::class
        ],
        'factories' => [
        ],
        'aliases' => [
            'UppercaseFirst' => UppercaseFirst::class
        ]
    ],
    'form_elements' => [
        'invokables' => [
            'Lift\Form\Fieldset\UserFieldset' => UserFieldset::class,
            'Lift\Form\Fieldset\UserRegistrationFieldset' => UserRegistrationFieldset::class,
            'Lift\Form\UserRegistrationForm' => UserRegistrationForm::class,
            UserLoginFieldset::class => UserLoginFieldset::class,
            UserLoginForm::class => UserLoginForm::class,
            FoundAtOptionsAdminForm::class => FoundAtOptionsAdminForm::class,
            FoundAtOptionsAdminFieldset::class => FoundAtOptionsAdminFieldset::class
        ],
        'factories' => [
            'Lift\Form\Element\FoundAtSelect' => FoundAtSelectFactory::class
        ]
    ],
    'view_helpers' => [
        'invokables' => [

        ],
        'factories' => [
            AuthElement::class => AuthElementFactory::class
        ],
        'aliases' => [
            'liftAuthElement' => AuthElement::class
        ]
    ],
    'controllers' => [
        'invokables' => [
            'Lift\Controller\Index' => IndexController::class,
            //'Lift\Controller\FoundAtOptionsAdmin'  => FoundAtOptionsAdminController::class
        ],
        'factories' => [
            'Lift\Controller\User' => UserControllerFactory::class,
            'Lift\Controller\Auth' => function($sm){
                $authService = $sm->getServiceLocator()->get(ZendAuthService::class);
                $loginForm = $sm->getServiceLocator()->get('FormElementManager')->get(UserLoginForm::class);
                return new AuthController($authService, $loginForm);
            },
            'Lift\Controller\FoundAtOptionsAdmin' => function($sm){
                $repo = $sm->getServiceLocator()->get(FoundAtOptionsRepo::class);
                $form = $sm->getServiceLocator()->get('FormElementManager')
                    ->get(FoundAtOptionsAdminForm::class);
                return new FoundAtOptionsAdminController($repo, $form);
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
                    'admin' => [
                        'type' => 'Zend\Mvc\Router\Http\Literal',
                        'options' => [
                            'route'    => '/admin',
                            'defaults' => [
//                                'controller' => 'Lift\Controller\User',
//                                'action'     => 'register',
                            ],
                        ],
                        'may_terminate' => false,
                        'child_routes' => [
                            'found-at-options' => [
                                'type' => 'Zend\Mvc\Router\Http\Literal',
                                'options' => [
                                    'route'    => '/found-at-options',
                                    'defaults' => [
                                        'controller' => 'Lift\Controller\FoundAtOptionsAdmin',
                                        'action'     => 'index',
                                    ],
                                ],
                            ]
                        ]
                    ],
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
//                    'login' => [
//                        'type' => 'Zend\Mvc\Router\Http\Literal',
//                        'options' => [
//                            'route'    => '/login',
//                            'defaults' => [
//                                'controller' => 'Lift\Controller\Auth',
//                                'action'     => 'login',
//                            ],
//                        ],
//                    ],
//                    'logout' => [
//                        'type' => 'Zend\Mvc\Router\Http\Literal',
//                        'options' => [
//                            'route'    => '/logout',
//                            'defaults' => [
//                                'controller' => 'Lift\Controller\Auth',
//                                'action'     => 'logout',
//                            ],
//                        ],
//                    ],
                    'auth' => [
                        'type' => 'Zend\Mvc\Router\Http\Segment',
                        'options' => [
                            'route'    => '/:action',
                            'defaults' => [
                                'controller' => 'Lift\Controller\Auth'
                            ],
                            'constraints' => [
                                'action' => '(login|logout)'
                            ]
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
    'navigation' => [
        'lift' => [
            [
                'label' => 'Home',
                'route' => 'lift',
            ],
            [
                'label' => 'Register',
                'route' => 'lift/register',
            ],
        ]
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view'
        ],
        'template_map' => [
            'layout/lift' => __DIR__ . '/../view/layout/layout.phtml',
        ],
    ],
    'lift'=> [
        'db_file' => __DIR__ . '/../../../data/config/database.json'
    ]
];