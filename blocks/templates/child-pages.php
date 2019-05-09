<?php

/**
 * Testimonial Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

global $post;

// Create id attribute allowing for custom "anchor" value.
$id = 'child-pages-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Load values and assing defaults.
$parent = get_field('parent') ?: get_the_id();
$style = get_field('style') ?: 'child-pages--card';

// Create class attribute allowing for custom "className" and "align" values.
$className = "child-pages $style";
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

?>
<ul id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
	<?php
	$children = new WP_Query( array(
		'post_type' => 'page',
		'post_parent' => $parent,
		'post__not_in' => [ $post->ID ],
		'orderby' => 'menu_order',
		'order' => 'asc',
	) );

    if ( $children->have_posts() ) {
		while( $children->have_posts() ) {
			$children->the_post();
			ob_start(); ?>
			<li class="child-pages__child">
			<?php if ( $style !== 'child-pages--text-only' && has_post_thumbnail($children->post) ) { ?>
				<figure class="child-pages__image">
				<?php echo get_the_post_thumbnail($children->post, 'social'); ?>
				</figure>
			<?php } ?>
				<div class="child-pages__text">
					<?php if ( $style !== 'child-pages--card-with-excerpt' ) { ?>
					<p><a href="<?php echo get_the_permalink($children->post) ?>"><?php echo get_the_title(); ?></a></p>
					<?php } else { ?>
						<h2><?php echo get_the_title(); ?></h2>
						<?php if ( $children->post->post_excerpt ) {
							echo wpautop( $children->post->post_excerpt );
						} ?>
						<div class="wp-block-button is-style-primary">
							<a class="wp-block-button__link" href="<?php echo get_the_permalink($children->post) ?>">
								<span class="screen-reader-text"><?php echo get_the_title(); ?> &mdash; </span>
								<?php _e('Read more', 'platformcoop-support') ?>
							</a>
						</div>
					<?php } ?>
				</div>
			</li>
			<?php $content .= ob_get_clean();
		}
	}

	wp_reset_postdata();

	echo $content; ?>
</ul>
