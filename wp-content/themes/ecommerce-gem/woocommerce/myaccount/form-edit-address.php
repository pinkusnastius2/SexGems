<?php
/**
 * Edit address form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-address.php.
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
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$page_title = ( 'billing' === $load_address ) ? __( 'Billing address', 'woocommerce' ) : __( 'Shipping address', 'woocommerce' );

do_action( 'woocommerce_before_edit_account_address_form' ); ?>

<?php if ( ! $load_address ) : ?>
	<?php wc_get_template( 'myaccount/my-address.php' ); ?>
<?php else : ?>

	<form method="post">

		<h3><?php echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title, $load_address ); ?></h3><?php // @codingStandardsIgnoreLine ?>

		<div class="woocommerce-address-fields">
			<?php do_action( "woocommerce_before_edit_address_form_{$load_address}" ); ?>

			<div class="woocommerce-address-fields__field-wrapper">
				<?php
							
				foreach ( $address as $key => $field ) {
					
					$field['return'] = true;
					
					if ( isset( $field['country_field'], $address[ $field['country_field'] ] ) ) {
						$field['country'] = wc_get_post_data_by_key( $field['country_field'], $address[ $field['country_field'] ]['value'] );
					}


			$theField = woocommerce_form_field( $key, $field, wc_get_post_data_by_key( $key, $field['value']) );
			//$theField = str_replace('<p', '<div class="review-input-group">', $theField);	//	Add your classes here too, if you want
			//$bits = preg_split('/</label>/', $theField, 1);
			//$theField =$bits[1];
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

			<?php do_action( "woocommerce_after_edit_address_form_{$load_address}" ); ?>

			<p>
				<button type="submit" class="button" name="save_address" value="<?php esc_attr_e( 'Save address', 'woocommerce' ); ?>"><?php esc_html_e( 'Save address', 'woocommerce' ); ?></button>
				<?php wp_nonce_field( 'woocommerce-edit_address' ); ?>
				<input type="hidden" name="action" value="edit_address" />
			</p>
		</div>

	</form>

<?php endif; ?>

<?php do_action( 'woocommerce_after_edit_account_address_form' ); ?>
