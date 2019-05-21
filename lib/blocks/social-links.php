<?php

namespace PlatformCoop\Blocks\SocialLinks;

/**
 * Register the Social Links block.
 *
 * @return null
 */
function register_block()
{
    register_block_type(
        'pcc/social-links',
        [
            'editor_script' => 'platform-coop-blocks-js',
            'render_callback' => '\\PlatformCoop\\Blocks\\SocialLinks\\render_callback',
            'attributes' => [
                'className' => [ 'type' => 'string' ],
                'label_facebook' => [ 'type' => 'string' ],
                'label_twitter' => [ 'type' => 'string' ],
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
    $class =
        ( isset($attributes['className']) && ! empty($attributes['className']) ) ?
        'social-links ' . $attributes['className'] :
        'social-links';
    $options = get_option('the_seo_framework_site_options');
    $social = [
        'facebook' => [
            'label' =>
                ( isset($attributes['label_facebook']) && ! empty($attributes['label_facebook']) ) ?
                $attributes['label_facebook'] :
                __('Platform Cooperativism – Discussion & Linkshare', 'platformcoop-support'),
            'url' => $options['knowledge_facebook'] ?? 'https://www.facebook.com/groups/1487620331468306/',
            'icon' => '<svg class="social-links__icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 35 35"><path fill="currentColor" d="M18.03,31.02h3.934V21.5h2.624l.348-3.281H21.964l0-1.643c0-.855.082-1.314,1.309-1.314h1.64V11.98H22.292c-3.153,0-4.262,1.592-4.262,4.268v1.97H16.064V21.5H18.03ZM20.5,39A17.5,17.5,0,1,1,38,21.5,17.5,17.5,0,0,1,20.5,39Z" transform="translate(-3 -4)" fill-rule="evenodd"></path></svg>', // @codingStandardsIgnoreLine
        ],
        'twitter' => [
            'label' =>
                ( isset($attributes['label_twitter']) && ! empty($attributes['label_twitter']) ) ?
                $attributes['label_twitter'] :
                __('Platform Co-op Development Kit', 'platformcoop-support'),
            'url' => $options['knowledge_twitter'] ?? 'https://twitter.com/platformcoop/',
            'icon' => '<svg class="social-links_icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 35 35"><path fill="currentColor" d="M21.224,5.157a17.5,17.5,0,1,0,17.5,17.5A17.5,17.5,0,0,0,21.224,5.157Zm8.815,13.972c.009.189.013.379.013.571A12.544,12.544,0,0,1,10.743,30.267a9.019,9.019,0,0,0,1.052.061,8.848,8.848,0,0,0,5.477-1.888,4.417,4.417,0,0,1-4.119-3.064,4.307,4.307,0,0,0,.829.079,4.383,4.383,0,0,0,1.162-.154,4.414,4.414,0,0,1-3.539-4.324c0-.019,0-.038,0-.057a4.4,4.4,0,0,0,2,.552,4.416,4.416,0,0,1-1.365-5.889,12.521,12.521,0,0,0,9.091,4.607,4.413,4.413,0,0,1,7.515-4.022,8.809,8.809,0,0,0,2.8-1.07,4.423,4.423,0,0,1-1.94,2.44,8.817,8.817,0,0,0,2.534-.694A8.91,8.91,0,0,1,30.039,19.129Z" transform="translate(-3.723 -5.157)"></path></svg>', // @codingStandardsIgnoreLine
        ],
    ];
    ob_start();
?>
    <ul class="<?php echo $class; ?>">
    <?php foreach ($social as $network) { ?>
    <li class="social-links__item">
        <a class="social-links__link" rel="external" href="<?php echo $network['url']; ?>">
            <?php echo $network['icon']; ?>
            <span class="social-links__link"><?php echo $network['label']; ?></span>
        </a>
    </li>
    <?php } ?>
</ul>
<?php
    $output = ob_get_clean();
    return $output;
}
