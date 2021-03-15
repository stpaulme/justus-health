<?php

$context = Timber::context();
$timber_post = new TimberPost();

$context['post'] = $timber_post;

// Title
$context['title'] = $timber_post->title;
if ($timber_post->post_parent) {
    $context['breadcrumbs'] = bcn_display(true);
}

// Sidebar
$context['sidebar'] = true;
$context['parent'] = spm_get_top_parent($post);
$context['sidebar_nav'] = spm_get_child_pages(0, true);
$sidebar_modules = get_field('sidebar_modules');
$context['sidebar_modules'] = spm_add_data_to_modules($sidebar_modules);

// Below the fold
$below_modules = get_field('below_modules');
$context['below_modules'] = spm_add_data_to_modules($below_modules);

$templates = array('default.twig');

if (post_password_required($timber_post->ID)) {
    $context['sidebar'] = true; // for .container and line length
    Timber::render('page-password.twig', $context);
} else {
    Timber::render($templates, $context);
}
