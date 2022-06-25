<?php
     get_header();
     $options = get_design_plus_option();
     $headline = get_the_title();
     $headline_font_type = $options['work_headline_font_type'];
     $desc = get_post_meta($post->ID, 'single_desc', true);
     $current_page_id = $post->ID;
     $accent_color = get_post_meta($post->ID, 'accent_color', true) ?  get_post_meta($post->ID, 'accent_color', true) : '#0b5d7c';
?>
<div id="wide_contents">

 <div id="archive_header">
  <div class="content">
   <?php if($headline){ ?>
   <h1 class="headline common_headline rich_font_<?php echo esc_attr($headline_font_type); ?>" style="color:<?php echo esc_attr($accent_color); ?>;"><?php echo wp_kses_post(nl2br($headline)); ?></h1>
   <?php }; ?>
   <?php if($desc){ ?>
   <p class="desc"><?php echo wp_kses_post(nl2br($desc)); ?></p>
   <?php }; ?>
  </div>
 </div>

 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

 <?php
      $gallery_layout = get_post_meta($post->ID, 'gallery_layout', true) ?  get_post_meta($post->ID, 'gallery_layout', true) : 'type1';

      if($gallery_layout == 'type1'){

      // コンテンツビルダー
      $work_content = get_post_meta( $post->ID, 'work_content', true );
      $content_count = 1;
      $item_num = 0;
      if ( $work_content && is_array( $work_content ) ) :
        foreach( $work_content as $key => $content ) :

          // レイアウト１ --------------------------------------------------------------------------------
          if ( $content['cb_content_select'] == 'layout1' ) {
 ?>
 <div class="work_image_list layout1 num<?php echo $content_count; ?>">

  <?php
       for ( $i = 1; $i <= 6; $i++ ) :
       $image = isset( $content['image'.$i] ) ? wp_get_attachment_image_src($content['image'.$i], 'full') : '';
       $caption = wp_get_attachment_caption($content['image'.$i]);
  ?>
  <div class="item inview <?php if($i == 1 || $i == 6){ echo 'size1'; } else { echo 'size2'; }; if(empty($image)){ echo ' no_image'; }; ?> <?php if($i > 3){ echo 'delay_animate'; }; ?>">
   <?php if($image){ ?>
   <a class="image_wrap animate_background no_move_page modal_button" href="#" data-item-num="<?php echo esc_attr($item_num); ?>">
    <?php if($caption){ echo '<p class="desc" style="background:' . esc_attr($accent_color) . ';">' . esc_html($caption) . '</p>'; }; ?>
    <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
   </a>
   <?php }; ?>
  </div>
  <?php
       if($image){ $item_num++; };
       endfor;
  ?>

 </div><!-- END .work_image_list -->

 <?php
          // レイアウト２ --------------------------------------------------------------------------------
          } elseif ( $content['cb_content_select'] == 'layout2' ) {
 ?>
 <div class="work_image_list layout2 num<?php echo $content_count; ?>">

  <?php
       for ( $i = 1; $i <= 4; $i++ ) :
       $image = isset( $content['image'.$i] ) ? wp_get_attachment_image_src($content['image'.$i], 'full') : '';
       $caption = wp_get_attachment_caption($content['image'.$i]);
  ?>
  <div class="item inview size1<?php if(empty($image)){ echo ' no_image'; }; ?> <?php if($i > 2) { echo 'delay_animate'; }; ?>">
   <?php if($image){ ?>
   <a class="image_wrap animate_background no_move_page modal_button" href="#" data-item-num="<?php echo esc_attr($item_num); ?>">
    <?php if($caption){ echo '<p class="desc" style="background:' . esc_attr($accent_color) . ';">' . esc_html($caption) . '</p>'; }; ?>
    <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
   </a>
   <?php }; ?>
  </div>
  <?php
       if($image){ $item_num++; };
       endfor;
  ?>

 </div><!-- END .work_image_list -->

 <?php
          // レイアウト３ --------------------------------------------------------------------------------
          } elseif ( $content['cb_content_select'] == 'layout3' ) {
 ?>
 <div class="work_image_list layout3 num<?php echo $content_count; ?>">

  <?php
       for ( $i = 1; $i <= 8; $i++ ) :
       $image = isset( $content['image'.$i] ) ? wp_get_attachment_image_src($content['image'.$i], 'full') : '';
       $caption = wp_get_attachment_caption($content['image'.$i]);
  ?>
  <div class="item inview size2<?php if(empty($image)){ echo ' no_image'; }; ?> <?php if( $i > 4 ) { echo 'delay_animate'; }; ?>">
   <?php if($image){ ?>
   <a class="image_wrap animate_background no_move_page modal_button" href="#" data-item-num="<?php echo esc_attr($item_num); ?>">
    <?php if($caption){ echo '<p class="desc" style="background:' . esc_attr($accent_color) . ';">' . esc_html($caption) . '</p>'; }; ?>
    <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
   </a>
   <?php }; ?>
  </div>
  <?php
       if($image){ $item_num++; };
       endfor;
  ?>

 </div><!-- END .work_image_list -->

 <?php
          };
        $content_count++;
        endforeach; // END 並び替え
      endif;
 ?>

 <?php } else { // gallery type2 ?>

  <?php
       // ギャラリー　タイプ２ -------------------------------------
       $data_list = get_post_meta($post->ID, 'data_list', true);
       $item_num = 0;
       if (!empty($data_list)) {
  ?>
  <div id="work_gallery_type2">
   <?php
        foreach ( $data_list as $key => $value ) :
          $image = isset( $value['image'] ) ? wp_get_attachment_image_src($value['image'], 'full') : '';
          $caption = wp_get_attachment_caption($value['image']);
          if($image){
   ?>
   <div class="item inview">
    <a class="animate_background no_move_page modal_button" href="#" data-item-num="<?php echo esc_attr($item_num); ?>">
     <?php if($caption){ echo '<p class="desc" style="background:' . esc_attr($accent_color) . ';">' . esc_html($caption) . '</p>'; }; ?>
     <img class="image" src="<?php echo esc_attr($image[0]); ?>" data-width="<?php echo esc_attr($image[1]); ?>" data-height="<?php echo esc_attr($image[2]); ?>" alt="" title="">
    </a>
   </div>
   <?php
          $item_num++;
          };
        endforeach;
   ?>
  </div><!-- END #work_gallery_type2 -->
  <?php }; ?>

 <?php }; ?>

 <?php endwhile; endif; ?>

 <?php // メニュー ------------------------------- ?>
 <div id="work_single_menu" class="vscroll">
  <?php
       $args = array( 'post_type' => 'work', 'posts_per_page' => -1, 'orderby' => 'menu_order', 'order' => 'ASC');
       $post_list = new wp_query($args);
       if($post_list->have_posts()):
  ?>
  <ol>
   <?php while( $post_list->have_posts() ) : $post_list->the_post(); ?>
   <li<?php if($current_page_id == $post->ID){ echo ' class="active"'; }; ?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
   <?php endwhile; ?>
  </ol>
  <?php endif; wp_reset_query(); ?>
 </div>

 <?php get_template_part('template-parts/side_copyright'); ?>

</div><!-- END #wide_contents -->
<?php get_footer(); ?>