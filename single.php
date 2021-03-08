<?php

$context = Timber::context();
$post = Timber::query_post();

$context['post'] = $post;
$context['title'] = $post->title;
$context['breadcrumbs'] = bcn_display(true);
$context['sidebar'] = true;

Timber::render(array('single-' . $post->ID . '.twig', 'single-' . $post->post_type . '.twig', 'single.twig'), $context);
