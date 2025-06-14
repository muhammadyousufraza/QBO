<?php
/*
 * Plugin Name: Divi Torque
 * Plugin URI:  https://divitorque.com
 * Description: Create beautiful and attracting posts, pages, and landing pages with Divi Torque Lite.
 * Author:      PlugPress
 * Author URI:  https://plugpress.co
 * Version:     4.2.0
 * License:     GPL3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain: addons-for-divi
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

define('DIVI_TORQUE_LITE_FILE', __FILE__);
define('DIVI_TORQUE_LITE_BASE', plugin_basename(__FILE__));
define('DIVI_TORQUE_LITE_VERSION', '4.2.0');
define('DIVI_TORQUE_LITE_DIR', plugin_dir_path(__FILE__));
define('DIVI_TORQUE_LITE_URL', plugin_dir_url(__FILE__));
define('DIVI_TORQUE_LITE_ASSETS', trailingslashit(DIVI_TORQUE_LITE_URL . 'assets'));

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

require_once DIVI_TORQUE_LITE_DIR . 'includes/plugin.php';
