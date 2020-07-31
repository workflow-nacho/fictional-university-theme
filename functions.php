<?php

function university_files() {
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

    if (strstr($_SERVER['SERVER_NAME'], 'fictional-university.test')) {
        wp_enqueue_script('main-university-js', 'http://localhost:3000/bundled.js', NULL, '1.0', true); # This only work in our local machine. Not on a production server.
    } else {
        wp_enqueue_script('our-vendors-js', get_theme_file_uri('/bundled-assets/vendors~scripts.8c97d901916ad616a264.js'), NULL, '1.0', true);
        wp_enqueue_script('main-university-js', get_theme_file_uri('/bundled-assets/scripts.291f4fbd3120f33dcc5a.js'), NULL, '1.0', true);
        wp_enqueue_style('our-main-styles', get_theme_file_uri('/bundled-assets/styles.291f4fbd3120f33dcc5a.css'));
    }
    
}

add_action('wp_enqueue_scripts', 'university_files');

function university_features() {
    #register_nav_menu( 'headerMenuLocation', 'Header Menu Location' );
    add_theme_support( 'title-tag' );
}

add_action('after_setup_theme', 'university_features');
