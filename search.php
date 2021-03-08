<?php

$context = Timber::context();

$context['title'] = 'Search Results for "' . get_search_query() . '"';
$context['posts'] = new Timber\PostQuery();

$templates = array('search.twig', 'index.twig');
Timber::render($templates, $context);
