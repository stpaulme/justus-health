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

// GF: Use <button> for submit button
add_filter('gform_submit_button', 'spm_form_submit_button', 10, 2);
function spm_form_submit_button($button, $form)
{
    return "<button class='button gform_button' id='gform_submit_button_{$form['id']}'><span>Submit</span></button>";
}

// Custom validation for provider statement field
add_filter('acf/validate_value/name=provider_statement', 'spm_max_limit_provider_statement', 10, 4);
function spm_max_limit_provider_statement($valid, $value, $field, $input_name)
{
    // Bail early if value is already invalid
    if ($valid !== true) {
        return $valid;
    }

    $max = 500;

    if (strlen(wp_strip_all_tags($value)) > $max) {
        return __('The maximum number of characters allowed is ' . $max);
    }

    return $valid;
}

// Make provider area tax public for breadcrumb purposes
add_filter('bcn_show_tax_private', 'spm_show_area_tax_to_bcn', 10, 4);
function spm_show_area_tax_to_bcn($public, $taxonomy_name)
{
    if ($taxonomy_name == 'provider_area') {
        $public = true;
    }

    return $public;
}
