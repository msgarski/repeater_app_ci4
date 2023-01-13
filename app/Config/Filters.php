<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Filters\CSRF;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\Filters\Honeypot;
use App\Filters\JWTAuthenticationFilter;


class Filters extends BaseConfig
{
	/**
	 * Configures aliases for Filter classes to
	 * make reading things nicer and simpler.
	 *
	 * @var array
	 */
	public $aliases = [
		'csrf'     	=> CSRF::class,
		'toolbar'  	=> DebugToolbar::class,
		'honeypot' 	=> Honeypot::class,
		'cors'     	=> \App\Filters\Cors::class,
		'auth'		=> JWTAuthenticationFilter::class,
	];

	/**
	 * List of filter aliases that are always
	 * applied before and after every request.
	 *
	 * @var array
	 */
	public $globals = [
		'before' => [
			'cors',
			//'auth'
			// 'honeypot',
			// 'csrf',
		],
		'after'  => [
			//'toolbar',
			// 'honeypot',
		],
	];

	/**
	 * List of filter aliases that works on a
	 * particular HTTP method (GET, POST, etc.).
	 *
	 * Example:
	 * 'post' => ['csrf', 'throttle']
	 *
	 * @var array
	 */
	public $methods = [
		
	];

	/**
	 * List of filter aliases that should run on any
	 * before or after URI patterns.
	 *
	 * Example:
	 * 'isLoggedIn' => ['before' => ['account/*', 'profiles/*']]
	 *
	 * @var array
	 */
	 public $filters = [
		'before' => [
			'auth' => [
				'except' => [
					'signup/*',
					'signup',
					'password/*',
					'password',
					'login/*',
					'login'
				]
			]
		],
		'after'  => [],	
	];
}


// 	public $filters = [
// 		'guest'		=>	[
// 			'password/*'
// 		],
// 		'auth' => [
// 			'before'=>	[
// 				'except' => [
// 					'signup/*',
// 					'signup',
// 					'password/*',
// 					'password',
// 					'login/*',
// 					'login'
// 				]
// 			],
// 		]
// 	];
// }

// 'before' => [
// 	'signup/*',
// 	'signup'
// ],
