<?php

acf_register_block_type(array(
  'name' => 'child-pages',
  'title' => __('Child Pages'),
  'render_template' => __DIR__ . '/templates/child-pages.php',
  'supports' => array(
    'align' => false,
  )
));

acf_add_local_field_group(array(
    'key' => 'group_5cd425a9e3cc7',
    'title' => 'Child Pages',
    'fields' => array(
        array(
            'key' => 'field_5cd425c8611c5',
            'label' => 'Parent Page',
            'name' => 'parent',
            'type' => 'post_object',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
                'width' => '',
                'class' => '',
                'id' => '',
            ),
            'post_type' => array(
                0 => 'page',
            ),
            'taxonomy' => '',
            'allow_null' => 1,
            'multiple' => 0,
            'return_format' => 'id',
            'ui' => 1,
        ),
        array(
            'key' => 'field_5cd429c65f675',
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
                'child-pages--card' => 'Card',
                'child-pages--card-with-excerpt' => 'Card with Excerpt',
                'child-pages--text-only' => 'Text Only',
            ),
            'default_value' => array(
                0 => 'child-pages--card',
            ),
            'allow_null' => 0,
            'multiple' => 0,
            'ui' => 0,
            'return_format' => 'value',
            'ajax' => 0,
            'placeholder' => '',
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/child-pages',
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
