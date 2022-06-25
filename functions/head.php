<?php
     function tcd_head() {
       $options = get_design_plus_option();
?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/design-plus.css?ver=<?php echo version_num(); ?>">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/sns-botton.css?ver=<?php echo version_num(); ?>">
<link rel="stylesheet" media="screen and (max-width:1301px)" href="<?php echo get_template_directory_uri(); ?>/css/responsive.css?ver=<?php echo version_num(); ?>">
<link rel="stylesheet" media="screen and (max-width:1301px)" href="<?php echo get_template_directory_uri(); ?>/css/footer-bar.css?ver=<?php echo version_num(); ?>">

<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.easing.1.4.js?ver=<?php echo version_num(); ?>"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jscript.js?ver=<?php echo version_num(); ?>"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.cookie.min.js?ver=<?php echo version_num(); ?>"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/comment.js?ver=<?php echo version_num(); ?>"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/horizon-scroll.js?ver=<?php echo version_num(); ?>"></script>

<?php if(is_mobile()) { ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/footer-bar.js?ver=<?php echo version_num(); ?>"></script>
<?php }; ?>

<script src="<?php echo get_template_directory_uri(); ?>/js/header_fix.js?ver=<?php echo version_num(); ?>"></script>

<?php
     // ヘッダーメッセージ
     if($options['show_header_message']) {
?>
<script type="text/javascript">
jQuery(document).ready(function($){
  if ($.cookie('close_header_message') == 'on') {
    $('#header_message').hide();
  }
  $('#close_header_message').click(function() {
    $('#header_message').hide();
    $.cookie('close_header_message', 'on', {
      path:'/'
    });
  });
});
</script>
<?php }; ?>

<?php /* URLやモバイル等でcssが変わらないものをここで出力 */ ?>
<style type="text/css">
<?php
     // フォントの設定　------------------------------------------------------------------
     $headline_font_size = $options['headline_font_size'] ? $options['headline_font_size'] : '32';
     $headline_font_size_sp = $options['headline_font_size_sp'] ? $options['headline_font_size_sp'] : '22';
     $sub_headline_font_size = $options['sub_headline_font_size'] ? $options['sub_headline_font_size'] : '26';
     $sub_headline_font_size_sp = $options['sub_headline_font_size_sp'] ? $options['sub_headline_font_size_sp'] : '2';

     $headline_font_size_middle = floor($headline_font_size * 0.7);
     $headline_font_size_sp_middle = floor($headline_font_size_sp * 0.7);
?>
body { font-size:<?php echo esc_html($options['content_font_size']); ?>px; }
.common_headline { font-size:<?php echo esc_html($headline_font_size); ?>px !important; }
.common_sub_headline { font-size:<?php echo esc_html($sub_headline_font_size); ?>px !important; }
#archive_header.archive .headline { font-size:<?php echo esc_html($headline_font_size_middle); ?>px !important; }
@media screen and (max-width:1250px) {
  .common_headline { font-size:<?php echo esc_html($headline_font_size_sp); ?>px !important; }
  .common_sub_headline { font-size:<?php echo esc_html($sub_headline_font_size_sp); ?>px !important; }
  #archive_header.archive .headline { font-size:<?php echo esc_html($headline_font_size_sp_middle); ?>px !important; }
}
@media screen and (max-width:750px) {
  body { font-size:<?php echo esc_html($options['content_font_size_sp']); ?>px; }
  #blog_list .bottom_content p, #news_list .desc { font-size:<?php echo esc_html($options['content_font_size_sp'] - 2); ?>px; }
}
<?php
     // 基本のフォントタイプ
     if($options['content_font_type'] == 'type1') {
?>
body, input, textarea { font-family: Arial, "ヒラギノ角ゴ ProN W3", "Hiragino Kaku Gothic ProN", "メイリオ", Meiryo, sans-serif; }
<?php } elseif($options['content_font_type'] == 'type2') { ?>
body, input, textarea { font-family: Arial, "Hiragino Sans", "ヒラギノ角ゴ ProN", "Hiragino Kaku Gothic ProN", "游ゴシック", YuGothic, "メイリオ", Meiryo, sans-serif; }
<?php } else { ?>
body, input, textarea { font-family: "Times New Roman" , "游明朝" , "Yu Mincho" , "游明朝体" , "YuMincho" , "ヒラギノ明朝 Pro W3" , "Hiragino Mincho Pro" , "HiraMinProN-W3" , "HGS明朝E" , "ＭＳ Ｐ明朝" , "MS PMincho" , serif; }
<?php }; ?>

<?php
     // 見出しのフォントタイプ
     if($options['headline_font_type'] == 'type1') {
?>
.rich_font, .p-vertical { font-family: Arial, "ヒラギノ角ゴ ProN W3", "Hiragino Kaku Gothic ProN", "メイリオ", Meiryo, sans-serif; font-weight:600; }
<?php } elseif($options['headline_font_type'] == 'type2') { ?>
.rich_font, .p-vertical { font-family: Arial, "Hiragino Sans", "ヒラギノ角ゴ ProN", "Hiragino Kaku Gothic ProN", "游ゴシック", YuGothic, "メイリオ", Meiryo, sans-serif; font-weight:600; }
<?php } else { ?>
.rich_font, .p-vertical { font-family: "Times New Roman" , "游明朝" , "Yu Mincho" , "游明朝体" , "YuMincho" , "ヒラギノ明朝 Pro W3" , "Hiragino Mincho Pro" , "HiraMinProN-W3" , "HGS明朝E" , "ＭＳ Ｐ明朝" , "MS PMincho" , serif; font-weight:600; }
<?php }; ?>

.rich_font_type1 { font-family: Arial, "ヒラギノ角ゴ ProN W3", "Hiragino Kaku Gothic ProN", "メイリオ", Meiryo, sans-serif; font-weight:600; }
.rich_font_type2 { font-family: Arial, "Hiragino Sans", "ヒラギノ角ゴ ProN", "Hiragino Kaku Gothic ProN", "游ゴシック", YuGothic, "メイリオ", Meiryo, sans-serif; font-weight:600; }
.rich_font_type3 { font-family: "Times New Roman" , "游明朝" , "Yu Mincho" , "游明朝体" , "YuMincho" , "ヒラギノ明朝 Pro W3" , "Hiragino Mincho Pro" , "HiraMinProN-W3" , "HGS明朝E" , "ＭＳ Ｐ明朝" , "MS PMincho" , serif; font-weight:600; }

<?php
     // 小見出しのフォントタイプ
     if($options['sub_headline_font_type'] == 'type1') {
?>
.common_sub_headline { font-family: Arial, "ヒラギノ角ゴ ProN W3", "Hiragino Kaku Gothic ProN", "メイリオ", Meiryo, sans-serif; font-weight:600; }
<?php } elseif($options['sub_headline_font_type'] == 'type2') { ?>
.common_sub_headline { font-family: Arial, "Hiragino Sans", "ヒラギノ角ゴ ProN", "Hiragino Kaku Gothic ProN", "游ゴシック", YuGothic, "メイリオ", Meiryo, sans-serif; font-weight:600; }
<?php } else { ?>
.common_sub_headline { font-family: "Times New Roman" , "游明朝" , "Yu Mincho" , "游明朝体" , "YuMincho" , "ヒラギノ明朝 Pro W3" , "Hiragino Mincho Pro" , "HiraMinProN-W3" , "HGS明朝E" , "ＭＳ Ｐ明朝" , "MS PMincho" , serif; font-weight:600; }
<?php }; ?>

.rich_font_type1 { font-family: Arial, "ヒラギノ角ゴ ProN W3", "Hiragino Kaku Gothic ProN", "メイリオ", Meiryo, sans-serif; font-weight:600; }
.rich_font_type2 { font-family: Arial, "Hiragino Sans", "ヒラギノ角ゴ ProN", "Hiragino Kaku Gothic ProN", "游ゴシック", YuGothic, "メイリオ", Meiryo, sans-serif; font-weight:600; }
.rich_font_type3 { font-family: "Times New Roman" , "游明朝" , "Yu Mincho" , "游明朝体" , "YuMincho" , "ヒラギノ明朝 Pro W3" , "Hiragino Mincho Pro" , "HiraMinProN-W3" , "HGS明朝E" , "ＭＳ Ｐ明朝" , "MS PMincho" , serif; font-weight:600; }

<?php
     // ヘッダー -------------------------------------------------------------------------------

     // ロゴ
?>
#header_logo .logo_text { font-size:<?php echo esc_html($options['header_logo_font_size']); ?>px; }
@media screen and (max-width:1201px) {
  #header_logo .logo_text { font-size:<?php echo esc_html($options['header_logo_font_size_sp']); ?>px; }
}
<?php
     // メッセージ -----------------------------------------------------------------------------------
      if($options['show_header_message'] && $options['header_message']) {
?>
#header_message { background:<?php echo esc_attr($options['header_message_bg_color']); ?>; color:<?php echo esc_attr($options['header_message_font_color']); ?>; }
#close_header_message:before { color:<?php echo esc_attr($options['header_message_font_color']); ?>; }
#header_message a { color:<?php echo esc_attr($options['header_message_link_font_color']); ?>; }
#header_message a:hover { color:<?php echo esc_attr($options['main_color']); ?>; }
<?php
      };

     // サムネイルのホバーアニメーション設定　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
     if($options['hover_type']!="type5"){

       // ズームイン ------------------------------------------------------------------------------
       if($options['hover_type']=="type1"){
?>
.author_profile .avatar_area img, .animate_image img, .animate_background .image {
  width:100%; height:auto; will-change:transform;
  -webkit-transition: transform  0.5s ease;
  transition: transform  0.5s ease;
}
.author_profile a.avatar:hover img, .animate_image:hover img, .animate_background:hover .image {
  -webkit-transform: scale(<?php echo $options['hover1_zoom']; ?>);
  transform: scale(<?php echo $options['hover1_zoom']; ?>);
}

<?php
     // ズームアウト ------------------------------------------------------------------------------
     } if($options['hover_type']=="type2"){
?>
.author_profile .avatar_area img, .animate_image img, .animate_background .image {
  width:100%; height:auto; will-change:transform;
  -webkit-transition: transform  0.5s ease;
  transition: transform  0.5s ease;
  -webkit-transform: scale(<?php echo $options['hover2_zoom']; ?>);
  transform: scale(<?php echo $options['hover2_zoom']; ?>);
}
.author_profile a.avatar:hover img, .animate_image:hover img, .animate_background:hover .image {
  -webkit-transform: scale(1);
  transform: scale(1);
}

<?php
     // スライド ------------------------------------------------------------------------------
     } elseif($options['hover_type']=="type3"){
       $hover3_bgcolor_hex = hex2rgb($options['hover3_bgcolor']);
       $hover3_bgcolor_hex = implode(",",$hover3_bgcolor_hex);
?>
.author_profile .avatar_area:before, .animate_image:before, .animate_background:not(.link):before, .animate_background .image_wrap:before {
  background:rgba(<?php echo esc_attr($hover3_bgcolor_hex); ?>,<?php echo esc_attr($options['hover3_opacity']); ?>); content:''; display:block; position:absolute; top:0; left:0; z-index:10; width:100%; height:100%; opacity:0;
  -webkit-transition: opacity 0.3s ease; transition: opacity 0.3s ease;
}
.author_profile .avatar_area:hover:before, .animate_image:hover:before, .animate_background:not(.link):hover:before, .animate_background:hover .image_wrap:before {
  opacity:1;
}
.animate_image img, .animate_background .image {
  -webkit-width:calc(100% + 30px) !important; width:calc(100% + 30px) !important; height:auto; max-width:inherit !important;
  <?php if($options['hover3_direct']=='type1'): ?>
  -webkit-transform: translate(-15px, 0px); -webkit-transition-property: opacity, translateX; -webkit-transition: 0.5s;
  transform: translate(-15px, 0px); transition-property: opacity, translateX; transition: 0.5s;
  <?php else: ?>
  -webkit-transform: translate(-15px, 0px); -webkit-transition-property: opacity, translateX; -webkit-transition: 0.5s;
  transform: translate(-15px, 0px); transition-property: opacity, translateX; transition: 0.5s;
  <?php endif; ?>
}
.animate_image.avatar_area img {
  width:calc(100% + 10px) !important;
  <?php if($options['hover3_direct']=='type1'): ?>
  -webkit-transform: translate(-5px, 0px); transform: translate(-5px, 0px);
  <?php else: ?>
  -webkit-transform: translate(-5px, 0px); transform: translate(-5px, 0px);
  <?php endif; ?>
}
.animate_image:hover img, .animate_background:hover .image {
  <?php if($options['hover3_direct']=='type1'): ?>
  -webkit-transform: translate(0px, 0px);
  transform: translate(0px, 0px);
  <?php else: ?>
  -webkit-transform: translate(-30px, 0px);
  transform: translate(-30px, 0px);
  <?php endif; ?>
}
<?php
     // フェードアウト ------------------------------------------------------------------------------
     } elseif($options['hover_type']=="type4"){
       $hover3_bgcolor_hex = hex2rgb($options['hover4_bgcolor']);
       $hover3_bgcolor_hex = implode(",",$hover3_bgcolor_hex);
?>
.author_profile .avatar_area:before, .animate_image:before, .animate_background:not(.link):before, .animate_background .image_wrap:before {
  background:rgba(<?php echo esc_attr($hover3_bgcolor_hex); ?>,<?php echo esc_attr($options['hover4_opacity']); ?>); content:''; display:block; position:absolute; top:0; left:0; z-index:10; width:100%; height:100%; opacity:0;
  -webkit-transition: opacity 0.3s ease; transition: opacity 0.3s ease;
}
.author_profile .avatar_area:hover:before, .animate_image:hover:before, .animate_background:not(.link):hover:before, .animate_background:hover .image_wrap:before {
  opacity:1;
}
<?php }; }; // アニメーションここまで ?>

<?php
     // 色関連のスタイル　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
?>
a { color:#000; }

<?php
     // メインカラー ----------------------------------
     $main_color = $options['main_color'];
     $main_color_hex = hex2rgb($main_color);
     $main_color_hex = implode(",",$main_color_hex);

?>
#comment_tab li.active a, .widget_tab_post_list_button div.active, #wp-calendar tbody a, .page_navi span.current, body.post-type-archive-news .page_navi span.current,
  #return_top a, .hscroll-scrollbar-handle, html::-webkit-scrollbar-thumb, #global_menu ul ul a:hover, #p_readmore .button:hover, .c-pw__btn:hover, #comment_tab li a:hover, #submit_comment:hover, #cancel_comment_reply a:hover,
    #wp-calendar #prev a:hover, #wp-calendar #next a:hover, #wp-calendar td a:hover, #comment_tab li a:hover, .tcdw_tag_list_widget ol a:hover, .widget_tag_cloud .tagcloud a:hover, #wp-calendar tbody a:hover, .megamenu_b .category:hover,
      #single_post_title .category:hover, #related_post .category:hover, .page_navi a:hover, body.post-type-archive-news .page_navi a:hover, #blog_list .category:hover, #drawer_menu .menu li.menu-item-has-children > a > .button:hover:after, #drawer_menu .menu li.menu-item-has-children > a > .button:hover:before
{ background-color:<?php echo esc_html($main_color); ?>; }

#single_post_title .category, #related_post .category, #blog_list .category, #post_title .category, .widget_tab_post_list_button div.active, .megamenu_b .category, .page_navi span.current, body.post-type-archive-news .page_navi span.current,
  .page_navi a:hover, body.post-type-archive-news .page_navi a:hover, #post_pagination a:hover, #comment_textarea textarea:focus, .c-pw__box-input:focus, #related_post .category:hover, #blog_list .category:hover, #post_title .category:hover, .megamenu_b .category:hover, #single_post_title .category:hover,
    #related_post .category:hover, #blog_list .category:hover, .tcdw_tag_list_widget ol a:hover, .widget_tag_cloud .tagcloud a:hover
{ border-color:<?php echo esc_html($main_color); ?>; }

#single_post_title .category, #related_post .category, #bread_crumb li.last, #blog_list .category, #post_title .category, #global_menu > ul > li.active > a, #global_menu > ul > li.active_megamenu_button > a, .megamenu_b .category, #global_menu > ul > li.current-menu-item > a,
  #work_single_menu li.active a, .faq_list .title.active, #return_top2 a:hover:before, #header_search_button:hover:before, #header_search .button:hover label:before, #global_menu > ul > li > a:hover, .single_post_nav:hover span:after, #related_post .category:hover, #blog_list .category:hover, #post_title .category:hover,
    #news_list .item a:hover, .widget_tab_post_list_button div:hover, .megamenu_c a:hover, .megamenu_b .owl-carousel .owl-nav button:hover, #drawer_menu .close_button:hover:before, #drawer_menu .menu a:hover, #drawer_menu .menu > ul > li.active > a, #drawer_menu .menu > ul > li.current-menu-item > a, #drawer_menu .menu > li > a > .title:hover,
      #work_image_modal_box .close_button:hover:before, #work_image_modal_box .slick-arrow:hover:before, .faq_list .title:hover, #searchform .submit_button:hover:before, #header_lang_button li a:hover,
a:hover, #mega_category .title a:hover, #mega_category a:hover .name, #header_slider .post_item .title a:hover, #footer_top a:hover, #footer_social_link li a:hover:before, #next_prev_post a:hover,
  .cb_category_post .title a:hover, .cb_trend .post_list.type2 .name:hover, #header_content_post_list .item .title a:hover, #header_content_post_list .item .name:hover,
    .tcdw_search_box_widget .search_area .search_button:hover:before, #single_author_title_area .author_link li a:hover:before, .author_profile a:hover, #post_meta_bottom a:hover, .cardlink_title a:hover,
      .comment a:hover, .comment_form_wrapper a:hover, #mega_menu_mobile_global_menu li a:hover, #tcd_toc.styled .toc_link:hover, .tcd_toc_widget.no_underline .toc_widget_wrap.styled .toc_link:hover, .rank_headline .headline:hover
{ color:<?php echo esc_html($main_color); ?>; }

#drawer_menu .menu ul ul a:hover,  #drawer_menu .menu li > a:hover > span:after, #drawer_menu .menu li.active > a > .button:after, #featured_post a:hover
{ color:<?php echo esc_html($main_color); ?> !important; }

#return_top a:hover { background-color:rgba(<?php echo esc_attr($main_color_hex); ?>,0.5); }

html, #work_single_menu { scrollbar-color:<?php echo esc_html($main_color); ?> rgba(0, 0, 0, 0.1); }

<?php
     // 詳細ページのテキストカラー ----------------------------------
?>
.post_content a, .widget_block a, .textwidget a, #no_post a, #page_404_header .desc a { color:<?php echo esc_html($options['content_link_color']); ?>; }
.post_content a:hover, .widget_block a:hover, .textwidget a:hover, #no_post a:hover, #page_404_header .desc a:hover { color:<?php echo esc_html($options['content_link_hover_color']); ?>; }
<?php
     // ワークスの色 -------------------------------
     global $post;
     $args = array( 'post_type' => 'work', 'posts_per_page' => -1);
     $post_list = new wp_query($args);
     if($post_list->have_posts()):
       while( $post_list->have_posts() ) : $post_list->the_post();
       $accent_color = get_post_meta($post->ID, 'accent_color', true) ?  get_post_meta($post->ID, 'accent_color', true) : '#0b5d7c';
?>
.work_id<?php echo esc_html($post->ID); ?> a:hover { background:<?php echo esc_attr($accent_color); ?>; }
<?php
       if(is_post_type_archive('work')) {
?>
#work_list_id<?php echo esc_html($post->ID); ?> .title:after { background:<?php echo esc_attr($accent_color); ?>; }
<?php
       }
       endwhile;
     endif;
     wp_reset_query();

     // カスタムCSS --------------------------------------------
     if($options['css_code']) {
       echo wp_kses_post($options['css_code']);
     };

     // デザインボタン ----------------------------------------------
     $button_type = $options['design_button_type'];
     $button_shape = $options['design_button_border_radius'];
     $button_size = $options['design_button_size'];
     $button_animation_type = $options['design_button_animation_type'];
     $button_color = $options['design_button_color'];
     $button_color_hover = $options['design_button_color_hover'];
     $colors = array();
     $animations = array();
     if($button_shape == 'flat'){
       $shape = 'border-radius:0px;';
     } elseif($button_shape == 'rounded'){
       $shape = 'border-radius:6px;';
     } else {
       $shape = 'border-radius:70px;';
     }
     if($button_size == 'small'){
       $size = 'min-width:130px; height:40px; line-height:40px;';
     } elseif($button_size == 'medium'){
       $size = 'min-width:270px; height:60px; line-height:60px;';
     } else {
       $size = 'min-width:400px; height:70px; line-height:70px;';
     }
     if($button_type == 'type1'){
       $colors = array('background-color:'.$button_color.';border:none;', 'background-color:'.$button_color_hover.';', '' );
     } elseif($button_type == 'type2'){
       $colors = array('color:'.$button_color.';border-color:'.$button_color.';', 'background-color:'.$button_color_hover.';', 'color:#fff;border-color:'.$button_color_hover.';');
     } else {
       $colors = array('border-color:'.$button_color.';','background-color:'.$button_color.';', 'color:'.$button_color_hover.';border-color:'.$button_color_hover.';' );
     }
     if($button_animation_type == 'animation_type1'){
       $animations = ($button_type != 'type3') ? array('opacity:0;', 'opacity:1;') : array('opacity:1;', 'opacity:0;');
     } elseif($button_animation_type == 'animation_type2'){
       $animations = ($button_type != 'type3') ? array('left:-100%;', 'left:0;') : array('left:0;', 'left:100%;');
     } else {
       $animations = ($button_type != 'type3') ? array('left:calc(-100% - 110px);transform:skewX(45deg); width:calc(100% + 70px);', 'left:-35px;') : array('left:-35px;transform:skewX(45deg); width:calc(100% + 70px);', 'left:calc(100% + 50px);');
     }
?>
.design_button { <?php echo $size.$shape.$colors[0]; ?> }
.design_button:before { <?php echo $colors[1].$animations[0]; ?> }
.design_button:hover { <?php echo $colors[2]; ?> }
.design_button:hover:before { <?php echo $animations[1]; ?> }
<?php
     // クイックタグ --------------------------------------------
    if ( $options['use_quicktags'] ) :

    
    for ( $i = 2; $i <= 5; $i++ ){

    // 見出し
    $heading_font_size = $options['qt_h'.$i.'_font_size'];
    $heading_font_size_sp = $options['qt_h'.$i.'_font_size_sp'];
    $heading_text_align = $options['qt_h'.$i.'_text_align'];
    $heading_font_weight = $options['qt_h'.$i.'_font_weight'];
    $heading_font_color = $options['qt_h'.$i.'_font_color'];
    $heading_bg_color = $options['qt_h'.$i.'_bg_color'];
    $heading_ignore_bg = $options['qt_h'.$i.'_ignore_bg'];
    $heading_border = 'qt_h'.$i.'_border_';
    $heading_border_color = $options['qt_h'.$i.'_border_color'];
    $heading_border_width = $options['qt_h'.$i.'_border_width'];
    $heading_border_style = $options['qt_h'.$i.'_border_style'];

?>
.styled_h<?php echo $i ?> {
  font-size:<?php echo esc_attr($heading_font_size); ?>px!important;
  text-align:<?php echo esc_attr($heading_text_align); ?>!important;
  font-weight:<?php echo esc_attr($heading_font_weight); ?>!important;
  color:<?php echo esc_attr($heading_font_color); ?>;
  border-color:<?php echo esc_attr($heading_border_color); ?>;
  border-width:<?php echo esc_attr($heading_border_width); ?>px;
  border-style:<?php echo esc_attr($heading_border_style); ?>;
<?php

  $border_potition = array('left', 'right', 'top', 'bottom');
  foreach( $border_potition as $position ):

    if($options[$heading_border.$position]){
      if($position == 'left' || $position == 'right'){
        echo 'padding-'.$position.':1em!important;'."\n".'padding-top:0.5em!important;'."\n".'padding-bottom:0.5em!important;'."\n";
      }else{
        echo 'padding-'.$position.':0.8em!important;'."\n";
      }
    }else{
      echo 'border-'.$position.':none;'."\n";
    }

  endforeach;

  if($heading_ignore_bg){
    echo 'background-color:transparent;'."\n";
  }else{
    echo 'background-color:'.esc_attr($heading_bg_color).';'."\n".'padding:0.8em 1em!important;'."\n";
  }

?>
}
@media screen and (max-width:750px) {
  .styled_h<?php echo $i ?> { font-size:<?php echo esc_attr($heading_font_size_sp); ?>px!important; }
}
<?php

    }

    // ボタン
    for ( $i = 1; $i <= 3; $i++ ) {
      $button_type = $options['qt_button'.$i.'_type'];
      $button_shape = $options['qt_button'.$i.'_border_radius'];
      $button_size = $options['qt_button'.$i.'_size'];
      $button_animation_type = $options['qt_button'.$i.'_animation_type'];
      $button_color = $options['qt_button'.$i.'_color'];
      $button_color_hover = $options['qt_button'.$i.'_color_hover'];

      $colors = array();
      $animations = array();

      switch ($button_shape){
        case 'flat': $shape = 'border-radius:0px;'; break;
        case 'rounded': $shape = 'border-radius:6px;'; break;
        case 'oval': $shape = 'border-radius:70px;'; break;
      }
      switch ($button_size){
        case 'small': $size = 'min-width:130px; height:40px;'; break;
        case 'medium': $size = 'min-width:270px; height:60px;'; break;
        case 'large': $size = 'min-width:400px; height:70px;'; break;
      }
      switch ($button_type){
        case 'type1': $colors = array('color:#fff !important; background-color:'.$button_color.';border:none;', 'background-color:'.$button_color_hover.';', '' ); break;
        case 'type2': $colors = array('color:'.$button_color.' !important; border-color:'.$button_color.';', 'background-color:'.$button_color_hover.';', 'color:#fff !important; border-color:'.$button_color_hover.';'); break;
        case 'type3': $colors = array('color:#fff !important; border-color:'.$button_color.';','background-color:'.$button_color.';', 'color:'.$button_color_hover.' !important; border-color:'.$button_color_hover.';' ); break;
      }
      switch ($button_animation_type){
        case 'animation_type1': $animations = ($button_type != 'type3') ? array('opacity:0;', 'opacity:1;') : array('opacity:1;', 'opacity:0;'); break;
        case 'animation_type2': $animations = ($button_type != 'type3') ? array('left:-100%;', 'left:0;') : array('left:0;', 'left:100%;'); break;
        case 'animation_type3': $animations = ($button_type != 'type3') ? array('left:calc(-100% - 110px);transform:skewX(45deg); width:calc(100% + 70px);', 'left:-35px;') : array('left:-35px;transform:skewX(45deg); width:calc(100% + 70px);', 'left:calc(100% + 50px);'); break;
      }

?>
.q_custom_button<?php echo $i; ?> { <?php echo $size.$shape.$colors[0]; ?> }
.q_custom_button<?php echo $i; ?>:before { <?php echo $colors[1].$animations[0]; ?> }
.q_custom_button<?php echo $i; ?>:hover { <?php echo $colors[2]; ?> }
.q_custom_button<?php echo $i; ?>:hover:before { <?php echo $animations[1]; ?> }
<?php

    };


    // アンダーライン
    for ( $i = 1; $i <= 3; $i++ ) {

      $underline_color = $options['qt_underline'.$i.'_border_color'];
      $underline_font_weight = $options['qt_underline'.$i.'_font_weight'];
      $underline_use_animation = $options['qt_underline'.$i.'_use_animation'];

?>
.q_underline<?php echo $i; ?> {
	font-weight:<?php echo esc_attr($underline_font_weight); ?>;
  background-image: -webkit-linear-gradient(left, transparent 50%, <?php echo esc_attr($underline_color); ?> 50%);
  background-image: -moz-linear-gradient(left, transparent 50%, <?php echo esc_attr($underline_color); ?> 50%);
  background-image: linear-gradient(to right, transparent 50%, <?php echo esc_attr($underline_color); ?> 50%);
  <?php if($underline_use_animation == 'no') echo 'background-position:-100% 0.8em;'; ?>
}
<?php

    }

    // 吹き出し
    for ( $i = 1; $i <= 4; $i++ ) {

      $sb_font_color = $options['qt_speech_balloon'.$i.'_font_color'];
      $sb_bg_color = $options['qt_speech_balloon'.$i.'_bg_color'];
      $sb_border_color = $options['qt_speech_balloon'.$i.'_border_color'];
      $sb_direction = ($i >= 3) ? 'left' : 'right';

?>
.speech_balloon<?php echo $i; ?> .speech_balloon_text_inner {
  color:<?php echo esc_attr($sb_font_color); ?>;
  background-color:<?php echo esc_attr($sb_bg_color); ?>;
  border-color:<?php echo esc_attr($sb_border_color); ?>;
}
.speech_balloon<?php echo $i; ?> .before { border-left-color:<?php echo esc_attr($sb_border_color); ?>; }
.speech_balloon<?php echo $i; ?> .after { border-right-color:<?php echo esc_attr($sb_bg_color); ?>; }
<?php

    }


    endif;
    
    // Google map
    $qt_gmap_marker_bg = $options['qt_gmap_marker_bg'];
?>
.qt_google_map .pb_googlemap_custom-overlay-inner { background:<?php echo esc_attr($qt_gmap_marker_bg); ?>; color:<?php echo esc_attr($options['qt_gmap_marker_color']); ?>; }
.qt_google_map .pb_googlemap_custom-overlay-inner::after { border-color:<?php echo esc_attr($qt_gmap_marker_bg); ?> transparent transparent transparent; }
<?php
	// tcd_head_css action
	do_action( 'tcd_head_css' );
?>
</style>

<?php /* URLやモバイル等でcssが変わるものはここで出力 ■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■ */ ?>
<style id="current-page-style" type="text/css">
<?php
     global $post;

     // トップページ -----------------------------------------------------------------------------
     if ( ( is_front_page() && $options['contents_builder']) || ( is_front_page() && $options['mobile_contents_builder']) || (is_page_template('page-about.php') && get_post_meta( $post->ID, 'lp_content', true )) ) {

       // コンテンツビルダー -------------------------------------------------------------------------------------------------------------
       $contents_builder = '';
       if(is_front_page()){
         if(is_mobile() && $options['mobile_index_content_type'] == 'type2') {
           $contents_builder = $options['mobile_contents_builder'];
         } else {
           $contents_builder = $options['contents_builder'];
         }
       } elseif(is_page_template('page-about.php')) {
         $contents_builder = get_post_meta( $post->ID, 'lp_content', true );
       }
       if ($contents_builder) :
         $content_count = 1;
         foreach($contents_builder as $content) :

           // デザインコンテンツ ---------------------------------------------------------
           if ( $content['cb_content_select'] == 'design_content' && $content['show_content'] ) {
             if($content['layout'] == 'type6'){
               if(is_front_page()){
                 if(is_mobile() && ($options['mobile_index_content_type'] == 'type2') ) {
                   $catch_font_size_sp = $content['catch_font_size3'];
                 } else {
                   $catch_font_size_sp = $content['catch_font_size_sp3'];
                 }
               } else {
                 $catch_font_size_sp = $content['catch_font_size_sp3'];
               }
?>
.cb_design_content.num<?php echo $content_count; ?> .catch { font-size:<?php echo esc_html($content['catch_font_size3']); ?>px; }
@media screen and (max-width:1201px) {
  .cb_design_content.num<?php echo $content_count; ?> .catch { font-size:<?php echo esc_html($catch_font_size_sp); ?>px; }
}
<?php
               if($content['show_button3']){
                 $button_type = $content['button_type3'] ? $content['button_type3'] : 'type1';
                 $button_shape = $content['button_border_radius3'] ? $content['button_border_radius3'] : 'oval';
                 $button_size = $content['button_size3'] ? $content['button_size3'] : 'middle';
                 $button_animation_type = $content['button_animation_type3'] ? $content['button_animation_type3'] : 'animation_type1';
                 $button_color = $content['button_color3'] ? $content['button_color3'] : '#00b200';
                 $button_color_hover = $content['button_color_hover3'] ? $content['button_color_hover3'] : '#098700';
                 $colors = array();
                 $animations = array();
                 if($button_shape == 'flat'){
                   $shape = 'border-radius:0px;';
                 } elseif($button_shape == 'rounded'){
                   $shape = 'border-radius:6px;';
                 } else {
                   $shape = 'border-radius:70px;';
                 }
                 if($button_size == 'small'){
                   $size = 'width:130px; height:40px; line-height:40px;';
                 } elseif($button_size == 'medium'){
                   $size = 'width:270px; height:60px; line-height:60px;';
                 } else {
                   $size = 'width:400px; height:70px; line-height:70px;';
                 }
                 if($button_type == 'type1'){
                   $colors = array('color:#fff !important; background-color:'.$button_color.';border:none;', 'background-color:'.$button_color_hover.';', '' );
                 } elseif($button_type == 'type2'){
                   $colors = array('color:'.$button_color.';border-color:'.$button_color.';', 'background-color:'.$button_color_hover.';', 'color:#fff !important; border-color:'.$button_color_hover.';');
                 } else {
                   $colors = array('color:#fff !important; border-color:'.$button_color.';','background-color:'.$button_color.';', 'color:'.$button_color_hover.' !important; border-color:'.$button_color_hover.';' );
                 }
                 if($button_animation_type == 'animation_type1'){
                   $animations = ($button_type != 'type3') ? array('opacity:0;', 'opacity:1;') : array('opacity:1;', 'opacity:0;');
                 } elseif($button_animation_type == 'animation_type2'){
                   $animations = ($button_type != 'type3') ? array('left:-100%;', 'left:0;') : array('left:0;', 'left:100%;');
                 } else {
                   $animations = ($button_type != 'type3') ? array('left:calc(-100% - 110px);transform:skewX(45deg); width:calc(100% + 70px);', 'left:-35px;') : array('left:-35px;transform:skewX(45deg); width:calc(100% + 70px);', 'left:calc(100% + 50px);');
                 }
?>
.cb_design_content.num<?php echo $content_count; ?> .design_button { <?php echo $size.$shape.$colors[0]; ?> }
.cb_design_content.num<?php echo $content_count; ?> .design_button:before { <?php echo $colors[1].$animations[0]; ?> }
.cb_design_content.num<?php echo $content_count; ?> .design_button:hover { <?php echo $colors[2]; ?> }
.cb_design_content.num<?php echo $content_count; ?> .design_button:hover:before { <?php echo $animations[1]; ?> }
<?php
               };
             };

           // 画像スライダー ---------------------------------------------------------
           } elseif ( $content['cb_content_select'] == 'image_slider' && $content['show_content'] ) {
             $data_list = isset($content['item_list']) ?  $content['item_list'] : '';
             if (!empty($data_list)) {
               $slider_item_num = 1;
               foreach ( $data_list as $key => $value ) :
                 if(is_front_page()){
                   if(is_mobile() && ($options['mobile_index_content_type'] == 'type2') ) {
                     $catch_font_size_sp = $value['catch_font_size'];
                   } else {
                     $catch_font_size_sp = $value['catch_font_size_sp'];
                   }
                 } else {
                   $catch_font_size_sp = $value['catch_font_size_sp'];
                 }
?>
.cb_image_slider.num<?php echo $content_count; ?> .item<?php echo $slider_item_num; ?> .catch { font-size:<?php echo esc_attr($value['catch_font_size']); ?>px; }
@media screen and (max-width:1201px) {
  .cb_image_slider.num<?php echo $content_count; ?> .item<?php echo $slider_item_num; ?> .catch { font-size:<?php echo esc_attr($catch_font_size_sp); ?>px; }
}
<?php
                 if($value['show_button']){
                   $button_type = $value['button_type'] ? $value['button_type'] : 'type1';
                   $button_shape = $value['button_border_radius'] ? $value['button_border_radius'] : 'oval';
                   $button_size = $value['button_size'] ? $value['button_size'] : 'middle';
                   $button_animation_type = $value['button_animation_type'] ? $value['button_animation_type'] : 'animation_type1';
                   $button_color = $value['button_color'] ? $value['button_color'] : '#00b200';
                   $button_color_hover = $value['button_color_hover'] ? $value['button_color_hover'] : '#098700';
                   $colors = array();
                   $animations = array();
                   if($button_shape == 'flat'){
                     $shape = 'border-radius:0px;';
                   } elseif($button_shape == 'rounded'){
                     $shape = 'border-radius:6px;';
                   } else {
                     $shape = 'border-radius:70px;';
                   }
                   if($button_size == 'small'){
                     $size = 'min-width:130px; height:40px; line-height:40px;';
                   } elseif($button_size == 'medium'){
                     $size = 'min-width:270px; height:60px; line-height:60px;';
                   } else {
                     $size = 'min-width:400px; height:70px; line-height:70px;';
                   }
                   if($button_type == 'type1'){
                     $colors = array('color:#fff !important; background-color:'.$button_color.';border:none;', 'background-color:'.$button_color_hover.';', '' );
                   } elseif($button_type == 'type2'){
                     $colors = array('color:'.$button_color.';border-color:'.$button_color.';', 'background-color:'.$button_color_hover.';', 'color:#fff !important; border-color:'.$button_color_hover.';');
                   } else {
                     $colors = array('color:#fff !important; border-color:'.$button_color.';','background-color:'.$button_color.';', 'color:'.$button_color_hover.' !important; border-color:'.$button_color_hover.';' );
                   }
                   if($button_animation_type == 'animation_type1'){
                     $animations = ($button_type != 'type3') ? array('opacity:0;', 'opacity:1;') : array('opacity:1;', 'opacity:0;');
                   } elseif($button_animation_type == 'animation_type2'){
                     $animations = ($button_type != 'type3') ? array('left:-100%;', 'left:0;') : array('left:0;', 'left:100%;');
                   } else {
                     $animations = ($button_type != 'type3') ? array('left:calc(-100% - 110px);transform:skewX(45deg); width:calc(100% + 70px);', 'left:-35px;') : array('left:-35px;transform:skewX(45deg); width:calc(100% + 70px);', 'left:calc(100% + 50px);');
                   }
?>
.cb_image_slider.num<?php echo $content_count; ?> .item<?php echo $slider_item_num; ?> .slider_design_button { <?php echo $size.$shape.$colors[0]; ?> }
.cb_image_slider.num<?php echo $content_count; ?> .item<?php echo $slider_item_num; ?> .slider_design_button:before { <?php echo $colors[1].$animations[0]; ?> }
.cb_image_slider.num<?php echo $content_count; ?> .item<?php echo $slider_item_num; ?> .slider_design_button:hover { <?php echo $colors[2]; ?> }
.cb_image_slider.num<?php echo $content_count; ?> .item<?php echo $slider_item_num; ?> .slider_design_button:hover:before { <?php echo $animations[1]; ?> }
<?php
                 };

                 if($value['overlay_opacity'] != 0) {
                   $overlay_color_base = hex2rgb($value['overlay_color']);
                   $overlay_color = implode(",",$overlay_color_base);
?>
.cb_image_slider.num<?php echo $content_count; ?> .item<?php echo $slider_item_num; ?> .overlay { background-color:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($value['overlay_opacity']); ?>); }
<?php
                 };
                 $slider_item_num++;
               endforeach;
             }; // END $data_list

           // フリースペース ---------------------------------------------------------
           } elseif ( $content['cb_content_select'] == 'free_space' && $content['show_content'] ) {
             $padding = $content['padding'] ? $content['padding'] : '0';
             if(is_mobile() && ($options['mobile_index_content_type'] == 'type2') ) {
               $padding_mobile = $padding;
             } else {
               $padding_mobile = $content['padding_mobile'] ? $content['padding_mobile'] : '0';
             }
?>
.cb_free_space.num<?php echo $content_count; ?> { padding:<?php echo esc_attr($padding); ?>px; }
@media screen and (max-width:750px) {
  .cb_free_space.num<?php echo $content_count; ?> { padding:<?php echo esc_attr($padding_mobile); ?>px; }
}
<?php
           };
         $content_count++;
         endforeach;
       endif; // END コンテンツビルダーここまで

     // ワークスアーカイブ -----------------------------------------------------------------------------
     } elseif(is_post_type_archive('work')) {
?>
#work_list .item .title { font-size:<?php echo esc_attr($options['archive_work_title_font_size']); ?>px; }
@media screen and (max-width:1301px) {
  #work_list .item .title { font-size:<?php echo esc_attr($options['archive_work_title_font_size_sp']); ?>px; }
}
<?php
       if($options['archive_work_list_overlay_opacity'] != 0) {
         $overlay_color = hex2rgb($options['archive_work_list_overlay_color']);
         $overlay_opacity = $options['archive_work_list_overlay_opacity'];
         $overlay_color = implode(",",$overlay_color);
?>
#work_list .overlay { background-color:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>); }
<?php
       }; // END overlay

       if($options['archive_work_overlay_opacity'] != 0) {
         $overlay_color = hex2rgb($options['archive_work_overlay_color']);
         $overlay_opacity = $options['archive_work_overlay_opacity'];
         $overlay_color = implode(",",$overlay_color);
?>
#work_archive_header .overlay { background-color:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>); }
<?php
       }; // END overlay

     // ワークス詳細ページ -----------------------------------------------------------------------------
     } elseif(is_singular('work')) {

     // お知らせアーカイブ -----------------------------------------------------------------------------
     } elseif(is_post_type_archive('news')) {
       $title_font_size_middle = round( ($options['archive_news_title_font_size'] + $options['archive_news_title_font_size_sp']) / 2);
       $headline_font_size_middle = round( ($options['headline_font_size'] + $options['headline_font_size_sp']) / 2);
?>
#news_list .title { font-size:<?php echo esc_attr($options['archive_news_title_font_size']); ?>px; }
@media screen and (max-height:900px) {
  #news_list .title { font-size:<?php echo esc_attr($title_font_size_middle); ?>px; }
  .common_headline { font-size:<?php echo esc_html($headline_font_size_middle); ?>px !important; }
}
@media screen and (max-width:750px) {
  #news_list .title { font-size:<?php echo esc_attr($options['archive_news_title_font_size_sp']); ?>px; }
  @media screen and (max-height:900px) {
    .common_headline { font-size:<?php echo esc_html($options['headline_font_size_sp']); ?>px !important; }
  }
}
<?php
       if($options['archive_news_overlay_opacity'] != 0) {
         $overlay_color = hex2rgb($options['archive_news_overlay_color']);
         $overlay_opacity = $options['archive_news_overlay_opacity'];
         $overlay_color = implode(",",$overlay_color);
?>
#news_archive_overlay { background-color:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>); }
<?php
       }; // END overlay

     // お知らせ詳細ページ -----------------------------------------------------------------------------
     } elseif(is_singular('news')) {
?>
#single_post_title .title { font-size:<?php echo esc_attr($options['single_title_font_size']); ?>px; }
@media screen and (max-width:750px) {
  #single_post_title .title { font-size:<?php echo esc_attr($options['single_title_font_size_sp']); ?>px; }
}
<?php
     // ブログアーカイブ -----------------------------------------------------------------------------
     } elseif(is_archive() || is_home() || is_search()) {
       $title_font_size_middle = round( ($options['archive_blog_title_font_size'] + $options['archive_blog_title_font_size_sp']) / 2);
       $headline_font_size_middle = round( ($options['headline_font_size'] + $options['headline_font_size_sp']) / 2);
?>
#blog_list .title { font-size:<?php echo esc_attr($options['archive_blog_title_font_size']); ?>px; }
@media screen and (max-height:900px) {
  #blog_list .title { font-size:<?php echo esc_attr($title_font_size_middle); ?>px; }
  .common_headline { font-size:<?php echo esc_html($headline_font_size_middle); ?>px !important; }
}
@media screen and (max-width:750px) {
  #blog_list .title { font-size:<?php echo esc_attr($options['archive_blog_title_font_size_sp']); ?>px; }
  @media screen and (max-height:900px) {
    .common_headline { font-size:<?php echo esc_html($options['headline_font_size_sp']); ?>px !important; }
  }
}
<?php
     // ブログ詳細ページ -----------------------------------------------------------------------------
     } elseif(is_single()){
?>
#single_post_title .title { font-size:<?php echo esc_attr($options['single_title_font_size']); ?>px; }
@media screen and (max-width:750px) {
  #single_post_title .title { font-size:<?php echo esc_attr($options['single_title_font_size_sp']); ?>px; }
}
<?php
     // 固定ページ --------------------------------------------------------------------
     } elseif(is_page() && !is_page_template('page-about.php') && !is_front_page()) {

       global $post;

       $page_header_catch_font_size = get_post_meta($post->ID, 'page_header_catch_font_size', true) ?  get_post_meta($post->ID, 'page_header_catch_font_size', true) : '32';
       $page_header_catch_font_size_sp = get_post_meta($post->ID, 'page_header_catch_font_size_sp', true) ?  get_post_meta($post->ID, 'page_header_catch_font_size_sp', true) : '22';
       $page_header_catch_font_size_middle = floor(($page_header_catch_font_size + $page_header_catch_font_size_sp) / 2);

       $page_bg_color = get_post_meta($post->ID, 'page_bg_color', true) ?  get_post_meta($post->ID, 'page_bg_color', true) : '#f6f7f8';

       $page_content_font_size = get_post_meta($post->ID, 'page_content_font_size', true) ?  get_post_meta($post->ID, 'page_content_font_size', true) : '16';
       $page_content_font_size_sp = get_post_meta($post->ID, 'page_content_font_size_sp', true) ?  get_post_meta($post->ID, 'page_content_font_size_sp', true) : '14';
?>
body { font-size:<?php echo esc_html($page_content_font_size); ?>px; }
#main_contents, #main_col, #bread_crumb { background:<?php echo esc_html($page_bg_color); ?>; }
#page_header .catch { font-size:<?php echo esc_html($page_header_catch_font_size); ?>px; }
@media screen and (max-width:1050px) {
  #page_header .catch { font-size:<?php echo esc_html($page_header_catch_font_size_middle); ?>px; }
}
@media screen and (max-width:750px) {
  body { font-size:<?php echo esc_html($page_content_font_size_sp); ?>px; }
  #page_header .catch { font-size:<?php echo esc_html($page_header_catch_font_size_sp); ?>px; }
}
<?php
       if(get_post_meta($post->ID, 'page_header_overlay_opacity', true) != 0) {
         $overlay_color = get_post_meta($post->ID, 'page_header_overlay_color', true) ?  get_post_meta($post->ID, 'page_header_overlay_color', true) : '#000000';
         $overlay_color = hex2rgb($overlay_color);
         $overlay_color = implode(",",$overlay_color);
         $overlay_opacity = get_post_meta($post->ID, 'page_header_overlay_opacity', true) ?  get_post_meta($post->ID, 'page_header_overlay_opacity', true) : '0.3';
?>
#page_header .overlay { background-color:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>); }
<?php
       }; // END overlay

     // 404ページ -----------------------------------------------------------------------------
     } elseif( is_404()) {

       if($options['page_404_overlay_opacity'] != 0) {
         $overlay_color = hex2rgb($options['page_404_overlay_color']);
         $overlay_opacity = $options['page_404_overlay_opacity'];
         $overlay_color = implode(",",$overlay_color);
?>
#page_404_header .overlay { background-color:rgba(<?php echo esc_attr($overlay_color); ?>,<?php echo esc_attr($overlay_opacity); ?>); }
<?php
       }; // END overlay

     }; //END page setting

     // カスタムCSS --------------------------------------------
     if(is_single() || is_page()) {
       global $post;
       $custom_css = get_post_meta($post->ID, 'custom_css', true);
       if($custom_css) {
         echo $custom_css;
       };
     }

     // ロード画面 -----------------------------------------
     if(
       $options['show_loading'] && is_front_page() && $options['loading_display_page'] == 'type1' && $options['loading_display_time'] == 'type1' && !isset($_COOKIE['first_visit']) ||
       $options['show_loading'] && is_front_page() && $options['loading_display_page'] == 'type1' && $options['loading_display_time'] == 'type2' ||
       $options['show_loading'] && $options['loading_display_page'] == 'type2' && $options['loading_display_time'] == 'type1' && !isset($_COOKIE['first_visit']) ||
       $options['show_loading'] && $options['loading_display_page'] == 'type2' && $options['loading_display_time'] == 'type2'
     ){
       get_template_part('functions/loader_css');
       if($options['loading_type'] == 'type5'){
         $loading_catch_font_size_middle = ($options['loading_catch_font_size'] + $options['loading_catch_font_size_sp']) / 2;
?>
#site_loader_logo_inner .catch { font-size:<?php echo esc_html($options['loading_catch_font_size']); ?>px; color:<?php echo esc_html($options['loading_catch_font_color']); ?>; }
@media screen and (max-width:1100px) {
  #site_loader_logo_inner .catch { font-size:<?php echo esc_attr(ceil($load_type5_catch_font_size_middle)); ?>px; }
}
@media screen and (max-width:750px) {
  #site_loader_logo_inner .catch { font-size:<?php echo esc_html($options['loading_catch_font_size_sp']); ?>px; }
}
<?php
       };
     };

     //フッターバー --------------------------------------------
     if(is_mobile()) {
       if($options['footer_bar_type'] == 'type1' && $options['footer_bar_display'] != 'type3'){
         $footer_bar_border_color = hex2rgb($options['footer_bar_border_color']);
         $footer_bar_border_color = implode(",",$footer_bar_border_color);
?>
#dp-footer-bar { background:<?php echo esc_attr($options['footer_bar_bg_color']); ?>; color:<?php echo esc_html($options['footer_bar_font_color']); ?>; }
.dp-footer-bar-item a { border-color:rgba(<?php echo esc_attr($footer_bar_border_color); ?>,<?php echo esc_html($options['footer_bar_border_color_opacity']); ?>); color:<?php echo esc_html($options['footer_bar_font_color']); ?>; }
.dp-footer-bar-item a:hover { border-color:<?php echo esc_html($options['footer_bar_bg_color_hover']); ?>; background:<?php echo esc_html($options['footer_bar_bg_color_hover']); ?>; }
<?php
       } elseif($options['footer_bar_type'] == 'type2' && $options['footer_bar_display'] != 'type3'){
         for($i = 1; $i <= 2; $i++) {
           if($options['show_footer_button'.$i]) {
             $footer_button_bg_color_hover = $options['footer_button_bg_color_hover'.$i];
?>
#dp-footer-bar a.footer_button.num<?php echo $i; ?> { font-size:<?php echo esc_attr($options['footer_button_font_size']); ?>px; color:<?php echo esc_attr($options['footer_button_font_color'.$i]); ?>; background:<?php echo esc_attr($options['footer_button_bg_color'.$i]); ?>; }
#dp-footer-bar a.footer_button.num<?php echo $i; ?>:hover { background:<?php echo esc_attr($footer_button_bg_color_hover); ?>; }
<?php
           }
         };
       };
     };
?>
<?php
	// tcd_head_css_current_page action
	do_action( 'tcd_head_css_current_page' );
?>
</style>

<?php
     // JavaScriptの設定はここから　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■

     // トップページ、アバウトページ
     global $post;

     // コンテンツビルダー
     if ( (is_front_page() && $options['contents_builder']) || (is_front_page() && $options['mobile_contents_builder']) || (is_page_template('page-about.php') && get_post_meta($post->ID, 'lp_content', true)) ) {
       $contents_builder = '';
       if(is_front_page()){
         if(is_mobile() && $options['mobile_index_content_type'] == 'type2') {
           $contents_builder = $options['mobile_contents_builder'];
         } else {
           $contents_builder = $options['contents_builder'];
         }
       } elseif(is_page_template('page-about.php')) {
         $contents_builder = get_post_meta( $post->ID, 'lp_content', true );
       };
       if ($contents_builder) :
?>
<script type="text/javascript">
jQuery(document).ready(function($){
<?php
         foreach($contents_builder as $content) :
           // 画像スライダー --------------------------------------------------------------------------------
           if ( $content['cb_content_select'] == 'image_slider' && $content['show_content'] ) {
             if ( empty( $cb_image_slider_first_js_rendered ) ) {
               $cb_image_slider_first_js_rendered = true;
               wp_enqueue_style('slick-style', get_template_directory_uri() . '/js/slick.css', '', '1.0.0');
               wp_enqueue_script('slick-script', get_template_directory_uri() . '/js/slick.min.js', '', '1.0.0', true);
?>
  var winH = $(window).innerHeight();
  if (window.matchMedia('(max-width: 1024px)').matches) {
    $('.cb_image_slider .cb_slider_wrap').css('height', winH - 60);
  } else {
    $('.cb_image_slider .cb_slider_wrap').css('height', '100%');
  }
  $(window).on('resize', function(){
    var winH = $(window).innerHeight();
    if (window.matchMedia('(max-width: 1024px)').matches) {
      $('.cb_image_slider .cb_slider_wrap').css('height', winH - 60);
    } else {
      $('.cb_image_slider .cb_slider_wrap').css('height', '100%');
    }
  });

  var slider_wrap = $('.cb_slider');
  slider_wrap.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
    if (currentSlide == nextSlide) return;
    slick.$slides.eq(nextSlide).addClass('animate');
    setTimeout(function(){
      slick.$slides.eq(nextSlide).find(".animate_item").each(function(i){
        $(this).delay(i *700).queue(function(next) {
          $(this).addClass('animate');
          next();
        });
      });
    }, 1000);
    slick.$slides.eq(currentSlide).addClass('end_animate');
  });
  slider_wrap.on('afterChange', function(event, slick, currentSlide) {
    slick.$slides.not(':eq(' + currentSlide + ')').removeClass('animate end_animate first_item');
    slick.$slides.not(':eq(' + currentSlide + ')').find(".animate_item").removeClass('animate');
  });
  slider_wrap.on('swipe', function(event, slick, direction){
    slider_wrap.slick('setPosition');
  });

  slider_wrap.slick({
    slide: '.item',
    infinite: true,
    dots: true,
    arrows: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    swipe: true,
    pauseOnFocus: false,
    pauseOnHover: false,
    autoplay: true,
    fade: true,
    autoplaySpeed:7000,
    speed:2000,
    easing: 'easeOutExpo',
  });

  <?php // アイテムが止まるまで待つ ?>
  $('.cb_image_slider .slick-dots').on('click', function() {
    $(this).addClass('no_click');
    setTimeout(function(){
      $('.cb_image_slider .slick-dots').removeClass('no_click');
    }, 2400);
  });

  <?php
       // ニュースティッカー
       if($content['show_news_ticker']){
  ?>
  var news_ticker_wrap = $('.cb_news_ticker .post_list');
  news_ticker_wrap.slick({
    infinite: true,
    dots: false,
    arrows: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    swipe: false,
    adaptiveHeight: false,
    pauseOnHover: true,
    autoplay: true,
    fade: false,
    vertical: true,
    easing: 'easeOutExpo',
    speed: 700,
    autoplaySpeed: 5000
  });
  <?php }; ?>

  <?php
       // ロード画面がある場合
       if(
         $options['show_loading'] && is_front_page() && $options['loading_display_page'] == 'type1' && $options['loading_display_time'] == 'type1' && !isset($_COOKIE['first_visit']) ||
         $options['show_loading'] && is_front_page() && $options['loading_display_page'] == 'type1' && $options['loading_display_time'] == 'type2' ||
         $options['show_loading'] && $options['loading_display_page'] == 'type2' && $options['loading_display_time'] == 'type1' && !isset($_COOKIE['first_visit']) ||
         $options['show_loading'] && $options['loading_display_page'] == 'type2' && $options['loading_display_time'] == 'type2'
       ){
  ?>
  slider_wrap.slick('slickPause');
  <?php if($content['show_news_ticker']){ ?>
  news_ticker_wrap.slick('slickPause');
  <?php }; ?>
  <?php } else { ?>
  $('.cb_slider .first_item').addClass('animate');
  setTimeout(function(){
    $('.cb_slider .first_item .animate_item').each(function(i){
      $(this).delay(i *700).queue(function(next) {
        $(this).addClass('animate');
        next();
      });
    });
  }, 500);
  <?php }; ?>

<?php
             };
           };
         endforeach;
?>

  if ($('.youtube_bg').length) {
    var ytPlayer
    if (!$('script[src="//www.youtube.com/iframe_api"]').length) {
      var tag = document.createElement('script');
      tag.src = 'https://www.youtube.com/iframe_api';
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    }

    // YouTube IFrame Player API Ready
    window.onYouTubeIframeAPIReady = function(){
      $('.youtube_bg iframe').each(function(i){
        if (!this.id) {
          this.id = 'youtube-' + i + Math.floor(Math.random() * 10000); 
        }
        var player = new YT.Player(this.id, {
          events: {
            onReady: function(e) {
              e.target.mute();
              e.target.playVideo();
            }
          }
        });
      });
    }

    function youtube_resize(){
      $(".youtube_bg").removeAttr('style').each(function () {
        var content_height = $(this).innerHeight();
        var content_width = $(this).innerWidth();
        var youtube_height = content_width*(9/16);
        var youtube_width = content_height*(16/9);
        if(content_width > youtube_width) {
          $(this).find('.youtube_wrap').addClass('type1');
          $(this).find('.youtube_wrap').removeClass('type2');
          $(this).find('.youtube_wrap').css({'width': '100%', 'height': youtube_height});
        } else {
          $(this).find('.youtube_wrap').removeClass('type1');
          $(this).find('.youtube_wrap').addClass('type2');
          $(this).find('.youtube_wrap').css({'width':youtube_width, 'height':content_height });
        }
      });
    }
    youtube_resize();
    $(window).on('resize', youtube_resize);
  }

});
</script>
<?php
       endif; // END コンテンツビルダー
     }; // END front page

     // メガメニュー --------------------
?>
<script type="text/javascript">
jQuery(function($){
  if ($('.megamenu_b .slider').length){
    $('.megamenu_b .slider').owlCarousel({
      autoplay: true,
      autoplayHoverPause: true,
      autoplayTimeout: 5000,
      autoplaySpeed: 700,
      dots: false,
      margin: 40,
      items: 3,
      loop: true,
      nav: true,
      navText: ['&#xe90f', '&#xe910']
    });
  }
});
</script>
<?php
     // ワークス詳細ページ ----------------------------------------------------------
     if( is_singular('work') ) {
       global $post;
       $gallery_layout = get_post_meta($post->ID, 'gallery_layout', true) ?  get_post_meta($post->ID, 'gallery_layout', true) : 'type1';
       wp_enqueue_style('slick-style', get_template_directory_uri() . '/js/slick.css', '', '1.0.0');
       wp_enqueue_script('slick-script', get_template_directory_uri() . '/js/slick.min.js', '', '1.0.0', true);
?>
<script type="text/javascript">
jQuery(document).ready(function($){

  var image_list = $('#work_image_modal_box .image_list');
  image_list.slick({
    initialSlide: 0,
    infinite: true,
    dots: false,
    arrows: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    swipe: true,
    adaptiveHeight: false,
    autoplay: false,
  });
  image_list.on('beforeChange', function(event, slick, currentSlide, nextSlide) {
    if (currentSlide == nextSlide) return;
    slick.$slides.eq(nextSlide).addClass('animate');
  });
  image_list.on('afterChange', function(event, slick, currentSlide) {
    slick.$slides.not(':eq(' + currentSlide + ')').removeClass('animate');
  });
  image_list.on('init', function(event, slick){
    $('#work_image_modal_box .slick-current').addClass('animate');
  });

  $(".modal_button").on('click',function() {
    $('html').addClass('open_modal');
    var item_num = $(this).data('item-num');
    image_list.slick('unslick');
    image_list.slick({
      initialSlide: item_num,
    });
    return false;
  });

  $("#work_image_modal_box .close_button").on('click',function() {
    $('html').removeClass('open_modal');
    $('#work_image_modal_box .item').removeClass('animate');
    return false;
  });

<?php if($gallery_layout == 'type2'){ ?>
  function size_fix(){
    var winH = $(window).innerHeight();
    var content_width = Math.round((winH * 483.3333) / 1200);
    $('.width_fix').css('width', content_width);

    var item_height = Math.round( ($('#work_gallery_type2 .item').innerHeight()) );
    $("#work_gallery_type2 .image").each(function () {
      var image_width = $(this).data('width');
      var image_height = $(this).data('height');
      var image_width = Math.round( ((item_height) * image_width) / image_height );
      $(this).closest('.item').css({'width' : image_width, 'height' : item_height});
    });
  }
  size_fix();
  $(window).on('resize', function(){
    size_fix();
  });
<?php }; ?>

});
</script>
<?php
     };

     // ブログ詳細ページ ----------------------------------------------------------
     if( (is_single() && $options['show_related_post']) || (is_singular('news') && $options['show_recent_news']) ) {
?>
<script type="text/javascript">
jQuery(document).ready(function($){
  $('#related_post .post_list').owlCarousel({
    autoplay: true,
    autoplayHoverPause: true,
    autoplayTimeout: 5000,
    autoplaySpeed: 700,
    autoWidth: false,
    center: false,
    dots: false,
    touchDrag: true,
    mouseDrag: true,
    nav: false,
    loop: true,
    margin: 70,
    center: true,
    autoWidth: true,
    responsive : {
      0 : { items: 3, margin: 20 },
      1024 : { items: 4, margin: 40 },
      1301 : { items: 3, margin: 70 },
    },
  });
});
</script>
<?php
     };

     // 固定ページ ----------------------------------------------------------
     if(is_page() && !is_page_template('page-about.php')) {
       global $post;
       $hide_page_header = get_post_meta($post->ID, 'hide_page_header', true) ?  get_post_meta($post->ID, 'hide_page_header', true) : 'no';
       if($hide_page_header != 'yes'){
         // 全画面ヘッダー
         $page_header_type = get_post_meta($post->ID, 'page_header_type', true) ?  get_post_meta($post->ID, 'page_header_type', true) : 'type1';
         $hide_page_header_bar = get_post_meta($post->ID, 'hide_page_header_bar', true) ?  get_post_meta($post->ID, 'hide_page_header_bar', true) : 'no';
         if($page_header_type == 'type3'){
?>
<script type="text/javascript">
jQuery(document).ready(function($){

  function page_full_header_height(){
    var winH = $(window).innerHeight();
<?php if($hide_page_header_bar == 'yes'){ ?>
    var header_height = '0';
<?php } else { ?>
    var header_height = $("#header").innerHeight();
<?php }; ?>
    $('#page_header.full_height').css('height', winH - header_height);
    $("#page_contents_link").off('click');
    $("#page_contents_link").on('click',function() {
      var myHref= $(this).attr("href");
      var myPos = $(myHref).offset().top - header_height;
      $("html,body").animate({scrollTop : myPos}, 1000, 'easeOutExpo');
      return false;
    });
  }
  page_full_header_height();
  $(window).on('resize', function(){
    page_full_header_height();
  });

});
</script>
<?php
         };
       };
     };

     // お知らせアーカイブ ----------------------------------------------------------
     if(is_post_type_archive('test')) {
?>
<script type="text/javascript">
jQuery(document).ready(function($){

  function page_full_header_height(){
    var winH = $(window).innerHeight();
    var header_height = $("#header").innerHeight();
    $('#news_archive_bg_image').css('height', winH - header_height);
    $('#news_archive_overlay').css('height', winH - header_height);
  }
  page_full_header_height();
  $(window).on('resize', function(){
    page_full_header_height();
  });

});
</script>
<?php
     };

     // 404 --------------------------------------------
     if(is_404()) {
?>
<script type="text/javascript">
jQuery(document).ready(function($){
  $('#page_404_header').addClass('animate');
  function page_full_header_height(){
    var winH = $(window).innerHeight();
    var header_height = $("#header").innerHeight();
    var copyright_height = $("#copyright").innerHeight();
    $('#page_404_header').css('height', winH - header_height - copyright_height);
  }
  page_full_header_height();
  $(window).on('resize', function(){
    page_full_header_height();
  });

});
</script>
<?php
     };

     // ヘッダーメッセージ
     if($options['show_header_message']) {
?>
<script type="text/javascript">
jQuery(document).ready(function($){
  function adjust_header_position(){
    var winH = $(window).innerHeight();
    var header_message_height = $("#header_message").innerHeight();
    $('#header').css('top', header_message_height);
    if(winH > 1000){
      $('body').css('padding-top', header_message_height + 100);
    } else {
      $('body').css('padding-top', header_message_height + 70);
    }
  }
  adjust_header_position();
  $(window).on('resize', function(){
    adjust_header_position();
  });
});
</script>
<?php
     };

     // カスタムスクリプト--------------------------------------------
     if($options['script_code']) {
       echo $options['script_code'];
     };
     if(is_single() || is_page()) {
       global $post;
       $custom_script = get_post_meta($post->ID, 'custom_script', true);
       if($custom_script) {
         echo $custom_script;
       };
     };
?>

<?php
     }; // END function tcd_head()
     add_action("wp_head", "tcd_head");

// スライダースクリプトのキューイング
function tcd_enqueue_slider_scripts() {

  wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array( 'jquery' ), '2.3.4', true );
  wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.css', array(), '2.3.4' );

}
add_action( 'wp_enqueue_scripts', 'tcd_enqueue_slider_scripts' );
?>