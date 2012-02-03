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
 
	public function __construct() {
		
		$this->plugin_url = WP_PLUGIN_URL . '/wp-slider-js';
		
		// Set up actions to enqueue scripts & styles
		add_action( 'wp_enqueue_scripts', array( &$this, 'wpsjs_js_enqueue' ) );
		add_action( 'wp_print_styles', array( &$this, 'wpsjs_css_enqueue' ) );
	
	}
	
	// Enqueue jQuery from the Google API and the Slider.js file locally
	public function wpsjs_js_enqueue() {
	
		// Get jQuery from Google APIs and enqueue it
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.js' );
		wp_enqueue_script( 'jquery' );

		// Enqueue slider.js
		wp_deregister_script( 'slider' );
		wp_register_script( 'slider', $this->plugin_url . '/js/slider.min.js' );
		wp_enqueue_script( 'slider' );
	
	}
	
	// Print the slider style
	public function wpsjs_css_enqueue() {
	
		wp_deregister_style( 'slider_style' );
		wp_register_style( 'slider_style', $this->plugin_url . '/css/slider.min.css' );
		wp_enqueue_style( 'slider_style' );
	
	}
	
	// Set up the image query. Will retrieve featured images from the specified category.
	public function wpsjs_show_slider( $name, $category, $image_limit = 5, $height = 800, $width = 600, $duration = 5000 ) {
	
		// Query for the latest featured posts
		global $post;
		$args = array(
		  'category' => $category,
		  'numberposts' => $image_limit,
		  'post_status' => 'publish'
		);

		$slider_posts = get_posts( $args );
		
		// Declare empty array for JSON processing
		$images = array();

		foreach( $slider_posts as $post) : setup_postdata($post);
			// Get the featured image src
			$image_id = get_post_thumbnail_id();
			$image_url = wp_get_attachment_image_src( $image_id, 'full' );
			$image_url = $image_url[0];

			// Set post title to variable
			$ftitle = $post->post_title;

			// Set post permalink to variable
			$flink = get_permalink();

			$arr = array('src' => $image_url, 'name' => $ftitle, 'link' => $flink );

			array_push( $images, $arr );    

		endforeach;

		$slides = json_encode($images);

		// Now to call Slider.js!
		?>
		<script type="text/javascript">
		jQuery(function($) {
		  var slider = new Slider($("#<?php echo $name; ?>"));

		  slider.setSize( <?php echo $height; ?>, <?php echo $width; ?> );

		  slider.setPhotos(
			  <?php echo $slides; ?>
			);

		  slider.setDuration( <?php echo $duration; ?> );

		});

		</script>
		
		<div id="<?php echo $name; ?>">
			<?php print_r( $height ); ?>
		</div>
	<?php
	}
	
 } // Class: WPSliderJS
 
 $wpSliderJs = new WPSliderJS();
 
 
 // Set up the template tag
 function wp_slider_js( $name, $category, $image_limit = 5, $height = 800, $width = 600, $duration = 5000 ) {
 
	$wpsjs_add_slider = new WPSliderJS;
	echo $wpsjs_add_slider->wpsjs_show_slider( $name, $category, $image_limit, $height, $width, $duration );
 
 }