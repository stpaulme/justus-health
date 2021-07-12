<?php

/**
 * Taxonomy: Therapist or Intern Type (Group, Individual, Family)
 */

$labels = array(
    'name' => _x('Therapy Types', 'Taxonomy General Name', 'text_domain'),
    'singular_name' => _x('Therapy Type', 'Taxonomy Singular Name', 'text_domain'),
);

$args = array(
    'labels' => $labels,
    'hierarchical' => false,
    'public' => false,
    'show_ui' => true,
    'show_admin_column' => true,
    'show_in_nav_menus' => false,
    'show_tagcloud' => true,
);

register_taxonomy('therapy_type', array('therapist'), $args);

/**
 * Taxonomy: Therapist or Intern Role (Therapist, Intern)
 */

$labels = array(
    'name' => _x('Roles', 'Taxonomy General Name', 'text_domain'),
    'singular_name' => _x('Role', 'Taxonomy Singular Name', 'text_domain'),
);

$args = array(
    'labels' => $labels,
    'hierarchical' => false,
    'public' => false,
    'show_ui' => true,
    'show_admin_column' => true,
    'show_in_nav_menus' => false,
    'show_tagcloud' => true,
);

register_taxonomy('therapist_role', array('therapist'), $args);
