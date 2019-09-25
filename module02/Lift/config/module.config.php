<?php
namespace Lift;

use http\Exception\UnexpectedValueException;
use Lift\Acl\AclInterface;
use Lift\Acl\ConfigAcl;
use Lift\Acl\ConfigAclFactory;
use Lift\Auth\DoctrineAuthServiceFactory;
use Lift\Auth\TestAdapter;
use Lift\Controller\AuthController;
use Lift\Controller\DemandController;
use Lift\Controller\FoundAtOptionsAdminController;
use Lift\Controller\IndexController;
use Lift\Controller\OfferController;
use Lift\Controller\UserControllerFactory;
use Lift\Controller\UserRegistrationController;
use Lift\Controller\UserRegistrationControllerFactory;
use Lift\Crypto\BcryptFactory;
use Lift\Doctrine\EventListener\CryptoInjectionListener;
use Lift\Doctrine\EventListener\CryptoInjectionListenerFactory;
use Lift\Entity\UserEntity;
use Lift\Filter\UppercaseFirst;
use Lift\Form\Element\WhereFoundSelectFactory;
use Lift\Form\Fieldset\FoundAtOptionsAdminFieldset;
use Lift\Form\Fieldset\UserFieldsetFactory;
use Lift\Form\Fieldset\UserLoginFieldset;
use Lift\Form\Fieldset\UserRegistrationFieldsetFactory;
use Lift\Form\FoundAtOptionsAdminForm;
use Lift\Form\UserLoginForm;
use Lift\Hydrator\DoctrineObjectHydratorFactory;
use Lift\Model\ModelAbstractFactory;
use Lift\Model\UserModel;
use Lift\Model\UserModelFactory;
use Lift\Mvc\EventListener\NavigationHelperAclEventListener;
use Lift\Mvc\EventListener\RouteAclEventListener;
use Lift\Repository\FoundAtOptionsRepo;
use Lift\Repository\RepositoryAbstractFactory;
use Lift\Repository\UserRepository;
use Lift\Repository\UserRepositoryFactory;
use Lift\ServiceManager\Delegator\UserModelBDelegatorFactory;
use Lift\ServiceManager\Delegator\UserModelDelegatorFactory;
use Lift\ServiceManager\Initializer\AuthServiceAwareInitializer;
use Lift\ServiceManager\Initializer\ObjectManagerAwareInitializer;
use Lift\Validator\GreaterThan5;
use Lift\Form\Fieldset\UserFieldset;
use Lift\Form\Fieldset\UserRegistrationFieldset;
use Lift\Form\UserRegistrationForm;
use Lift\Validator\UsernameIsUniqueFactory;
use Lift\Validator\WhereFoundOptionExistsFactory;
use Lift\View\Helper\AuthElement;
use Lift\View\Helper\AuthElementFactory;
use Zend\Authentication\AuthenticationService as ZendAuthService;
use Zend\Crypt\Password\Bcrypt;
use Zend\Filter\Callback;
use Zend\Form\Element\Select;


return [
    'doctrine' => [
        'driver' => [
            __NAMESPACE__  .'_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../src/' . __NAMESPACE__ . '/Entity'
                ]
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__  .'_driver'
                ]
            ]
        ],
        'authentication' => [
            'orm_default' => [
                'object_manager' => 'Doctrine\ORM\EntityManager',
                'identity_class' => 'Lift\Entity\UserEntity',
                'identity_property' => 'userName',
                'credential_property' => 'password',
                'credential_callable' => function (UserEntity $user, $passwordGiven) {
                    return $user->verify($passwordGiven);
                },
            ],
        ],
        'eventmanager' => [
            'orm_default' => [
                'subscribers' => [
                    CryptoInjectionListener::class
                ],
            ],
        ],

    ],
    'service_manager' => [
        'invokables' => [
            NavigationHelperAclEventListener::class => NavigationHelperAclEventListener::class,
            RouteAclEventListener::class => RouteAclEventListener::class,
        ],
        'factories' => [
            ZendAuthService::class => DoctrineAuthServiceFactory::class,
            CryptoInjectionListener::class => CryptoInjectionListenerFactory::class,
            'Lift\Crypto\Crypto' => BcryptFactory::class,
            'Lift\Acl\Acl' => ConfigAclFactory::class,
        ],
        'initializers' => [
            AuthServiceAwareInitializer::class,
            ObjectManagerAwareInitializer::class
        ],
        'abstract_factories' => [
            RepositoryAbstractFactory::class
        ]
//        'delegators' => [
//            UserModel::class => [
//                UserModelBDelegatorFactory::class,
//                UserModelDelegatorFactory::class,
//            ]
//        ],
//        'lazy_services' => [
//            'class_map' => [
//                UserModel::class => UserModel::class
//            ]
//        ],
    ],

    'validators' => [
        'invokables' => [
          GreaterThan5::class => GreaterThan5::class
        ],
        'factories' => [
            'Lift\Validator\UsernameIsUnique' => UsernameIsUniqueFactory::class,
            'Lift\Validator\WhereFoundOptionExists' => WhereFoundOptionExistsFactory::class
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
            UserRegistrationForm::class => UserRegistrationForm::class,
            UserLoginFieldset::class => UserLoginFieldset::class,
            UserLoginForm::class => UserLoginForm::class,
            FoundAtOptionsAdminForm::class => FoundAtOptionsAdminForm::class,
            FoundAtOptionsAdminFieldset::class => FoundAtOptionsAdminFieldset::class
        ],
        'factories' => [
            'Lift\Form\Element\WhereFoundSelect' => WhereFoundSelectFactory::class,
            UserFieldset::class => UserFieldsetFactory::class,
            UserRegistrationFieldset::class => UserRegistrationFieldsetFactory::class
        ],
    ],
    'hydrators' => [
        'factories' => [
            'Lift\Hydrator\DoctrineObject' => DoctrineObjectHydratorFactory::class
        ],
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
            'Lift\Controller\Offer' => OfferController::class,
            'Lift\Controller\Demand' => DemandController::class
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
            },
            'Lift\Controller\UserRegistration' => UserRegistrationControllerFactory::class
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
                        'resource'   => 'home'
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
                                'controller' => 'Lift\Controller\UserRegistration',
                                'action'     => 'register',
                                'resource'   => 'register'
                            ],
                        ],
                    ],
                    'offer' => [
                        'type' => 'Zend\Mvc\Router\Http\Literal',
                        'options' => [
                            'route'    => '/offer',
                            'defaults' => [
                                'controller' => 'Lift\Controller\Offer',
                                'action'     => 'index',
                                'resource'   => 'offer'
                            ],
                        ],
                    ],
                    'demand' => [
                        'type' => 'Zend\Mvc\Router\Http\Literal',
                        'options' => [
                            'route'    => '/request',
                            'defaults' => [
                                'controller' => 'Lift\Controller\Demand',
                                'action'     => 'index',
                                'resource'   => 'demand'
                            ],
                        ],
                    ],
                    'my_offer' => [
                        'type' => 'Zend\Mvc\Router\Http\Literal',
                        'options' => [
                            'route'    => '/my-offer',
                            'defaults' => [
                                'controller' => 'Lift\Controller\Offer',
                                'action'     => 'index',
                                'resource'   => 'my_offer'
                            ],
                        ],
                    ],
                    'my_demand' => [
                        'type' => 'Zend\Mvc\Router\Http\Literal',
                        'options' => [
                            'route'    => '/my-request',
                            'defaults' => [
                                'controller' => 'Lift\Controller\Demand',
                                'action'     => 'index',
                                'resource'   => 'my_demand'
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
                                'controller' => 'Lift\Controller\Auth',
                                'resource' => 'auth'
                            ],
                            'constraints' => [
                                'action' => '(login|logout)',
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
        'defaults' => [

        ],
        'lift' => [
            [
                'label' => 'Home',
                'route' => 'lift',
                'resource' => 'home'
            ],
            [
                'label' => 'Offers',
                'route' => 'lift/offer',
                'resource' => 'offer'
            ],
            [
                'label' => 'Requests',
                'route' => 'lift/demand',
                'resource' => 'demand'
            ],
            [
                'label' => 'My Offers',
                'route' => 'lift/my_offer',
                'resource' => 'my_offer'
            ],
            [
                'label' => 'My Requests',
                'route' => 'lift/my_demand',
                'resource' => 'my_demand'
            ],
            [
                'label' => 'Register',
                'route' => 'lift/register',
                'resource' => 'register'
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
        'db_file' => __DIR__ . '/../../../data/config/database.json',
        'acl' => [
            'roles' => [
                'guest',
                'user' => ['guest']
            ],
            'resources' => [
                'home',
                'register',
                'auth',
                'offer',
                'demand',
                'my_offer',
                'my_demand'
            ],
            'allow' => [
                'guest' => ['home', 'register', 'auth', 'offer', 'demand'],
                'user' => ['my_offer', 'my_demand']
            ],
            'deny' => [
                'user' => ['register']
            ]
        ]
    ]
];