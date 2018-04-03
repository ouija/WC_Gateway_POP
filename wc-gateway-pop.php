<?php
/*
 * Plugin Name: WooCommerce Pay on Pickup
 * Plugin URI: https://github.com/ouija/WC_Gateway_POP
 * Description: Extends WooCommerce by adding a payment option of pay on pickup.
 * Version: 1.0
 * Requires at least: 4.0
 * Tested up to: 4.9
 * WC requires at least: 2.5
 * WC tested up to: 3.3
 * Author: ouija
 * Author URI: http://ouija.xyz
 * License: GPLv2 or later
 * Text Domain: pop
 */

/* Initalization */
add_action( 'plugins_loaded', 'pop_init', 0 );
function pop_init() {

	/* Checks if WooCommerce is installed and activated */
	if ( ! class_exists( 'WC_Payment_Gateway' ) ) return;
	
	/* Inlcude payment gateway class */
	include_once( 'class-wc-gateway-pop.php' );

	/* Adds pop payment gateway */
	add_filter( 'woocommerce_payment_gateways', 'pop_add_gateway' );
	function pop_add_gateway( $methods ) {
		$methods[] = 'WC_Gateway_POP';
		return $methods;
	}
}

/* Plugin action links */
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'pop_action_links' );
function pop_action_links( $links ) {
	$plugin_links = array(
		'<a href="' . admin_url( 'admin.php?page=wc-settings&tab=checkout&section=pop' ) . '">' . __( 'Settings', 'pop' ) . '</a>',
	);
	return array_merge( $plugin_links, $links );	
}