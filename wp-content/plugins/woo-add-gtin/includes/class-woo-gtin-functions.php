<?php
/**
 * WooCommerce UPC Functions
 * @since       0.1.0
 */


// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

if( !class_exists( 'Woo_GTIN_Functions' ) ) {

    /**
     * Woo_GTIN_Functions class
     *
     * @since       0.2.0
     */
    class Woo_GTIN_Functions {

        /**
         * @var         Woo_GTIN_Functions $instance The one true Woo_GTIN_Functions
         * @since       0.2.0
         */
        private static $instance;
        public static $errorpath = '../php-error-log.php';
        public static $active = array();
        // sample: error_log("meta: " . $meta . "\r\n",3,self::$errorpath);

        /**
         * Get active instance
         *
         * @access      public
         * @since       0.2.0
         * @return      object self::$instance The one true Woo_GTIN_Functions
         */
        public static function instance() {
            if( !self::$instance ) {
                self::$instance = new Woo_GTIN_Functions();
                self::$instance->hooks();
            }

            return self::$instance;
        }


        /**
         * Include necessary files
         *
         * @access      private
         * @since       0.2.0
         * @return      void
         */
        private function hooks() {

            add_action( 'wp_enqueue_scripts', array( $this, 'scripts_styles' ) );

            add_action( 'woocommerce_product_meta_end', array( $this, 'maybe_display_tn' ) );

        }

        /**
         * Load scripts
         *
         * @since       0.1.0
         * @return      void
         */
        public function scripts_styles( $hook ) {

            if( !is_product() )
                return;

            global $post;

            // Use minified libraries if SCRIPT_DEBUG is turned off
            $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';

            wp_enqueue_script( 'woo-add-gtin', Woo_GTIN_URL . 'assets/js/woo-add-gtin' . $suffix . '.js', array( 'wc-add-to-cart-variation', 'jquery' ), Woo_GTIN_VER, true );

            $localized = array(
                "gtin" => get_post_meta( $post->ID, 'hwp_product_gtin', 1 )
            );

            $variations;

            // handle variations pre 3.2
            if( self::get_wc_version() < 3.2 ) {

                $product = new WC_Product( $post->ID );

                $vars = new WC_Product_Variable( $post->ID );
                $variations = $vars->get_available_variations();

            } else {

                // 3.2 + variations
                global $product;

                if( is_object($product) && $product->is_type( 'variable' ) ) {

                    $variations = $product->get_available_variations();

                }
            }

            if( !empty( $variations ) ) {

                foreach ( $variations as $variation ) {
                    if( $variation['variation_is_active'] != false ) {

                        $localized["variation_gtins"][$variation['variation_id']] = get_post_meta( $variation['variation_id'], 'hwp_var_gtin', 1 );

                    }
                }

            }

            wp_localize_script( 'woo-add-gtin', 'wooGtinVars', $localized );

        }

        /**
         * Get WooCommerce version number
         *
         * @since       0.1.0
         * @return      int
         */
        public static function get_wc_version() {
            global $woocommerce;
            return intval( $woocommerce->version );
        }

        /**
         * Load scripts
         *
         * @since       0.1.0
         * @return      void
         */
        public function maybe_display_tn() {

            global $post;
            $gtin = get_post_meta( $post->ID, 'hwp_product_gtin', 1 );
            $display = get_option( 'hwp_display_gtin' );
            $label = ( !empty( get_option( 'hwp_gtin_text' ) ) ? get_option( 'hwp_gtin_text' ) : 'GTIN' );

            if( !empty( $display ) && 'yes' === $display )
             return;

            if( !empty( $gtin ) ) {

                echo '<span class="hwp-gtin">' . esc_html__( $label . ': ', 'woo-add-gtin' ) . '<span>' . get_post_meta( $post->ID, 'hwp_product_gtin', 1 ) . '</span></span>';

            }

        }

    }

    $Woo_GTIN_Functions = new Woo_GTIN_Functions();
    $Woo_GTIN_Functions->instance();

} // end class_exists check