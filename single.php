<?php
     get_header();
     $options = get_design_plus_option();
     $headline_font_type = $options['blog_headline_font_type'];
     if ( have_posts() ) : while ( have_posts() ) : the_post();
       $category = wp_get_post_terms( $post->ID, 'category' , array( 'orderby' => 'term_order' ));
       if ( $category && ! is_wp_error($category) ) {
         foreach ( $category as $cat ) :
           $cat_name = $cat->name;
           $cat_id = $cat->term_id;
           $cat_url = get_term_link($cat_id,'category');
           break;
         endforeach;
       };
?>
<?php get_template_part('template-parts/breadcrumb'); ?>

<div id="main_contents">

 <?php if($page == '1') { // ***** only show on first page ***** ?>

 <div id="single_post_title">
  <div class="meta">
   <?php if ( $category && ! is_wp_error($category) ) { ?>
   <a class="category" href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat_name); ?></a>
   <?php }; ?>
   <?php if ($options['blog_show_date']){ ?>
   <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
   <?php
        $post_date = get_the_time('Ymd');
        $modified_date = get_the_modified_date('Ymd');
        if($post_date < $modified_date){
   ?>
   <time class="update entry-date updated" datetime="<?php the_modified_time('c'); ?>"><?php the_modified_date('Y.m.d'); ?></time>
   <?php }; ?>
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
        if($options['single_blog_show_sns_top'] == 'display') {
   ?>
   <div class="single_share clearfix" id="single_share_top">
    <?php get_template_part('template-parts/sns-btn-top'); ?>
   </div>
   <?php }; ?>

   <?php
        // copy title&url button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['single_blog_show_copy_top'] == 'display') {
   ?>
   <div class="single_copy_title_url" id="single_copy_title_url_top">
    <button class="single_copy_title_url_btn" data-clipboard-text="<?php echo esc_attr( strip_tags( get_the_title() ) . ' ' . get_permalink() ); ?>" data-clipboard-copied="<?php echo esc_attr( __( 'COPIED TITLE &amp; URL', 'tcd-horizon' ) ); ?>"><?php _e( 'COPY TITLE &amp; URL', 'tcd-horizon' ); ?></button>
   </div>
   <?php }; ?>

   <?php
        // banner top ------------------------------------------------------------------------------------------------------------------------
        if(!is_mobile()) {
          if( $options['single_top_ad_code']) {
   ?>
   <div id="single_banner_top" class="single_banner">
    <?php echo $options['single_top_ad_code']; ?>
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
        // Author profile ------------------------------------------------------------------------------------------------------------------------------
        $author_id = get_the_author_meta('ID');
        $user_data = get_userdata($author_id);
        if(!empty($user_data->show_author)) {
           $desc = $user_data->description;
           $facebook = $user_data->facebook_url;
           $twitter = $user_data->twitter_url;
           $insta = $user_data->instagram_url;
           $pinterest = $user_data->pinterest_url;
           $youtube = $user_data->youtube_url;
           $contact = $user_data->contact_url;
           $author_url = get_author_posts_url($author_id);
           $user_url = $user_data->user_url;
   ?>
   <div class="author_profile clearfix">
    <a class="avatar_area animate_image" href="<?php echo esc_url($author_url); ?>"><?php echo wp_kses_post(get_avatar($author_id, 300)); ?></a>
    <div class="info">
     <div class="info_inner">
      <h4 class="name rich_font_type2"><a href="<?php echo esc_url($author_url); ?>"><span class="author"><?php echo esc_html($user_data->display_name); ?></span></a></h4>
      <?php if($desc) { ?>
      <p class="desc"><span><?php echo esc_html($desc); ?></span></p>
      <?php }; ?>
      <?php if($facebook || $twitter || $insta || $pinterest || $youtube || $contact || $user_url) { ?>
      <ul id="author_sns" class="sns_button_list clearfix color_<?php echo esc_attr($options['sns_button_color_type']); ?>">
       <?php if($user_url) { ?><li class="user_url"><a href="<?php echo esc_url($user_url); ?>" target="_blank"><span><?php echo esc_url($user_url); ?></span></a></li><?php }; ?>
       <?php if($insta) { ?><li class="insta"><a href="<?php echo esc_url($insta); ?>" rel="nofollow" target="_blank" title="Instagram"><span>Instagram</span></a></li><?php }; ?>
       <?php if($twitter) { ?><li class="twitter"><a href="<?php echo esc_url($twitter); ?>" rel="nofollow" target="_blank" title="Twitter"><span>Twitter</span></a></li><?php }; ?>
       <?php if($facebook) { ?><li class="facebook"><a href="<?php echo esc_url($facebook); ?>" rel="nofollow" target="_blank" title="Facebook"><span>Facebook</span></a></li><?php }; ?>
       <?php if($pinterest) { ?><li class="pinterest"><a href="<?php echo esc_url($pinterest); ?>" rel="nofollow" target="_blank" title="Pinterest"><span>Pinterest</span></a></li><?php }; ?>
       <?php if($youtube) { ?><li class="youtube"><a href="<?php echo esc_url($youtube); ?>" rel="nofollow" target="_blank" title="Youtube"><span>Youtube</span></a></li><?php }; ?>
       <?php if($contact) { ?><li class="contact"><a href="<?php echo esc_url($contact); ?>" rel="nofollow" target="_blank" title="Contact"><span>Contact</span></a></li><?php }; ?>
      </ul>
      <?php }; ?>
     </div>
    </div>
   </div><!-- END .author_profile -->
   <?php }; ?>

   <?php
        // sns button ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if($options['single_blog_show_sns_btm'] == 'display') {
   ?>
   <div class="single_share clearfix" id="single_share_bottom">
    <?php get_template_part('template-parts/sns-btn-btm'); ?>
   </div>
   <?php }; ?>

   <?php
        // meta ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        if ( $options['single_blog_show_meta_author'] == 'display' || $options['single_blog_show_meta_category'] == 'display' || $options['single_blog_show_meta_tag'] == 'display' ) {
   ?>
   <ul id="post_meta_bottom" class="clearfix">
    <?php if ($options['single_blog_show_meta_author'] == 'display') : ?><li class="post_author"><?php _e("Author","tcd-horizon"); ?>: <?php if (function_exists('coauthors_posts_links')) { coauthors_posts_links(', ',', ','','',true); } else { the_author_posts_link(); }; ?></li><?php endif; ?>
    <?php if ($options['single_blog_show_meta_category'] == 'display'){ ?><li class="post_category"><?php the_category(', '); ?></li><?php }; ?>
    <?php if ($options['single_blog_show_meta_tag'] == 'display'): ?><?php the_tags('<li class="post_tag">',', ','</li>'); ?><?php endif; ?>
    <?php if (comments_open()) : if (comments_open()){ ?><li class="post_comment"><?php _e("Comment","tcd-horizon"); ?>: <a href="#comments"><?php comments_number( '0','1','%' ); ?></a></li><?php }; endif; ?>
   </ul>
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
          if( $options['single_bottom_ad_code'] ) {
   ?>
   <div id="single_banner_bottom" class="single_banner">
    <?php echo $options['single_bottom_ad_code']; ?>
   </div><!-- END #single_banner_bottom -->
   <?php
          };
        };
   ?>

   <?php
        // mobile banner ------------------------------------------------------------------------------------------------------------------------
        if(is_mobile()) {
          if( $options['single_mobile_ad_code'] ) {
   ?>
   <div id="single_banner_bottom" class="single_banner">
    <?php echo $options['single_mobile_ad_code']; ?>
   </div><!-- END #single_banner_bottom -->
   <?php
          };
        };
   ?>

  <?php
       // comment ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
       if (comments_open() || pings_open()) { comments_template('', true); };
  ?>

 </div><!-- END #main_col -->

</div><!-- END #main_contents -->

<?php endwhile; endif; ?>

  <?php
       // related post ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
       if ($options['show_related_post']){
         $categories = get_the_category($post->ID);
         if ($categories) {
           $post_num = $options['related_post_num'];
           if(is_mobile()){
             $post_num = $options['related_post_num_sp'];
           }
           $category_ids = array();
           foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
           $args = array( 'category__in' => $category_ids, 'post__not_in' => array($post->ID), 'showposts'=> $post_num, 'orderby' => 'rand');
           $related_post_list = new wp_query($args);
           if($related_post_list->have_posts()):
  ?>
  <div id="related_post">
   <h3 class="headline rich_font_<?php echo esc_attr($headline_font_type); ?>"><span><?php echo wp_kses_post(nl2br($options['related_post_headline'])); ?></span></h3>
   <div class="post_list owl-carousel">
    <?php
         while( $related_post_list->have_posts() ) : $related_post_list->the_post();
           if(has_post_thumbnail()) {
             $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size2' );
           } elseif($options['blog_no_image']) {
             $image = wp_get_attachment_image_src( $options['blog_no_image'], 'full' );
           } elseif($options['no_image1']) {
             $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
           } else {
             $image = array();
             $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image1.gif";
           }
           $category = wp_get_post_terms( $post->ID, 'category' , array( 'orderby' => 'term_order' ));
           if ( $category && ! is_wp_error($category) ) {
             foreach ( $category as $cat ) :
               $cat_name = $cat->name;
               $cat_id = $cat->term_id;
               $cat_url = get_term_link($cat_id,'category');
               break;
             endforeach;
           };
    ?>
    <article class="item">
     <div class="meta">
      <?php if ( $category && ! is_wp_error($category) ) { ?>
      <a class="category" href="<?php echo esc_url($cat_url); ?>"><?php echo esc_html($cat_name); ?></a>
      <?php }; ?>
      <?php if ($options['blog_show_date']){ ?>
      <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
      <?php }; ?>
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
       };
  ?>

 <?php
      // widget ------------------------
      get_sidebar();
 ?>

<?php get_footer(); ?>