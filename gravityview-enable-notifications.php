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

add_action( 'gform_after_update_entry', 'gravityview_enable_gf_notifications_after_update', 10, 2 );

/**
 * Triggers Gravity Forms notifications engine when entry is updated (admin or frontend)
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


add_action( 'gform_post_update_entry', 'gravityview_enable_gf_notifications_after_api_update_entry', 10, 2 );

/**
 * Triggers Gravity Forms notifications engine when entry is updated through Gravity Forms API (GFAPI)
 * @param  array $entry Updated entry object
 * @param  array $original_entry Original entry object
 * @return void
 */
function gravityview_enable_gf_notifications_after_api_update_entry( $entry, $original_entry ) {
	if( !is_admin() || !class_exists('GFCommon') || !class_exists( 'GFAPI' ) ) {
		return;
	}

	$form = GFAPI::get_form( $entry['form_id'] );

	GFCommon::send_form_submission_notifications( $form, $entry );
}