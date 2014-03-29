<?php
/*
Template Name: לוח שנה
*/
?>

<?php get_header(); ?>

<div id="content-full">
    <div id="hr">
        <div id="hr-center">
            <div id="intro">
                <div class="center-highlight">

                    <div class="container breadcrumbs">

                        <?php get_template_part('includes/breadcrumbs'); ?>

                    </div> <!-- end .container -->
                </div> <!-- end .center-highlight -->
            </div>	<!-- end #intro -->
        </div> <!-- end .hr-center -->
    </div> <!-- end .hr -->
    <div class="hr">
    <div class="hr-center">
    <div class="center-highlight">
        <div class="container">

            <?php if ($fullwidth) { ?>
            <div id="full" class="clearfix full-contact">
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
                            <?php $urlCalender=$cfs->get('addCalender');//, $post_id, $options ?>
                            
                            <iframe src="<?php echo $urlCalender?>" style="border: 0" max-width="540" width="90%" height="400" frameborder="0" scrolling="no"></iframe>
                            <?php wp_link_pages(array('before' => '<p><strong>'.esc_html__('Pages','DeepFocus').':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

                            <div id="et-contact">

                                <div id="et-contact-message"><?php echo($et_error_message); ?>
                                </div>

                            </div> <!-- end #et-contact -->
                            <div class="clear"></div>

                            <?php edit_post_link(esc_html__('Edit this page','DeepFocus')); ?>

    </div>
                        </div>

                        <div id="wrapper1-castoum"> 
                            <div class="text-container">
                                
                            </div>
                        </div>
                        </div>

                        <!-- end .entry -->
                        <?php endwhile; endif; ?>

                        <?php if (get_option('deepfocus_integration_single_bottom') <> '' && get_option('deepfocus_integrate_singlebottom_enable') == 'on') echo(get_option('deepfocus_integration_single_bottom')); ?>

                    </div> <!-- end #left-area -->
                    

                </div> <!-- end #content-area -->
            </div> <!-- end .container -->
        </div> <!-- end .center-highlight -->
    </div> <!-- end .hr-center -->
    </div> <!-- end .hr -->
    </div> <!-- end #content-full -->
            <?php get_footer(); ?>
