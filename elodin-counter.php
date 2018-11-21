<?php
/*
	Plugin Name: Counter
	Plugin URI: https://github.com/jonschr/elodin-counter
    GitHub Plugin URI: https://github.com/jonschr/elodin-counter
	Description: Just another counter plugin
	Version: 0.1
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
define( 'COUNTER_DIR', dirname( __FILE__ ) );

//* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'elodin_counter_add_scripts' );
function elodin_counter_add_scripts() {

    wp_register_script( 'elodin-counter-waypoints', '//cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js', array( 'jquery' ), false, false );

    wp_register_script( 'elodin-counter', plugins_url( '/js/counter.min.js', __FILE__), array( 'jquery', 'elodin-counter-waypoints' ), false, false );

}

///////////////
// SHORTCODE //
///////////////

function counter_shortcode( $atts ) {
    
    // Waypoints
    wp_enqueue_script( 'elodin-counter-waypoints' );

    // Jquery counter
    wp_enqueue_script( 'elodin-counter' );

    $atts = shortcode_atts( array(
        'number'   => null,
        'delay'    => 10,
        'time'     => 2000,
    ), $atts );

    $number = $atts['number'];
    $rand = rand( 1, 10000 );
    ?>
    <script>
        jQuery(document).ready(function($) {
            $('.counter-<?php echo $rand; ?>').counterUp({
                delay: <?php echo $atts['delay']; ?>,
                time: <?php echo $atts['time']; ?>,
            });
        });
    </script>

    <?php
    // return "foo = {$atts['foo']}";
    
    $output = sprintf( '<span class="counter counter-%s">%s</span>', $rand, $number );
    return $output;
}
add_shortcode( 'counter', 'counter_shortcode' );