<?php
 /*
    Template Name: פירסום אחרון
    */

 get_header(); ?>

<div id="content-full" class="my-last-post">
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

	<div class="center-highlight">
        <div class="wrap-container">
		<div class="container">
            <div id="right-side-poster"></div>
            <?php
			  $the_query =  new WP_Query(array('posts_per_page' => 1,'category_name'=>'new-post') );  ?>

          

           
			<div id="content-area" class="clearfix">

				<div id="left-area">
                    <div id="new-post-title">מה חדש</div>
					<?php if (get_option('deepfocus_integration_single_top') <> '' && get_option('deepfocus_integrate_singletop_enable') == 'on') echo(get_option('deepfocus_integration_single_top')); ?>
					  <?php if ( $the_query->have_posts() ) : ?>
                        <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>  
                      <h1 class="title" id="title-of-lastpost"><?php the_title(); ?></h1>
						<div class="entry clearfix post">
                            <!--<h1 class="title"><?php/* the_title();*/ ?></h1>-->
							<?php $width = 185;
								  $height = 185;
								  if (!$isBlogPage) {
									  $width = 650;
									  $height = 9999;
								  }

								  $classtext = '';
								  $titletext = get_the_title();

								  $thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext,true);
								  $thumb = $thumbnail["thumb"];
                                  

                                   ?>
                               
									<div class="gallery-thumb">
										<?php print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext, $width, $height, $classtext); ?>
										<span class="overlay"></span>
                                        <div class="gallery-thumb-bottom">
										<div class="left-shadow"></div>
										<div class="bg"></div>
										<div class="right-shadow"></div>
									</div> <!-- end .gallery-thumb-botton -->
								</div> <!-- end .gallery-thumb -->
									
							 
							<?php get_template_part('includes/postinfo'); ?>

							


							<?php/* the_content();*/ ?>
							<?php wp_link_pages(array('before' => '<p><strong>'.esc_html__('Pages','DeepFocus').':</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
							<?php edit_post_link(esc_html__('Edit this page','DeepFocus')); ?>
						</div> <!-- end .entry -->
					<?php endwhile; endif; ?>
                    <div id="post-content-wrapper">
                    	<?php the_content(); ?> 
                        </div>
                  <?php wp_reset_postdata(); ?>
					<?php if (get_option('deepfocus_integration_single_bottom') <> '' && get_option('deepfocus_integrate_singlebottom_enable') == 'on') echo(get_option('deepfocus_integration_single_bottom')); ?>

					<?php if (get_option('deepfocus_468_enable') == 'on') { ?>
						<?php if(get_option('deepfocus_468_adsense') <> '') echo(get_option('deepfocus_468_adsense'));
						else { ?>
							<a href="<?php echo(get_option('deepfocus_468_url')); ?>"><img src="<?php echo(get_option('deepfocus_468_image')); ?>" alt="468 ad" class="foursixeight" /></a>
						<?php } ?>
					<?php } ?>

					<?php // if (get_option('deepfocus_show_postcomments') == 'on') comments_template('', true); ?>

				</div> <!-- end #left-area -->
                
				<?php get_sidebar(); ?>

			</div> <!-- end #content-area -->

		</div> <!-- end .container -->
        </div> <!-- end .wrap-container -->
		<?php get_footer(); ?>

<script>
    a = jQuery("#footer").height();
    b = jQuery(".tell-height-wrap").height();
    d = window.outerHeight;
    v = jQuery(".center-highlight").height();
    h = d - a - b - v;
    jQuery('#content-area.clearfix').css('min-height', h + 'px');
    </script>