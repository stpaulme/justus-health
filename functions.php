<?php

if (!class_exists('Timber')) {
    add_action(
        'admin_notices',
        function () {
            echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url(admin_url('plugins.php#timber')) . '">' . esc_url(admin_url('plugins.php')) . '</a></p></div>';
        }
    );
    return;
}

Timber::$dirname = array('templates');

class SPMSite extends Timber\Site
{
    public function __construct()
    {
        add_action('after_setup_theme', array($this, 'theme_supports'));
        add_action('after_setup_theme', array($this, 'image_sizes'));
        add_filter('timber/context', array($this, 'add_to_context'));
        add_action('init', array($this, 'register_menus'));
        add_action('init', array($this, 'register_post_types'));
        add_action('init', array($this, 'register_taxonomies'));
        add_action('init', array($this, 'register_widgets'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue'));

        parent::__construct();
    }

    public function register_menus()
    {
        require 'lib/menus.php';
    }

    public function register_post_types()
    {
        require 'lib/post-types.php';
    }

    public function register_taxonomies()
    {
        require 'lib/taxonomies.php';
    }

    public function register_widgets()
    {
        require 'lib/widgets.php';
    }

    public function add_to_context($context)
    {
        $context['categories'] = wp_list_categories(array(
            'depth' => 1,
            'echo' => false,
            'title_li' => '<h2>Categories</h2>',
        ));

        foreach (get_registered_nav_menus() as $location => $value) {
            $twig_location = str_replace('-', '_', $location);
            $context['menu_' . $twig_location] = new TimberMenu($location);
        }

        $context['newsletter_signup_form'] = gravity_form('Newsletter Signup', false, true, false, null, true, 0, false);

        $context['options'] = get_fields('option');

        $context['site'] = $this;

        return $context;
    }

    public function theme_supports()
    {
        require 'lib/theme-supports.php';
    }

    public function image_sizes()
    {
        require 'lib/image-sizes.php';
    }

    public function enqueue()
    {
        require 'lib/enqueue.php';
    }
}

class Event extends Timber\Post
{

    public $_start;
    public $_end;
    public $_event_category;
    public $_address;

    public function start()
    {
        if (!$this->_start) {
            if (tribe_event_is_multiday($this)) { // Multi Day
                if (tribe_event_is_all_day($this)) { // All Day
                    $start = tribe_get_start_date($this, false, 'F j, Y'); // April 28, 2021
                } else { // Timed
                    $start = tribe_get_start_date($this, true, 'F j, Y / g:i A'); // April 28, 2021 / 10:00 AM
                }
            } else { // Single Day
                if (tribe_event_is_all_day($this)) { // All Day
                    $start = tribe_get_start_date($this, false, 'F j, Y'); // April 28, 2021
                } else { // Timed
                    $start = tribe_get_start_date($this, true, 'F j, Y / g:i A'); // April 28, 2021 / 10:00 AM
                }
            }

            if (isset($start)) {
                $this->_start = $start;
            }
        }

        return $this->_start;
    }

    public function end()
    {
        if (!$this->_end) {
            if (tribe_event_is_multiday($this)) { // Multi Day
                if (tribe_event_is_all_day($this)) { // All Day
                    $end = tribe_get_end_date($this, false, 'F j, Y'); // April 30, 2021
                } else { // Timed
                    $end = tribe_get_end_date($this, true, 'F j, Y / g:i A'); // April 30, 2021 / 11:00 AM
                }
            } else { // Single Day
                if (tribe_event_is_all_day($this)) { // All Day
                    $end = false;
                } else { // Timed
                    $end = tribe_get_end_date($this, true, 'g:i A'); // 10:00 AM
                }
            }

            if (isset($end)) {
                $this->_end = $end;
            }
        }
        return $this->_end;
    }

    public function event_category()
    {
        if (!$this->_event_category) {
            $event_categories = $this->get_terms('tribe_events_cat');
            if (is_array($event_categories) && count($event_categories)) {
                $event_category = Timber::get_term($event_categories[0]);
                $this->_event_category = $event_category;
            }
        }
        return $this->_event_category;
    }

    public function address()
    {
        if (!$this->_address) {
            $address = trim(strip_tags(tribe_get_full_address($this), '<br>'));

            if (isset($address)) {
                $this->_address = $address;
            }
        }
        return $this->_address;
    }
}

new SPMSite();

// ACF options page
if (function_exists('acf_add_options_page')) {
    require 'lib/acf-options-page.php';
}

// Additional actions
require 'lib/actions.php';

// Additional filters
require 'lib/filters.php';

// Custom functions
require 'lib/custom-functions.php';

// TEC: Use default events template for single event series
add_filter(
    'template_include',
    function ($template) {
        if (is_singular('tribe_event_series')) {
            $template = locate_template('tribe/events/v2/default-template.php');
        }

        return $template;
    }
);

// TEC: Load missing assets on single event series
function spm_tec_load_missing_assets_on_series()
{
    if (is_singular('tribe_event_series')) {
        // CSS
        wp_enqueue_style('tribe-events-views-v2-bootstrap-datepicker-styles-css', WP_PLUGIN_URL . '/the-events-calendar/vendor/bootstrap-datepicker/css/bootstrap-datepicker.standalone.min.css');
        wp_enqueue_style('tribe-common-skeleton-style-css', WP_PLUGIN_URL . '/the-events-calendar/common/src/resources/css/common-skeleton.min.css');
        wp_enqueue_style('tribe-tooltipster-css-css', WP_PLUGIN_URL . '/the-events-calendar/common/vendor/tooltipster/tooltipster.bundle.min.css');
        wp_enqueue_style('tribe-events-views-v2-skeleton-css', WP_PLUGIN_URL . '/the-events-calendar/src/resources/css/views-skeleton.min.css');
        wp_enqueue_style('tribe-common-full-style-css', WP_PLUGIN_URL . '/the-events-calendar/common/src/resources/css/common-full.min.css');
        wp_enqueue_style('tribe-events-views-v2-full-css', WP_PLUGIN_URL . '/the-events-calendar/src/resources/css/views-full.min.css');
        wp_enqueue_style('tribe-events-views-v2-print-css', WP_PLUGIN_URL . '/the-events-calendar/src/resources/css/views-print.min.css');
        wp_enqueue_style('tribe-events-pro-views-v2-skeleton-css', WP_PLUGIN_URL . '/events-calendar-pro/src/resources/css/views-skeleton.min.css');
        wp_enqueue_style('tribe-events-pro-views-v2-full-css', WP_PLUGIN_URL . '/events-calendar-pro/src/resources/css/views-full.min.css');
        wp_enqueue_style('tribe-events-pro-views-v2-print-css', WP_PLUGIN_URL . '/events-calendar-pro/src/resources/css/views-print.min.css');

        // JS
        wp_enqueue_script('tribe-common-js', WP_PLUGIN_URL . '/the-events-calendar/common/src/resources/js/tribe-common.min.js', );
        wp_enqueue_script('tribe-events-views-v2-breakpoints-js', WP_PLUGIN_URL . '/the-events-calendar/src/resources/js/views/breakpoints.min.js', array('jquery'), );
    }
}
add_action('wp_enqueue_scripts', 'spm_tec_load_missing_assets_on_series');
