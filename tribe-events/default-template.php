<?php

$context = Timber::get_context();

if (is_singular()) {
    $timber_post = new TimberPost();
    $context['title'] = $timber_post->title;
    $context['breadcrumbs'] = bcn_display(true);
    $context['sidebar'] = true; // for .container and line length
}

Timber::render('templates/events.twig', $context);
