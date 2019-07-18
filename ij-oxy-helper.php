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

require_once 'backend/disable.php';
require_once 'backend/dequeue.php';
require_once 'backend/vendor-tweaks.php';
require_once 'backend/site-tweaks.php';

require_once 'backend/oxygen-tweaks/quick-editor-toolbar.php';