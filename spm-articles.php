<?php
/**
 * Template Name: Articles
 */

$context = Timber::get_context();
$timber_post = new TimberPost();

$context['post'] = $timber_post;

// Title
$context['title'] = $timber_post->title;
if ($timber_post->post_parent) {
    $context['breadcrumbs'] = bcn_display(true);
}

// Filters
$search_form_id = get_field('search_form_id');
$context['search_form_id'] = $search_form_id;

// Posts
$args = array(
    'search_filter_id' => $search_form_id,
);
$context['posts'] = Timber::get_posts($args);

// Below modules
$below_modules = get_field('below_modules');
$context['content'] = spm_add_data_to_modules($below_modules);

if (post_password_required($timber_post->ID)) {
    $context['sidebar'] = true; // for .container and line length
    Timber::render('page-password.twig', $context);
} else {
    Timber::render(array('spm-articles.twig'), $context);
}