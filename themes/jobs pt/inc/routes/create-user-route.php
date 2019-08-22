<?php

add_action('rest_api_init', 'userRoutes');

function userRoutes() {
  register_rest_route('wp/v2', 'users', array(
    'methods' => 'POST',
    'callback' => 'createUser'
  ));
}

function createUser($data) {

	$user_email = $data['email'];
	$user_name = $data['username'];
	$password = $data['password'];

	$user_id = username_exists( $data['username'] );

	if ( !$user_id and email_exists($user_email) == false ) {
		
		$user_id = wp_create_user( $user_name, $password, $user_email );

		return true;

	} else {
		return false;
	}

}