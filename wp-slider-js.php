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
	
 } // Class: WPSliderJS
 
 $wpSliderJs = new WPSliderJS();