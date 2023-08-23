<?php

/**
 * Taxonomy: Article Category
 */

$labels = array(
    "name" => _x("Article Categories", "Taxonomy General Name", "justus-health"),
    "singular_name" => _x("Article Category", "Taxonomy Singular Name", "justus-health"),
);

$args = array(
    "hierarchical" => false,
    "meta_box_cb" => "post_categories_meta_box",
    "public" => false,
    "show_admin_column" => true,
    "show_in_nav_menus" => false,
    "show_in_quick_edit" => true,
    "show_ui" => true,
    "show_ui" => true,
    "labels" => $labels,
);

register_taxonomy("article_category", array("article"), $args);

/**
 * Taxonomy: Provider Area
 */

$labels = array(
    "name" => _x("Areas", "Taxonomy General Name", "justus-health"),
    "singular_name" => _x("Area", "Taxonomy Singular Name", "justus-health"),
);

$args = array(
    "hierarchical" => false,
    "meta_box_cb" => false,
    "public" => false,
    "show_admin_column" => true,
    "show_in_nav_menus" => false,
    "show_in_quick_edit" => false,
    "show_ui" => true,
    "show_ui" => true,
    "labels" => $labels,
);

register_taxonomy("provider_area", array("provider"), $args);

/**
 * Taxonomy: Provider Type
 */

$labels = array(
    "name" => _x("Types", "Taxonomy General Name", "justus-health"),
    "singular_name" => _x("Type", "Taxonomy Singular Name", "justus-health"),
);

$args = array(
    "hierarchical" => false,
    "meta_box_cb" => false,
    "public" => false,
    "show_admin_column" => true,
    "show_in_nav_menus" => false,
    "show_in_quick_edit" => false,
    "show_ui" => true,
    "show_ui" => true,
    "labels" => $labels,
);

register_taxonomy("provider_type", array("provider"), $args);

/**
 * Taxonomy: Provider Service Category
 */

$labels = array(
    "name" => _x("Service Categories", "Taxonomy General Name", "justus-health"),
    "singular_name" => _x("Service Category", "Taxonomy Singular Name", "justus-health"),
);

$args = array(
    "hierarchical" => false,
    "meta_box_cb" => false,
    "public" => false,
    "show_admin_column" => true,
    "show_in_nav_menus" => false,
    "show_in_quick_edit" => false,
    "show_ui" => true,
    "show_ui" => true,
    "labels" => $labels,
);

register_taxonomy("provider_service_category", array("provider"), $args);

/**
 * Taxonomy: Provider County
 */

$labels = array(
    "name" => _x("Counties", "Taxonomy General Name", "justus-health"),
    "singular_name" => _x("County", "Taxonomy Singular Name", "justus-health"),
);

$args = array(
    "hierarchical" => false,
    "meta_box_cb" => false,
    "public" => false,
    "show_admin_column" => true,
    "show_in_nav_menus" => false,
    "show_in_quick_edit" => false,
    "show_ui" => true,
    "show_ui" => true,
    "labels" => $labels,
);

register_taxonomy("provider_county", array("provider"), $args);

/**
 * Taxonomy: Provider Business Hours
 */

$labels = array(
    "name" => _x("Business Hours", "Taxonomy General Name", "justus-health"),
    "singular_name" => _x("Business Hours", "Taxonomy Singular Name", "justus-health"),
);

$args = array(
    "hierarchical" => false,
    "meta_box_cb" => false,
    "public" => false,
    "show_admin_column" => true,
    "show_in_nav_menus" => false,
    "show_in_quick_edit" => false,
    "show_ui" => true,
    "show_ui" => true,
    "labels" => $labels,
);

register_taxonomy("provider_business_hours", array("provider"), $args);

/**
 * Taxonomy: Provider Appointment Format
 */

$labels = array(
    "name" => _x("Appointment Formats", "Taxonomy General Name", "justus-health"),
    "singular_name" => _x("Appointment Format", "Taxonomy Singular Name", "justus-health"),
);

$args = array(
    "hierarchical" => false,
    "meta_box_cb" => false,
    "public" => false,
    "show_admin_column" => true,
    "show_in_nav_menus" => false,
    "show_in_quick_edit" => false,
    "show_ui" => true,
    "show_ui" => true,
    "labels" => $labels,
);

register_taxonomy("provider_appointment_format", array("provider"), $args);

/**
 * Taxonomy: Provider Payment Option
 */

$labels = array(
    "name" => _x("Payment Options", "Taxonomy General Name", "justus-health"),
    "singular_name" => _x("Payment Option", "Taxonomy Singular Name", "justus-health"),
);

$args = array(
    "hierarchical" => false,
    "meta_box_cb" => false,
    "public" => false,
    "show_admin_column" => true,
    "show_in_nav_menus" => false,
    "show_in_quick_edit" => false,
    "show_ui" => true,
    "show_ui" => true,
    "labels" => $labels,
);

register_taxonomy("provider_payment_option", array("provider"), $args);

/**
 * Taxonomy: Therapist or Intern Type (Group, Individual, Family)
 */

$labels = array(
    "name" => _x("Therapy Types", "Taxonomy General Name", "justus-health"),
    "singular_name" => _x("Therapy Type", "Taxonomy Singular Name", "justus-health"),
);

$args = array(
    "labels" => $labels,
    "hierarchical" => false,
    "public" => false,
    "show_ui" => true,
    "show_admin_column" => true,
    "show_in_nav_menus" => false,
    "show_tagcloud" => true,
);

register_taxonomy("therapy_type", array("therapist"), $args);

/**
 * Taxonomy: Therapist or Intern Role (Therapist, Intern)
 */

$labels = array(
    "name" => _x("Roles", "Taxonomy General Name", "justus-health"),
    "singular_name" => _x("Role", "Taxonomy Singular Name", "justus-health"),
);

$args = array(
    "labels" => $labels,
    "hierarchical" => false,
    "public" => false,
    "show_ui" => true,
    "show_admin_column" => true,
    "show_in_nav_menus" => false,
    "show_tagcloud" => true,
);

register_taxonomy("therapist_role", array("therapist"), $args);