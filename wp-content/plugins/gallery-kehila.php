<?php
    /*
    Plugin Name: gallery-kehilat yerucham
    Plugin URI: http://www.cambium.co.il
    Description: שינוי גלרייה של וורדפרס עבור קהילת בני-עקיבא ירוחם
    Version: 1.0
    Author: yanai edri- ינאי אדרי
    Author URI: http://www.cambium.co.il
    */
    
    remove_shortcode('gallery');
    add_shortcode('gallery', 'parse_gallery_shortcode');
    
    function parse_gallery_shortcode($atts) {
    
        global $post;
    
        if ( ! empty( $atts['ids'] ) ) {
            // 'ids' is explicitly ordered, unless you specify otherwise.
            if ( empty( $atts['orderby'] ) )
                $atts['orderby'] = 'post__in';
            $atts['include'] = $atts['ids'];
        }
    
        extract(shortcode_atts(array(
            'orderby' => 'menu_order ASC, ID ASC',
            'include' => '',
            'id' => $post->ID,
            'itemtag' => 'dl',
            'icontag' => 'dt',
            'captiontag' => 'dd',
            'columns' => 3,
            'size' => 'medium',
            'link' => 'file'
        ), $atts));
    
    
        $args = array(
            'post_type' => 'attachment',
            'post_status' => 'inherit',
            'post_mime_type' => 'image',
            'orderby' => $orderby
        );
    
        if ( !empty($include) )
            $args['include'] = $include;
        else {
            $args['post_parent'] = $id;
            $args['numberposts'] = -1;
        }
    
        $images = get_posts($args);
?>
<div id="et_pt_gallery" class="clearfix main-gal">
    <?php
        
        foreach ( $images as $image ) {     
    ?>
    <div class="et_pt_gallery_entry">
        <div class="et_pt_item_image" style="background-color: rgb(0, 0, 0); top: 0px;">

            <?php
                 $caption = $image->post_excerpt;
                
                 $description = $image->post_content;
                 if($description == '') $description = $image->post_title;
                
                 $image_alt = get_post_meta($image->ID,'_wp_attachment_image_alt', true);
                
                 // render your gallery here
                // var_dump($image);
                // echo wp_get_attachment_image($image->ID, array(185,185),array('class' => "portfolio"));
                
            ?>
            <img src="<?php echo $image->guid ?>" width="185" height="185" class="portfolio" alt="<?php $image->post_title; ?>">
            <a class="zoom-icon fancybox" title="<?php $image->post_title;; ?>" rel="gallery" href="<?php echo $image->guid; ?>"><?php esc_html_e('Zoom in','DeepFocus'); ?></a>
        </div> <!-- end .et_pt_item_image -->
    </div> <!-- end .et_pt_gallery_entry -->
    <?php
        
        }
    ?>
</div>
<?php
    }
