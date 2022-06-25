<?php
     get_header();
     $options = get_design_plus_option();
     $headline = $options['archive_news_headline'];
     $headline_font_type = $options['news_headline_font_type'];
     $desc = $options['archive_news_desc'];
?>
<div id="wide_contents">

 <?php if(!is_paged()){ ?>
 <div id="archive_header">
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

 <div id="news_list">
  <?php
       while ( have_posts() ) : the_post();
         if(has_post_thumbnail()) {
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size3' );
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
   <time class="date entry-date published" datetime="<?php the_modified_time('c'); ?>"><?php the_time('Y.m.d'); ?></time>
   <div class="content">
    <h2 class="title"><a href="<?php the_permalink(); ?>"><span><?php the_title(); ?></span></a></h2>
    <a class="image_wrap animate_background" href="<?php the_permalink(); ?>">
     <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
    </a>
    <p class="desc"><span><?php echo trim_excerpt(200); ?></span></p>
   </div>
  </article>
  <?php endwhile; ?>
 </div><!-- END #news_list -->

 <?php get_template_part('template-parts/navigation'); ?>

 <?php else: ?>

 <p id="no_post"><?php _e('There is no registered post.', 'tcd-horizon');  ?></p>

 <?php endif; ?>

 <?php get_template_part('template-parts/side_copyright'); ?>

</div><!-- END #wide_contents -->

<?php get_footer(); ?>