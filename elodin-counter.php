<?php
/*
	Plugin Name: Counter
	Plugin URI: https://github.com/jonschr/elodin-counter
	Description: Just another counter plugin
	Version: 0.2.2
    Author: Jon Schroeder
    Author URI: http://elod.in

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
    GNU General Public License for more details.
*/

// Plugin Directory 
define( 'ELODIN_COUNTER_DIR', dirname( __FILE__ ) );
define( 'ELODIN_COUNTER_VERSION', '0.2.2' );

//* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'elodin_counter_add_scripts' );
function elodin_counter_add_scripts() {

    wp_register_script( 'elodin-counter-waypoints', '//cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js', array( 'jquery' ), ELODIN_COUNTER_VERSION, false );
    wp_register_script( 'elodin-counter', plugins_url( '/js/counter.min.js', __FILE__), array( 'elodin-counter-waypoints' ), ELODIN_COUNTER_VERSION, false );
    wp_register_script( 'elodin-counter-init', plugins_url( '/js/counter-init.js', __FILE__), array( 'elodin-counter' ), ELODIN_COUNTER_VERSION, false );
}

///////////////
// SHORTCODE //
///////////////

function counter_shortcode( $atts ) {
    
    wp_enqueue_script( 'elodin-counter-waypoints' );
    wp_enqueue_script( 'elodin-counter' );
    wp_enqueue_script( 'elodin-counter-init' );
    
    $atts = shortcode_atts( array(
        'number'   => null,
        'delay'    => 10,
        'time'     => 2000,
    ), $atts );
        
    $output = sprintf( '<span data-delay="%s" data-time="%s" class="elodin-counter">%s</span>', $atts['delay'], $atts['time'], $atts['number'] );
    return $output;
}
add_shortcode( 'counter', 'counter_shortcode' );