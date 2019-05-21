<?php

namespace PlatformCoop\Blocks\ChildPages;

/**
 * Register the Child Pages block.
 *
 * @return null
 */
function register_block()
{
    register_block_type(
        'pcc/child-pages',
        [
            'editor_script' => 'platform-coop-blocks-js',
            'render_callback' => '\\PlatformCoop\\Blocks\\ChildPages\\render_callback',
            'attributes' => [
                'className' => [ 'type' => 'string' ],
                'current' => [ 'type' => 'integer' ],
                'parent' => [ 'type' => 'integer' ],
            ]
        ]
    );
}

/**
 * Render callback for Child Pages block.
 *
 * @param array $attributes The block attributes.
 *
 * @return string
 */
function render_callback($attributes)
{
    if (!isset($attributes['parent'])) {
        $attributes['parent'] = get_the_ID();
    }

    $attributes['exclude'] = get_the_ID();

    $class =
        (isset($attributes['className']) && ! empty($attributes['className'])) ?
        'child-pages ' . $attributes['className'] :
        'child-pages';

    $has_image = isset($attributes['className']) && ! strpos($attributes['className'], 'text-only');
    $has_excerpt = isset($attributes['className']) && strpos($attributes['className'], 'excerpt');

    $children = new \WP_Query([
        'post_type' => 'page',
        'post_parent' => $attributes['parent'],
        'post__not_in' => [ $attributes['exclude'] ],
        'orderby' => 'menu_order',
        'order' => 'asc',
        ]);

    $output = '';
    ob_start();
    if ($children->have_posts()) { ?>
    <ul class="<?php echo $class; ?>">
        <?php while ($children->have_posts()) {
            $children->the_post(); ?>
        <li class="child-pages__child">
    <?php if ($has_image && has_post_thumbnail($children->post)) { ?>
            <figure class="child-pages__image">
            <?php echo get_the_post_thumbnail($children->post, 'social'); ?>
            </figure>
    <?php } ?>
            <div class="child-pages__text">
                <?php if (!$has_excerpt) { ?>
                <p><a href="<?php echo get_the_permalink($children->post) ?>"><?php echo get_the_title(); ?></a></p>
                <?php } else { ?>
                    <h2><?php echo get_the_title(); ?></h2>
                    <?php $excerpt = ($children->post->post_excerpt) ? wpautop($children->post->post_excerpt) : '';
                    echo $excerpt; ?>
                    <div class="wp-block-button is-style-primary">
                        <a class="wp-block-button__link" href="<?php echo get_the_permalink($children->post) ?>">
                            <span class="screen-reader-text"><?php echo get_the_title(); ?> &mdash; </span>
                            <?php _e('Read more', 'platformcoop-support') ?>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </li>
        <?php }
            wp_reset_postdata();
    ?>
        </ul>
    <?php }
    $output .= ob_get_clean();
    return $output;
}
