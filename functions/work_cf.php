<?php

function work_meta_box() {
  add_meta_box(
    'work_meta_box',//ID of meta box
   __('Basic setting', 'tcd-horizon'),//label
    'show_work_meta_box',//callback function
    'work',// post type
    'normal',// context
    'high'// priority
  );
}
add_action('add_meta_boxes', 'work_meta_box');

function show_work_meta_box() {
  global $post;

  $options = get_design_plus_option();
  $work_label = $options['work_label'] ? esc_html( $options['work_label'] ) : __( 'Work', 'tcd-horizon' );

  $accent_color = get_post_meta($post->ID, 'accent_color', true) ?  get_post_meta($post->ID, 'accent_color', true) : '#0b5d7c';
  $single_desc = get_post_meta($post->ID, 'single_desc', true);
  $archive_desc = get_post_meta($post->ID, 'archive_desc', true);
  $gallery_layout = get_post_meta($post->ID, 'gallery_layout', true) ?  get_post_meta($post->ID, 'gallery_layout', true) : 'type1';

  $data_list = get_post_meta($post->ID, 'data_list', true);

  // コンテンツビルダー
  $work_content = get_post_meta( $post->ID, 'work_content', true );

  echo '<input type="hidden" name="work_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

  //入力欄 ***************************************************************************************************************************************************************************************
?>

<div class="tcd_custom_field_wrap contents_builder_wrap">

 <div class="theme_option_field cf theme_option_field_ac open active">
  <div class="theme_option_field_ac_content">

   <h4 class="theme_option_headline2"><?php _e( 'Accent color', 'tcd-horizon' ); ?></h4>
   <p><input type="text" name="accent_color" value="<?php echo esc_attr( $accent_color ); ?>" data-default-color="#0b5d7c" class="c-color-picker"></p>

   <h3 class="theme_option_headline2"><?php _e('Description for single page', 'tcd-horizon'); ?></h3>
   <textarea class="full_width" cols="50" rows="3" name="single_desc"><?php echo esc_textarea(  $single_desc ); ?></textarea>

   <h3 class="theme_option_headline2"><?php _e('Description for archive page', 'tcd-horizon'); ?></h3>
   <textarea class="full_width" cols="50" rows="3" name="archive_desc"><?php echo esc_textarea(  $archive_desc ); ?></textarea>

   <h3 class="theme_option_headline2"><?php _e( 'Image for mega menu', 'tcd-horizon' ); ?></h3>
   <div class="theme_option_message2">
    <p>
     <?php _e( 'Please register image if you want to use mega menu.', 'tcd-horizon' ); ?><br>
     <?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '480', '200'); ?>
    </p>
   </div>
   <?php mlcf_media_form('mega_image', __('Image', 'tcd-horizon')); ?>

   <h4 class="theme_option_headline2"><?php _e( 'Gallery', 'tcd-horizon' ); ?></h4>
   <ul class="design_radio_button cf">
    <li id="work_gallery_layout_type1">
     <input type="radio" id="work_gallery_layout_type1_button" name="gallery_layout" value="type1" <?php checked( $gallery_layout, 'type1' ); ?> />
     <label for="work_gallery_layout_type1_button"><?php _e( 'Display image by two row', 'tcd-horizon' ); ?></label>
    </li>
    <li id="work_gallery_layout_type2">
     <input type="radio" id="work_gallery_layout_type2_button" name="gallery_layout" value="type2" <?php checked( $gallery_layout, 'type2' ); ?> />
     <label for="work_gallery_layout_type2_button"><?php _e( 'Display image by one row', 'tcd-horizon' ); ?></label>
    </li>
   </ul>

   <div id="work_gallery_layout2" style="margin-top:30px;">
    <?php // スライダー ------------------------------------------------------------------------- ?>
    <div class="theme_option_message2">
     <?php echo __( '<p>STEP1: Click add item button.<br />STEP2: Input data and save the option.</p><p>You can change order by dragging headline and you can delete content by clicking DELETE button.</p>', 'tcd-horizon' ); ?>
    </div>
    <?php //繰り返しフィールド ----- ?>
    <div class="repeater-wrapper">
     <div class="repeater sortable" data-delete-confirm="<?php _e( 'Delete?', 'tcd-horizon' ); ?>">
      <?php
           if ( $data_list ) :
             foreach ( $data_list as $key => $value ) :
      ?>
      <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
       <h4 class="theme_option_subbox_headline"><?php _e( 'Item', 'tcd-horizon' ); echo esc_attr( $key+1 ); ?></h4>
       <div class="sub_box_content">
        <h4 class="theme_option_headline2"><?php _e( 'Image', 'tcd-horizon' ); ?></h4>
        <div class="theme_option_message2">
         <p><?php _e('If the caption is registered, it will be displayed on the front screen.', 'tcd-horizon'); ?></p>
        </div>
        <div class="image_box cf">
         <div class="cf cf_media_field hide-if-no-js work_gallery_type2_image_<?php echo esc_attr( $key ); ?>">
          <input type="hidden" value="<?php if ( $data_list[$key]['image'] ) echo esc_attr( $data_list[$key]['image'] ); ?>" id="work_gallery_type2_image_<?php echo esc_attr( $key ); ?>" name="data_list[<?php echo esc_attr( $key ); ?>][image]" class="cf_media_id">
          <div class="preview_field"><?php if ( $data_list[$key]['image'] ) echo wp_get_attachment_image( $data_list[$key]['image'], 'medium'); ?></div>
          <div class="button_area">
           <input type="button" value="<?php _e( 'Select Image', 'tcd-horizon' ); ?>" class="cfmf-select-img button">
           <input type="button" value="<?php _e( 'Remove Image', 'tcd-horizon' ); ?>" class="cfmf-delete-img button <?php if ( ! $data_list[$key]['image'] ) echo 'hidden'; ?>">
          </div>
         </div>
        </div>
        <ul class="button_list cf">
         <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
         <li class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete item', 'tcd-horizon' ); ?></a></li>
        </ul>
       </div><!-- END .sub_box_content -->
      </div><!-- END .sub_box -->
      <?php
             endforeach;
           endif;
           $key = 'addindex';
           ob_start();
      ?>
      <div class="sub_box repeater-item repeater-item-<?php echo $key; ?>">
       <h4 class="theme_option_subbox_headline"><?php echo __( 'New item', 'tcd-horizon' ); ?></h4>
       <div class="sub_box_content">
        <h4 class="theme_option_headline2"><?php _e( 'Image', 'tcd-horizon' ); ?></h4>
        <div class="theme_option_message2">
         <p><?php _e('If the caption is registered, it will be displayed on the front screen.', 'tcd-horizon'); ?></p>
        </div>
        <div class="image_box cf">
         <div class="cf cf_media_field hide-if-no-js work_gallery_type2_image_<?php echo esc_attr( $key ); ?>">
          <input type="hidden" value="" id="work_gallery_type2_image_<?php echo esc_attr( $key ); ?>" name="data_list[<?php echo esc_attr( $key ); ?>][image]" class="cf_media_id">
          <div class="preview_field"></div>
          <div class="button_area">
           <input type="button" value="<?php _e( 'Select Image', 'tcd-horizon' ); ?>" class="cfmf-select-img button">
           <input type="button" value="<?php _e( 'Remove Image', 'tcd-horizon' ); ?>" class="cfmf-delete-img button hidden">
          </div>
         </div>
        </div>
        <ul class="button_list cf">
         <li><a class="close_sub_box button-ml" href="#"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
         <li class="delete-row"><a class="button-delete-row button-ml red_button" href="#"><?php echo __( 'Delete item', 'tcd-horizon' ); ?></a></li>
        </ul>
       </div><!-- END .sub_box_content -->
      </div><!-- END .sub_box -->
      <?php
           $clone = ob_get_clean();
      ?>
     </div><!-- END .repeater -->
     <a href="#" style="height:40px; line-height:40px;" class="button-ml button-add-row" data-clone="<?php echo esc_attr( $clone ); ?>"><?php _e( 'Add item', 'tcd-horizon' ); ?></a>
    </div><!-- END .repeater-wrapper -->
    <?php //繰り返しフィールドここまで ----- ?>
   </div><!-- END #work_gallery_layout1 -->

  </div><!-- END .theme_option_field_ac_content -->
 </div><!-- END .theme_option_field -->

 <div id="work_gallery_layout1">

 <div class="theme_option_message">
  <?php echo __( '<p>STEP1: Click add content button.<br />STEP2: Select content from dropdown menu.<br />STEP3: Input data and save the option.</p><br /><p>You can change order by dragging MOVE button and you can delete content by clicking DELETE button.</p>', 'tcd-horizon' ); ?>
  <br>
  <h4 class="content_builder_headline"><?php _e( 'Content image', 'tcd-horizon' ); ?></h4>
  <ul class="design_button_list cf">
   <li><a data-rel="lightcase:workimage" href="<?php bloginfo('template_url'); ?>/admin/img/works_portrait1.jpg" title="<?php _e( 'Layout1', 'tcd-horizon' ); ?>"><?php _e( 'Layout1', 'tcd-horizon' ); ?></a></li>
   <li><a data-rel="lightcase:workimage" href="<?php bloginfo('template_url'); ?>/admin/img/works_portrait2.jpg" title="<?php _e( 'Layout2', 'tcd-horizon' ); ?>"><?php _e( 'Layout2', 'tcd-horizon' ); ?></a></li>
   <li><a data-rel="lightcase:workimage" href="<?php bloginfo('template_url'); ?>/admin/img/works_portrait3.jpg" title="<?php _e( 'Layout3', 'tcd-horizon' ); ?>"><?php _e( 'Layout3', 'tcd-horizon' ); ?></a></li>
  </ul>
 </div>


 <?php
      // コンテンツビルダーはここから -----------------------------------------------------------------
 ?>
 <div class="contents_builder">
  <p class="cb_message"><?php _e( 'Click Add content button to start content builder', 'tcd-horizon' ); ?></p>
  <?php
       if ( $work_content && is_array( $work_content ) ) :
         foreach( $work_content as $key => $content ) :
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
          work_content_select( $cb_index, $content['cb_content_select'] );
          if ( ! empty( $content['cb_content_select'] ) ) :
            work_content_setting( $cb_index, $content['cb_content_select'], $content );
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
       <?php work_content_select( 'cb_cloneindex' ); ?>
    </div><!-- END .cb_column -->
   </div><!-- END .cb_column_area -->
  </div><!-- END .cb_row -->
  <?php
       foreach ( work_get_contents() as $key => $value ) :
         work_content_setting( 'cb_cloneindex', $key );
       endforeach;
  ?>
 </div><!-- END .contents_builder-clone -->

 </div><!-- END #work_gallery_layout1 -->

</div><!-- END .tcd_custom_field_wrap -->
<?php
}

function save_work_meta_box( $post_id ) {

  // verify nonce
  if (!isset($_POST['work_meta_box_nonce']) || !wp_verify_nonce($_POST['work_meta_box_nonce'], basename(__FILE__))) {
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

  // save or delete
  $cf_keys = array(
    'accent_color','single_desc','archive_desc','gallery_layout','mega_image'
  );
  foreach ($cf_keys as $cf_key) {
    $old = get_post_meta($post_id, $cf_key, true);

    if (isset($_POST[$cf_key])) {
      $new = $_POST[$cf_key];
    } else {
      $new = '';
    }

    if ($new && $new != $old) {
      update_post_meta($post_id, $cf_key, $new);
    } elseif ('' == $new && $old) {
      delete_post_meta($post_id, $cf_key, $old);
    }
  }

  // repeater save or delete
  $cf_keys = array( 'data_list' );
  foreach ( $cf_keys as $cf_key ) {
    $old = get_post_meta( $post_id, $cf_key, true );

    if ( isset( $_POST[$cf_key] ) && is_array( $_POST[$cf_key] ) ) {
      $new = array_values( $_POST[$cf_key] );
    } else {
      $new = false;
    }

    if ( $new && $new != $old ) {
      update_post_meta( $post_id, $cf_key, $new );
    } elseif ( ! $new && $old ) {
      delete_post_meta( $post_id, $cf_key, $old );
    }
  }

	// コンテンツビルダー 整形保存
	if ( ! empty( $_POST['work_content'] ) && is_array( $_POST['work_content'] ) ) {
		$cb_contents = work_get_contents();
		$cb_data = array();

		foreach ( $_POST['work_content'] as $key => $value ) {
			// クローン用はスルー
			if ( 'cb_cloneindex' === $key ) continue;

			// コンテンツデフォルト値に入力値をマージ
			if ( ! empty( $value['cb_content_select'] ) && isset( $cb_contents[$value['cb_content_select']]['default'] ) ) {
				$value = array_merge( (array) $cb_contents[$value['cb_content_select']]['default'], $value );
			}

			// レイアウト1
			if ( 'layout1' === $value['cb_content_select'] ) {

        $value['image1'] = wp_filter_nohtml_kses( $value['image1'] );
        $value['image2'] = wp_filter_nohtml_kses( $value['image2'] );
        $value['image3'] = wp_filter_nohtml_kses( $value['image3'] );
        $value['image4'] = wp_filter_nohtml_kses( $value['image4'] );
        $value['image5'] = wp_filter_nohtml_kses( $value['image5'] );
        $value['image6'] = wp_filter_nohtml_kses( $value['image6'] );

			// レイアウト2
			} elseif ( 'layout2' === $value['cb_content_select'] ) {

        $value['image1'] = wp_filter_nohtml_kses( $value['image1'] );
        $value['image2'] = wp_filter_nohtml_kses( $value['image2'] );
        $value['image3'] = wp_filter_nohtml_kses( $value['image3'] );
        $value['image4'] = wp_filter_nohtml_kses( $value['image4'] );

			// レイアウト3
			} elseif ( 'layout3' === $value['cb_content_select'] ) {

        $value['image1'] = wp_filter_nohtml_kses( $value['image1'] );
        $value['image2'] = wp_filter_nohtml_kses( $value['image2'] );
        $value['image3'] = wp_filter_nohtml_kses( $value['image3'] );
        $value['image4'] = wp_filter_nohtml_kses( $value['image4'] );
        $value['image5'] = wp_filter_nohtml_kses( $value['image5'] );
        $value['image6'] = wp_filter_nohtml_kses( $value['image6'] );
        $value['image7'] = wp_filter_nohtml_kses( $value['image7'] );
        $value['image8'] = wp_filter_nohtml_kses( $value['image8'] );

			}

			$cb_data[] = $value;
		}

		if ( $cb_data ) {
			update_post_meta( $post_id, 'work_content', $cb_data );
		} else {
			delete_post_meta( $post_id, 'work_content' );
		}
	}
}
add_action('save_post', 'save_work_meta_box');


/**
 * コンテンツビルダー コンテンツ一覧取得
 */
function work_get_contents() {
	return array(
    // レイアウト1
		'layout1' => array(
			'name' => 'layout1',
			'label' => __( 'Layout1', 'tcd-horizon' ),
			'default' => array(
				'image1' => false,
				'image2' => false,
				'image3' => false,
				'image4' => false,
				'image5' => false,
				'image6' => false,
			)
		),
    // レイアウト2
		'layout2' => array(
			'name' => 'layout2',
			'label' => __( 'Layout2', 'tcd-horizon' ),
			'default' => array(
				'image1' => false,
				'image2' => false,
				'image3' => false,
				'image4' => false,
			)
		),
    // レイアウト3
		'layout3' => array(
			'name' => 'layout3',
			'label' => __( 'Layout3', 'tcd-horizon' ),
			'default' => array(
				'image1' => false,
				'image2' => false,
				'image3' => false,
				'image4' => false,
				'image5' => false,
				'image6' => false,
				'image7' => false,
				'image8' => false,
			)
		),
	);
}

/**
 * コンテンツビルダー用 コンテンツ選択プルダウン
 */
function work_content_select( $cb_index = 'cb_cloneindex', $selected = null ) {
	$cb_contents = work_get_contents();

	if ( $selected && isset( $cb_contents[$selected] ) ) {
		$add_class = ' hidden';
	} else {
		$add_class = '';
	}

	$out = '<select name="work_content[' . esc_attr( $cb_index ) . '][cb_content_select]" class="cb_content_select' . $add_class . '">';
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
function work_content_setting( $cb_index = 'cb_cloneindex', $cb_content_select = null, $value = array() ) {

  global $post, $font_type_options, $content_width_options, $content_direction_options, $content_direction_options2, $text_align_options;

	$cb_contents = work_get_contents();

	// 不明なコンテンツの場合は終了
	if ( ! $cb_content_select || ! isset( $cb_contents[$cb_content_select] ) ) return false;

	// コンテンツデフォルト値に入力値をマージ
	if ( isset( $cb_contents[$cb_content_select]['default'] ) ) {
		$value = array_merge( (array) $cb_contents[$cb_content_select]['default'], $value );
	}
?>
  <div class="cb_content_wrap cf <?php echo esc_attr( $cb_content_select ); ?>">

  <?php
      // レイアウト1 -------------------------------------------------------------------------
      if ( 'layout1' === $cb_content_select ) :
  ?>
  <h3 class="cb_content_headline"><?php echo esc_html( $cb_contents[$cb_content_select]['label'] ); ?></h3>
  <div class="cb_content">

   <div class="gallery_item_list_container">

   <?php for($i = 1; $i <= 6; $i++) { ?>

   <div class="gallery_item gallery_modal_image<?php echo $i; ?>_<?php echo $cb_index; ?> <?php if($i == 1 || $i == 6){ echo 'size1'; } else { echo 'size2'; }; ?>">
    <div class="gallery_item_inner">

    <a class="open_gallery_modal" href="#gallery_modal_image<?php echo $i; ?>_<?php echo $cb_index; ?>">
     <div class="gallery_preview_field">
      <?php
           if (!empty($value['image'.$i])) {
             $gallery_preview_image = wp_get_attachment_image_src($value['image'.$i], 'full');
             echo '<div class="image" style="background:url(' . esc_attr($gallery_preview_image[0]) . ') no-repeat center center; background-size:cover;"></div>';
           };
      ?>
      <div class="empty" <?php if( !empty($value['image'.$i]) ) { ?>style="display:none;"<?php }; ?>>
       <p><?php echo __( 'Click to register image data', 'tcd-horizon' ); ?></p>
      </div>
     </div>
    </a>

    <div class="gallery_modal_container" id="gallery_modal_image<?php echo $i; ?>_<?php echo $cb_index; ?>" style="display:none;">
     <div class="gallery_modal_content">
      <div class="gallery_modal_header">
       <p><?php _e( 'Please select the image to display', 'tcd-horizon' );  ?></p>
       <a class="close_gallery_modal" href="#"></a>
      </div>
      <div class="gallery_modal_input_area">
       <?php // Image ---------------- ?>
       <div class="theme_option_message2" style="margin-top:20px;">
        <p><?php _e('If the caption is registered, it will be displayed on the front screen.', 'tcd-horizon'); ?><br>
        <?php if($i == 1 || $i == 6){ ?>
        <?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '725', '550'); ?></p>
        <?php } else { ?>
        <?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '240', '550'); ?></p>
        <?php }; ?>
       </div>
       <div class="cf cf_media_field hide-if-no-js gallery_list_image<?php echo $i; ?>_<?php echo $cb_index; ?>">
        <input type="hidden" class="cf_media_id" name="work_content[<?php echo $cb_index; ?>][image<?php echo $i; ?>]" id="gallery_list_image<?php echo $i; ?>_<?php echo $cb_index; ?>" value="<?php echo esc_attr( isset( $value['image'.$i] ) ? $value['image'.$i] : '' ); ?>" />
        <div class="preview_field gallery_image_preview_field"><?php if ( isset( $value['image'.$i] ) ) echo wp_get_attachment_image( $value['image'.$i], 'full' ); ?></div>
        <div class="buttton_area">
         <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-horizon' ); ?>" />
         <input type="button" class="cfmf-delete-img button<?php if ( empty( $value['image'.$i] ) ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-horizon' ); ?>" />
        </div>
       </div>
      </div><!-- END .gallery_modal_input_area -->
     </div><!-- END .gallery_modal_content -->
    </div><!-- END .gallery_modal_container -->

   </div><!-- END .gallery_item_inner -->
   </div><!-- END .gallery_item -->

   <?php }; ?>

   </div><!-- END .gallery_item_list_container -->

   <ul class="button_list cf">
    <li><a href="#" class="button-ml close-content"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
   </ul>
  </div><!-- END .cb_content -->

  <?php
      // レイアウト2 -------------------------------------------------------------------------
      elseif ( 'layout2' === $cb_content_select ) :
  ?>
  <h3 class="cb_content_headline"><?php echo esc_html( $cb_contents[$cb_content_select]['label'] ); ?></h3>
  <div class="cb_content">

   <div class="gallery_item_list_container">

   <?php for($i = 1; $i <= 4; $i++) { ?>

   <div class="gallery_item gallery_modal_image<?php echo $i; ?>_<?php echo $cb_index; ?> size1">
    <div class="gallery_item_inner">

    <a class="open_gallery_modal" href="#gallery_modal_image<?php echo $i; ?>_<?php echo $cb_index; ?>">
     <div class="gallery_preview_field">
      <?php
           if (!empty($value['image'.$i])) {
             $gallery_preview_image = wp_get_attachment_image_src($value['image'.$i], 'full');
             echo '<div class="image" style="background:url(' . esc_attr($gallery_preview_image[0]) . ') no-repeat center center; background-size:cover;"></div>';
           };
      ?>
      <div class="empty" <?php if( !empty($value['image'.$i]) ) { ?>style="display:none;"<?php }; ?>>
       <p><?php echo __( 'Click to register image data', 'tcd-horizon' ); ?></p>
      </div>
     </div>
    </a>

    <div class="gallery_modal_container" id="gallery_modal_image<?php echo $i; ?>_<?php echo $cb_index; ?>" style="display:none;">
     <div class="gallery_modal_content">
      <div class="gallery_modal_header">
       <p><?php _e( 'Please select the image to display', 'tcd-horizon' );  ?></p>
       <a class="close_gallery_modal" href="#"></a>
      </div>
      <div class="gallery_modal_input_area">
       <?php // Image ---------------- ?>
       <div class="theme_option_message2" style="margin-top:20px;">
        <p><?php _e('If the caption is registered, it will be displayed on the front screen.', 'tcd-horizon'); ?><br>
        <?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '725', '550'); ?></p>
       </div>
       <div class="cf cf_media_field hide-if-no-js gallery_list_image<?php echo $i; ?>_<?php echo $cb_index; ?>">
        <input type="hidden" class="cf_media_id" name="work_content[<?php echo $cb_index; ?>][image<?php echo $i; ?>]" id="gallery_list_image<?php echo $i; ?>_<?php echo $cb_index; ?>" value="<?php echo esc_attr( isset( $value['image'.$i] ) ? $value['image'.$i] : '' ); ?>" />
        <div class="preview_field gallery_image_preview_field"><?php if ( isset( $value['image'.$i] ) ) echo wp_get_attachment_image( $value['image'.$i], 'full' ); ?></div>
        <div class="buttton_area">
         <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-horizon' ); ?>" />
         <input type="button" class="cfmf-delete-img button<?php if ( empty( $value['image'.$i] ) ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-horizon' ); ?>" />
        </div>
       </div>
      </div><!-- END .gallery_modal_input_area -->
     </div><!-- END .gallery_modal_content -->
    </div><!-- END .gallery_modal_container -->

   </div><!-- END .gallery_item_inner -->
   </div><!-- END .gallery_item -->

   <?php }; ?>

   </div><!-- END .gallery_item_list_container -->

   <ul class="button_list cf">
    <li><a href="#" class="button-ml close-content"><?php echo __( 'Close', 'tcd-horizon' ); ?></a></li>
   </ul>
  </div><!-- END .cb_content -->

  <?php
      // レイアウト3 -------------------------------------------------------------------------
      elseif ( 'layout3' === $cb_content_select ) :
  ?>
  <h3 class="cb_content_headline"><?php echo esc_html( $cb_contents[$cb_content_select]['label'] ); ?></h3>
  <div class="cb_content">

   <div class="gallery_item_list_container">

   <?php for($i = 1; $i <= 8; $i++) { ?>

   <div class="gallery_item gallery_modal_image<?php echo $i; ?>_<?php echo $cb_index; ?> size2">
    <div class="gallery_item_inner">

    <a class="open_gallery_modal" href="#gallery_modal_image<?php echo $i; ?>_<?php echo $cb_index; ?>">
     <div class="gallery_preview_field">
      <?php
           if (!empty($value['image'.$i])) {
             $gallery_preview_image = wp_get_attachment_image_src($value['image'.$i], 'full');
             echo '<div class="image" style="background:url(' . esc_attr($gallery_preview_image[0]) . ') no-repeat center center; background-size:cover;"></div>';
           };
      ?>
      <div class="empty" <?php if( !empty($value['image'.$i]) ) { ?>style="display:none;"<?php }; ?>>
       <p><?php echo __( 'Click to register image data', 'tcd-horizon' ); ?></p>
      </div>
     </div>
    </a>

    <div class="gallery_modal_container" id="gallery_modal_image<?php echo $i; ?>_<?php echo $cb_index; ?>" style="display:none;">
     <div class="gallery_modal_content">
      <div class="gallery_modal_header">
       <p><?php _e( 'Please select the image to display', 'tcd-horizon' );  ?></p>
       <a class="close_gallery_modal" href="#"></a>
      </div>
      <div class="gallery_modal_input_area">
       <?php // Image ---------------- ?>
       <div class="theme_option_message2" style="margin-top:20px;">
        <p><?php _e('If the caption is registered, it will be displayed on the front screen.', 'tcd-horizon'); ?><br>
        <?php printf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '240', '550'); ?></p>
       </div>
       <div class="cf cf_media_field hide-if-no-js gallery_list_image<?php echo $i; ?>_<?php echo $cb_index; ?>">
        <input type="hidden" class="cf_media_id" name="work_content[<?php echo $cb_index; ?>][image<?php echo $i; ?>]" id="gallery_list_image<?php echo $i; ?>_<?php echo $cb_index; ?>" value="<?php echo esc_attr( isset( $value['image'.$i] ) ? $value['image'.$i] : '' ); ?>" />
        <div class="preview_field gallery_image_preview_field"><?php if ( isset( $value['image'.$i] ) ) echo wp_get_attachment_image( $value['image'.$i], 'full' ); ?></div>
        <div class="buttton_area">
         <input type="button" class="cfmf-select-img button" value="<?php _e( 'Select Image', 'tcd-horizon' ); ?>" />
         <input type="button" class="cfmf-delete-img button<?php if ( empty( $value['image'.$i] ) ) echo ' hidden'; ?>" value="<?php _e( 'Remove Image', 'tcd-horizon' ); ?>" />
        </div>
       </div>
      </div><!-- END .gallery_modal_input_area -->
     </div><!-- END .gallery_modal_content -->
    </div><!-- END .gallery_modal_container -->

   </div><!-- END .gallery_item_inner -->
   </div><!-- END .gallery_item -->

   <?php }; ?>

   </div><!-- END .gallery_item_list_container -->

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

?>