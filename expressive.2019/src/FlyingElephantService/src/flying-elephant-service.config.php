<?php
/**
 * Services config for Flying Elephant Service
 */
use Zend\Validator\{NotEmpty, Digits};
use Zend\Filter\StripTags;
use ZF\MvcAuth\Authentication\{HttpAdapter, OAuth2Adapter};
use FlyingElephantService\Rest\PropulsionSystems\{
    PropulsionSystemsResource,
    PropulsionSystemsEntity,
    PropulsionSystemsCollection
};
return [
    'documentation' => [
        PropulsionSystemsResource::class => [
            'description' => 'Service provides information about propulsion systems in use.',
            'collection' => [
                'description' => 'View list of propulsion systems offered.',
                'GET' => [
                    'description' => 'Retrieve a list of propulsion systems.',
                ],
                'POST' => [
                    'description' => 'Create a new propulsion system',
                ],
            ],
            'entity' => [
                'GET' => [
                    'description' => 'Retrieve a propulsion system',
                ],
                'PATCH' => [
                    'description' => 'Update a propulsion system',
                ],
                'PUT' => [
                    'description' => 'Replace a propulsion system',
                ],
                'DELETE' => [
                    'description' => 'Delete a propulsion system',
                ],
                'POST' => [
                    'description' => 'Create a new propulsion system',
                ],
            ],
        ],
    ],

    'propulsion' => [
        'array_mapper_path' => 'data/propulsion.php',
        'table' => 'propellant',
        'db' => \PDO::class,
    ],

    'zf-versioning' => [
        'uri' => [
            0 => 'fes-rest-propulsion-systems',
        ],
    ],
    'zf-rest' => [
        'route_name' => 'fes-rest-propulsion-systems',
        'route_identifier_name' => 'propulsion_systems_id',
        'entity_class' => PropulsionSystemsEntity::class,
        'collection_class' => PropulsionSystemsCollection::class,
        'collection_name' => 'propulsion_systems',
        'entity_http_methods' => [
            0 => 'GET',
            1 => 'PATCH',
            2 => 'PUT',
            3 => 'DELETE',
            4 => 'POST',
        ],
        'collection_http_methods' => [
            0 => 'GET',
            1 => 'POST',
        ],
        'collection_query_whitelist' => [],
        'page_size' => 25,
        'page_size_param' => null,
        'service_name' => 'PropulsionSystems',

    ],
    'zf-content-negotiation' => [
        'controllers' => [
            PropulsionSystemsResource::class => 'HalJson',
        ],
        'accept_whitelist' => [
            PropulsionSystemsResource::class => [
                0 => 'application/vnd.flying-elephant-service.v1+json',
                1 => 'application/hal+json',
                2 => 'application/json',
            ],
        ],
        'content_type_whitelist' => [
            PropulsionSystemsResource::class => [
                0 => 'application/vnd.flying-elephant-service.v1+json',
                1 => 'application/json',
            ],
        ],
    ],
    'zf-hal' => [
        'metadata_map' => [
            PropulsionSystemsEntity::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'fes-rest-propulsion-systems',
                'route_identifier_name' => 'propulsion_systems_id',
                'hydrator' => \Zend\Hydrator\ObjectProperty::class,
            ],
            PropulsionSystemsCollection::class => [
                'entity_identifier_name' => 'id',
                'route_name' => 'fes-rest-propulsion-systems',
                'route_identifier_name' => 'propulsion_systems_id',
                'is_collection' => true,
            ],
        ],
    ],
    'zf-content-validation' => [
        PropulsionSystemsResource::class => [
            'input_filter' => 'FlyingElephantService\\Rest\\PropulsionSystems\\Validator',
        ],
    ],
    'input_filter_specs' => [
        'FlyingElephantService\\Rest\\PropulsionSystems\\Validator' => [
            0 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => NotEmpty::class,
                        'options' => [
                            'breakchainonfailure' => false,
                        ],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => StripTags::class,
                        'options' => [],
                    ],
                ],
                'name' => 'Type',
                'description' => 'Volatile chemical',
                'field_type' => 'string',
                'error_message' => 'A value is required',
            ],
            1 => [
                'required' => true,
                'validators' => [
                    0 => [
                        'name' => NotEmpty::class,
                        'options' => [],
                    ],
                ],
                'filters' => [
                    0 => [
                        'name' => StripTags::class,
                        'options' => [],
                    ],
                ],
                'description' => 'The propellant chemical',
                'name' => 'Propellant',
                'field_type' => 'string',
                'error_message' => 'A value is required',
            ],
            2 => [
                'required' => false,
                'validators' => [
                    0 => [
                        'name' => Digits::class,
                        'options' => [],
                    ],
                ],
                'filters' => [],
                'name' => 'timestamp',
                'field_type' => 'timestamp',
                'description' => 'A timestamp placeholder',
                'error_message' => 'Invalid timestamp',
            ],
        ],
    ],
    'zf-mvc-auth' => [
        'authorization' => [
            PropulsionSystemsResource::class => [
                'collection' => [
                    'GET' => true,
                    'POST' => true,
                    'PUT' => false,
                    'PATCH' => false,
                    'DELETE' => false,
                ],
                'entity' => [
                    'GET' => true,
                    'POST' => true,
                    'PUT' => true,
                    'PATCH' => true,
                    'DELETE' => true,
                ],
            ],
        ],
        'authentication' => [
            'adapters' => [
                'propulsion-systems.basic' => [
                    'adapter' => HttpAdapter::class,
                    'options' => [
                        'accept_schemes' => [
                            0 => 'basic',
                        ],
                        'realm' => 'api',
                        'htpasswd' => '/home/vagrant/Zend/workspaces/DefaultWorkspace/apigility/data/htpasswd',
                    ],
                ],
                'propulsion-systems.oauth2' => [
                    'adapter' => OAuth2Adapter::class,
                    'storage' => [
                        'adapter' => \pdo::class,
                        'dsn' => 'mysql:host=localhost;dbname=oauth2',
                        'route' => '/oauth',
                        'username' => 'vagrant',
                        'password' => 'vagrant',
                        'options' => [
                            1002 => 'SET NAMES utf8',
                        ],
                    ],
                ],
            ],
        ],
    ],
    'db' => [
        'adapters' => [
            \PDO::class => [
                'database' => 'flying_elephant',
                'driver' => 'PDO_Mysql',
                'hostname' => 'localhost',
                'username' => 'vagrant',
                'password' => 'vagrant',
                'driver_options' => [
                    1002 => 'SET NAMES \'UTF8\'',
                ],
            ],
        ],
    ],
];
