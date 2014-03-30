<?php
/*
Template Name:  תבנית גנרית לטקסט
*/
?>
<?php get_header(); ?>

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
<!--<div id="page-wrapper"></div>-->
<script>
  //element = document.getElementById("page-wrapper");
  //element.style.height=window.outerHeight+"px";
</script>
<?php get_header(); ?>

<div id="content-full">
    <div id="hr">
        <div id="hr-center">
            <div id="intro">
                <div class="center-highlight">
                    <div class="wrap-container">
                    <div class="container breadcrumbs">

                        <?php get_template_part('includes/breadcrumbs'); ?>

                    </div> <!-- end .container -->
                </div> <!-- end .center-highlight -->
            </div>	<!-- end #intro -->
        </div> <!-- end #hr-center -->
    </div> <!-- end #hr -->
    <div class="center-highlight">
        <div class="container">

            <?php if ($fullwidth) { ?>
            <div id="full" class="clearfix full-contact full-text">
                <?php } else { ?>
                <div id="content-area" class="clearfix news">
                    <div id="left-area">
                        <?php } ?>

                        <?php if (get_option('deepfocus_integration_single_top') <> '' && get_option('deepfocus_integrate_singletop_enable') == 'on') echo(get_option('deepfocus_integration_single_top')); ?>
                        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                        <div id="main-contact" class="entry clearfix post<?php if($fullwidth) echo(' full');?>">
                            <?php
                                $width = 185;
                                                                 $height = 185;
                                                                 $classtext = '';
                                                                 $titletext = get_the_title();
                                
                                                                 $thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext);
                                                                 $thumb = $thumbnail["thumb"];
                            ?>
<div id="contact-wrapper">
                            
                            <?php $urlImg=$cfs->get('Icon');//, $post_id, $options ?>
                            <h1 class="title c-title" style="background-image: url('<?php echo $urlImg ?>')"><?php the_title(); ?></h1>
                            
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

                            </div> <!-- end #et-contact -->
                            <div class="clear"></div>

                            <?php edit_post_link(esc_html__('Edit this page','DeepFocus')); ?>

    </div>
                        </div>


                        <!-- end .entry -->
                        <?php endwhile; endif; ?>

                        <?php if (get_option('deepfocus_integration_single_bottom') <> '' && get_option('deepfocus_integrate_singlebottom_enable') == 'on') echo(get_option('deepfocus_integration_single_bottom')); ?>

                    </div> <!-- end #left-area -->
                    

                </div> <!-- end #content-area -->
            </div> <!-- end .container -->
            </div> <!-- end .wrap-container -->
            </div> <!-- end .center-highlight -->
        </div> <!-- end #content-full -->
            <?php get_footer(); ?>
