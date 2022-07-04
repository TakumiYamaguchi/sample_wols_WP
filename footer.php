<?php $options = get_design_plus_option(); ?>

<?php
      if(is_page()){ 
        $page_hide_footer = get_post_meta($post->ID, 'page_hide_footer', true) ?  get_post_meta($post->ID, 'page_hide_footer', true) : 'no';
      } else {
        $page_hide_footer = 'no';
      }

      if($page_hide_footer != 'yes'){
 ?>

<footer id="footer">
    <div id="return_top2">
        <a href="#body"><span>TOP</span></a>
    </div>
    <div id="copyright">
        <?php
        // SNS�{�^�� ------------------------------------
        if($options['show_sns_footer'] == 'display') {
          $facebook = $options['sns_button_facebook_url'];
          $twitter = $options['sns_button_twitter_url'];
          $insta = $options['sns_button_instagram_url'];
          $pinterest = $options['sns_button_pinterest_url'];
          $youtube = $options['sns_button_youtube_url'];
          $contact = $options['sns_button_contact_url'];
          $show_rss = $options['sns_button_show_rss'];
   ?>
        <ul id="footer_sns"
            class="sns_button_list clearfix color_<?php echo esc_attr($options['sns_button_color_type']); ?>">
            <?php if($insta) { ?><li class="insta"><a href="<?php echo esc_url($insta); ?>" rel="nofollow noopener"
                    target="_blank" title="Instagram"><span>Instagram</span></a></li><?php }; ?>
            <?php if($twitter) { ?><li class="twitter"><a href="<?php echo esc_url($twitter); ?>"
                    rel="nofollow noopener" target="_blank" title="Twitter"><span>Twitter</span></a></li><?php }; ?>
            <?php if($facebook) { ?><li class="facebook"><a href="<?php echo esc_url($facebook); ?>"
                    rel="nofollow noopener" target="_blank" title="Facebook"><span>Facebook</span></a></li><?php }; ?>
            <?php if($pinterest) { ?><li class="pinterest"><a href="<?php echo esc_url($pinterest); ?>"
                    rel="nofollow noopener" target="_blank" title="Pinterest"><span>Pinterest</span></a></li><?php }; ?>
            <?php if($youtube) { ?><li class="youtube"><a href="<?php echo esc_url($youtube); ?>"
                    rel="nofollow noopener" target="_blank" title="Youtube"><span>Youtube</span></a></li><?php }; ?>
            <?php if($contact) { ?><li class="contact"><a href="<?php echo esc_url($contact); ?>"
                    rel="nofollow noopener" target="_blank" title="Contact"><span>Contact</span></a></li><?php }; ?>
            <?php if($show_rss) { ?><li class="rss"><a href="<?php esc_url(bloginfo('rss2_url')); ?>"
                    rel="nofollow noopener" target="_blank" title="RSS"><span>RSS</span></a></li><?php }; ?>
        </ul>
        <?php }; ?>
        <p><?php echo wp_kses_post($options['copyright']); ?></p>
    </div>
</footer>

<?php
      }; // hide footer
 ?>

</div><!-- #container -->

<div id="return_top">
    <a href="#body"><span>TOP</span></a>
</div>

<?php
     // ���m�点�A�[�J�C�u -----------------------------------------
     if(is_post_type_archive('news')) {
       $bg_image = wp_get_attachment_image_src( $options['archive_news_bg_image'], 'full' );
       if($options['archive_news_overlay_opacity'] != 0) {
?>
<div id="news_archive_overlay"></div>
<?php
       };
       if($bg_image){
?>
<div id="news_archive_bg_image"
    style="background:url(<?php echo esc_attr($bg_image[0]); ?>) no-repeat center center; background-size:cover;"></div>
<?php
       };
     };
?>

<?php
     // ���[�N�X�ڍ׃y�[�W�p���[�_�� -------------------------------
     if(is_singular('work')){
       global $post;
       $gallery_layout = get_post_meta($post->ID, 'gallery_layout', true) ?  get_post_meta($post->ID, 'gallery_layout', true) : 'type1';
       $accent_color = get_post_meta($post->ID, 'accent_color', true) ?  get_post_meta($post->ID, 'accent_color', true) : '#0b5d7c';

       if($gallery_layout == 'type1'){

         $work_content = get_post_meta( $post->ID, 'work_content', true );
         if ( $work_content && is_array( $work_content ) ) :
?>
<div id="work_image_modal_box">
    <div class="close_button"></div>
    <h3 class="title" style="color:<?php echo esc_attr($accent_color); ?>;"><?php the_title(); ?></h3>
    <div class="image_list">
        <?php
           foreach( $work_content as $key => $content ) :
             if ( $content['cb_content_select'] == 'layout1' ) {
               for ( $i = 1; $i <= 6; $i++ ) :
                 $image = isset( $content['image'.$i] ) ? wp_get_attachment_image_src($content['image'.$i], 'full') : '';
                 $caption = wp_get_attachment_caption($content['image'.$i]);
                 if($image){
  ?>
        <div class="item">
            <div class="image"
                style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center; background-size:contain;">
            </div>
            <?php if($caption){ echo '<p class="caption">' . esc_html($caption) . '</p>'; }; ?>
        </div>
        <?php
                 };
               endfor;
             } elseif ( $content['cb_content_select'] == 'layout2' ) {
               for ( $i = 1; $i <= 4; $i++ ) :
                 $image = isset( $content['image'.$i] ) ? wp_get_attachment_image_src($content['image'.$i], 'full') : '';
                 $caption = wp_get_attachment_caption($content['image'.$i]);
                 if($image){
  ?>
        <div class="item">
            <div class="image"
                style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center; background-size:contain;">
            </div>
            <?php if($caption){ echo '<p class="caption">' . esc_html($caption) . '</p>'; }; ?>
        </div>
        <?php
                 };
               endfor;
             } elseif ( $content['cb_content_select'] == 'layout3' ) {
               for ( $i = 1; $i <= 8; $i++ ) :
                 $image = isset( $content['image'.$i] ) ? wp_get_attachment_image_src($content['image'.$i], 'full') : '';
                 $caption = wp_get_attachment_caption($content['image'.$i]);
                 if($image){
  ?>
        <div class="item">
            <div class="image"
                style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center; background-size:contain;">
            </div>
            <?php if($caption){ echo '<p class="caption">' . esc_html($caption) . '</p>'; }; ?>
        </div>
        <?php
                 };
               endfor;
             };
           endforeach;
  ?>
    </div><!-- END .image_list -->
</div><!-- END #work_image_modal_box -->
<?php
         endif;

       } else { // gallery type2

         $data_list = get_post_meta($post->ID, 'data_list', true);
         if (!empty($data_list)) :
?>
<div id="work_image_modal_box">
    <div class="close_button"></div>
    <h3 class="title" style="color:<?php echo esc_attr($accent_color); ?>;"><?php the_title(); ?></h3>
    <div class="image_list">
        <?php
           foreach ( $data_list as $key => $value ) :
             $image = isset( $value['image'] ) ? wp_get_attachment_image_src($value['image'], 'full') : '';
             $caption = wp_get_attachment_caption($value['image']);
             if($image){
  ?>
        <div class="item">
            <div class="image"
                style="background:url(<?php echo esc_attr($image[0]); ?>) no-repeat center; background-size:contain;">
            </div>
            <?php if($caption){ echo '<p class="caption">' . esc_html($caption) . '</p>'; }; ?>
        </div>
        <?php
             };
           endforeach;
  ?>
    </div><!-- END .image_list -->
</div><!-- END #work_image_modal_box -->
<?php
         endif;

       }; // end gallery type

     };
?>

<?php
     // �h�����[���j���[ --------------------------------------------
     if (has_nav_menu('global-menu')) {
?>
<div id="drawer_menu">

    <div class="close_button"></div>

    <div id="drawer_menu_content">
        <div id="drawer_menu_content_inner">

            <?php // ���j���[ -------------------  ?>
            <nav class="menu">
                <?php wp_nav_menu( array( 'sort_column' => 'menu_order', 'theme_location' => 'global-menu' , 'container' => '' ) ); ?>
                <li class="sp_li">Sound</li>
            </nav>
            <?php
       // �����t�H�[�� --------------------------------------------------------------------
       if( $options['drawer_menu_show_search'] == 'display') {
  ?>
            <div id="drawer_menu_search">
                <form role="search" method="get" action="<?php echo esc_url(home_url()); ?>">
                    <div class="input_area"><input type="text" value="" name="s" autocomplete="off"></div>
                    <div class="button_area"><label for="drawer_menu_search_button"></label><input
                            id="drawer_menu_search_button" type="submit" value=""></div>
                </form>
            </div>
            <?php }; ?>
            <?php
       // SNS�{�^�� ------------------------------------
       if($options['drawer_menu_show_sns'] == 'display') {
         $facebook = $options['sns_button_facebook_url'];
         $twitter = $options['sns_button_twitter_url'];
         $insta = $options['sns_button_instagram_url'];
         $pinterest = $options['sns_button_pinterest_url'];
         $youtube = $options['sns_button_youtube_url'];
         $contact = $options['sns_button_contact_url'];
         $show_rss = $options['sns_button_show_rss'];
  ?>
            <ul id="drawer_menu_sns"
                class="sns_button_list clearfix color_<?php echo esc_attr($options['sns_button_color_type']); ?>">
                <?php if($insta) { ?><li class="insta"><a href="<?php echo esc_url($insta); ?>" rel="nofollow noopener"
                        target="_blank" title="Instagram"><span>Instagram</span></a></li><?php }; ?>
                <?php if($twitter) { ?><li class="twitter"><a href="<?php echo esc_url($twitter); ?>"
                        rel="nofollow noopener" target="_blank" title="Twitter"><span>Twitter</span></a></li><?php }; ?>
                <?php if($facebook) { ?><li class="facebook"><a href="<?php echo esc_url($facebook); ?>"
                        rel="nofollow noopener" target="_blank" title="Facebook"><span>Facebook</span></a></li>
                <?php }; ?>
                <?php if($pinterest) { ?><li class="pinterest"><a href="<?php echo esc_url($pinterest); ?>"
                        rel="nofollow noopener" target="_blank" title="Pinterest"><span>Pinterest</span></a></li>
                <?php }; ?>
                <?php if($youtube) { ?><li class="youtube"><a href="<?php echo esc_url($youtube); ?>"
                        rel="nofollow noopener" target="_blank" title="Youtube"><span>Youtube</span></a></li><?php }; ?>
                <?php if($contact) { ?><li class="contact"><a href="<?php echo esc_url($contact); ?>"
                        rel="nofollow noopener" target="_blank" title="Contact"><span>Contact</span></a></li><?php }; ?>
                <?php if($show_rss) { ?><li class="rss"><a href="<?php esc_url(bloginfo('rss2_url')); ?>"
                        rel="nofollow noopener" target="_blank" title="RSS"><span>RSS</span></a></li><?php }; ?>
            </ul>
            <?php }; ?>
            <?php
       // ����{�^�� ------------------------------------
       if($options['drawer_menu_show_lang'] == 'display' && $options['lang_button']) {
  ?>
            <ul class="lang_button">
                <?php foreach ( $options['lang_button'] as $key => $value ) : ?>
                <li<?php if($value['active_button']){ echo ' class="active"'; }; ?>><a
                        href="<?php if($value['url']) { echo esc_url($value['url']); }; ?>"
                        target="_blank"><?php if($value['name']) { echo esc_html($value['name']); }; ?></a></li>
                    <?php endforeach; ?>
            </ul>
            <?php }; ?>

        </div><!-- END #drawer_menu_content_inner -->
    </div><!-- END #drawer_menu_content -->

</div>
<?php }; ?>

<?php
     if($page_hide_footer != 'yes'){

     // footer bar for mobile device -------------------
     if( is_mobile() && ($options['footer_bar_display'] != 'type3') && ($options['footer_bar_type'] == 'type1')) {
       get_template_part('template-parts/footer-bar');
     } elseif( is_mobile() && ($options['footer_bar_display'] != 'type3') && ($options['footer_bar_type'] == 'type2')) {
?>
<div id="dp-footer-bar" class="type2">
    <?php
      for($i = 1; $i <= 2; $i++) {
        if($options['show_footer_button'.$i]) {
 ?>
    <a class="footer_button num<?php echo $i; ?>" href="<?php echo esc_html($options['footer_button_url'.$i]); ?>"
        <?php if($options['footer_button_target'.$i]){ echo 'target="_blank"'; }; ?>>
        <span><?php echo esc_html($options['footer_button_label'.$i]); ?></span>
    </a>
    <?php }; }; ?>
</div>
<?php
     }
?>

<?php }; // hide footer ?>

<?php
     // load script -----------------------------------------------------------
     if(
       $options['show_loading'] && is_front_page() && $options['loading_display_page'] == 'type1' && $options['loading_display_time'] == 'type1' && !isset($_COOKIE['first_visit']) ||
       $options['show_loading'] && is_front_page() && $options['loading_display_page'] == 'type1' && $options['loading_display_time'] == 'type2' ||
       $options['show_loading'] && $options['loading_display_page'] == 'type2' && $options['loading_display_time'] == 'type1' && !isset($_COOKIE['first_visit']) ||
       $options['show_loading'] && $options['loading_display_page'] == 'type2' && $options['loading_display_time'] == 'type2'
     ){
       show_loading_screen();
     } else {
       no_loading_screen();
     };
?>

<?php
     // share button ----------------------------------------------------------------------
     if ( is_single() && ( $options['single_blog_show_sns_top'] == 'display' || $options['single_blog_show_sns_btm'] == 'display' || $options['single_news_show_sns_top'] == 'display' || $options['single_news_show_sns_btm'] == 'display') ) :
       if ( $options['sns_share_design_type'] == 'type5') :
         if ( $options['show_sns_share_twitter'] ) :
?>
<script>
! function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0],
        p = /^http:/.test(d.location) ? 'http' : 'https';
    if (!d.getElementById(id)) {
        js = d.createElement(s);
        js.id = id;
        js.src = p + '://platform.twitter.com/widgets.js';
        fjs.parentNode.insertBefore(js, fjs);
    }
}(document, 'script', 'twitter-wjs');
</script>
<?php
         endif;
         if ( $options['show_sns_share_fblike'] || $options['show_sns_share_fbshare'] ) :
?>
<!-- facebook share button code -->
<div id="fb-root"></div>
<script>
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.5";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<?php
         endif;
         if ( $options['show_sns_share_hatena'] ) :
?>
<script type="text/javascript" src="http://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async">
</script>
<?php
         endif;
         if ( $options['show_sns_share_pocket'] ) :
?>
<script type="text/javascript">
! function(d, i) {
    if (!d.getElementById(i)) {
        var j = d.createElement("script");
        j.id = i;
        j.src = "https://widgets.getpocket.com/v1/j/btn.js?v=1";
        var w = d.getElementById(i);
        d.body.appendChild(j);
    }
}(document, "pocket-btn-js");
</script>
<?php
         endif;
         if ( $options['show_sns_share_pinterest'] ) :
?>
<script async defer src="//assets.pinterest.com/js/pinit.js"></script>
<?php
         endif;
       endif;
     endif;
?>

<?php wp_footer(); ?>
</body>

</html>