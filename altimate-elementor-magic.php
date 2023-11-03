<?php

/**
 * Plugin Name: Altimate Elementor Magic
 * Description: Essential widget for Elementor
 * Plugin URI:  https://altimate2lementor.com/
 * Version:     1.0.0
 * Author:      Altimate Elementor Magic
 * Author URI:  https://altimate2lementor.com/
 * Text Domain: altimate-elementor-magic
 *
 */

// Exit if accessed directly.
if (!defined('ABSPATH')) exit;

if (!defined('AEM_PBNAME'))
    define('AEM_PBNAME', plugin_basename(__FILE__));
if (!defined('AEM_PATH'))
    define('AEM_PATH', plugin_dir_path(__FILE__));
if (!defined('AEM_URL'))
    define('AEM_URL', plugins_url('/', __FILE__));
if (!defined('AEM_ADMIN'))
    define('AEM_ADMIN', AEM_PATH . 'admin/');
if (!defined('AEM_TEMPLATES'))
    define('AEM_TEMPLATES', AEM_PATH . 'includes/template-parts/');
if (!defined('AEM_ASSETS_URL'))
    define('AEM_ASSETS_URL', AEM_URL . 'assets/');
if (!defined('AEM_PLUGIN_VERSION'))
    define('AEM_PLUGIN_VERSION', '1.0.0');
if (!defined('MINIMUM_ELEMENTOR_VERSION'))
    define('MINIMUM_ELEMENTOR_VERSION', '2.0.0');
if (!defined('MINIMUM_PHP_VERSION'))
    define('MINIMUM_PHP_VERSION', '8.0');
if (!defined('AEM_TEXTDOMAIN'))
    define('AEM_TEXTDOMAIN', 'altimate-elementor-magic');

function aem_initiate_plugin()
{

    // Check if Elementor installed and activated
    if (!did_action('elementor/loaded')) {
        add_action('admin_notices', 'aem_admin_notice_missing_elementor');
        return;
    }

    // Check for required Elementor version
    if (!version_compare(ELEMENTOR_VERSION, MINIMUM_ELEMENTOR_VERSION, '>=')) {
        add_action('admin_notices', 'aem_admin_notice_minimum_elementor_version');
        return;
    }

    // Check for required PHP version
    if (version_compare(PHP_VERSION, MINIMUM_PHP_VERSION, '<')) {
        add_action('admin_notices', 'aem_admin_notice_minimum_php_version');
        return;
    }
}
add_action('plugins_loaded', 'aem_initiate_plugin');
function aem_register_widget($widgets_manager)
{

    // include the widget file
    require_once(AEM_PATH . 'classes/Helper.php');
    require_once(AEM_PATH . 'widgets/AEM_Testimonial_Addon.php');
    require_once(AEM_PATH . 'widgets/AEM_Accordion.php');
    require_once(AEM_PATH . 'widgets/AEM_Pricing_Table.php');
    require_once(AEM_PATH . 'widgets/AEM_Progressbar.php');
    require_once(AEM_PATH . 'widgets/AEM_Iconbox.php');
    require_once(AEM_PATH . 'widgets/AEM_Image_Carousel.php');
    require_once(AEM_PATH . 'widgets/AEM_Gallery_Slider.php');
    require_once(AEM_PATH . 'widgets/AEM_Flipbox.php');
    require_once(AEM_PATH . 'widgets/AEM_Button.php');
    require_once(AEM_PATH . 'widgets/AEM_Dual_Button.php');
    require_once(AEM_PATH . 'widgets/AEM_Post_Grid.php');
    require_once(AEM_PATH . 'widgets/AEM_Business_Hours.php');
    require_once(AEM_PATH . 'widgets/AEM_Dropcap.php');
    require_once(AEM_PATH . 'widgets/AEM_Heading.php');
    require_once(AEM_PATH . 'widgets/AEM_Alert.php');
    require_once(AEM_PATH . 'widgets/AEM_Contact_Form_7.php');
    require_once(AEM_PATH . 'widgets/AEM_Logobox.php');
    require_once(AEM_PATH . 'widgets/AEM_News_Ticker.php');
    require_once(AEM_PATH . 'widgets/AEM_Tooltips.php');
    require_once(AEM_PATH . 'widgets/AEM_Countdown.php');
    require_once(AEM_PATH . 'widgets/AEM_Pricing_Menu.php');
    require_once(AEM_PATH . 'widgets/AEM_Map.php');

    // register the widget
    $widgets_manager->register(new AEM_Testimonial_Addon());
    $widgets_manager->register(new AEM_Accordion());
    $widgets_manager->register(new AEM_Pricing_Table());
    $widgets_manager->register(new AEM_Progressbar());
    $widgets_manager->register(new AEM_Iconbox());
    $widgets_manager->register(new AEM_Image_Carousel());
    $widgets_manager->register(new AEM_Gallery_Slider());
    $widgets_manager->register(new AEM_Flipbox());
    $widgets_manager->register(new AEM_Button());
    $widgets_manager->register(new AEM_Dual_Button());
    $widgets_manager->register(new AEM_Post_Grid());
    $widgets_manager->register(new AEM_Business_Hours());
    $widgets_manager->register(new AEM_Dropcap());
    $widgets_manager->register(new AEM_Heading());
    $widgets_manager->register(new AEM_Alert());
    $widgets_manager->register(new AEM_Contact_Form_7());
    $widgets_manager->register(new AEM_Logobox());
    $widgets_manager->register(new AEM_News_Ticker());
    $widgets_manager->register(new AEM_Tooltips());
    $widgets_manager->register(new AEM_Countdown());
    $widgets_manager->register(new AEM_Pricing_Menu());
    $widgets_manager->register(new AEM_Map());
}
add_action('elementor/widgets/register', 'aem_register_widget');

function aem_add_elementor_widget_categories($elements_manager)
{

    $elements_manager->add_category(
        'aem-category',
        [
            'title' => esc_html__('AEM Category', AEM_TEXTDOMAIN),
            'icon' => 'fa fa-plug',
        ]
    );
}
add_action('elementor/elements/categories_registered', 'aem_add_elementor_widget_categories');

function aem_frontend_stylesheets()
{
    // CSS Load for slick slider
    wp_enqueue_style('aem-slick', AEM_ASSETS_URL . 'vendor/css/slick.min.css');
    wp_enqueue_style('aem-slick-theme', AEM_ASSETS_URL . 'vendor/css/slick-theme.min.css');

    wp_register_style('aem-style-1', AEM_ASSETS_URL . 'css/aem-style.css');

    wp_enqueue_style('aem-style-1');
}
add_action('elementor/frontend/after_enqueue_styles', 'aem_frontend_stylesheets');

function aem_frontend_scripts()
{

    wp_register_script('aem-script-1', AEM_ASSETS_URL . 'js/aem-script.js', array(), false, true);

    wp_enqueue_script('aem-script-1');
}
add_action('elementor/frontend/after_register_scripts', 'aem_frontend_scripts');

function aem_frontend_editor_scripts()
{

    wp_register_style('aem-frontend-editor', AEM_ASSETS_URL . 'css/aem-frontend-editor.css');
    wp_enqueue_style('aem-frontend-editor');
}
add_action('elementor/editor/after_enqueue_scripts', 'aem_frontend_editor_scripts');

function aem_register_dependency_scripts()
{
    wp_register_script('aem-slick', AEM_ASSETS_URL . 'vendor/js/slick.min.js', array('jquery'), AEM_PLUGIN_VERSION, true);
    wp_register_script( 'aem-google-map-api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCkUOdZ5y7hMm0yrcCQoCvLwzdM6M8s5qk&callback=initMap', array(), AEM_PLUGIN_VERSION, false );
    wp_register_script( 'aem-gmap3', AEM_ASSETS_URL . 'vendor/js/gmap3.min.js', array( 'jquery' ), AEM_PLUGIN_VERSION, true );

}
add_action('elementor/frontend/after_register_scripts', 'aem_register_dependency_scripts', 20);


/**
 * Admin notice
 * Warning when the site doesn't have Elementor installed or activated.
 *
 * @since 1.0.0
 *
 * @access public
 */
function aem_admin_notice_missing_elementor()
{

    $message = sprintf(
        __('%1$s requires %2$s to be installed and activated to function properly. %3$s', AEM_TEXTDOMAIN),
        '<strong>' . __('Altimate Elementor Magic', AEM_TEXTDOMAIN) . '</strong>',
        '<strong>' . __('Elementor', AEM_TEXTDOMAIN) . '</strong>',
        '<a href="' . esc_url(admin_url('plugin-install.php?s=Elementor&tab=search&type=term')) . '">' . __('Please click here to install/activate Elementor', AEM_TEXTDOMAIN) . '</a>'
    );

    printf('<div class="notice notice-warning is-dismissible"><p style="padding: 5px 0">%1$s</p></div>', $message);
}

/**
 * Admin notice
 *
 * Warning when the site doesn't have a minimum required Elementor version.
 *
 * @since 1.0.0
 *
 * @access public
 */
function aem_admin_notice_minimum_elementor_version()
{

    if (isset($_GET['activate']))
        unset($_GET['activate']);

    $message = sprintf(
        /* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
        esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', AEM_TEXTDOMAIN),
        '<strong>' . esc_html__('Altimate Elementor Magic', AEM_TEXTDOMAIN) . '</strong>',
        '<strong>' . esc_html__('Elementor', AEM_TEXTDOMAIN) . '</strong>',
        MINIMUM_ELEMENTOR_VERSION
    );

    printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
}
/**
 * Admin notice
 *
 * Warning when the site doesn't have a minimum required PHP version.
 *
 * @since 1.0.0
 *
 * @access public
 */
function aem_admin_notice_minimum_php_version()
{

    if (isset($_GET['activate']))
        unset($_GET['activate']);

    $message = sprintf(
        /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
        esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', AEM_TEXTDOMAIN),
        '<strong>' . esc_html__('Altimate Elementor Magic', AEM_TEXTDOMAIN) . '</strong>',
        '<strong>' . esc_html__('PHP', AEM_TEXTDOMAIN) . '</strong>',
        MINIMUM_PHP_VERSION
    );

    printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
}
