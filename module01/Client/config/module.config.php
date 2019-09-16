<?php
namespace Client;

use Client\Mvc\EventListener\Factory\OperationClientEventListenerFactory;
use Client\Mvc\EventListener\OperationClientEventListener;
use Client\Mvc\Validator\Policy\Factory\OperationClientPolicyValidatorFactory;
use Client\Mvc\Validator\Policy\OperationClientPolicyValidator;
use Client\Repository\Factory\OperationClientRepositoryFactory;
use Client\Repository\File\OperationClientFileRepository;
use Client\Repository\File\OperationClientFileRepositoryFactory;
use Client\Repository\OperationClientRepository;

return [
    'router' => [
        'routes' => [
            'client' => [
                'type' => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route'    => '/client/:operation',
                    'defaults' => [
                        'check_operation_client_policy' => true
                    ],
                ],
                'may_terminate' => false,
            ],
        ],
    ],
    'service_manager' => [
        'invokables' => [
        ],
        'abstract_factories' => [
        ],
        'factories' => [
            OperationClientEventListener::class
                => OperationClientEventListenerFactory::class,
            OperationClientPolicyValidator::class
                => OperationClientPolicyValidatorFactory::class,
            OperationClientRepository::class
                => OperationClientRepositoryFactory::class,
            OperationClientFileRepository::class
                => OperationClientFileRepositoryFactory::class
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'client' => [
        'operation_client_repository_path' => __DIR__ . "/../../../data/config/op-client.json"
    ]
];