<?php get_header(); ?>

	<div id="content-full">
		<div id="home-top"></div>
		<div class="hr">
			<div class="hr-center">
				<div class="intro">
					<div class="center-highlight">
                        <div class="wrap-container">
						<div class="container">

							<?php if (get_option('deepfocus_featured') == 'on') get_template_part('includes/featured'); ?>

							<?php if (get_option('deepfocus_quote') == 'on') { ?>
								<div id="tagline">
									<p><?php echo wp_kses_post(get_option('deepfocus_quote_one')); ?></p>
									<span class="quote2"><?php echo wp_kses_post(get_option('deepfocus_quote_two')); ?></span>
								</div>	<!-- end #tagline-->
							<?php } ?>

						</div> <!-- end .container -->
                        </div> <!-- wrap-container -->
					</div> <!-- end .center-highlight -->
				</div>	<!-- end .intro -->
			</div> <!-- end .hr-center -->
		</div> <!-- end .hr -->
        
	    <div class="center-highlight">
            <div class="wrap-container">
			<div class="container">

				<?php if (get_option('deepfocus_blog_style') == 'false') { ?>
					<?php for ($i=1; $i <= 3; $i++) { ?>
						<?php query_posts('page_id=' . get_pageId(html_entity_decode(get_option('deepfocus_home_page_'.$i)))); while (have_posts()) : the_post(); ?>
							<div class="service" id="homeService<?php echo $i;?>">
							<h3 class="hometitle"><?php the_title(); ?></h3>      
                                <a href="<?php the_permalink(); ?>" class="home-links" >
                                 <?php echo get_the_post_thumbnail( $post->ID, 'full',array() ); ?> 
								</a>
                                <?php /* global $more;
								$more = 0;
								the_content(''); 
								<a href="<?php the_permalink(); ?>" class="readmore"><span><?php esc_html_e('Learn More','DeepFocus'); ?></span></a>
							*/ ?></div> <!-- end .service -->
						<?php endwhile; wp_reset_query(); ?>
					<?php } ?>


					<?php /*<div class="service" id="blog">
						<div id="blog-top"></div>
						<div id="blog-wrapper">
							<div id="blog-content">
								<h4 class="widgettitle"><?php esc_html_e('From The Blog','DeepFocus'); ?></h4>
								<div class="recentscroll">
									<ul>
										<?php query_posts("posts_per_page=".get_option('deepfocus_fromblog_number')."&cat=".get_catId(get_option('deepfocus_blog_cat')));
										if (have_posts()) : while (have_posts()) : the_post(); ?>
											<li class="clearfix">
												<a href="<?php the_permalink(); ?>" class="title"><span><?php truncate_title(30); ?></span></a>
												<span class="postinfo"><?php esc_html_e('Posted','DeepFocus'); ?> <?php esc_html_e('by','DeepFocus'); ?> <?php the_author_posts_link(); ?> <?php esc_html_e('on','DeepFocus'); ?> <?php the_time(get_option('deepfocus_date_format')) ?></span>
											</li>
										<?php endwhile; endif; wp_reset_query(); ?>
									</ul> <!-- end ul.nav -->
								</div> <!-- end .recentscroll -->
							</div> <!-- end #blog-center -->
						</div> <!-- end #blog-wrapper -->
                        */?>
<?php /*						<div id="controllers2">
							<a href="#" id="cleft-arrow"><?php esc_html_e('Previous','DeepFocus'); ?></a>
							<a href="#" id="cright-arrow"><?php esc_html_e('Next','DeepFocus'); ?></a>
						</div>	<!-- end #controllers2 -->
					</div>
     
         <!-- end .service --> */?>  

					<div class="clear"></div>

					<h3 class="hometitle recentworks"></h3>

					<div id="portfolio-items" class="clearfix">
						<?php get_template_part('includes/galeryExapmle'); ?><!--sara check it out       gallery-->

						<div class="clear"></div>

						<a href="<?php echo esc_url(get_category_link(get_catId(get_option('deepfocus_portfolio_cat')))); ?>" class="readmore entergallery"><span><?php esc_html_e('כניסה לגלריה','DeepFocus'); ?></span></a>
					</div> <!-- end #portfolio-items -->
            </div> <!-- wrap-container -->
				<?php } else { ?>
					<div id="content-area" class="clearfix">

						<div id="left-area">
							<?php get_template_part('includes/entry'); ?>
						</div> <!-- end #left-area -->

						<?php get_sidebar(); ?>

					</div> <!-- end #content-area -->
				<?php } ?>

			</div> <!-- end .container -->
      </div>  
</div>

			<?php get_footer(); ?>