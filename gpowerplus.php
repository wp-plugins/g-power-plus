<?php
/*
Plugin Name: G Power Plus List Building Plugin
Plugin URI: http://www.listbuilding.in
Description: The one & only list building Wordpress plugin, G Power Plus Plugin is part of G Power Plus list building app. This plugin adds a customized link to posts, sidebar & footer to turn Google plus one into subscribers OR you can ask your users to SIGN IN with their Google OR Google Apps account for a bonus report or anything & in the background they will be automatically subscribed to your list. Supports Aweber, GetResponse, iContact, ImnicaMail & TrafficWave autoresponders.
Version: 1.0
Author: JennyClicks Inc.
Author URI: http://jennyclicks.com/about
License: GPL2
*/
/*  Copyright 2011  JennyClicks Inc.  (email : support@jennyclicks.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_action('admin_menu', 'plugin_admin_add_page');
function plugin_admin_add_page() {
add_options_page('G Power Plus Settings Page', 'G Power Plus Settings', 'manage_options', 'gpowerplus', 'gpowerplus_options_page');
}

function gpowerplus_options_page() {
?>
<div>
<p align="center"><img src="http://listbuilding.in/gpowerplus/head.jpg" width="95%"></p>
<h2 align="center">G Power Plus Settings Page</h2>
Please enter your G Power Plus URL, anchor text & enter yes wherever you want G Power Plus link to be added. For any help, please do not hesitate to get in touch 
with JennyClicks support executives by visiting <a href="http://jennyclicks.com/support" target="_blank">www.jennyclicks.com/support</a><br><br> <strong>And if you are not 
aware of G Power Plus yet</strong> then please visit <a href="http://listbuilding.in/?ref=wordpress">www.ListBuilding.in</a> where you can get G Power Plus & turn plus 
ones into subscribers with in a single second.<br>
<form action="options.php" method="post">
<?php settings_fields('gpowerplus_options'); ?>
<?php do_settings_sections('gpowerplus'); ?>
<br><br>
<input name="submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
</form></div>

<?php
}

add_action('admin_init', 'plugin_admin_init');
function plugin_admin_init(){
register_setting( 'gpowerplus_options', 'gpowerplus_url' );
add_settings_section('gpowerplus_main', 'G Power Plus Settings', 'gpowerplus_section_text', 'gpowerplus');
add_settings_field('gpowerplus_url_text', 'Your G Power Plus URL', 'gpowerplus_setting_string', 'gpowerplus', 'gpowerplus_main');
register_setting( 'gpowerplus_options', 'gpowerplus_atext' );
add_settings_field('gpowerplus_atext_text', 'Anchor Text For G Power Plus URL', 'gpowerplus_setting_string1', 'gpowerplus', 'gpowerplus_main');
register_setting( 'gpowerplus_options', 'gpowerplus_content' );
add_settings_field('gpowerplus_content_text', 'Show G Power Plus Link Above The Post Content (enter yes to allow)', 'gpowerplus_setting_string2', 'gpowerplus', 'gpowerplus_main');
register_setting( 'gpowerplus_options', 'gpowerplus_sidebar' );
add_settings_field('gpowerplus_sidebar_text', 'Show G Power Plus Link In Sidebar & Footer(enter yes to allow)', 'gpowerplus_setting_string3', 'gpowerplus', 'gpowerplus_main');
}

function gpowerplus_section_text() {
echo '<p>Enter G Power Plus URL & Anchor Text</p>';
}

function gpowerplus_setting_string() {
$options = get_option('gpowerplus_url');
echo "<input id='plugin_text_string' name='gpowerplus_url' size='40' type='text' value='{$options}' />";
}

function gpowerplus_setting_string1() {
$options = get_option('gpowerplus_atext');
echo "<input id='plugin_text_string' name='gpowerplus_atext' size='40' type='text' value='{$options}' />";
}

function gpowerplus_setting_string2() {
$options = get_option('gpowerplus_content');
echo "<input id='plugin_text_string' name='gpowerplus_content' size='40' type='text' value='{$options}' />";
}

function gpowerplus_setting_string3() {
$options = get_option('gpowerplus_sidebar');
echo "<input id='plugin_text_string' name='gpowerplus_sidebar' size='40' type='text' value='{$options}' />";
}


function addgpowerpluslink($content) {
$gpowerpluscontent = get_option('gpowerplus_content');
if($gpowerpluscontent=="yes")
{
$gpowerplusatext = get_option('gpowerplus_atext');
$gpowerplusurl = get_option('gpowerplus_url');
echo("<p align=center><strong><a href=".$gpowerplusurl." target=blank>".$gpowerplusatext."</a></strong><br></p>");    
}
return $content;
}

function addgpowerpluslinksidebar($content) {
$gpowerplussidebar = get_option('gpowerplus_sidebar');
if($gpowerplussidebar=="yes")
{
$gpowerplusatext = get_option('gpowerplus_atext');
$gpowerplusurl = get_option('gpowerplus_url');
echo("<p align=center><strong><a href=".$gpowerplusurl." target=blank>".$gpowerplusatext."</a></strong><br></p>");    
}
return $content;
}


add_filter ( 'the_content', 'addgpowerpluslink');

add_action ( 'get_sidebar', 'addgpowerpluslinksidebar');

add_action ( 'wp-footer', 'addgpowerpluslinksidebar');
?>