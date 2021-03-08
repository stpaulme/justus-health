<?php

// Get top parent
function spm_get_top_parent($post)
{
    // Bail early if we don't have post object
    if (!is_object($post)) {
        return false;
    }

    if ($post->post_parent) {
        $ancestors = get_post_ancestors($post->ID);
        $root = count($ancestors) - 1;
        $parent = $ancestors[$root];
    } else {
        $parent = $post->ID;
    }

    return $parent;
}

// Get child pages
function spm_get_child_pages($depth, $show_title_li)
{
    global $post;

    $top_parent = spm_get_top_parent($post);

    $args = array(
        'child_of' => $top_parent,
        'depth' => $depth,
        'echo' => false,
        'sort_column' => 'menu_order',
        'title_li' => '',
    );

    if ($show_title_li == true) {
        $args['title_li'] = '<h2>' . get_the_title($top_parent) . '</h2>';
    }

    $child_pages = wp_list_pages($args);

    return $child_pages;
}

// Add data to certain modules (e.g., post feed)
function spm_add_data_to_modules($modules)
{
    // Bail early if we don't have modules
    if (empty($modules)) {
        return false;
    }

    foreach ($modules as &$module) {
        if ($module['acf_fc_layout'] == 'feed_event') {
            // Get data from ACF
            $event_category = $module['event_category'];
            $max = $module['max'];

            // Add event category to module in Timber
            if (!empty($event_category)) {
                $module['event_category'] = new Timber\Term($event_category, 'tribe_events_cat');
            }

            // Add events to module in Timber
            $args = array(
                'posts_per_page' => $max,
                'start_date' => 'now',
            );
            if (!empty($event_category)) {
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'tribe_events_cat',
                        'field' => 'term_id',
                        'terms' => $event_category,
                    ),
                );
            }
            $events = tribe_get_events($args);
            if ($events) {
                $module['events'] = new Timber\PostQuery($events, 'Event');
            }
        }

        if ($module['acf_fc_layout'] == 'feed_post') {
            // Get data from ACF
            $post_category = $module['post_category'];
            $max = $module['max'];

            // Add post category to module in Timber
            if (!empty($post_category)) {
                $module['post_category'] = new Timber\Term($post_category);
            }

            // Add posts to module in Timber
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => $max,
                'cat' => $post_category,
            );

            $module['posts'] = Timber::get_posts($args);
        }
    }

    return $modules;

}

// Get address from ACF location field
function spm_get_address_from_location_field($location)
{
    $address = '';

    foreach (array('street_number', 'street_name', 'city', 'state', 'post_code', 'country') as $i => $k) {
        if (isset($location[$k])) {
            if ($i == 0) {
                // first element is street number; no comma needed
                $address .= sprintf('<span class="segment-%s">%s</span> ', $k, $location[$k]);
            } else {
                // subsequent elements need commas
                $address .= sprintf('<span class="segment-%s">%s</span>, ', $k, $location[$k]);
            }

        }
    }

    // trim trailing comma
    $address = trim($address, ', ');

    return $address;
}
