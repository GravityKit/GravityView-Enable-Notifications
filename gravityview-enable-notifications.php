<?php
/*
* Plugin Name:       	GravityView - Enable Gravity Forms Notifications
* Plugin URI:        	http://gravityview.co/
* Description:       	Enable Gravity Forms notifications when an entry is edited in GravityView.
* Version:          	1.0
* Author:            	Katz Web Services, Inc.
* Author URI:        	http://www.katzwebservices.com
* License:           	GPLv2 or later
* License URI: 			http://www.gnu.org/licenses/gpl-2.0.html
*/

add_filter( 'gform_after_update_entry', 'gravityview_enable_gf_notifications_after_update', 10, 2 );

/**
 * Triggers Gravity Forms notifications engine when entry is updated
 * @param  array $form    GF form
 * @param  int $entry_id  Lead/entry id
 * @return void
 */
function gravityview_enable_gf_notifications_after_update( $form, $entry_id ) {

	if( is_admin() || !class_exists('GFCommon') || !class_exists( 'GFAPI' ) ) {
		return;
	}

	$entry = GFAPI::get_entry( $entry_id );

	GFCommon::send_form_submission_notifications( $form, $entry );

}