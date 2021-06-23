<?php

$context = Timber::get_context();

if (is_singular()) {
    $timber_post = new TimberPost();
    $context['breadcrumbs'] = bcn_display(true);
    $context['sidebar'] = false;
}

Timber::render('templates/events.twig', $context);
