<?php

acf_register_block_type([
  'name' => 'social-list',
  'title' => __('Social List'),
  'render_template' => __DIR__ . '/templates/social-list.php',
  'supports' => [
    'align' => false,
  ]
]);
