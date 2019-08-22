<?php
/*
function add_cat_job ($query) {
	if( empty($query->query['post_type'])or
		$query->query['post_type'] === 'post'){

		$query->set('post_type', array('post', 'page', 'jobpost'));
}
}

add_action('pre_get_posts', 'add_cat_job');

*/
function themeprefix_show_cpt_archives( $query ) {
	if( is_category() || is_tag() && 
		empty( $query->query_vars['suppress_filters'] ) ) {
		$query->set( 'post_type', array(
			'post', 'nav_menu_item', 'jobpost'
		));
		return $query;
	}
}
add_filter( 'pre_get_posts', 'themeprefix_show_cpt_archives' );