<?php
     get_header();
     $options = get_design_plus_option();
     $headline = $options['archive_blog_headline'];
     $headline_font_type = $options['blog_headline_font_type'];
     $desc = $options['archive_blog_desc'];
     $author_info = $wp_query->get_queried_object();
     $author_id = $author_info->ID;
     if($author_id){
       $user_data = get_userdata($author_id);
       $headline = $user_data->display_name;
       $desc = $user_data->description;
       $facebook = $user_data->facebook_url;
       $twitter = $user_data->twitter_url;
       $insta = $user_data->instagram_url;
       $pinterest = $user_data->pinterest_url;
       $youtube = $user_data->youtube_url;
       $contact = $user_data->contact_url;
       $author_url = get_author_posts_url($author_id);
       $user_url = $user_data->user_url;
    }
?>
<div id="wide_contents">

 <?php if(!is_paged()){ ?>
 <div id="archive_header" class="archive">
  <div class="content">
   <div class="image"><?php echo wp_kses_post(get_avatar($author_id, 360)); ?></div>
   <?php if($headline){ ?>
   <h1 class="headline common_headline rich_font_<?php echo esc_attr($headline_font_type); ?>"><?php echo wp_kses_post(nl2br($headline)); ?></h1>
   <?php }; ?>
   <?php if($desc){ ?>
   <p class="desc"><?php echo wp_kses_post(nl2br($desc)); ?></p>
   <?php }; ?>
   <?php if($facebook || $twitter || $insta || $pinterest || $youtube || $contact || $user_url) { ?>
   <ul class="sns_button_list clearfix color_<?php echo esc_attr($options['sns_button_color_type']); ?>">
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
 <?php }; ?>

 <?php if ( have_posts() ) : ?>

 <div id="blog_list">
  <?php
       while ( have_posts() ) : the_post();
         if(has_post_thumbnail()) {
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size3' );
         } elseif($options['blog_no_image']) {
           $image = wp_get_attachment_image_src( $options['blog_no_image'], 'full' );
         } elseif($options['no_image1']) {
           $image = wp_get_attachment_image_src( $options['no_image1'], 'full' );
         } else {
           $image = array();
           $image[0] = esc_url(get_bloginfo('template_url')) . "/img/common/no_image1.gif";
         }
  ?>
  <article class="item">
   <div class="content">

    <div class="top_content">
     <div class="meta">
      <?php
           if(is_category()) {
           } else {
             $category = wp_get_post_terms( $post->ID, 'category' , array( 'orderby' => 'term_order' ));
             if ( $category && ! is_wp_error($category) ) {
               foreach ( $category as $cat ) :
                 $cat_name = $cat->name;
                 $cat_id = $cat->term_id;
                 break;
               endforeach;
      ?>
      <a class="category cat_id<?php echo esc_attr($cat_id); ?>" href="<?php echo esc_url(get_term_link($cat_id,'category')); ?>"><span><?php echo esc_html($cat_name); ?></span></a>
      <?php
             };
           };
      ?>
      <?php if ($options['blog_show_date']){ ?>
      <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
      <?php }; ?>
     </div>
     <h2 class="title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h2>
    </div>

    <a class="image_wrap animate_background" href="<?php the_permalink(); ?>">
     <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
    </a>

    <div class="bottom_content">
     <p><span><?php echo trim_excerpt(200); ?></span></p>
    </div>

   </div>
  </article>
  <?php endwhile; ?>
 </div><!-- END #blog_list -->

 <?php get_template_part('template-parts/navigation'); ?>

 <?php else: ?>

 <p id="no_post"><?php _e('There is no registered post.', 'tcd-horizon');  ?></p>

 <?php endif; ?>

 <?php get_template_part('template-parts/side_copyright'); ?>

</div><!-- END #wide_contents -->
<?php get_footer(); ?>