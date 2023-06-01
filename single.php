<?php

$context = Timber::context();
$post = Timber::query_post();

$context['post'] = $post;
$context['breadcrumbs'] = bcn_display(true);
$context['sidebar'] = true;
$context['sidebar_pos'] = 'right';

if (is_singular('article')) {
    // Below the fold
    $below_modules = get_field('below_modules');
    $context['below_modules'] = spm_add_data_to_modules($below_modules);
}

if (is_singular('provider')) {
    $context['sidebar_pos'] = 'left';

    // Below the fold
    $below_modules = get_field('below_modules');
    $context['below_modules'] = spm_add_data_to_modules($below_modules);
}

if (is_singular('therapist')) {
    $context['sidebar_pos'] = 'left';
}

if (post_password_required($post->ID)) {
    $context['sidebar'] = true; // for .container and line length
    Timber::render('page-password.twig', $context);
} else {
    Timber::render(array('single-' . $post->ID . '.twig', 'single-' . $post->post_type . '.twig', 'single.twig'), $context);
}