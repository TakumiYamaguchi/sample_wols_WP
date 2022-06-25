<?php
     get_header();
     $options = get_design_plus_option();
     $headline_font_type = $options['blog_headline_font_type'];
     if ( have_posts() ) : while ( have_posts() ) : the_post();
?>
<?php get_template_part('template-parts/breadcrumb'); ?>

<div id="main_contents">

 <div id="single_post_title">
  <h1 class="title rich_font_<?php echo esc_attr($headline_font_type); ?> entry-title"><?php the_title(); ?></h1>
 </div>

 <?php
      // アイキャッチ画像 -----------------------------------
      $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'size4' );
 ?>
 <div id="single_post_image">
  <div class="image" style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center center; background-size:cover;"></div>
 </div>

 <div id="main_col">

  <article id="article">

   <?php // post content ------------------------------------------------------------------------------------------------------------------------ ?>
   <div class="post_content clearfix">
    <?php
         the_content();
         if ( ! post_password_required() ) {
           custom_wp_link_pages();
         }
    ?>
   </div>

  </article><!-- END #article -->

 </div><!-- END #main_col -->

</div><!-- END #main_contents -->

<?php endwhile; endif; ?>

 <?php
      // widget ------------------------
      get_sidebar();
 ?>

<?php get_footer(); ?>