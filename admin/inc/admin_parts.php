<?php

// 管理画面のパーツ

// よく使う翻訳テキスト
function tcd_admin_label($key, $atts = array('','')) {

  $text_domain = 'tcd-horizon';

  $translates = array(

    // 保存ボタン
    'save' => __( 'Save Changes', 'tcd-horizon' ),
    'close' => __( 'Close', 'tcd-horizon' ),

    // 画像
    'select_image' => __( 'Select Image', 'tcd-horizon' ),
    'remove_image' => __( 'Remove Image', 'tcd-horizon' ),

    // ダミーテキスト
    'dummy_desc' => __( 'Description will be displayed here.<br>Description will be displayed here.', 'tcd-horizon' ),

    'basic' => __( 'Basic', 'tcd-horizon' ),

    // ブログ
    'blog' => __( 'Blog', 'tcd-horizon' ),
    'News' => __( 'News', 'tcd-horizon' ),
    'common' => __( 'Common setting', 'tcd-horizon' ),
    'content_name' => __( 'Name of content', 'tcd-horizon' ),
    'use_breadcrumb' => __( 'This name will also be used in breadcrumb link.', 'tcd-horizon' ),
    'archive_page' => __( 'Archive page', 'tcd-horizon' ),
    'header' => __( 'Header', 'tcd-horizon' ),
    'headline' => __( 'Headline', 'tcd-horizon' ),
    'sub_headline' => __( 'Sub headline', 'tcd-horizon' ),
    'desc' => __( 'Description', 'tcd-horizon' ),
    'desc_sp' => __( 'Description (mobile)', 'tcd-horizon' ),
    'article_list' => __( 'Article list', 'tcd-horizon' ),
    'article_list_num' => __( 'Number of article to display per page', 'tcd-horizon' ),
    'font_size_title' => __( 'Font size of title', 'tcd-horizon' ),
    'article_title_area' => __( 'Article title area', 'tcd-horizon' ),
    'display_setting' => __( 'Display setting', 'tcd-horizon' ),
    'related_post' => __( 'Related post', 'tcd-horizon' ),

    'no_image' => __( 'Alternate image to be displayed when featured image is not registered', 'tcd-horizon' ),
    'no_image_desc' => __( 'If you set image here, you can display alternative image for article which featured image is not set.', 'tcd-horizon' ),
    'no_image_desc2' => __( 'This image will be applied with priority over the "Alternate image to be displayed when featured image is not registered" option in the basic setting menu.', 'tcd-horizon' ),

    'recommend_image' => sprintf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), $atts[0], $atts[1]),

    'color' => __( 'Font color', 'tcd-horizon' ),
    'bg_color' => __( 'Background color', 'tcd-horizon' ),
    'bg_color_hover' => __( 'Background color on mouseover', 'tcd-horizon' ),
    'border_color' => __( 'Border color', 'tcd-horizon' ),
    'menu' => __( 'Menu', 'tcd-horizon' ),
    'catch' => __( 'Catchphrase', 'tcd-horizon' ),
    'catch_sp' => __( 'Catchphrase (mobile)', 'tcd-horizon' ),
    'font_size' => __( 'Font size', 'tcd-horizon' ),
    'font_type' => __( 'Font type', 'tcd-horizon' ),
    'text_align' => __( 'Text align', 'tcd-horizon' ),
    'font_weight' => __( 'Font weight', 'tcd-horizon' ),

    'content' => __( 'Content', 'tcd-horizon' ),
    'text' => __( 'Text', 'tcd-horizon' ),
    'button' => __( 'Button', 'tcd-horizon' ),
    'button_type' => __( 'Button type', 'tcd-horizon' ),
    'button_label' => __( 'Button label', 'tcd-horizon' ),
    'label' => __( 'Label', 'tcd-horizon' ),
    'display_button' => __( 'Display button', 'tcd-horizon' ),
    'new_open' => __( 'Open link in new window', 'tcd-horizon' ),

    'bg' => __( 'Background', 'tcd-horizon' ),
    'bg_image' => __( 'Background image', 'tcd-horizon' ),
    'bg_image_sp' => __( 'Background image (mobile)', 'tcd-horizon' ),

    'image' => __( 'Image', 'tcd-horizon' ),

    'overlay' => __( 'Overlay', 'tcd-horizon' ),
    'overlay_color' => __( 'Color of overlay', 'tcd-horizon' ),
    'overlay_opacity' => __( 'Transparency of overlay', 'tcd-horizon' ),

    'opacity_desc' => __( 'Please specify the number of 0 from 1.0. Overlay color will be more transparent as the number is small.', 'tcd-horizon' ),
    'device_diff_text' => __( 'If you want to display different text on mobile size, please fill in this field.', 'tcd-horizon' ),

    


    'delete' => __( 'Delete?', 'tcd-horizon' ),
    'delete_item' => __( 'Delete item', 'tcd-horizon' ),
    'new_item' => __( 'New item', 'tcd-horizon' ),
    'add_item' => __( 'Add item', 'tcd-horizon' ),
    'Item' => __( 'Item', 'tcd-horizon' ),




    

  );

  return $translates[$key];
  
}

function tcd_recommend_size($width, $height) {

  $translate = sprintf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), $width, $height);
  return $translate;
}

function tcd_get_post_labels($dp_options, $post_type) {
  if($post_type == 'blog'){
    $label = $dp_options['blog_label'] ? esc_html( $dp_options['blog_label'] ) : __( 'Blog', 'tcd-horizon' );
  }elseif($post_type == 'news'){
    $label = $dp_options['news_label'] ? esc_html( $dp_options['news_label'] ) : __( 'News', 'tcd-horizon' );
  }
  return $label;
}









// PCモバイルの文字サイズ専用オプション
function tcd_font_size_option($dp_options, $key, $repeater = false) {

	$html = '<div class="font_size_option">';

  if($repeater == false){
    $name = 'dp_options['.$key.']';
    $name_sp = 'dp_options['.$key.'_sp]';
    $value = esc_attr( $dp_options[$key] );
    $value_sp = esc_attr( $dp_options[$key.'_sp'] );
  }else{
    $name = 'dp_options['.$key[0].']['.$key[1].']['.$key[2].']';
    $name_sp = 'dp_options['.$key[0].']['.$key[1].']['.$key[2].'_sp]';
    $value = esc_attr( $dp_options[$key[2]] );
    $value_sp = esc_attr( $dp_options[$key[2].'_sp'] );
  }

  // PC
	$html .= '<label class="font_size_label number_option">';
	$html .= '<input class="hankaku input_font_size" type="number" name="'.$name.'" value="'.$value.'" min="9" max="100" />';
	$html .= '<span class="icon icon_pc"></span>';
	$html .= '</label>';

  // SP
  $html .= '<label class="font_size_label number_option">';
	$html .= '<input class="hankaku input_font_size_sp" type="number" name="'.$name_sp.'" value="'.$value_sp.'" min="9" max="100" />';
	$html .= '<span class="icon icon_sp"></span>';
	$html .= '</label>';


	$html .= '</div>';

	return $html;

}

// CF PCモバイルの文字サイズ専用オプション
function cf_tcd_font_size_option($key, $variable, $variable_sp) {

	$html = '<div class="font_size_option">';

  // PC
  $html .= '<label class="font_size_label number_option">';
	$html .= '<input class="hankaku input_font_size" type="number" name="'.$key.'" value="'.esc_attr( $variable ).'" min="9" max="100" />';
	$html .= '<span class="icon icon_pc"></span>';
	$html .= '</label>';

  // SP
  $html .= '<label class="font_size_label number_option">';
  $html .= '<input class="hankaku input_font_size_sp" type="number" name="'.$key.'_sp" value="'.esc_attr( $variable_sp ).'" min="9" max="100" />';
  $html .= '<span class="icon icon_sp"></span>';
  $html .= '</label>';

	$html .= '</div>';

	return $html;

}


// 表示する記事の数
function tcd_display_post_num_option($key, $pc_nums, $sp_nums) {

  $dp_options = get_design_plus_option();

  $html = '<div class="display_post_num_option">';

  // PC
  $min = $pc_nums[0];
  $max = $pc_nums[1];
  $divisible = $pc_nums[2];

  $html .= '<label for="'.$key.'">';
  $html .= '<select id="'.$key.'" name="dp_options['.$key.']">';

  for($i = $min; $i <= $max; $i++):
    if( ($i % $divisible) == 0 )
      $html .= '<option value="'.esc_attr($i).'" '.selected( $dp_options[$key], $i, false ).'>'.esc_html($i).'</option>';
  endfor;

  $html .= '</select>';
  $html .= '<span class="icon icon_pc"></span>';
  $html .= '</label>';

  // SP
  $key_sp = $key.'_sp';
  $min = $sp_nums[0];
  $max = $sp_nums[1];
  $divisible = $sp_nums[2];

  $html .= '<label for="'.$key_sp.'">';
  $html .= '<select id="'.$key_sp.'" name="dp_options['.$key_sp.']">';

  for($i = $min; $i <= $max; $i++):
    if( ($i % $divisible) == 0 )
      $html .= '<option value="'.esc_attr($i).'" '.selected( $dp_options[$key_sp], $i, false ).'>'.esc_html($i).'</option>';
  endfor;

  $html .= '</select>';
  $html .= '<span class="icon icon_sp"></span>';
  $html .= '</label>';

	$html .= '</div>';

	return $html;

}







// 横展開のラジオボタン
function tcd_basic_radio_button($dp_options, $key, $options, $repeater = false) {

  // dp
  if($repeater == false){
    $name = 'dp_options['.$key.']';
    $check = $dp_options[$key];
  }else{
    $name = 'dp_options['.$key[0].']['.esc_attr( $key[1] ).']['.$key[2].']';
    $check = $dp_options[$key[2]];
  }

	$html = '<div class="standard_radio_button">';

	foreach ( $options as $option ) {

    if($repeater == false){
      $connect = $key.'_'.esc_attr($option['value']);
    }else{
      $connect = $key[0].$key[1].'_'.$key[2].'_'.esc_attr($option['value']);
    }
		$html .= '<input id="'.$connect.'" type="radio" name="'.$name.'" value="'.esc_attr($option['value']).'"'.checked( $check, esc_attr($option['value']), false ).'>';
		$html .= '<label for="'.$connect.'">'.$option['label'].'</label>';
	}

	$html .= '</div>';

	return $html;

}

// 横展開のラジオボタン
function cf_tcd_basic_radio_button($key, $variable, $options) {

	$html = '<div class="standard_radio_button">';

	foreach ( $options as $option ) {
		$connect = $key.'_'.esc_attr($option['value']);
		$html .= '<input id="'.$connect.'" type="radio" name="'.$key.'" value="'.esc_attr($option['value']).'"'.checked( $variable, esc_attr($option['value']), false ).'>';
		$html .= '<label for="'.$connect.'">'.$option['label'].'</label>';
	}

	$html .= '</div>';

	return $html;

}



// カラーピッカー横のトグルボタン
function admin_cp_toggle_button($dp_options, $key ) {
	$html = '<input class="hide_cp_toggle_button" id="'.$key.'" name="dp_options['.$key.']" type="checkbox" value="1" '.checked( '1', $dp_options[$key], false ).' />';
	$html .= '<label for="'.$key.'"><span></span>'.__('No background color', 'tcd-horizon').'</label>';
	return $html;
}


// メディアアップローダー
function tcd_media_image_uploader($dp_options, $key, $size = 'full', $repeater = false) {

  if($repeater == false){
    $id = $key;
    $name = 'dp_options['.$key.']';
    $value = $dp_options[$key];
  }else{
    $id = $key[0].$key[1].'_'.$key[2];
    $name = 'dp_options['.$key[0].']['.esc_attr( $key[1] ).']['.$key[2].']';
    $value = $dp_options[$key[2]];
  }

  $html = '<div class="image_box cf">';
  $html .= '<div class="cf cf_media_field hide-if-no-js '.$id.'">';
  $html .= '<input type="hidden" value="'.esc_attr( $value ).'" id="'.$id.'" name="'.$name.'" class="cf_media_id">';
  $html .= '<div class="preview_field">';
  if ( $value ) $html .= wp_get_attachment_image( $value, $size );
  $html .= '</div>';
  $html .= '<div class="button_area">';
  $html .= '<input type="button" value="'.tcd_admin_label('select_image').'" class="cfmf-select-img button" style="margin-right:5px;">';
  $html .= '<input type="button" value="'.tcd_admin_label('remove_image').'" class="cfmf-delete-img button ';
  if ( !$value ) $html .= 'hidden';
  $html .= '">';
  $html .= '</div>';
  $html .= '</div>';
  $html .= '</div>';

  return $html;

}



// 画像付きラジオボタン
function tcd_admin_image_radio_button($dp_options, $key, $options) {

	$i = 0;
	$html = '';
	foreach( $options as $option){
							
		$i++;
		$id = $key.$i;

		$html .= '<input class="tcd_admin_image_radio_button" id="'.$id.'" type="radio" name="dp_options['.$key.']" value="'.esc_attr($option['value']).'" '.checked( $dp_options[$key], esc_attr($option['value']), false ).'>';
		$html .= '<label for="'.$id.'">';
		$html .= '<span class="image_wrap"><img src="'.$option['image'].'" alt=""></span>';
		$html .= '<span class="title_wrap"><span class="title">'.$option['label'].'</span></span>';
		$html .= '</label>';

	}

	return $html;

}


// CF 画像付きラジオボタン
function cf_tcd_admin_image_radio_button($key, $variable, $options) {

	$i = 0;
	$html = '';
	foreach( $options as $option){
							
		$i++;
		$id = $key.$i;

		$html .= '<input class="tcd_admin_image_radio_button" id="'.$id.'" type="radio" name="'.$key.'" value="'.esc_attr($option['value']).'" '.checked( $variable, esc_attr($option['value']), false ).'>';
		$html .= '<label for="'.$id.'">';
		$html .= '<span class="image_wrap"><img src="'.$option['image'].'" alt=""></span>';
		$html .= '<span class="title_wrap"><span class="title">'.$option['label'].'</span></span>';
		$html .= '</label>';

	}

	return $html;

}

?>