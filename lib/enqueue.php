<?php

wp_enqueue_style('spm-css', get_template_directory_uri() . '/dist/css/spm.min.css', array(), filemtime(get_template_directory() . '/dist/css/spm.min.css'), false);
wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&display=swap');

wp_enqueue_script('font-awesome', '//kit.fontawesome.com/58427931e3.js');
wp_enqueue_script('spm-js', get_template_directory_uri() . '/dist/js/spm.min.js', array('jquery'));
wp_enqueue_script('bootstrap-js', '//cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js');
