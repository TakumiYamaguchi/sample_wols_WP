<?php
/*
 * オプションの設定
 */


// hover effect
global $hover_type_options;
$hover_type_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Zoom in', 'tcd-horizon' )),
  'type2' => array('value' => 'type2','label' => __( 'Zoom out', 'tcd-horizon' )),
  'type3' => array('value' => 'type3','label' => __( 'Slide', 'tcd-horizon' )),
  'type4' => array('value' => 'type4','label' => __( 'Fade', 'tcd-horizon' )),
  'type5' => array('value' => 'type5','label' => __( 'No animation', 'tcd-horizon' ))
);
global $hover3_direct_options;
$hover3_direct_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Left to Right', 'tcd-horizon' )),
  'type2' => array('value' => 'type2','label' => __( 'Right to Left', 'tcd-horizon' ))
);


//フォントタイプ
global $font_type_options;
$font_type_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Meiryo', 'tcd-horizon' ),'label_en' => 'Arial'),
  'type2' => array('value' => 'type2','label' => __( 'YuGothic', 'tcd-horizon' ),'label_en' => 'San Serif'),
  'type3' => array('value' => 'type3','label' => __( 'YuMincho', 'tcd-horizon' ),'label_en' => 'Times New Roman')
);


// ヘッダーの固定設定
global $header_fix_options;
$header_fix_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Normal position', 'tcd-horizon' )),
  'type2' => array('value' => 'type2','label' => __( 'Fix at top after page scroll', 'tcd-horizon' )),
);
// ヘッダーの固定設定
global $header_fix_options2;
$header_fix_options2 = array(
  'type1' => array('value' => 'type1','label' => __( 'Normal header', 'tcd-horizon' )),
  'type2' => array('value' => 'type2','label' => __( 'Fix logo area at top after page scroll', 'tcd-horizon' )),
  'type3' => array('value' => 'type3','label' => __( 'Fix global menu at top after page scroll', 'tcd-horizon' )),
  'type4' => array('value' => 'type4','label' => __( 'Fix all header content at top after page scroll', 'tcd-horizon' ))
);


// レイアウトの設定
global $layout_options;
$layout_options = array(
 'type0' => array('value' => 'type0','label' => __( 'Use theme option setting', 'tcd-horizon' )),
 'type1' => array('value' => 'type1','label' => __( 'Don\'t display', 'tcd-horizon' )),
 'type2' => array('value' => 'type2','label' => __( 'Display on right side', 'tcd-horizon' )),
 'type3' => array('value' => 'type3','label' => __( 'Display on left side', 'tcd-horizon' )),
);


// ソーシャルボタンの設定
global $sns_type_options;
$sns_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Type1 (color)', 'tcd-horizon' ), 'img' => 'share_type1.jpg'),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Type2 (mono)', 'tcd-horizon' ), 'img' => 'share_type2.jpg'),
  'type3' => array( 'value' => 'type3', 'label' => __( 'Type3 (4 column - color)', 'tcd-horizon' ), 'img' => 'share_type3.jpg'),
  'type4' => array( 'value' => 'type4', 'label' => __( 'Type4 (4 column - mono)', 'tcd-horizon' ), 'img' => 'share_type4.jpg'),
  'type5' => array( 'value' => 'type5', 'label' => __( 'Type5 (official design)', 'tcd-horizon' ), 'img' => 'share_type5.jpg')
);


// フッターの固定メニュー 表示タイプ
global $footer_bar_display_options;
$footer_bar_display_options = array(
 'type1' => array('value' => 'type1', 'label' => __( 'Fade In', 'tcd-horizon' )),
 'type2' => array('value' => 'type2', 'label' => __( 'Slide In', 'tcd-horizon' )),
 'type3' => array('value' => 'type3', 'label' => __( 'Hide', 'tcd-horizon' ))
);


// フッターの固定メニュー ボタンのタイプ
global $footer_bar_button_options;
$footer_bar_button_options = array(
  'type1' => array('value' => 'type1', 'label' => __( 'Default', 'tcd-horizon' )),
  'type2' => array('value' => 'type2', 'label' => __( 'Share', 'tcd-horizon' )),
  'type3' => array('value' => 'type3', 'label' => __( 'Telephone', 'tcd-horizon' ))
);


// フッターの固定メニューのアイコン
global $footer_bar_icon_options;
$footer_bar_icon_options = array(
  'twitter' => array('value' => 'twitter'),
  'facebook' => array('value' => 'facebook'),
  'instagram' => array('value' => 'instagram'),
  'youtube' => array('value' => 'youtube'),
  'line' => array('value' => 'line'),
  'heart' => array('value' => 'heart'),
  'star1' => array('value' => 'star1'),
  'list2' => array('value' => 'list2'),
  'fire' => array('value' => 'fire'),
  'bubble' => array('value' => 'bubble'),
  'bell' => array('value' => 'bell'),
  'cart' => array('value' => 'cart'),
  'user' => array('value' => 'user'),
  'map' => array('value' => 'map'),
  'film' => array('value' => 'film'),
  'camera' => array('value' => 'camera'),
  'news' => array('value' => 'news'),
  'office' => array('value' => 'office'),
  'home' => array('value' => 'home'),
  'help' => array('value' => 'help'),
  'light' => array('value' => 'light'),
  'menu' => array('value' => 'menu'),
  'grid' => array('value' => 'grid'),
  'search' => array('value' => 'search'),
  'tel' => array('value' => 'tel'),
  'calendar' => array('value' => 'calendar'),
  'mail' => array('value' => 'mail'),
  'pdf' => array('value' => 'pdf'),
  'pencil' => array('value' => 'pencil'),
  'clock' => array('value' => 'clock'),
);


// 記事タイプ
global $post_type_options;
$post_type_options = array(
  'recent_post' => array('value' => 'recent_post','label' => __( 'All post', 'tcd-horizon' )),
  'recommend_post' => array('value' => 'recommend_post','label' => __( 'Recommend post1', 'tcd-horizon' )),
  'recommend_post2' => array('value' => 'recommend_post2','label' => __( 'Recommend post2', 'tcd-horizon' )),
  'pickup_post' => array('value' => 'pickup_post','label' => __( 'Pickup post', 'tcd-horizon' ))
);


// 記事の並び順
global $post_type_order_options;
$post_type_order_options = array(
  'date1' => array('value' => 'date1','label' => __( 'Date (DESC)', 'tcd-horizon' )),
  'date2' => array('value' => 'date2','label' => __( 'Date (ASC)', 'tcd-horizon' )),
  'rand' => array('value' => 'rand','label' => __( 'Random', 'tcd-horizon' ))
);


// スライダーやロードアイコンで使用
global $time_options;
$time_options = array(
  '1000' => array('value' => '1000','label' => sprintf(__('%s second', 'tcd-horizon'), 1)),
  '2000' => array('value' => '2000','label' => sprintf(__('%s second', 'tcd-horizon'), 2)),
  '3000' => array('value' => '3000','label' => sprintf(__('%s second', 'tcd-horizon'), 3)),
  '4000' => array('value' => '4000','label' => sprintf(__('%s second', 'tcd-horizon'), 4)),
  '5000' => array('value' => '5000','label' => sprintf(__('%s second', 'tcd-horizon'), 5)),
  '6000' => array('value' => '6000','label' => sprintf(__('%s second', 'tcd-horizon'), 6)),
  '7000' => array('value' => '7000','label' => sprintf(__('%s second', 'tcd-horizon'), 7)),
  '8000' => array('value' => '8000','label' => sprintf(__('%s second', 'tcd-horizon'), 8)),
  '9000' => array('value' => '9000','label' => sprintf(__('%s second', 'tcd-horizon'), 9)),
  '10000' => array('value' => '10000','label' => sprintf(__('%s second', 'tcd-horizon'), 10)),
  '11000' => array('value' => '11000','label' => sprintf(__('%s second', 'tcd-horizon'), 11)),
  '12000' => array('value' => '12000','label' => sprintf(__('%s second', 'tcd-horizon'), 12)),
  '13000' => array('value' => '13000','label' => sprintf(__('%s second', 'tcd-horizon'), 13)),
  '14000' => array('value' => '14000','label' => sprintf(__('%s second', 'tcd-horizon'), 14)),
  '15000' => array('value' => '15000','label' => sprintf(__('%s second', 'tcd-horizon'), 15))
);


// ロゴに画像を使うか否か
global $logo_type_options;
$logo_type_options = array(
  'type1' => array(
    'value' => 'type1',
    'label' => __( 'Use text for logo', 'tcd-horizon' ),
    'image' => get_template_directory_uri() . '/admin/img/header_logo_type1.gif'
  ),
  'type2' => array(
    'value' => 'type2',
    'label' => __( 'Use image for logo', 'tcd-horizon' ),
    'image' => get_template_directory_uri() . '/admin/img/header_logo_type2.gif'
  )
);


// フッターの固定コンテンツ
global $fixed_footer_content_type_options;
$fixed_footer_content_type_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Template', 'tcd-horizon' )),
  'type2' => array('value' => 'type2','label' => __( 'Free space', 'tcd-horizon' ))
);


// Google Maps
global $gmap_marker_type_options;
$gmap_marker_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Use default marker', 'tcd-horizon' ), 'img' => 'gmap_marker_type1.jpg'),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Use custom marker', 'tcd-horizon' ), 'img' => 'gmap_marker_type2.jpg' )
);
global $gmap_custom_marker_type_options;
$gmap_custom_marker_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Text', 'tcd-horizon' ) ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Image', 'tcd-horizon' ) )
);


// ページ分割ナビのタイプ
global $pagenation_type_options;
$pagenation_type_options = array(
  'type1' => array( 'value' => 'type1', 'label' => __( 'Page numbers', 'tcd-horizon' ), 'img' => 'page_link_type1.jpg' ),
  'type2' => array( 'value' => 'type2', 'label' => __( 'Read more button', 'tcd-horizon' ), 'img' => 'page_link_type2.jpg' )
);


// スライダーのアニメーション
global $slider_animation_options;
$slider_animation_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Zoom out', 'tcd-horizon' )),
  'type2' => array('value' => 'type2','label' => __( 'Zoom in', 'tcd-horizon' )),
  'type3' => array('value' => 'type3','label' => __( 'Move right', 'tcd-horizon' )),
  'type4' => array('value' => 'type4','label' => __( 'Move left', 'tcd-horizon' )),
  'type5' => array('value' => 'type5','label' => __( 'Move top', 'tcd-horizon' )),
  'type6' => array('value' => 'type6','label' => __( 'Move bottom', 'tcd-horizon' )),
  'type7' => array('value' => 'type7','label' => __( 'No animation', 'tcd-horizon' ))
);


// レイヤー画像のアニメーション
global $layer_image_animation_options;
$layer_image_animation_options = array(
  'type1' => array('value' => 'type1','label' => __( 'No animation', 'tcd-horizon' )),
  'type2' => array('value' => 'type2','label' => __( 'Fade in', 'tcd-horizon' )),
  'type3' => array('value' => 'type3','label' => __( 'Slide in', 'tcd-horizon' )),
);


// コンテンツの方向
global $content_direction_options;
$content_direction_options = array(
 'type1' => array('value' => 'type1', 'label' => __( 'Align left', 'tcd-horizon' )),
 'type2' => array('value' => 'type2', 'label' => __( 'Align center', 'tcd-horizon' )),
 'type3' => array('value' => 'type3', 'label' => __( 'Align right', 'tcd-horizon' ))
);
// コンテンツの方向（縦方向）
global $content_direction_options2;
$content_direction_options2 = array(
 'type1' => array('value' => 'type1', 'label' => __( 'Align top', 'tcd-horizon' )),
 'type2' => array('value' => 'type2', 'label' => __( 'Align middle', 'tcd-horizon' )),
 'type3' => array('value' => 'type3', 'label' => __( 'Align bottom', 'tcd-horizon' ))
);


// アイテムのタイプ
global $item_type_options;
$item_type_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Image', 'tcd-horizon' )),
  'type2' => array('value' => 'type2','label' => __( 'Video', 'tcd-horizon' )),
  'type3' => array('value' => 'type3','label' => __( 'Youtube', 'tcd-horizon' )),
);


// フッターコンテンツのタイプ
global $footer_content_type_options;
$footer_content_type_options = array(
  'type1' => array('value' => 'type1', 'label' => __( 'Display footer button', 'tcd-horizon' )),
  'type2' => array('value' => 'type2', 'label' => __( 'Display footer bar', 'tcd-horizon' ))
);


// スライダーのコンテンツタイプ
global $index_slider_content_type_options;
$index_slider_content_type_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Same as PC setting', 'tcd-horizon' )),
  'type2' => array('value' => 'type2','label' => __( 'Display diffrent content in mobile size', 'tcd-horizon' )),
);


// スライダーのアイテムタイプ
global $slider_type_options;
$slider_type_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Image', 'tcd-horizon' )),
  'type2' => array('value' => 'type2','label' => __( 'Video', 'tcd-horizon' )),
  'type3' => array('value' => 'type3','label' => __( 'Youtube', 'tcd-horizon' )),
  'type4' => array('value' => 'type4','label' => __( 'Logo content', 'tcd-horizon' ))
);


// メガメニュー
global $megamenu_options;
$megamenu_options = array(
  'type1' => array('value' => 'type1', 'title' => __( 'Dropdown menu (type1)', 'tcd-horizon' ), 'label' => __( 'Dropdown menu (type1)', 'tcd-horizon' ), 'img' => 'megamenu1.jpg'),
  'type2' => array('value' => 'type2', 'title' => __( 'Dropdown menu (type2)', 'tcd-horizon' ), 'label' => __( 'Dropdown menu (type2)', 'tcd-horizon' ), 'img' => 'megamenu2.jpg'),
  'type3' => array('value' => 'type3', 'title' => __( 'Mega menu A', 'tcd-horizon' ), 'label' => __( 'Mega menu A', 'tcd-horizon' ), 'img' => 'megamenu3.jpg'),
  'type4' => array('value' => 'type4', 'title' => __( 'Mega menu B', 'tcd-horizon' ), 'label' => __( 'Mega menu B', 'tcd-horizon' ), 'img' => 'megamenu4.jpg'),
);


// パララックスの設定
global $para_options;
$para_options = array(
  'type1' => array('value' => 'type1', 'label' => __( 'Use parallax effect', 'tcd-horizon' )),
  'type2' => array('value' => 'type2', 'label' => __( 'Don\'t use parallax effect', 'tcd-horizon' ))
);


// クイックタグ カスタムボタンタイプ
global $qt_custom_button_type_options;
$qt_custom_button_type_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Flat button', 'tcd-horizon' )
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Rounded button', 'tcd-horizon' )
	),
	'type3' => array(
		'value' => 'type3',
		'label' => __( 'Oval button', 'tcd-horizon' )
	)
);


// クイックタグ カスタムボタンサイズ
global $qt_custom_button_size_options;
$qt_custom_button_size_options = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Small size button - Width:130px Height:40px', 'tcd-horizon' )
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Medium size button - Width:270px Height:60px', 'tcd-horizon' )
	),
	'type3' => array(
		'value' => 'type3',
		'label' => __( 'Large size button - Width:400px Height:70px', 'tcd-horizon' )
	)
);


// テキストの方向
global $text_align_options;
$text_align_options = array(
 'left' => array('value' => 'left', 'label' => __( 'Align left', 'tcd-horizon' )),
 'center' => array('value' => 'center', 'label' => __( 'Align center', 'tcd-horizon' )),
);


// テキストの方向2
global $text_direction_options;
$text_direction_options = array(
 'type1' => array('value' => 'type1', 'label' => __( 'Display horizontally', 'tcd-horizon' )),
 'type2' => array('value' => 'type2', 'label' => __( 'Display vertically', 'tcd-horizon' )),
);


// コンテンツの横幅
global $content_width_options;
$content_width_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Normal content width', 'tcd-horizon' )),
  'type2' => array('value' => 'type2','label' => __( 'Full screen width', 'tcd-horizon' ))
);


// キャッチコピーのアニメーションのタイプ
global $catch_animation_type_options;
$catch_animation_type_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Animate all words from bottom to upward', 'tcd-horizon' )),
  'type2' => array('value' => 'type2','label' => __( 'Animate letter one by one', 'tcd-horizon' )),
);


//記事一覧のアニメーションタイプ
global $post_list_animation_type_options;
$post_list_animation_type_options = array(
  'type1' => array('value' => 'type1','label' => __( 'Fade in', 'tcd-horizon' )),
  'type2' => array('value' => 'type2','label' => __( 'Popup', 'tcd-horizon' )),
  'type3' => array('value' => 'type3','label' => __( 'Slide up', 'tcd-horizon' ))
);


// 表示設定
global $basic_display_options;
$basic_display_options = array(
	'display' => array(
		'value' => 'display',
		'label' => __( 'Display', 'tcd-horizon' ),
	),
	'hide' => array(
		'value' => 'hide',
		'label' => __( 'Hide', 'tcd-horizon' ),
	)
);




// クイックタグ関連 -------------------------------------------------------------------------------------------


// 見出し
global $font_weight_options;
$font_weight_options = array(
	'400' => array('value' => '400','label' => __( 'Normal', 'tcd-horizon' )),
	'600' => array('value' => '600','label' => __( 'Bold', 'tcd-horizon' ))
);
global $border_potition_options;
$border_potition_options = array(
	'left' => array('value' => 'left','label' => __( 'Left', 'tcd-horizon' )),
	'top' => array('value' => 'top','label' => __( 'Top', 'tcd-horizon' )),
	'bottom' => array('value' => 'bottom','label' => __( 'Bottom', 'tcd-horizon' )),
	'right' => array('value' => 'right','label' => __( 'Right', 'tcd-horizon' ))
);
global $border_style_options;
$border_style_options = array(
	'solid' => array('value' => 'solid','label' => __( 'Solid line', 'tcd-horizon' )),
	'dotted' => array('value' => 'dotted','label' => __( 'Dot line', 'tcd-horizon' )),
	'double' => array('value' => 'double','label' => __( 'Double line', 'tcd-horizon' ))
);


// ボタン
global $button_type_options;
$button_type_options = array(
	'type1' => array('value' => 'type1','label' => __( 'Normal', 'tcd-horizon' )),
	'type2' => array('value' => 'type2','label' => __( 'Ghost', 'tcd-horizon' )),
	'type3' => array('value' => 'type3','label' => __( 'Reverse', 'tcd-horizon' ))
);
global $button_border_radius_options;
$button_border_radius_options = array(
	'flat' => array('value' => 'flat','label' => __( 'Square', 'tcd-horizon' )),
	'rounded' => array('value' => 'rounded','label' => __( 'Rounded', 'tcd-horizon' )),
	'oval' => array('value' => 'oval','label' => __( 'Pill', 'tcd-horizon' ))
);
global $button_size_options;
$button_size_options = array(
	'small' => array('value' => 'small','label' => __( 'Small', 'tcd-horizon' )),
	'medium' => array('value' => 'medium','label' => __( 'Medium', 'tcd-horizon' )),
	'large' => array('value' => 'large','label' => __( 'Large', 'tcd-horizon' ))
);
global $button_animation_options;
$button_animation_options = array(
	'animation_type1' => array('value' => 'animation_type1','label' => __( 'Fade', 'tcd-horizon' )),
	'animation_type2' => array('value' => 'animation_type2','label' => __( 'Swipe', 'tcd-horizon' )),
	'animation_type3' => array('value' => 'animation_type3','label' => __( 'Diagonal swipe', 'tcd-horizon' ))
);


// アンダーライン
global $bool_options;
$bool_options = array(
	'yes' => array('value' => 'yes','label' => __( 'Yes', 'tcd-horizon' )),
	'no' => array('value' => 'no','label' => __( 'No', 'tcd-horizon' ))
);


// Google Map
global $google_map_design_options;
$google_map_design_options = array(
	'default' => array('value' => 'default','label' => __( 'Default', 'tcd-horizon' )),
	'monochrome' => array('value' => 'monochrome','label' => __( 'Monochrome', 'tcd-horizon' ))
);
global $google_map_marker_options;
$google_map_marker_options = array(
	'type1' => array('value' => 'type1','label' => __( 'Default', 'tcd-horizon' )),
	'type2' => array('value' => 'type2','label' => __( 'Text', 'tcd-horizon' )),
	'type3' => array('value' => 'type3','label' => __( 'Image', 'tcd-horizon' ))
);


// ローディングアイコンの種類の設定
global $loading_icon_type;
$loading_icon_type = array(
 'type1' => array('value' => 'type1','label' => __( 'Circle', 'tcd-tenjiku' )),
 'type2' => array('value' => 'type2','label' => __( 'Square', 'tcd-tenjiku' )),
 'type3' => array('value' => 'type3','label' => __( 'Dot circle', 'tcd-tenjiku' ))
);

global $loading_splash_type;
$loading_splash_type = array(
 'type1' => array('value' => 'type1','label' => __( 'Logo', 'tcd-tenjiku' )),
 'type2' => array('value' => 'type2','label' => __( 'Catchphrase', 'tcd-tenjiku' ))
);


// ロード画面関連 -------------------------------------------------------------------------------------------


// ローディングアイコンの種類の設定
global $loading_type;
$loading_type = array(
	'type1' => array(
		'value' => 'type1',
		'label' => __( 'Circle icon', 'tcd-horizon' ),
		'image' => get_template_directory_uri() . '/admin/img/load_smaple.jpg'
	),
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Square icon', 'tcd-horizon' ),
		'image' => get_template_directory_uri() . '/admin/img/load_smaple.jpg'
	),
	'type3' => array(
		'value' => 'type3',
		'label' => __( 'Dot circle icon', 'tcd-horizon' ),
		'image' => get_template_directory_uri() . '/admin/img/load_smaple.jpg'
	),
	'type4' => array(
		'value' => 'type4',
		'label' => __( 'Logo', 'tcd-horizon' ),
		'image' => get_template_directory_uri() . '/admin/img/load_smaple.jpg'
	),
	'type5' => array(
		'value' => 'type5',
		'label' => __( 'Catchphrase', 'tcd-horizon' ),
		'image' => get_template_directory_uri() . '/admin/img/load_smaple.jpg'
	)
);


global $loading_display_page_options;
$loading_display_page_options = array(
 'type1' => array('value' => 'type1','label' => __( 'Front page', 'tcd-horizon' )),
 'type2' => array('value' => 'type2','label' => __( 'All pages', 'tcd-horizon' ))
);


global $loading_display_time_options;
$loading_display_time_options = array(
 'type1' => array('value' => 'type1','label' => __( 'Only once', 'tcd-horizon' )),
 'type2' => array('value' => 'type2','label' => __( 'Every time', 'tcd-horizon' ))
);



// 固定ページのヘッダータイプ
global $page_header_type_options;
$page_header_type_options = array(
	'type2' => array(
		'value' => 'type2',
		'label' => __( 'Display at normal height', 'tcd-horizon' ),
		'image' => get_template_directory_uri() . '/admin/img/page_header_type2.jpg'
	),
	'type3' => array(
		'value' => 'type3',
		'label' => __( 'Full screen display', 'tcd-horizon' ),
		'image' => get_template_directory_uri() . '/admin/img/page_header_type3.jpg'
	)
);

?>