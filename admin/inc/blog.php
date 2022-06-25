<?php
/*
 * ブログの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_blog_dp_default_options' );


//  Add label of blog tab
add_action( 'tcd_tab_labels', 'add_blog_tab_label' );


// Add HTML of blog tab
add_action( 'tcd_tab_panel', 'add_blog_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_blog_theme_options_validate' );


// タブの名前
function add_blog_tab_label( $tab_labels ) {
	$tab_labels['blog'] = __( 'Blog', 'tcd-horizon' );
	return $tab_labels;
}


// 初期値
function add_blog_dp_default_options( $dp_default_options ) {

	// 基本設定
	$dp_default_options['blog_label'] = __( 'Blog', 'tcd-horizon' );
	$dp_default_options['blog_show_date'] = 1;
	$dp_default_options['blog_no_image'] = false;
	$dp_default_options['blog_headline_font_type'] = 'type2';

	// アーカイブページ
	$dp_default_options['archive_blog_headline'] = 'BLOG';
	$dp_default_options['archive_blog_desc'] = '';

	$dp_default_options['archive_blog_num'] = '6';
	$dp_default_options['archive_blog_num_sp'] = '6';
	$dp_default_options['archive_blog_title_font_size'] = '22';
	$dp_default_options['archive_blog_title_font_size_sp'] = '16';

	$dp_default_options['show_featured_post'] = 1;
	$dp_default_options['featured_post_headline'] = __( 'Featured post', 'tcd-horizon' );

	// 詳細ページ
	$dp_default_options['single_blog_show_sns_top'] = 'display';
	$dp_default_options['single_blog_show_sns_btm'] = 'display';
	$dp_default_options['single_blog_show_copy_top'] = 'display';
	$dp_default_options['single_blog_show_meta_category'] = 'display';
	$dp_default_options['single_blog_show_meta_tag'] = 'display';
	$dp_default_options['single_blog_show_meta_author'] = 'display';

	// 関連記事
	$dp_default_options['show_related_post'] = 1;
	$dp_default_options['related_post_headline'] = __( 'Related post', 'tcd-horizon' );
	$dp_default_options['related_post_num'] = '8';
	$dp_default_options['related_post_num_sp'] = '6';

	// 記事ページのバナー
	$dp_default_options['single_top_ad_code'] = '';
	$dp_default_options['single_bottom_ad_code'] = '';
	$dp_default_options['single_mobile_ad_code'] = '';

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_blog_tab_panel( $options ) {

  global $dp_default_options, $font_type_options, $post_list_animation_type_options, $basic_display_options;
  $blog_label = $options['blog_label'] ? esc_html( $options['blog_label'] ) : __( 'Blog', 'tcd-horizon' );

?>

<div id="tab-content-blog" class="tab-content">

   <?php // 基本設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Common setting', 'tcd-horizon');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Name of content', 'tcd-horizon');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('This name will also be used in breadcrumb link.', 'tcd-horizon'); ?></p>
     </div>
     <input class="full_width" type="text" name="dp_options[blog_label]" value="<?php echo esc_attr($options['blog_label']); ?>" />

     <h4 class="theme_option_headline2"><?php _e('Date', 'tcd-horizon');  ?></h4>
     <p><label><input name="dp_options[blog_show_date]" type="checkbox" value="1" <?php checked( $options['blog_show_date'], 1 ); ?>><?php _e( 'Display date', 'tcd-horizon' ); ?></label></p>

     <h4 class="theme_option_headline2"><?php _e('Font type', 'tcd-horizon');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Font type will be applyed to archive page, single page headline and title.', 'tcd-horizon');  ?></p>
     </div>
     <p><?php echo tcd_basic_radio_button($options, 'blog_headline_font_type', $font_type_options); ?></p>
     <br style="clear:both;">

     <?php // 代替画像 ------------------------ ?>
     <h4 class="theme_option_headline2"><?php _e('Alternate image to be displayed when featured image is not registered', 'tcd-horizon');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('If you set image here, you can display alternative image for article which featured image is not set.', 'tcd-horizon');  ?></p>
      <p><?php _e('This image will be applied with priority over the "Alternate image to be displayed when featured image is not registered" option in the basic setting menu.', 'tcd-horizon');  ?></p>
      <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '800', '800'); ?></p>
     </div>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js blog_no_image">
       <input type="hidden" value="<?php echo esc_attr( $options['blog_no_image'] ); ?>" id="blog_no_image" name="dp_options[blog_no_image]" class="cf_media_id">
       <div class="preview_field"><?php if($options['blog_no_image']){ echo wp_get_attachment_image($options['blog_no_image'], 'medium'); }; ?></div>
       <div class="buttton_area">
        <input type="button" value="<?php _e('Select Image', 'tcd-horizon'); ?>" class="cfmf-select-img button">
        <input type="button" value="<?php _e('Remove Image', 'tcd-horizon'); ?>" class="cfmf-delete-img button <?php if(!$options['blog_no_image']){ echo 'hidden'; }; ?>">
       </div>
      </div>
     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-horizon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // アーカイブページ ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Archive page', 'tcd-horizon'); ?></h3>
    <div class="theme_option_field_ac_content">

     <?php $home_page_id = get_option( 'page_for_posts' ); ?>
     <div class="theme_option_message2" style="margin-top:20px;">
      <p><?php _e('Settings for the post archive page.', 'tcd-horizon'); ?></p>
      <?php
           if($home_page_id) {
             $home_page_url = get_page_link( $home_page_id );
             if($home_page_url){
      ?>
      <p><?php _e('URL of the post archive page:', 'tcd-horizon'); ?><a class="e_link" href="<?php echo esc_url($home_page_url) ?>"><?php echo esc_url($home_page_url) ?></a></p>
      <?php
             };
           } else {
      ?>
      <p><?php _e('The page for the post archive page is not set.', 'tcd-horizon'); ?>
         <?php _e('Please refer to the <a href="https://dl.tcd-theme.com/tcd090/display-setting/">manual</a> to create and configure.', 'tcd-horizon'); ?></p>
      <?php } ?>
     </div>

     <h4 class="theme_option_headline2"><?php echo __('Headline', 'tcd-horizon'); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('You can set font size and font type of headline from basic setting menu in theme option page.', 'tcd-horizon');  ?></p>
     </div>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Headline', 'tcd-horizon');  ?></span><input type="text" class="full_width" name="dp_options[archive_blog_headline]" value="<?php echo esc_attr($options['archive_blog_headline']); ?>"></li>
      <li class="cf">
       <span class="label"><?php _e('Description', 'tcd-horizon');  ?></span>
       <textarea class="full_width" cols="50" rows="3" name="dp_options[archive_blog_desc]"><?php echo esc_textarea( $options['archive_blog_desc'] ); ?></textarea>
      </li>
     </ul>

     <h4 class="theme_option_headline2"><?php echo __('Post list', 'tcd-horizon'); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php echo tcd_admin_label('article_list_num'); ?></span><?php echo tcd_display_post_num_option('archive_blog_num', array(4,12,2), array(4,10,2)); ?></li>
      <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-horizon'); ?></span><?php echo tcd_font_size_option($options, 'archive_blog_title_font_size'); ?></li>
     </ul>

     <?php // 特集記事 ----------------------------- ?>
     <h4 class="theme_option_headline2"><?php _e('Featured post', 'tcd-horizon');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Recommend post1 will be used in featured post.<br>You can set recommend post1 from post edit page.', 'tcd-horizon');  ?></p>
     </div>
     <p class="displayment_checkbox"><label><input name="dp_options[show_featured_post]" type="checkbox" value="1" <?php checked( $options['show_featured_post'], 1 ); ?>><?php _e( 'Display featured post', 'tcd-horizon' ); ?></label></p>
     <div style="<?php if($options['show_featured_post'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list">
       <li class="cf" style="border-top:1px dotted #ccc;"><span class="label"><?php _e('Headline', 'tcd-horizon');  ?></span><input type="text" class="full_width" name="dp_options[featured_post_headline]" value="<?php echo esc_attr($options['featured_post_headline']); ?>"></li>
      </ul>
     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-horizon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 詳細ページの設定 -------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Blog article', 'tcd-horizon');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-horizon');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('You can set share button design from basic setting menu in theme option page.', 'tcd-horizon');  ?></p>
     </div>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Display share button above post content', 'tcd-horizon');  ?></span><?php echo tcd_basic_radio_button($options, 'single_blog_show_sns_top', $basic_display_options); ?></li>
      <li class="cf"><span class="label"><?php _e('Display share button under post content', 'tcd-horizon');  ?></span><?php echo tcd_basic_radio_button($options, 'single_blog_show_sns_btm', $basic_display_options); ?></li>
      <li class="cf"><span class="label"><?php _e('Display "COPY Title&amp;URL" button under title', 'tcd-horizon');  ?></span><?php echo tcd_basic_radio_button($options, 'single_blog_show_copy_top', $basic_display_options); ?></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Meta box', 'tcd-horizon');  ?></h4>
     <ul class="option_list">
      <li class="cf" style="border-top:1px dotted #ccc;"><span class="label"><?php _e('Display author', 'tcd-horizon');  ?></span><?php echo tcd_basic_radio_button($options, 'single_blog_show_meta_author', $basic_display_options); ?></li>
      <li class="cf"><span class="label"><?php _e('Display category', 'tcd-horizon');  ?></span><?php echo tcd_basic_radio_button($options, 'single_blog_show_meta_category', $basic_display_options); ?></li>
      <li class="cf"><span class="label"><?php _e('Display tag', 'tcd-horizon');  ?></span><?php echo tcd_basic_radio_button($options, 'single_blog_show_meta_tag', $basic_display_options); ?></li>
     </ul>

     <?php // 関連記事 ----------------------------- ?>
     <h4 class="theme_option_headline2"><?php _e('Related post', 'tcd-horizon');  ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[show_related_post]" type="checkbox" value="1" <?php checked( $options['show_related_post'], 1 ); ?>><?php _e( 'Display related post', 'tcd-horizon' ); ?></label></p>
     <div style="<?php if($options['show_related_post'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list">
       <li class="cf" style="border-top:1px dotted #ccc;"><span class="label"><?php _e('Headline', 'tcd-horizon');  ?></span><input type="text" class="full_width" name="dp_options[related_post_headline]" value="<?php echo esc_attr($options['related_post_headline']); ?>"></li>
       <li class="cf"><span class="label"><?php _e('Number of post to display', 'tcd-horizon');  ?></span><?php echo tcd_display_post_num_option('related_post_num', array(8,16,4), array(6,10,2)); ?></li>
      </ul>
     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-horizon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 広告 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Additional content', 'tcd-horizon'); ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="theme_option_message2">
      <p><?php _e('You can display banners in HTML, Google calendar, SNS timeline, etc.', 'tcd-horizon');  ?></p>
     </div>

     <?php // メインコンテンツの上部 -------------------------------- ?>
     <div class="sub_box cf">
      <h3 class="theme_option_subbox_headline"><?php _e('Above main content', 'tcd-horizon'); ?></h3>
      <div class="sub_box_content">
       <div class="theme_option_message2" style="margin-top:20px;">
        <p><?php _e('This content will be displayed above main content.', 'tcd-horizon');  ?></p>
       </div>
       <h4 class="theme_option_headline2"><?php _e('Free HTML area', 'tcd-horizon');  ?></h4>
       <textarea class="full_width" cols="50" rows="10" name="dp_options[single_top_ad_code]"><?php echo esc_textarea( $options['single_top_ad_code'] ); ?></textarea>
       <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-horizon' ); ?>" /></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->

     <?php // メインコンテンツの下部 -------------------------------- ?>
     <div class="sub_box cf">
      <h3 class="theme_option_subbox_headline"><?php _e('Below main content', 'tcd-horizon'); ?></h3>
      <div class="sub_box_content">
       <div class="theme_option_message2" style="margin-top:20px;">
        <p><?php _e('This banner will be displayed after main content.', 'tcd-horizon');  ?></p>
       </div>
       <h4 class="theme_option_headline2"><?php _e('Free HTML area', 'tcd-horizon');  ?></h4>
       <textarea class="full_width" cols="50" rows="10" name="dp_options[single_bottom_ad_code]"><?php echo esc_textarea( $options['single_bottom_ad_code'] ); ?></textarea>
       <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-horizon' ); ?>" /></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->

     <?php // モバイル用 -------------------------------- ?>
     <div class="sub_box cf">
      <h3 class="theme_option_subbox_headline"><?php _e('Mobile device', 'tcd-horizon'); ?></h3>
      <div class="sub_box_content">
       <div class="theme_option_message2" style="margin-top:20px;">
        <p><?php _e('This content will be displayed in mobile device only.', 'tcd-horizon');  ?></p>
        <p><?php _e('This content will be display after main content and will be repleace by additional content for PC device.', 'tcd-horizon');  ?></p>
       </div>
       <h4 class="theme_option_headline2"><?php _e('Free HTML area', 'tcd-horizon');  ?></h4>
       <textarea class="full_width" cols="50" rows="10" name="dp_options[single_mobile_ad_code]"><?php echo esc_textarea( $options['single_mobile_ad_code'] ); ?></textarea>
       <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-horizon' ); ?>" /></li>
        <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-horizon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_blog_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_blog_theme_options_validate( $input ) {

  global $dp_default_options, $font_type_options, $post_list_animation_type_options;

  // 基本設定
  $input['blog_label'] = wp_filter_nohtml_kses( $input['blog_label'] );
  $input['blog_show_date'] = ! empty( $input['blog_show_date'] ) ? 1 : 0;
  $input['blog_no_image'] = wp_filter_nohtml_kses( $input['blog_no_image'] );
  $input['blog_headline_font_type'] = wp_filter_nohtml_kses( $input['blog_headline_font_type'] );

  // アーカイブ
  $input['archive_blog_headline'] = wp_filter_nohtml_kses( $input['archive_blog_headline'] );
  $input['archive_blog_desc'] = wp_filter_nohtml_kses( $input['archive_blog_desc'] );

  $input['archive_blog_num'] = wp_filter_nohtml_kses( $input['archive_blog_num'] );
  $input['archive_blog_num_sp'] = wp_filter_nohtml_kses( $input['archive_blog_num_sp'] );
  $input['archive_blog_title_font_size'] = wp_filter_nohtml_kses( $input['archive_blog_title_font_size'] );
  $input['archive_blog_title_font_size_sp'] = wp_filter_nohtml_kses( $input['archive_blog_title_font_size_sp'] );

  $input['show_featured_post'] = ! empty( $input['show_featured_post'] ) ? 1 : 0;
  $input['featured_post_headline'] = wp_filter_nohtml_kses( $input['featured_post_headline'] );


  // 記事ページ
  $input['single_blog_show_sns_top'] = wp_filter_nohtml_kses( $input['single_blog_show_sns_top'] );
  $input['single_blog_show_sns_btm'] = wp_filter_nohtml_kses( $input['single_blog_show_sns_btm'] );
  $input['single_blog_show_copy_top'] = wp_filter_nohtml_kses( $input['single_blog_show_copy_top'] );

  $input['single_blog_show_meta_category'] = wp_filter_nohtml_kses( $input['single_blog_show_meta_category'] );
  $input['single_blog_show_meta_tag'] = wp_filter_nohtml_kses( $input['single_blog_show_meta_tag'] );
  $input['single_blog_show_meta_author'] = wp_filter_nohtml_kses( $input['single_blog_show_meta_author'] );



  // 関連記事
  $input['show_related_post'] = ! empty( $input['show_related_post'] ) ? 1 : 0;
  $input['related_post_headline'] = wp_filter_nohtml_kses( $input['related_post_headline'] );
  $input['related_post_num'] = wp_filter_nohtml_kses( $input['related_post_num'] );
  $input['related_post_num_sp'] = wp_filter_nohtml_kses( $input['related_post_num_sp'] );


  // 記事ページのバナー広告
  $input['single_top_ad_code'] = $input['single_top_ad_code'];
  $input['single_bottom_ad_code'] = $input['single_bottom_ad_code'];
  $input['single_mobile_ad_code'] = $input['single_mobile_ad_code'];

	return $input;

};


?>