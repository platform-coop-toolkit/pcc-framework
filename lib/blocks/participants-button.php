<?php

namespace PCCFramework\Blocks\ParticipantsButton;

/**
 * Register the Social Links block.
 *
 * @return null
 */
function register_block()
{
    register_block_type(
        'pcc/participants-button',
        [
            'editor_script' => 'platform-coop-blocks-js',
            'render_callback' => '\\PCCFramework\\Blocks\\ParticipantsButton\\render_callback',
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
        __('View all participants', 'pcc-framework');

    ob_start();
?>
    <div class="wp-block-button">
        <a class="wp-block-button__link" href="<?= get_permalink() . 'participants/' ?>"><?= $label ?></a>
    </div>
<?php
    $output = ob_get_clean();
    return $output;
}
