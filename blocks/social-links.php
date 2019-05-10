<?php

acf_register_block_type(array(
  'name' => 'social-links',
  'title' => __('Social Links'),
  'render_template' => __DIR__ . '/templates/social-links.php',
  'supports' => array(
    'align' => false,
  )
));

acf_add_local_field_group(array(
    'key' => 'group_5cd580fbefcbd',
    'title' => 'Social Links',
    'fields' => array(
        array(
            'key' => 'field_5cd58100e5b2b',
            'label' => 'Style',
            'name' => 'style',
            'type' => 'select',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'choices' => array(
                'default' => 'Default',
                'icon-only' => 'Icon Only',
            ),
            'default_value' => array(
                0 => 'default',
            ),
            'allow_null' => 0,
            'multiple' => 0,
            'ui' => 0,
            'return_format' => 'value',
            'ajax' => 0,
            'placeholder' => '',
        ),
        array(
            'key' => 'field_5cd582a254dc7',
            'label' => 'Facebook Label',
            'name' => 'label_facebook',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => 'Platform Cooperativism – Discussion & Linkshare',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
        ),
        array(
            'key' => 'field_5cd582e554dc8',
            'label' => 'Twitter Label',
            'name' => 'label_twitter',
            'type' => 'text',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'default_value' => 'Platform Co-op Development Kit',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/social-links',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
));
