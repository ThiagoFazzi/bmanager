<?php

namespace Bmanager;

return array(	
	'router' => array(
		'routes' => array(
			'application' => array(
				'type' => 'Segment',
				'options' => array(
					'route' => '/[:controller[/:action[/:id]]]',
					'constraints' => array(
						'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'id' => '[0-9]*',
					),
					'defaults' => array(
						'__NAMESPACE__' => 'Bmanager\Controller',
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
			'Bmanager\Controller\Index' => 'Bmanager\Controller\IndexController',
			'Bmanager\Controller\User' => 'Bmanager\Controller\UserController',
			'Bmanager\Controller\Company' => 'Bmanager\Controller\CompanyController',
		)
	),
	'view_manager' => array(
		'template_path_stack' => array(
			__DIR__ . '/../view/',
		),
		'template_map' => array(
            'layout/layout'           => __DIR__ . './../view/layout/layout.phtml',
        ),
	),
	'view_helpers' => array(
		'invokables' => array(
			'FlashHelper' => 'Bmanager\View\Helper\FlashHelper',
			#'PaginationHelper' => 'Bmanager\View\Helper\PaginationHelper'
		)
	),
	'doctrine' => array(
		'driver' => array(
			'bmanager_entities' => array(
				'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
				'cache' => 'array',
				'paths' => array(
					__DIR__ . '/../src/Bmanager/Entity',
				),
			),
			'orm_default' => array(
				'drivers' => array(
					'Bmanager\Entity' => 'bmanager_entities'
				)
			)
		),
		'authentication' => array(
			'orm_default' => array(
				'object_manager'		=> 	'Doctrine\ORM\EntityManager',
				'identity_class' 		=> 	'Bmanager\Entity\User',
				'identity_property' 	=> 	'userName',
				'credential_property' 	=> 	'password',
				'credentialCallable' 	=> 	function($user,$password) {
					return $user->getPassword() == md5($password);
				}
			)
		)
	)	
);