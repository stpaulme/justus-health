<?php

$context = Timber::context();

$_404_page = get_field('_404_page', 'option');

$context['title'] = $_404_page['title'];
$context['copy'] = $_404_page['copy'];
$context['link'] = $_404_page['link'];

$context['sidebar'] = true; // for .container and line length

Timber::render('404.twig', $context);
