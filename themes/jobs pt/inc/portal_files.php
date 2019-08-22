<?php

add_action('wp_enqueue_scripts', 'portal_files');

function portal_files() {
  
wp_enqueue_script('main-portal-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, '1.0', true);
wp_enqueue_style('portal_main_styles', get_stylesheet_uri(),NULL,microtime());
  


wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');


wp_enqueue_style( 'custom-font', "//fonts.googleapis.com/css?family=Merriweather:300,400,700,900");


wp_localize_script('main-portal-js', 'portalData', array(
    'root_url' => get_site_url(),
    'nonce' => wp_create_nonce('wp_rest')
  ));
}

