<?php
/*
Plugin Name: DC -  Widget for Elementor
Description: Ein individuelles Timeline-Widget für Elementor.
Version: 1.0
Author: Dirk Schoemakers
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function ctle_register_elementor_widget( $widgets_manager ) {
  require_once( __DIR__ . '/widget-timeline.php' );
  $widgets_manager->register( new \CTLE_Timeline_Widget() );
}
add_action( 'elementor/widgets/register', 'ctle_register_elementor_widget' );

function ctle_enqueue_styles() {
  wp_register_style( 'ctle-timeline-style', plugins_url( 'timeline.css', __FILE__ ) );
  wp_enqueue_style( 'ctle-timeline-style' );
}
add_action( 'wp_enqueue_scripts', 'ctle_enqueue_styles' );
