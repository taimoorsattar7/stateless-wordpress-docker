<?php 
function underline_features() {
  add_theme_support('post-thumbnails');
  add_image_size('Square', 128, 128, true);
  add_image_size('Portrait', 480, 650, true);
  add_image_size('pageBanner', 1000, 420, true);
}

add_action('after_setup_theme', 'underline_features');
