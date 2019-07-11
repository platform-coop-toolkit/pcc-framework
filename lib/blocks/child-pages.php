<?php

namespace PCCFramework\Blocks\ChildPages;

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
            'render_callback' => '\\PCCFramework\\Blocks\\ChildPages\\render_callback',
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
    <?php } else { ?>
            <figure class="child-pages__image">
                <div class="child-pages__placeholder-wrap">
                    <svg class="child-pages__placeholder" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 78.76 78.76">
                        <defs>
                            <style>
                                .stroke{fill:none;stroke:currentColor;stroke-miterlimit:10;stroke-width:2px}
                                .fill{fill:currentColor;}
                            </style>
                        </defs>
                        <path class="stroke" d="M39.38 55.13l-18-51.75-18 51.75h12.37v20.25H27V55.13z"/>
                        <path class="stroke" d="M75.38 55.13l-18-51.75-18 51.75h12.37v20.25H63V55.13z"/>
                        <circle class="fill" cx="21.38" cy="3.38" r="3.38"/>
                        <circle class="fill" cx="57.38" cy="3.38" r="3.38"/>
                        <circle class="fill" cx="39.38" cy="55.13" r="3.38"/>
                        <circle class="fill" cx="51.75" cy="55.13" r="3.38"/>
                        <circle class="fill" cx="63" cy="55.13" r="3.38"/>
                        <circle class="fill" cx="3.38" cy="55.13" r="3.38"/>
                        <circle class="fill" cx="15.75" cy="55.13" r="3.38"/>
                        <circle class="fill" cx="27" cy="55.13" r="3.38"/>
                        <circle class="fill" cx="51.75" cy="75.38" r="3.38"/>
                        <circle class="fill" cx="63" cy="75.38" r="3.38"/>
                        <circle class="fill" cx="15.75" cy="75.38" r="3.38"/>
                        <circle class="fill" cx="27" cy="75.38" r="3.38"/>
                        <circle class="fill" class="fill" cx="75.38" cy="55.13" r="3.38"/>
                    </svg>
                </div>
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
                            <?php _e('Read more', 'pcc-framework') ?>
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
