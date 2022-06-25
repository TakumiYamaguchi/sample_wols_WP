<?php
/*
 * ヘッダーの設定
 */


// Add default values
add_filter( 'before_getting_design_plus_option', 'add_header_dp_default_options' );


// Add label of logo tab
add_action( 'tcd_tab_labels', 'add_header_tab_label' );


// Add HTML of logo tab
add_action( 'tcd_tab_panel', 'add_header_tab_panel' );


// Register sanitize function
add_filter( 'theme_options_validate', 'add_header_theme_options_validate' );


// タブの名前
function add_header_tab_label( $tab_labels ) {
	$tab_labels['header'] = __( 'Header', 'tcd-horizon' );
	return $tab_labels;
}


// 初期値
function add_header_dp_default_options( $dp_default_options ) {

  //ヘッダーロゴ
	$dp_default_options['header_logo_type'] = 'type1';
	$dp_default_options['header_logo_font_size'] = '32';
	$dp_default_options['header_logo_font_size_sp'] = '24';
	$dp_default_options['header_logo_font_type'] = 'type2';
	$dp_default_options['header_logo_image'] = false;
	$dp_default_options['header_logo_retina'] = 'no';
	$dp_default_options['header_logo_image_mobile'] = false;
	$dp_default_options['header_logo_retina_mobile'] = 'no';

  //言語ボタン
	$dp_default_options['show_lang_button'] = '';
	$dp_default_options['lang_button'] = array();

  //検索フォーム
	$dp_default_options['show_header_search'] = '';

  // モバイル用メニュー
	$dp_default_options['drawer_menu_show_search'] = 'hide';
	$dp_default_options['drawer_menu_show_sns'] = 'hide';
	$dp_default_options['drawer_menu_show_lang'] = 'hide';

  // メガメニュー
	$dp_default_options['mega_menu_a_post_num'] = '6';
	$dp_default_options['mega_menu_a_post_order'] = 'date';
  $dp_default_options['megamenu'] = array();

  // メッセージ
	$dp_default_options['show_header_message'] = '';
	$dp_default_options['header_message'] = __('Header message', 'tcd-horizon');
  $dp_default_options['header_message_url'] = '#';
  $dp_default_options['header_message_font_color'] = '#ffffff';
  $dp_default_options['header_message_bg_color'] = '#bf9d87';

	return $dp_default_options;

}


// 入力欄の出力　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_header_tab_panel( $options ) {

  global $dp_default_options, $header_fix_options, $header_fix_options2, $content_width_options, $font_type_options, $logo_type_options, $megamenu_options, $basic_display_options, $bool_options;
  $work_label = $options['work_label'] ? esc_html( $options['work_label'] ) : __( 'Work', 'tcd-horizon' );

?>

<div id="tab-content-header" class="tab-content">


   <?php // ヘッダーのロゴの設定 ----------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header logo', 'tcd-horizon');  ?></h3>
    <div class="theme_option_field_ac_content">
     <h4 class="theme_option_headline2"><?php _e('Type of logo', 'tcd-horizon');  ?></h4>
     <?php echo tcd_admin_image_radio_button($options, 'header_logo_type', $logo_type_options) ?>

     <div id="header_logo_type1_area">
      <h4 class="theme_option_headline2"><?php _e('Font size', 'tcd-horizon');  ?></h4>
      <ul class="option_list">
       <li class="cf"><span class="label"><?php echo tcd_admin_label('font_type'); ?></span><?php echo tcd_basic_radio_button($options, 'header_logo_font_type', $font_type_options); ?></li>
       <li class="cf"><span class="label"><?php _e('Font size', 'tcd-horizon'); ?></span><?php echo tcd_font_size_option($options, 'header_logo_font_size'); ?></li>
      </ul>
     </div>

     <div id="header_logo_type2_area">
      <h4 class="theme_option_headline2"><?php _e('Logo image', 'tcd-horizon');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('Please select "Yes" for the radio button below if you upload logo image for the retina display.','tcd-horizon'); ?></p>
      </div>
      <ul class="option_list">
       <li class="cf">
        <span class="label"><?php _e('Image', 'tcd-horizon'); ?></span>
        <div class="image_box cf">
         <div class="cf cf_media_field hide-if-no-js header_logo_image">
          <input type="hidden" value="<?php echo esc_attr( $options['header_logo_image'] ); ?>" id="header_logo_image" name="dp_options[header_logo_image]" class="cf_media_id">
          <div class="preview_field"><?php if($options['header_logo_image']){ echo wp_get_attachment_image($options['header_logo_image'], 'full'); }; ?></div>
          <div class="buttton_area">
           <input type="button" value="<?php _e('Select Image', 'tcd-horizon'); ?>" class="cfmf-select-img button">
           <input type="button" value="<?php _e('Remove Image', 'tcd-horizon'); ?>" class="cfmf-delete-img button <?php if(!$options['header_logo_image']){ echo 'hidden'; }; ?>">
          </div>
         </div>
        </div>
       </li>
       <li class="cf"><span class="label"><?php _e('Use retina display image', 'tcd-horizon'); ?></span><?php echo tcd_basic_radio_button($options, 'header_logo_retina', $bool_options); ?></li>
       <li class="cf">
        <span class="label"><?php _e('Image (mobile)', 'tcd-horizon'); ?></span>
        <div class="image_box cf">
         <div class="cf cf_media_field hide-if-no-js header_logo_image_mobile">
          <input type="hidden" value="<?php echo esc_attr( $options['header_logo_image_mobile'] ); ?>" id="header_logo_image_mobile" name="dp_options[header_logo_image_mobile]" class="cf_media_id">
          <div class="preview_field"><?php if($options['header_logo_image_mobile']){ echo wp_get_attachment_image($options['header_logo_image_mobile'], 'full'); }; ?></div>
          <div class="buttton_area">
           <input type="button" value="<?php _e('Select Image', 'tcd-horizon'); ?>" class="cfmf-select-img button">
           <input type="button" value="<?php _e('Remove Image', 'tcd-horizon'); ?>" class="cfmf-delete-img button <?php if(!$options['header_logo_image_mobile']){ echo 'hidden'; }; ?>">
          </div>
         </div>
        </div>
       </li>
       <li class="cf"><span class="label"><?php _e('Use retina display image', 'tcd-horizon'); ?></span><?php echo tcd_basic_radio_button($options, 'header_logo_retina_mobile', $bool_options); ?></li>
      </ul>
     </div>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-horizon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // その他の設定 ----------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Other setting', 'tcd-horizon');  ?></h3>
    <div class="theme_option_field_ac_content">

     <?php // 言語ボタン ----------------------------------------------------------------- ?>
     <h4 class="theme_option_headline2"><?php _e('Language button', 'tcd-horizon');  ?></h4>
     <p class="displayment_checkbox"><label><input name="dp_options[show_lang_button]" type="checkbox" value="1" <?php checked( $options['show_lang_button'], 1 ); ?>><?php _e( 'Display language button', 'tcd-horizon' ); ?></label></p>
     <div style="<?php if($options['show_lang_button'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <div class="theme_option_message2">
       <p><?php _e('Displays a link button to a multilingual site. (example: JP / EN, etc)', 'tcd-horizon');  ?><br>
       <?php _e('Click add item button to start this option.<br />You can change order by dragging each headline of option field.', 'tcd-horizon');  ?></p>
      </div>
      <?php //繰り返しフィールド ----- ?>
      <div class="repeater-wrapper">
       <input type="hidden" name="dp_options[lang_button]" value="">
       <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-horizon' ); ?>">
        <?php
             if ( $options['lang_button'] ) :
               foreach ( $options['lang_button'] as $key => $value ) :
        ?>
        <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $key ); ?>">
         <h4 class="theme_option_subbox_headline"><?php if($value['name']) { echo esc_html( $value['name'] ); } else { _e( 'Item', 'tcd-horizon' ); }; ?></h4>
         <div class="sub_box_content">
          <p><label><input name="dp_options[lang_button][<?php echo esc_attr( $key ); ?>][active_button]" type="checkbox" value="1" <?php checked( $value['active_button'], 1 ); ?>><?php _e( 'Set this language button as active button', 'tcd-horizon' ); ?></label></p>
          <h4 class="theme_option_headline2"><?php _e( 'Language name', 'tcd-horizon' ); ?></h4>
          <input class="repeater-label full_width" type="text" name="dp_options[lang_button][<?php echo esc_attr( $key ); ?>][name]" value="<?php echo esc_attr( $value['name'] ); ?>" />
          <h4 class="theme_option_headline2"><?php _e( 'URL', 'tcd-horizon' ); ?></h4>
          <input class="full_width" type="text" name="dp_options[lang_button][<?php echo esc_attr( $key ); ?>][url]" value="<?php echo esc_url( $value['url'] ); ?>" />
          <p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete item', 'tcd-horizon' ); ?></a></p>
         </div><!-- END .sub_box_content -->
        </div><!-- END .sub_box -->
        <?php
               endforeach;
             endif;
             $key = 'addindex';
             $value = array(
              'active_button' => '',
              'name' => '',
              'url' => '',
             );
             ob_start();
        ?>
        <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
         <h4 class="theme_option_subbox_headline"><?php _e( 'New item', 'tcd-horizon' ); ?></h4>
         <div class="sub_box_content">
          <p><label><input name="dp_options[lang_button][<?php echo esc_attr( $key ); ?>][active_button]" type="checkbox" value="1" <?php checked( $value['active_button'], 1 ); ?>><?php _e( 'Set this language button as active button', 'tcd-horizon' ); ?></label></p>
          <h4 class="theme_option_headline2"><?php _e( 'Language name', 'tcd-horizon' ); ?></h4>
          <input class="repeater-label full_width" type="text" name="dp_options[lang_button][<?php echo esc_attr( $key ); ?>][name]" value="<?php echo esc_attr( $value['name'] ); ?>" />
          <h4 class="theme_option_headline2"><?php _e( 'URL', 'tcd-horizon' ); ?></h4>
          <input class="full_width" type="text" name="dp_options[lang_button][<?php echo esc_attr( $key ); ?>][url]" value="<?php echo esc_url( $value['url'] ); ?>" />
          <p class="delete-row right-align"><a href="#" class="button button-secondary button-delete-row"><?php _e( 'Delete item', 'tcd-horizon' ); ?></a></p>
         </div><!-- END .sub_box_content -->
        </div><!-- END .sub_box -->
        <?php
             $clone = ob_get_clean();
        ?>
       </div><!-- END .repeater -->
       <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php _e( 'Add item', 'tcd-horizon' ); ?></a>
      </div><!-- END .repeater-wrapper -->
      <?php //繰り返しフィールドここまで ----- ?>
     </div>

     <?php // 検索フォーム ----------------------------------------------------------------- ?>
     <h4 class="theme_option_headline2"><?php _e('Search form', 'tcd-horizon');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('You can set more details about search form from basic setting menu.','tcd-horizon'); ?></p>
     </div>
     <p><?php echo tcd_basic_radio_button($options, 'show_header_search', $basic_display_options); ?></p>
     <br style="clear:both;">

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-horizon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
     </ul>

    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // モバイル用メニュー ---------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Menu for mobile size', 'tcd-horizon');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="theme_option_message2" style="margin-top:20px;">
      <p><?php _e('This menu will be displayed when browser size became mobile size.<br>Please register language button from other setting above.<br>You set SNS settings from basic settings area.', 'tcd-horizon');  ?></p>
     </div>

     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Display search form', 'tcd-horizon');  ?></span><?php echo tcd_basic_radio_button($options, 'drawer_menu_show_search', $basic_display_options); ?></li>
      <li class="cf"><span class="label"><?php _e('Display SNS icon', 'tcd-horizon');  ?></span><?php echo tcd_basic_radio_button($options, 'drawer_menu_show_sns', $basic_display_options); ?></li>
      <li class="cf"><span class="label"><?php _e('Display language button', 'tcd-horizon');  ?></span><?php echo tcd_basic_radio_button($options, 'drawer_menu_show_lang', $basic_display_options); ?></li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-horizon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
     </ul>

    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // メガメニュー ---------------------------------------------------------------------------------- ?>
   <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Mega menu', 'tcd-horizon');  ?></h3>
    <div class="theme_option_field_ac_content">
     <p><?php _e( 'Set the display format of the sub menu of the global menu', 'tcd-horizon' ); ?></p>
     <div class="theme_option_message2">
      <p><?php _e( 'Dropdown menu (type1) - Display submenu in drop down.', 'tcd-horizon'); ?></p>
      <p><?php _e( 'Dropdown menu (type2) - Display submenu in drop down.', 'tcd-horizon'); ?></p>
      <p><?php _e('Mega menu A - Display blog carousel.', 'tcd-horizon'); ?></p>
      <p><?php printf(__('Mega menu B - Display %s list.', 'tcd-horizon'), $work_label); ?></p>
     </div>
     <ul class="megamenu_image clearfix">
      <?php
           foreach ( $megamenu_options as $option ) :
             if(isset($option['img'])){
      ?>
      <li>
       <img src="<?php echo esc_url(get_template_directory_uri()); ?>/admin/img/<?php echo esc_attr($option['img']); ?>" alt="<?php echo esc_attr( $option['title'] ); ?>" title="" />
       <p><?php echo esc_html($option['title']); ?></p>
      </li>
      <?php }; endforeach; ?>
     </ul>

     <h4 class="theme_option_headline2"><?php _e('Menu type setting', 'tcd-horizon');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please create custom menu from <a href="./nav-menus.php">menu page</a> and set the position as <strong>"Global menu"</strong> before you use this option.', 'tcd-horizon');  ?></p>
     </div>
     <?php
          $menu_locations = get_nav_menu_locations();
          $nav_menus = wp_get_nav_menus();
          $global_nav_items = array();
          if ( isset( $menu_locations['global-menu'] ) ) {
            foreach ( (array) $nav_menus as $menu ) {
              if ( $menu_locations['global-menu'] === $menu->term_id ) {
                $global_nav_items = wp_get_nav_menu_items( $menu );
                break;
              }
            }
          }
          echo '<ul class="option_list">';
          foreach ( $global_nav_items as $item ) {
            if ( $item->menu_item_parent ) continue;
            $value = isset( $options['megamenu'][$item->ID] ) ? $options['megamenu'][$item->ID] : '';
            echo '<li class="cf"><span class="label">' . esc_html( $item->title ) . '</span>';
            echo '<select name="dp_options[megamenu][' . esc_attr( $item->ID ) . ']">';
            foreach ( $megamenu_options as $option ) {
              echo '<option value="' . esc_attr( $option['value'] ) . '" ' . selected( $option['value'], $value, false ) . '>' . esc_html( $option['label'] ) . '</option>';
            }
            echo '</select>';
            echo '</li>';
          }
          echo '</ul>' . "\n";
     ?>

     <?php // メガメニューA ------------------------------- ?>
     <h4 class="theme_option_headline2"><?php _e('Mega menu A setting', 'tcd-horizon');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Number of post', 'tcd-horizon');  ?></span>
       <select name="dp_options[mega_menu_a_post_num]">
        <?php for($i=3; $i<= 12; $i++): ?>
        <option style="padding-right: 10px;" value="<?php echo esc_attr($i); ?>" <?php selected( $options['mega_menu_a_post_num'], $i ); ?>><?php echo esc_html($i); ?></option>
        <?php endfor; ?>
       </select>
      </li>
      <li class="cf"><span class="label"><?php _e('Post order', 'tcd-horizon');  ?></span>
       <select name="dp_options[mega_menu_a_post_order]">
        <option value="date" <?php selected($options['mega_menu_a_post_order'], 'date'); ?>><?php _e('Date', 'tcd-horizon'); ?></option>
        <option value="rand" <?php selected($options['mega_menu_a_post_order'], 'rand'); ?>><?php _e('Random', 'tcd-horizon'); ?></option>
       </select>
      </li>
     </ul>

     <ul class="button_list cf">
      <li><input type="submit" class="button-ml ajax_button" value="<?php echo __( 'Save Changes', 'tcd-horizon' ); ?>" /></li>
      <li><a class="close_ac_content button-ml" href="#"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
     </ul>
    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->


   <?php // メッセージ ----------------------------------------- ?>
  <div class="theme_option_field cf theme_option_field_ac">
    <h3 class="theme_option_headline"><?php _e('Header message', 'tcd-horizon');  ?></h3>
    <div class="theme_option_field_ac_content">

      <div class="theme_option_message2">
        <p><?php _e('The "header message" is displayed at the top of the site (above the header bar).', 'tcd-horizon'); ?></p>
      </div>

      <input id="show_header_message" class="show_checkbox" name="dp_options[show_header_message]" type="checkbox" value="1" <?php checked( $options['show_header_message'], 1 ); ?>>
      <label for="show_header_message"><?php _e( 'Display header message', 'tcd-horizon' ); ?></label>

      <div class="show_checkbox_area">

        <ul class="option_list" style="border-top: 1px dotted #ddd; padding-top: 10px;">
          <li class="cf"><span class="label"><?php _e('Message', 'tcd-horizon');  ?></span><textarea class="full_width" cols="50" rows="2" name="dp_options[header_message]"><?php echo esc_textarea( $options['header_message'] ); ?></textarea></li>
          <li class="cf"><span class="label"><?php _e('URL', 'tcd-horizon');  ?></span><input id="dp_options[header_message_url]" class="full_width" type="text" name="dp_options[header_message_url]" value="<?php echo esc_attr( $options['header_message_url'] ); ?>" /></li>
          <li class="cf color_picker_bottom"><span class="label"><?php echo tcd_admin_label('color'); ?></span><input type="text" name="dp_options[header_message_font_color]" value="<?php echo esc_attr( $options['header_message_font_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
          <li class="cf color_picker_bottom"><span class="label"><?php echo tcd_admin_label('bg_color'); ?></span><input type="text" name="dp_options[header_message_bg_color]" value="<?php echo esc_attr( $options['header_message_bg_color'] ); ?>" data-default-color="#bf9d87" class="c-color-picker"></li>
        </ul>

      </div>

      <ul class="button_list cf">
        <li><input type="submit" class="button-ml ajax_button" value="<?php echo tcd_admin_label('save'); ?>" /></li>
        <li><a class="close_ac_content button-ml" href="#"><?php echo tcd_admin_label('close'); ?></a></li>
      </ul>

    </div><!-- END .theme_option_field_ac_content -->
  </div><!-- END .theme_option_field -->

</div><!-- END .tab-content -->

<?php
} // END add_header_tab_panel()


// バリデーション　■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■■
function add_header_theme_options_validate( $input ) {

  global $dp_default_options, $header_fix_options, $header_fix_options2, $content_width_options, $font_type_options, $logo_type_options, $megamenu_options;

  // ヘッダーロゴ
  if ( ! isset( $input['header_logo_type'] ) )
    $input['header_logo_type'] = null;
  if ( ! array_key_exists( $input['header_logo_type'], $logo_type_options ) )
    $input['header_logo_type'] = null;
  $input['header_logo_font_size'] = wp_filter_nohtml_kses( $input['header_logo_font_size'] );
  $input['header_logo_font_size_sp'] = wp_filter_nohtml_kses( $input['header_logo_font_size_sp'] );
  $input['header_logo_font_type'] = wp_filter_nohtml_kses( $input['header_logo_font_type'] );
  $input['header_logo_image'] = wp_filter_nohtml_kses( $input['header_logo_image'] );
  $input['header_logo_retina'] = wp_filter_nohtml_kses( $input['header_logo_retina'] );
  $input['header_logo_image_mobile'] = wp_filter_nohtml_kses( $input['header_logo_image_mobile'] );
  $input['header_logo_retina_mobile'] = wp_filter_nohtml_kses( $input['header_logo_retina_mobile'] );

  // 言語ボタン
  $input['show_lang_button'] = ! empty( $input['show_lang_button'] ) ? 1 : 0;
  $lang_button = array();
  if ( isset( $input['lang_button'] ) && is_array( $input['lang_button'] ) ) {
    foreach ( $input['lang_button'] as $key => $value ) {
      $lang_button[] = array(
        'active_button' => ! empty( $input['lang_button'][$key]['active_button'] ) ? 1 : 0,
        'name' => isset( $input['lang_button'][$key]['name'] ) ? wp_filter_nohtml_kses( $input['lang_button'][$key]['name'] ) : '',
        'url' => isset( $input['lang_button'][$key]['url'] ) ? wp_filter_nohtml_kses( $input['lang_button'][$key]['url'] ) : '',
      );
    }
  };
  $input['lang_button'] = $lang_button;

  // 検索フォーム
  $input['show_header_search'] = wp_filter_nohtml_kses( $input['show_header_search'] );

  // モバイル用メニュー
  $input['drawer_menu_show_search'] = wp_filter_nohtml_kses( $input['drawer_menu_show_search'] );
  $input['drawer_menu_show_sns'] = wp_filter_nohtml_kses( $input['drawer_menu_show_sns'] );
  $input['drawer_menu_show_lang'] = wp_filter_nohtml_kses( $input['drawer_menu_show_lang'] );


  // メガメニュー
  $input['mega_menu_a_post_num'] = wp_filter_nohtml_kses( $input['mega_menu_a_post_num'] );
  $input['mega_menu_a_post_order'] = wp_filter_nohtml_kses( $input['mega_menu_a_post_order'] );
  foreach ( array_keys( $input['megamenu'] ) as $index ) {
    if ( ! array_key_exists( $input['megamenu'][$index], $megamenu_options ) ) {
      $input['megamenu'][$index] = null;
    }
  }

  // メッセージ
  $input['show_header_message'] = ! empty( $input['show_header_message'] ) ? 1 : 0;
  $input['header_message'] = wp_filter_nohtml_kses( $input['header_message'] );
  $input['header_message_url'] = wp_filter_nohtml_kses( $input['header_message_url'] );
  $input['header_message_font_color'] = sanitize_hex_color( $input['header_message_font_color'] );
  $input['header_message_bg_color'] = sanitize_hex_color( $input['header_message_bg_color'] );


  return $input;

};


?>