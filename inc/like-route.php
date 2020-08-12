<?php

add_action('rest_api_init', 'universityLikeRoutes');

if (!function_exists('universityLikeRoutes')) {
    function universityLikeRoutes () {
        register_rest_route( 'university/v1', 'manageLike', array(
            'methods' => 'POST',
            'callback' => 'createLike'
        ) );

        register_rest_route( 'university/v1', 'manageLike', array(
            'methods' => 'DELETE',
            'callback' => 'deleteLike'
        ) );
    }
}

function createLike() {
    return 'Thanks for trying to CREATE a like';
}

function deleteLike() {
    return 'Thanks for trying to DELETE a like';
}