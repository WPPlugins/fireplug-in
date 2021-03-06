<?php
/**
 * Fireplug-in
 *
 * @package   Fireplug-in
 * @author    Cory Walker <cory.walker@akimbo.io>
 * @license   GPL-2.0+
 * @link      http://getfireplug.com
 * @copyright 2013 Akimbo
 */

/**
 * Plugin class.
 *
 * TODO: Rename this class to a proper name for your plugin.
 *
 * @package   Fireplug-in
 * @author    Cory Walker <cory.walker@akimbo.io>
 */
class Fireplugin {

    /**
     * Plugin version, used for cache-busting of style and script file references.
     *
     * @since   0.1.1
     *
     * @var     string
     */
    protected $version = '0.1.1';

    /**
     * Unique identifier for your plugin.
     *
     * Use this value (not the variable name) as the text domain when internationalizing strings of text. It should
     * match the Text Domain file header in the main plugin file.
     *
     * @since    0.1.1
     *
     * @var      string
     */
    protected $plugin_slug = 'fireplug-in';

    /**
     * Instance of this class.
     *
     * @since    0.1.1
     *
     * @var      object
     */
    protected static $instance = null;

    /**
     * Slug of the plugin screen.
     *
     * @since    0.1.1
     *
     * @var      string
     */
    protected $plugin_screen_hook_suffix = null;

    //Get div code for the Fireplug button
    public function btn_code() {
        // If we want to make it only show up on single pages use is_single()
        $href = get_permalink();
        if (!is_page()){
            $button = '<div class="fp-getcredit" data-href="' . $href . '"></div>';
            return $button;
        }
        return "";
    }

    //Function 'fp_bttn_plgn_shortcode' are using to create shortcode by Fireplug Button.
    public function fp_bttn_plgn_shortcode( $content ) {
        $button = $this->btn_code();
        return $button;
    }

    /**
     * Initialize the plugin by setting localization, filters, and administration functions.
     *
     * @since     0.1.1
     */
    private function __construct() {

        // Load plugin text domain
        add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

        // Add the options page and menu item.
        // add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );

        // Load admin style sheet and JavaScript.
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

        // Load public-facing style sheet and JavaScript.
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

        //Add shortcode.
        add_shortcode( 'fp_button', array( $this, 'fp_bttn_plgn_shortcode' ) );

        // Define custom functionality. Read more about actions and filters: http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters
        add_action( 'TODO', array( $this, 'action_method_name' ) );
        add_filter( 'the_content', array( $this, 'filter_method_name' ) );

    }

    /**
     * Return an instance of this class.
     *
     * @since     0.1.1
     *
     * @return    object    A single instance of this class.
     */
    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if ( null == self::$instance ) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Fired when the plugin is activated.
     *
     * @since    0.1.1
     *
     * @param    boolean    $network_wide    True if WPMU superadmin uses "Network Activate" action, false if WPMU is disabled or plugin is activated on an individual blog.
     */
    public static function activate( $network_wide ) {
        // TODO: Define activation functionality here
    }

    /**
     * Fired when the plugin is deactivated.
     *
     * @since    0.1.1
     *
     * @param    boolean    $network_wide    True if WPMU superadmin uses "Network Deactivate" action, false if WPMU is disabled or plugin is deactivated on an individual blog.
     */
    public static function deactivate( $network_wide ) {
        // TODO: Define deactivation functionality here
    }

    /**
     * Load the plugin text domain for translation.
     *
     * @since    0.1.1
     */
    public function load_plugin_textdomain() {

        $domain = $this->plugin_slug;
        $locale = apply_filters( 'plugin_locale', get_locale(), $domain );

        load_textdomain( $domain, WP_LANG_DIR . '/' . $domain . '/' . $domain . '-' . $locale . '.mo' );
        load_plugin_textdomain( $domain, FALSE, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );
    }

    /**
     * Register and enqueue admin-specific style sheet.
     *
     * @since     0.1.1
     *
     * @return    null    Return early if no settings page is registered.
     */
    public function enqueue_admin_styles() {

        if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
            return;
        }

        $screen = get_current_screen();
        if ( $screen->id == $this->plugin_screen_hook_suffix ) {
            wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( 'css/admin.css', __FILE__ ), $this->version );
        }

    }

    /**
     * Register and enqueue admin-specific JavaScript.
     *
     * @since     0.1.1
     *
     * @return    null    Return early if no settings page is registered.
     */
    public function enqueue_admin_scripts() {

        if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
            return;
        }

        $screen = get_current_screen();
        if ( $screen->id == $this->plugin_screen_hook_suffix ) {
            wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'js/admin.js', __FILE__ ), array( 'jquery' ), $this->version );
        }

    }

    /**
     * Register and enqueue public-facing style sheet.
     *
     * @since    0.1.1
     */
    public function enqueue_styles() {
        wp_enqueue_style( $this->plugin_slug . '-plugin-styles', plugins_url( 'css/public.css', __FILE__ ), $this->version );
    }

    /**
     * Register and enqueues public-facing JavaScript files.
     *
     * @since    0.1.1
     */
    public function enqueue_scripts() {
        wp_enqueue_script( $this->plugin_slug . '-plugin-script', plugins_url( 'js/public.js', __FILE__ ), array( 'jquery' ), $this->version );
    }

    /**
     * Register the administration menu for this plugin into the WordPress Dashboard menu.
     *
     * @since    0.1.1
     */
    public function add_plugin_admin_menu() {

        /*
         * TODO:
         *
         * Change 'Page Title' to the title of your plugin admin page
         * Change 'Menu Text' to the text for menu item for the plugin settings page
         * Change 'plugin-name' to the name of your plugin
         */
        $this->plugin_screen_hook_suffix = add_plugins_page(
            __( 'Page Title', $this->plugin_slug ),
            __( 'Menu Text', $this->plugin_slug ),
            'read',
            $this->plugin_slug,
            array( $this, 'display_plugin_admin_page' )
        );

    }

    /**
     * Render the settings page for this plugin.
     *
     * @since    0.1.1
     */
    public function display_plugin_admin_page() {
        include_once( 'views/admin.php' );
    }

    /**
     * NOTE:  Actions are points in the execution of a page or process
     *        lifecycle that WordPress fires.
     *
     *        WordPress Actions: http://codex.wordpress.org/Plugin_API#Actions
     *        Action Reference:  http://codex.wordpress.org/Plugin_API/Action_Reference
     *
     * @since    0.1.1
     */
    public function action_method_name() {
        // TODO: Define your action hook callback here
    }

    /**
     * NOTE:  Filters are points of execution in which WordPress modifies data
     *        before saving it or sending it to the browser.
     *
     *        WordPress Filters: http://codex.wordpress.org/Plugin_API#Filters
     *        Filter Reference:  http://codex.wordpress.org/Plugin_API/Filter_Reference
     *
     * @since    0.1.1
     */
    public function filter_method_name( $content ) {
        $button = $this->btn_code();
        return $content . $button;
    }

}
