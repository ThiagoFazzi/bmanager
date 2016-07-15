<?php

namespace Finance;

return array(
	'router' => array(
		'routes' => array(
			'finance' => array(
				'type' => 'Segment',
				'options' => array(
					'route' => '/Finance/[:controller[/:action[/:id]]]',
					'constraints' => array(
						'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'id' => '[0-9]*',
					),
					'defaults' => array(
						'__NAMESPACE__' => 'Finance\Controller',
						'controller' => 'Index',
						'action' => 'index'
					)
				)
			)
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
			'Finance\Controller\Index' => 'Finance\Controller\IndexController',
			'Finance\Controller\Bank' => 'Finance\Controller\BankController',
			'Finance\Controller\Agency' => 'Finance\Controller\AgencyController',
			'Finance\Controller\AccountType' => 'Finance\Controller\AccountTypeController',
			'Finance\Controller\Account' => 'Finance\Controller\AccountController',
			'Finance\Controller\StructureItem' => 'Finance\Controller\StructureItemController',
			'Finance\Controller\Structure' => 'Finance\Controller\StructureController',
		)
	),
	'view_manager' => array(
		'template_path_stack' => array(
			__DIR__ . '/../view/',
		),
		'strategies' => array(
			'ViewJsonStrategy',
		),
	),
	'doctrine' => array(
		'driver' => array(
			'finance_entities' => array(
				'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
				'cache' => 'array',
				'paths' => array(
					__DIR__ . '/../src/Finance/Entity',
				),
			),
			'orm_default' => array(
				'drivers' => array(
					'Finance\Entity' => 'finance_entities'
				)
			)
		),
	)
);