<?php
/*
 * SEOの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_seo_dp_default_options' );


//  Add label of seo tab
add_action( 'tcd_tab_labels', 'add_seo_tab_label' );


// Add HTML of seo tab
add_action( 'tcd_tab_panel', 'add_seo_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_seo_theme_options_validate' );


// タブの名前
function add_seo_tab_label( $tab_labels ) {
	$tab_labels['seo'] = __( 'SEO', 'tcd-horizon' );
	return $tab_labels;
}


// 初期値
function add_seo_dp_default_options( $dp_default_options ) {

  // SEO
	$dp_default_options['front_page_meta_title'] = '';
	$dp_default_options['front_page_meta_description'] = '';
	$dp_default_options['blog_archive_meta_title'] = '';
	$dp_default_options['blog_archive_meta_description'] = '';
	$dp_default_options['news_archive_meta_title'] = '';
	$dp_default_options['news_archive_meta_description'] = '';
	$dp_default_options['menu_archive_meta_title'] = '';
	$dp_default_options['menu_archive_meta_description'] = '';
	$dp_default_options['work_archive_meta_title'] = '';
	$dp_default_options['work_archive_meta_description'] = '';

	// 高速化機能
	$dp_default_options['use_emoji'] = 0;
	$dp_default_options['use_js_optimization'] = 0;
	$dp_default_options['use_css_optimization'] = 0;
	$dp_default_options['use_html_optimization'] = 0;

	// Facebook OGPの設定
	$dp_default_options['use_ogp'] = 0;
	$dp_default_options['fb_app_id'] = '';
	$dp_default_options['ogp_image'] = '';

	// Twitter Cardsの設定
	$dp_default_options['use_twitter_card'] = 0;
	$dp_default_options['twitter_account_name'] = '';

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_seo_tab_panel( $options ) {

  global $dp_default_options;

  $blog_label = $options['blog_label'] ? esc_html( $options['blog_label'] ) : __( 'Blog', 'tcd-horizon' );
  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-horizon' );
  $work_label = $options['work_label'] ? esc_html( $options['work_label'] ) : __( 'Work', 'tcd-horizon' );

?>

<div id="tab-content-seo" class="tab-content">

   <?php // SEO ----------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Meta tag', 'tcd-horizon');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="theme_option_message2" style="margin-top:20px;">
      <p>
       <?php _e('You can set individual meta tags for the front page and archive pages.', 'tcd-horizon'); ?></br>
       <?php _e('If not entered, the site\'s title, catchphrase, etc. will be reflected.', 'tcd-horizon'); ?></br>
       <?php _e('You can edit meta tags for single pages and taxonomy pages from the respective editing screens.', 'tcd-horizon'); ?>
      </p>
     </div>

     <div class="sub_box cf"> 
      <h3 class="theme_option_subbox_headline"><?php _e('Front page', 'tcd-horizon');  ?></h3>
      <div class="sub_box_content">
       <h4 class="theme_option_headline2"><?php _e( 'Title tag', 'tcd-horizon' ); ?></h4>
       <input type="text" class="full_width" name="dp_options[front_page_meta_title]" value="<?php echo esc_textarea(  $options['front_page_meta_title'] ); ?>" />
       <h4 class="theme_option_headline2"><?php _e( 'Meta description tag', 'tcd-horizon' ); ?></h4>
       <textarea class="full_width word_count" cols="50" rows="4" name="dp_options[front_page_meta_description]"><?php echo esc_textarea(  $options['front_page_meta_description'] ); ?></textarea>
       <p class="word_count_result"><?php _e( 'Current character is : <span>0</span>', 'tcd-horizon' ); ?></p>
      </div>
     </div>

     <div class="sub_box cf"> 
      <h3 class="theme_option_subbox_headline"><?php _e('Post archive page', 'tcd-horizon');  ?></h3>
      <div class="sub_box_content">
       <h4 class="theme_option_headline2"><?php _e( 'Title tag', 'tcd-horizon' ); ?></h4>
       <input type="text" class="full_width" name="dp_options[blog_archive_meta_title]" value="<?php echo esc_textarea(  $options['blog_archive_meta_title'] ); ?>" />
       <h4 class="theme_option_headline2"><?php _e( 'Meta description tag', 'tcd-horizon' ); ?></h4>
       <textarea class="full_width word_count" cols="50" rows="4" name="dp_options[blog_archive_meta_description]"><?php echo esc_textarea(  $options['blog_archive_meta_description'] ); ?></textarea>
       <p class="word_count_result"><?php _e( 'Current character is : <span>0</span>', 'tcd-horizon' ); ?></p>
      </div>
     </div>

     <div class="sub_box cf"> 
      <h3 class="theme_option_subbox_headline"><?php printf(__('%s archive page', 'tcd-horizon'), $news_label);  ?></h3>
      <div class="sub_box_content">
       <h4 class="theme_option_headline2"><?php _e( 'Title tag', 'tcd-horizon' ); ?></h4>
       <input type="text" class="full_width" name="dp_options[news_archive_meta_title]" value="<?php echo esc_textarea(  $options['news_archive_meta_title'] ); ?>" />
       <h4 class="theme_option_headline2"><?php _e( 'Meta description tag', 'tcd-horizon' ); ?></h4>
       <textarea class="full_width word_count" cols="50" rows="4" name="dp_options[news_archive_meta_description]"><?php echo esc_textarea(  $options['news_archive_meta_description'] ); ?></textarea>
       <p class="word_count_result"><?php _e( 'Current character is : <span>0</span>', 'tcd-horizon' ); ?></p>
      </div>
     </div>

     <div class="sub_box cf"> 
      <h3 class="theme_option_subbox_headline"><?php printf(__('%s archive page', 'tcd-horizon'), $work_label);  ?></h3>
      <div class="sub_box_content">
       <h4 class="theme_option_headline2"><?php _e( 'Title tag', 'tcd-horizon' ); ?></h4>
       <input type="text" class="full_width" name="dp_options[work_archive_meta_title]" value="<?php echo esc_textarea(  $options['work_archive_meta_title'] ); ?>" />
       <h4 class="theme_option_headline2"><?php _e( 'Meta description tag', 'tcd-horizon' ); ?></h4>
       <textarea class="full_width word_count" cols="50" rows="4" name="dp_options[work_archive_meta_description]"><?php echo esc_textarea(  $options['work_archive_meta_description'] ); ?></textarea>
       <p class="word_count_result"><?php _e( 'Current character is : <span>0</span>', 'tcd-horizon' ); ?></p>
      </div>
     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-horizon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->

   <?php // Facebook OGP ------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Facebook OGP', 'tcd-horizon');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="theme_option_message2" style="margin-top:20px;">
      <p><?php _e('OGP is a mechanism for correctly conveying page information.', 'tcd-horizon'); ?></p>
     </div>

     <p class="displayment_checkbox"><label><input name="dp_options[use_ogp]" type="checkbox" value="1" <?php checked( $options['use_ogp'], 1 ); ?>><?php _e( 'Use OGP', 'tcd-horizon' ); ?></label></p>
     <div style="<?php if($options['use_ogp'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

      <h4 class="theme_option_headline2"><?php _e( 'OGP', 'tcd-horizon' ); ?></h4>
      <ul class="option_list">
       <li class="cf">
        <span class="label"><?php _e('Your app ID', 'tcd-horizon'); ?></span><input class="full_width" type="text" name="dp_options[fb_app_id]" value="<?php echo esc_attr( $options['fb_app_id'] ); ?>" />
        <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
         <p><?php _e( 'In order to use Facebook Insights please set your app ID.', 'tcd-horizon' ); ?></p>
        </div>
       </li>
       <li class="cf">
        <span class="label"><?php _e('OGP image', 'tcd-horizon'); ?></span>
        <div class="image_box cf">
         <div class="cf cf_media_field hide-if-no-js">
          <input type="hidden" value="<?php echo esc_attr( $options['ogp_image'] ); ?>" id="ogp_image" name="dp_options[ogp_image]" class="cf_media_id">
          <div class="preview_field"><?php if ( $options['ogp_image'] ) { echo wp_get_attachment_image( $options['ogp_image'], 'medium'); } ?></div>
          <div class="button_area">
           <input type="button" value="<?php _e( 'Select Image', 'tcd-horizon' ); ?>" class="cfmf-select-img button">
           <input type="button" value="<?php _e( 'Remove Image', 'tcd-horizon' ); ?>" class="cfmf-delete-img button <?php if ( ! $options['ogp_image'] ) { echo 'hidden'; } ?>">
          </div>
         </div>
        </div>
        <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
         <p><?php _e( 'This image is displayed for OGP if the page does not have a thumbnail.', 'tcd-horizon' ); ?></p>
         <p><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '1200', '630'); ?></p>
        </div>
       </li>
      </ul>

     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-horizon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->

   <?php // Twitterカード ------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Twitter Cards', 'tcd-horizon');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="theme_option_message2" style="margin-top:20px;">
      <p><?php _e('This theme requires Facebook OGP settings to use Twitter cards.', 'tcd-horizon'); ?></p>
      <p><a href="http://design-plus1.com/tcd-w/2016/11/twitter-cards.html" target="_blank"><?php _e( 'Information about Twitter Cards.', 'tcd-horizon' ); ?></a></p>
     </div>

     <p class="displayment_checkbox"><label><input name="dp_options[use_twitter_card]" type="checkbox" value="1" <?php checked( $options['use_twitter_card'], 1 ); ?>><?php _e( 'Use Twitter Cards', 'tcd-horizon' ); ?></label></p>
     <div style="<?php if($options['use_ogp'] == 1) { echo 'display:use_twitter_card;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list" style="border-top:1px dotted #ccc; padding-top:12px;">
       <li class="cf"><span class="label"><?php _e('Your Twitter account name (exclude @ mark)', 'tcd-horizon'); ?></span><input class="full_width" type="text" name="dp_options[twitter_account_name]" value="<?php echo esc_attr( $options['twitter_account_name'] ); ?>" /></li>
      </ul>
     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-horizon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->

   <?php // 高速化 ------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Acceleration', 'tcd-horizon');  ?></h3>
    <div class="theme_option_field_ac_content">

     <h4 class="theme_option_headline2"><?php _e( 'Emoji', 'tcd-horizon' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( "We recommend to checkoff this option if you dont use any Emoji in your post content.", 'tcd-horizon' ); ?></p>
     </div>
     <p><label><input name="dp_options[use_emoji]" type="checkbox" value="1" <?php checked( 1, $options['use_emoji'] ); ?>><?php _e( 'Use emoji', 'tcd-horizon' ); ?></label></p>

     <h4 class="theme_option_headline2"><?php _e( 'Optimization', 'tcd-horizon' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e( 'Check here to remove margins and line breaks in JavaScript.', 'tcd-horizon' ); ?></p>
     </div>
     <p><label><input name="dp_options[use_js_optimization]" type="checkbox" value="1" <?php checked( 1, $options['use_js_optimization'] ); ?>> <?php _e( 'Use JavaScript optimization', 'tcd-horizon' ); ?></label></p>
     <div class="theme_option_message2">
      <p><?php _e( 'Check here to remove margins and line breaks in CSS.<br>It also improves the loading speed by generating a page common CSS cache file.<br>* This specification does not apply to external CSS (CDN, etc.).', 'tcd-horizon' ); ?></p>
     </div>
     <p><label><input name="dp_options[use_css_optimization]" type="checkbox" value="1" <?php checked( 1, $options['use_css_optimization'] ); ?>> <?php _e( 'Use CSS optimization', 'tcd-horizon' ); ?></label></p>
     <div class="theme_option_message2">
      <p><?php _e( 'Check here to remove margins and line breaks in HTML.', 'tcd-horizon' ); ?></p>
     </div>
     <p><label><input name="dp_options[use_html_optimization]" type="checkbox" value="1" <?php checked( 1, $options['use_html_optimization'] ); ?>> <?php _e( 'Use HTML optimization', 'tcd-horizon' ); ?></label></p>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-horizon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->

</div><!-- END .tab-content -->

<?php
} // END add_seo_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_seo_theme_options_validate( $input ) {

  global $dp_default_options;

  // 高速化機能
  $input['use_emoji'] = ! empty( $input['use_emoji'] ) ? 1 : 0;
  $input['use_js_optimization'] = ! empty( $input['use_js_optimization'] ) ? 1 : 0;
  $input['use_css_optimization'] = ! empty( $input['use_css_optimization'] ) ? 1 : 0;
  $input['use_html_optimization'] = ! empty( $input['use_html_optimization'] ) ? 1 : 0;


  // meta tag
  $input['front_page_meta_title'] = wp_filter_nohtml_kses( $input['front_page_meta_title'] );
  $input['front_page_meta_description'] = wp_filter_nohtml_kses( $input['front_page_meta_description'] );
  $input['blog_archive_meta_title'] = wp_filter_nohtml_kses( $input['blog_archive_meta_title'] );
  $input['blog_archive_meta_description'] = wp_filter_nohtml_kses( $input['blog_archive_meta_description'] );
  $input['news_archive_meta_title'] = wp_filter_nohtml_kses( $input['news_archive_meta_title'] );
  $input['news_archive_meta_description'] = wp_filter_nohtml_kses( $input['news_archive_meta_description'] );
  $input['menu_archive_meta_title'] = wp_filter_nohtml_kses( $input['menu_archive_meta_title'] );
  $input['menu_archive_meta_description'] = wp_filter_nohtml_kses( $input['menu_archive_meta_description'] );
  $input['work_archive_meta_title'] = wp_filter_nohtml_kses( $input['work_archive_meta_title'] );
  $input['work_archive_meta_description'] = wp_filter_nohtml_kses( $input['work_archive_meta_description'] );


  // Facebook OGPの設定
  $input['use_ogp'] = ! empty( $input['use_ogp'] ) ? 1 : 0;
  $input['ogp_image'] = wp_filter_nohtml_kses( $input['ogp_image'] );
  $input['fb_app_id'] = wp_filter_nohtml_kses( $input['fb_app_id'] );


  // Twitter Cardsの設定
  $input['use_twitter_card'] = ! empty( $input['use_twitter_card'] ) ? 1 : 0;
  $input['twitter_account_name'] = wp_filter_nohtml_kses( $input['twitter_account_name'] );


	return $input;

};


?>