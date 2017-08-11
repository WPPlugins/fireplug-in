<?php
/**
 * The WordPress Plugin Boilerplate.
 *
 * A foundation off of which to build well-documented WordPress plugins that also follow
 * WordPress coding standards and PHP best practices.
 *
 * @package   Fireplug-in
 * @author    Cory Walker <cory.walker@akimbo.io>
 * @license   GPL-2.0+
 * @link      http://getfireplug.com
 * @copyright 2013 Akimbo
 *
 * @wordpress-plugin
 * Plugin Name: Fireplug-in
 * Plugin URI:  http://getfireplug.com
 * Description: The official Fireplug WordPress plugin. Get credit for what you write, and let your readers get credit for reading it. Increase traffic and loyalty.
 * Version:     0.1.2
 * Author:      Fireplug
 * Author URI:  http://getfireplug.com
 * Text Domain: en_US
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /lang
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

require_once( plugin_dir_path( __FILE__ ) . 'class-fireplugin.php' );

// Register hooks that are fired when the plugin is activated, deactivated, and uninstalled, respectively.
// TODO: replace PluginName with the name of the plugin defined in `class-plugin-name.php`
//register_activation_hook( __FILE__, array( 'PluginName', 'activate' ) );
//register_deactivation_hook( __FILE__, array( 'PluginName', 'deactivate' ) );

Fireplugin::get_instance();
