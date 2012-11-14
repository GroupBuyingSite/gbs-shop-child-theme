<?php

/**
 * This function file is loaded after the parent theme's function file. It's a great way to override functions, e.g. add_image_size sizes.
 *
 *
 */


/**
 * Redirect to the latest deal
 *
 * @return null redirect
 */
function gb_redirect_from_home() {

	if ( !is_user_logged_in() && gb_force_login_option() != 'false' ) {
		if (
			( ( is_home() || is_front_page() ) && 'subscriptions' == gb_force_login_option() ) ||
			gb_on_login_page() ||
			gb_on_reset_password_page() ) {
			return;
		} else {
			gb_set_message( gb__( 'Force Login Activated, Membership Required.' ) );
			gb_login_required();
			return;
		}
	}

	if ( is_home() ) {
		if ( is_user_logged_in() || gb_has_location_preference() ) { // redirect for logged in users
			wp_redirect( apply_filters( 'gb_latest_deal_redirect', gb_get_latest_deal_link() ) );
			exit();
		}
	}
}
add_action( 'pre_gbs_head', 'gb_redirect_from_home' );