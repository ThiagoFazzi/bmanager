<?php
namespace Budget;

return array(
	'router' => array(
		'routes' => array(
			'budget' => array(
				'type' => 'Segment',
				'options' => array(
					'route' => '/Budget/[:controller[/:action[/:id]]]',
					'constraints' => array(
						'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'id' => '[0-9]*',
					),
					'defaults' => array(
						'__NAMESPACE__' => 'Budget\Controller',
						'controller' => 'Index',
						'action' => 'index'
					)
				)
			)
		)
	),
	'controllers' => array(
		'invokables' => array(
			'Budget\Controller\Index' => 'Budget\Controller\IndexController'
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

);