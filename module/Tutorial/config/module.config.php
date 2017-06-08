<?php

namespace Tutorial;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\Router\Http\Regex;
use Zend\Router\Http\Method;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'tutorial' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/tutorial',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'example' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/example',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'example',
                    ],
                ],
            ],
            /*'sample' => [
                'type' => Regex::class,
                'options' => [
                    'regex'  => '/sample/(?<slug>[a-z]*)/(?<id>[0-9]+)',
                    'spec'   => '%slug%%id%',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'sample',
                    ],
                ],
            ],*/
            'sample' => [
                'type' => Segment::class,
                'options' => [
                    'route'  => '/sample[/:slug[/:id]]',
                    'constraints' => [
                        'slug' => '[a-z0-9]*',
                        'id'   => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        //'action'     => 'sample',
                        'action'     => rand(0, 1) ? 'foo' : 'bar',
                    ],
                ],
            ],
            'article' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/article',
                    'defaults' => [
                        'controller' => Controller\ArticleController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
            ],
            'articleAction' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/article/edit[/:id]',
                    'constraints'    => [
                        'action' => '[a-z-]*',
                        'id' => '[0-9]+',
                    ],
                ],
                'child_routes' => [
                    'get' => [
                        'type' => Method::class,
                        'options' => [
                            'verb'    => 'get',
                            'defaults' => [
                                'controller' => Controller\ArticleController::class,
                                'action'     => 'edit',
                            ],
                        ],
                    ],
                    'post' => [
                        'type' => Method::class,
                        'options' => [
                            'verb'    => 'post',
                            'defaults' => [
                                'controller' => Controller\ArticleController::class,
                                'action'     => 'post',
                            ],
                        ],
                    ],
                ],
            ],
            'product' => [
                'type' => Segment::class,
                'options' => [
                    'route'    => '/product',
                    'defaults' => [
                        'controller' => Controller\ProductController::class,
                        'action'     => 'index',
                    ],
                ],
                //'may_terminate' => true,
            ],
            'productEditAction' => [
                'type' => Segment::class,
                'options' => [
                    //'route'    => '/product[/:action[/:id]]',
                    'route'    => '/product/edit[/:id]',
                    'constraints' => [
                        'id'     => '[0-9]+',
                    ],
                ],
                'child_routes' => [
                    'get' => [
                        'type' => Method::class,
                        'options' => [
                            'verb'    => 'get',
                            'defaults' => [
                                'controller' => Controller\ProductController::class,
                                'action'     => 'edit',
                            ],
                        ],
                    ],
                    'post' => [
                        'type' => Method::class,
                        'options' => [
                            'verb'    => 'post',
                            'defaults' => [
                                'controller' => Controller\ProductController::class,
                                'action'     => 'editPost',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            //Controller\IndexController::class => InvokableFactory::class,
            Controller\ArticleController::class => InvokableFactory::class,
            Controller\ProductController::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'tutorial/index/index' => __DIR__ . '/../view/tutorial/index/index.phtml',
            'error/404'            => __DIR__ . '/../view/error/404.phtml',
            'error/index'          => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
