<?php

// Add "Formats" dropdown to TinyMCE editor
function spm_add_formats_dropdown($buttons)
{
    array_unshift($buttons, 'styleselect');
    return $buttons;
}
add_filter('mce_buttons_2', 'spm_add_formats_dropdown');

// Insert formats into "Formats" dropdown
function spm_insert_formats($init_array)
{
    $style_formats = array(
        array(
            'title' => 'Button',
            'selector' => 'a',
            'classes' => 'button',
        ),
    );

    // Insert the array, JSON ENCODED, into 'style_formats'
    $init_array['style_formats'] = json_encode($style_formats);

    return $init_array;
}
add_filter('tiny_mce_before_init', 'spm_insert_formats');

// Make default WordPress embeds responsive by wrapping them in .er-container div
function spm_wrap_embeds($html)
{
    return '<div class="er-container">' . $html . '</div>';
}
add_filter('embed_oembed_html', 'spm_wrap_embeds');

// Customize which menu item is marked active
function spm_menu_item_classes($classes, $item, $args)
{

    /* Counselors */
    if ((is_singular('counselor') && 'Chemical Health' == $item->title)) {
        $classes[] = 'current-menu-item';
    }
    if ((is_singular('counselor') && false !== strpos($item->title, 'Counseling'))) {
        $classes[] = 'current-menu-item';
    }

    /* Events */
    if ((tribe_is_community_edit_event_page() || tribe_is_community_my_events_page()) && 'Events' == $item->title) {
        $classes[] = 'current-menu-item';
    }

    /* News */
    if ((is_singular('post') || is_category()) && 'News' == $item->title) {
        $classes[] = 'current-menu-item';
    }

    /* Therapists */
    if ((is_singular('therapist') && 'Therapy' == $item->title)) {
        $classes[] = 'current-menu-item';
    }
    if ((is_singular('therapist') && false !== strpos($item->title, 'Counseling'))) {
        $classes[] = 'current-menu-item';
    }

    return array_unique($classes);

}
add_filter('nav_menu_css_class', 'spm_menu_item_classes', 10, 3);

// ACF: Google Maps API key
function spm_acf_google_map_api($api)
{
    $api['key'] = 'AIzaSyAiM7QW2k_Y6nD7jS0S6TXUdNCPwhjJnXA';
    return $api;
}
add_filter('acf/fields/google_map/api', 'spm_acf_google_map_api');

// GF: Scroll to confirmation text or validation message on submission
add_filter('gform_confirmation_anchor', '__return_true');

// ACF: Use a flexible content layout's heading as its title
add_filter('acf/fields/flexible_content/layout_title', 'spm_use_heading_as_acf_layout_title', 10, 4);
function spm_use_heading_as_acf_layout_title($title, $field, $layout, $i)
{
    if ($heading = get_sub_field('heading')) {
        $title .= ': ' . esc_html($heading);
    }

    return $title;
}
