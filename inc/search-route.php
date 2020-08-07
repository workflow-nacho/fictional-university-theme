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
    function universitySearchResults ($data) {
        $professor = new WP_Query(array(
            'post_type' => 'professor',
            's' => sanitize_text_field($data['term'])
        ));

        $professorResults = array();

        while($professor->have_posts()) {
            $professor->the_post();
            array_push($professorResults, array(
                'title' => get_the_title(),
                'permalink' => get_the_permalink()
            ));
        }

        return $professorResults;
    }
}