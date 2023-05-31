<?php

// Remove tags from posts
add_action('init', 'spm_remove_tags');
function spm_remove_tags()
{
    unregister_taxonomy_for_object_type('post_tag', 'post');
}

// Add excerpts to pages
add_action('init', 'spm_excerpts');
function spm_excerpts()
{
    add_post_type_support('page', 'excerpt');
}

// Remove emojis
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');

// Remove S&F styles
add_action('wp_print_styles', 'spm_remove_sf_styles', 100);
function spm_remove_sf_styles()
{
    wp_dequeue_style('search-filter-plugin-styles');
}

// Add Open Graph meta tags for Facebook
add_action('wp_head', 'spm_add_og_meta_tags', 5);
function spm_add_og_meta_tags()
{
    global $post;

    if (is_single()) {

        if (has_post_thumbnail($post->ID)) {
            $image_id = get_post_thumbnail_id($post->ID);
        } else {
            $image_id = get_field('logo', 'option');
        }
        $img_src = wp_get_attachment_image_url($image_id, 'large');

        $excerpt = wp_strip_all_tags(get_the_excerpt(), true);
        if (!$excerpt) {
            $excerpt = get_bloginfo('description');
        }
        ?>

<meta name="twitter:card" content="summary">
<meta property="og:site_name" content="<?php echo get_bloginfo(); ?>">
<meta property="og:url" content="<?php echo the_permalink(); ?>">
<meta property="og:title" content="<?php echo the_title(); ?>">
<meta property="og:description" content="<?php echo $excerpt; ?>">
<meta property="og:image" content="<?php echo $img_src; ?>">
<meta property="og:type" content="article">

<?php
} else {
        return;
    }
}

// Localize load-more.js
function spm_load_more()
{
    global $wp_query;

    // Register main load more script but do not enqueue it yet
    wp_register_script('spm_load_more', get_stylesheet_directory_uri() . '/load-more.js', array('jquery'));

    wp_localize_script('spm_load_more', 'spm_more_params', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'posts' => json_encode($wp_query->query_vars),
        'current_page' => get_query_var('paged') ? get_query_var('paged') : 1,
        'max_page' => $wp_query->max_num_pages,
    ));

    // Enqueue load more script
    wp_enqueue_script('spm_load_more');
}
add_action('wp_enqueue_scripts', 'spm_load_more');

// AJAX handler for load-more.js
function spm_load_more_ajax_handler()
{
    // Prepare arguments for query
    $args = json_decode(stripslashes($_POST['query']), true);
    $args['paged'] = $_POST['page'] + 1; // we need next page to be loaded
    $args['post_status'] = 'publish';

    query_posts($args);

    if (have_posts()):
        // Run the loop
        while (have_posts()): the_post();
            $context = Timber::context();
            $context['post'] = new Timber\Post(get_the_ID());
            $post_type = get_post_type($post->ID);

            $templates = array('blocks/excerpt-' . $post_type . '.twig', 'blocks/excerpt.twig');

            Timber::render($templates, $context);
        endwhile;
    endif;

    die;

    wp_reset_query();
}
add_action('wp_ajax_loadmore', 'spm_load_more_ajax_handler'); // wp_ajax_{action}
add_action('wp_ajax_nopriv_loadmore', 'spm_load_more_ajax_handler'); // wp_ajax_nopriv_{action}

// Add filtered provider directory pages to breadcrumbs
add_action('bcn_after_fill', 'spm_add_area_page_to_breadcrumbs');
function spm_add_area_page_to_breadcrumbs($trail)
{
    if (is_singular('provider')) {
        $area_breadcrumb = $trail->trail[1];

        if (in_array('provider_area', $area_breadcrumb->get_types())) {
            $term = get_term($area_breadcrumb->get_id(), 'provider_area');
            $area_breadcrumb->set_title('Providers');
            $area_breadcrumb->set_url('/resources-directories/providers/?_sft_provider_area=' . $term->slug);
        }
    }
}