<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.9
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/** @global WC_Checkout $checkout */

?>
<div class="woocommerce-billing-fields">
	<?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

		<h3><?php _e( 'Billing &amp; Shipping', 'woocommerce' ); ?></h3>

	<?php else : ?>

		<h3><?php _e( 'Billing details', 'woocommerce' ); ?></h3>

	<?php endif; ?>

	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

	<div class="woocommerce-billing-fields__field-wrapper">
		<?php
			$fields = $checkout->get_checkout_fields( 'billing' );

			foreach ( $fields as $key => $field ) {
				$field['return'] = true;
				if ( isset( $field['country_field'], $fields[ $field['country_field'] ] ) ) {
					$field['country'] = $checkout->get_value( $field['country_field'] );
				}
				$theField = woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
				
			
			$bits = explode("</label>", $theField);
			$theField = $bits[1];
			$theField = str_replace('</p>', '', $theField);
			$theField = str_replace('placeholder="', 'placeholder="'. $field['label'] .' ', $theField);
			$theField = str_replace('input-text', 'account-input-text', $theField);
			if (strpos($field['label'], "name")){
				$theField = '<div class="review-input-group"><div class="input-group-label" id="name-span"><i class="fa fa-user" id="id_'. $key .'"></i></div>' . $theField . "</div>";
			}
			if (strpos($key, "address")||strpos($key, "state")||strpos($key, "city")||strpos($key, "postcode")){
				$theField = '<div class="review-input-group"><div class="input-group-label" id="name-span"><i class="fa fa-map-marker" id="id_'. $key .'"></i></div>' . $theField . "</div>";
			}
			
			if (strpos($key, "email")){
				$theField = '<div class="review-input-group"><div class="input-group-label" id="name-span"><i class="fa fa-envelope" id="id_'. $key .'"></i></div>' . $theField . "</div>";
			}
			if (strpos($key, "phone")){
				$theField = '<div class="review-input-group"><div class="input-group-label" id="name-span"><i class="fa fa-phone" id="id_'. $key .'"></i></div>' . $theField . "</div>";
			}
		$script_for_actions ='	<script>
		jQuery("#'. $key .'").focus(function(){
    jQuery("#id_' . $key.'").css("color", "#eb286e");});
	jQuery("#'. $key .'").focusout(function(){
    jQuery("#id_'.$key.'").css("color", "#46a9c6");});
	</script>';

			

					echo $theField;
						echo $script_for_actions;
			}
		?>
	</div>
	<?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
</div>

<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
	<div class="woocommerce-account-fields">
		<?php if ( ! $checkout->is_registration_required() ) : ?>

			<p class="form-row form-row-wide create-account">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ) ?> type="checkbox" name="createaccount" value="1" /> <span><?php _e( 'Create an account?', 'woocommerce' ); ?></span>
				</label>
			</p>

		<?php endif; ?>

		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

		<?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>

			<div class="create-account">
				<?php foreach ( $checkout->get_checkout_fields( 'account' ) as $key => $field ) : 
				$field['return'] = true;?>
                
					<?php $theField = woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); 
			
			$bits = explode("</label>", $theField);
			$theField = $bits[1];
			$theField = str_replace('</p>', '', $theField);
			$theField = str_replace('placeholder="', 'placeholder="'. $field['label'] .' ', $theField);
			$theField = str_replace('input-text', 'account-input-text', $theField);
			if (strpos($field['label'], "name")){
				$theField = '<div class="review-input-group"><div class="input-group-label" id="name-span"><i class="fa fa-user" id="id_'. $key .'"></i></div>' . $theField . "</div>";
			}
			if (strpos($key, "address")||strpos($key, "state")||strpos($key, "city")||strpos($key, "postcode")){
				$theField = '<div class="review-input-group"><div class="input-group-label" id="name-span"><i class="fa fa-map-marker" id="id_'. $key .'"></i></div>' . $theField . "</div>";
			}
			
			if (strpos($key, "email")){
				$theField = '<div class="review-input-group"><div class="input-group-label" id="name-span"><i class="fa fa-envelope" id="id_'. $key .'"></i></div>' . $theField . "</div>";
			}
			if (strpos($key, "phone")){
				$theField = '<div class="review-input-group"><div class="input-group-label" id="name-span"><i class="fa fa-phone" id="id_'. $key .'"></i></div>' . $theField . "</div>";
			}
				if (strpos($key, "password")){
				$theField = '<div class="review-input-group"><div class="input-group-label" id="name-span"><i class="fa fa-key" id="id_'. $key .'"></i></div>' . $theField . "</div>";
			}
		$script_for_actions ='	<script>
		jQuery("#'. $key .'").focus(function(){
    jQuery("#id_' . $key.'").css("color", "#eb286e");});
	jQuery("#'. $key .'").focusout(function(){
    jQuery("#id_'.$key.'").css("color", "#46a9c6");});
	</script>';

			

					echo $theField;
						echo $script_for_actions;
				
				?>
				<?php endforeach; ?>
				<div class="clear"></div>
			</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
	</div>
<?php endif; ?>
