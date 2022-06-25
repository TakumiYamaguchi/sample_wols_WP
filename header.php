<?php $options = get_design_plus_option(); ?>
<!DOCTYPE html>
<html class="pc<?php if( (is_single() && !is_singular('work')) || (is_page() && !is_page_template('page-about.php') && !is_front_page()) || is_404() ){ echo ' show_scroll_y'; } else { echo ' hide_scroll_y'; }; ?>" <?php language_attributes(); ?>>
<?php if($options['use_ogp']) { ?>
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#">
<?php } else { ?>
<head>
<?php }; ?>
<meta charset="<?php bloginfo('charset'); ?>">
<!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge"><![endif]-->
<meta name="viewport" content="width=device-width">
<title><?php wp_title('|', true, 'right'); ?></title>
<meta name="description" content="<?php seo_description(); ?>">
<?php if(is_attachment() && (get_option( 'blog_public' ) != 0)) { ?>
<meta name='robots' content='noindex, nofollow' />
<?php }; ?>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<?php wp_enqueue_style('style', get_stylesheet_uri(), false, version_num(), 'all'); wp_enqueue_script( 'jquery' ); if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
</head>
<body id="body" <?php body_class(); ?>>

<?php
     // ロードアイコン --------------------------------------------------------------------
     if(
       $options['show_loading'] && is_front_page() && $options['loading_display_page'] == 'type1' && $options['loading_display_time'] == 'type1' && !isset($_COOKIE['first_visit']) ||
       $options['show_loading'] && is_front_page() && $options['loading_display_page'] == 'type1' && $options['loading_display_time'] == 'type2' ||
       $options['show_loading'] && $options['loading_display_page'] == 'type2' && $options['loading_display_time'] == 'type1' && !isset($_COOKIE['first_visit']) ||
       $options['show_loading'] && $options['loading_display_page'] == 'type2' && $options['loading_display_time'] == 'type2'
     ){
       load_icon();
     };

     // メッセージ --------------------------------------------------------------------
     if($options['show_header_message']) {
       $message = $options['header_message'];
       $url = $options['header_message_url'];
       $font_color = $options['header_message_font_color'];
       $bg_color = $options['header_message_bg_color'];
?>
<div id="header_message" style="color:<?php esc_attr_e($font_color); ?>;background-color:<?php esc_attr_e($bg_color); ?>;">
  <?php if($url){ ?>
  <a href="<?php echo esc_url($url); ?>" class="label"><?php echo wp_kses_post(nl2br($message)); ?></a>
  <?php }else{ ?>
  <p class="label"><?php echo wp_kses_post(nl2br($message)); ?></p>
  <?php } ?>
</div>
<?php }; ?>

<?php
     // ヘッダー ----------------------------------------------------------------------
     if( is_page() && (get_post_meta($post->ID, 'hide_page_header_bar', true) == 'yes') ) { } else {
?>
<header id="header" class="page_header_animate_item">
 <div id="header_logo">
  <?php header_logo(); ?>
 </div>
 <?php
      // グローバルメニュー ----------------------------------------------------------------
      if ( has_nav_menu('global-menu') ) {
 ?>
 <a id="drawer_menu_button" href="#"><span></span><span></span><span></span></a>
 <nav id="global_menu">
  <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'global-menu' , 'container' => '' ) ); ?>
 </nav>
 <?php }; ?>
 <?php
      // 検索フォーム --------------------------------------------------------------------
      if( $options['show_header_search'] == 'display') {
 ?>
 <div id="header_search">
  <div id="header_search_button"></div>
  <form role="search" method="get" id="header_searchform" action="<?php echo esc_url(home_url()); ?>">
   <div class="input_area"><input type="text" value="" id="header_search_input" name="s" autocomplete="off"></div>
   <div class="button"><label for="header_search_button"></label><input type="submit" id="header_search_button" value=""></div>
  </form>
 </div>
 <?php }; ?>
 <?php
      // 言語ボタン ------------------------------------
      if($options['show_lang_button'] && $options['lang_button']) {
 ?>
 <ul id="header_lang_button">
  <?php foreach ( $options['lang_button'] as $key => $value ) : ?>
  <li<?php if($value['active_button']){ echo ' class="active"'; }; ?>><a href="<?php if($value['url']) { echo esc_url($value['url']); }; ?>" target="_blank"><?php if($value['name']) { echo esc_html($value['name']); }; ?></a></li>
  <?php endforeach; ?>
 </ul>
 <?php }; ?>
 <?php get_template_part( 'template-parts/megamenu' ); ?>
</header>
<?php }; ?>

<div id="container">
