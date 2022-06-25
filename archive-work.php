<?php
     get_header();
     $options = get_design_plus_option();
     $headline = $options['archive_work_headline'];
     $headline_font_type = $options['work_headline_font_type'];
     $desc1 = $options['archive_work_desc1'];
     $desc2 = $options['archive_work_desc2'];
     $desc3 = $options['archive_work_desc3'];
     $bg_image = wp_get_attachment_image_src( $options['archive_work_bg_image'], 'full' );
     $list_last_image = wp_get_attachment_image_src( $options['archive_work_list_bg_image'], 'full' );
?>
<div id="wide_contents">

 <?php if($desc1){ ?>
 <div class="work_archive_desc">
  <p class="desc"><?php echo wp_kses_post(nl2br($desc1)); ?></p>
 </div>
 <?php }; ?>

 <div id="work_archive_header">
  <div class="content">
   <?php if($headline){ ?>
   <h1 class="headline common_headline rich_font_<?php echo esc_attr($headline_font_type); ?>"><?php echo wp_kses_post(nl2br($headline)); ?></h1>
   <?php }; ?>
   <?php if($desc2){ ?>
   <p class="desc"><?php echo wp_kses_post(nl2br($desc2)); ?></p>
   <?php }; ?>
  </div>
  <?php if($options['archive_work_overlay_opacity'] != 0){ ?>
  <div class="overlay"></div>
  <?php }; ?>
  <?php if($bg_image){ ?>
  <div class="content_bg_image" style="background:url(<?php echo esc_attr($bg_image[0]); ?>) no-repeat center center; background-size:cover;"></div>
  <?php }; ?>
 </div>

 <?php
      if ( have_posts() ) :
        $total_post = $wp_query->found_posts;
 ?>

 <div id="work_list" style="width:calc(100vw / 3 * <?php echo ceil($total_post / 2); ?>);">
  <?php
       while ( have_posts() ) : the_post();
         if(has_post_thumbnail()) {
           $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size5' );
           $accent_color = get_post_meta($post->ID, 'accent_color', true) ?  get_post_meta($post->ID, 'accent_color', true) : '#0b5d7c';
           $archive_desc = get_post_meta($post->ID, 'archive_desc', true);
  ?>
  <article class="item" id="work_list_id<?php echo esc_attr($post->ID); ?>">
   <a class="animate_background" href="<?php the_permalink(); ?>">
    <div class="content">
     <div class="content_inner">
      <h2 class="title"><span><?php the_title(); ?></span></h2>
      <?php if($archive_desc){ ?><p class="desc"><span><?php  echo wp_kses_post(nl2br($archive_desc)); ?></span></p><?php }; ?>
     </div>
    </div>
    <div class="overlay"></div>
    <div class="image_wrap">
     <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
    </div>
   </a>
  </article>
  <?php }; endwhile; ?>
 </div><!-- END #work_list -->

 <?php if($list_last_image){ ?>
 <div class="work_archive_desc">
  <div class="overlay"></div>
  <div class="bg_image" style="background:url(<?php echo esc_attr($list_last_image[0]); ?>) no-repeat center center; background-size:cover;"></div>
 </div>
 <?php }; ?>

 <?php if($desc3){ ?>
 <div class="work_archive_desc">
  <p class="desc"><?php echo wp_kses_post(nl2br($desc3)); ?></p>
 </div>
 <?php }; ?>

 <?php else: ?>

 <p id="no_post"><?php _e('There is no registered post.', 'tcd-horizon');  ?></p>

 <?php endif; ?>

 <?php get_template_part('template-parts/side_copyright'); ?>

</div><!-- END #wide_contents -->
<?php get_footer(); ?>