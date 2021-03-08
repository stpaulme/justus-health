<?php

$context = Timber::context();
$post = new TimberPost();

$context['title'] = $post->title;
$context['posts'] = new Timber\PostQuery();

$templates = array('index.twig');
if (is_home()) {
    array_unshift($templates, 'front-page.twig', 'home.twig');
}

Timber::render($templates, $context);
