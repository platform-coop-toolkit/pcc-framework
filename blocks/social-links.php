<?php

acf_register_block_type([
  'name' => 'social-links',
  'title' => __('Social Links'),
  'render_template' => __DIR__ . '/templates/social-links.php',
  'supports' => [
    'align' => false,
  ]
]);
