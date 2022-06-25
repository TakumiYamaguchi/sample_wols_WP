<?php
/*
Template Name:Horizontal scroll page
*/
__('Horizontal scroll page', 'tcd-horizon');
?>
<?php
     get_header();
     $options = get_design_plus_option();
?>
<div id="wide_contents">

 <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

 <?php
      // コンテンツビルダー
      $lp_content = get_post_meta( $post->ID, 'lp_content', true );
      $content_count = 1;
      if ( $lp_content && is_array( $lp_content ) ) :
        foreach( $lp_content as $key => $content ) :

         // デザインコンテンツ --------------------------------------------------------------------------------
         if ( $content['cb_content_select'] == 'design_content' && $content['show_content'] ) {

           $image1 = isset($content['image1']) ? wp_get_attachment_image_src( $content['image1'], 'full' ) : '';
           $image2 = isset($content['image2']) ? wp_get_attachment_image_src( $content['image2'], 'full' ) : '';
           $image3 = isset($content['image3']) ? wp_get_attachment_image_src( $content['image3'], 'full' ) : '';
           $image4 = isset($content['image4']) ? wp_get_attachment_image_src( $content['image4'], 'full' ) : '';
           $image_mobile1 = isset($content['image_mobile1']) ? wp_get_attachment_image_src( $content['image_mobile1'], 'full' ) : '';
           $image_mobile2 = isset($content['image_mobile2']) ? wp_get_attachment_image_src( $content['image_mobile2'], 'full' ) : '';
           $image_mobile3 = isset($content['image_mobile3']) ? wp_get_attachment_image_src( $content['image_mobile3'], 'full' ) : '';
           $image_mobile4 = isset($content['image_mobile4']) ? wp_get_attachment_image_src( $content['image_mobile4'], 'full' ) : '';
           $video = $content['video'];
           $youtube = $content['youtube'];
           $layout = isset($content['layout']) ? $content['layout'] : 'type1';
           $bg_type = isset($content['bg_type']) ? $content['bg_type'] : 'type1';
           if($layout == 'type2' || $layout == 'type3'){
             $bg_type = 'type1';
           }
?>
<div class="cb_design_content num<?php echo $content_count; ?> layout_<?php echo esc_attr($layout); ?>" id="<?php echo 'cb_content_' . $content_count; ?>">

 <?php // 左側のコンテンツ ---------------------------------- ?>
 <?php if($layout == 'type5'){ ?>
 <div class="content content3" style="background-color:<?php echo esc_attr($content['bg_color2']); ?>; color:<?php echo esc_attr($content['font_color2']); ?>;">

  <div class="content_inner">
   <?php if($content['catch_type2'] == 'type1' && $content['headline2']){ ?>
   <h2 class="headline common_headline rich_font_<?php echo esc_attr($options['headline_font_type']); ?>"><?php echo wp_kses_post(nl2br($content['headline2'])); ?></h2>
   <?php }; ?>
   <?php if($content['catch_type2'] == 'type2' && $content['catch2']){ ?>
   <h3 class="catch common_sub_headline"><?php echo wp_kses_post(nl2br($content['catch2'])); ?></h3>
   <?php }; ?>
   <?php if($content['desc2']){ ?>
   <p class="desc<?php if(empty($content['headline2']) && empty($content['catch2'])){ echo ' no_headline'; }; ?>"><?php echo wp_kses_post(nl2br($content['desc2'])); ?></p>
   <?php }; ?>
   <?php if($content['show_button2']){ ?>
   <div class="link_button">
    <a class="design_button" href="<?php echo esc_url($content['button_url2']); ?>"><span><?php echo esc_html($content['button_label2']); ?></span></a>
   </div>
   <?php }; ?>
  </div>

 </div><!--END .content3 -->
 <?php }; ?>

 <?php // 中央のコンテンツ ---------------------------------- ?>
 <div class="content content1<?php if($bg_type == 'type3'){ echo ' youtube_bg'; if ( !empty($content['use_para']) && !is_mobile() ) { echo ' youtube_bg_parallax'; }; }; ?>">

  <div class="content_inner">

   <?php if($layout != 'type6'){ ?>

   <?php if($content['headline3']){ ?>
   <h2 class="headline common_headline rich_font_<?php echo esc_attr($options['headline_font_type']); ?>"><?php echo wp_kses_post(nl2br($content['headline3'])); ?></h2>
   <?php }; ?>

   <?php } else { ?>

   <?php if($content['catch3']){ ?>
   <h2 class="catch rich_font_<?php echo esc_attr($content['catch_font_type3']); ?>"><?php echo wp_kses_post(nl2br($content['catch3'])); ?></h2>
   <?php }; ?>

   <?php if($content['desc3']){ ?>
   <p class="desc"><?php echo wp_kses_post(nl2br($content['desc3'])); ?></p>
   <?php }; ?>

   <?php if($content['show_button3']){ ?>
   <div class="link_button">
    <a class="design_button" href="<?php echo esc_url($content['button_url3']); ?>"><span><?php echo esc_html($content['button_label3']); ?></span></a>
   </div>
   <?php }; ?>

   <?php }; ?>

  </div>

  <?php
       if( ($content['overlay_opacity'] != 0) && ($image1 || $image2 || $image3 || $image4 || $video || $youtube) ){
         $overlay_color = hex2rgb($content['overlay_color']);
         $overlay_color = implode(",",$overlay_color);
         $overlay_opacity = $content['overlay_opacity'];
  ?>
  <div class="overlay" style="background-color:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>
  <?php }; ?>

  <?php if($bg_type == 'type1'){ ?>

  <?php if ( ! empty( $content['use_para'] ) && ( $image1 || $image_mobile1 ) ) { ?>
  <div class="image image1"  data-parallax-image="<?php echo esc_attr( $image1[0] ); ?>"<?php if ($image_mobile1) echo ' data-parallax-mobile-image="' . esc_attr( $image_mobile1[0] ) . '"'; ?>></div>
  <?php } else { ?>
  <?php if($image1){ ?>
  <div class="image image1<?php if($image_mobile1){ echo ' pc'; }; ?>" style="background:url(<?php echo esc_attr($image1[0]); ?>) no-repeat center center; background-size:cover;"></div>
  <?php if($image_mobile1){ ?>
  <div class="image image1 mobile" style="background:url(<?php echo esc_attr($image_mobile1[0]); ?>) no-repeat center center; background-size:cover;"></div>
  <?php }; ?>
  <?php }; ?>
  <?php }; ?>

  <?php if($layout == 'type2' || $layout == 'type3'){ ?>

  <?php if ( $content['use_para'] && ( $image2 || $image_mobile2 ) ) { ?>
  <div class="image image2"  data-parallax-image="<?php echo esc_attr( $image2[0] ); ?>"<?php if ($image_mobile2) echo ' data-parallax-mobile-image="' . esc_attr( $image_mobile2[0] ) . '"'; ?>></div>
  <?php } else { ?>
  <?php if($image2){ ?>
  <div class="image image2<?php if($image_mobile2){ echo ' pc'; }; ?>" style="background:url(<?php echo esc_attr($image2[0]); ?>) no-repeat center center; background-size:cover;"></div>
  <?php if($image_mobile2){ ?>
  <div class="image image2 mobile" style="background:url(<?php echo esc_attr($image_mobile2[0]); ?>) no-repeat center center; background-size:cover;"></div>
  <?php }; ?>
  <?php }; ?>
  <?php }; ?>

  <?php if ( $content['use_para'] && ( $image3 || $image_mobile3 ) ) { ?>
  <div class="image image3"  data-parallax-image="<?php echo esc_attr( $image3[0] ); ?>"<?php if ($image_mobile3) echo ' data-parallax-mobile-image="' . esc_attr( $image_mobile3[0] ) . '"'; ?>></div>
  <?php } else { ?>
  <?php if($image3){ ?>
  <div class="image image3<?php if($image_mobile3){ echo ' pc'; }; ?>" style="background:url(<?php echo esc_attr($image3[0]); ?>) no-repeat center center; background-size:cover;"></div>
  <?php if($image_mobile3){ ?>
  <div class="image image3 mobile" style="background:url(<?php echo esc_attr($image_mobile3[0]); ?>) no-repeat center center; background-size:cover;"></div>
  <?php }; ?>
  <?php }; ?>
  <?php }; ?>

  <?php }; ?>

  <?php
       } elseif($bg_type == 'type2') {
         if(!empty($video)) {
           if (auto_play_movie()) {
  ?>
  <video class="video<?php if ( !empty($content['use_para']) && !is_mobile() ) echo ' video_parallax'; ?>" src="<?php echo esc_url(wp_get_attachment_url($video)); ?>" playsinline autoplay loop muted></video>
  <?php
           } else {
             if($image1){
  ?>
  <div class="image image1<?php if($image_mobile1){ echo ' pc'; }; ?>" style="background:url(<?php echo esc_attr($image1[0]); ?>) no-repeat center center; background-size:cover;"></div>
  <?php if($image_mobile1){ ?>
  <div class="image image1 mobile" style="background:url(<?php echo esc_attr($image_mobile1[0]); ?>) no-repeat center center; background-size:cover;"></div>
  <?php }; ?>
  <?php
             }
           };
         };
       } elseif($bg_type == 'type3') {
         if(!empty($youtube)) {
           if (auto_play_movie()) {
             if(preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[\w\-?&!#=,;]+/[\w\-?&!#=/,;]+/|(?:v|e(?:mbed)?)/|[\w\-?&!#=,;]*[?&]v=)|youtu\.be/)([\w-]{11})(?:[^\w-]|\Z)%i', $youtube, $matches)) {
  ?>
  <div class="youtube_wrap">
   <div class="youtube_inner">
    <iframe class="youtube_item" src="https://www.youtube.com/embed/<?php echo esc_attr($matches[1]); ?>?enablejsapi=1&controls=0&fs=0&iv_load_policy=3&rel=0&showinfo=0&autoplay=1&mute=1&loop=1&<?php echo "playlist=" . esc_attr($matches[1]); ?>&playsinline=1" frameborder="0"></iframe>
   </div>
  </div>
  <?php
             };
           } else {
             if($image1){
  ?>
  <div class="image image1<?php if($image_mobile1){ echo ' pc'; }; ?>" style="background:url(<?php echo esc_attr($image1[0]); ?>) no-repeat center center; background-size:cover;"></div>
  <?php if($image_mobile1){ ?>
  <div class="image image1 mobile" style="background:url(<?php echo esc_attr($image_mobile1[0]); ?>) no-repeat center center; background-size:cover;"></div>
  <?php }; ?>
  <?php
             }
           };
         };
       };
  ?>

 </div><!--END .content1 -->

 <?php // 右側のコンテンツ ---------------------------------- ?>
 <?php if($layout != 'type6'){ ?>
 <div class="content content2" style="background-color:<?php echo esc_attr($content['bg_color']); ?>; color:<?php echo esc_attr($content['font_color']); ?>;">

  <?php if($layout == 'type4'){ ?>
  <div class="content_top">
  <?php }; ?>
   <div class="content_inner">
    <?php if($content['catch_type'] == 'type1' && $content['headline']){ ?>
    <h2 class="headline common_headline rich_font_<?php echo esc_attr($options['headline_font_type']); ?>"><?php echo wp_kses_post(nl2br($content['headline'])); ?></h2>
    <?php }; ?>
    <?php if($content['catch_type'] == 'type2' && $content['catch']){ ?>
    <h3 class="catch common_sub_headline"><?php echo wp_kses_post(nl2br($content['catch'])); ?></h3>
    <?php }; ?>
    <?php if($content['desc']){ ?>
    <p class="desc<?php if(empty($content['headline']) && empty($content['catch'])){ echo ' no_headline'; }; ?>"><?php echo wp_kses_post(nl2br($content['desc'])); ?></p>
    <?php }; ?>
    <?php if($content['show_button']){ ?>
    <div class="link_button">
     <a class="design_button" href="<?php echo esc_url($content['button_url']); ?>"><span><?php echo esc_html($content['button_label']); ?></span></a>
    </div>
    <?php }; ?>
   </div>
  <?php if($layout == 'type4'){ ?>
  </div>
  <?php }; ?>

  <?php if($layout == 'type4' && $image4){ ?>
  <div class="image image4<?php if($image_mobile4){ echo ' pc'; }; ?>" style="background:url(<?php echo esc_attr($image4[0]); ?>) no-repeat center center; background-size:cover;"></div>
  <?php if($image_mobile4){ ?>
  <div class="image image4 mobile" style="background:url(<?php echo esc_attr($image_mobile4[0]); ?>) no-repeat center center; background-size:cover;"></div>
  <?php }; ?>
  <?php }; ?>

 </div><!--END .content2 -->
 <?php }; ?>

</div><!-- END .cb_design_content -->

<?php
         // 画像スライダー -----------------------------------------------------
         } elseif ( $content['cb_content_select'] == 'image_slider' && $content['show_content'] ) {
           $layout = isset($content['layout']) ? $content['layout'] : 'type1';
?>
<div class="cb_image_slider num<?php echo $content_count; ?> layout_<?php echo esc_attr($layout); ?><?php if(!$content['show_news_ticker']){ echo ' no_news_ticker'; }; ?>" id="<?php echo 'cb_content_' . $content_count; ?>">

 <div class="cb_slider_wrap">

  <?php
       //　スライダー ---------------------------------------------------------
       $data_list = isset($content['item_list']) ?  $content['item_list'] : '';
       if (!empty($data_list)) {
         $total_item = count($data_list);
  ?>
  <div class="cb_slider<?php if($total_item == 1){ echo ' one_item'; }; ?>">
   <?php
        $i = 1;
        foreach ( $data_list as $key => $value ) :
          $image = isset($value['image']) ? wp_get_attachment_image_src( $value['image'], 'full' ) : '';
          $image_mobile = isset($value['image_mobile']) ? wp_get_attachment_image_src( $value['image_mobile'], 'full' ) : '';
   ?>
   <div class="item item<?php echo $i; ?> <?php if($i == 1){ echo 'first_item'; }; ?>">

    <div class="caption">

     <?php if(!empty($value['catch'])){ ?>
     <h3 class="catch animate_item rich_font_<?php echo esc_attr($value['catch_font_type']); ?>"><?php echo wp_kses_post(nl2br($value['catch'])); ?></h3>
     <?php }; ?>

     <?php if(!empty($value['desc'])){ ?>
     <div class="desc animate_item">
      <p><?php echo wp_kses_post(nl2br($value['desc'])); ?></p>
     </div>
     <?php }; ?>

     <?php if(!empty($value['show_button'])){ ?>
     <div class="button animate_item">
      <a class="slider_design_button" href="<?php echo esc_url($value['button_url']); ?>"><span><?php echo esc_html($value['button_label']); ?></span></a>
     </div>
     <?php }; ?>

    </div><!-- END .caption -->

    <?php if( ($value['overlay_opacity'] != 0) && $image ) { ?><div class="overlay"></div><?php }; ?>

    <?php if($image) { ?><div class="bg_image <?php if($image_mobile) { echo 'pc'; }; ?>" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div><?php }; ?>
    <?php if($image_mobile) { ?><div class="bg_image mobile" style="background:url(<?php echo esc_attr($image_mobile[0]); ?>) no-repeat center center; background-size:cover;"></div><?php }; ?>

   </div><!-- END .item -->
   <?php $i++; endforeach; ?>
  </div><!-- END .cb_slider -->
  <?php }; ?>

  <?php
       // ニュースティッカー -----------------------------------
       if($content['show_news_ticker']){
         $post_num = '5';
         $post_type = $content['news_ticker_post_type'];
         $post_order = $content['news_ticker_post_order'];
         $args = array( 'post_type' => $post_type, 'posts_per_page' => $post_num, 'orderby' => $post_order );
         $post_list = new wp_query($args);
         if($post_list->have_posts()):
  ?>
  <div class="cb_news_ticker">
   <div class="post_list">
    <?php
         while($post_list->have_posts()): $post_list->the_post();
    ?>
    <article class="item">
     <a href="<?php the_permalink(); ?>">
      <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
      <h3 class="title"><span><?php the_title(); ?></span></h3>
     </a>
    </article>
    <?php endwhile; ?>
   </div>
  </div><!-- END .cb_news_ticker -->
  <?php
         endif;
         wp_reset_query();
       };
  ?>

 </div><!-- END .cb_slider_wrap -->

 <?php
       // 説明文 -----------------------------------
      if($layout == 'type1' && $content['desc']){
 ?>
 <div class="desc_area" style="background-color:<?php echo esc_attr($content['desc_bg_color']); ?>; color:<?php echo esc_attr($content['desc_font_color']); ?>;">
  <p class="desc"><?php echo wp_kses_post(nl2br($content['desc'])); ?></p>
 </div>
 <?php }; ?>

</div><!-- END .cb_image_slider -->

<?php
          // ボックスコンテンツ -----------------------------------------------------------------
          } elseif ( ($content['cb_content_select'] == 'box_content') && $content['show_content']) {
?>
<div class="cb_box num<?php echo $content_count; ?>" id="<?php echo 'cb_content_' . $content_count; ?>">

 <?php
      for ( $i = 1; $i <= 3; $i++ ):
        $image = isset($content['image'.$i]) ? wp_get_attachment_image_src( $content['image'.$i], 'full' ) : '';
        $image_mobile = isset($content['image_mobile'.$i]) ? wp_get_attachment_image_src( $content['image_mobile'.$i], 'full' ) : '';
        $video = $content['video'.$i];
        $youtube = $content['youtube'.$i];
        $bg_type = isset($content['bg_type'.$i]) ? $content['bg_type'.$i] : 'type1';

 ?>
 <div class="content num<?php echo $i; if($bg_type == 'type3'){ echo ' youtube_bg'; if ( !empty($content['use_para' . $i]) && !is_mobile() ) { echo ' youtube_bg_parallax'; }; }; ?>" style="background-color:<?php echo esc_attr($content['bg_color'.$i]); ?>; color:<?php echo esc_attr($content['font_color'.$i]); ?>;">

  <div class="mobile_content_wrap">

  <div class="content_inner">
   <?php if($content['headline'.$i]){ ?>
   <h2 class="headline common_headline rich_font_<?php echo esc_attr($options['headline_font_type']); ?>"><?php echo wp_kses_post(nl2br($content['headline'.$i])); ?></h2>
   <?php }; ?>
   <div class="content_inner_sub">
    <?php if($content['desc_top'.$i]){ ?>
    <p class="desc desc_top"><?php echo wp_kses_post(nl2br($content['desc_top'.$i])); ?></p>
    <?php }; ?>
    <?php if($content['desc_middle'.$i]){ ?>
    <p class="desc desc_middle"><?php echo wp_kses_post(nl2br($content['desc_middle'.$i])); ?></p>
    <?php }; ?>
   </div>
  </div>

  <?php if($content['desc_bottom'.$i]){ ?>
  <p class="desc desc_bottom"><?php echo wp_kses_post(nl2br($content['desc_bottom'.$i])); ?></p>
  <?php }; ?>

  </div>

  <?php
       if($bg_type != 'type4'){
         if( ($content['overlay_opacity'.$i] != 0) && ($image || $video || $youtube) ){
           $overlay_color = hex2rgb($content['overlay_color'.$i]);
           $overlay_color = implode(",",$overlay_color);
           $overlay_opacity = $content['overlay_opacity'.$i];
  ?>
  <div class="overlay" style="background-color:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>);"></div>
  <?php }; }; ?>

  <?php if($bg_type == 'type1'){ ?>

  <?php if ( ! empty( $content['use_para' . $i] ) && ( $image || $image_mobile ) ) { ?>
  <div class="image"  data-parallax-image="<?php echo esc_attr( $image[0] ); ?>"<?php if ($image_mobile) echo ' data-parallax-mobile-image="' . esc_attr( $image_mobile[0] ) . '"'; ?>></div>
  <?php } else { ?>
  <?php if($image){ ?>
  <div class="image<?php if($image_mobile){ echo ' pc'; }; ?>" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
  <?php if($image_mobile){ ?>
  <div class="image mobile" style="background:url(<?php echo esc_attr($image_mobile[0]); ?>) no-repeat center center; background-size:cover;"></div>
  <?php }; ?>
  <?php }; ?>
  <?php }; ?>

  <?php
       } elseif($bg_type == 'type2') {
         if(!empty($video)) {
           if (auto_play_movie()) {
  ?>
  <video class="video<?php if ( !empty($content['use_para' . $i]) && !is_mobile() ) echo ' video_parallax'; ?>" src="<?php echo esc_url(wp_get_attachment_url($video)); ?>" playsinline autoplay loop muted></video>
  <?php
           } else {
             if($image){
  ?>
  <div class="image<?php if($image_mobile){ echo ' pc'; }; ?>" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
  <?php if($image_mobile1){ ?>
  <div class="image mobile" style="background:url(<?php echo esc_attr($image_mobile[0]); ?>) no-repeat center center; background-size:cover;"></div>
  <?php }; ?>
  <?php
             }
           };
         };
       } elseif($bg_type == 'type3') {
         if(!empty($youtube)) {
           if (auto_play_movie()) {
             if(preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[\w\-?&!#=,;]+/[\w\-?&!#=/,;]+/|(?:v|e(?:mbed)?)/|[\w\-?&!#=,;]*[?&]v=)|youtu\.be/)([\w-]{11})(?:[^\w-]|\Z)%i', $youtube, $matches)) {
  ?>
  <div class="youtube_wrap">
   <div class="youtube_inner">
    <iframe class="youtube_item" src="https://www.youtube.com/embed/<?php echo esc_attr($matches[1]); ?>?enablejsapi=1&controls=0&fs=0&iv_load_policy=3&rel=0&showinfo=0&autoplay=1&mute=1&loop=1&<?php echo "playlist=" . esc_attr($matches[1]); ?>&playsinline=1" frameborder="0"></iframe>
   </div>
  </div>
  <?php
             };
           } else {
             if($image){
  ?>
  <div class="image<?php if($image_mobile){ echo ' pc'; }; ?>" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
  <?php if($image_mobile1){ ?>
  <div class="image mobile" style="background:url(<?php echo esc_attr($image_mobile[0]); ?>) no-repeat center center; background-size:cover;"></div>
  <?php }; ?>
  <?php
             }
           };
         };
       };
  ?>

 </div>
 <?php endfor; ?>

</div><!-- END .cb_box -->


<?php
          // アクセス -----------------------------------------------------------------
          } elseif ( ($content['cb_content_select'] == 'access_map') && $content['show_content']) {
?>
<div class="cb_access num<?php echo $content_count; ?>" id="<?php echo 'cb_content_' . $content_count; ?>">

 <?php
      // 地図 ------------------------------
      if($content['address']){
        $address = esc_html($content['address']);
 ?>
 <div class="map_area">
  <?php echo do_shortcode('[qt_google_map address="' . $address . '"]'); ?>
 </div>
 <?php }; ?>

 <?php // コンテンツ ------------------------------ ?>
 <div class="content" style="background-color:<?php echo esc_attr($content['bg_color']); ?>;">
  <div class="content_inner">

   <?php if($content['show_logo']){ ?>
   <div class="logo">
    <?php header_logo(); ?>
   </div>
   <?php }; ?>

   <?php if($content['desc']){ ?>
   <p class="desc"><?php echo wp_kses_post(nl2br($content['desc'])); ?></p>
   <?php }; ?>

   <?php
        if($content['show_sns']) {
          $facebook = $options['sns_button_facebook_url'];
          $twitter = $options['sns_button_twitter_url'];
          $insta = $options['sns_button_instagram_url'];
          $pinterest = $options['sns_button_pinterest_url'];
          $youtube = $options['sns_button_youtube_url'];
          $contact = $options['sns_button_contact_url'];
   ?>
   <ul class="sns_button_list clearfix color_<?php echo esc_attr($options['sns_button_color_type']); ?>">
    <?php if($insta) { ?><li class="insta"><a href="<?php echo esc_url($insta); ?>" rel="nofollow noopener" target="_blank" title="Instagram"><span>Instagram</span></a></li><?php }; ?>
    <?php if($twitter) { ?><li class="twitter"><a href="<?php echo esc_url($twitter); ?>" rel="nofollow noopener" target="_blank" title="Twitter"><span>Twitter</span></a></li><?php }; ?>
    <?php if($facebook) { ?><li class="facebook"><a href="<?php echo esc_url($facebook); ?>" rel="nofollow noopener" target="_blank" title="Facebook"><span>Facebook</span></a></li><?php }; ?>
    <?php if($pinterest) { ?><li class="pinterest"><a href="<?php echo esc_url($pinterest); ?>" rel="nofollow noopener" target="_blank" title="Pinterest"><span>Pinterest</span></a></li><?php }; ?>
    <?php if($youtube) { ?><li class="youtube"><a href="<?php echo esc_url($youtube); ?>" rel="nofollow noopener" target="_blank" title="Youtube"><span>Youtube</span></a></li><?php }; ?>
    <?php if($contact) { ?><li class="contact"><a href="<?php echo esc_url($contact); ?>" rel="nofollow noopener" target="_blank" title="Contact"><span>Contact</span></a></li><?php }; ?>
   </ul>
   <?php }; ?>

  </div>
 </div>

</div><!-- END .cb_access -->

<?php
         // フリースペース -----------------------------------------------------
         } elseif ( $content['cb_content_select'] == 'free_space' && $content['show_content'] ) {
?>
<div class="cb_free_space num<?php echo $content_count; ?>" id="<?php echo 'cb_content_' . $content_count; ?>">

 <?php if($content['free_space']){ ?>
 <div class="post_content clearfix">
  <?php echo apply_filters('the_content', $content['free_space'] ); ?>
 </div>
 <?php }; ?>

</div><!-- END .cb_free_space -->
<?php
         };
       $content_count++;
       endforeach; // END 並び替え
     endif;
?>

 <?php endwhile; endif; ?>

 <?php get_template_part('template-parts/side_copyright'); ?>

</div><!-- END #wide_contents -->
<?php get_footer(); ?>