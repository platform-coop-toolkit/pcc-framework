<?php

namespace PCCFramework\Blocks\ProgramButton;

/**
 * Register the Social Links block.
 *
 * @return null
 */
function register_block()
{
    register_block_type(
        'pcc/program-button',
        [
            'editor_script' => 'platform-coop-blocks-js',
            'render_callback' => '\\PCCFramework\\Blocks\\ProgramButton\\render_callback',
            'attributes' => [
                'label' => [ 'type' => 'string' ],
            ]
        ]
    );
}

/**
 * Render callback for Social Links block.
 *
 * @param array $attributes The block attributes.
 *
 * @return string
 */
function render_callback($attributes)
{
    $label = ( isset($attributes['label']) && ! empty($attributes['label']) ) ?
        $attributes['label'] :
        __('See the full program', 'pcc-framework');

    ob_start();
?>
    <div class="wp-block-button">
        <a class="wp-block-button__link" href="<?= get_permalink() . 'program/' ?>"><?= $label ?></a>
    </div>
<?php
    $output = ob_get_clean();
    return $output;
}
