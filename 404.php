<?php

$context = Timber::context();

$_404_page = get_field('_404_page', 'option');

$context['cta'] = $_404_page;

Timber::render('404.twig', $context);
