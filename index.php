<?php
/*
 * Plugin Name: User Registration
 * Description: This plugin is for user registration process. To create custom user from the front side after admin will approve it will automatically create user with subscriber user role.
 * Author: Manalee Shanishchara
 * Author URI: https://www.facebook.com/manalee.shanishchara
 * Version: 1.0.0
 * Requires: 3.0 or higher
 */


/* Main Plugin File */
if (!defined('ABSPATH')) {
	exit;
}

require_once 'inc/const.php';
require_once 'inc/init.php';




require_once 'front/script.php';
require_once 'front/reg_form.php';
require_once 'front/ajax.php';


require_once 'admin/script.php';
require_once 'admin/admin_menu.php';
require_once 'admin/ajax.php';
