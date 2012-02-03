<?php
/*
 * Plugin Name: WP Slider.js
 * Plugin URI: http://www.channeleaton.com
 * Description: A feature slider that incorporates Slider.js. You can find Slider.js here: http://greweb.fr/slider/
 * Version: 1.0
 * Author: J. Aaron Eaton
 * Author URI: http://www.channeleaton.com
 * License: Apache 2.0
 */
 
 
 class WPSliderJS {
 
	protected $plugin_url;
	
 
	public function __construct() {
	
		$this->plugin_url = WP_PLUGIN_URL . '/wp-slider-js';
	
	}
	
	public function shortcode() {
	
	
	
	}
	
 }
 
 $wpsliderjs = new WPSliderJS();
 
 
 
 
 
 
 
 
 
 
 
 
/******************/
/** Slider Setup **/
/******************/

// Enqueue slider.js and jquery only on front page
add_action( 'wp_enqueue_scripts', 'js_script_enqueue' );
function js_script_enqueue() {
  
    // Get jQuery from Google APIs and enqueue it
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.js' );
    wp_enqueue_script( 'jquery' );

    // Enqueue slider.js
    wp_deregister_script( 'slider' );
    wp_register_script( 'slider', WP_PLUGIN_URL . '/js/slider.min.js' );
    wp_enqueue_script( 'slider' );
	
}


// Enqueue slider.css
add_action( 'wp_print_styles', 'css_style_enqueue' );
function css_style_enqueue() {

    wp_deregister_style( 'slider_style' );
    wp_register_style( 'slider_style', WP_PLUGIN_URL . '/css/slider.min.css' );
    wp_enqueue_style( 'slider_style' );

}

// Create function for slider.js
// Add the slider to the front page
add_action( 'thematic_abovecontainer', 'load_slider' );
function load_slider() {

    // Query for the latest featured posts
    global $post;
    $args = array(
      'category' => 218,
      'numberposts' => 3,
      'post_status' => 'publish'
    );

    $feature_posts = get_posts( $args );
    
    // Declare empty array for JSON processing
    $featured = array();

    foreach( $feature_posts as $post) : setup_postdata($post);
    // Get the featured image src
    $image_id = get_post_thumbnail_id();
    $image_url = wp_get_attachment_image_src( $image_id, 'full' );
    $image_url = $image_url[0];

    // Set post title to variable
    $ftitle = $post->post_title;

    // Set post permalink to variable
    $flink = get_permalink();

    $arr = array('src' => $image_url, 'name' => $ftitle, 'link' => $flink );

    array_push( $featured, $arr );    

endforeach;

$slides = json_encode($featured);

// Now to call Slider.js!
?>
<script type="text/javascript">
jQuery(function($) {
  var slider = new Slider($("#main-slider"));

  slider.setSize( 1072, 380 );

  slider.setPhotos(
      <?php echo $slides; ?>
    );

  slider.setDuration( 8000 );

});

</script>
      <div id="main-slider">
      </div>

<?php

}
?>