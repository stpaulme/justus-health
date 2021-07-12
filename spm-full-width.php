<?php
/**
 * Template Name: Full Width
 */

$context = Timber::get_context();
$timber_post = new TimberPost();

$context['post'] = $timber_post;

// Title
$show_page_title = get_field('show_page_title');
if ($show_page_title) {
    $context['title'] = $timber_post->title;

    if ($timber_post->post_parent) {
        $context['breadcrumbs'] = bcn_display(true);
    }
}

// Main content
$content_modules = get_field('content_modules');
$context['content'] = spm_add_data_to_modules($content_modules);

if (post_password_required($timber_post->ID)) {
    $context['sidebar'] = true; // for .container and line length
    Timber::render('page-password.twig', $context);
} else {
    Timber::render(array('spm-full-width.twig'), $context);
}
