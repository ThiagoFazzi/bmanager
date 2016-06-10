<?php
namespace Budget;

return array(
	'router' => array(
		'routes' => array(
			'commercial' => array(
				'type' => 'Segment',
				'options' => array(
					'route' => '/Commercial/[:controller[/:action[/:id]]]',
					'constraints' => array(
						'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'id' => '[0-9]*',
					),
					'defaults' => array(
						'__NAMESPACE__' => 'Commercial\Controller',
						'controller' => 'Index',
						'action' => 'index'
					)
				)
			)
		)
	),
	'controllers' => array(
		'invokables' => array(
			'Commercial\Controller\Index' => 'Commercial\Controller\IndexController',
			'Commercial\Controller\Budget' => 'Commercial\Controller\BudgetController',
		)
	),
	'view_manager' => array(
		'template_path_stack' => array(
			__DIR__ . '/../view/',
		),
		#'template_map' => array(
        #    'layout/layout'           => __DIR__ . './../view/layout/layout.phtml',
        #),
	),
	'doctrine' => array(
		'driver' => array(
			'commercial_entities' => array(
				'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
				'cache' => 'array',
				'paths' => array(
					__DIR__ . '/../src/Commercial/Entity',
				),	
			),
			'orm_default' => array(
				'drivers' => array(
					'Commercial\Entity' => "commercial_entities"
				)
			)
		),
	)
);