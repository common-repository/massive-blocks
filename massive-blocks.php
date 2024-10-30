<?php
/**
 * Plugin Name: Massive Blocks - Addons for WordPress Editor and Gutenberg
 * Plugin URI: https://blocks.webcodingplace.com
 * Description: A Collection of Beautifully Designed UI Blocks for WordPress editor and Gutenberg
 * Version: 1.0
 * Author: WebCodingPlace
 * Author URI: http://webcodingplace.com/
 * License: GNU General Public License version 3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: page-building-blocks-wordpress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define('MBA_PATH', untrailingslashit(plugin_dir_path( __FILE__ )) );
define('MBA_URL', untrailingslashit(plugin_dir_url( __FILE__ )) );
define('MBA_VERSION', '1.0' );

require_once MBA_PATH . '/plugin.class.php';


if( class_exists('Massive_Blocks')){
	
	$massive_blocks_init = new Massive_Blocks;
	$massive_blocks_init->autoload( MBA_PATH . '/inc' );
	
}


?>