<?php
/*
Plugin Name: Subscribe2 Widget Pro
Plugin URI: http://wordimpress.com/
Description: An enhanced Subscribe2 WordPress widget that will help you increase newsletter conversions.
Version: 1.0
Author: Devin Walker
Author URI: http://imdev.in/
License: GPLv2
*/

/*
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; version 2 of the License.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
// error_reporting(E_ALL);
// ini_set('display_errors', '1');

define( 'S2w_PLUGIN_NAME', 'subscribe2-widget-pro');
define( 'S2w_PLUGIN_NAME_PLUGIN', 'subscribe2-widget-pro/subscribe2-widget-pro.php');
define( 'S2w_WIDGET_PRO_PATH', WP_PLUGIN_DIR.'/'.S2w_PLUGIN_NAME);
define( 'S2w_WIDGET_PRO_URL', WP_PLUGIN_URL.'/'.S2w_PLUGIN_NAME);

/**
 * Adds Subscribe2 Widget Pro Options Page
 */
require_once (dirname(__FILE__) . '/includes/options.php');


/**
 * @TODO: Localize the Plugin for Other Languages
 *
 */
//load_plugin_textdomain('sw2' , false, dirname( plugin_basename(__FILE__) ) . '/languages/' );


/**
 * @TODO: Licensing
 */
//$licenseFuncs = include(dirname(__FILE__) . '/lib/license.php');
//if (file_exists($licenseFuncs)) {
//    echo $licenseFuncs;
//}


/**
 * Logic to check for updated version of Yelp Widget Pro Premium
 * if the user has a valid license key and email
 */
$options = get_option('sw2_widget_settings');
if($options['sw2_widget_premium_license_status'] == "1") {

    /**
     * Adds the Premium Plugin updater
     */
    require 'lib/plugin-updates/plugin-update-checker.php';
    $MyUpdateChecker = new PluginUpdateChecker(
        'http://wordimpress.com/downloads/subscribe2-widget-pro-premium.json',
        __FILE__,
        'subscribe2-widget-pro'
    );

    $licenseTransient = get_transient('sw2_widget_license_transient');

}


/**
 * Adds Subscribe2 Widget Pro Stylesheets
 */
add_action('wp_print_styles', 'add_subscribe2_widget_css');

function add_subscribe2_widget_css() {

    $cssOption = get_option('sw2_widget_settings');

    if($cssOption["sw2_widget_disable_css"] == 0) {

        $url = plugins_url(SW2_PLUGIN_NAME.'/includes/style/subscribe2.css', dirname(__FILE__));

        wp_register_style('sw2-widget', $url);
        wp_enqueue_style('sw2-widget');

    }

}

/**
 * Get the Widget
 */
if(!class_exists('Yelp_Widget')) {
    require 'includes/widget.php';
}