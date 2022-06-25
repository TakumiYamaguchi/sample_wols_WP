<?php
     get_header();
     $options = get_design_plus_option();
     $headline_font_type = $options['news_headline_font_type'];
     if ( have_posts() ) : while ( have_posts() ) : the_post();
?>
<?php get_template_part('template-parts/breadcrumb'); ?>

<div id="main_contents">

 <?php if($page == '1') { // ***** only show on first page ***** ?>

 <div id="single_post_title">
  <div class="meta">
   <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
   <?php
        $post_date = get_the_time('Ymd');
        $modified_date = get_the_modified_date('Ymd');
        if($post_date < $modified_date){
   ?>
   <time class="update entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_modified_date('Y.m.d'); ?></time>
   <?php }; ?>
  </div>
  <h1 class="title rich_font_<?php echo esc_attr($headline_font_type); ?> entry-title"><?php the_title(); ?></h1>
 </div>

 <?php
      // アイキャッチ画像 -----------------------------------
      if(has_post_thumbnail()) {
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size4' );
 ?>
 <div id="single_post_image">
  <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
 </div>
 <?php }; ?>

 <?php
      // 次の記事、前の記事リンク -----------------------------------
      $prev_post = get_adjacent_post(false, '', true);
      $next_post = get_adjacent_post(false, '', false);
      if ($prev_post) {
        $post_id = $prev_post->ID;
 ?>
 <a class="single_post_nav prev_post" href="<?php echo get_permalink($post_id); ?>">
  <span><?php echo __('Prev post', 'tcd-horizon'); ?></span>
 </a>
 <?php
      };
      if ($next_post) {
        $post_id = $next_post->ID;
  ?>
  <a class="single_post_nav next_post" href="<?php echo get_permalink($post_id); ?>">
   <span><?php echo __('Next post', 'tcd-horizon'); ?></span>
 </a>
 <?php }; ?>

 <?php }; // end if first page ?>

 <div id="main_col">

  <article id="article">

   <?php if($page == '1') { // ***** only show on first page ***** ?>

   <?php
        // sns button top ------------------------------------------------------------------------------------------------------------------------
        if($options['single_news_show_sns_top'] == 'display') {
   ?>
   <div class="single_share clearfix" id="single_share_top">
    <?php get_template_part('template-parts/sns-btn-top'); ?>
   </div>
   <?php }; ?>

   <?php
        // copy title&url button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['single_news_show_copy_top'] == 'display') {
   ?>
   <div class="single_copy_title_url" id="single_copy_title_url_top">
    <button class="single_copy_title_url_btn" data-clipboard-text="<?php echo esc_attr( strip_tags( get_the_title() ) . ' ' . get_permalink() ); ?>" data-clipboard-copied="<?php echo esc_attr( __( 'COPIED TITLE &amp; URL', 'tcd-horizon' ) ); ?>"><?php _e( 'COPY TITLE &amp; URL', 'tcd-horizon' ); ?></button>
   </div>
   <?php }; ?>

   <?php
        // banner top ------------------------------------------------------------------------------------------------------------------------
        if(!is_mobile()) {
          if( $options['news_single_top_ad_code']) {
   ?>
   <div id="single_banner_top" class="single_banner">
    <?php echo $options['news_single_top_ad_code']; ?>
   </div><!-- END #single_banner_top -->
   <?php
          };
        };
   ?>

   <?php }; // ***** END only show on first page ***** ?>

   <?php // post content ------------------------------------------------------------------------------------------------------------------------ ?>
   <div class="post_content clearfix">
    <?php
         the_content();
         if ( ! post_password_required() ) {
           custom_wp_link_pages();
         }
    ?>
   </div>

   <?php
        // sns button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['single_news_show_sns_btm'] == 'display') {
   ?>
   <div class="single_share clearfix" id="single_share_bottom">
    <?php get_template_part('template-parts/sns-btn-btm'); ?>
   </div>
   <?php }; ?>

   <?php
        // page nav ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
   ?>
   <div id="next_prev_post">
    <?php next_prev_post_link(); ?>
   </div>

  </article><!-- END #article -->

   <?php
        // banner bottom ------------------------------------------------------------------------------------------------------------------------
        if(!is_mobile()) {
          if( $options['news_single_bottom_ad_code'] ) {
   ?>
   <div id="single_banner_bottom" class="single_banner">
    <?php echo $options['news_single_bottom_ad_code']; ?>
   </div><!-- END #single_banner_bottom -->
   <?php
          };
        };
   ?>

   <?php
        // mobile banner ------------------------------------------------------------------------------------------------------------------------
        if(is_mobile()) {
          if( $options['news_single_mobile_ad_code'] ) {
   ?>
   <div id="single_banner_bottom" class="single_banner">
    <?php echo $options['news_single_mobile_ad_code']; ?>
   </div><!-- END #single_banner_bottom -->
   <?php
          };
        };
   ?>

 </div><!-- END #main_col -->

</div><!-- END #main_contents -->

<?php endwhile; endif; ?>

  <?php
       // recent post ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
       if ($options['show_recent_news']){
         $post_num = $options['recent_news_num'];
         if(is_mobile()){
           $post_num = $options['recent_news_num_sp'];
         }
         $args = array( 'post_type' => 'news', 'post__not_in' => array($post->ID), 'showposts'=> $post_num, 'orderby' => 'rand');
         $recent_post_list = new wp_query($args);
         if($recent_post_list->have_posts()):
  ?>
  <div id="related_post">
   <h3 class="headline rich_font_<?php echo esc_attr($headline_font_type); ?>"><span><?php echo wp_kses_post(nl2br($options['recent_news_headline'])); ?></span></h3>
   <div class="post_list owl-carousel">
    <?php
         while( $recent_post_list->have_posts() ) : $recent_post_list->the_post();
           if(has_post_thumbnail()) {
             $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
           } elseif($options['news_no_image']) {
             $image = wp_get_attachment_image_src( $options['news_no_image'], 'full' );
           } elseif($options['no_image1']) {
             $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
           } else {
             $image = array();
             $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image1.gif";
           }
    ?>
    <article class="item">
     <div class="meta">
      <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
     </div>
     <a class="image_wrap animate_background" href="<?php the_permalink(); ?>">
      <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
     </a>
     <h4 class="title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h4>
    </article>
    <?php endwhile; wp_reset_query(); ?>
   </div><!-- END .post_list -->
  </div><!-- END #related_post -->
  <?php
         endif;
       };
  ?>

 <?php
      // widget ------------------------
      get_sidebar();
 ?>

<?php get_footer(); ?>