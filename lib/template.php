<?php

/**
 * Adds a hidden "redirect_to" input field to the sidebar login form.
 *
 */
function bpmagic_sidebar_login_redirect_to() {
	
	$redirect_to = ! empty( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : '';
	$redirect_to = apply_filters( 'bp_no_access_redirect', $redirect_to );
	?>
	<input type="hidden" name="redirect_to" value="<?php echo esc_attr( $redirect_to ); ?>" />

	<?php
}

add_action( 'bp_sidebar_login_form', 'bpmagic_sidebar_login_redirect_to' );

/**
 * Display navigation to next/previous pages when applicable
 *
 * @global WP_Query $wp_query
 * @param string $nav_id DOM ID for this navigation
 * @since 1.0
 * not used
 */
function bpmagic_posts_nav( $nav_id ) {
	
	global $wp_query;

	if ( ! empty( $wp_query->max_num_pages ) && $wp_query->max_num_pages > 1 ) :
		?>

		<div id="<?php echo $nav_id; ?>" class="navigation">
			<div class="alignleft"><?php next_posts_link( __( '&larr; Previous Entries', 'bp-magic' ) ); ?></div>
			<div class="alignright"><?php previous_posts_link( __( 'Next Entries &rarr;', 'bp-magic' ) ); ?></div>
			<div class="clear"></div>
		</div><!-- #<?php echo $nav_id; ?> -->

	<?php
	endif;
}

/**
 * A copy of bp_dtheme_activity_secondary_avatars
 * @param type $action
 * @param type $activity
 * @return type 
 */
function bpmagic_activity_secondary_avatars( $action, $activity ) {
	
	switch ( $activity->component ) {
		case 'groups' :
		case 'friends' :
			// Only insert avatar if one exists
			if ( $secondary_avatar = bp_get_activity_secondary_avatar() ) {
				$reverse_content = strrev( $action );
				$position = strpos( $reverse_content, 'a<' );
				$action = substr_replace( $action, $secondary_avatar, -$position - 2, 0 );
			}
			break;
	}

	return $action;
}

add_filter( 'bp_get_activity_action_pre_meta', 'bpmagic_activity_secondary_avatars', 10, 2 );

function bpmagic_main_nav_fallback( $args ) {
	
	$pages_args = array(
		'depth'		=> 0,
		'echo'		=> false,
		'exclude'	=> '',
		'title_li'	=> ''
	);
	
	$menu = wp_page_menu( $pages_args );
	$menu = str_replace( array( '<div class="menu"><ul>', '</ul></div>' ), array( '<ul id="nav">', '</ul><!-- #nav -->' ), $menu );
	echo $menu;

	do_action( 'bp_nav_items' );
}

/**
 * Display Notifications Menu in the Header of the theme
 *
 * @since v1.0
 */
function bpmagic_notifications_menu() {
	
	if ( class_exists( 'ClearBpNotifications' ) ) {

		ClearBpNotifications::add_notifications_menu();
		return;
	}
	
	echo '<li class="top-nav-main-item top-nav-item-first top-notification-menu"><a href="' . bp_loggedin_user_domain() . '">' . __( 'Notifications', 'bp-magic' );
	
	if ( function_exists( 'bp_notifications_get_notifications_for_user' ) ) {
		$notifications = bp_notifications_get_notifications_for_user( bp_loggedin_user_id() );
	} else {
		$notifications = bp_core_get_notifications_for_user( bp_loggedin_user_id() ); //this method is depricated in 1.9
	}
	
	if ( $notifications ) {
		?>
		<span><?php echo count( $notifications ) ?></span>
		<?php
	}

	echo '</a>';
	echo '<ul>';

	if ( $notifications ) {
		$counter = 0;
		for ( $i = 0, $count = count( $notifications ); $i < $count; ++ $i ) {
			$alt = ( 0 == $counter % 2 ) ? ' class="alt"' : '';
			?>

			<li<?php echo $alt ?>><?php echo $notifications[$i] ?></li>

			<?php
			$counter ++;
		}
	} else {
		?>

		<li><a href="<?php echo bp_loggedin_user_domain() ?>"><?php _e( 'No new notifications.', 'bp-magic' ); ?></a></li>

		<?php
	}

	echo '</ul>';
	echo '</li>';
}

/**
 * Copy of bp_profile_visibility_radio_buttons for accessibility
 */
function bpmagic_profile_visibility_radio_buttons( $field_id = false ) {
	echo bpmagic_profile_get_visibility_radio_buttons( $field_id );
}

/**
 * Return the field visibility radio buttons
 */
function bpmagic_profile_get_visibility_radio_buttons( $field_id = false ) {
	
	$html = '<ul class="radio">';
	
	if ( ! $field_id ) {
		$field_id = bp_get_the_profile_field_id();
	}
	
	foreach ( bp_xprofile_get_visibility_levels() as $level ) {
		$checked = $level['id'] == bp_get_the_profile_field_visibility_level() ? ' checked="checked" ' : '';

		$html .= '<li><label for="see-field_' . esc_attr( $level['id'] ) . $field_id . '"><input type="radio" id="see-field_' . esc_attr( $level['id'] ) . $field_id . '" name="field_' . bp_get_the_profile_field_id() . '_visibility" value="' . esc_attr( $level['id'] ) . '"' . $checked . ' /> ' . esc_html( $level['label'] ) . '</label></li>';
	}

	$html .= '</ul>';

	return apply_filters( 'bp_profile_get_visibility_radio_buttons', $html );
}

/**
 * A copy of bp_get_new_group_invite_friend_list
 * 
 * For better accesibility and presentation
 * 
 * @global type $bp
 * @param type $args
 * @return type 
 */
function bpmagic_new_group_invite_friend_list() {
	echo bpmagic_get_new_group_invite_friend_list();
}

function bpmagic_get_new_group_invite_friend_list( $args = '' ) {
	global $bp;

	if ( ! bp_is_active( 'friends' ) ) {
		return false;
	}

	$defaults = array(
		'group_id'	=> false,
		'separator' => 'li'
	);

	$r = wp_parse_args( $args, $defaults );
	extract( $r, EXTR_SKIP );

	if ( empty( $group_id ) ) {
		$group_id = ! empty( $bp->groups->new_group_id ) ? $bp->groups->new_group_id : $bp->groups->current_group->id;
	}
	
	if ( $friends = friends_get_friends_invite_list( bp_loggedin_user_id(), $group_id ) ) {
		
		$invites = groups_get_invites_for_group( bp_loggedin_user_id(), $group_id );

		for ( $i = 0, $count = count( $friends ); $i < $count; ++ $i ) {
			$checked = '';

			if ( ! empty( $invites ) ) {
				if ( in_array( $friends[$i]['id'], $invites ) ) {
					$checked = ' checked="checked"';
				}
			}
			
			$input_id = "f-{$friends[$i]['id']}";
			$items[] = '<' . $separator . '><label for="' . $input_id . '"><input' . $checked . ' type="checkbox" name="friends[]" id="' . $input_id . '" value="' . esc_attr( $friends[$i]['id'] ) . '" /> ' . $friends[$i]['full_name'] . '</label></' . $separator . '>';
		}
	}

	if ( ! empty( $items ) ) {
		return implode( "\n", (array) $items );
	}
	
	return false;
}

/**
 * show the select all/delete at the bottom of Message List
 * 
 * a modified copy of bp_messages_options()
 */
function bpmagic_messages_options() {
	?>

	<?php _e( 'Select:', 'bp-magic' ) ?>

	<select name="message-type-select" id="message-type-select">
		<option value=""></option>
		<option value="read"><?php _e( 'Read', 'bp-magic' ) ?></option>
		<option value="unread"><?php _e( 'Unread', 'bp-magic' ) ?></option>
		<option value="all"><?php _e( 'All', 'bp-magic' ) ?></option>
	</select> &nbsp;

	<?php if ( ! bp_is_current_action( 'sentbox' ) && bp_is_current_action( 'notices' ) ) : ?>

		<a href="#" id="mark_as_read"><?php _e( 'Mark as Read', 'bp-magic' ) ?></a> &nbsp;
		<a href="#" id="mark_as_unread"><?php _e( 'Mark as Unread', 'bp-magic' ) ?></a> &nbsp;

	<?php endif; ?>

	<a href="#" id="delete_<?php echo bp_current_action(); ?>_messages" class="btn btn-delete"><?php _e( 'Delete Selected', 'bp-magic' ); ?></a> &nbsp;

	<?php
}
