<?php
     if ( ! isset( $_SESSION ) ) session_start();
    /*
    Template Name: Contact Page
    */
?>
<?php
    $et_ptemplate_settings = array();
    $et_ptemplate_settings = maybe_unserialize( get_post_meta(get_the_ID(),'et_ptemplate_settings',true) );
    
    $fullwidth = isset( $et_ptemplate_settings['et_fullwidthpage'] ) ? (bool) $et_ptemplate_settings['et_fullwidthpage'] : false;
    
    $et_regenerate_numbers = isset( $et_ptemplate_settings['et_regenerate_numbers'] ) ? (bool) $et_ptemplate_settings['et_regenerate_numbers'] : false;
    
    $et_error_message = '';
    $et_contact_error = false;
    
    if ( isset($_POST['et_contactform_submit']) ) {
        if ( !isset($_POST['et_contact_captcha']) || empty($_POST['et_contact_captcha']) ) {
            $et_error_message .= '<p>' . esc_html__('Make sure you entered the captcha. ','DeepFocus') . '</p>';
            $et_contact_error = true;
        } else if ( $_POST['et_contact_captcha'] <> ( $_SESSION['et_first_digit'] + $_SESSION['et_second_digit'] ) ) {
            $et_numbers_string = $et_regenerate_numbers ? esc_html__('Numbers regenerated.','DeepFocus') : '';
            $et_error_message .= '<p>' . esc_html__('You entered the wrong number in captcha. ','DeepFocus') . $et_numbers_string . '</p>';
    
            if ($et_regenerate_numbers) {
                unset( $_SESSION['et_first_digit'] );
                unset( $_SESSION['et_second_digit'] );
            }
    
            $et_contact_error = true;
        } else if ( empty($_POST['et_contact_name']) || empty($_POST['et_contact_email']) || empty($_POST['et_contact_subject']) || empty($_POST['et_contact_message']) ){
            $et_error_message .= '<p>' . esc_html__('Make sure you fill all fields. ','DeepFocus') . '</p>';
            $et_contact_error = true;
        }
    
        if ( !is_email( $_POST['et_contact_email'] ) ) {
            $et_error_message .= '<p>' . esc_html__('Invalid Email. ','DeepFocus') . '</p>';
            $et_contact_error = true;
        }
    } else {
        $et_contact_error = true;
        if ( isset($_SESSION['et_first_digit'] ) ) unset( $_SESSION['et_first_digit'] );
        if ( isset($_SESSION['et_second_digit'] ) ) unset( $_SESSION['et_second_digit'] );
    }
    
    if ( !isset($_SESSION['et_first_digit'] ) ) $_SESSION['et_first_digit'] = $et_first_digit = rand(1, 15);
    else $et_first_digit = $_SESSION['et_first_digit'];
    
    if ( !isset($_SESSION['et_second_digit'] ) ) $_SESSION['et_second_digit'] = $et_second_digit = rand(1, 15);
    else $et_second_digit = $_SESSION['et_second_digit'];
    
    if ( ! $et_contact_error && isset( $_POST['_wpnonce-et-contact-form-submitted'] ) && wp_verify_nonce( $_POST['_wpnonce-et-contact-form-submitted'], 'et-contact-form-submit' ) ) {
        $et_email_to = ( isset($et_ptemplate_settings['et_email_to']) && !empty($et_ptemplate_settings['et_email_to']) ) ? $et_ptemplate_settings['et_email_to'] : get_site_option('admin_email');
    
        $et_site_name = is_multisite() ? $current_site->site_name : get_bloginfo('name');
    
        $contact_name 	= stripslashes( sanitize_text_field( $_POST['et_contact_name'] ) );
        $contact_email 	= sanitize_email( $_POST['et_contact_email'] );
    
        $headers  = 'From: ' . $contact_name . ' <' . $contact_email . '>' . "\r\n";
        $headers .= 'Reply-To: ' . $contact_name . ' <' . $contact_email . '>';
    
        wp_mail( apply_filters( 'et_contact_page_email_to', $et_email_to ), sprintf( '[%s] ' . stripslashes( sanitize_text_field( $_POST['et_contact_subject'] ) ), $et_site_name ), stripslashes( wp_strip_all_tags( $_POST['et_contact_message'] ) ), apply_filters( 'et_contact_page_headers', $headers, $contact_name, $contact_email ) );
    
        $et_error_message = '<p>' . esc_html__('Thanks for contacting us','DeepFocus') . '</p>';
    }
?>
<script>
  //element = document.getElementById("page-wrapper");
  //element.style.height=window.outerHeight+"px";
</script>
<?php get_header(); ?>

<div id="content-full" class="my-content-full">
    <div id="hr">
        <div id="hr-center">
            <div id="intro">
                <div class="center-highlight">

                    <div class="container breadcrumbs">

                        <?php get_template_part('includes/breadcrumbs'); ?>

                    </div> <!-- end .container -->
                </div> <!-- end .center-highlight -->
            </div>	<!-- end #intro -->
        </div> <!-- end #hr-center -->
    </div> <!-- end #hr -->
    <div class="hr">
    <div class="hr-center">
    <div class="center-highlight big-contact">
        <div class="container">

            <?php if ($fullwidth) { ?>
            <div id="full" class="clearfix full-contact">
                <?php } else { ?>
                <div id="content-area" class="clearfix">
                    <div id="left-area">
                        <?php } ?>

                        <?php if (get_option('deepfocus_integration_single_top') <> '' && get_option('deepfocus_integrate_singletop_enable') == 'on') echo(get_option('deepfocus_integration_single_top')); ?>
                        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                        <div id="main-contact" class="my-change-contact entry clearfix post<?php if($fullwidth) echo(' full');?>">
                            <?php
                                $width = 185;
                                                                 $height = 185;
                                                                 $classtext = '';
                                                                 $titletext = get_the_title();
                                
                                                                 $thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext);
                                                                 $thumb = $thumbnail["thumb"];
                            ?>


<div id="contact-wrapper">
                            <h1 class="title c-title"><?php the_title(); ?></h1>

                            <?php if($thumb == '') echo('<div class="clear"></div>'); ?>

                            <?php if($thumb <> '' && get_option('deepfocus_page_thumbnails') == 'on') { ?>
                            <div class="post-thumbnail">
                                <?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext , $width, $height, $classtext); ?>
                                <span class="overlay"></span>
                            </div> 	<!-- end .thumbnail -->
                            <?php }; ?>

                            <?php the_content(); ?>
                            <?php wp_link_pages(array('before' => '<p><strong>'.esc_html__('Pages','DeepFocus').':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

                            <div id="et-contact">

                                <div id="et-contact-message"><?php echo($et_error_message); ?>
                                </div>

                                <?php if ( $et_contact_error ) { ?>
                                <form action="<?php echo esc_url( get_permalink( get_the_ID() ) ); ?>" method="post" id="et_contact_form">
                                    <div id="et_contact_left et__left">
                                        <p class="clearfix">
                                            <label for="et_contact_name" class="et_contact_form_label"><?php esc_html_e('שם ושם משפחה','DeepFocus'); ?></label>
                                            <input type="text" name="et_contact_name" value="<?php if ( isset($_POST['et_contact_name']) ) echo esc_attr($_POST['et_contact_name']); else esc_attr_e('שם ושם משפחה','DeepFocus'); ?>" id="et_contact_name" class="input" />
                                        </p>

                                        <p class="clearfix">
                                            <label for="et_contact_email" class="et_contact_form_label"><?php esc_html_e('אמייל','DeepFocus'); ?></label>
                                            <input type="text" name="et_contact_email" value="<?php if ( isset($_POST['et_contact_email']) ) echo esc_attr($_POST['et_contact_email']); else esc_attr_e('אמייל','DeepFocus'); ?>" id="et_contact_email" class="input" />
                                        </p>

                                        <p class="clearfix">
                                            <label for="et_contact_subject" class="et_contact_form_label"><?php esc_html_e('נושא הפנייה','DeepFocus'); ?></label>
                                            <input type="text" name="et_contact_subject" value="<?php if ( isset($_POST['et_contact_subject']) ) echo esc_attr($_POST['et_contact_subject']); else esc_attr_e('נושא הפנייה','DeepFocus'); ?>" id="et_contact_subject" class="input" />
                                        </p>
                                    </div> <!-- #et_contact_left -->
                                    <div id="et_contact_right">
                                        <p class="clearfix">
                                            <?php
                                               
                                                  esc_html_e('Captcha: ','DeepFocus');
                                                 //poot here your take away
                                                   echo ' ' . esc_attr($et_first_digit) . ' + ' . esc_attr($et_second_digit) . ' = ';
                                                   ?>
                                                
                                                  <input type="text" name="et_contact_captcha" value="<?php if ( isset($_POST['et_contact_captcha']) ) echo esc_attr($_POST['et_contact_captcha']); ?>" id="et_contact_captcha" class="input" size="2" />

                                                                                           </p>
                                                                                       </div> <!-- #et_contact_right -->
                                                
                                                                                       <div class="clear"></div>
                                                
                                                                                       <p class="clearfix wrap-message-contact">
                                                                                           <label for="et_contact_message" class="et_contact_form_label"><?php esc_html_e('טקסט ההודעה','DeepFocus');
                                            ?></label>
                                            <textarea class="input" id="et_contact_message" name="et_contact_message"><?php if ( isset($_POST['et_contact_message']) ) echo esc_textarea($_POST['et_contact_message']); else echo esc_textarea( __('טקסט ההודעה','DeepFocus') ); ?></textarea>
                                        </p>

                                        <input type="hidden" name="et_contactform_submit" value="et_contact_proccess" />

                                        <input type="reset" id="et_contact_reset" value="<?php esc_attr_e('Reset','DeepFocus'); ?>" />

                                        <input class="et_contact_submit" type="submit" value="<?php esc_attr_e('שלח >','DeepFocus'); ?>" id="et_contact_submit" />

                                        <?php wp_nonce_field( 'et-contact-form-submit', '_wpnonce-et-contact-form-submitted' ); ?>
                                </form>
                                <?php } ?>
                            </div> <!-- end #et-contact -->
                            <div class="clear"></div>

                            <?php edit_post_link(esc_html__('Edit this page','DeepFocus')); ?>

    </div>


                        </div>
                        <div id="cshadow-down"></div>
                    
                        <!-- end .entry -->
                        <?php endwhile; endif; ?>

                        <?php if (get_option('deepfocus_integration_single_bottom') <> '' && get_option('deepfocus_integrate_singlebottom_enable') == 'on') echo(get_option('deepfocus_integration_single_bottom')); ?>

                    </div> <!-- end #left-area -->
                    <?php if (!$fullwidth) get_sidebar(); ?>

                </div> <!-- end #content-area -->
          <div id="wrapper1-castoum"> 
                            <div class="castoum_contant">
                            <div id="are-address" class="kehila-details">כתובתינו:</div>
                            <div id="kehila-address" class="kehila-details"><?php echo get_theme_mod('add_text'); ?></div>
                            <div id="kehila-phone" class="kehila-details">טל: <?php echo get_theme_mod('add_phone'); ?></div>
                            <div id="kehila-fax" class="kehila-details">פקס: <?php echo get_theme_mod('add_fax'); ?></div>
                            <a href="<?php echo get_theme_mod('add_facebook'); ?>" targrt="new" id="conect-good-point" class="kehila-details">לדף הפייסבוק של נקודה טובה</a>


                        </div>
                        </div>

                      </div> <!-- end .container -->
            </div> <!-- end .center-highlight -->
        </div> <!-- end #content-full -->
    </div> <!-- end .hr-center -->
    </div> <!-- end .hr -->


   


            <?php get_footer(); ?>
