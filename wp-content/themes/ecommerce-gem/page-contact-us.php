<?php

  //response generation function

  $response = "";

  //function to generate response
  function my_contact_form_generate_response($type, $message){

    global $response;

    if($type == "success") $response = "<div class='success'>{$message}</div>";
    else $response = "<div class='error'>{$message}</div>";

  }

  //response messages
  $not_human       = "Human verification incorrect.";
  $missing_content = "Please supply all information.";
  $email_invalid   = "Email Address Invalid.";
  $message_unsent  = "Message was not sent. Try Again.";
  $message_sent    = "Thanks! Your message has been sent.";

  //user posted variables
  $name = $_POST['message_name'];
  $email = $_POST['message_email'];
  $message = $_POST['message_text'];
  $destination = $_POST['destination'];

  //php mailer variables
  $to = $destination;
  $subject = "Someone sent a message from ".get_bloginfo('name');
  $headers = 'From: '. $email . "\r\n" .
    'Reply-To: ' . $email . "\r\n";

      //validate email
if(!empty($destination)){
      if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        my_contact_form_generate_response("error", $email_invalid);
      else //email is valid
      {
        //validate presence of name and message
        if(empty($name) || empty($message)){
          my_contact_form_generate_response("error", $missing_content);
        }
        else //ready to go!
        {
          $sent = wp_mail($to, $subject, strip_tags($message), $headers);
          if($sent) my_contact_form_generate_response("success", $message_sent); //message sent!
          else my_contact_form_generate_response("error", $message_unsent); //message wasn't sent
        }
      }
}
    
?>

<?php get_header(); ?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_GB/sdk/xfbml.customerchat.js#xfbml=1&version=v2.12&autoLogAppEvents=1';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Your customer chat code -->
<div class="fb-customerchat"
  attribution="setup_tool"
  page_id="399222717211986"
  theme_color="#eb286e">
</div>
  <div id="primary" class="site-content">
    <div id="content" role="main">

      <?php while ( have_posts() ) : the_post(); ?>

          <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <header class="entry-header">
              <h1 class="entry-title"><?php the_title(); ?></h1>
            </header>

            <div class="entry-content">
              <?php the_content(); ?>

              <style type="text/css">
                .error{
                  padding: 5px 9px;
                  border: 1px solid #eb286e;
                  color: #eb286e;
                  border-radius: 3px;
                }

                .success{
                  padding: 5px 9px;
                  border: 1px solid #46a9c6;
                  color: #46a9c6;
                  border-radius: 3px;
                }
				.contact-message, select{
					border-top: 1px solid #46a9c6;
					border-left: 1px solid #46a9c6;
					border-right: 1px solid #eb286e;
					border-bottom: 1px solid #eb286e;	
				}
				select {
					width: 210px;
				}
                form span{
                  color: red;
                }
				input{
					color:#46a9c6;
				}
				
              </style>

              <div id="respond">
                <?php echo $response; ?>
                <form action="<?php the_permalink(); ?>" method="post">
                <p><div class="review-input-group"><label for="destination" >Please select the appropiate department for your query so that we can answer you as soon as possible
                <select name="destination">
                	<option value="sales@sexgems.co.uk">Sales</option>
                    <option value="support@sexgems.co.uk">Support</option>
                </select></label></div>
                </p>
                  <p><div class="review-input-group"><div class="input-group-label" id="name-span">
        <i class="fa fa-user" id="lb_name"></i></div><input id="name" type="text" name="message_name" placeholder="Your Name" value="<?php echo esc_attr($_POST['message_name']); ?>"></div></p>
                  <p><div class="review-input-group"><div class="input-group-label" id="name-span">
        <i class="fa fa-envelope" id="lb_email"></i></div><input id="email" type="text" name="message_email" value="<?php echo esc_attr($_POST['message_email']); ?>" placeholder="Your Email Address"></div></p>
                  <p><div class="review-input-group"><textarea class="contact-message" type="text" name="message_text" placeholder="Your Message"><?php echo esc_textarea($_POST['message_text']); ?></textarea></div></p>
                  <input type="hidden" name="submitted" value="1">
                  <p><input type="submit"></p>
                </form>
              </div>
              <script>
		jQuery("#name").focus(function(){
    jQuery("#lb_name").css("color", "#eb286e");});
	jQuery("#name").focusout(function(){
    jQuery("#lb_name").css("color", "#46a9c6");});
	jQuery("#email").focus(function(){
    jQuery("#lb_email").css("color", "#eb286e");});
	jQuery("#email").focusout(function(){
    jQuery("#lb_email").css("color", "#46a9c6");});</script>



            </div><!-- .entry-content -->

          </article><!-- #post -->

      <?php endwhile; // end of the loop. ?>

    </div><!-- #content -->
  </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>