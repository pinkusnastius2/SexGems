<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
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
	exit; // Exit if accessed directly.
}

?>

<?php wc_print_notices(); ?>

<?php do_action( 'woocommerce_before_customer_login_form' ); ?>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

<div class="u-columns col2-set" id="customer_login">

	<div class="u-column1 col-1">

<?php endif; ?>

		<h2><?php esc_html_e( 'Login', 'woocommerce' ); ?></h2>

		<form class="woocommerce-form woocommerce-form-login login" method="post">

			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<?php /*<label for="username"><?php esc_html_e( 'Username or email address', 'woocommerce' ); ?> <span class="required">*</span></label>*/ ?>
				<div class="review-input-group"><div class="input-group-label" id="name-span">
        <i class="fa fa-envelope" id="user1"></i></div><input type="email" class="woocommerce-Input woocommerce-Input--text input-text account-input-text" placeholder="<?php esc_html_e( 'Username or email address', 'woocommerce' ); ?>"name="username" id="username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /></div><?php // @codingStandardsIgnoreLine ?>
			</p>
			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<?php /*<label for="password"><?php esc_html_e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label> */?>
				<div class="review-input-group"><div class="input-group-label" id="name-span">
        <i class="fa fa-key" id="password1"></i></div><input class="woocommerce-Input woocommerce-Input--text input-text account-input-text" type="password" name="password" id="password" placeholder="<?php esc_html_e( 'Password', 'woocommerce' ); ?>" /></div>
			</p>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<p class="form-row">
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				<button type="submit" class="woocommerce-Button button" name="login" value="<?php esc_attr_e( 'Login', 'woocommerce' ); ?>"><?php esc_html_e( 'Login', 'woocommerce' ); ?></button>
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox inline">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <span><?php esc_html_e( 'Remember me', 'woocommerce' ); ?></span>
				</label>
			</p>
			<p class="woocommerce-LostPassword lost_password">
				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php esc_html_e( 'Lost your password?', 'woocommerce' ); ?></a>
			</p>

			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>

<?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>

	</div>

	<div class="u-column2 col-2">

		<h2><?php esc_html_e( 'Register', 'woocommerce' ); ?></h2>

		<form method="post" class="register">

			<?php do_action( 'woocommerce_register_form_start' ); ?>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<?php /*<label for="reg_username"><?php esc_html_e( 'Username', 'woocommerce' ); ?> <span class="required">*</span></label>*/?>
					<div class="review-input-group"><div class="input-group-label" id="name-span">
        <i class="fa fa-envelope" id="user2"></i></div><input type="text" placeholder="<?php esc_html_e( 'Username', 'woocommerce' ); ?> " class="woocommerce-Input woocommerce-Input--text input-text account-input-text" name="username" id="reg_username" value="<?php echo ( ! empty( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" /></div><?php // @codingStandardsIgnoreLine ?>
				</p>

			<?php endif; ?>

			<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
				<?php /*<label for="reg_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?> <span class="required">*</span></label>*/?>
				<div class="review-input-group"><div class="input-group-label" id="name-span">
        <i class="fa fa-envelope" id="user2"></i></div><input type="email" placeholder="<?php esc_html_e( 'Email address', 'woocommerce' ); ?>" class="woocommerce-Input woocommerce-Input--text input-text account-input-text" name="email" id="reg_email" value="<?php echo ( ! empty( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" /></div><?php // @codingStandardsIgnoreLine ?>
			</p>

			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>

				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<?php /*<label for="reg_password"><?php esc_html_e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label> */?>
					<div class="review-input-group"><div class="input-group-label" id="name-span">
        <i class="fa fa-key" id="password2"></i></div><input type="password" placeholder="<?php esc_html_e( 'Password', 'woocommerce' ); ?>" class="woocommerce-Input woocommerce-Input--text input-text account-input-text" name="password" id="reg_password" /></div>
				</p>

			<?php endif; ?>

			<?php do_action( 'woocommerce_register_form' ); ?>

			<p class="woocommerce-FormRow form-row">
				<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
				<button type="submit" class="woocommerce-Button button" name="register" value="<?php esc_attr_e( 'Register', 'woocommerce' ); ?>"><?php esc_html_e( 'Register', 'woocommerce' ); ?></button>
			</p>

			<?php do_action( 'woocommerce_register_form_end' ); ?>

		</form>

	</div>

</div>
<script>
		jQuery("#username").focus(function(){
    jQuery("#user1").css("color", "#eb286e");});
	jQuery("#username").focusout(function(){
    jQuery("#user1").css("color", "#46a9c6");});
	jQuery("#password").focus(function(){
    jQuery("#password1").css("color", "#eb286e");});
	jQuery("#password").focusout(function(){
    jQuery("#password1").css("color", "#46a9c6");});
	jQuery("#reg_username").focus(function(){
    jQuery("#user2").css("color", "#eb286e");});
	jQuery("#reg_username").focusout(function(){
    jQuery("#user2").css("color", "#46a9c6");});
	jQuery("#reg_password").focus(function(){
    jQuery("#password2").css("color", "#eb286e");});
	jQuery("#reg_password").focusout(function(){
    jQuery("#password2").css("color", "#46a9c6");});
	jQuery("#reg_email").focus(function(){
    jQuery("#user2").css("color", "#eb286e");});
	jQuery("#reg_email").focusout(function(){
    jQuery("#user2").css("color", "#46a9c6");}); </script>
<?php endif; ?>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
