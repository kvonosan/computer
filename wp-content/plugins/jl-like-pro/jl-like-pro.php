<?php
/*
Plugin Name: JoomLine WP Like Pro
Description: Help share your posts on popular social networks: VKontakte, Facebook, ok.ru, Google Plus, Twitter, LinkedIn, mail.ru, Pinterest.
Version: 1.1.4
Author: Joomline
Author URI: http://joomline.org
*/

/*  Copyright 2016  Joomline  (email: sale@joomline.ru)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

defined('JL_LIKE_PRO_BASE') or define('JL_LIKE_PRO_BASE', __FILE__);
defined('JL_LIKE_PRO_BASE_DIR') or define('JL_LIKE_PRO_BASE_DIR', dirname(__FILE__));

require_once 'includes/functions.php';
require_once 'includes/helper.php';

//Инициализация
add_action( 'init', array( 'JlLikePro', 'init') );

// adds "Settings" link to the plugin action page
add_filter( 'plugin_action_links', array( 'JlLikePro', 'action_links'), 10, 2 );

//добавляет дополнительные ссылки в списке плагинов
add_filter( 'plugin_row_meta', array( 'JlLikePro', 'plgn_links'), 10, 2 );

//Calling a function add administrative menu.
//add_action( 'admin_menu', 'jllikepro_bttn_plgn_add_pages' );

//Calling a function add administrative menu.
add_action( 'admin_menu', array( 'JlLikePro', 'add_pages') );

//Add shortcode.
add_shortcode( 'jllikepro_buttons', array( 'JlLikePro', 'shortcode') );

//Add settings links.
add_filter( 'the_content', array( 'JlLikePro', 'display_button') );

if(!is_admin()){
    add_action('wp_head', array( 'JlLikePro', 'loadScriptAndOG'));
    add_action( 'wp_enqueue_scripts', array( 'JlLikePro', 'loadScriptsAndStyles') );
}

register_uninstall_hook( JL_LIKE_PRO_BASE, array( 'JlLikePro', 'delete_options') );

?>