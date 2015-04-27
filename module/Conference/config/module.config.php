<?php

return array(
    'controllers' => array(
        /*
        'invokables' => array(
            'Conference\Controller\Conference' => \Conference\Controller\ConferenceController::class,
            'Conference\Controller\Lieu' => \Conference\Controller\LieuController::class,
        ),
        */
        'factories' => array(
            'Conference\Controller\Conference' => function($cm) {
                // cm => Controller Manager
                // sm => Service Manager
                $sm = $cm->getServiceLocator();
                $conferenceService = $sm->get('Conference\Service\Conference');
                // Rajout de lieuService : ajout d'un lieu lors de la création d'un service
                $lieuService = $sm->get('Conference\Service\Lieu');
                
                // Ajout de lieuService dans le return afin d'être utiliser dans le constructuer de ConferenceController
                return new Conference\Controller\ConferenceController($conferenceService, $lieuService);
            },
            'Conference\Controller\Lieu' => function($cm) {
                // cm => Controller Manager
                // sm => Service Manager
                $sm = $cm->getServiceLocator();
                $lieuService = $sm->get('Conference\Service\Lieu');
                
                return new Conference\Controller\LieuController($lieuService);
            },
        ),
    ),
    'router' => array(
        'routes' => array(
            /*
            'home' => array(
                'type' => \Zend\Mvc\Router\Http\Literal::class,
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'Conference\Controller\Conference',
                        'action' => 'list',
                    ),
                ),
            ),
            */
            'conference' => array(
                'type' => \Zend\Mvc\Router\Http\Literal::class,
                'options' => array(
                    'route' => '/conference',
                    'defaults' => array(
                        'controller' => 'Conference\Controller\Conference',
                        'action' => 'list',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'add' => array(
                        'type' => \Zend\Mvc\Router\Http\Literal::class,
                        'options' => array(
                            'route' => '/add',
                            'defaults' => array(
                                'action' => 'add',
                            ),
                        ),
                    ),
                    'show' => array(
                        'type' => Zend\Mvc\Router\Http\Segment::class,
                        'options' => array(
                            'route' => '/show/:id',
                            'defaults' => array(
                                'action' => 'show',
                            ),
                            'constraints' => array(
                                'id' => '[1-9][0-9]*'
                            ),
                        ),
                    ),
                    'update' => array(
                        'type' => Zend\Mvc\Router\Http\Segment::class,
                        'options' => array(
                            'route' => '/update/:id',
                            'defaults' => array(
                                'action' => 'update',
                            ),
                            'constraints' => array(
                                'id' => '[1-9][0-9]*'
                            ),
                        ),
                    ),
                    'delete' => array(
                        'type' => Zend\Mvc\Router\Http\Segment::class,
                        'options' => array(
                            'route' => '/delete/:id',
                            'defaults' => array(
                                'action' => 'delete',
                            ),
                            'constraints' => array(
                                'id' => '[1-9][0-9]*'
                            ),
                        ),
                    ),
                ),
            ),
            'lieu' => array(
                'type' => \Zend\Mvc\Router\Http\Literal::class,
                'options' => array(
                    'route' => '/lieu',
                    'defaults' => array(
                        'controller' => 'Conference\Controller\Lieu',
                        'action' => 'list',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'add' => array(
                        'type' => \Zend\Mvc\Router\Http\Literal::class,
                        'options' => array(
                            'route' => '/add',
                            'defaults' => array(
                                'action' => 'add',
                            ),
                        ),
                    ),
                    'show' => array(
                        'type' => Zend\Mvc\Router\Http\Segment::class,
                        'options' => array(
                            'route' => '/show/:id',
                            'defaults' => array(
                                'action' => 'show',
                            ),
                            'constraints' => array(
                                'id' => '[1-9][0-9]*'
                            ),
                        ),
                    ),
                    'update' => array(
                        'type' => Zend\Mvc\Router\Http\Segment::class,
                        'options' => array(
                            'route' => '/update/:id',
                            'defaults' => array(
                                'action' => 'update',
                            ),
                            'constraints' => array(
                                'id' => '[1-9][0-9]*'
                            ),
                        ),
                    ),
                    'delete' => array(
                        'type' => Zend\Mvc\Router\Http\Segment::class,
                        'options' => array(
                            'route' => '/delete/:id',
                            'defaults' => array(
                                'action' => 'delete',
                            ),
                            'constraints' => array(
                                'id' => '[1-9][0-9]*'
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            // defines an annotation driver with two paths, and names it `my_annotation_driver`
            'my_annotation_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__.'/../src/Conference/Entity',
                ),
            ),
            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default' => array(
                'drivers' => array(
                    // register `my_annotation_driver` for any entity under namespace `My\Namespace`
                    'Conference\Entity' => 'my_annotation_driver'
                ),
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'Conference\Service\Conference' => function($sm) {
                
                $om = $sm->get('Doctrine\ORM\EntityManager');
                $service = new \Conference\Service\ConferenceService($om);
        
                return $service;
            },
            'Conference\Service\Lieu' => function($sm) {
                
                $om = $sm->get('Doctrine\ORM\EntityManager');
                $service = new \Conference\Service\LieuService($om);
        
                return $service;
            },
        ),
    ),
);

