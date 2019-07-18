<?php
/**
* Plugin Name: Ivan Juras Oxygen Helper
* Plugin URI: https://ivanjuras.com
* Description: A helper plugin for the Oxygen theme builder.
* Version: 1.0
* Author: Ivan Juras
* Author URI: https://ivanjuras.com
**/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'plugins_loaded', 'ijoxy_check_if_oxygen_exists');
function check_if_oxygen_exists() {
	if (! class_exists('CT_Component') ) {
		add_action( 'admin_notices', 'ijoxy_no_oxygen_error_notice' );
		function ijoxy_no_oxygen_error_notice() {
			echo '
				<div class="error notice">
						<p>' . _e( 'There has been an error. Bummer!', 'my_plugin_textdomain' ) . '</p>
				</div>
			';
		}
	}
}


require_once 'backend/disable.php';
require_once 'backend/dequeue.php';
require_once 'backend/vendor-tweaks.php';
require_once 'backend/site-tweaks.php';

require_once 'backend/oxygen-tweaks/quick-editor-toolbar.php';