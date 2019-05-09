<?php

acf_register_block_type([
	'name' => 'child-pages',
	'title' => __('Child Pages'),
	'render_template' => __DIR__ . '/templates/child-pages.php',
	'supports' => [
		'align' => false,
	]
]);
