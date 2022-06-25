<?php

function about_meta_box() {
  $options = get_design_plus_option();
  add_meta_box(
    'about_meta_box',//ID of meta box
    __('Horizontal scroll page setting', 'tcd-horizon'),//label
    'show_about_meta_box',//callback function
    'page',// post type
    'normal',// context
    'high'// priority
  );
}
add_action('add_meta_boxes', 'about_meta_box');

function show_about_meta_box() {

  global $post, $font_type_options;

  // コンテンツビルダー
  $lp_content = get_post_meta( $post->ID, 'lp_content', true );

  echo '<input type="hidden" name="about_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  //入力欄 ***************************************************************************************************************************************************************************************
?>

<div class="tcd_custom_field_wrap contents_builder_wrap">

   <div class="theme_option_field theme_option_field_ac open active show_arrow">
    <h3 class="theme_option_headline"><?php _e('Content builder', 'tcd-horizon');  ?></h3>
    <div class="theme_option_field_ac_content">

     <div class="theme_option_message no_arrow">
      <?php echo __( '<p>You can build contents freely with this function.</p><br /><p>STEP1: Click Add content button.<br />STEP2: Select content from dropdown menu.<br />STEP3: Input data and save the option.</p><br /><p>You can change order by dragging MOVE button and you can delete content by clicking DELETE button.</p>', 'tcd-horizon' ); ?>
      <br>
      <p><?php _e('For headline and description that do not have font type or font size options, please adjust all at once from the font setting section of the basic settings ', 'tcd-horizon');  ?></p>
     </div>
     <ul class="design_button_list cf">
      <li><a data-rel="lightcase:indexcb" href="<?php bloginfo('template_url'); ?>/admin/img/cb_content_layout1.jpg" title="<?php _e( 'Design content<br>You can select from 6 layouts', 'tcd-horizon' ); ?>"><?php _e( 'Design content', 'tcd-horizon' ); ?></a></li>
      <li><a data-rel="lightcase:indexcb" href="<?php bloginfo('template_url'); ?>/admin/img/cb_image_slider.jpg" title="<?php _e( 'Image slider', 'tcd-horizon' ); ?>"><?php _e( 'Image slider', 'tcd-horizon' ); ?></a></li>
      <li><a data-rel="lightcase:indexcb" href="<?php bloginfo('template_url'); ?>/admin/img/cb_box.jpg" title="<?php _e( 'Three box', 'tcd-horizon' ); ?>"><?php _e( 'Three box', 'tcd-horizon' ); ?></a></li>
      <li><a data-rel="lightcase:indexcb" href="<?php bloginfo('template_url'); ?>/admin/img/cb_access.jpg" title="<?php _e( 'Access map', 'tcd-horizon' ); ?>"><?php _e( 'Access map', 'tcd-horizon' ); ?></a></li>
     </ul>

    </div><!-- END .theme_option_field_ac_content -->
   </div><!-- END .theme_option_field -->

 <?php
      // コンテンツビルダーはここから -----------------------------------------------------------------
 ?>
 <div class="contents_builder">
  <p class="cb_message"><?php _e( 'Click Add content button to start content builder', 'tcd-horizon' ); ?></p>
  <?php
       if ( $lp_content && is_array( $lp_content ) ) :
         foreach( $lp_content as $key => $content ) :
           $cb_index = 'cb_' . $key . '_' . mt_rand( 0, 999999 );
  ?>
  <div class="cb_row">
   <ul class="cb_button cf">
    <li><span class="cb_move"><?php _e( 'Move', 'tcd-horizon' ); ?></span></li>
    <li><span class="cb_delete"><?php _e( 'Delete', 'tcd-horizon' ); ?></span></li>
   </ul>
   <div class="cb_column_area cf">
    <div class="cb_column">
     <input type="hidden" class="cb_index" value="<?php echo $cb_index; ?>">
     <?php
          lp_content_select( $cb_index, $content['cb_content_select'] );
          if ( ! empty( $content['cb_content_select'] ) ) :
            lp_content_content_setting( $cb_index, $content['cb_content_select'], $content );
          endif;
     ?>
    </div><!-- END .cb_column -->
   </div><!-- END .cb_column_area -->
  </div><!-- END .cb_row -->
  <?php
         endforeach;
       endif;
  ?>
 </div><!-- END .contents_builder -->
 <ul class="button_list cf cb_add_row_buttton_area">
  <li><input type="button" value="<?php _e( 'Add content', 'tcd-horizon' ); ?>" class="button-ml add_row"></li>
 </ul>

 <?php // コンテンツビルダー追加用 非表示 ?>
 <div class="contents_builder-clone hidden">
  <div class="cb_row">
   <ul class="cb_button cf">
    <li><span class="cb_move"><?php _e( 'Move', 'tcd-horizon' ); ?></span></li>
    <li><span class="cb_delete"><?php _e( 'Delete', 'tcd-horizon' ); ?></span></li>
   </ul>
   <div class="cb_column_area cf">
    <div class="cb_column">
     <input type="hidden" class="cb_index" value="cb_cloneindex">
       <?php lp_content_select( 'cb_cloneindex' ); ?>
    </div><!-- END .cb_column -->
   </div><!-- END .cb_column_area -->
  </div><!-- END .cb_row -->
  <?php
       foreach ( lp_get_contents() as $key => $value ) :
         lp_content_content_setting( 'cb_cloneindex', $key );
       endforeach;
  ?>
 </div><!-- END .contents_builder-clone -->

</div><!-- END .tcd_custom_field_wrap -->
<?php
}

function save_about_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['about_meta_box_nonce']) || !wp_verify_nonce($_POST['about_meta_box_nonce'], basename(__FILE__))) {
    return $post_id;
  }

  // check autosave
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post_id;
  }

  // check permissions
  if ('page' == $_POST['post_type']) {
    if (!current_user_can('edit_page', $post_id)) {
      return $post_id;
    }
  } elseif (!current_user_can('edit_post', $post_id)) {
      return $post_id;
  }

	// コンテンツビルダー 整形保存
	if ( ! empty( $_POST['lp_content'] ) && is_array( $_POST['lp_content'] ) ) {
		$cb_contents = lp_get_contents();
		$cb_data = array();

		foreach ( $_POST['lp_content'] as $key => $value ) {
			// クローン用はスルー
			if ( 'cb_cloneindex' === $key ) continue;

			// コンテンツデフォルト値に入力値をマージ
			if ( ! empty( $value['cb_content_select'] ) && isset( $cb_contents[$value['cb_content_select']]['default'] ) ) {
				$value = array_merge( (array) $cb_contents[$value['cb_content_select']]['default'], $value );
			}

      // デザインコンテンツ -----------------------------------------------------------------------
      if ($value['cb_content_select'] == 'design_content') {

        if ( ! isset( $value['show_content'] ) )
          $value['show_content'] = null;
          $value['show_content'] = ( $value['show_content'] == 1 ? 1 : 0 );

        $value['layout'] = wp_filter_nohtml_kses( $value['layout'] );

        $value['headline'] = wp_filter_nohtml_kses( $value['headline'] );
        $value['catch'] = wp_filter_nohtml_kses( $value['catch'] );
        $value['catch_type'] = wp_filter_nohtml_kses( $value['catch_type'] );
        $value['desc'] = wp_kses_post( $value['desc'] );
        $value['font_color'] = wp_filter_nohtml_kses( $value['font_color'] );
        $value['bg_color'] = wp_filter_nohtml_kses( $value['bg_color'] );

        $value['show_button'] = ! empty( $value['show_button'] ) ? 1 : 0;
        $value['button_label'] = wp_filter_nohtml_kses( $value['button_label'] );
        $value['button_url'] = wp_filter_nohtml_kses( $value['button_url'] );

        $value['headline2'] = wp_filter_nohtml_kses( $value['headline2'] );
        $value['catch2'] = wp_filter_nohtml_kses( $value['catch2'] );
        $value['catch_type2'] = wp_filter_nohtml_kses( $value['catch_type2'] );
        $value['desc2'] = wp_kses_post( $value['desc2'] );
        $value['font_color2'] = wp_filter_nohtml_kses( $value['font_color2'] );
        $value['bg_color2'] = wp_filter_nohtml_kses( $value['bg_color2'] );

        $value['show_button2'] = ! empty( $value['show_button2'] ) ? 1 : 0;
        $value['button_label2'] = wp_filter_nohtml_kses( $value['button_label2'] );
        $value['button_url2'] = wp_filter_nohtml_kses( $value['button_url2'] );

        $value['headline3'] = wp_filter_nohtml_kses( $value['headline3'] );

        $value['image1'] = wp_filter_nohtml_kses( $value['image1'] );
        $value['image2'] = wp_filter_nohtml_kses( $value['image2'] );
        $value['image3'] = wp_filter_nohtml_kses( $value['image3'] );
        $value['image4'] = wp_filter_nohtml_kses( $value['image4'] );

        $value['image_mobile1'] = wp_filter_nohtml_kses( $value['image_mobile1'] );
        $value['image_mobile2'] = wp_filter_nohtml_kses( $value['image_mobile2'] );
        $value['image_mobile3'] = wp_filter_nohtml_kses( $value['image_mobile3'] );
        $value['image_mobile4'] = wp_filter_nohtml_kses( $value['image_mobile4'] );

        $value['overlay_color'] = wp_filter_nohtml_kses( $value['overlay_color'] );
        $value['overlay_opacity'] = wp_filter_nohtml_kses( $value['overlay_opacity'] );

        $value['bg_type'] = wp_filter_nohtml_kses( $value['bg_type'] );
        $value['video'] = wp_filter_nohtml_kses( $value['video'] );
        $value['youtube'] = wp_filter_nohtml_kses( $value['youtube'] );

        $value['catch3'] = wp_filter_nohtml_kses( $value['catch3'] );
        $value['catch_font_type3'] = wp_filter_nohtml_kses( $value['catch_font_type3'] );
        $value['catch_font_size3'] = wp_filter_nohtml_kses( $value['catch_font_size3'] );
        $value['catch_font_size_sp3'] = wp_filter_nohtml_kses( $value['catch_font_size_sp3'] );
        $value['desc3'] = wp_kses_post( $value['desc3'] );

        $value['show_button3'] = ! empty( $value['show_button3'] ) ? 1 : 0;
        $value['button_label3'] = wp_filter_nohtml_kses( $value['button_label3'] );
        $value['button_url3'] = wp_filter_nohtml_kses( $value['button_url3'] );

        $value['button_type3'] = wp_filter_nohtml_kses( $value['button_type3'] );
        $value['button_border_raidus3'] = wp_filter_nohtml_kses( $value['button_border_raidus3'] );
        $value['button_size3'] = wp_filter_nohtml_kses( $value['button_size3'] );
        $value['button_animation_type3'] = wp_filter_nohtml_kses( $value['button_animation_type3'] );
        $value['button_color3'] = wp_filter_nohtml_kses( $value['button_color3'] );
        $value['button_color_hover3'] = wp_filter_nohtml_kses( $value['button_color_hover3'] );

        $value['use_para'] = ! empty( $value['use_para'] ) ? 1 : 0;

      // 画像スライダー -----------------------------------------------------------------------
      } elseif ($value['cb_content_select'] == 'image_slider') {

        if ( ! isset( $value['show_content'] ) )
          $value['show_content'] = null;
          $value['show_content'] = ( $value['show_content'] == 1 ? 1 : 0 );

        $value['layout'] = wp_filter_nohtml_kses( $value['layout'] );

        $value['item_list'] = $value['item_list'];

        $value['desc'] = wp_kses_post( $value['desc'] );
        $value['desc_font_color'] = wp_filter_nohtml_kses( $value['desc_font_color'] );
        $value['desc_bg_color'] = wp_filter_nohtml_kses( $value['desc_bg_color'] );

        $value['show_news_ticker'] = ! empty( $value['show_news_ticker'] ) ? 1 : 0;
        $value['news_ticker_post_type'] = wp_filter_nohtml_kses( $value['news_ticker_post_type'] );
        $value['news_ticker_post_order'] = wp_filter_nohtml_kses( $value['news_ticker_post_order'] );

      // ボックスコンテンツ -----------------------------------------------------------------------
      } elseif ($value['cb_content_select'] == 'box_content') {

        if ( ! isset( $value['show_content'] ) )
          $value['show_content'] = null;

        for ( $i = 1; $i <= 3; $i++ ) :
          $value['headline'.$i] = wp_filter_nohtml_kses( $value['headline'.$i] );
          $value['desc_top'.$i] = wp_kses_post( $value['desc_top'.$i] );
          $value['desc_middle'.$i] = wp_kses_post( $value['desc_middle'.$i] );
          $value['desc_bottom'.$i] = wp_kses_post( $value['desc_bottom'.$i] );
          $value['font_color'.$i] = wp_filter_nohtml_kses( $value['font_color'.$i] );
          $value['bg_color'.$i] = wp_filter_nohtml_kses( $value['bg_color'.$i] );
          $value['image'.$i] = wp_filter_nohtml_kses( $value['image'.$i] );
          $value['image_mobile'.$i] = wp_filter_nohtml_kses( $value['image_mobile'.$i] );
          $value['bg_type'.$i] = wp_filter_nohtml_kses( $value['bg_type'.$i] );
          $value['video'.$i] = wp_filter_nohtml_kses( $value['video'.$i] );
          $value['youtube'.$i] = wp_filter_nohtml_kses( $value['youtube'.$i] );
          $value['overlay_color'.$i] = wp_filter_nohtml_kses( $value['overlay_color'.$i] );
          $value['overlay_opacity'.$i] = wp_filter_nohtml_kses( $value['overlay_opacity'.$i] );
          $value['use_para'.$i] = ! empty( $value['use_para'.$i] ) ? 1 : 0;
        endfor;

      // アクセスマップ -----------------------------------------------------------------------
      } elseif ($value['cb_content_select'] == 'access_map') {

        if ( ! isset( $value['show_content'] ) )
          $value['show_content'] = null;

        $value['show_logo'] = ! empty( $value['show_logo'] ) ? 1 : 0;
        $value['address'] = wp_filter_nohtml_kses( $value['address'] );
        $value['desc'] = wp_kses_post( $value['desc'] );
        $value['show_sns'] = ! empty( $value['show_sns'] ) ? 1 : 0;
        $value['bg_color'] = wp_filter_nohtml_kses( $value['bg_color'] );

      // フリースペース -----------------------------------------------------------------------
      } elseif ($value['cb_content_select'] == 'free_space') {

        if ( ! isset( $value['show_content'] ) )
          $value['show_content'] = null;
          $value['show_content'] = ( $value['show_content'] == 1 ? 1 : 0 );

        if ( ! isset( $value['free_space'] )) {
          $value['free_space'] = null;
        } else {
          $value['free_space'] = $value['free_space'];
        }

        $value['padding'] = wp_filter_nohtml_kses( $value['padding'] );
        $value['padding_mobile'] = wp_filter_nohtml_kses( $value['padding_mobile'] );

      }

			$cb_data[] = $value;
		}

		if ( $cb_data ) {
			update_post_meta( $post_id, 'lp_content', $cb_data );
		} else {
			delete_post_meta( $post_id, 'lp_content' );
		}
	}
}
add_action('save_post', 'save_about_meta_box');


/**
 * コンテンツビルダー コンテンツ一覧取得
 */
function lp_get_contents() {
	return array(
    // デザインコンテンツ
		'design_content' => array(
			'name' => 'design_content',
			'label' => __( 'Design content', 'tcd-horizon' ),
			'default' => array(
				'show_content' => 1,
				'layout' => 'type1',
				'headline' => '',
				'headline2' => '',
				'headline3' => '',
				'catch' => '',
				'catch_type' => 'type1',
				'catch2' => '',
				'catch_type2' => 'type1',
				'catch3' => '',
				'catch_font_type3' => 'type3',
				'catch_font_type3' => 'type3',
				'catch_font_size3' => '40',
				'catch_font_size_sp3' => '24',
				'desc' => '',
				'desc2' => '',
				'desc3' => '',
				'font_color' => '#000000',
				'font_color2' => '#ffffff',
				'bg_color' => '#ffffff',
				'bg_color2' => '#000000',
				'show_button' => '',
				'button_label' => '',
				'button_url' => '',
				'show_button2' => '',
				'button_label2' => '',
				'button_url2' => '',
				'show_button3' => '',
				'button_label3' => '',
				'button_url3' => '',
				'button_type3' => 'type1',
				'button_border_radius3' => 'oval',
				'button_size3' => 'medium',
				'button_animation_type3' => 'animation_type1',
				'button_color3' => '#00b200',
				'button_color_hover3' => '#098700',
				'image1' => '',
				'image2' => '',
				'image3' => '',
				'image4' => '',
				'image_mobile1' => '',
				'image_mobile2' => '',
				'image_mobile3' => '',
				'image_mobile4' => '',
				'overlay_color' => '#000000',
				'overlay_opacity' => '0.5',
				'bg_type' => 'type1',
				'video' => '',
				'youtube' => '',
				'use_para' => '',
			)
		),
    // 画像スライダー
		'image_slider' => array(
			'name' => 'image_slider',
			'label' => __( 'Image slider', 'tcd-horizon' ),
			'default' => array(
				'show_content' => 1,
				'layout' => 'type1',
				'desc' => '',
				'desc_font_color' => '#000000',
				'desc_bg_color' => '#ffffff',
				'show_news_ticker' => '',
				'news_ticker_post_type' => 'post',
				'news_ticker_post_order' => 'date',
				'item_list' => array(),
			),
			'item_list_default' => array(
             'image' => false,
             'image_mobile' => false,
             'catch' => '',
             'catch_font_type' => 'type3',
             'catch_font_size' => '40',
             'catch_font_size_sp' => '24',
             'desc' => '',
             'show_button' => '',
             'button_label' => '',
             'button_url' => '',
             'button_type' => 'type1',
             'button_border_radius' => 'oval',
             'button_size' => 'medium',
             'button_animation_type' => 'animation_type1',
             'button_color' => '#00b200',
             'button_color_hover' => '#098700',
             'overlay_color' => '#000000',
             'overlay_opacity' => '0.5',
			)
		),
    // ボックスコンテンツ
		'box_content' => array(
			'name' => 'box_content',
			'label' => __( 'Three box', 'tcd-horizon' ),
			'default' => array(
				'show_content' => 1,
				'headline1' => '',
				'headline2' => '',
				'headline3' => '',
				'desc_top1' => '',
				'desc_top2' => '',
				'desc_top3' => '',
				'desc_middle1' => '',
				'desc_middle2' => '',
				'desc_middle3' => '',
				'desc_bottom1' => '',
				'desc_bottom2' => '',
				'desc_bottom3' => '',
				'font_color1' => '#ffffff',
				'bg_color1' => '#000000',
				'font_color2' => '#ffffff',
				'bg_color2' => '#555555',
				'font_color3' => '#000000',
				'bg_color3' => '#f6f7f8',
				'image1' => '',
				'image2' => '',
				'image3' => '',
				'image_mobile1' => '',
				'image_mobile2' => '',
				'image_mobile3' => '',
				'overlay_color1' => '#000000',
				'overlay_opacity1' => '0.5',
				'overlay_color2' => '#000000',
				'overlay_opacity2' => '0.5',
				'overlay_color3' => '#000000',
				'overlay_opacity3' => '0.5',
				'bg_type1' => 'type4',
				'bg_type2' => 'type4',
				'bg_type3' => 'type4',
				'video1' => '',
				'video2' => '',
				'video3' => '',
				'youtube1' => '',
				'youtube2' => '',
				'youtube3' => '',
				'use_para1' => '',
				'use_para2' => '',
				'use_para3' => '',
			)
		),
    // アクセスマップ
		'access_map' => array(
			'name' => 'access_map',
			'label' => __( 'Access map', 'tcd-horizon' ),
			'default' => array(
				'show_content' => 1,
				'show_logo' => '',
				'address' => '',
				'desc' => '',
				'show_sns' => '',
				'bg_color' => '#f6f7f8',
			)
		),
    // フリースペース
		'free_space' => array(
			'name' => 'free_space',
			'label' => __( 'Free space', 'tcd-horizon' ),
			'default' => array(
				'show_content' => 1,
				'free_space' => '',
				'padding' => '0',
				'padding_mobile' => '0',
			)
		)
	);
}

/**
 * コンテンツビルダー用 コンテンツ選択プルダウン
 */
function lp_content_select( $cb_index = 'cb_cloneindex', $selected = null ) {
	$cb_contents = lp_get_contents();

	if ( $selected && isset( $cb_contents[$selected] ) ) {
		$add_class = ' hidden';
	} else {
		$add_class = '';
	}

	$out = '<select name="lp_content[' . esc_attr( $cb_index ) . '][cb_content_select]" class="cb_content_select' . $add_class . '">';
	$out .= '<option value="">' . __( 'Choose the content', 'tcd-horizon' ) . '</option>';

	foreach ( $cb_contents as $key => $value ) {
		$out .= '<option value="' . esc_attr( $key ) . '"' . selected( $key, $selected, false ) . '>' . esc_html( $value['label'] ) . '</option>';
	}

	$out .= '</select>';

	echo $out;
}

/**
 * コンテンツビルダー用 コンテンツ設定
 */
function lp_content_content_setting( $cb_index = 'cb_cloneindex', $cb_content_select = null, $value = array() ) {

  global $font_type_options, $button_type_options, $button_border_radius_options, $button_size_options, $button_animation_options;

  $options = get_design_plus_option();
  $news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-horizon' );

	$cb_contents = lp_get_contents();

	// 不明なコンテンツの場合は終了
	if ( ! $cb_content_select || ! isset( $cb_contents[$cb_content_select] ) ) return false;

	// コンテンツデフォルト値に入力値をマージ
	if ( isset( $cb_contents[$cb_content_select]['default'] ) ) {
		$value = array_merge( (array) $cb_contents[$cb_content_select]['default'], $value );
	}
?>
  <div class="cb_content_wrap cf <?php echo esc_attr( $cb_content_select ); ?>">

  <?php
      // デザインコンテンツ -------------------------------------------------------------------------
      if ( 'design_content' === $cb_content_select ) :
  ?>
  <h3 class="cb_content_headline"><?php echo esc_html( $cb_contents[$cb_content_select]['label'] ); ?></h3>
  <div class="cb_content">

   <p class="hidden"><input name="lp_content[<?php echo $cb_index; ?>][show_content]" type="hidden" value="0"></p>
   <p class="displayment_checkbox"><label><input name="lp_content[<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>> <?php _e('Display design content', 'tcd-horizon'); ?></label></p>
   <div style="<?php if($value['show_content'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

   <h4 class="theme_option_headline2"><?php _e( 'Layout', 'tcd-horizon' ); ?></h4>
   <ul class="design_radio_button2 cb_layout_option" style="margin-bottom:30px;">
    <?php for ( $i = 1; $i <= 6; $i++ ): ?>
    <li<?php if($value['layout'] == 'type'.$i){ echo ' class="active"'; }; ?>>
     <label class="cb_layout_option_type<?php echo $i; ?>" for="cb_layout_type<?php echo $i; ?>_<?php echo $cb_index; ?>">
      <img src="<?php bloginfo('template_url'); ?>/admin/img/layout_type<?php echo $i; ?>.png" title="" alt="">
      <span class="title"><?php _e('Layout', 'tcd-horizon'); ?><?php echo $i; ?></span>
      <span class="link" style="margin-top:-5px; display:block; position:relative;">(<a data-rel="lightcase" href="<?php bloginfo('template_url'); ?>/admin/img/cb_content_layout<?php echo $i; ?>.jpg"><?php _e('Sample', 'tcd-horizon'); ?></a>)</span>
      <input type="radio" id="cb_layout_type<?php echo $i; ?>_<?php echo $cb_index; ?>" name="lp_content[<?php echo $cb_index; ?>][layout]" value="type<?php echo $i; ?>" <?php checked( $value['layout'], 'type'.$i ); ?> />
     </label>
    </li>
    <?php endfor; ?>
   </ul>

   <?php // コンテンツ左（3カラム時） ------------------------------------------------------ ?>
   <div class="sub_box cf three_column_option">
    <h3 class="theme_option_subbox_headline"><?php _e('Content (left)', 'tcd-horizon');  ?></h3>
    <div class="sub_box_content">

     <h4 class="theme_option_headline2 catch_type1_area"><?php _e('Headline', 'tcd-horizon');  ?></h4>
     <h4 class="theme_option_headline2 catch_type2_area"><?php _e('Catchphrase', 'tcd-horizon');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please set font size from basic settings.<br>Headline will be displayed center align and catchphrase will be displyaed in left align.', 'tcd-horizon');  ?></p>
     </div>
     <div class="cf" style="margin-top:20px;">
      <div class="standard_radio_button">
       <input type="radio" id="catch_type2_type1_<?php echo $cb_index; ?>" name="lp_content[<?php echo $cb_index; ?>][catch_type2]" value="type1"<?php checked( $value['catch_type2'], 'type1' ); ?>>
       <label class="catch_type_type1_button" for="catch_type2_type1_<?php echo $cb_index; ?>"><?php _e('Headline', 'tcd-horizon');  ?></label>
       <input type="radio" id="catch_type2_type2_<?php echo $cb_index; ?>" name="lp_content[<?php echo $cb_index; ?>][catch_type2]" value="type2"<?php checked( $value['catch_type2'], 'type2' ); ?>>
       <label class="catch_type_type2_button" for="catch_type2_type2_<?php echo $cb_index; ?>"><?php _e('Catchphrase', 'tcd-horizon');  ?></label>
      </div>
     </div>
     <br class="clear">

     <input type="text" class="catch_type1_area full_width cb-repeater-label" name="lp_content[<?php echo $cb_index; ?>][headline2]" value="<?php echo esc_html(  $value['headline2'] ); ?>" />
     <textarea class="catch_type2_area full_width" cols="50" rows="3" name="lp_content[<?php echo $cb_index; ?>][catch2]"><?php echo esc_textarea(  $value['catch2'] ); ?></textarea>

     <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-horizon');  ?></h4>
     <textarea class="large-text" cols="50" rows="3" name="lp_content[<?php echo $cb_index; ?>][desc2]"><?php echo esc_textarea(  $value['desc2'] ); ?></textarea>

     <div class="hide_when_type5">
      <h4 class="theme_option_headline2"><?php _e('Button', 'tcd-horizon');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('You can set design of button from basic setting menu in theme option page.', 'tcd-horizon');  ?></p>
      </div>
      <p class="hidden"><input name="lp_content[<?php echo $cb_index; ?>][show_button2]" type="hidden" value="0"></p>
      <p class="displayment_checkbox"><label><input name="lp_content[<?php echo $cb_index; ?>][show_button2]" type="checkbox" value="1" <?php checked( $value['show_button2'], 1 ); ?>><?php _e( 'Display button', 'tcd-horizon' ); ?></label></p>
      <div class="button_option_area" style="<?php if($value['show_button2'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
       <ul class="option_list">
        <li class="cf" style="border-top:1px dotted #ccc;"><span class="label"><?php _e('label', 'tcd-horizon');  ?></span><input class="full_width" type="text" name="lp_content[<?php echo $cb_index; ?>][button_label2]" value="<?php esc_attr_e( $value['button_label2'] ); ?>" /></li>
        <li class="cf"><span class="label"><?php _e('URL', 'tcd-horizon');  ?></span><input class="full_width" type="text" name="lp_content[<?php echo $cb_index; ?>][button_url2]" value="<?php esc_attr_e( $value['button_url2'] ); ?>" /></li>
       </ul>
      </div>
     </div>

     <h4 class="theme_option_headline2"><?php _e('Color', 'tcd-horizon');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-horizon'); ?></span><input type="text" name="lp_content[<?php echo $cb_index; ?>][font_color2]" value="<?php echo esc_attr( $value['font_color2'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
      <li class="cf"><span class="label"><?php _e('Background color', 'tcd-horizon'); ?></span><input type="text" name="lp_content[<?php echo $cb_index; ?>][bg_color2]" value="<?php echo esc_attr( $value['bg_color2'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
     </ul>

    </div><!-- END .sub_box_content -->
   </div><!-- END .sub_box -->

   <?php // コンテンツ左（2カラム時）、コンテンツ中央（3カラム時） ------------------------------------------------------ ?>
   <div class="sub_box cf"> 
    <h3 class="theme_option_subbox_headline"><div class="non_layout6_option"><span class="three_column_option"><?php _e('Content (center)', 'tcd-horizon');  ?></span><span class="two_column_option"><?php _e('Content (left)', 'tcd-horizon');  ?></span></div><div class="layout6_option"><?php _e('Content', 'tcd-horizon');  ?></div></h3>
    <div class="sub_box_content">

     <div class="background_type_option">
      <h4 class="theme_option_headline2"><?php _e('Background type', 'tcd-horizon'); ?></h4>
      <ul class="design_radio_button horizontal cf">
       <li class="cb_bg_type_type1">
        <input type="radio" id="bg_type1_<?php echo $cb_index; ?>" name="lp_content[<?php echo $cb_index; ?>][bg_type]" value="type1" <?php checked( $value['bg_type'], 'type1' ); ?> />
        <label for="bg_type1_<?php echo $cb_index; ?>"><?php _e('Image', 'tcd-horizon'); ?></label>
       </li>
       <li class="cb_bg_type_type2">
        <input type="radio" id="bg_type2_<?php echo $cb_index; ?>" name="lp_content[<?php echo $cb_index; ?>][bg_type]" value="type2" <?php checked( $value['bg_type'], 'type2' ); ?> />
        <label for="bg_type2_<?php echo $cb_index; ?>"><?php _e('Video', 'tcd-horizon'); ?></label>
       </li>
       <li class="cb_bg_type_type3">
        <input type="radio" id="bg_type3_<?php echo $cb_index; ?>" name="lp_content[<?php echo $cb_index; ?>][bg_type]" value="type3" <?php checked( $value['bg_type'], 'type3' ); ?> />
        <label for="bg_type3_<?php echo $cb_index; ?>"><?php _e('Youtube', 'tcd-horizon'); ?></label>
       </li>
      </ul>
     </div>

     <div class="video_bg_option">

      <h4 class="theme_option_headline2"><?php _e('Video', 'tcd-horizon'); ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('Please upload MP4 format file.', 'tcd-horizon');  ?></p>
       <p><?php _e('Web browser takes few second to load the data of video so we recommend to use loading screen if you want to display video.', 'tcd-horizon'); ?></p>
      </div>
      <div class="image_box cf">
       <div class="cf cf_media_field hide-if-no-js video_<?php echo $cb_index; ?>">
        <input type="hidden" value="<?php echo esc_attr( $value['video'] ); ?>" id="video_<?php echo $cb_index; ?>" name="lp_content[<?php echo $cb_index; ?>][video]" class="cf_media_id">
        <div class="preview_field preview_field_video">
         <?php if($value['video']){ ?>
         <h4><?php _e( 'Uploaded MP4 file', 'tcd-horizon' ); ?></h4>
         <p><?php echo esc_url(wp_get_attachment_url($value['video'])); ?></p>
         <?php }; ?>
        </div>
        <div class="buttton_area">
         <input type="button" value="<?php _e('Select MP4 file', 'tcd-horizon'); ?>" class="cfmf-select-video button">
         <input type="button" value="<?php _e('Remove MP4 file', 'tcd-horizon'); ?>" class="cfmf-delete-video button <?php if(!$value['video']){ echo 'hidden'; }; ?>">
        </div>
       </div>
      </div>

     </div><!-- # END .video_bg_option -->

     <div class="youtube_bg_option">

      <h4 class="theme_option_headline2"><?php _e('Youtube', 'tcd-horizon'); ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('Please enter Youtube URL.', 'tcd-horizon');  ?></p>
       <p><?php _e('Web browser takes few second to load the data of video so we recommend to use loading screen if you want to display video.', 'tcd-horizon'); ?></p>
      </div>
      <input class="regular-text" type="text" name="lp_content[<?php echo $cb_index; ?>][youtube]" value="<?php echo esc_attr( $value['youtube'] ); ?>">

     </div><!-- # END .youtube_bg_option -->

     <h4 class="theme_option_headline2 image_bg_option"><?php _e('Image', 'tcd-horizon'); ?></h4>
     <h4 class="theme_option_headline2 video_bg_option"><?php _e('Substitute image', 'tcd-horizon'); ?></h4>
     <div class="theme_option_message2 video_bg_option" style="margin-top:20px;">
      <p class="video_bg_option"><?php _e('If the mobile device can\'t play video this image will be displayed instead.', 'tcd-horizon');  ?></p>
     </div>
     <h4 class="theme_option_headline2 youtube_bg_option"><?php _e('Substitute image', 'tcd-horizon'); ?></h4>
     <div class="theme_option_message2 youtube_bg_option" style="margin-top:20px;">
      <p class="youtube_bg_option"><?php _e('If the mobile device can\'t play video this image will be displayed instead.', 'tcd-horizon');  ?></p>
     </div>
     <ul class="option_list">
      <li class="cf">
       <span class="label">
        <span class="image_option1_type1"><?php _e('Image', 'tcd-horizon'); ?></span><span class="image_option1_type2"><?php _e('Image', 'tcd-horizon'); ?>1</span>
        <span class="non_layout6_option">
         <span class="recommend_desc image_size1"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '725', '1100'); ?></span>
         <span class="recommend_desc image_size2"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '725', '550'); ?></span>
         <span class="recommend_desc image_size3"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '725', '367'); ?></span>
        </span>
        <span class="recommend_desc layout6_option"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '1450', '1100'); ?></span>
       </span>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js image-<?php echo $cb_index; ?>1">
         <input type="hidden" class="cf_media_id" name="lp_content[<?php echo $cb_index; ?>][image1]" id="image-<?php echo $cb_index; ?>1" value="<?php echo esc_attr( $value['image1'] ); ?>">
         <div class="preview_field"><?php if ( $value['image1'] ) echo wp_get_attachment_image( $value['image1'], 'medium' ); ?></div>
         <div class="buttton_area">
          <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-horizon' ); ?>">
          <input type="button" class="cfmf-delete-img button<?php if ( empty($value['image1']) ) { echo ' hidden'; }; ?>" value="<?php _e( 'Remove Image', 'tcd-horizon'); ?>">
         </div>
        </div>
       </div>
      </li>
      <li class="cf image_bg_option">
       <span class="label">
        <span class="image_option1_type1"><?php _e('Image (mobile)', 'tcd-horizon'); ?></span><span class="image_option1_type2"><?php printf(__('Image%s (mobile)', 'tcd-horizon'), '1'); ?></span>
        <span class="non_layout6_option">
         <span class="recommend_desc image_size1"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '750', '1250'); ?></span>
         <span class="recommend_desc image_size2"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '750', '625'); ?></span>
         <span class="recommend_desc image_size3"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '750', '312'); ?></span>
        </span>
        <span class="recommend_desc layout6_option"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '750', '2500'); ?></span>
       </span>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js image_mobile-<?php echo $cb_index; ?>1">
         <input type="hidden" class="cf_media_id" name="lp_content[<?php echo $cb_index; ?>][image_mobile1]" id="image_mobile-<?php echo $cb_index; ?>1" value="<?php echo esc_attr( $value['image_mobile1'] ); ?>">
         <div class="preview_field"><?php if ( $value['image_mobile1'] ) echo wp_get_attachment_image( $value['image_mobile1'], 'medium' ); ?></div>
         <div class="buttton_area">
          <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-horizon' ); ?>">
          <input type="button" class="cfmf-delete-img button<?php if ( empty($value['image_mobile1']) ) { echo ' hidden'; }; ?>" value="<?php _e( 'Remove Image', 'tcd-horizon'); ?>">
         </div>
        </div>
       </div>
      </li>
     </ul>
     <ul class="option_list image_bg_option">
      <li class="cf image_option2" style="border-top:1px dotted #ccc;">
       <span class="label">
        <?php _e('Image', 'tcd-horizon'); ?>2
        <span class="recommend_desc image_size1"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '725', '1100'); ?></span>
        <span class="recommend_desc image_size2"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '725', '550'); ?></span>
        <span class="recommend_desc image_size3"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '725', '367'); ?></span>
       </span>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js image-<?php echo $cb_index; ?>2">
         <input type="hidden" class="cf_media_id" name="lp_content[<?php echo $cb_index; ?>][image2]" id="image-<?php echo $cb_index; ?>2" value="<?php echo esc_attr( $value['image2'] ); ?>">
         <div class="preview_field"><?php if ( $value['image2'] ) echo wp_get_attachment_image( $value['image2'], 'medium' ); ?></div>
         <div class="buttton_area">
          <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-horizon' ); ?>">
          <input type="button" class="cfmf-delete-img button<?php if ( empty($value['image2']) ) { echo ' hidden'; }; ?>" value="<?php _e( 'Remove Image', 'tcd-horizon'); ?>">
         </div>
        </div>
       </div>
      </li>
      <li class="cf image_option2">
       <span class="label">
        <?php printf(__('Image%s (mobile)', 'tcd-horizon'), '2'); ?>
        <span class="non_layout6_option">
         <span class="recommend_desc image_size1"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '750', '1250'); ?></span>
         <span class="recommend_desc image_size2"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '750', '625'); ?></span>
         <span class="recommend_desc image_size3"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '750', '312'); ?></span>
        </span>
       </span>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js image_mobile-<?php echo $cb_index; ?>2">
         <input type="hidden" class="cf_media_id" name="lp_content[<?php echo $cb_index; ?>][image_mobile2]" id="image_mobile-<?php echo $cb_index; ?>2" value="<?php echo esc_attr( $value['image_mobile2'] ); ?>">
         <div class="preview_field"><?php if ( $value['image_mobile2'] ) echo wp_get_attachment_image( $value['image_mobile2'], 'medium' ); ?></div>
         <div class="buttton_area">
          <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-horizon' ); ?>">
          <input type="button" class="cfmf-delete-img button<?php if ( empty($value['image_mobile2']) ) { echo ' hidden'; }; ?>" value="<?php _e( 'Remove Image', 'tcd-horizon'); ?>">
         </div>
        </div>
       </div>
      </li>
      <li class="cf image_option3">
       <span class="label">
        <?php _e('Image', 'tcd-horizon'); ?>3
        <span class="recommend_desc image_size1"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '725', '1100'); ?></span>
        <span class="recommend_desc image_size2"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '725', '550'); ?></span>
        <span class="recommend_desc image_size3"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '725', '367'); ?></span>
       </span>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js image-<?php echo $cb_index; ?>3">
         <input type="hidden" class="cf_media_id" name="lp_content[<?php echo $cb_index; ?>][image3]" id="image-<?php echo $cb_index; ?>3" value="<?php echo esc_attr( $value['image3'] ); ?>">
         <div class="preview_field"><?php if ( $value['image3'] ) echo wp_get_attachment_image( $value['image3'], 'medium' ); ?></div>
         <div class="buttton_area">
          <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-horizon' ); ?>">
          <input type="button" class="cfmf-delete-img button<?php if ( empty($value['image3']) ) { echo ' hidden'; }; ?>" value="<?php _e( 'Remove Image', 'tcd-horizon'); ?>">
         </div>
        </div>
       </div>
      </li>
      <li class="cf image_option3">
       <span class="label">
        <?php printf(__('Image%s (mobile)', 'tcd-horizon'), '3'); ?>
        <span class="non_layout6_option">
         <span class="recommend_desc image_size1"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '750', '1250'); ?></span>
         <span class="recommend_desc image_size2"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '750', '625'); ?></span>
         <span class="recommend_desc image_size3"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '750', '312'); ?></span>
        </span>
       </span>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js image_mobile-<?php echo $cb_index; ?>3">
         <input type="hidden" class="cf_media_id" name="lp_content[<?php echo $cb_index; ?>][image_mobile3]" id="image_mobile-<?php echo $cb_index; ?>3" value="<?php echo esc_attr( $value['image_mobile3'] ); ?>">
         <div class="preview_field"><?php if ( $value['image_mobile3'] ) echo wp_get_attachment_image( $value['image_mobile3'], 'medium' ); ?></div>
         <div class="buttton_area">
          <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-horizon' ); ?>">
          <input type="button" class="cfmf-delete-img button<?php if ( empty($value['image_mobile3']) ) { echo ' hidden'; }; ?>" value="<?php _e( 'Remove Image', 'tcd-horizon'); ?>">
         </div>
        </div>
       </div>
      </li>
     </ul>

     <div class="para_option">
      <h4 class="theme_option_headline2"><?php _e( 'Parallax effect for background image', 'tcd-horizon' ); ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('You can express a three-dimensional effect and depth background.', 'tcd-horizon'); ?><br>
      </div>
      <p><label><input class="use_para_checkbox" name="lp_content[<?php echo $cb_index; ?>][use_para]" type="checkbox" value="1" <?php checked( $value['use_para'], 1 ); ?>><?php _e( 'Use parallax effect', 'tcd-horizon' ); ?></label></p>
     </div>

     <h4 class="theme_option_headline2"><span class="image_bg_option"><?php _e( 'Overlay for image', 'tcd-horizon' ); ?></span><span class="video_bg_option"><?php _e( 'Overlay for video', 'tcd-horizon' ); ?></span></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-horizon'); ?></span><input type="text" name="lp_content[<?php echo $cb_index; ?>][overlay_color]" value="<?php echo esc_attr( $value['overlay_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      <li class="cf">
       <span class="label"><?php _e('Transparency of overlay', 'tcd-horizon'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="lp_content[<?php echo $cb_index; ?>][overlay_opacity]" value="<?php echo esc_attr( $value['overlay_opacity'] ); ?>" />
       <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-horizon');  ?><br>
        <?php _e('Please enter 0 if you don\'t want to use overlay.', 'tcd-horizon');  ?></p>
       </div>
      </li>
     </ul>

     <div class="hide_when_type2_type3_type5">

      <div class="non_layout6_option">

       <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-horizon');  ?></h4>
       <input type="text" class="full_width cb-repeater-label" name="lp_content[<?php echo $cb_index; ?>][headline3]" value="<?php echo esc_html(  $value['headline3'] ); ?>" />

      </div><!-- END .non_layout6_option -->

      <div class="layout6_option">

       <h4 class="theme_option_headline2"><?php _e('Catchphrase', 'tcd-horizon');  ?></h4>
       <textarea class="full_width cb-repeater-label" cols="50" rows="3" name="lp_content[<?php echo $cb_index; ?>][catch3]"><?php echo esc_textarea(  $value['catch3'] ); ?></textarea>
       <ul class="option_list">
        <li class="cf">
         <span class="label"><?php _e('Font type', 'tcd-horizon');  ?></span>
         <div class="standard_radio_button">
          <?php foreach ( $font_type_options as $option ) { ?>
          <input id="catch_font_type3_<?php echo $cb_index; ?>_<?php echo esc_attr($option['value']); ?>" type="radio" name="lp_content[<?php echo $cb_index; ?>][catch_font_type3]" value="<?php echo esc_attr($option['value']); ?>"<?php checked( $value['catch_font_type3'], $option['value'] ); ?>>
          <label for="catch_font_type3_<?php echo $cb_index; ?>_<?php echo esc_attr($option['value']); ?>"><?php echo esc_html($option['label']); ?></label>
          <?php } ?>
         </div>
        </li>
        <li class="cf">
         <span class="label"><?php _e('Font size', 'tcd-horizon'); ?></span>
         <div class="font_size_option">
          <label class="font_size_label number_option">
           <input class="hankaku input_font_size" type="number" name="lp_content[<?php echo $cb_index; ?>][catch_font_size3]" value="<?php echo esc_attr( $value['catch_font_size3'] ); ?>" min="9" max="100" />
           <span class="icon icon_pc"></span>
          </label>
          <label class="font_size_label number_option">
           <input class="hankaku input_font_size" type="number" name="lp_content[<?php echo $cb_index; ?>][catch_font_size_sp3]" value="<?php echo esc_attr( $value['catch_font_size_sp3'] ); ?>" min="9" max="100" />
           <span class="icon icon_sp"></span>
          </label>
         </div>
        </li>
       </ul>

       <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-horizon');  ?></h4>
       <textarea class="large-text" cols="50" rows="3" name="lp_content[<?php echo $cb_index; ?>][desc3]"><?php echo esc_textarea(  $value['desc3'] ); ?></textarea>

       <h4 class="theme_option_headline2"><?php _e('Button', 'tcd-horizon');  ?></h4>
       <p class="hidden"><input name="lp_content[<?php echo $cb_index; ?>][show_button3]" type="hidden" value="0"></p>
       <p class="displayment_checkbox"><label><input name="lp_content[<?php echo $cb_index; ?>][show_button3]" type="checkbox" value="1" <?php checked( $value['show_button3'], 1 ); ?>><?php _e( 'Display button', 'tcd-horizon' ); ?></label></p>
       <div class="button_option_area" style="<?php if($value['show_button3'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
        <ul class="option_list">
         <li class="cf" style="border-top:1px dotted #ccc;">
          <span class="label"><?php _e('Type', 'tcd-horizon'); ?></span>
          <div class="standard_radio_button">
           <?php foreach ( $button_type_options as $option ) { ?>
           <input id="button_type3_<?php echo esc_attr($option['value']); ?>_<?php echo $cb_index; ?>" type="radio" name="lp_content[<?php echo $cb_index; ?>][button_type3]" value="<?php echo esc_attr($option['value']); ?>" <?php checked( $value['button_type3'], $option['value'] ); ?>><label for="button_type3_<?php echo esc_attr($option['value']); ?>_<?php echo $cb_index; ?>"><?php echo esc_html($option['label']); ?></label>
           <?php }; ?>
          </div>
         </li>
         <li class="cf">
          <span class="label"><?php _e('Shape', 'tcd-horizon'); ?></span>
          <div class="standard_radio_button">
           <?php foreach ( $button_border_radius_options as $option ) { ?>
           <input id="button_border_radius3_<?php echo esc_attr($option['value']); ?>_<?php echo $cb_index; ?>" type="radio" name="lp_content[<?php echo $cb_index; ?>][button_border_radius3]" value="<?php echo esc_attr($option['value']); ?>" <?php checked( $value['button_border_radius3'], $option['value'] ); ?>><label for="button_border_radius3_<?php echo esc_attr($option['value']); ?>_<?php echo $cb_index; ?>"><?php echo esc_html($option['label']); ?></label>
           <?php }; ?>
          </div>
         </li>
         <li class="cf"><span class="label">
          <?php _e('Size', 'tcd-horizon'); ?></span>
          <div class="standard_radio_button">
           <?php foreach ( $button_size_options as $option ) { ?>
           <input id="button_size3_<?php echo esc_attr($option['value']); ?>_<?php echo $cb_index; ?>" type="radio" name="lp_content[<?php echo $cb_index; ?>][button_size3]" value="<?php echo esc_attr($option['value']); ?>" <?php checked( $value['button_size3'], $option['value'] ); ?>><label for="button_size3_<?php echo esc_attr($option['value']); ?>_<?php echo $cb_index; ?>"><?php echo esc_html($option['label']); ?></label>
           <?php }; ?>
          </div>
         </li>
         <li class="cf"><span class="label">
          <?php _e('Mouseover animation', 'tcd-horizon'); ?></span>
          <div class="standard_radio_button">
           <?php foreach ( $button_animation_options as $option ) { ?>
           <input id="button_animation_type3_<?php echo esc_attr($option['value']); ?>_<?php echo $cb_index; ?>" type="radio" name="lp_content[<?php echo $cb_index; ?>][button_animation_type3]" value="<?php echo esc_attr($option['value']); ?>" <?php checked( $value['button_animation_type3'], $option['value'] ); ?>><label for="button_animation_type3_<?php echo esc_attr($option['value']); ?>_<?php echo $cb_index; ?>"><?php echo esc_html($option['label']); ?></label>
           <?php }; ?>
          </div>
         </li>
         <li class="cf"><span class="label"><?php _e('Color scheme', 'tcd-horizon'); ?></span><input type="text" name="lp_content[<?php echo $cb_index; ?>][button_color3]" value="<?php echo esc_attr( $value['button_color3'] ); ?>" data-default-color="#00b200" class="c-color-picker"></li>
         <li class="cf"><span class="label"><?php _e('Color scheme on mouseover', 'tcd-horizon'); ?></span><input type="text" name="lp_content[<?php echo $cb_index; ?>][button_color_hover3]" value="<?php echo esc_attr( $value['button_color_hover3'] ); ?>" data-default-color="#098700" class="c-color-picker"></li>
         <li class="cf"><span class="label"><?php _e('label', 'tcd-horizon'); ?></span><input class="full_width" type="text" name="lp_content[<?php echo $cb_index; ?>][button_label3]" value="<?php echo esc_attr( $value['button_label3'] ); ?>" /></li>
         <li class="cf"><span class="label"><?php _e('URL', 'tcd-horizon'); ?></span><input class="full_width" type="text" name="lp_content[<?php echo $cb_index; ?>][button_url3]" value="<?php echo esc_attr( $value['button_url3'] ); ?>"></li>
        </ul>
       </div>

      </div><!-- END .layout6_option -->

     </div><!-- END .hide_when_type2_type3_type5 -->

    </div><!-- END .sub_box_content -->
   </div><!-- END .sub_box -->

   <?php // コンテンツ右 ------------------------------------------------------ ?>
   <div class="sub_box cf non_layout6_option">
    <h3 class="theme_option_subbox_headline"><?php _e('Content (right)', 'tcd-horizon');  ?></h3>
    <div class="sub_box_content">

     <h4 class="theme_option_headline2 catch_type1_area"><?php _e('Headline', 'tcd-horizon');  ?></h4>
     <h4 class="theme_option_headline2 catch_type2_area"><?php _e('Catchphrase', 'tcd-horizon');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Please set font size from basic settings.<br>Headline will be displayed center align and catchphrase will be displyaed in left align.', 'tcd-horizon');  ?></p>
     </div>
     <div class="cf" style="margin-top:20px;">
      <div class="standard_radio_button">
       <input type="radio" id="catch_type_type1_<?php echo $cb_index; ?>" name="lp_content[<?php echo $cb_index; ?>][catch_type]" value="type1"<?php checked( $value['catch_type'], 'type1' ); ?>>
       <label class="catch_type_type1_button" for="catch_type_type1_<?php echo $cb_index; ?>"><?php _e('Headline', 'tcd-horizon');  ?></label>
       <input type="radio" id="catch_type_type2_<?php echo $cb_index; ?>" name="lp_content[<?php echo $cb_index; ?>][catch_type]" value="type2"<?php checked( $value['catch_type'], 'type2' ); ?>>
       <label class="catch_type_type2_button" for="catch_type_type2_<?php echo $cb_index; ?>"><?php _e('Catchphrase', 'tcd-horizon');  ?></label>
      </div>
     </div>
     <br class="clear">

     <input type="text" class="catch_type1_area full_width cb-repeater-label" name="lp_content[<?php echo $cb_index; ?>][headline]" value="<?php echo esc_html(  $value['headline'] ); ?>" />
     <textarea class="catch_type2_area full_width" cols="50" rows="3" name="lp_content[<?php echo $cb_index; ?>][catch]"><?php echo esc_textarea(  $value['catch'] ); ?></textarea>

     <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-horizon');  ?></h4>
     <textarea class="large-text" cols="50" rows="3" name="lp_content[<?php echo $cb_index; ?>][desc]"><?php echo esc_textarea(  $value['desc'] ); ?></textarea>

     <div class="hide_when_type4">
      <h4 class="theme_option_headline2"><?php _e('Button', 'tcd-horizon');  ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('You can set design of button from basic setting menu in theme option page.', 'tcd-horizon');  ?></p>
      </div>
      <p class="hidden"><input name="lp_content[<?php echo $cb_index; ?>][show_button]" type="hidden" value="0"></p>
      <p class="displayment_checkbox"><label><input name="lp_content[<?php echo $cb_index; ?>][show_button]" type="checkbox" value="1" <?php checked( $value['show_button'], 1 ); ?>><?php _e( 'Display button', 'tcd-horizon' ); ?></label></p>
      <div class="button_option_area" style="<?php if($value['show_button'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
       <ul class="option_list">
        <li class="cf" style="border-top:1px dotted #ccc;"><span class="label"><?php _e('label', 'tcd-horizon');  ?></span><input class="full_width" type="text" name="lp_content[<?php echo $cb_index; ?>][button_label]" value="<?php esc_attr_e( $value['button_label'] ); ?>" /></li>
        <li class="cf"><span class="label"><?php _e('URL', 'tcd-horizon');  ?></span><input class="full_width" type="text" name="lp_content[<?php echo $cb_index; ?>][button_url]" value="<?php esc_attr_e( $value['button_url'] ); ?>" /></li>
       </ul>
      </div>
     </div>

     <h4 class="theme_option_headline2"><?php _e('Color', 'tcd-horizon');  ?></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Font color', 'tcd-horizon'); ?></span><input type="text" name="lp_content[<?php echo $cb_index; ?>][font_color]" value="<?php echo esc_attr( $value['font_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      <li class="cf color_picker_bottom"><span class="label"><?php _e('Background color', 'tcd-horizon'); ?></span><input type="text" name="lp_content[<?php echo $cb_index; ?>][bg_color]" value="<?php echo esc_attr( $value['bg_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     </ul>

     <div class="show_when_type4">
      <h4 class="theme_option_headline2"><?php _e('Image', 'tcd-horizon'); ?></h4>
      <ul class="option_list image_bg_option">
       <li class="cf image_option2">
        <span class="label">
         <?php _e('Image', 'tcd-horizon'); ?>
         <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '725', '550'); ?></span>
        </span>
        <div class="image_box cf">
         <div class="cf cf_media_field hide-if-no-js image-<?php echo $cb_index; ?>4">
          <input type="hidden" class="cf_media_id" name="lp_content[<?php echo $cb_index; ?>][image4]" id="image-<?php echo $cb_index; ?>4" value="<?php echo esc_attr( $value['image4'] ); ?>">
          <div class="preview_field"><?php if ( $value['image4'] ) echo wp_get_attachment_image( $value['image4'], 'medium' ); ?></div>
          <div class="buttton_area">
           <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-horizon' ); ?>">
           <input type="button" class="cfmf-delete-img button<?php if ( empty($value['image4']) ) { echo ' hidden'; }; ?>" value="<?php _e( 'Remove Image', 'tcd-horizon'); ?>">
          </div>
         </div>
        </div>
       </li>
       <li class="cf image_option2">
        <span class="label">
         <?php _e('Image (mobile)', 'tcd-horizon'); ?>
         <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '750', '1250'); ?></span>
        </span>
        <div class="image_box cf">
         <div class="cf cf_media_field hide-if-no-js image_mobile-<?php echo $cb_index; ?>4">
          <input type="hidden" class="cf_media_id" name="lp_content[<?php echo $cb_index; ?>][image_mobile4]" id="image_mobile-<?php echo $cb_index; ?>4" value="<?php echo esc_attr( $value['image_mobile4'] ); ?>">
          <div class="preview_field"><?php if ( $value['image_mobile4'] ) echo wp_get_attachment_image( $value['image_mobile4'], 'medium' ); ?></div>
          <div class="buttton_area">
           <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-horizon' ); ?>">
           <input type="button" class="cfmf-delete-img button<?php if ( empty($value['image_mobile4']) ) { echo ' hidden'; }; ?>" value="<?php _e( 'Remove Image', 'tcd-horizon'); ?>">
          </div>
         </div>
        </div>
       </li>
      </ul>
     </div>

    </div><!-- END .sub_box_content -->
   </div><!-- END .sub_box -->

   </div><!-- END .displayment_checkbox -->

   <ul class="button_list cf">
    <li><a href="#" class="button-ml close-content"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
   </ul>
  </div><!-- END .cb_content -->


  <?php
      // 画像スライダー -------------------------------------------------------------------------
      elseif ( 'image_slider' === $cb_content_select ) :
  ?>
  <h3 class="cb_content_headline"><?php echo esc_html( $cb_contents[$cb_content_select]['label'] ); ?></h3>
  <div class="cb_content">

   <p class="hidden"><input name="lp_content[<?php echo $cb_index; ?>][show_content]" type="hidden" value="0"></p>
   <p class="displayment_checkbox"><label><input name="lp_content[<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>> <?php _e('Display image slider', 'tcd-horizon'); ?></label></p>
   <div style="<?php if($value['show_content'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

   <h4 class="theme_option_headline2"><?php _e( 'Layout', 'tcd-horizon' ); ?></h4>
   <ul class="design_radio_button2 cb_slider_layout_option" style="margin-bottom:30px;">
    <li<?php if($value['layout'] == 'type1'){ echo ' class="active"'; }; ?>>
     <label class="cb_slider_layout_option_type1" for="cb_slider_layout_type1_<?php echo $cb_index; ?>">
      <img src="<?php bloginfo('template_url'); ?>/admin/img/image-slider01.png" title="" alt="">
      <span class="title"><?php _e('Two column', 'tcd-horizon'); ?></span>
      <span class="link" style="margin-top:-5px; display:block; position:relative;">(<a data-rel="lightcase" href="<?php bloginfo('template_url'); ?>/admin/img/cb_image_slider.jpg"><?php _e('Sample', 'tcd-horizon'); ?></a>)</span>
      <input type="radio" id="cb_slider_layout_type1_<?php echo $cb_index; ?>" name="lp_content[<?php echo $cb_index; ?>][layout]" value="type1" <?php checked( $value['layout'], 'type1' ); ?> />
     </label>
    </li>
    <li<?php if($value['layout'] == 'type2'){ echo ' class="active"'; }; ?>>
     <label class="cb_slider_layout_option_type2" for="cb_slider_layout_type2_<?php echo $cb_index; ?>">
      <img src="<?php bloginfo('template_url'); ?>/admin/img/image-slider02.png" title="" alt="">
      <span class="title"><?php _e('Full screen width', 'tcd-horizon'); ?></span>
      <span class="link" style="margin-top:-5px; display:block; position:relative;">(<a data-rel="lightcase" href="<?php bloginfo('template_url'); ?>/admin/img/cb_image_slider2.jpg"><?php _e('Sample', 'tcd-horizon'); ?></a>)</span>
      <input type="radio" id="cb_slider_layout_type2_<?php echo $cb_index; ?>" name="lp_content[<?php echo $cb_index; ?>][layout]" value="type2" <?php checked( $value['layout'], 'type2' ); ?> />
     </label>
    </li>
   </ul>

   <?php // スライダー ------------------------------------------------------ ?>
   <div class="sub_box cf"> 
    <h3 class="theme_option_subbox_headline"><?php _e('Slider', 'tcd-horizon');  ?></h3>
    <div class="sub_box_content">

     <?php // リピーターここから -------------------------- ?>
     <div class="theme_option_message2" style="margin-top:20px;">
      <p><?php _e('Click add item button to start this option.<br />You can change order by dragging each headline of option field.', 'tcd-horizon');  ?></p>
      <p><?php _e('In a mobile device size, due to the size of the screen, the description will be displayed at the top of the column regardless of which layout is selected.', 'tcd-horizon');  ?></p>
     </div>
     <div class="repeater-wrapper">
      <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-horizon' ); ?>">
       <?php
            $image_slider_item_num = 1;
            if ( $value['item_list'] && is_array( $value['item_list'] ) ) :
              foreach ( $value['item_list'] as $repeater_key => $repeater_value ) :
                 $repeater_value = array_merge( $cb_contents[$cb_content_select]['item_list_default'], $repeater_value );
       ?>
       <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
        <h4 class="theme_option_subbox_headline"><?php _e( 'Item', 'tcd-horizon' ); echo esc_attr( $image_slider_item_num ); ?></h4>
        <div class="sub_box_content">

         <div class="sub_box_tab">
          <div class="tab active" data-tab="tab1"><?php _e('Background', 'tcd-horizon'); ?></div>
          <div class="tab" data-tab="tab2"><?php _e('Content', 'tcd-horizon'); ?></div>
         </div>

         <?php // 背景 ----------------------- ?>
         <div class="sub_box_tab_content active" data-tab-content="tab1">

           <h4 class="theme_option_headline2"><?php _e( 'Background image', 'tcd-horizon' ); ?></h4>
           <ul class="option_list">
            <li class="cf">
             <span class="label">
              <?php _e('Background image', 'tcd-horizon'); ?>
              <span class="recommend_desc layout1_option"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '970', '1100'); ?></span>
              <span class="recommend_desc layout2_option"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '1450', '1100'); ?></span>
             </span>
             <div class="image_box cf">
              <div class="cf cf_media_field hide-if-no-js image_slider_<?php echo $cb_index; ?>_image<?php echo esc_attr( $repeater_key ); ?>">
               <input type="hidden" value="<?php if ( $repeater_value['image'] ) echo esc_attr( $repeater_value['image'] ); ?>" id="image_slider_<?php echo $cb_index; ?>_image<?php echo esc_attr( $repeater_key ); ?>" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][image]" class="cf_media_id">
               <div class="preview_field"><?php if ( $repeater_value['image'] ) echo wp_get_attachment_image( $repeater_value['image'], 'medium'); ?></div>
               <div class="button_area">
                <input type="button" value="<?php _e( 'Select Image', 'tcd-horizon' ); ?>" class="cfmf-select-img button">
                <input type="button" value="<?php _e( 'Remove Image', 'tcd-horizon' ); ?>" class="cfmf-delete-img button <?php if ( ! $repeater_value['image'] ) echo 'hidden'; ?>">
               </div>
              </div>
             </div>
            </li>
            <li class="cf">
             <span class="label">
              <?php _e('Background image (mobile)', 'tcd-horizon'); ?>
              <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '750', '1250'); ?></span>
             </span>
             <div class="image_box cf">
              <div class="cf cf_media_field hide-if-no-js image_slider_<?php echo $cb_index; ?>_image<?php echo esc_attr( $repeater_key ); ?>_mobile">
               <input type="hidden" value="<?php if ( $repeater_value['image_mobile'] ) echo esc_attr( $repeater_value['image_mobile'] ); ?>" id="image_slider_<?php echo $cb_index; ?>_image<?php echo esc_attr( $repeater_key ); ?>_mobile" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][image_mobile]" class="cf_media_id">
               <div class="preview_field"><?php if ( $repeater_value['image_mobile'] ) echo wp_get_attachment_image( $repeater_value['image_mobile'], 'medium'); ?></div>
               <div class="button_area">
                <input type="button" value="<?php _e( 'Select Image', 'tcd-horizon' ); ?>" class="cfmf-select-img button">
                <input type="button" value="<?php _e( 'Remove Image', 'tcd-horizon' ); ?>" class="cfmf-delete-img button <?php if ( ! $repeater_value['image_mobile'] ) echo 'hidden'; ?>">
               </div>
              </div>
             </div>
            </li>
           </ul>

           <?php // オーバーレイ ----------------------- ?>
           <h4 class="theme_option_headline2"><?php _e( 'Background overlay', 'tcd-horizon' ); ?></h4>
           <ul class="option_list">
            <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-horizon'); ?></span><input class="c-color-picker" type="text" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][overlay_color]" value="<?php echo esc_attr( $repeater_value['overlay_color'] ); ?>" data-default-color="#000000"></li>
            <li class="cf">
             <span class="label"><?php _e('Transparency of overlay', 'tcd-horizon'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][overlay_opacity]" value="<?php echo esc_attr( $repeater_value['overlay_opacity'] ); ?>" />
             <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
              <p><?php _e('Please specify the number of 0 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-horizon');  ?><br>
              <?php _e('Please enter 0 if you don\'t want to use overlay.', 'tcd-horizon');  ?></p>
             </div>
            </li>
           </ul>

         </div><!-- END .sub_box_tab_content -->

         <?php // キャッチフレーズ ----------------------- ?>
         <div class="sub_box_tab_content" data-tab-content="tab2">

           <?php // キャッチフレーズ ----------------------- ?>
           <h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-horizon' ); ?></h4>
           <textarea class="large-text" cols="50" rows="3" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][catch]"><?php echo esc_textarea(  $repeater_value['catch'] ); ?></textarea>
           <ul class="option_list">
            <li class="cf">
             <span class="label"><?php _e('Font type', 'tcd-horizon');  ?></span>
             <div class="standard_radio_button">
              <?php foreach ( $font_type_options as $option ) { ?>
              <input id="catch_font_type_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>_<?php echo esc_attr($option['value']); ?>" type="radio" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][catch_font_type]" value="<?php echo esc_attr($option['value']); ?>"<?php checked( $repeater_value['catch_font_type'], $option['value'] ); ?>>
              <label for="catch_font_type_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>_<?php echo esc_attr($option['value']); ?>"><?php echo esc_html($option['label']); ?></label>
              <?php } ?>
             </div>
            </li>
            <li class="cf">
             <span class="label"><?php _e('Font size', 'tcd-horizon'); ?></span>
             <div class="font_size_option">
              <label class="font_size_label number_option">
               <input class="hankaku input_font_size" type="number" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][catch_font_size]" value="<?php echo esc_attr( $repeater_value['catch_font_size'] ); ?>" min="9" max="100" />
               <span class="icon icon_pc"></span>
              </label>
              <label class="font_size_label number_option">
               <input class="hankaku input_font_size" type="number" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][catch_font_size_sp]" value="<?php echo esc_attr( $repeater_value['catch_font_size_sp'] ); ?>" min="9" max="100" />
               <span class="icon icon_sp"></span>
              </label>
             </div>
            </li>
           </ul>
           <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-horizon' ); ?></h4>
           <textarea class="large-text" cols="50" rows="4" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][desc]"><?php echo esc_textarea(  $repeater_value['desc'] ); ?></textarea>
 
           <?php // ボタン ----------------------- ?>
           <h4 class="theme_option_headline2"><?php _e('Button', 'tcd-horizon');  ?></h4>
           <p class="hidden"><input name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][show_button]" type="hidden" value="0"></p>
           <p class="displayment_checkbox"><label><input class="show_button" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][show_button]" type="checkbox" value="1" <?php checked( $repeater_value['show_button'], 1 ); ?>><?php _e( 'Display button', 'tcd-horizon' ); ?></label></p>
           <div style="<?php if($repeater_value['show_button'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
            <ul class="option_list">
             <li class="cf" style="border-top:1px dotted #ccc;">
              <span class="label"><?php _e('Type', 'tcd-horizon'); ?></span>
              <div class="standard_radio_button">
               <?php foreach ( $button_type_options as $option ) { ?>
               <input id="button_type_<?php echo esc_attr($option['value']); ?>_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>" type="radio" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][button_type]" value="<?php echo esc_attr($option['value']); ?>" <?php checked( $repeater_value['button_type'], $option['value'] ); ?>><label for="button_type_<?php echo esc_attr($option['value']); ?>_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>"><?php echo esc_html($option['label']); ?></label>
               <?php }; ?>
              </div>
             </li>
             <li class="cf">
              <span class="label"><?php _e('Shape', 'tcd-horizon'); ?></span>
              <div class="standard_radio_button">
               <?php foreach ( $button_border_radius_options as $option ) { ?>
               <input id="button_border_radius_<?php echo esc_attr($option['value']); ?>_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>" type="radio" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][button_border_radius]" value="<?php echo esc_attr($option['value']); ?>" <?php checked( $repeater_value['button_border_radius'], $option['value'] ); ?>><label for="button_border_radius_<?php echo esc_attr($option['value']); ?>_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>"><?php echo esc_html($option['label']); ?></label>
               <?php }; ?>
              </div>
             </li>
             <li class="cf"><span class="label">
              <?php _e('Size', 'tcd-horizon'); ?></span>
              <div class="standard_radio_button">
               <?php foreach ( $button_size_options as $option ) { ?>
               <input id="button_size_<?php echo esc_attr($option['value']); ?>_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>" type="radio" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][button_size]" value="<?php echo esc_attr($option['value']); ?>" <?php checked( $repeater_value['button_size'], $option['value'] ); ?>><label for="button_size_<?php echo esc_attr($option['value']); ?>_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>"><?php echo esc_html($option['label']); ?></label>
               <?php }; ?>
              </div>
             </li>
             <li class="cf"><span class="label">
              <?php _e('Mouseover animation', 'tcd-horizon'); ?></span>
              <div class="standard_radio_button">
               <?php foreach ( $button_animation_options as $option ) { ?>
               <input id="button_animation_type_<?php echo esc_attr($option['value']); ?>_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>" type="radio" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][button_animation_type]" value="<?php echo esc_attr($option['value']); ?>" <?php checked( $repeater_value['button_animation_type'], $option['value'] ); ?>><label for="button_animation_type_<?php echo esc_attr($option['value']); ?>_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>"><?php echo esc_html($option['label']); ?></label>
               <?php }; ?>
              </div>
             </li>
             <li class="cf"><span class="label"><?php _e('Color scheme', 'tcd-horizon'); ?></span><input type="text" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][button_color]" value="<?php echo esc_attr( $repeater_value['button_color'] ); ?>" data-default-color="#00b200" class="c-color-picker"></li>
             <li class="cf"><span class="label"><?php _e('Color scheme on mouseover', 'tcd-horizon'); ?></span><input type="text" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][button_color_hover]" value="<?php echo esc_attr( $repeater_value['button_color_hover'] ); ?>" data-default-color="#098700" class="c-color-picker"></li>
             <li class="cf"><span class="label"><?php _e('label', 'tcd-horizon'); ?></span><input class="full_width" type="text" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][button_label]" value="<?php echo esc_attr( $repeater_value['button_label'] ); ?>" /></li>
             <li class="cf"><span class="label"><?php _e('URL', 'tcd-horizon'); ?></span><input class="full_width" type="text" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][button_url]" value="<?php echo esc_attr( $repeater_value['button_url'] ); ?>"></li>
            </ul>
           </div>

         </div><!-- END .sub_box_tab_content -->

         <ul class="button_list cf">
          <li class="delete-row" style="float:right; margin-right:0;"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete item', 'tcd-horizon' ); ?></a></li>
         </ul>
        </div><!-- END .sub_box_content -->
       </div><!-- END .sub_box -->
       <?php
              $image_slider_item_num++;
              endforeach;
            endif;

            $repeater_key = 'addindex';
            $repeater_value = $cb_contents[$cb_content_select]['item_list_default'];
            ob_start();
       ?>
       <div class="sub_box repeater-item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
        <h4 class="theme_option_subbox_headline"><?php _e( 'New item', 'tcd-horizon' ); ?></h4>
        <div class="sub_box_content">

         <div class="sub_box_tab">
          <div class="tab active" data-tab="tab1"><?php _e('Background', 'tcd-horizon'); ?></div>
          <div class="tab" data-tab="tab2"><?php _e('Content', 'tcd-horizon'); ?></div>
         </div>

         <?php // 背景 ----------------------- ?>
         <div class="sub_box_tab_content active" data-tab-content="tab1">

           <h4 class="theme_option_headline2"><?php _e( 'Background image', 'tcd-horizon' ); ?></h4>
           <ul class="option_list">
            <li class="cf">
             <span class="label">
              <?php _e('Background image', 'tcd-horizon'); ?>
              <span class="recommend_desc layout1_option"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '970', '1100'); ?></span>
              <span class="recommend_desc layout2_option"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '1450', '1100'); ?></span>
             </span>
             <div class="image_box cf">
              <div class="cf cf_media_field hide-if-no-js image_slider_<?php echo $cb_index; ?>_image<?php echo esc_attr( $repeater_key ); ?>">
               <input type="hidden" value="<?php if ( $repeater_value['image'] ) echo esc_attr( $repeater_value['image'] ); ?>" id="image_slider_<?php echo $cb_index; ?>_image<?php echo esc_attr( $repeater_key ); ?>" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][image]" class="cf_media_id">
               <div class="preview_field"><?php if ( $repeater_value['image'] ) echo wp_get_attachment_image( $repeater_value['image'], 'medium'); ?></div>
               <div class="button_area">
                <input type="button" value="<?php _e( 'Select Image', 'tcd-horizon' ); ?>" class="cfmf-select-img button">
                <input type="button" value="<?php _e( 'Remove Image', 'tcd-horizon' ); ?>" class="cfmf-delete-img button <?php if ( ! $repeater_value['image'] ) echo 'hidden'; ?>">
               </div>
              </div>
             </div>
            </li>
            <li class="cf">
             <span class="label">
              <?php _e('Background image (mobile)', 'tcd-horizon'); ?>
              <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '750', '1250'); ?></span>
             </span>
             <div class="image_box cf">
              <div class="cf cf_media_field hide-if-no-js image_slider_<?php echo $cb_index; ?>_image<?php echo esc_attr( $repeater_key ); ?>_mobile">
               <input type="hidden" value="<?php if ( $repeater_value['image_mobile'] ) echo esc_attr( $repeater_value['image_mobile'] ); ?>" id="image_slider_<?php echo $cb_index; ?>_image<?php echo esc_attr( $repeater_key ); ?>_mobile" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][image_mobile]" class="cf_media_id">
               <div class="preview_field"><?php if ( $repeater_value['image_mobile'] ) echo wp_get_attachment_image( $repeater_value['image_mobile'], 'medium'); ?></div>
               <div class="button_area">
                <input type="button" value="<?php _e( 'Select Image', 'tcd-horizon' ); ?>" class="cfmf-select-img button">
                <input type="button" value="<?php _e( 'Remove Image', 'tcd-horizon' ); ?>" class="cfmf-delete-img button <?php if ( ! $repeater_value['image_mobile'] ) echo 'hidden'; ?>">
               </div>
              </div>
             </div>
            </li>
           </ul>

           <?php // オーバーレイ ----------------------- ?>
           <h4 class="theme_option_headline2"><?php _e( 'Background overlay', 'tcd-horizon' ); ?></h4>
           <ul class="option_list">
            <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-horizon'); ?></span><input class="c-color-picker" type="text" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][overlay_color]" value="<?php echo esc_attr( $repeater_value['overlay_color'] ); ?>" data-default-color="#000000"></li>
            <li class="cf">
             <span class="label"><?php _e('Transparency of overlay', 'tcd-horizon'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][overlay_opacity]" value="<?php echo esc_attr( $repeater_value['overlay_opacity'] ); ?>" />
             <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
              <p><?php _e('Please specify the number of 0 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-horizon');  ?></br>
              <?php _e('Please enter 0 if you don\'t want to use overlay.', 'tcd-horizon');  ?></p>
             </div>
            </li>
           </ul>

         </div><!-- END .sub_box_tab_content -->

         <?php // キャッチフレーズ ----------------------- ?>
         <div class="sub_box_tab_content" data-tab-content="tab2">

           <?php // キャッチフレーズ ----------------------- ?>
           <h4 class="theme_option_headline2"><?php _e( 'Catchphrase', 'tcd-horizon' ); ?></h4>
           <textarea class="large-text" cols="50" rows="3" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][catch]"><?php echo esc_textarea(  $repeater_value['catch'] ); ?></textarea>
           <ul class="option_list">
            <li class="cf">
             <span class="label"><?php _e('Font type', 'tcd-horizon');  ?></span>
             <div class="standard_radio_button">
              <?php foreach ( $font_type_options as $option ) { ?>
              <input id="catch_font_type_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>_<?php echo esc_attr($option['value']); ?>" type="radio" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][catch_font_type]" value="<?php echo esc_attr($option['value']); ?>"<?php checked( $repeater_value['catch_font_type'], $option['value'] ); ?>>
              <label for="catch_font_type_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>_<?php echo esc_attr($option['value']); ?>"><?php echo esc_html($option['label']); ?></label>
              <?php } ?>
             </div>
            </li>
            <li class="cf">
             <span class="label"><?php _e('Font size', 'tcd-horizon'); ?></span>
             <div class="font_size_option">
              <label class="font_size_label number_option">
               <input class="hankaku input_font_size" type="number" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][catch_font_size]" value="<?php echo esc_attr( $repeater_value['catch_font_size'] ); ?>" min="9" max="100" />
               <span class="icon icon_pc"></span>
              </label>
              <label class="font_size_label number_option">
               <input class="hankaku input_font_size" type="number" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][catch_font_size_sp]" value="<?php echo esc_attr( $repeater_value['catch_font_size_sp'] ); ?>" min="9" max="100" />
               <span class="icon icon_sp"></span>
              </label>
             </div>
            </li>
           </ul>
           <h4 class="theme_option_headline2"><?php _e( 'Description', 'tcd-horizon' ); ?></h4>
           <textarea class="large-text" cols="50" rows="4" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][desc]"><?php echo esc_textarea(  $repeater_value['desc'] ); ?></textarea>
 
           <?php // ボタン ----------------------- ?>
           <h4 class="theme_option_headline2"><?php _e('Button', 'tcd-horizon');  ?></h4>
           <p class="hidden"><input name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][show_button]" type="hidden" value="0"></p>
           <p class="displayment_checkbox"><label><input class="show_button" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][show_button]" type="checkbox" value="1" <?php checked( $repeater_value['show_button'], 1 ); ?>><?php _e( 'Display button', 'tcd-horizon' ); ?></label></p>
           <div style="<?php if($repeater_value['show_button'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
            <ul class="option_list">
             <li class="cf" style="border-top:1px dotted #ccc;">
              <span class="label"><?php _e('Type', 'tcd-horizon'); ?></span>
              <div class="standard_radio_button">
               <?php foreach ( $button_type_options as $option ) { ?>
               <input id="button_type_<?php echo esc_attr($option['value']); ?>_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>" type="radio" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][button_type]" value="<?php echo esc_attr($option['value']); ?>" <?php checked( $repeater_value['button_type'], $option['value'] ); ?>><label for="button_type_<?php echo esc_attr($option['value']); ?>_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>"><?php echo esc_html($option['label']); ?></label>
               <?php }; ?>
              </div>
             </li>
             <li class="cf">
              <span class="label"><?php _e('Shape', 'tcd-horizon'); ?></span>
              <div class="standard_radio_button">
               <?php foreach ( $button_border_radius_options as $option ) { ?>
               <input id="button_border_radius_<?php echo esc_attr($option['value']); ?>_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>" type="radio" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][button_border_radius]" value="<?php echo esc_attr($option['value']); ?>" <?php checked( $repeater_value['button_border_radius'], $option['value'] ); ?>><label for="button_border_radius_<?php echo esc_attr($option['value']); ?>_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>"><?php echo esc_html($option['label']); ?></label>
               <?php }; ?>
              </div>
             </li>
             <li class="cf"><span class="label">
              <?php _e('Size', 'tcd-horizon'); ?></span>
              <div class="standard_radio_button">
               <?php foreach ( $button_size_options as $option ) { ?>
               <input id="button_size_<?php echo esc_attr($option['value']); ?>_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>" type="radio" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][button_size]" value="<?php echo esc_attr($option['value']); ?>" <?php checked( $repeater_value['button_size'], $option['value'] ); ?>><label for="button_size_<?php echo esc_attr($option['value']); ?>_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>"><?php echo esc_html($option['label']); ?></label>
               <?php }; ?>
              </div>
             </li>
             <li class="cf"><span class="label">
              <?php _e('Mouseover animation', 'tcd-horizon'); ?></span>
              <div class="standard_radio_button">
               <?php foreach ( $button_animation_options as $option ) { ?>
               <input id="button_animation_type_<?php echo esc_attr($option['value']); ?>_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>" type="radio" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][button_animation_type]" value="<?php echo esc_attr($option['value']); ?>" <?php checked( $repeater_value['button_animation_type'], $option['value'] ); ?>><label for="button_animation_type_<?php echo esc_attr($option['value']); ?>_<?php echo $cb_index; ?>_<?php echo esc_attr( $repeater_key ); ?>"><?php echo esc_html($option['label']); ?></label>
               <?php }; ?>
              </div>
             </li>
             <li class="cf"><span class="label"><?php _e('Color scheme', 'tcd-horizon'); ?></span><input type="text" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][button_color]" value="<?php echo esc_attr( $repeater_value['button_color'] ); ?>" data-default-color="#00b200" class="c-color-picker"></li>
             <li class="cf"><span class="label"><?php _e('Color scheme on mouseover', 'tcd-horizon'); ?></span><input type="text" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][button_color_hover]" value="<?php echo esc_attr( $repeater_value['button_color_hover'] ); ?>" data-default-color="#098700" class="c-color-picker"></li>
             <li class="cf"><span class="label"><?php _e('label', 'tcd-horizon'); ?></span><input class="full_width" type="text" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][button_label]" value="<?php echo esc_attr( $repeater_value['button_label'] ); ?>" /></li>
             <li class="cf"><span class="label"><?php _e('URL', 'tcd-horizon'); ?></span><input class="full_width" type="text" name="lp_content[<?php echo $cb_index; ?>][item_list][<?php echo esc_attr( $repeater_key ); ?>][button_url]" value="<?php echo esc_attr( $repeater_value['button_url'] ); ?>"></li>
            </ul>
           </div>

         </div><!-- END .sub_box_tab_content -->

         <ul class="button_list cf">
          <li class="delete-row" style="float:right; margin-right:0;"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete item', 'tcd-horizon' ); ?></a></li>
         </ul>
        </div><!-- END .sub_box_content -->
       </div><!-- END .sub_box -->
       <?php
            $clone = ob_get_clean();
       ?>
      </div><!-- END .repeater -->
      <a href="#" class="button button-secondary button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php _e( 'Add item', 'tcd-horizon' ); ?></a>
     </div><!-- END .repeater-wrapper -->
     <?php // リピーターここまで -------------------------- ?>

    </div><!-- END .sub_box_content -->
   </div><!-- END .sub_box -->

   <?php // ニュースティッカーの設定 ---------- ?>
   <div class="sub_box cf">
    <h3 class="theme_option_subbox_headline"><?php _e('News ticker', 'tcd-horizon');  ?></h3>
    <div class="sub_box_content">

     <p class="hidden"><input name="lp_content[<?php echo $cb_index; ?>][show_news_ticker]" type="hidden" value="0"></p>
     <p class="displayment_checkbox"><label><input name="lp_content[<?php echo $cb_index; ?>][show_news_ticker]" type="checkbox" value="1" <?php checked( $value['show_news_ticker'], 1 ); ?>><?php _e( 'Display news ticker', 'tcd-horizon' ); ?></label></p>
     <div style="<?php if($value['show_news_ticker'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">
      <ul class="option_list">
       <li class="cf" style="border-top:1px dotted #ccc;"><span class="label"><?php _e('Post type', 'tcd-horizon'); ?></span>
        <select name="lp_content[<?php echo $cb_index; ?>][news_ticker_post_type]">
         <option style="padding-right: 10px;" value="post" <?php selected( $value['news_ticker_post_type'], 'post' ); ?>><?php echo __( 'Blog', 'tcd-horizon' ); ?></option>
         <option style="padding-right: 10px;" value="news" <?php selected( $value['news_ticker_post_type'], 'news' ); ?>><?php echo esc_html($news_label); ?></option>
        </select>
       </li>
       <li class="cf"><span class="label"><?php _e('Post order', 'tcd-horizon');  ?></span>
        <select name="lp_content[<?php echo $cb_index; ?>][news_ticker_post_order]">
         <option value="date" <?php selected($value['news_ticker_post_order'], 'date'); ?>><?php _e('Date', 'tcd-horizon'); ?></option>
         <option value="rand" <?php selected($value['news_ticker_post_order'], 'rand'); ?>><?php _e('Random', 'tcd-horizon'); ?></option>
        </select>
       </li>
      </ul>
     </div>

    </div><!-- END .sub_box_content -->
   </div><!-- END .sub_box -->

   <?php // 説明文の設定 ---------- ?>
   <div class="sub_box cf layout1_option">
    <h3 class="theme_option_subbox_headline"><?php _e('Right column description', 'tcd-horizon');  ?></h3>
    <div class="sub_box_content">

     <textarea style="margin-top:20px;" class="full_width" cols="50" rows="4" name="lp_content[<?php echo $cb_index; ?>][desc]"><?php echo esc_textarea(  $value['desc'] ); ?></textarea>
     <ul class="option_list">
      <li class="cf color_picker_bottom"><span class="label"><?php _e('Font color', 'tcd-horizon'); ?></span><input type="text" name="lp_content[<?php echo $cb_index; ?>][desc_font_color]" value="<?php echo esc_attr( $value['desc_font_color'] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      <li class="cf color_picker_bottom"><span class="label"><?php _e('Background color', 'tcd-horizon'); ?></span><input type="text" name="lp_content[<?php echo $cb_index; ?>][desc_bg_color]" value="<?php echo esc_attr( $value['desc_bg_color'] ); ?>" data-default-color="#ffffff" class="c-color-picker"></li>
     </ul>

    </div><!-- END .sub_box_content -->
   </div><!-- END .sub_box -->

   </div><!-- END .displayment_checkbox -->

   <ul class="button_list cf">
    <li><a href="#" class="button-ml close-content"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
   </ul>
  </div><!-- END .cb_content -->


  <?php
      // ボックスコンテンツ -------------------------------------------------------------------------
      elseif ( 'box_content' === $cb_content_select ) :
  ?>
  <h3 class="cb_content_headline"><?php echo esc_html( $cb_contents[$cb_content_select]['label'] ); ?></h3>
  <div class="cb_content">

   <p class="hidden"><input name="lp_content[<?php echo $cb_index; ?>][show_content]" type="hidden" value="0"></p>
   <p class="displayment_checkbox"><label><input name="lp_content[<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>> <?php _e('Display three box', 'tcd-horizon'); ?> (<a data-rel="lightcase" href="<?php bloginfo('template_url'); ?>/admin/img/cb_box.jpg"><?php _e('Sample', 'tcd-horizon'); ?></a>)</label></p>
   <div style="<?php if($value['show_content'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

   <?php // コンテンツ ------------------------------------------------------ ?>
   <?php for ( $i = 1; $i <= 3; $i++ ): ?>
   <div class="sub_box cf"> 
    <h3 class="theme_option_subbox_headline"><?php if($i == 1) { _e('Content (left)', 'tcd-horizon'); } elseif($i == 2) { _e('Content (center)', 'tcd-horizon'); } else { _e('Content (right)', 'tcd-horizon'); }; ?></h3>
    <div class="sub_box_content">

     <div class="sub_box_tab">
      <div class="tab active" data-tab="tab1"><?php _e('Background', 'tcd-horizon'); ?></div>
      <div class="tab" data-tab="tab2"><?php _e('Content', 'tcd-horizon'); ?></div>
     </div>

     <div class="sub_box_tab_content active" data-tab-content="tab1">

     <h4 class="theme_option_headline2"><?php _e('Background type', 'tcd-horizon'); ?></h4>
     <ul class="design_radio_button horizontal cf">
      <li class="cb_bg_type_type1">
       <input type="radio" id="bg_type1_<?php echo $cb_index; ?>_<?php echo $i; ?>" name="lp_content[<?php echo $cb_index; ?>][bg_type<?php echo $i; ?>]" value="type1" <?php checked( $value['bg_type'.$i], 'type1' ); ?> />
       <label for="bg_type1_<?php echo $cb_index; ?>_<?php echo $i; ?>"><?php _e('Image', 'tcd-horizon'); ?></label>
      </li>
      <li class="cb_bg_type_type2">
       <input type="radio" id="bg_type2_<?php echo $cb_index; ?>_<?php echo $i; ?>" name="lp_content[<?php echo $cb_index; ?>][bg_type<?php echo $i; ?>]" value="type2" <?php checked( $value['bg_type'.$i], 'type2' ); ?> />
       <label for="bg_type2_<?php echo $cb_index; ?>_<?php echo $i; ?>"><?php _e('Video', 'tcd-horizon'); ?></label>
      </li>
      <li class="cb_bg_type_type3">
       <input type="radio" id="bg_type3_<?php echo $cb_index; ?>_<?php echo $i; ?>" name="lp_content[<?php echo $cb_index; ?>][bg_type<?php echo $i; ?>]" value="type3" <?php checked( $value['bg_type'.$i], 'type3' ); ?> />
       <label for="bg_type3_<?php echo $cb_index; ?>_<?php echo $i; ?>"><?php _e('Youtube', 'tcd-horizon'); ?></label>
      </li>
      <li class="cb_bg_type_type4">
       <input type="radio" id="bg_type4_<?php echo $cb_index; ?>_<?php echo $i; ?>" name="lp_content[<?php echo $cb_index; ?>][bg_type<?php echo $i; ?>]" value="type4" <?php checked( $value['bg_type'.$i], 'type4' ); ?> />
       <label for="bg_type4_<?php echo $cb_index; ?>_<?php echo $i; ?>"><?php _e('Only background color', 'tcd-horizon'); ?></label>
      </li>
     </ul>

     <div class="video_bg_option">

      <h4 class="theme_option_headline2"><?php _e('Video', 'tcd-horizon'); ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('Please upload MP4 format file.', 'tcd-horizon');  ?></p>
       <p><?php _e('Web browser takes few second to load the data of video so we recommend to use loading screen if you want to display video.', 'tcd-horizon'); ?></p>
      </div>
      <div class="image_box cf">
       <div class="cf cf_media_field hide-if-no-js video_<?php echo $cb_index; ?>_<?php echo $i; ?>">
        <input type="hidden" value="<?php echo esc_attr( $value['video'.$i] ); ?>" id="video_<?php echo $cb_index; ?>_<?php echo $i; ?>" name="lp_content[<?php echo $cb_index; ?>][video<?php echo $i; ?>]" class="cf_media_id">
        <div class="preview_field preview_field_video">
         <?php if($value['video'.$i]){ ?>
         <h4><?php _e( 'Uploaded MP4 file', 'tcd-horizon' ); ?></h4>
         <p><?php echo esc_url(wp_get_attachment_url($value['video'.$i])); ?></p>
         <?php }; ?>
        </div>
        <div class="buttton_area">
         <input type="button" value="<?php _e('Select MP4 file', 'tcd-horizon'); ?>" class="cfmf-select-video button">
         <input type="button" value="<?php _e('Remove MP4 file', 'tcd-horizon'); ?>" class="cfmf-delete-video button <?php if(!$value['video'.$i]){ echo 'hidden'; }; ?>">
        </div>
       </div>
      </div>

     </div><!-- # END .video_bg_option -->

     <div class="youtube_bg_option">

      <h4 class="theme_option_headline2"><?php _e('Youtube', 'tcd-horizon'); ?></h4>
      <div class="theme_option_message2">
       <p><?php _e('Please enter Youtube URL.', 'tcd-horizon');  ?></p>
       <p><?php _e('Web browser takes few second to load the data of video so we recommend to use loading screen if you want to display video.', 'tcd-horizon'); ?></p>
      </div>
      <input class="regular-text" type="text" name="lp_content[<?php echo $cb_index; ?>][youtube<?php echo $i; ?>]" value="<?php echo esc_attr( $value['youtube'.$i] ); ?>">

     </div><!-- # END .youtube_bg_option -->

     <div class="non_color_bg_option">

     <h4 class="theme_option_headline2 image_bg_option"><?php _e('Image', 'tcd-horizon'); ?></h4>
     <h4 class="theme_option_headline2 video_bg_option"><?php _e('Substitute image', 'tcd-horizon'); ?></h4>
     <div class="theme_option_message2 video_bg_option">
      <p><?php _e('If the mobile device can\'t play video this image will be displayed instead.', 'tcd-horizon');  ?></p>
      <p class="youtube_bg_option"><?php _e('If the mobile device can\'t play video this image will be displayed instead.', 'tcd-horizon');  ?></p>
     </div>
     <h4 class="theme_option_headline2 youtube_bg_option"><?php _e('Substitute image', 'tcd-horizon'); ?></h4>
     <div class="theme_option_message2 youtube_bg_option">
      <p><?php _e('If the mobile device can\'t play video this image will be displayed instead.', 'tcd-horizon');  ?></p>
     </div>
     <ul class="option_list">
      <li class="cf">
       <span class="label">
        <?php _e('Image', 'tcd-horizon'); ?>
        <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '480', '1100'); ?></span>
       </span>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js image<?php echo $i; ?>-<?php echo $cb_index; ?>">
         <input type="hidden" class="cf_media_id" name="lp_content[<?php echo $cb_index; ?>][image<?php echo $i; ?>]" id="image<?php echo $i; ?>-<?php echo $cb_index; ?>" value="<?php echo esc_attr( $value['image'.$i] ); ?>">
         <div class="preview_field"><?php if ( $value['image'.$i] ) echo wp_get_attachment_image( $value['image'.$i], 'medium' ); ?></div>
         <div class="buttton_area">
          <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-horizon' ); ?>">
          <input type="button" class="cfmf-delete-img button<?php if ( empty($value['image'.$i]) ) { echo ' hidden'; }; ?>" value="<?php _e( 'Remove Image', 'tcd-horizon'); ?>">
         </div>
        </div>
       </div>
      </li>
      <li class="cf image_bg_option">
       <span class="label">
        <?php _e('Image (mobile)', 'tcd-horizon'); ?>
        <span class="recommend_desc"><?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '750', '1680'); ?></span>
       </span>
       <div class="image_box cf">
        <div class="cf cf_media_field hide-if-no-js image_mobile<?php echo $i; ?>-<?php echo $cb_index; ?>">
         <input type="hidden" class="cf_media_id" name="lp_content[<?php echo $cb_index; ?>][image_mobile<?php echo $i; ?>]" id="image_mobile<?php echo $i; ?>-<?php echo $cb_index; ?>" value="<?php echo esc_attr( $value['image_mobile'.$i] ); ?>">
         <div class="preview_field"><?php if ( $value['image_mobile'.$i] ) echo wp_get_attachment_image( $value['image_mobile'.$i], 'medium' ); ?></div>
         <div class="buttton_area">
          <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-horizon' ); ?>">
          <input type="button" class="cfmf-delete-img button<?php if ( empty($value['image_mobile'.$i]) ) { echo ' hidden'; }; ?>" value="<?php _e( 'Remove Image', 'tcd-horizon'); ?>">
         </div>
        </div>
       </div>
      </li>
     </ul>

     <h4 class="theme_option_headline2"><?php _e( 'Parallax effect for background image', 'tcd-horizon' ); ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('You can express a three-dimensional effect and depth background.', 'tcd-horizon'); ?><br>
     </div>
     <p class="hidden"><input name="lp_content[<?php echo $cb_index; ?>][use_para<?php echo $i; ?>]" type="hidden" value="0"></p>
     <p><label><input class="use_para_checkbox" name="lp_content[<?php echo $cb_index; ?>][use_para<?php echo $i; ?>]" type="checkbox" value="1" <?php checked( $value['use_para'.$i], 1 ); ?>><?php _e( 'Use parallax effect', 'tcd-horizon' ); ?></label></p>

     <h4 class="theme_option_headline2"><span class="image_bg_option"><?php _e( 'Overlay for image', 'tcd-horizon' ); ?></span><span class="video_bg_option"><?php _e( 'Overlay for video', 'tcd-horizon' ); ?></span><span class="youtube_bg_option"><?php _e( 'Overlay for video', 'tcd-horizon' ); ?></span></h4>
     <ul class="option_list">
      <li class="cf"><span class="label"><?php _e('Color of overlay', 'tcd-horizon'); ?></span><input type="text" name="lp_content[<?php echo $cb_index; ?>][overlay_color<?php echo $i; ?>]" value="<?php echo esc_attr( $value['overlay_color'.$i] ); ?>" data-default-color="#000000" class="c-color-picker"></li>
      <li class="cf">
       <span class="label"><?php _e('Transparency of overlay', 'tcd-horizon'); ?></span><input class="hankaku" style="width:70px;" type="number" max="1" min="0" step="0.1" name="lp_content[<?php echo $cb_index; ?>][overlay_opacity<?php echo $i; ?>]" value="<?php echo esc_attr( $value['overlay_opacity'.$i] ); ?>" />
       <div class="theme_option_message2" style="clear:both; margin:7px 0 0 0;">
        <p><?php _e('Please specify the number of 0 from 0.9. Overlay color will be more transparent as the number is small.', 'tcd-horizon');  ?><br>
        <?php _e('Please enter 0 if you don\'t want to use overlay.', 'tcd-horizon');  ?></p>
       </div>
      </li>
     </ul>

     </div><!-- END .non_color_bg_option -->

     <div class="color_bg_option">
      <h4 class="theme_option_headline2"><?php _e('Background color', 'tcd-horizon');  ?></h4>
      <div class="color_picker_bottom"><input type="text" name="lp_content[<?php echo $cb_index; ?>][bg_color<?php echo $i; ?>]" value="<?php echo esc_attr( $value['bg_color'.$i] ); ?>" data-default-color="<?php if($i == 1){ echo '#ffffff'; } elseif($i == 2){ echo '#555555'; } else { echo '#f6f7f8'; }; ?>" class="c-color-picker"></div>
     </div>

     </div>
     <div class="sub_box_tab_content" data-tab-content="tab2">

     <h4 class="theme_option_headline2"><?php _e('Headline', 'tcd-horizon');  ?></h4>
     <input type="text" class="full_width" name="lp_content[<?php echo $cb_index; ?>][headline<?php echo $i; ?>]" value="<?php echo esc_html(  $value['headline'.$i] ); ?>" />

     <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-horizon');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('If it is a plan etc., please describe the outline here.', 'tcd-horizon');  ?></p>
     </div>
     <textarea class="large-text" cols="50" rows="3" name="lp_content[<?php echo $cb_index; ?>][desc_top<?php echo $i; ?>]"><?php echo esc_textarea(  $value['desc_top'.$i] ); ?></textarea>

     <h4 class="theme_option_headline2"><?php _e('Description with background', 'tcd-horizon');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Since it is displayed with the background in the center part, please describe the points you want to stand out most.', 'tcd-horizon');  ?></p>
     </div>
     <textarea class="large-text" cols="50" rows="3" name="lp_content[<?php echo $cb_index; ?>][desc_middle<?php echo $i; ?>]"><?php echo esc_textarea(  $value['desc_middle'.$i] ); ?></textarea>

     <h4 class="theme_option_headline2"><?php _e('Supplementary description', 'tcd-horizon');  ?></h4>
     <div class="theme_option_message2">
      <p><?php _e('Since this is displayed small at the bottom, it can be used for supplementary explanations. ', 'tcd-horizon');  ?></p>
     </div>
     <textarea class="large-text" cols="50" rows="3" name="lp_content[<?php echo $cb_index; ?>][desc_bottom<?php echo $i; ?>]"><?php echo esc_textarea(  $value['desc_bottom'.$i] ); ?></textarea>

     <h4 class="theme_option_headline2"><?php _e('Text color', 'tcd-horizon');  ?></h4>
     <div class="color_picker_bottom"><input type="text" name="lp_content[<?php echo $cb_index; ?>][font_color<?php echo $i; ?>]" value="<?php echo esc_attr( $value['font_color'.$i] ); ?>" data-default-color="<?php if($i == 1){ echo '#ffffff'; } elseif($i == 2){ echo '#ffffff'; } else { echo '#000000'; }; ?>" class="c-color-picker"></div>

     </div>

     <ul class="button_list cf">
      <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
     </ul>

    </div><!-- END .sub_box_content -->
   </div><!-- END .sub_box -->
   <?php endfor; ?>

   </div><!-- END .displayment_checkbox -->

   <ul class="button_list cf">
    <li><a href="#" class="button-ml close-content"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
   </ul>
  </div><!-- END .cb_content -->


  <?php
      // アクセスマップ -------------------------------------------------------------------------
      elseif ( 'access_map' === $cb_content_select ) :
  ?>
  <h3 class="cb_content_headline"><?php echo esc_html( $cb_contents[$cb_content_select]['label'] ); ?></h3>
  <div class="cb_content">

   <p class="hidden"><input name="lp_content[<?php echo $cb_index; ?>][show_content]" type="hidden" value="0"></p>
   <p class="displayment_checkbox"><label><input name="lp_content[<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>> <?php _e('Display access map', 'tcd-horizon'); ?> (<a data-rel="lightcase" href="<?php bloginfo('template_url'); ?>/admin/img/cb_access.jpg"><?php _e('Sample', 'tcd-horizon'); ?></a>)</label></p>
   <div style="<?php if($value['show_content'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

   <div class="theme_option_message2" style="margin-top:20px;">
    <p><?php _e('Please set Google map information from quick tag menu in <a href="../wp-admin/admin.php?page=theme_options" target="_blank">theme option page</a>.', 'tcd-horizon');  ?></p>
   </div>

   <h4 class="theme_option_headline2"><?php _e('Map address', 'tcd-horizon');  ?></h4>
   <input type="text" class="full_width" name="lp_content[<?php echo $cb_index; ?>][address]" value="<?php echo esc_html(  $value['address'] ); ?>" />

   <h4 class="theme_option_headline2"><?php _e('Logo', 'tcd-horizon');  ?></h4>
   <div class="theme_option_message2">
    <p><?php _e('Logo image which you registered in theme option will be displayed.', 'tcd-horizon');  ?></p>
   </div>
   <p class="hidden"><input name="lp_content[<?php echo $cb_index; ?>][show_logo]" type="hidden" value="0"></p>
   <p><label><input name="lp_content[<?php echo $cb_index; ?>][show_logo]" type="checkbox" value="1" <?php checked( $value['show_logo'], 1 ); ?>><?php _e( 'Display logo', 'tcd-horizon' ); ?></label></p>

   <h4 class="theme_option_headline2"><?php _e('Description', 'tcd-horizon');  ?></h4>
   <textarea class="large-text" cols="50" rows="3" name="lp_content[<?php echo $cb_index; ?>][desc]"><?php echo esc_textarea(  $value['desc'] ); ?></textarea>

   <h4 class="theme_option_headline2"><?php _e('SNS icon', 'tcd-horizon'); ?></h4>
   <div class="theme_option_message2">
    <p><?php _e('You can set SNS icon from "Share button, SNS icon" section in basic settings.', 'tcd-horizon');  ?></p>
   </div>
   <p class="hidden"><input name="lp_content[<?php echo $cb_index; ?>][show_sns]" type="hidden" value="0"></p>
   <p><label><input name="lp_content[<?php echo $cb_index; ?>][show_sns]" type="checkbox" value="1" <?php checked( $value['show_sns'], 1 ); ?>><?php _e( 'Display SNS icon', 'tcd-horizon' ); ?></label></p>

   <h4 class="theme_option_headline2"><?php _e('Background color', 'tcd-horizon'); ?></h4>
   <div class="color_picker_bottom"><input type="text" name="lp_content[<?php echo $cb_index; ?>][bg_color]" value="<?php echo esc_attr( $value['bg_color'] ); ?>" data-default-color="#f3f3f3" class="c-color-picker"></div>

   </div><!-- END .displayment_checkbox -->

   <ul class="button_list cf">
    <li><a href="#" class="button-ml close-content"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
   </ul>
  </div><!-- END .cb_content -->


  <?php
      // フリースペース -------------------------------------------------------------------------
      elseif ( 'free_space' === $cb_content_select ) :
  ?>
  <h3 class="cb_content_headline"><?php echo esc_html( $cb_contents[$cb_content_select]['label'] ); ?></h3>
  <div class="cb_content">

   <p class="hidden"><input name="lp_content[<?php echo $cb_index; ?>][show_content]" type="hidden" value="0"></p>
   <p class="displayment_checkbox"><label><input name="lp_content[<?php echo $cb_index; ?>][show_content]" type="checkbox" value="1" <?php checked( $value['show_content'], 1 ); ?>> <?php _e('Display free space', 'tcd-horizon'); ?></label></p>
   <div style="<?php if($value['show_content'] == 1) { echo 'display:block;'; } else { echo 'display:none;'; }; ?>">

   <h4 class="theme_option_headline2"><?php _e('Content', 'tcd-horizon');  ?></h4>
   <?php wp_editor( $value['free_space'], 'cb_wysiwyg_editor-' . $cb_index, array ( 'tinymce' => array('body_class' => 'cb_wysiwyg_editor'), 'textarea_name' => 'lp_content[' . $cb_index . '][free_space]' ) ); ?>

   <h4 class="theme_option_headline2"><?php _e('Others', 'tcd-horizon');  ?></h4>
   <p class="hidden"><input name="lp_content[<?php echo $cb_index; ?>][show_border]" type="hidden" value="0"></p>
   <ul class="option_list">
    <li class="cf"><span class="label"><?php _e('Space around content', 'tcd-horizon'); ?></span><input class="font_size hankaku" type="text" name="lp_content[<?php echo $cb_index; ?>][padding]" value="<?php esc_attr_e( $value['padding'] ); ?>" /><span>px</span></li>
    <li class="cf"><span class="label"><?php _e('Space around content (mobile)', 'tcd-horizon'); ?></span><input class="font_size hankaku" type="text" name="lp_content[<?php echo $cb_index; ?>][padding_mobile]" value="<?php esc_attr_e( $value['padding_mobile'] ); ?>" /><span>px</span></li>
   </ul>

   </div><!-- END .displayment_checkbox -->

   <ul class="button_list cf">
    <li><a href="#" class="button-ml close-content"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
   </ul>
  </div><!-- END .cb_content -->

  <?php
       // ボタンを表示 ----------------------------------------------------------------------------
       else :
  ?>
  <h3 class="cb_content_headline"><?php echo esc_html( $cb_content_select ); ?></h3>
  <div class="cb_content">
   <ul class="button_list cf">
    <li><a href="#" class="button-ml close-content"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
   </ul>
  </div>
  <?php endif; ?>

  </div><!-- END .cb_content_wrap -->
<?php
}

/**
 * クローン用のリッチエディター化処理をしないようにする
 * クローン後のリッチエディター化はjsで行う
 */
function cb_tiny_mce_before_init( $mceInit, $editor_id ) {
  if ( strpos( $editor_id, 'cb_cloneindex' ) !== false ) {
    $mceInit['wp_skip_init'] = true;
  }
  return $mceInit;
}
add_filter( 'tiny_mce_before_init', 'cb_tiny_mce_before_init', 10, 2 );
