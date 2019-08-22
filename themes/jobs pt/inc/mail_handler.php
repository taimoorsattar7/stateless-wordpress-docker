<?php
function set_mail_html_content_type() {
	return 'text/html';
}

function author_publish_notice( $ID ) {

	$to = get_current_user_id();
	$subject = 'Your Job'. the_title($ID) .' Is Posted';
	$message = '<h1>Congratulations!</h1> <p>You can now make changes to your Job post.</p> <p>Here is the link. <a href="' . get_permalink( $ID ) . '">' . the_title($ID) . '</a></p>';
	
	add_filter( 'wp_mail_content_type', 'set_mail_html_content_type' );
	wp_mail( $to, $subject, $message ); 
	remove_filter( 'wp_mail_content_type', 'set_mail_html_content_type' );

}