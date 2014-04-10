<?php
		$pages = get_pages(array(
			'meta_key' => '_wp_page_template',
			'meta_value' => 'main-gallery-page.php'
		));
		
		
		foreach($pages as $page){
			$pageID=$page->ID.'<br />';
		}

        $mainpage=$post->ID;
        
        $arg=array(
        	'child_of' => $pageID,
        	'post_type' => 'page',
        	'post_status' => 'publish',
		);
        
        $mypages = get_pages($arg);    
        
    ?>
    <div id="et_pt_gallery main-gal" class="clearfix">



        <div class="page-nav clearfix">
            <div class="pagination">
                <div class="alignleft"></div>
                <div class="alignright"></div>
            </div>
        </div> <!-- end .entry -->
   
    <?php   
			$counter=0;	
            foreach( $mypages as $page ) {		
        
        //        echo '<pre>';var_dump($page);echo '</pre>';
        
    ?>
    
    	<?php if($counter<4):?>   
     <div class="et_pt_gallery_entry">
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
                  //  var_dump($page);    
                
                   echo get_the_post_thumbnail($page->ID,array(237,136), array('class' => "portfolio",'alt'=> $page->post_title ,));
                //  print_thumbnail($thumb, $thumbnail["use_timthumb"], $titletext , $width, $height, $classtext);
            ?>
            <span class="main-post-title"><?php echo $page->post_title ;?></span>
            <a class="more-icon gal" href="<?php echo $page->guid; ?>" style="opacity: 0; visibility: visible; left: 128px;">Read more</a>

        </div> <!-- end .et_pt_item_image -->
    </div> <!-- end .et_pt_gallery_entry -->
    <?php 
		$counter++;
		endif;
	?>
    <?php }; ?>



 </div>