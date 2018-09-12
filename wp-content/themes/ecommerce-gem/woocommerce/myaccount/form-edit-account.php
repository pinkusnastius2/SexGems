<?php
/**
 * Edit account form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-edit-account.php.
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

do_action( 'woocommerce_before_edit_account_form' ); ?>

<form class="woocommerce-EditAccountForm edit-account" action="" method="post">
	<div class="woocommerce-address-fields">

	<?php do_action( 'woocommerce_edit_account_form_start' ); ?>

	<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-wide">
		<?php /*<label for="account_first_name"><?php esc_html_e( 'First name', 'woocommerce' ); ?> <span class="required">*</span></label>*/?>
		<div class="review-input-group"><div class="input-group-label" id="name-span">
        <i class="fa fa-user" id="id_first"></i></div><input type="text" class="woocommerce-Input woocommerce-Input--text input-text account-input-text" name="account_first_name" placeholder="<?php esc_html_e( 'First name', 'woocommerce' ); ?>" id="account_first_name" value="<?php echo esc_attr( $user->first_name ); ?>" /></div>
	</p>
	<p class="woocommerce-form-row woocommerce-form-row--last form-row form-row-wide">
		<?php /*<label for="account_last_name"><?php esc_html_e( 'Last name', 'woocommerce' ); ?> <span class="required">*</span></label>*/?>
				<div class="review-input-group"><div class="input-group-label" id="name-span">
        <i class="fa fa-user" id="id_last"></i></div><input type="text" placeholder="<?php esc_html_e( 'Last name', 'woocommerce' ); ?>" class="woocommerce-Input woocommerce-Input--text input-text account-input-text" name="account_last_name" id="account_last_name" value="<?php echo esc_attr( $user->last_name ); ?>" /></div>
	</p>
	<div class="clear"></div>

	<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
		<?php /*<label for="account_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>*/?>
		<div class="review-input-group"><div class="input-group-label" id="name-span">
        <i class="fa fa-envelope" id="id_email"></i></div><input type="email" class="woocommerce-Input woocommerce-Input--email input-text account-input-text" name="account_email" placeholder="<?php esc_html_e( 'Email address', 'woocommerce' ); ?>" id="account_email" value="<?php echo esc_attr( $user->user_email ); ?>" /></div>
	</p>

	<fieldset>
		<legend><?php esc_html_e( 'Password change', 'woocommerce' ); ?></legend>

		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<?php /*<label for="password_current"><?php esc_html_e( 'Current password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>*/?><div class="review-input-group"><div class="input-group-label" id="name-span">
        <i class="fa fa-key" id="id_pass"></i></div><input type="password" class="woocommerce-Input woocommerce-Input--password input-text account-input-text" placeholder="<?php esc_html_e( 'Current password (leave blank to leave unchanged)', 'woocommerce' ); ?>" name="password_current" id="password_current" /></div>
		</p>
		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<?php /*<label for="password_1"><?php esc_html_e( 'New password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>*/?>
			<div class="review-input-group"><div class="input-group-label" id="name-span">
        <i class="fa fa-key" id="id_newpass"></i></div><input type="password" class="woocommerce-Input woocommerce-Input--password input-text account-input-text" placeholder="<?php esc_html_e( 'New password (leave blank to leave unchanged)', 'woocommerce' ); ?>" name="password_1" id="password_1" /></div>
		</p>
		<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
			<?php /*label for="password_2"><?php esc_html_e( 'Confirm new password', 'woocommerce' ); ?></label>*/?>
            <div class="review-input-group"><div class="input-group-label" id="name-span">
        <i class="fa fa-key" id="id_confirm"></i></div>
			<input type="password" class="woocommerce-Input woocommerce-Input--password input-text account-input-text" placeholder="<?php esc_html_e( 'Confirm new password', 'woocommerce' ); ?>" name="password_2" id="password_2" /></div>
		</p>
	</fieldset>
	<div class="clear"></div>

	<?php do_action( 'woocommerce_edit_account_form' ); ?>

	<p>
		<?php wp_nonce_field( 'save_account_details' ); ?>
		<button type="submit" class="woocommerce-Button button" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>"><?php esc_html_e( 'Save changes', 'woocommerce' ); ?></button>
		<input type="hidden" name="action" value="save_account_details" />
	</p>
    <script>
		jQuery("#account_first_name").focus(function(){
    jQuery("#id_first").css("color", "#eb286e");});
	jQuery("#account_first_name").focusout(function(){
    jQuery("#id_first").css("color", "#46a9c6");});
	jQuery("#account_last_name").focus(function(){
    jQuery("#id_last").css("color", "#eb286e");});
	jQuery("#account_last_name").focusout(function(){
    jQuery("#id_last").css("color", "#46a9c6");}); 
	jQuery("#account_email").focus(function(){
    jQuery("#id_email").css("color", "#eb286e");});
	jQuery("#account_email").focusout(function(){
    jQuery("#id_email").css("color", "#46a9c6");});
	jQuery("#password_current").focus(function(){
    jQuery("#id_pass").css("color", "#eb286e");});
	jQuery("#password_current").focusout(function(){
    jQuery("#id_pass").css("color", "#46a9c6");}); 
    jQuery("#password_1").focus(function(){
    jQuery("#id_newpass").css("color", "#eb286e");});
	jQuery("#password_1").focusout(function(){
    jQuery("#id_newpass").css("color", "#46a9c6");});
	jQuery("#password_2").focus(function(){
    jQuery("#id_confirm").css("color", "#eb286e");});
	jQuery("#password_2").focusout(function(){
    jQuery("#id_confirm").css("color", "#46a9c6");});</script>


	<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
    </div>
</form>

<?php do_action( 'woocommerce_after_edit_account_form' ); ?>
