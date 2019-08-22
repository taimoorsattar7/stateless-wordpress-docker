<?php

add_action('rest_api_init', 'jobRoutes');

function jobRoutes() {
  register_rest_route('wp/v2', 'jobpost', array(
    'methods' => 'POST',
    'callback' => 'createjob'
  ));
}

function createjob($data) {

  if ( is_email( $data['applyLink'] ) ) {
    return;
  }

  $title = sanitize_text_field($data['title']);

  $content = $data['content'];

  $applyLink = sanitize_text_field($data['applyLink']);

  $titleCOM = sanitize_text_field($data['title_company']);

  $contentCOM = $data['content_company'];

  $urlCOM = $data['URL_company'];

  $status = sanitize_text_field($data['status']);
  


  if($data['doing']){

    $my_post = array(
      'ID'           => $data['ID'],
      'post_title'   => $title,
      'post_content' => $content,

      'meta_input' => array(
        'apply_link' => $applyLink,
        'company_url' => $urlCOM,
        'about_company' => $contentCOM,
        'company_name'=> $titleCOM  ));

    wp_update_post( $my_post, true );

    return $my_post;

  }
  
  else{
    $category = get_category_by_slug( 'category' );

    $ffoo=wp_insert_post(array(
      'post_type' => 'jobpost',
      'author' => get_current_user_id(),
      'post_status' => 'publish',
      'post_title' => $title,
      'post_content' => $content,
      'meta_input' => array(
        'apply_link' => $applyLink,
        'about_company' => $contentCOM,
        'company_url' => $urlCOM,
        'company_name'=> $titleCOM
      )
    ));
    if ($ffoo) {
    # code...
      author_publish_notice( $ffoo );
      /*wp_set_object_terms( $ffoo, , 'category');*/
      return get_permalink($ffoo);
    }
  }
  
}

