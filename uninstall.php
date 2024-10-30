<?php
if( !defined( 'ABSPATH') && !defined('WP_UNINSTALL_PLUGIN') )
	    exit();

delete_option('smbsugar_box_align');
delete_option('smbsugar_display_home');
delete_option('smbsugar_display_page');
delete_option('smbsugar_display_post');
delete_option('smbsugar_display_cat');
delete_option('smbsugar_display_archive');
delete_option('smbsugar_button');
?>