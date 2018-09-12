<?php
/**
 * Shipping Calculator
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/shipping-calculator.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( 'no' === get_option( 'woocommerce_enable_shipping_calc' ) || ! WC()->cart->needs_shipping() ) {
	return;
}

wp_enqueue_script( 'wc-country-select' );

do_action( 'woocommerce_before_shipping_calculator' ); ?>

<form class="woocommerce-shipping-calculator" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

	<p><a href="#" class="shipping-calculator-button"><?php esc_html_e( 'Calculate shipping', 'woocommerce' ); ?></a></p>

	<section class="shipping-calculator-form" style="display:none;">


			<select name="calc_shipping_country" id="calc_shipping_country" class="country_to_state country_select" rel="calc_shipping_state">
				<option value=""><?php esc_html_e( 'Select a country&hellip;', 'woocommerce' ); ?></option>
				<?php
				foreach ( WC()->countries->get_shipping_countries() as $key => $value ) {
					echo '<option value="' . esc_attr( $key ) . '"' . selected( WC()->customer->get_shipping_country(), esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>';
				}
				?>
			</select>
           

			<?php
			$current_cc = WC()->customer->get_shipping_country();
			$current_r  = WC()->customer->get_shipping_state();
			$states     = WC()->countries->get_states( $current_cc );

			if ( is_array( $states ) && empty( $states ) ) {
				?><div class="review-input-group"><div class="input-group-label" id="lpl"><i class="fa fa-map-marker" id="lb-state"></i></div><input type="hidden" name="calc_shipping_state" id="calc_shipping_state" placeholder="<?php esc_attr_e( 'State / County', 'woocommerce' ); ?>" /></div>
				<script>
		jQuery("#calc_shipping_state").focus(function(){
    jQuery("#lb-state").css("color", "#eb286e");});
	jQuery("#calc_shipping_state").focusout(function(){
    jQuery("#lb-state").css("color", "#46a9c6");});
	</script><?php
			} elseif ( is_array( $states ) ) {
				?><span>
					<select name="calc_shipping_state" class="state_select" id="calc_shipping_state" placeholder="<?php esc_attr_e( 'State / County', 'woocommerce' ); ?>">
						<option value=""><?php esc_html_e( 'Select a state&hellip;', 'woocommerce' ); ?></option>
						<?php
						foreach ( $states as $ckey => $cvalue ) {
							echo '<option value="' . esc_attr( $ckey ) . '" ' . selected( $current_r, $ckey, false ) . '>' . esc_html( $cvalue ) . '</option>';
						}
						?>
					</select>
				</span><?php
			} else {
				?><div class="review-input-group"><div class="input-group-label" id="lb-state"><i class="fa fa-map-marker" id="lb-state"></i></div><input type="text" class="input-text" value="<?php echo esc_attr( $current_r ); ?>" placeholder="<?php esc_attr_e( 'State / County', 'woocommerce' ); ?>" name="calc_shipping_state" id="calc_shipping_state" /></div>	<script>
		jQuery("#calc_shipping_state").focus(function(){
    jQuery("#lb-state").css("color", "#eb286e");});
	jQuery("#calc_shipping_state").focusout(function(){
    jQuery("#lb-state").css("color", "#46a9c6");});
	</script><?php
			}
			?>

		<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_city', true ) ) : ?>

				<div class="review-input-group"><div class="input-group-label" id="lb-state"><i class="fa fa-map-marker" id="lb-city"></i></div><input type="text" class="input-text" value="<?php echo esc_attr( WC()->customer->get_shipping_city() ); ?>" placeholder="<?php esc_attr_e( 'City', 'woocommerce' ); ?>" name="calc_shipping_city" id="calc_shipping_city" /></div>
				<script>
		jQuery("#calc_shipping_city").focus(function(){
    jQuery("#lb-city").css("color", "#eb286e");});
	jQuery("#calc_shipping_city").focusout(function(){
    jQuery("#lb-city").css("color", "#46a9c6");});
	</script>
           

		<?php endif; ?>

		<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_postcode', true ) ) : ?>


				<div class="review-input-group"><div class="input-group-label" id="lb-state"><i class="fa fa-map-marker" id="lb-postcode'"></i></div><input type="text" class="input-text" value="<?php echo esc_attr( WC()->customer->get_shipping_postcode() ); ?>" placeholder="<?php esc_attr_e( 'Postcode / ZIP', 'woocommerce' ); ?>" name="calc_shipping_postcode" id="calc_shipping_postcode" />
				<script>
		jQuery("#calc_shipping_postcode").focus(function(){
    jQuery("#lb-postcode").css("color", "#eb286e");});
	jQuery("#calc_shipping_postcode").focusout(function(){
    jQuery("#lb-postcode").css("color", "#46a9c6");});
	</script>
           
		<?php endif; ?>


		<br /><button type="submit" name="calc_shipping" value="1" class="button"><?php esc_html_e( 'Update totals', 'woocommerce' ); ?></button>

		<?php wp_nonce_field( 'woocommerce-cart' ); ?>
	</section>
</form>

<?php do_action( 'woocommerce_after_shipping_calculator' ); ?>
