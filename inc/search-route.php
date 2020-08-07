<?php

add_action('rest_api_init', 'universityRegisterSearch');

// Creating the route: http://fictional-university.test/wp-json/university/v1/search
if (!function_exists('universityRegisterSearch')) {
    function universityRegisterSearch () {
        register_rest_route( 'university/v1', 'search', array(
            'methods' => WP_REST_SERVER::READABLE,
            'callback' => 'universitySearchResults' 
        ) );
    }
}

if (!function_exists('universitySearchResults')) {
    function universitySearchResults () {
        return 'Congratulations, you created a route.';
    }
}