<?php

/**
 * Post Type: Counselors.
 */

$labels = array(
    "name" => __("Counselors", "custom-post-type-ui"),
    "singular_name" => __("Counselor", "custom-post-type-ui"),
    "menu_name" => __("Counselors", "custom-post-type-ui"),
);

$args = array(
    "label" => __("Counselors", "custom-post-type-ui"),
    "labels" => $labels,
    "description" => "",
    "public" => true,
    "publicly_queryable" => false,
    "show_ui" => true,
    "delete_with_user" => false,
    "show_in_rest" => true,
    "rest_base" => "",
    "rest_controller_class" => "WP_REST_Posts_Controller",
    "has_archive" => false,
    "show_in_menu" => true,
    "show_in_nav_menus" => false,
    "exclude_from_search" => true,
    "capability_type" => "page",
    "map_meta_cap" => true,
    "hierarchical" => false,
    "show_in_admin_bar" => false,
    "query_var" => false,
    "menu_icon" => "dashicons-groups",
    "supports" => array("title", "editor", "thumbnail", "page-attributes"),
);

register_post_type("counselor", $args);

/**
 * Post Type: Therapists.
 */

$labels = array(
    "name" => __("Therapists & Interns", "custom-post-type-ui"),
    "singular_name" => __("Therapist or Intern", "custom-post-type-ui"),
    "menu_name" => __("Therapists & Interns", "custom-post-type-ui"),
);

$args = array(
    "label" => __("Therapists & Interns", "custom-post-type-ui"),
    "labels" => $labels,
    "description" => "",
    "public" => true,
    "publicly_queryable" => true,
    "show_ui" => true,
    "delete_with_user" => false,
    "show_in_rest" => true,
    "rest_base" => "",
    "rest_controller_class" => "WP_REST_Posts_Controller",
    "has_archive" => false,
    "show_in_menu" => true,
    "show_in_nav_menus" => true,
    "exclude_from_search" => false,
    "capability_type" => "page",
    "map_meta_cap" => true,
    "hierarchical" => false,
    "rewrite" => array("slug" => "therapy-counseling/therapy/our-therapists", "with_front" => false),
    "query_var" => true,
    "menu_icon" => "dashicons-groups",
    "supports" => array("title", "editor", "thumbnail", "page-attributes"),
);

register_post_type("therapist", $args);
