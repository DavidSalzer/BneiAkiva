<?php
    /*
    Template Name: עמוד גלרייה ראשי
    */
?>
<?php get_header(); ?>

<div id="content-full">
   
    <?php
        $mainpage=$post->ID;
        
        $arg=array(
        'sort_order' => 'ASC',
        'sort_column' => 'post_title',
        'child_of' => $mainpage,
        'post_type' => 'page',
        'post_status' => 'publish'
        );
        
        $mypages = get_pages($arg);    
        
    ?>
    <div id="et_pt_gallery" class="clearfix main-gal backround-main-gall">
       


        <div class="page-nav clearfix">
            <div class="pagination">
                <div class="alignleft"></div>
                <div class="alignright"></div>
            </div>
        </div> <!-- end .entry -->
     <div id="main-gallery-title">גלרייה</div>
    <?php
            foreach( $mypages as $page ) {		
        
        //        echo '<pre>';var_dump($page);echo '</pre>';
        
    ?>
    <div class="et_pt_gallery_entry album">
        <div class="et_pt_item_image" style="background-color: rgb(0, 0, 0); top: 0px;">
            <?php
                
                 $width = 185;
                 $height = 185;
                 $classtext = '';
                // $titletext = get_the_title($page->ID);
                
                // $thumbnail = get_thumbnail($width,$height,$classtext,$titletext,$titletext);
                 // $thumb = $thumbnail["thumb"];
            ?>

            <?php
                
                
                   echo get_the_post_thumbnail($page->ID,array(237,136), array('class' => "portfolio",'alt'=> $page->post_title ,));
                //  print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext , $width, $height, $classtext);
            ?>
            <span class="main-post-title"><?php echo $page->post_title ;?></span>
            <a class="more-icon gal" href="<?php echo $page->guid; ?>" style="opacity: 0; visibility: visible; left: 128px;">Read more</a>

        </div> <!-- end .et_pt_item_image -->
    </div> <!-- end .et_pt_gallery_entry -->
    <?php }; ?>



 </div>
    
   


</div> <!-- end .container -->



<?php get_footer(); ?>


 <script>
     a = jQuery("#footer").height();
     b = jQuery("#top").height();
     d = window.outerHeight;
     h = d - a - b;
     jQuery('#et_pt_gallery').css('min-height', h + 'px');
    </script>