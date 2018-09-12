<?php
/**
 * Lost password form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-lost-password.php.
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

wc_print_notices(); ?>

<form method="post" class="woocommerce-ResetPassword lost_reset_password">
<div>
	<p><?php echo apply_filters( 'woocommerce_lost_password_message', esc_html__( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'woocommerce' ) ); ?></p><?php // @codingStandardsIgnoreLine ?>


</div>
<?php /*		<label for="user_login"><?php esc_html_e( 'Username or email', 'woocommerce' ); ?></label> */?>
		<div class="review-input-group"><div class="input-group-label" id="name-span">
        <i class="fa fa-envelope" id="user1"></i></div><input class="woocommerce-Input woocommerce-Input--text input-text account-input-text" placeholder="<?php esc_html_e( 'Username or email', 'woocommerce' ); ?>" type="text" name="user_login" id="user_login" /></div>


	<div class="clear"></div>

	<?php do_action( 'woocommerce_lostpassword_form' ); ?>

	<p class="woocommerce-form-row form-row">
		<input type="hidden" name="wc_reset_password" value="true" />
		<button type="submit" class="woocommerce-Button button" value="<?php esc_attr_e( 'Reset password', 'woocommerce' ); ?>"><?php esc_html_e( 'Reset password', 'woocommerce' ); ?></button>
	</p>

	<?php wp_nonce_field( 'lost_password' ); ?>

</form>

<script>
		jQuery("#user_login").focus(function(){
    jQuery("#user1").css("color", "#eb286e");});
	jQuery("#user_login").focusout(function(){
    jQuery("#user1").css("color", "#46a9c6");});
	</script>