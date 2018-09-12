<?php 
/*
Plugin Name: product breadcrumbs
Plugin URI: https://sexgems.co.uk
Description: Add cats to products breadcrumbs
Version: 1
Author: pinkusnastius
Author URI: http://robert.pink
*/
// Add product categories to the "Product" breadcrumb in WooCommerce.



// Get breadcrumbs on product pages that read: Home > Shop > Product category > Product Name

add_filter( 'breadcrumb_trail_items', 'woo_custom_breadcrumbs_trail_add_product_categories', 20 );



function woo_custom_breadcrumbs_trail_add_product_categories ( $trail ) {

	if ( ( get_post_type() == 'product' ) && is_singular() ) {

		global $post;

		

		$taxonomy = 'product_cat';

		

		$terms = get_the_terms( $post->ID, $taxonomy );

		$links = array();



		if ( $terms && ! is_wp_error( $terms ) ) {

		$count = 0;

			foreach ( $terms as $c ) {

				$count++;

				if ( $count > 1 ) { continue; }

				$parents = woo_get_term_parents( $c->term_id, $taxonomy, true, ', ', $c->name, array() );



				if ( $parents != '' && ! is_wp_error( $parents ) ) {

					$parents_arr = explode( ', ', $parents );

					

					foreach ( $parents_arr as $p ) {

						if ( $p != '' ) { $links[] = $p; }

					}

				}

			}

			

			// Add the trail back on to the end.

			// $links[] = $trail['trail_end'];

			$trail_end = $trail[count( $trail ) - 1];



			// Add the new links, and the original trail's end, back into the trail.

			array_splice( $trail, 2, count( $trail ) - 1, $links );

			

			$trail['trail_end'] = $trail_end;

		}

	}



	return $trail;

} // End woo_custom_breadcrumbs_trail_add_product_categories()



/**

 * Retrieve term parents with separator.

 *

 * @param int $id Term ID.

 * @param string $taxonomy.

 * @param bool $link Optional, default is false. Whether to format with link.

 * @param string $separator Optional, default is '/'. How to separate terms.

 * @param bool $nicename Optional, default is false. Whether to use nice name for display.

 * @param array $visited Optional. Already linked to terms to prevent duplicates.

 * @return string

 */



if ( ! function_exists( 'woo_get_term_parents' ) ) {

function woo_get_term_parents( $id, $taxonomy, $link = false, $separator = '/', $nicename = false, $visited = array() ) {

	$chain = '';

	$parent = &get_term( $id, $taxonomy );

	if ( is_wp_error( $parent ) )

		return $parent;



	if ( $nicename ) {

		$name = $parent->slug;

	} else {

		$name = $parent->name;

	}



	if ( $parent->parent && ( $parent->parent != $parent->term_id ) && !in_array( $parent->parent, $visited ) ) {

		$visited[] = $parent->parent;

		$chain .= woo_get_term_parents( $parent->parent, $taxonomy, $link, $separator, $nicename, $visited );

	}



	if ( $link ) {

		$chain .= '<a href="' . get_term_link( $parent, $taxonomy ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s" ), $parent->name ) ) . '">'.$parent->name.'</a>' . $separator;

	} else {

		$chain .= $name.$separator;

	}

	return $chain;

} // End woo_get_term_parents()

}
?>