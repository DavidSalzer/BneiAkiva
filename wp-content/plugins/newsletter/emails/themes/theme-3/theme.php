<?php
    global $newsletter; // Newsletter object
    global $post; // Current post managed by WordPress
    /*
     * Some variabled are prepared by Newsletter Plus and are available inside the theme,
     * for example the theme options used to build the email body as configured by blog
     * owner.
     *
     * $theme_options - is an associative array with theme options: every option starts
     * with "theme_" as required. See the theme-options.php file for details.
     * Inside that array there are the autmated email options as well, if needed.
     * A special value can be present in theme_options and is the "last_run" which indicates
     * when th automated email has been composed last time. Is should be used to find if
     * there are now posts or not.
     *
     * $is_test - if true it means we are composing an email for test purpose.
     */
    
    // This array will be passed to WordPress to extract the posts
    $filters = array();
    // Maximum number of post to retrieve
    $filters['showposts'] = (int) $theme_options['theme_max_posts'];
    if ($filters['showposts'] == 0)
        $filters['showposts'] = 10;
    
    // Include only posts from specified categories. Do not filter per category is no
    // one category has been selected.
    if (is_array($theme_options['theme_categories'])) {
        $filters['cat'] = implode(',', $theme_options['theme_categories']);
    }
    // Retrieve the posts asking them to WordPress
    $posts = get_posts($filters);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title></title>
        
    </head>

    <body style="direction: rtl">
        <br />
        <table cellspacing="0" align="center" border="0" style="max-width:440px; width:440px; background-color: #eee;" cellpadding="0" width="440px">
            <!-- Header -->
            <tr style="background: #455560; background-image: url(<?php echo plugins_url('header.jpg', __FILE__); ?>); height:144px;width:440px" cellspacing="0" border="0" align="center" cellpadding="0">
                
                <td height="144" width="440" style="color: #fff; font-size: 30px; font-family: Arial; " align="center" valign="middle">
                     <img src="<?php echo plugins_url('header.jpg', __FILE__); ?>" alt="picture" align="right" width="100%" height="100%" />
                    <?php //echo get_option('blogname'); ?>
                </td>
            </tr>
            <tr style="background-color: #2088a2; height:55px;width:440px;" cellspacing="0" border="0" align="center" cellpadding="0" width="440" height="80">
                <td style="color: #fff; font-size: 30px; font-family: Arial;text-indent: 42px; color: #fff;" align="right" valign="middle">ינואר 2014
                </td>
            </tr>
            <tr style="background-color: #f49b3b; height:12px;width:440px;" cellspacing="0" border="0" cellpadding="0">
                <td></td>
            </tr>
            <tr style="background-color: #fbd416; height:12px;width:440px;" cellspacing="0" border="0" cellpadding="0">
                <td></td>
            </tr>

            <tr>
                <td>
                    <table cellspacing="0" border="0" style="max-width:440px; width:440px; background-color: #eee;font-family:helvetica,arial,sans-serif;color:#555;font-size:13px;line-height:15px;" align="center" cellpadding="20" width="440px">
                        <tr>
                            <td style="padding: 0;">
                                <table cellpadding="0" cellspacing="0" border="0" bordercolor="" width="100%" bgcolor="#ffffff">
                                    <?php
                                        $caunter=0;
                                        // Do not use &post, it leads to problems...
                                        foreach ($posts as $post) {
                                            // Setup the post (WordPress requirement)
                                            setup_postdata($post);
                                            // The theme can "suggest" a subject replacing the one configured, for example. In this case
                                            // the theme, is there is no subject, suggest the first post title.
                                            if (empty($theme_options['subject']))
                                                $theme_options['subject'] = $post->post_title;
                                            // Extract a thumbnail, return null if no thumb can be found
                                            $image = nt_post_image(get_the_ID());
                                    ?>

                                     <?php 
                                                if($caunter%2==0){
                                                   ?>  <?php   ?>
                                                  <?php   
                                                }else{
                                                    $modClass='';
                                                }   
                                            ?>

                                    <tr>
                                        
                                        <td class="poster<?php echo " ".$modClass;?>" style="font-family: Arial; font-size: 15px; padding: 15px 15px 15px 15px;position: relative;<?php if($caunter%2==0){echo "background-color:#fbfbf5;";}?>" >

                                            <?php if ($image != null) { ?>
                                            
                                            <img src="<?php echo $image; ?>" alt="picture" align="right" width="110px" height="80px" style="margin-left: 10px;" />
                                            
                                            <?php } ?>
                                            <a target="_tab" href="<?php echo get_permalink(); ?>" style="color: #000;direction: rtl; font-size: 20px; text-decoration: none; max-width: 310px;"><b><?php the_title(); ?></b></a><br />
                                            <div id="text-news-latters" style="width: 320px; max-width: 320px; ">
                                                <?php the_excerpt(); ?>
                                            </div>
                                                <div style="text-align: left; width: 400px;">
                                                <a target="_tab" href="<?php echo get_permalink(); ?>" style="color: #208AA4;  font-size: 15px; text-decoration: none;"><b>קרא עוד...</b></a><br />
                                            </div>
                                        </td>

                                       
                                    </tr>

                                      <?php 
                                                if($caunter%2==0){
                                                   ?>   <?php   ?><?php/*end of special-color */?>
                                                  <?php   
                                                }else{
                                                    $modClass='';
                                                }   
                                            ?>
                                    <?php
                                         $caunter++;
                                        }
                                    ?>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <?php if (!isset($theme_options['theme_social_disable'])) { ?>
            <tr>
                <td style="font-family: Arial; font-size: 12px">
                    <?php include WP_PLUGIN_DIR . '/newsletter/emails/themes/default/social.php'; ?>
                </td>
            </tr>
            <?php } ?>
            <tr>
                <td bgcolor="#ffffff" style="font-family: Arial; font-size: 12px">
                    This email was sent to <b>{email}</b> because you opted in on <?php echo get_option('blogname'); ?> website.
                    <br />
                    <a target="_tab" href="{profile_url}">Manage the subscription</a> |
                    <a target="_tab" href="{unsubscription_url}">Unsubscribe</a>
                </td>
            </tr>
        </table>


    </body>
</html>
