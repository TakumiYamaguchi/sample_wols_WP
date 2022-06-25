<?php
     get_header();
     $options = get_design_plus_option();
     $options = get_design_plus_option();
     if ( !empty( get_search_query() ) ) {
       $headline = sprintf( __( 'Search result for %s', 'tcd-horizon' ), get_search_query() );
     } else {
       $headline = __( 'Search result', 'tcd-horizon' );
     }
     $headline_font_type = $options['blog_headline_font_type'];
     $desc = $options['archive_blog_desc'];
?>
<div id="wide_contents">

 <?php if(!is_paged()){ ?>
 <div id="archive_header" class="archive">
  <div class="content">
   <?php if($headline){ ?>
   <h1 class="headline common_headline rich_font_<?php echo esc_attr($headline_font_type); ?>"><?php echo wp_kses_post(nl2br($headline)); ?></h1>
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
         } elseif($post->post_type == 'post' && $options['blog_no_image']) {
           $image = wp_get_attachment_image_src( $options['blog_no_image'], 'full' );
         } elseif($post->post_type == 'news' && $options['news_no_image']) {
           $image = wp_get_attachment_image_src( $options['news_no_image'], 'full' );
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
     <?php
          if($post->post_type == 'work') {
            $single_desc = get_post_meta($post->ID, 'single_desc', true);
            if($single_desc){
     ?>
     <p><span><?php  echo wp_kses_post(nl2br($single_desc)); ?></span></p>
     <?php
            };
          } else {
     ?>
     <p><span><?php echo trim_excerpt(200); ?></span></p>
     <?php }; ?>
    </div>

   </div>
  </article>
  <?php endwhile; ?>
 </div><!-- END #blog_list -->

 <?php get_template_part('template-parts/navigation'); ?>

 <?php else: ?>

 <p id="no_post"><span><?php echo wp_kses_post(nl2br($options['search_result_no_post_label']))  ?></span></p>

 <?php endif; ?>

 <?php get_template_part('template-parts/side_copyright'); ?>

</div><!-- END #wide_contents -->
<?php get_footer(); ?>