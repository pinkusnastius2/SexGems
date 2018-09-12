<?php
/**
 * Load files.
 *
 * @package eCommerce_Gem
 */

// Remove rating info from featured products.
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

//=============================================================
// Change number of product per row
//=============================================================

if (!function_exists('ecommerce_gem_product_columns')) {

	function ecommerce_gem_product_columns() {

		return 3; // 3 products per row

	}
	
}

add_filter('loop_shop_columns', 'ecommerce_gem_product_columns');

//=============================================================
// Change number of related product
//=============================================================

if (!function_exists('ecommerce_gem_related_products_args')) {

	function ecommerce_gem_related_products_args( $args ) {

		$args['columns']   		= 3;
		
		$args['posts_per_page'] = 3; // 3 related products
		
		return $args;
	}

}

add_filter( 'woocommerce_output_related_products_args', 'ecommerce_gem_related_products_args' );


//=============================================================
// Change number of upsell products
//=============================================================

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

add_action( 'woocommerce_after_single_product_summary', 'ecommerce_gem_output_upsells', 15 );

if ( ! function_exists( 'ecommerce_gem_output_upsells' ) ) {

	function ecommerce_gem_output_upsells() {

	    woocommerce_upsell_display( 3, 3 ); // Display 3 products in rows of 3
	    
	}

}

remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );

remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );


add_action( 'woocommerce_shop_loop_item_title', 'ecommerce_gem_woocommerce_template_loop_product_title', 10 );

if ( ! function_exists( 'ecommerce_gem_woocommerce_template_loop_product_title' ) ) {

	/**
	 * Show the product title in the product loop. By default this is an H2.
	 */
	function ecommerce_gem_woocommerce_template_loop_product_title() {
		echo '<h2 class="woocommerce-loop-product__title">' . get_the_title() . '</h2>';
		echo '</a>';
	}
}
