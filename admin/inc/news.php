<?php
/*
 * お知らせの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_news_dp_default_options' );


// Add label of logo tab
add_action( 'tcd_tab_labels', 'add_news_tab_label' );


// Add HTML of logo tab
add_action( 'tcd_tab_panel', 'add_news_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_news_theme_options_validate' );


// タブの名前
function add_news_tab_label( $tab_labels ) {
  $options = get_design_plus_option();
  $tab_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-horizon' );
  $tab_labels['news'] = $tab_label;
  return $tab_labels;
}


// 初期値
function add_news_dp_default_options( $dp_default_options ) {

	// 基本設定
	$dp_default_options['news_label'] = __( 'News', 'tcd-horizon' );
	$dp_default_options['news_slug'] = 'news';
	$dp_default_options['news_no_image'] = false;
	$dp_default_options['news_headline_font_type'] = 'type2';

	// アーカイブページ
	$dp_default_options['archive_news_bg_image'] = false;
	$dp_default_options['archive_news_overlay_color'] = '#000000';
	$dp_default_options['archive_news_overlay_opacity'] = '0.5';

	$dp_default_options['archive_news_headline'] = 'NEWS';
	$dp_default_options['archive_news_desc'] = '';

	$dp_default_options['archive_news_num'] = '6';
	$dp_default_options['archive_news_num_sp'] = '6';
	$dp_default_options['archive_news_title_font_size'] = '22';
	$dp_default_options['archive_news_title_font_size_sp'] = '16';

	// 詳細ページ
	$dp_default_options['single_news_show_sns_top'] = 'display';
	$dp_default_options['single_news_show_sns_btm'] = 'display';
	$dp_default_options['single_news_show_copy_top'] = 'display';

	// 最新のお知らせ一覧
	$dp_default_options['show_recent_news'] = 1;
	$dp_default_options['recent_news_headline'] = __( 'Latest news', 'tcd-horizon' );
	$dp_default_options['recent_news_num'] = '6';
	$dp_default_options['recent_news_num_sp'] = '3';

	// 広告
	$dp_default_options['news_single_top_ad_code'] = '';
	$dp_default_options['news_single_bottom_ad_code'] = '';
	$dp_default_options['news_single_mobile_ad_code'] = '';


	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_news_tab_panel( $options ) {

  global $dp_default_options, $font_type_options, $basic_display_options;
  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-horizon' );

?>

<div id="tab-content-news" class="tab-content">


   <?php // 基本設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Common setting', 'tcd-horizon');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Name of content', 'tcd-horizon');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('This name will also be used in breadcrumb link.', 'tcd-horizon'); ?></p>
     </div>
     <input id="dp_options[news_label]" class="regular-text" type="text" name="dp_options[news_label]" value="<?php echo esc_attr( $options['news_label'] ); ?>" />

     <h4 class="theme_option_headline2"><?php _e('Slug', 'tcd-horizon');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please enter word by alphabet only.<br />After changing slug, please update permalink setting form <a href="./options-permalink.php"><strong>permalink option page</strong></a>.', 'tcd-horizon'); ?></p>
     </div>
     <p><input id="dp_options[news_slug]" class="hankaku regular-text" type="text" name="dp_options[news_slug]" value="<?php echo sanitize_title( $options['news_slug'] ); ?>" /></p>

     <h4 class="theme_option_headline2"><?php _e('Font type', 'tcd-horizon');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Font type will be applyed to archive page, single page headline and title.', 'tcd-horizon');  ?></p>
     </div>
     <p><?php echo tcd_basic_radio_button($options, 'news_headline_font_type', $font_type_options); ?></p>
     <br style="clear:both;">

     <?php // 代替画像 ------------------------ ?>
     <h4 class="theme_option_headline2"><?php _e('Alternate image to be displayed when featured image is not registered', 'tcd-horizon');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('If you set image here, you can display alternative image for article which featured image is not set.', 'tcd-horizon');  ?></p>
      <p><?php _e('This image will be applied with priority over the "Alternate image to be displayed when featured image is not registered" option in the basic setting menu.', 'tcd-horizon');  ?></p>
      <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '800', '800'); ?></p>
     </div>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js news_no_image">
       <input type="hidden" value="<?php echo esc_attr( $options['news_no_image'] ); ?>" id="news_no_image" name="dp_options[news_no_image]" class="cf_media_id">
       <div class="preview_field"><?php if($options['news_no_image']){ echo wp_get_attachment_image($options['news_no_image'], 'medium'); }; ?></div>
       <div class="buttton_area">
        <input type="button" value="<?php _e('Select Image', 'tcd-horizon'); ?>" class="cfmf-select-img button">
        <input type="button" value="<?php _e('Remove Image', 'tcd-horizon'); ?>" class="cfmf-delete-img button <?php if(!$options['news_no_image']){ echo 'hidden'; }; ?>">
       </div>
      </div>
     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-horizon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // アーカイブページ ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Archive page', 'tcd-horizon'); ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Background image', 'tcd-horizon'); ?></h4>
     <div class="theme_option_message2">
      <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '1450', '1100'); ?></p>
     </div>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js archive_news_bg_image">
       <input type="hidden" value="<?php echo esc_attr( $options['archive_news_bg_image'] ); ?>" id="archive_news_bg_image" name="dp_options[archive_news_bg_image]" class="cf_media_id">
       <div class="preview_field"><?php if($options['archive_news_bg_image']){ echo wp_get_attachment_image($options['archive_news_bg_image'], 'medium'); }; ?></div>
       <div class="buttton_area">
        <input type="button" value="<?php _e('Select Image', 'tcd-horizon'); ?>" class="cfmf-select-img button">
        <input type="button" value="<?php _e('Remove Image', 'tcd-horizon'); ?>" class="cfmf-delete-img button <?php if(!$options['archive_news_bg_image']){ echo 'hidden'; }; ?>">
       </div>
      </div>
     </div>

     <h4 class="theme_option_headline2"><?php _e( 'Overlay', 'tcd-horizon' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please enter 0 if you don\'t want to use overlay.', 'tcd-horizon');  ?></p>
     </div>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-horizon'); ?></span><input type="text" name="dp_options[archive_news_overlay_color]" value="<?php echo esc_attr( $options['archive_news_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      <li class="cf">
       <span class="label"><?php _e('Transparency of overlay', 'tcd-horizon'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[archive_news_overlay_opacity]" value="<?php echo esc_attr( $options['archive_news_overlay_opacity'] ); ?>" />
       <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-horizon');  ?></p>
       </div>
      </li>
     </ul>

     <h4 class="theme_option_headline2"><?php echo __('Headline', 'tcd-horizon'); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('You can set font size and font type of headline from basic setting menu in theme option page.', 'tcd-horizon');  ?></p>
     </div>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Headline', 'tcd-horizon');  ?></span><input type="text" class="full_width" name="dp_options[archive_news_headline]" value="<?php echo esc_attr($options['archive_news_headline']); ?>"></li>
      <li class="cf">
       <span class="label"><?php _e('Description', 'tcd-horizon');  ?></span>
       <textarea class="full_width" cols="50" rows="3" name="dp_options[archive_news_desc]"><?php echo esc_textarea( $options['archive_news_desc'] ); ?></textarea>
      </li>
     </ul>

     <h4 class="theme_option_headline2"><?php printf(__('%s list', 'tcd-horizon'), $news_label); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php echo tcd_admin_label('article_list_num'); ?></span><?php echo tcd_display_post_num_option('archive_news_num', array(4,12,2), array(4,10,2)); ?></li>
      <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-horizon'); ?></span><?php echo tcd_font_size_option($options, 'archive_news_title_font_size'); ?></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-horizon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 詳細ページの設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php printf(__('%s article', 'tcd-horizon'), $news_label); ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-horizon');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('You can set share button design from basic setting menu in theme option page.', 'tcd-horizon');  ?></p>
     </div>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Display share button above post content', 'tcd-horizon');  ?></span><?php echo tcd_basic_radio_button($options, 'single_news_show_sns_top', $basic_display_options); ?></li>
      <li class="cf"><span class="label"><?php _e('Display share button under post content', 'tcd-horizon');  ?></span><?php echo tcd_basic_radio_button($options, 'single_news_show_sns_btm', $basic_display_options); ?></li>
      <li class="cf"><span class="label"><?php _e('Display "COPY Title&amp;URL" button under title', 'tcd-horizon');  ?></span><?php echo tcd_basic_radio_button($options, 'single_news_show_copy_top', $basic_display_options); ?></li>
     </ul>

     <h4 class="theme_option_headline2"><?php echo __('Recent post', 'tcd-horizon'); ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[show_recent_news]" type="checkbox" value="1" <?php checked( $options['show_recent_news'], 1 ); ?>><?php echo __('Display recent post', 'tcd-horizon'); ?></label></p>
     <div style="<?php if($options['show_recent_news'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list">
       <li class="cf" style="border-top:1px dotted #ccc;"><span class="label"><?php _e('Headline', 'tcd-horizon');  ?></span><input type="text" class="full_width" name="dp_options[recent_news_headline]" value="<?php echo esc_textarea(  $options['recent_news_headline'] ); ?>" /></li>
       <li class="cf"><span class="label"><?php _e('Number of post to display', 'tcd-horizon'); ?></span><?php echo tcd_display_post_num_option('recent_news_num', array(4,8,2), array(2,6,2)); ?></li>
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
       <textarea class="full_width" cols="50" rows="10" name="dp_options[news_single_top_ad_code]"><?php echo esc_textarea( $options['news_single_top_ad_code'] ); ?></textarea>
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
       <textarea class="full_width" cols="50" rows="10" name="dp_options[news_single_bottom_ad_code]"><?php echo esc_textarea( $options['news_single_bottom_ad_code'] ); ?></textarea>
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
       <textarea class="full_width" cols="50" rows="10" name="dp_options[news_single_mobile_ad_code]"><?php echo esc_textarea( $options['news_single_mobile_ad_code'] ); ?></textarea>
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
} // END add_news_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_news_theme_options_validate( $input ) {

  global $dp_default_options, $no_image_options, $font_type_options;

  //基本設定
  $input['news_slug'] = sanitize_title( $input['news_slug'] );
  $input['news_label'] = wp_filter_nohtml_kses( $input['news_label'] );
  $input['news_no_image'] = wp_filter_nohtml_kses( $input['news_no_image'] );
  $input['news_headline_font_type'] = wp_filter_nohtml_kses( $input['news_headline_font_type'] );

  // アーカイブ
  $input['archive_news_bg_image'] = wp_filter_nohtml_kses( $input['archive_news_bg_image'] );
  $input['archive_news_overlay_color'] = wp_filter_nohtml_kses( $input['archive_news_overlay_color'] );
  $input['archive_news_overlay_opacity'] = wp_filter_nohtml_kses( $input['archive_news_overlay_opacity'] );

  $input['archive_news_headline'] = wp_filter_nohtml_kses( $input['archive_news_headline'] );
  $input['archive_news_desc'] = wp_filter_nohtml_kses( $input['archive_news_desc'] );

  $input['archive_news_num'] = wp_filter_nohtml_kses( $input['archive_news_num'] );
  $input['archive_news_num_sp'] = wp_filter_nohtml_kses( $input['archive_news_num_sp'] );
  $input['archive_news_title_font_size'] = wp_filter_nohtml_kses( $input['archive_news_title_font_size'] );
  $input['archive_news_title_font_size_sp'] = wp_filter_nohtml_kses( $input['archive_news_title_font_size_sp'] );


  //詳細ページ
  $input['single_news_show_sns_top'] = wp_filter_nohtml_kses( $input['single_news_show_sns_top'] );
  $input['single_news_show_sns_btm'] = wp_filter_nohtml_kses( $input['single_news_show_sns_btm'] );
  $input['single_news_show_copy_top'] = wp_filter_nohtml_kses( $input['single_news_show_copy_top'] );


  // 最新お知らせ一覧
  $input['show_recent_news'] = ! empty( $input['show_recent_news'] ) ? 1 : 0;
  $input['recent_news_headline'] = wp_filter_nohtml_kses( $input['recent_news_headline'] );
  $input['recent_news_num'] = wp_filter_nohtml_kses( $input['recent_news_num'] );
  $input['recent_news_num_sp'] = wp_filter_nohtml_kses( $input['recent_news_num_sp'] );

  // 広告
  $input['news_single_top_ad_code'] = $input['news_single_top_ad_code'];
  $input['news_single_bottom_ad_code'] = $input['news_single_bottom_ad_code'];
  $input['news_single_mobile_ad_code'] = $input['news_single_mobile_ad_code'];

	return $input;

};


?>