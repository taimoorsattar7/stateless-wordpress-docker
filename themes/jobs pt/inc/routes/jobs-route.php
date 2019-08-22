<?php

add_action('rest_api_init', 'jobsMinSearch');

function jobsMinSearch() {
  register_rest_route('jobs/v1', 'searchMin', array(
    'methods' => WP_REST_SERVER::READABLE,
    'callback' => 'jobsMinResults'
  ));
}


function jobsMinResults($data) {

  $mainQuery = new WP_Query(array(
    'post_type' => array('jobpost')
  ));

  $results = array(
    'generalInfo' => array()
  );

  while($mainQuery->have_posts()) {
    $mainQuery->the_post();

    if (get_post_type() == 'jobpost') {
      array_push($results['generalInfo'], array(
        'id' => get_the_ID(),
        'title' => get_the_title(),
        'permalink' => get_the_permalink(),
        'slug' => get_the_slug(),
        'postType' => get_post_type(),
        'authorName' => get_the_author()
      ));
    }
  }

  return $results;

}