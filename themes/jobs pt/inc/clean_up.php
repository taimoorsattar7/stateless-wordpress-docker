<?php

global $allowedtags;

unset($allowedtags['cite']);
unset($allowedtags['q']);
unset($allowedtags['del']);
unset($allowedtags['abbr']);
unset($allowedtags['acronym']);

function clean_up () {
    remove_action('wp_head', 'wp_generator');                // #1
    remove_action('wp_head', 'wlwmanifest_link');            // #2
    remove_action('wp_head', 'rsd_link');                    // #3
    remove_action('wp_head', 'wp_shortlink_wp_head');        // #4

    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);    // #5

    add_filter('the_generator', '__return_false');            // #6
    add_filter('show_admin_bar','__return_false');            // #7

    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );  // #8
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
}
add_action('after_setup_theme', 'clean_up');

remove_action('set_comment_cookies', 'wp_set_comment_cookies');



add_theme_support('html5',
    array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption', 'widgets')
);



function cubiq_template_redirect () {
    global $wp_query, $post;

    if ( is_attachment() ) {
        $post_parent = $post->post_parent;

        if ( $post_parent ) {
            wp_redirect( get_permalink($post->post_parent), 301 );
            exit;
        }

        $wp_query->set_404();

        return;
    }

    if ( is_author() || is_date() ) {
        $wp_query->set_404();
    }
}
add_action( 'template_redirect', 'cubiq_template_redirect' );


/**
 * Disable the Visual and Text Editor p and br tag modifications when saving
 * 
 * When you call the editor, it will automatically add a filter depending
 * on which editor you have open:
 * * Text Editor: add_filter('the_editor_content', 'wp_htmledit_pre');
 * * Visual Editor: add_filter('the_editor_content', 'wp_richedit_pre');
 * 
 * The only way to stop this is to remove the filter because it's applied.
 * The next call after is do_action( 'media_buttons', $editor_id );
 * So to remove this, we want to add an action to the media_buttons
 * that removes the filters.
 * 
 * You can see which filters are loaded using: global $wp_filter;
 */
function skl_disable_wp_editor_formatting() {
    remove_filter('the_editor_content', 'wp_htmledit_pre');
    remove_filter('the_editor_content', 'wp_richedit_pre');
}
add_action( 'media_buttons', 'skl_disable_wp_editor_formatting');

/**
 * Disable the editor p and br tag modifications when switching
 * back and forth between the Visual and Text tabs
 */
function skl_disable_mce_cleanup(array $init) {
    $init = array_merge($init, array(
        'convert_fonts_to_spans' => false,
        'verify_html' => false,
        'fix_list_elements' => false,
        'forced_root_block' => false,
        'invalid_elements' => '',
        'invalid_styles' => '',
        'keep_styles' => false,
    ));
    
    return $init;
}
add_action( 'tiny_mce_before_init', 'skl_disable_mce_cleanup');


function override_mce_options($initArray) {
    $opts = '*[*]';
    $initArray['valid_elements'] = $opts;
    $initArray['extended_valid_elements'] = $opts;
    return $initArray;
}
add_filter('tiny_mce_before_init', 'override_mce_options');