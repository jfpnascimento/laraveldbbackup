<?php


return [

	'path' => storage_path() . '/dumps/',

	'mysql' => [
		'dump_command_path' => '',//local do driver do mysql
		'restore_command_path' => '',//local do driver do mysql
	],

	's3' => [
		'path' => ''
	],

    'compress' => false,
];

