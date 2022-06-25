<?php
/*
 * 基本設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_basic_dp_default_options' );


// Add label of basic tab
add_action( 'tcd_tab_labels', 'add_basic_tab_label' );


// Add HTML of basic tab
add_action( 'tcd_tab_panel', 'add_basic_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_basic_theme_options_validate' );


// タブの名前
function add_basic_tab_label( $tab_labels ) {
	$tab_labels['basic'] = __( 'Basic setting', 'tcd-horizon' );
	return $tab_labels;
}


// 初期値
function add_basic_dp_default_options( $dp_default_options ) {

	// 色の設定
	$dp_default_options['main_color'] = '#00b200';
	$dp_default_options['content_link_color'] = '#000000';
	$dp_default_options['content_link_hover_color'] = '#00b200';

	// フォントの種類
	$dp_default_options['content_font_type'] = 'type2';
	$dp_default_options['content_font_size'] = '16';
	$dp_default_options['content_font_size_sp'] = '14';
	$dp_default_options['headline_font_type'] = 'type2';
	$dp_default_options['headline_font_size'] = '46';
	$dp_default_options['headline_font_size_sp'] = '30';
	$dp_default_options['sub_headline_font_type'] = 'type2';
	$dp_default_options['sub_headline_font_size'] = '26';
	$dp_default_options['sub_headline_font_size_sp'] = '20';
	$dp_default_options['single_title_font_size'] = '30';
	$dp_default_options['single_title_font_size_sp'] = '18';

	// ボタン
	$dp_default_options['design_button_type'] = 'type1';
	$dp_default_options['design_button_border_radius'] = 'oval';
	$dp_default_options['design_button_size'] = 'medium';
	$dp_default_options['design_button_animation_type'] = 'animation_type1';
	$dp_default_options['design_button_color'] = '#00b200';
	$dp_default_options['design_button_color_hover'] = '#098700';

	// アニメーションの設定
	$dp_default_options['hover_type'] = 'type1';
	$dp_default_options['hover1_zoom'] = '1.2';
	$dp_default_options['hover2_zoom'] = '1.2';
	$dp_default_options['hover3_direct'] = 'type1';
	$dp_default_options['hover3_opacity'] = '0.5';
	$dp_default_options['hover3_bgcolor'] = '#FFFFFF';
	$dp_default_options['hover4_opacity'] = '0.5';
	$dp_default_options['hover4_bgcolor'] = '#FFFFFF';

	// オリジナルスタイルの設定
	$dp_default_options['css_code'] = '';

	// オリジナルスクリプトの設定
	$dp_default_options['script_code'] = '';

  // ロードアイコンの設定ここから
  $dp_default_options['show_loading'] = '';
  $dp_default_options['loading_type'] = 'type1';

  // タイプ 1-3
  $dp_default_options['loading_icon_color'] = '#000000';

  // ロゴ
  $dp_default_options['loading_logo_image'] = '';
  $dp_default_options['loading_logo_retina'] = 'yes';
  $dp_default_options['loading_logo_image_sp'] = '';
  $dp_default_options['loading_logo_retina_sp'] = 'yes';

  // キャッチフレーズ
  $dp_default_options['loading_catch'] = '';
  $dp_default_options['loading_catch_font_type'] = 'type2';
  $dp_default_options['loading_catch_font_size'] = '36';
  $dp_default_options['loading_catch_font_size_sp'] = '20';
  $dp_default_options['loading_catch_font_color'] = '#000000';

  // 共通
  $dp_default_options['loading_bg_color'] = '#ffffff';
  $dp_default_options['loading_display_page'] = 'type1';
  $dp_default_options['loading_display_time'] = 'type1';

  // ロードアイコンの設定ここまで

	// NO IMAGE
	$dp_default_options['no_image1'] = false;

	// ソーシャルシェアボタン
	$dp_default_options['sns_share_design_type'] = 'type1';
	$dp_default_options['show_sns_share_twitter'] = 1;
	$dp_default_options['show_sns_share_fblike'] = 1;
	$dp_default_options['show_sns_share_fbshare'] = 1;
	$dp_default_options['show_sns_share_hatena'] = 1;
	$dp_default_options['show_sns_share_pocket'] = 1;
	$dp_default_options['show_sns_share_feedly'] = 1;
	$dp_default_options['show_sns_share_rss'] = 1;
	$dp_default_options['show_sns_share_pinterest'] = 1;
	$dp_default_options['twitter_info'] = '';

  // ソーシャルボタン
	$dp_default_options['sns_button_color_type'] = 'type1';
	$dp_default_options['sns_button_facebook_url'] = '';
	$dp_default_options['sns_button_twitter_url'] = '';
	$dp_default_options['sns_button_instagram_url'] = '';
	$dp_default_options['sns_button_pinterest_url'] = '';
	$dp_default_options['sns_button_youtube_url'] = '';
	$dp_default_options['sns_button_contact_url'] = '';
	$dp_default_options['sns_button_show_rss'] = 1;

	$dp_default_options['show_sns_footer'] = 'no';

  // 検索の対象
	$dp_default_options['search_type_post'] = 'yes';
	$dp_default_options['search_type_page'] = 'no';
	$dp_default_options['search_type_news'] = 'no';
	$dp_default_options['search_type_work'] = 'no';
	$dp_default_options['search_result_no_post_label'] = __( 'There is no registered post.', 'tcd-horizon' );

	// 404 ページ
	$dp_default_options['page_404_bg_image'] = false;
	$dp_default_options['page_404_catch'] = '404 NOT FOUND';
	$dp_default_options['page_404_desc'] = __( 'The page you are looking for are not found', 'tcd-horizon' );
	$dp_default_options['page_404_overlay_color'] = '#000000';
	$dp_default_options['page_404_overlay_opacity'] = '0.5';

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_basic_tab_panel( $options ) {

  global $dp_default_options, $font_type_options, $hover_type_options, $hover3_direct_options, $sns_type_options, $footer_bar_icon_options, $bool_options, $basic_display_options,
         $button_type_options, $button_border_radius_options, $button_size_options, $button_animation_options,
         $loading_type, $loading_display_page_options, $loading_display_time_options, $time_options;

  $blog_label = $options['blog_label'] ? esc_html( $options['blog_label'] ) : __( 'Blog', 'tcd-horizon' );
  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-horizon' );
  $work_label = $options['work_label'] ? esc_html( $options['work_label'] ) : __( 'Work', 'tcd-horizon' );

?>

<div id="tab-content-basic" class="tab-content">

   <?php // 色の設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Color', 'tcd-horizon');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="theme_option_message2">
      <p><?php _e( 'Accent color will be used mostly in navigation menu, button, and hover color.', 'tcd-horizon' ); ?></p>
     </div>

     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Accent color', 'tcd-horizon'); ?></span><input type="text" name="dp_options[main_color]" value="<?php echo esc_attr( $options['main_color'] ); ?>" data-default-color="#00b200" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Single page text link color', 'tcd-horizon'); ?></span><input type="text" name="dp_options[content_link_color]" value="<?php echo esc_attr( $options['content_link_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Single page text link color on mouseover', 'tcd-horizon'); ?></span><input type="text" name="dp_options[content_link_hover_color]" value="<?php echo esc_attr( $options['content_link_hover_color'] ); ?>" data-default-color="#00b200" class="c-color-picker"></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-horizon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // フォントの種類 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Font', 'tcd-horizon');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-horizon'); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('This settings will be applied to most of the headline and catchphrase.', 'tcd-horizon'); ?></p>
     </div>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php echo tcd_admin_label('font_type'); ?></span><?php echo tcd_basic_radio_button($options, 'headline_font_type', $font_type_options); ?></li>
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-horizon'); ?></span><?php echo tcd_font_size_option($options, 'headline_font_size'); ?></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-horizon'); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('This settings will be applied to catchphrase in content builder.', 'tcd-horizon'); ?></p>
     </div>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php echo tcd_admin_label('font_type'); ?></span><?php echo tcd_basic_radio_button($options, 'sub_headline_font_type', $font_type_options); ?></li>
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-horizon'); ?></span><?php echo tcd_font_size_option($options, 'sub_headline_font_size'); ?></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Post title', 'tcd-horizon');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('This settings will be applied to single page.', 'tcd-horizon'); ?></p>
     </div>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-horizon'); ?></span><?php echo tcd_font_size_option($options, 'single_title_font_size'); ?></li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Post contet', 'tcd-horizon'); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'This setting will be used in post contents and descriptions.', 'tcd-horizon' ); ?></p>
     </div>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php echo tcd_admin_label('font_type'); ?></span><?php echo tcd_basic_radio_button($options, 'content_font_type', $font_type_options); ?></li>
      <li class="cf"><span class="label"><?php _e('Font size', 'tcd-horizon'); ?></span><?php echo tcd_font_size_option($options, 'content_font_size'); ?></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-horizon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // ボタンの設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Button', 'tcd-horizon');  ?></h3>
    <div class="theme_option_field_ac_content qt-btn-preview-wrapper">

     <div class="theme_option_message2">
      <p><?php _e('This settings will be applied to contents builder button.', 'tcd-horizon'); ?></p>
     </div>

     <div class="admin_preview_area qt-btn-preview">
      <div class="qt_button_wrap">
       <div class="qt_button type1"><span class="text"><?php _e('Normal', 'tcd-horizon'); ?></span><span class="background"></span></div>
       <div class="qt_button type2"><span class="text"><?php _e('Ghost', 'tcd-horizon'); ?></span><span class="background"></span></div>
       <div class="qt_button type3"><span class="text"><?php _e('Reverse', 'tcd-horizon'); ?></span><span class="background"></span></div>
      </div>
     </div>

     <h4 class="theme_option_headline2"><?php _e( 'Basic setting', 'tcd-horizon' ); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Type', 'tcd-horizon'); ?></span><?php echo tcd_basic_radio_button($options, 'design_button_type', $button_type_options); ?></li>
      <li class="cf"><span class="label"><?php _e('Shape', 'tcd-horizon'); ?></span><?php echo tcd_basic_radio_button($options, 'design_button_border_radius', $button_border_radius_options); ?></li>
      <li class="cf"><span class="label"><?php _e('Size', 'tcd-horizon'); ?></span><?php echo tcd_basic_radio_button($options, 'design_button_size', $button_size_options); ?></li>
      <li class="cf"><span class="label"><?php _e('Mouseover animation', 'tcd-horizon'); ?></span><?php echo tcd_basic_radio_button($options, 'design_button_animation_type', $button_animation_options); ?></li>
      <li class="cf"><span class="label"><?php _e('Color scheme', 'tcd-horizon'); ?></span><input type="text" name="dp_options[design_button_color]" value="<?php echo esc_attr( $options['design_button_color'] ); ?>" data-default-color="#00b200" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Color scheme on mouseover', 'tcd-horizon'); ?></span><input type="text" name="dp_options[design_button_color_hover]" value="<?php echo esc_attr( $options['design_button_color_hover'] ); ?>" data-default-color="#098700" class="c-color-picker"></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-horizon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // ホバーアニメーション ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Thumbnail and hover animation', 'tcd-horizon');  ?></h3>
    <div class="theme_option_field_ac_content">
     <h4 class="theme_option_headline2"><?php _e('Hover effect type', 'tcd-horizon'); ?></h4>

     <div class="theme_option_message2">
      <p><?php _e('You can select the thumbnail hover effect from 4 types.', 'tcd-horizon'); ?></p>
     </div>

     <ul class="design_radio_button">
      <?php foreach ( $hover_type_options as $option ) { ?>
      <li>
       <input type="radio" id="hover_type_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[hover_type]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $options['hover_type'], $option['value'] ); ?> />
       <label for="hover_type_<?php esc_attr_e( $option['value'] ); ?>"><?php echo esc_html( $option['label'] ); ?></label>
      </li>
      <?php } ?>
     </ul>

     <div id="hover_type1_area" style="<?php if($options['hover_type'] == 'type1'){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e('Zoom in', 'tcd-horizon'); ?></h4>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Magnification rate', 'tcd-horizon'); ?></span><input class="hankaku" style="width:70px;" type="number" max="10" min="1" step="0.1" name="dp_options[hover1_zoom]" value="<?php esc_attr_e( $options['hover1_zoom'] ); ?>" /></li>
      </ul>
     </div>

     <div id="hover_type2_area" style="<?php if($options['hover_type'] == 'type2'){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e('Zoom out', 'tcd-horizon'); ?></h4>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Reduction rate', 'tcd-horizon'); ?></span><input class="hankaku" style="width:70px;" type="number" max="10" min="1" step="0.1" name="dp_options[hover2_zoom]" value="<?php esc_attr_e( $options['hover2_zoom'] ); ?>" /></li>
      </ul>
     </div>

     <div id="hover_type3_area" style="<?php if($options['hover_type'] == 'type3'){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e('Slide', 'tcd-horizon'); ?></h4>
      <ul class="option_list">
       <li class="cf">
        <span class="label"><?php _e('Direction', 'tcd-horizon'); ?></span>
        <select name="dp_options[hover3_direct]">
         <?php foreach ( $hover3_direct_options as $option ) { ?>
         <option style="padding-right: 10px;" value="<?php echo esc_attr($option['value']); ?>" <?php selected( $options['hover3_direct'], $option['value'] ); ?>><?php echo $option['label']; ?></option>
         <?php } ?>
        </select>
       </li>
       <li class="cf"><span class="label"><?php _e('Background color', 'tcd-horizon'); ?></span><input type="text" name="dp_options[hover3_bgcolor]" value="<?php echo esc_attr( $options['hover3_bgcolor'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
       <li class="cf">
        <span class="label"><?php _e('Opacity of background color', 'tcd-horizon'); ?></span>
        <input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[hover3_opacity]" value="<?php esc_attr_e( $options['hover3_opacity'] ); ?>" />
        <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
         <p><?php _e('Please specify the number of 0 from 1.0. Overlay color will be more transparent as the number is small.', 'tcd-horizon');  ?></p>
        </div>
       </li>
      </ul>
     </div>

     <div id="hover_type4_area" style="<?php if($options['hover_type'] == 'type4'){ echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <h4 class="theme_option_headline2"><?php _e('Fade', 'tcd-horizon'); ?></h4>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php _e('Background color', 'tcd-horizon'); ?></span><input type="text" name="dp_options[hover4_bgcolor]" value="<?php echo esc_attr( $options['hover4_bgcolor'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
       <li class="cf">
        <span class="label"><?php _e('Opacity of background color', 'tcd-horizon'); ?></span>
        <input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[hover4_opacity]" value="<?php esc_attr_e( $options['hover4_opacity'] ); ?>" />
        <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
         <p><?php _e('Please specify the number of 0 from 1.0. Overlay color will be more transparent as the number is small.', 'tcd-horizon');  ?></p>
        </div>
       </li>
      </ul>
     </div>

     <?php // 代替画像 ------------------------------------------------------------------- ?>
     <h3 class="theme_option_headline2"><?php _e('Alternate image to be displayed when featured image is not registered', 'tcd-horizon');  ?></h3>
     <div class="theme_option_message2">
      <p><?php _e('If you set image here, you can display alternative image for article which featured image is not set.', 'tcd-horizon');  ?></p>
      <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '800', '800'); ?></p>
     </div>
     <div class="image_box cf">
      <div class="cf cf_media_field hide-if-no-js no_image1">
       <input type="hidden" value="<?php echo esc_attr( $options['no_image1'] ); ?>" id="no_image1" name="dp_options[no_image1]" class="cf_media_id">
       <div class="preview_field"><?php if($options['no_image1']){ echo wp_get_attachment_image($options['no_image1'], 'medium'); }; ?></div>
       <div class="buttton_area">
        <input type="button" value="<?php _e('Select Image', 'tcd-horizon'); ?>" class="cfmf-select-img button">
        <input type="button" value="<?php _e('Remove Image', 'tcd-horizon'); ?>" class="cfmf-delete-img button <?php if(!$options['no_image1']){ echo 'hidden'; }; ?>">
       </div>
      </div>
     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-horizon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // SNSボタン  ------------------------------------------------------------------ ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Share button and SNS icon', 'tcd-horizon');  ?></h3>
    <div class="theme_option_field_ac_content">

     <?php // ソーシャルシェアボタン ------------------------------------------------------------------- ?>
     <div class="sub_box cf"> 
      <h3 class="theme_option_subbox_headline"><?php _e('Share button', 'tcd-horizon');  ?></h3>
      <div class="sub_box_content">

       <div class="theme_option_message2" style="margin-top:20px;">
        <p><?php printf(__('Share button will be displayed in blog article and %s article.', 'tcd-horizon'), $news_label); ?></p>
        <p><?php _e('Display position can be set from each post type.', 'tcd-horizon');  ?></p>
       </div>

       <h4 class="theme_option_headline2"><?php _e('Share button design', 'tcd-horizon');  ?></h4>
       <ul class="design_radio_button image_radio_button cf">
        <?php foreach ( $sns_type_options as $option ) { ?>
        <li>
         <input type="radio" id="sns_share_design_type_<?php esc_attr_e( $option['value'] ); ?>" name="dp_options[sns_share_design_type]" value="<?php esc_attr_e( $option['value'] ); ?>" <?php checked( $options['sns_share_design_type'], $option['value'] ); ?> />
         <label for="sns_share_design_type_<?php esc_attr_e( $option['value'] ); ?>">
          <span><?php echo esc_html($option['label']); ?></span>
          <img src="<?php bloginfo('template_url'); ?>/admin/img/<?php echo esc_attr($option['img']); ?>" alt="" title="" />
         </label>
        </li>
        <?php } ?>
       </ul>

       <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-horizon');  ?></h4>
       <ul>
        <li><label><input name="dp_options[show_sns_share_twitter]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_share_twitter'] ); ?> /> <?php _e('Display twitter button', 'tcd-horizon');  ?></label></li>
        <li><label><input name="dp_options[show_sns_share_fblike]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_share_fblike'] ); ?> /> <?php _e('Display facebook like button -Button type 5 (Default button) only', 'tcd-horizon');  ?></label></li>
        <li><label><input name="dp_options[show_sns_share_fbshare]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_share_fbshare'] ); ?> /> <?php _e('Display facebook share button', 'tcd-horizon');  ?></label></li>
        <li><label><input name="dp_options[show_sns_share_hatena]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_share_hatena'] ); ?> /> <?php _e('Display hatena button', 'tcd-horizon');  ?></label></li>
        <li><label><input name="dp_options[show_sns_share_pocket]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_share_pocket'] ); ?> /> <?php _e('Display pocket button', 'tcd-horizon');  ?></label></li>
        <li><label><input name="dp_options[show_sns_share_feedly]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_share_feedly'] ); ?> /> <?php _e('Display feedly button', 'tcd-horizon');  ?></label></li>
        <li><label><input name="dp_options[show_sns_share_rss]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_share_rss'] ); ?> /> <?php _e('Display rss button', 'tcd-horizon');  ?></label></li>
        <li><label><input name="dp_options[show_sns_share_pinterest]" type="checkbox" value="1" <?php checked( '1', $options['show_sns_share_pinterest'] ); ?> /> <?php _e('Display pinterest button', 'tcd-horizon');  ?></label></li>
       </ul>

       <h4 class="theme_option_headline2"><?php _e('Setting for the twitter button', 'tcd-horizon');  ?></h4>
       <label style="margin-top:20px;"><?php _e('Set of twitter account. (ex.tcd_jp)', 'tcd-horizon');  ?></label>
       <input style="display:block; margin:.6em 0 1em;" id="dp_options[twitter_info]" class="regular-text" type="text" name="dp_options[twitter_info]" value="<?php esc_attr_e( $options['twitter_info'] ); ?>" />

       <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-horizon' ); ?>" /></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->

     <?php // ソーシャルボタン ------------------------------------------------------------------- ?>
     <div class="sub_box cf"> 
      <h3 class="theme_option_subbox_headline"><?php _e('SNS icon', 'tcd-horizon');  ?></h3>
      <div class="sub_box_content">

       <h4 class="theme_option_headline2"><?php _e('SNS icon design', 'tcd-horizon');  ?></h4>
       <ul class="design_radio_button image_radio_button cf">
        <li>
         <input type="radio" id="sns_button_color_type1" name="dp_options[sns_button_color_type]" value="type1" <?php checked( $options['sns_button_color_type'], 'type1' ); ?> />
         <label for="sns_button_color_type1">
          <span><?php _e('Monochrome (TCD ver)', 'tcd-horizon');  ?></span>
          <img src="<?php bloginfo('template_url'); ?>/admin/img/sns_color_type1.png" alt="" title="" />
         </label>
        </li>
        <li>
         <input type="radio" id="sns_button_color_type2" name="dp_options[sns_button_color_type]" value="type2" <?php checked( $options['sns_button_color_type'], 'type2' ); ?> />
         <label for="sns_button_color_type2">
          <span><?php _e('Official color', 'tcd-horizon');  ?></span>
          <img src="<?php bloginfo('template_url'); ?>/admin/img/sns_color_type2.png" alt="" title="" />
         </label>
        </li>
       </ul>

       <h4 class="theme_option_headline2"><?php _e('Link', 'tcd-horizon');  ?></h4>
       <div class="theme_option_message2">
        <p><?php _e('Enter url of your SNS. Please leave the field empty if you don\'t want to display certain sns button.', 'tcd-horizon');  ?></p>
       </div>
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Instagram URL', 'tcd-horizon'); ?></span><input class="full_width" type="text" name="dp_options[sns_button_instagram_url]" value="<?php echo esc_attr( $options['sns_button_instagram_url'] ); ?>"></li>
        <li class="cf"><span class="label"><?php _e('Twitter URL', 'tcd-horizon'); ?></span><input class="full_width" type="text" name="dp_options[sns_button_twitter_url]" value="<?php echo esc_attr( $options['sns_button_twitter_url'] ); ?>"></li>
        <li class="cf"><span class="label"><?php _e('Facebook URL', 'tcd-horizon'); ?></span><input class="full_width" type="text" name="dp_options[sns_button_facebook_url]" value="<?php echo esc_attr( $options['sns_button_facebook_url'] ); ?>"></li>
        <li class="cf"><span class="label"><?php _e('Pinterest URL', 'tcd-horizon'); ?></span><input class="full_width" type="text" name="dp_options[sns_button_pinterest_url]" value="<?php echo esc_attr( $options['sns_button_pinterest_url'] ); ?>"></li>
        <li class="cf"><span class="label"><?php _e('Youtube URL', 'tcd-horizon'); ?></span><input class="full_width" type="text" name="dp_options[sns_button_youtube_url]" value="<?php echo esc_attr( $options['sns_button_youtube_url'] ); ?>"></li>
        <li class="cf"><span class="label"><?php _e('Contact page URL (You can use mailto:)', 'tcd-horizon'); ?></span><input class="full_width" type="text" name="dp_options[sns_button_contact_url]" value="<?php echo esc_attr( $options['sns_button_contact_url'] ); ?>"></li>
        <li class="cf"><span class="label"><?php _e('Display RSS button', 'tcd-horizon'); ?></span><input name="dp_options[sns_button_show_rss]" type="checkbox" value="1" <?php checked( '1', $options['sns_button_show_rss'] ); ?> /></li>
       </ul>

       <h4 class="theme_option_headline2"><?php _e('Display setting', 'tcd-horizon');  ?></h4>
       <div class="theme_option_message2" style="margin-top:20px;">
        <p><?php _e('SNS icon can be displayed in the following places.<br>Display settings can be set in various places.<br><br>Copyright part of footer<br>In the content builder "Access Map"<br>In the post single page profile', 'tcd-horizon');  ?></p>
       </div>
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Display on footer', 'tcd-horizon'); ?></span><?php echo tcd_basic_radio_button($options, 'show_sns_footer', $basic_display_options); ?></li>
       </ul>

       <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-horizon' ); ?>" /></li>
       </ul>
      </div><!-- END .sub_box_content -->
     </div><!-- END .sub_box -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-horizon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // ロード画面の設定 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Loading screen', 'tcd-horizon');  ?></h3>
    <div class="theme_option_field_ac_content">

     <input id="show_loading" class="show_checkbox" name="dp_options[show_loading]" type="checkbox" value="1" <?php checked( $options['show_loading'], 1 ); ?>>
     <label for="show_loading"><?php _e( 'Display loading screen', 'tcd-horizon' ); ?></label>

     <div class="show_checkbox_area">

      <div class="theme_option_message2" style="margin-top:20px;">
       <p><?php _e('You can set the load screen displayed during page transition.', 'tcd-horizon');  ?></p>
      </div>

      <input class="tcd_admin_image_radio_button" id="loading_type1" type="radio" name="dp_options[loading_type]" value="type1" <?php checked( $options['loading_type'], 'type1' ); ?>>
      <label for="loading_type1">
       <div class="loading_icon_wrap">
        <div class="circular_loader">
         <svg class="circular" viewBox="25 25 50 50">
          <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
         </svg>
        </div>
       </div>
       <span class="title_wrap"><span class="title"><?php _e( 'Circle icon', 'tcd-horizon' ); ?></span></span>
      </label>
      <input class="tcd_admin_image_radio_button" id="loading_type2" type="radio" name="dp_options[loading_type]" value="type2" <?php checked( $options['loading_type'], 'type2' ); ?>>
      <label for="loading_type2">
       <div class="loading_icon_wrap">
        <div class="sk-cube-grid">
         <div class="sk-cube sk-cube1"></div><div class="sk-cube sk-cube2"></div><div class="sk-cube sk-cube3"></div><div class="sk-cube sk-cube4"></div><div class="sk-cube sk-cube5"></div><div class="sk-cube sk-cube6"></div><div class="sk-cube sk-cube7"></div><div class="sk-cube sk-cube8"></div><div class="sk-cube sk-cube9"></div></div>
       </div>
       <span class="title_wrap"><span class="title"><?php _e( 'Square icon', 'tcd-horizon' ); ?></span></span>
      </label>
      <input class="tcd_admin_image_radio_button" id="loading_type3" type="radio" name="dp_options[loading_type]" value="type3" <?php checked( $options['loading_type'], 'type3' ); ?>>
      <label for="loading_type3">
       <div class="loading_icon_wrap">
        <div class="sk-circle">
         <div class="sk-circle1 sk-child"></div><div class="sk-circle2 sk-child"></div><div class="sk-circle3 sk-child"></div><div class="sk-circle4 sk-child"></div><div class="sk-circle5 sk-child"></div><div class="sk-circle6 sk-child"></div><div class="sk-circle7 sk-child"></div><div class="sk-circle8 sk-child"></div><div class="sk-circle9 sk-child"></div><div class="sk-circle10 sk-child"></div><div class="sk-circle11 sk-child"></div><div class="sk-circle12 sk-child"></div>
        </div>
       </div>
       <span class="title_wrap"><span class="title"><?php _e( 'Dot circle icon', 'tcd-horizon' ); ?></span></span>
      </label>
      <input class="tcd_admin_image_radio_button" id="loading_type4" type="radio" name="dp_options[loading_type]" value="type4" <?php checked( $options['loading_type'], 'type4' ); ?>>
      <label for="loading_type4">
       <span class="image_wrap"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/loading_logo.gif" alt=""></span>
       <span class="title_wrap"><span class="title"><?php _e( 'Logo', 'tcd-horizon' ); ?></span></span>
      </label>
      <input class="tcd_admin_image_radio_button" id="loading_type5" type="radio" name="dp_options[loading_type]" value="type5" <?php checked( $options['loading_type'], 'type5' ); ?>>
      <label for="loading_type5">
       <span class="image_wrap"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/loading_catch.gif" alt=""></span>
       <span class="title_wrap"><span class="title"><?php _e( 'Catchphrase', 'tcd-horizon' ); ?></span></span>
      </label>

      <?php // type1 - type3 ----------------------------------------- ?>
      <div id="loading_type1-3_area">
       <h4 class="theme_option_headline2"><?php _e('Icon design', 'tcd-horizon');  ?></h4>
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Icon color', 'tcd-horizon');  ?></span><input type="text" name="dp_options[loading_icon_color]" value="<?php echo esc_attr( $options['loading_icon_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
       </ul>
      </div>

      <?php // type4 ----------------------------------------- ?>
      <div id="loading_type4_area">
       <h4 class="theme_option_headline2"><?php _e('Logo', 'tcd-horizon');  ?></h4>
       <div class="theme_option_message2">
        <p><?php _e('Please select "Yes" for the radio button below if you upload logo image for the retina display.','tcd-horizon'); ?></p>
       </div>
       <ul class="option_list">
        <li class="cf"><span class="label"><?php _e('Image', 'tcd-horizon'); ?></span><?php echo tcd_media_image_uploader($options, 'loading_logo_image', 'full'); ?></li>
        <li class="cf"><span class="label"><?php _e('Use retina display image', 'tcd-horizon');  ?></span><?php echo tcd_basic_radio_button($options, 'loading_logo_retina', $bool_options); ?></li>
        <li class="cf"><span class="label"><?php _e('Image (mobile)', 'tcd-horizon'); ?></span><?php echo tcd_media_image_uploader($options, 'loading_logo_image_sp', 'full'); ?></li>
        <li class="cf"><span class="label"><?php _e('Use retina display image', 'tcd-horizon');  ?></span><?php echo tcd_basic_radio_button($options, 'loading_logo_retina_sp', $bool_options); ?></li>
       </ul>
      </div>

      <?php // type5 ----------------------------------------- ?>
      <div id="loading_type5_area">
       <h4 class="theme_option_headline2"><?php echo tcd_admin_label('catch'); ?></h4>
       <ul class="option_list">
        <li class="cf"><span class="label"><?php echo tcd_admin_label('catch'); ?></span><textarea class="full_width" cols="50" rows="2" name="dp_options[loading_catch]"><?php echo esc_textarea( $options['loading_catch'] ); ?></textarea></li>
        <li class="cf"><span class="label"><?php echo tcd_admin_label('font_type'); ?></span><?php echo tcd_basic_radio_button($options, 'loading_catch_font_type', $font_type_options); ?></li>
        <li class="cf"><span class="label"><?php echo tcd_admin_label('font_size'); ?></span><?php echo tcd_font_size_option($options, 'loading_catch_font_size'); ?></li>
        <li class="cf"><span class="label"><?php echo tcd_admin_label('color'); ?></span><input type="text" name="dp_options[loading_catch_font_color]" value="<?php echo esc_attr( $options['loading_catch_font_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
       </ul>
      </div>

      <?php // 共通 ----------------------------------------- ?>
      <h4 class="theme_option_headline2"><?php echo tcd_admin_label('common'); ?></h4>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php echo tcd_admin_label('bg_color'); ?></span><input type="text" name="dp_options[loading_bg_color]" value="<?php echo esc_attr( $options['loading_bg_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
       <li class="cf"><span class="label"><?php _e('Display pages', 'tcd-horizon'); ?></span><?php echo tcd_basic_radio_button($options, 'loading_display_page', $loading_display_page_options); ?></li>
       <li class="cf"><span class="label"><?php _e('Display times', 'tcd-horizon'); ?></span><?php echo tcd_basic_radio_button($options, 'loading_display_time', $loading_display_time_options); ?></li>
      </ul>

     </div><!-- END .show_checkbox_area -->

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->

   <?php // 404 ページ ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e( '404 page', 'tcd-horizon' ); ?></h3>
    <div class="theme_option_field_ac_content">

     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Catchphrase', 'tcd-horizon'); ?></span><textarea class="full_width" cols="50" rows="2" name="dp_options[page_404_catch]"><?php echo esc_textarea( $options['page_404_catch'] ); ?></textarea></li>
      <li class="cf"><span class="label"><?php _e('Description', 'tcd-horizon'); ?></span><textarea class="full_width" cols="50" rows="2" name="dp_options[page_404_desc]"><?php echo esc_textarea( $options['page_404_desc'] ); ?></textarea></li>
      <li class="cf">
       <span class="label">
        <span><?php _e('Background image', 'tcd-horizon'); ?></span>
        <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '1450', '1100'); ?></span>
       </span>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js page_404_bg_image">
         <input type="hidden" value="<?php echo esc_attr( $options['page_404_bg_image'] ); ?>" id="page_404_bg_image" name="dp_options[page_404_bg_image]" class="cf_media_id">
         <div class="preview_field"><?php if ( $options['page_404_bg_image'] ) { echo wp_get_attachment_image( $options['page_404_bg_image'], 'medium' ); } ?></div>
         <div class="button_area">
          <input type="button" value="<?php _e( 'Select Image', 'tcd-horizon' ); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e( 'Remove Image', 'tcd-horizon' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['page_404_bg_image'] ) { echo 'hidden'; } ?>">
         </div>
        </div>
       </div>
      </li>
      <li class="cf"><span class="label"><?php _e('Overlay color', 'tcd-horizon'); ?></span><input type="text" name="dp_options[page_404_overlay_color]" value="<?php echo esc_attr( $options['page_404_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      <li class="cf">
       <span class="label"><?php _e('Transparency of overlay', 'tcd-horizon'); ?></span>
       <input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[page_404_overlay_opacity]" value="<?php echo esc_attr( $options['page_404_overlay_opacity'] ); ?>" />
       <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-horizon');  ?><br>
        <?php _e('Please enter 0 if you don\'t want to use overlay.', 'tcd-horizon');  ?></p>
       </div>
      </li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-horizon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // 検索の対象 ------------------------------------------------------------ ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Search form', 'tcd-horizon');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="theme_option_message2">
      <p><?php _e('This setting will be applied to all search forms, including the search widget. ', 'tcd-horizon');  ?></p>
     </div>

     <ul class="option_list">
      <li class="cf"><span class="label"><?php printf(__('Include %s in search range', 'tcd-horizon'), __('post', 'tcd-horizon') ); ?></span><?php echo tcd_basic_radio_button($options, 'search_type_post', $bool_options); ?></li>
      <li class="cf"><span class="label"><?php printf(__('Include %s in search range', 'tcd-horizon'), __('pages', 'tcd-horizon') ); ?></span><?php echo tcd_basic_radio_button($options, 'search_type_page', $bool_options); ?></li>
      <li class="cf"><span class="label"><?php printf(__('Include %s in search range', 'tcd-horizon'), $news_label ); ?></span></span><?php echo tcd_basic_radio_button($options, 'search_type_news', $bool_options); ?></li>
      <li class="cf"><span class="label"><?php printf(__('Include %s in search range', 'tcd-horizon'), $work_label ); ?></span></span><?php echo tcd_basic_radio_button($options, 'search_type_work', $bool_options); ?></li>
      <li class="cf"><span class="label"><?php _e('Text for no search result page', 'tcd-horizon');  ?></span><textarea class="full_width" cols="50" rows="2" name="dp_options[search_result_no_post_label]"><?php echo esc_textarea( $options['search_result_no_post_label'] ); ?></textarea></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-horizon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // ユーザーCSS用の自由記入欄 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Custom CSS', 'tcd-horizon');  ?></h3>
    <div class="theme_option_field_ac_content">
     <div class="theme_option_message2">
      <p><?php _e( 'This css will be displayed inside &lt;head&gt; tag.<br />You don\'t need to enter &lt;style&gt; tag in this field.', 'tcd-horizon' ); ?></p>
      <p><?php _e('Example:<br><strong>.custom_css { font-size:12px; }</strong>', 'tcd-horizon');  ?></p>
     </div>
     <textarea id="dp_options[css_code]" class="large-text" cols="50" rows="10" name="dp_options[css_code]"><?php echo esc_textarea( $options['css_code'] ); ?></textarea>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-horizon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // カスタムスクリプト用の自由記入欄 ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Custom script', 'tcd-horizon');  ?></h3>
    <div class="theme_option_field_ac_content">
     <div class="theme_option_message2">
      <p><?php _e( 'This script will be displayed inside &lt;head&gt; tag.', 'tcd-horizon' ); ?></p>
     </div>
     <textarea id="dp_options[script_code]" class="large-text" cols="50" rows="10" name="dp_options[script_code]"><?php echo esc_textarea( $options['script_code'] ); ?></textarea>
     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-horizon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_basic_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_basic_theme_options_validate( $input ) {

  global $dp_default_options, $font_type_options, $hover_type_options, $hover3_direct_options, $sns_type_options, $footer_bar_icon_options, $bool_options,
         $button_type_options, $button_border_radius_options, $button_size_options, $button_animation_options,
         $loading_type, $loading_display_page_options, $loading_display_time_options, $time_options;

  // 色の設定
  $input['main_color'] = sanitize_hex_color( $input['main_color'] );
  $input['content_link_color'] = sanitize_hex_color( $input['content_link_color'] );
  $input['content_link_hover_color'] = sanitize_hex_color( $input['content_link_hover_color'] );


  // フォントの種類
  if ( ! isset( $input['content_font_type'] ) )
    $input['content_font_type'] = null;
  if ( ! array_key_exists( $input['content_font_type'], $font_type_options ) )
    $input['content_font_type'] = null;
  $input['content_font_size'] = wp_filter_nohtml_kses( $input['content_font_size'] );
  $input['content_font_size_sp'] = wp_filter_nohtml_kses( $input['content_font_size_sp'] );

  if ( ! isset( $input['headline_font_type'] ) )
    $input['headline_font_type'] = null;
  if ( ! array_key_exists( $input['headline_font_type'], $font_type_options ) )
    $input['headline_font_type'] = null;
  $input['headline_font_size'] = wp_filter_nohtml_kses( $input['headline_font_size'] );
  $input['headline_font_size_sp'] = wp_filter_nohtml_kses( $input['headline_font_size_sp'] );

  if ( ! isset( $input['sub_headline_font_type'] ) )
    $input['sub_headline_font_type'] = null;
  if ( ! array_key_exists( $input['sub_headline_font_type'], $font_type_options ) )
    $input['sub_headline_font_type'] = null;
  $input['sub_headline_font_size'] = wp_filter_nohtml_kses( $input['sub_headline_font_size'] );
  $input['sub_headline_font_size_sp'] = wp_filter_nohtml_kses( $input['sub_headline_font_size_sp'] );
  $input['single_title_font_size'] = wp_filter_nohtml_kses( $input['single_title_font_size'] );
  $input['single_title_font_size_sp'] = wp_filter_nohtml_kses( $input['single_title_font_size_sp'] );

  // ボタン
  $input['design_button_type'] = wp_filter_nohtml_kses( $input['design_button_type'] );
  $input['design_button_border_radius'] = wp_filter_nohtml_kses( $input['design_button_border_radius'] );
  $input['design_button_size'] = wp_filter_nohtml_kses( $input['design_button_size'] );
  $input['design_button_animation_type'] = wp_filter_nohtml_kses( $input['design_button_animation_type'] );
  $input['design_button_color'] = wp_filter_nohtml_kses( $input['design_button_color'] );
  $input['design_button_color_hover'] = wp_filter_nohtml_kses( $input['design_button_color_hover'] );


  // アニメーションの設定
  if ( ! isset( $input['hover_type'] ) )
    $input['hover_type'] = null;
  if ( ! array_key_exists( $input['hover_type'], $hover_type_options ) )
    $input['hover_type'] = null;
  $input['hover1_zoom'] = wp_filter_nohtml_kses( $input['hover1_zoom'] );
  $input['hover2_zoom'] = wp_filter_nohtml_kses( $input['hover2_zoom'] );
  if ( ! isset( $input['hover3_direct'] ) )
    $input['hover3_direct'] = null;
  if ( ! array_key_exists( $input['hover3_direct'], $hover3_direct_options ) )
    $input['hover3_direct'] = null;
  $input['hover3_opacity'] = wp_filter_nohtml_kses( $input['hover3_opacity'] );
  $input['hover3_bgcolor'] = sanitize_hex_color( $input['hover3_bgcolor'] );
  $input['hover4_opacity'] = wp_filter_nohtml_kses( $input['hover4_opacity'] );
  $input['hover4_bgcolor'] = sanitize_hex_color( $input['hover4_bgcolor'] );


  // オリジナルスタイルの設定
  $input['css_code'] = $input['css_code'];


  // オリジナルスクリプトの設定
  $input['script_code'] = $input['script_code'];


  // ロード画面
  $input['show_loading'] = ! empty( $input['show_loading'] ) ? 1 : 0;
  if ( ! isset( $input['loading_type'] ) )
    $input['loading_type'] = null;
  if ( ! array_key_exists( $input['loading_type'], $loading_type ) )
    $input['loading_type'] = null;

  // シンプル
  $input['loading_icon_color'] = sanitize_hex_color( $input['loading_icon_color'] );

  // ロゴ
  $input['loading_logo_image'] = absint( $input['loading_logo_image'] );
  $input['show_loading'] = ! empty( $input['show_loading'] ) ? 1 : 0;
  if ( ! isset( $input['loading_logo_retina'] ) )
    $input['loading_logo_retina'] = null;
  if ( ! array_key_exists( $input['loading_logo_retina'], $bool_options ) )
    $input['loading_logo_retina'] = null;
  $input['loading_logo_image_sp'] = absint( $input['loading_logo_image_sp'] );
  $input['show_loading'] = ! empty( $input['show_loading'] ) ? 1 : 0;
  if ( ! isset( $input['loading_logo_retina_sp'] ) )
    $input['loading_logo_retina_sp'] = null;
  if ( ! array_key_exists( $input['loading_logo_retina_sp'], $bool_options ) )
    $input['loading_logo_retina_sp'] = null;

  // キャッチフレーズ
  $input['loading_catch'] = wp_filter_nohtml_kses( $input['loading_catch'] );
  if ( ! isset( $input['loading_catch_font_type'] ) )
    $input['loading_catch_font_type'] = null;
  if ( ! array_key_exists( $input['loading_catch_font_type'], $font_type_options ) )
    $input['loading_catch_font_type'] = null;
  $input['loading_catch_font_size'] = absint( $input['loading_catch_font_size'] );
  $input['loading_catch_font_size_sp'] = absint( $input['loading_catch_font_size_sp'] );
  $input['loading_catch_font_color'] = sanitize_hex_color( $input['loading_catch_font_color'] );

  // 共通
  $input['loading_bg_color'] = sanitize_hex_color( $input['loading_bg_color'] );
  if ( ! isset( $input['loading_display_page'] ) )
    $input['loading_display_page'] = null;
  if ( ! array_key_exists( $input['loading_display_page'], $font_type_options ) )
    $input['loading_display_page'] = null;
  if ( ! isset( $input['loading_display_time'] ) )
    $input['loading_display_time'] = null;
  if ( ! array_key_exists( $input['loading_display_time'], $loading_display_time_options ) )
    $input['loading_display_time'] = null;

  // ロード画面ここまで

  // NO IMAGE
  $input['no_image1'] = wp_filter_nohtml_kses( $input['no_image1'] );


  // ソーシャルシェアボタン
  $input['sns_share_design_type'] = wp_filter_nohtml_kses( $input['sns_share_design_type'] );
  $input['show_sns_share_twitter'] = ! empty( $input['show_sns_share_twitter'] ) ? 1 : 0;
  $input['show_sns_share_fblike'] = ! empty( $input['show_sns_share_fblike'] ) ? 1 : 0;
  $input['show_sns_share_fbshare'] = ! empty( $input['show_sns_share_fbshare'] ) ? 1 : 0;
  $input['show_sns_share_hatena'] = ! empty( $input['show_sns_share_hatena'] ) ? 1 : 0;
  $input['show_sns_share_pocket'] = ! empty( $input['show_sns_share_pocket'] ) ? 1 : 0;
  $input['show_sns_share_feedly'] = ! empty( $input['show_sns_share_feedly'] ) ? 1 : 0;
  $input['show_sns_share_rss'] = ! empty( $input['show_sns_share_rss'] ) ? 1 : 0;
  $input['show_sns_share_pinterest'] = ! empty( $input['show_sns_share_pinterest'] ) ? 1 : 0;
  $input['twitter_info'] = wp_filter_nohtml_kses( $input['twitter_info'] );

  // ソーシャルボタン
  $input['sns_button_color_type'] = wp_filter_nohtml_kses( $input['sns_button_color_type'] );
  $input['sns_button_facebook_url'] = wp_filter_nohtml_kses( $input['sns_button_facebook_url'] );
  $input['sns_button_twitter_url'] = wp_filter_nohtml_kses( $input['sns_button_twitter_url'] );
  $input['sns_button_instagram_url'] = wp_filter_nohtml_kses( $input['sns_button_instagram_url'] );
  $input['sns_button_pinterest_url'] = wp_filter_nohtml_kses( $input['sns_button_pinterest_url'] );
  $input['sns_button_youtube_url'] = wp_filter_nohtml_kses( $input['sns_button_youtube_url'] );
  $input['sns_button_contact_url'] = wp_filter_nohtml_kses( $input['sns_button_contact_url'] );
  $input['sns_button_show_rss'] = ! empty( $input['sns_button_show_rss'] ) ? 1 : 0;

  $input['show_sns_footer'] = wp_filter_nohtml_kses( $input['show_sns_footer'] );


  // 検索の対象
  $input['search_type_post'] = wp_filter_nohtml_kses( $input['search_type_post'] );
  $input['search_type_page'] = wp_filter_nohtml_kses( $input['search_type_page'] );
  $input['search_type_news'] = wp_filter_nohtml_kses( $input['search_type_news'] );
  $input['search_type_work'] = wp_filter_nohtml_kses( $input['search_type_work'] );
  $input['search_result_no_post_label'] = wp_kses_post( $input['search_result_no_post_label'] );


  // 404 ページ
  $input['page_404_catch'] = wp_filter_nohtml_kses( $input['page_404_catch'] );
  $input['page_404_desc'] = wp_kses_post( $input['page_404_desc'] );
  $input['page_404_bg_image'] = wp_filter_nohtml_kses( $input['page_404_bg_image'] );
  $input['page_404_overlay_color'] = wp_filter_nohtml_kses( $input['page_404_overlay_color'] );
  $input['page_404_overlay_opacity'] = wp_filter_nohtml_kses( $input['page_404_overlay_opacity'] );


  return $input;

};


?>