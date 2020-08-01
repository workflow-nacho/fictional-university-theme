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

/**
 * Custom Query - To set or adjust the query before WP load the default query.
 */
if (!function_exists('university_adjust_queries')) {
    function university_adjust_queries($query) {
        /**
         *  Custom Query: CPT Program
         */
        if (!is_admin() AND is_post_type_archive('program') AND $query->is_main_query()) {
            $query->set('posts_per_page', -1);
            $query->set('orderby', 'title');
            $query->set('order', 'ASC');
        }

        /**
         *  Custom Query: CPT Event
         */
        if(!is_admin() AND is_post_type_archive('event') AND $query->is_main_query()) {
            $today = date('Ymd');
            $query->set('meta_key', 'event_date');
            $query->set('orderby', 'meta_value_num');
            $query->set('order', 'ASC');
            $query->set('meta_query', array(
                array(
                    'key' => 'event_date',
                    'compare' => '>=',
                    'value' => $today,
                    'type' => 'numeric'
                )
            ));
        }
    }
}

add_action('pre_get_posts', 'university_adjust_queries');