<?php
     get_header();
     $options = get_design_plus_option();
     $headline = $options['archive_blog_headline'];
     $headline_font_type = $options['blog_headline_font_type'];
     $desc = $options['archive_blog_desc'];
     if (is_category()) {
       $query_obj = get_queried_object();
       $headline = $query_obj->name;
       if (!empty($query_obj->description)){
         $desc = $query_obj->description;
       }
     } elseif(is_tag()) {
       $query_obj = get_queried_object();
       $headline = $query_obj->name;
       if (!empty($query_obj->description)){
         $desc = $query_obj->description;
       }
     } elseif ( is_day() ) {
       $headline = sprintf( __( 'Archive for %s', 'tcd-horizon' ), get_the_time( __( 'F jS, Y', 'tcd-horizon' ) ) );
     } elseif ( is_month() ) {
       $headline = sprintf( __( 'Archive for %s', 'tcd-horizon' ), get_the_time( __( 'F, Y', 'tcd-horizon') ) );
     } elseif ( is_year() ) {
       $headline = sprintf( __( 'Archive for %s', 'tcd-horizon' ), get_the_time( __( 'Y', 'tcd-horizon') ) );
     } elseif(is_author()) {
       $author_info = $wp_query->get_queried_object();
       $author_id = $author_info->ID;
       $user_data = get_userdata($author_id);
       $user_name = $user_data->display_name;
       $headline = sprintf( __( 'Archive for %s', 'tcd-horizon' ), $user_name );
     }

?>
<div id="wide_contents">

 <?php if(!is_paged()){ ?>
 <div id="archive_header"<?php if(!is_home()){ echo ' class="archive"'; }; ?>>
  <div class="content">
   <?php if($headline){ ?>
   <h1 class="headline common_headline rich_font_<?php echo esc_attr($headline_font_type); ?>"><?php echo wp_kses_post(nl2br($headline)); ?></h1>
   <?php }; ?>
   <?php if($desc){ ?>
   <p class="desc"><?php echo wp_kses_post(nl2br($desc)); ?></p>
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

 <?php
      // featured post ---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
       if ($options['show_featured_post']){
         $args = array( 'showposts'=> '3', 'orderby' => 'rand', 'meta_key' => 'featured_post', 'meta_value' => 'on');
         $featured_post_list = new wp_query($args);
         if($featured_post_list->have_posts()):
 ?>
 <div id="featured_post">
  <h3 class="headline rich_font_<?php echo esc_attr($headline_font_type); ?>"><span><?php echo wp_kses_post(nl2br($options['featured_post_headline'])); ?></span></h3>
  <div class="post_list">
   <?php
        while( $featured_post_list->have_posts() ) : $featured_post_list->the_post();
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
   ?>
   <article class="item">
    <a class="link animate_background" href="<?php the_permalink(); ?>">
     <div class="image_wrap">
      <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
     </div>
     <div class="content">
      <h4 class="title"><span><?php the_title(); ?></span></h4>
      <?php if ($options['blog_show_date']){ ?>
      <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
      <?php }; ?>
     </div>
    </a>
   </article>
   <?php endwhile; wp_reset_query(); ?>
  </div><!-- END .post_list -->
 </div><!-- END #featured_post -->
 <?php
        endif;
      };
 ?>

 <?php get_template_part('template-parts/navigation'); ?>

 <?php else: ?>

 <p id="no_post"><?php _e('There is no registered post.', 'tcd-horizon');  ?></p>

 <?php endif; ?>

 <?php get_template_part('template-parts/side_copyright'); ?>

</div><!-- END #wide_contents -->
<?php get_footer(); ?>