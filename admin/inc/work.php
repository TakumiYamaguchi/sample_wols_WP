<?php
/*
 * ワークスの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_work_dp_default_options' );


// Add label of logo tab
add_action( 'tcd_tab_labels', 'add_work_tab_label' );


// Add HTML of logo tab
add_action( 'tcd_tab_panel', 'add_work_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_work_theme_options_validate' );


// タブの名前
function add_work_tab_label( $tab_labels ) {
  $options = get_design_plus_option();
  $tab_label = $options['work_label'] ? esc_html( $options['work_label'] ) : __( 'Work', 'tcd-horizon' );
  $tab_labels['work'] = $tab_label;
  return $tab_labels;
}


// 初期値
function add_work_dp_default_options( $dp_default_options ) {

	// 基本設定
	$dp_default_options['work_label'] = __( 'Work', 'tcd-horizon' );
	$dp_default_options['work_slug'] = 'work';
	$dp_default_options['work_headline_font_type'] = 'type2';

	// アーカイブページ
	$dp_default_options['archive_work_bg_image'] = false;
	$dp_default_options['archive_work_overlay_color'] = '#000000';
	$dp_default_options['archive_work_overlay_opacity'] = '0.3';

	$dp_default_options['archive_work_headline'] = 'WORKS';

	$dp_default_options['archive_work_desc1'] = '';
	$dp_default_options['archive_work_desc2'] = '';
	$dp_default_options['archive_work_desc3'] = '';

	$dp_default_options['archive_work_title_font_size'] = '22';
	$dp_default_options['archive_work_title_font_size_sp'] = '16';
	$dp_default_options['archive_work_list_overlay_color'] = '#000000';
	$dp_default_options['archive_work_list_overlay_opacity'] = '0.2';
	$dp_default_options['archive_work_list_bg_image'] = false;

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_work_tab_panel( $options ) {

  global $dp_default_options, $font_type_options;
  $work_label = $options['work_label'] ? esc_html( $options['work_label'] ) : __( 'Work', 'tcd-horizon' );

?>

<div id="tab-content-work" class="tab-content">


   <?php // 基本設定 -------------------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Common setting', 'tcd-horizon');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e('Name of content', 'tcd-horizon');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('This name will also be used in breadcrumb link.', 'tcd-horizon'); ?></p>
     </div>
     <input class="regular-text" type="text" name="dp_options[work_label]" value="<?php echo esc_attr( $options['work_label'] ); ?>" />

     <h4 class="theme_option_headline2"><?php _e('Slug', 'tcd-horizon');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please enter word by alphabet only.<br />After changing slug, please update permalink setting form <a href="./options-permalink.php"><strong>permalink option page</strong></a>.', 'tcd-horizon'); ?></p>
     </div>
     <p><input class="hankaku regular-text" type="text" name="dp_options[work_slug]" value="<?php echo sanitize_title( $options['work_slug'] ); ?>" /></p>

     <h4 class="theme_option_headline2"><?php _e('Font type', 'tcd-horizon');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Font type will be applyed to archive page, single page headline and title.', 'tcd-horizon');  ?></p>
     </div>
     <p><?php echo tcd_basic_radio_button($options, 'work_headline_font_type', $font_type_options); ?></p>
     <br style="clear:both;">

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml" value="<?php echo __( 'Save Changes', 'tcd-horizon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // アーカイブページ ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php printf(__('%s list page', 'tcd-horizon'), $work_label); ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php echo __('Headline', 'tcd-horizon'); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('You can set font size and font type of headline from basic setting menu in theme option page.', 'tcd-horizon');  ?></p>
     </div>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Headline', 'tcd-horizon');  ?></span><input type="text" class="full_width" name="dp_options[archive_work_headline]" value="<?php echo esc_attr($options['archive_work_headline']); ?>"></li>
      <li class="cf">
       <span class="label"><?php _e('Background image', 'tcd-horizon');  ?></span>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js archive_work_bg_image">
         <input type="hidden" value="<?php echo esc_attr( $options['archive_work_bg_image'] ); ?>" id="archive_work_bg_image" name="dp_options[archive_work_bg_image]" class="cf_media_id">
         <div class="preview_field"><?php if($options['archive_work_bg_image']){ echo wp_get_attachment_image($options['archive_work_bg_image'], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-horizon'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-horizon'); ?>" class="cfmf-delete-img button <?php if(!$options['archive_work_bg_image']){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>
       <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '966', '1100'); ?></p>
       </div>
      </li>
      <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-horizon'); ?></span><input type="text" name="dp_options[archive_work_overlay_color]" value="<?php echo esc_attr( $options['archive_work_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      <li class="cf">
       <span class="label"><?php _e('Transparency of overlay', 'tcd-horizon'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[archive_work_overlay_opacity]" value="<?php echo esc_attr( $options['archive_work_overlay_opacity'] ); ?>" />
       <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-horizon');  ?></p>
        <p><?php _e('Please enter 0 if you don\'t want to use overlay.', 'tcd-horizon');  ?></p>
       </div>
      </li>
     </ul>

     <h4 class="theme_option_headline2"><?php echo __('Description', 'tcd-horizon'); ?></h4>
     <ul class="option_list">
      <li class="cf">
       <span class="label"><?php _e('Left edge of the page', 'tcd-horizon');  ?></span>
       <textarea class="full_width" cols="50" rows="3" name="dp_options[archive_work_desc1]"><?php echo esc_textarea( $options['archive_work_desc1'] ); ?></textarea>
      </li>
      <li class="cf">
       <span class="label"><?php _e('Under headline', 'tcd-horizon');  ?></span>
       <textarea class="full_width" cols="50" rows="3" name="dp_options[archive_work_desc2]"><?php echo esc_textarea( $options['archive_work_desc2'] ); ?></textarea>
      </li>
      <li class="cf">
       <span class="label"><?php _e('Right edge of the page', 'tcd-horizon');  ?></span>
       <textarea class="full_width" cols="50" rows="3" name="dp_options[archive_work_desc3]"><?php echo esc_textarea( $options['archive_work_desc3'] ); ?></textarea>
      </li>
     </ul>

     <h4 class="theme_option_headline2"><?php printf(__('%s list', 'tcd-horizon'), $work_label); ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font size of title', 'tcd-horizon'); ?></span><?php echo tcd_font_size_option($options, 'archive_work_title_font_size'); ?></li>
      <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-horizon'); ?></span><input type="text" name="dp_options[archive_work_list_overlay_color]" value="<?php echo esc_attr( $options['archive_work_list_overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      <li class="cf">
       <span class="label"><?php _e('Transparency of overlay', 'tcd-horizon'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="dp_options[archive_work_list_overlay_opacity]" value="<?php echo esc_attr( $options['archive_work_list_overlay_opacity'] ); ?>" />
       <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0.1 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-horizon');  ?></p>
       </div>
      </li>
      <li class="cf">
       <span class="label"><?php printf(__('Image displayed at the end of the %s list', 'tcd-horizon'), $work_label);  ?></span>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js archive_work_list_bg_image">
         <input type="hidden" value="<?php echo esc_attr( $options['archive_work_list_bg_image'] ); ?>" id="archive_work_list_bg_image" name="dp_options[archive_work_list_bg_image]" class="cf_media_id">
         <div class="preview_field"><?php if($options['archive_work_list_bg_image']){ echo wp_get_attachment_image($options['archive_work_list_bg_image'], 'medium'); }; ?></div>
         <div class="buttton_area">
          <input type="button" value="<?php _e('Select Image', 'tcd-horizon'); ?>" class="cfmf-select-img button">
          <input type="button" value="<?php _e('Remove Image', 'tcd-horizon'); ?>" class="cfmf-delete-img button <?php if(!$options['archive_work_list_bg_image']){ echo 'hidden'; }; ?>">
         </div>
        </div>
       </div>
       <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '483', '1100'); ?></p>
       </div>
      </li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-horizon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


</div><!-- END .tab-content -->

<?php
} // END add_work_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_work_theme_options_validate( $input ) {

  global $dp_default_options, $font_type_options;

  //基本設定
  $input['work_slug'] = sanitize_title( $input['work_slug'] );
  $input['work_label'] = wp_filter_nohtml_kses( $input['work_label'] );
  $input['work_headline_font_type'] = wp_filter_nohtml_kses( $input['work_headline_font_type'] );


  // アーカイブ
  $input['archive_work_bg_image'] = wp_filter_nohtml_kses( $input['archive_work_bg_image'] );
  $input['archive_work_overlay_color'] = wp_filter_nohtml_kses( $input['archive_work_overlay_color'] );
  $input['archive_work_overlay_opacity'] = wp_filter_nohtml_kses( $input['archive_work_overlay_opacity'] );

  $input['archive_work_headline'] = wp_filter_nohtml_kses( $input['archive_work_headline'] );
  $input['archive_work_desc1'] = wp_filter_nohtml_kses( $input['archive_work_desc1'] );
  $input['archive_work_desc2'] = wp_filter_nohtml_kses( $input['archive_work_desc2'] );
  $input['archive_work_desc3'] = wp_filter_nohtml_kses( $input['archive_work_desc3'] );

  $input['archive_work_title_font_size'] = wp_filter_nohtml_kses( $input['archive_work_title_font_size'] );
  $input['archive_work_title_font_size_sp'] = wp_filter_nohtml_kses( $input['archive_work_title_font_size_sp'] );
  $input['archive_work_list_bg_image'] = wp_filter_nohtml_kses( $input['archive_work_list_bg_image'] );
  $input['archive_work_list_overlay_color'] = wp_filter_nohtml_kses( $input['archive_work_list_overlay_color'] );
  $input['archive_work_list_overlay_opacity'] = wp_filter_nohtml_kses( $input['archive_work_list_overlay_opacity'] );

	return $input;

};


?>