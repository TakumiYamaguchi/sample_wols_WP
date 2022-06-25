<?php
     get_header();
     $options = get_design_plus_option();
     $catch = get_post_meta($post->ID, 'page_header_catch', true);
     $catch_mobile = get_post_meta($post->ID, 'page_header_catch_sp', true);
     $catch_font_type = get_post_meta($post->ID, 'page_header_catch_font_type', true) ?  get_post_meta($post->ID, 'page_header_catch_font_type', true) : 'type3';
     $desc = get_post_meta($post->ID, 'page_header_desc', true);
     $desc_mobile = get_post_meta($post->ID, 'page_header_desc_sp', true);
     $bg_image = wp_get_attachment_image_src(get_post_meta($post->ID, 'page_header_bg_image', true), 'full');
     $use_overlay = get_post_meta($post->ID, 'page_header_overlay_opacity', true);

     $hide_page_header = get_post_meta($post->ID, 'hide_page_header', true) ?  get_post_meta($post->ID, 'hide_page_header', true) : 'no';
     $page_header_type = get_post_meta($post->ID, 'page_header_type', true) ?  get_post_meta($post->ID, 'page_header_type', true) : 'type2';

     $page_hide_bread = get_post_meta($post->ID, 'page_hide_bread', true) ?  get_post_meta($post->ID, 'page_hide_bread', true) : 'no';
     $page_layout = get_post_meta($post->ID, 'page_layout', true) ?  get_post_meta($post->ID, 'page_layout', true) : 'type1';
     $change_content_width = get_post_meta($post->ID, 'change_content_width', true) ?  get_post_meta($post->ID, 'change_content_width', true) : 'no';
     if($change_content_width == 'yes'){
       $page_content_width = get_post_meta($post->ID, 'page_content_width', true) ?  get_post_meta($post->ID, 'page_content_width', true) : '840';
     } else {
       $page_content_width = '840';
     }
     if($hide_page_header != 'yes'){
?>
<div id="page_header"<?php if($page_header_type == 'type3'){ echo ' class="full_height"'; }; ?>>

 <div id="page_header_inner">
  <?php if($catch){ ?>
  <h1 class="catch animate_item rich_font_<?php echo esc_attr($catch_font_type); ?>"><?php if($catch_mobile){ ?><span class="pc"><?php }; ?><?php echo wp_kses_post(nl2br($catch)); ?><?php if($catch_mobile){ ?></span><span class="mobile"><?php echo wp_kses_post(nl2br($catch_mobile)); ?></span><?php }; ?></h1>
  <?php }; ?>
  <?php if($desc){ ?>
  <p class="desc animate_item"><?php if($desc_mobile){ ?><span class="pc"><?php }; ?><?php echo wp_kses_post(nl2br($desc)); ?><?php if($desc_mobile){ ?></span><span class="mobile"><?php echo wp_kses_post(nl2br($desc_mobile)); ?></span><?php }; ?></p>
  <?php }; ?>
 </div>

 <?php if($page_header_type == 'type3'){ ?>
 <a class="animate_item" id="page_contents_link" href="<?php if($page_hide_bread == 'yes'){ echo '#main_contents'; } else { echo '#bread_crumb'; }; ?>"></a>
 <?php }; ?>

 <?php if($use_overlay != 0) { ?>
 <div class="overlay"></div>
 <?php }; ?>

 <?php if(!empty($bg_image)) { ?>
 <div class="bg_image" style="background:url(<?php echo esc_attr($bg_image[0]); ?>) no-repeat center top; background-size:cover;"></div>
 <?php }; ?>

</div>
<?php }; ?>

<?php if($page_hide_bread != 'yes'){ get_template_part('template-parts/breadcrumb'); }; ?>

<div id="main_contents">

 <div id="main_col" style="width:<?php echo esc_html($page_content_width); ?>px;">

  <article id="article">

   <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

   <?php // post content ------------------------------------------------------------------------------------------------------------------------ ?>
   <div class="post_content clearfix">
    <?php
         the_content();
         if ( ! post_password_required() ) {
           custom_wp_link_pages();
         }
    ?>
   </div>

   <?php endwhile; endif; ?>

  </article>

 </div><!-- END #main_col -->

</div><!-- END #main_contents -->
<?php get_footer(); ?>