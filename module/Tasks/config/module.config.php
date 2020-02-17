<?php
return array(
    'service_manager' => array(
        'factories' => array(
            'Tasks\\V1\\Rest\\User\\UserResource' => 'Tasks\\V1\\Rest\\User\\UserResourceFactory',
        ),
    ),
    'router' => array(
        'routes' => array(
            'tasks.rest.user' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/user[/:user_id]',
                    'defaults' => array(
                        'controller' => 'Tasks\\V1\\Rest\\User\\Controller',
                    ),
                ),
            ),
            'tasks.rest.doctrine.user-entity' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/user-entity[/:user_entity_id]',
                    'defaults' => array(
                        'controller' => 'Tasks\\V1\\Rest\\UserEntity\\Controller',
                    ),
                ),
            ),
        ),
    ),
    'zf-versioning' => array(
        'uri' => array(
            1 => 'tasks.rest.user',
            0 => 'tasks.rest.doctrine.user-entity',
        ),
    ),
    'zf-rest' => array(
        'Tasks\\V1\\Rest\\User\\Controller' => array(
            'listener' => 'Tasks\\V1\\Rest\\User\\UserResource',
            'route_name' => 'tasks.rest.user',
            'route_identifier_name' => 'user_id',
            'collection_name' => 'user',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Lift\\Entity\\UserEntity',
            'collection_class' => 'Lift\\Repository\\UserRepository',
            'service_name' => 'user',
        ),
        'Tasks\\V1\\Rest\\UserEntity\\Controller' => array(
            'listener' => 'Tasks\\V1\\Rest\\UserEntity\\UserEntityResource',
            'route_name' => 'tasks.rest.doctrine.user-entity',
            'route_identifier_name' => 'user_entity_id',
            'entity_identifier_name' => 'id',
            'collection_name' => 'user_entity',
            'entity_http_methods' => array(
                0 => 'GET',
                1 => 'PATCH',
                2 => 'PUT',
                3 => 'DELETE',
            ),
            'collection_http_methods' => array(
                0 => 'GET',
                1 => 'POST',
            ),
            'collection_query_whitelist' => array(),
            'page_size' => 25,
            'page_size_param' => null,
            'entity_class' => 'Lift\\Entity\\UserEntity',
            'collection_class' => 'Tasks\\V1\\Rest\\UserEntity\\UserEntityCollection',
            'service_name' => 'UserEntity',
        ),
    ),
    'zf-content-negotiation' => array(
        'controllers' => array(
            'Tasks\\V1\\Rest\\User\\Controller' => 'HalJson',
            'Tasks\\V1\\Rest\\UserEntity\\Controller' => 'Json',
        ),
        'accept_whitelist' => array(
            'Tasks\\V1\\Rest\\User\\Controller' => array(
                0 => 'application/json',
                1 => 'application/hal+json',
            ),
            'Tasks\\V1\\Rest\\UserEntity\\Controller' => array(
                0 => 'application/vnd.tasks.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ),
        ),
        'content_type_whitelist' => array(
            'Tasks\\V1\\Rest\\User\\Controller' => array(
                0 => 'application/json',
            ),
            'Tasks\\V1\\Rest\\UserEntity\\Controller' => array(
                0 => 'application/vnd.tasks.v1+json',
                1 => 'application/json',
            ),
        ),
    ),
    'zf-hal' => array(
        'metadata_map' => array(
            'Tasks\\V1\\Rest\\User\\UserEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'tasks.rest.user',
                'route_identifier_name' => 'user_id',
                'hydrator' => 'Zend\\Hydrator\\ArraySerializable',
            ),
            'Tasks\\V1\\Rest\\User\\UserCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'tasks.rest.user',
                'route_identifier_name' => 'user_id',
                'is_collection' => true,
            ),
            'Lift\\Entity\\UserEntity' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'tasks.rest.doctrine.user-entity',
                'route_identifier_name' => 'user_entity_id',
                'hydrator' => 'Tasks\\V1\\Rest\\UserEntity\\UserEntityHydrator',
            ),
            'Lift\\Repository\\UserRepository' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'tasks.rest.user',
                'route_identifier_name' => 'user_id',
                'is_collection' => true,
            ),
            'Tasks\\V1\\Rest\\UserEntity\\UserEntityCollection' => array(
                'entity_identifier_name' => 'id',
                'route_name' => 'tasks.rest.doctrine.user-entity',
                'is_collection' => true,
            ),
        ),
    ),
    'zf-content-validation' => array(
        'Tasks\\V1\\Rest\\User\\Controller' => array(
            'input_filter' => 'Tasks\\V1\\Rest\\User\\Validator',
        ),
        'Tasks\\V1\\Rest\\UserEntity\\Controller' => array(
            'input_filter' => 'Tasks\\V1\\Rest\\UserEntity\\Validator',
        ),
    ),
    'input_filter_specs' => array(
        'Tasks\\V1\\Rest\\User\\Validator' => array(
            0 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => '3',
                            'max' => '20',
                        ),
                    ),
                ),
                'filters' => array(),
                'name' => 'user_name',
            ),
            1 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => '2',
                            'max' => '20',
                        ),
                    ),
                ),
                'filters' => array(),
                'name' => 'first_name',
            ),
            2 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => '2',
                            'max' => '30',
                        ),
                    ),
                ),
                'filters' => array(),
                'name' => 'last_name',
            ),
            3 => array(
                'required' => true,
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => '8',
                        ),
                    ),
                ),
                'filters' => array(),
                'name' => 'password',
                'field_type' => '',
            ),
        ),
        'Tasks\\V1\\Rest\\UserEntity\\Validator' => array(
            0 => array(
                'name' => 'userName',
                'required' => true,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => 1,
                            'max' => 255,
                        ),
                    ),
                ),
            ),
            1 => array(
                'name' => 'firstName',
                'required' => true,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => 1,
                            'max' => 255,
                        ),
                    ),
                ),
            ),
            2 => array(
                'name' => 'lastName',
                'required' => true,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => 1,
                            'max' => 255,
                        ),
                    ),
                ),
            ),
            3 => array(
                'name' => 'password',
                'required' => true,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => 1,
                            'max' => 255,
                        ),
                    ),
                ),
            ),
            4 => array(
                'name' => 'role',
                'required' => true,
                'filters' => array(
                    0 => array(
                        'name' => 'Zend\\Filter\\StringTrim',
                    ),
                    1 => array(
                        'name' => 'Zend\\Filter\\StripTags',
                    ),
                ),
                'validators' => array(
                    0 => array(
                        'name' => 'Zend\\Validator\\StringLength',
                        'options' => array(
                            'min' => 1,
                            'max' => 255,
                        ),
                    ),
                ),
            ),
        ),
    ),
    'zf-mvc-auth' => array(
        'authorization' => array(
            'Tasks\\V1\\Rest\\User\\Controller' => array(
                'collection' => array(
                    'GET' => true,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
                'entity' => array(
                    'GET' => true,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
            ),
            'Tasks\\V1\\Rest\\UserEntity\\Controller' => array(
                'collection' => array(
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
                'entity' => array(
                    'GET' => false,
                    'POST' => false,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ),
            ),
        ),
    ),
    'zf-apigility' => array(
        'doctrine-connected' => array(
            'Tasks\\V1\\Rest\\UserEntity\\UserEntityResource' => array(
                'object_manager' => 'doctrine.entitymanager.orm_default',
                'hydrator' => 'Tasks\\V1\\Rest\\UserEntity\\UserEntityHydrator',
            ),
        ),
    ),
    'doctrine-hydrator' => array(
        'Tasks\\V1\\Rest\\UserEntity\\UserEntityHydrator' => array(
            'entity_class' => 'Lift\\Entity\\UserEntity',
            'object_manager' => 'doctrine.entitymanager.orm_default',
            'by_value' => false,
            'strategies' => array(),
            'use_generated_hydrator' => true,
        ),
    ),
);
