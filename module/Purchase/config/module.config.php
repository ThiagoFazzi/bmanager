<?php

namespace Purchase;

return array(	
	'router' => array(
		'routes' => array(
			'purchase' => array(
				'type' => 'Segment',
				'options' => array(
					'route' => '/Purchase/[:controller[/:action[/:id]]]',
					'constraints' => array(
						'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'id' => '[0-9]*',
					),
					'defaults' => array(
						'__NAMESPACE__' => 'Purchase\Controller',
						'controller' => 'Index',
						'action' => 'index'
					)
				)
			),
			/*'produtos' => array(
				'type' => 'Segment',
				'options' => array(
					'route' => '/Produtos[/:page]',
					'constraints' => array(
						'page' => '[0-9]*',
					),
					'defaults' => array(
						'__NAMESPACE__' => 'Estoque\Controller',
						'controller' => 'Index',
						'action' => 'index',
						'page' => 1
					)
				)
			),*/						
		)
	),
	'controllers' => array(
		'invokables' => array(
			'Purchase\Controller\Index' => 'Purchase\Controller\IndexController',
			'Purchase\Controller\Provider' => 'Purchase\Controller\ProviderController',
		)
	),
	'view_manager' => array(
		'template_path_stack' => array(
			__DIR__ . '/../view/',
		),
	),
	'doctrine' => array(
		'driver' => array(
			'purchase_entities' => array(
				'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
				'cache' => 'array',
				'paths' => array(
					__DIR__ . '/../src/Purchase/Entity',
				),
			),
			'orm_default' => array(
				'drivers' => array(
					'Purchase\Entity' => 'purchase_entities'
				)
			)
		),
	)	
);