<?php

/**
 * All the attached hooks
 */
/**
 * filter on the edit profile field action
 * make the form always point to field group 1 
 */
add_filter( 'bp_get_the_profile_group_edit_form_action', 'bpmagic_update_profile_edit_form_action' );

function bpmagic_update_profile_edit_form_action( $action ) {

	return $action . '1/';
}
