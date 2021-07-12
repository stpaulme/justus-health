<?php

$context = Timber::context();
$post = new TimberPost();

$context['post'] = $post;
$context['title'] = $post->title;
$context['posts'] = new Timber\PostQuery();

// Below the fold
$below_modules = get_field('below_modules');
$context['below_modules'] = spm_add_data_to_modules($below_modules);

$templates = array('index.twig');
if (is_home()) {
    array_unshift($templates, 'front-page.twig', 'home.twig');
}

Timber::render($templates, $context);
