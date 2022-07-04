<?php


// 言語ファイル --------------------------------------------------------------------------------
load_textdomain('tcd-horizon', dirname(__FILE__).'/languages/' . get_locale() . '.mo');


// テーマの説明文
__('WordPress theme "HORIZON" is a template for a side-scrolling gallery site. Use it for your portfolio or product showcase. You can show off your beautiful photos smoothly by scrolling horizontally.', 'tcd-horizon');


// hook wp_head --------------------------------------------------------------------------------
require get_template_directory() . '/functions/head.php';


// テーマオプション --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/admin/theme-options.php' );
$options = get_design_plus_option();


// 更新通知 --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/update_notifier.php' );


// Javascriptの読み込み -----------------------------------------------------------------------
function my_admin_scripts() {
  $options = get_design_plus_option();
  wp_enqueue_script( 'wp-color-picker');
  wp_enqueue_script('thickbox');
  wp_enqueue_script('media-upload');
  wp_enqueue_script('jquery-ui-resizable');//トップページヘッダーコンテンツのロゴリサイズ機能で使用
  wp_enqueue_script('ml-widget-js', get_template_directory_uri().'/widget/js/script.js', '', '1.0.2', true);
  wp_enqueue_script('jquery.cookieTab', get_template_directory_uri().'/admin/js/jquery.cookieTab.js', '', '1.0.0', true);
  wp_enqueue_script('jquery.cookie', get_template_directory_uri().'/js/jquery.cookie.min.js', '', '1.0.0', true);
  wp_enqueue_script('my_script', get_template_directory_uri().'/admin/js/my_script.js', '', '1.2.0', true);
  wp_enqueue_script('admin_ankle', get_template_directory_uri().'/admin/js/admin_ankle.js', '', '1.0.0', true);
  wp_enqueue_script('lightcase_script', get_template_directory_uri().'/admin/js/lightcase/lightcase.js', '', '1.0.0', true);
  wp_localize_script( 'my_script', 'TCD_MESSAGES', array(
    'cookieResetSuccess' => __( 'Cookie has been deleted', 'tcd-horizon' ),
    'ajaxSubmitSuccess' => __( 'Settings Saved Successfully', 'tcd-horizon' ),
    'ajaxSubmitError' => __( 'Can not save data. Please try again', 'tcd-horizon' ),
    'tabChangeWithoutSave' => __( "Your changes on the current tab have not been saved.\nTo stay on the current tab so that you can save your changes, click Cancel.", 'tcd-horizon' ),
    'contentBuilderDelete' => __( 'Are you sure you want to delete this content?', 'tcd-horizon' ),
    'imageContentWidthMessage' => __( '<span>You can display image by content width when you displaying border around the content on LP page.</span>', 'tcd-horizon' ),
    'mainColor' => $options['main_color'],
  ) );
  wp_enqueue_media();//画像アップロード用
  wp_enqueue_script('cf-media-field', get_template_directory_uri().'/admin/js/cf-media-field.js', '', '1.0.2', true); //画像アップロード用
  wp_localize_script( 'cf-media-field', 'cfmf_text', array(
    'image_title' => __( 'Please select image', 'tcd-horizon' ),
    'image_button' => __( 'Use this image', 'tcd-horizon' ),
    'video_title' => __( 'Please select MP4 file', 'tcd-horizon' ),
    'video_button' => __( 'Use this MP4 file', 'tcd-horizon' ),
    'image_save' => __( 'Save', 'tcd-horizon' ),
  ) );
}
add_action('admin_print_scripts', 'my_admin_scripts');


// スタイルシートの読み込み -----------------------------------------------------------------------
function my_admin_styles() {
  wp_enqueue_style('imgareaselect');
  wp_enqueue_style('jquery-ui-draggable');
  wp_enqueue_style('wp-color-picker');
  wp_enqueue_style('thickbox');
  wp_enqueue_style('my_widget_css', get_template_directory_uri() . '/widget/css/menu.css','','1.0.2');

  wp_enqueue_style('my_widget_css', get_template_directory_uri() . '/widget/css/style.css','','1.0.2');
  wp_enqueue_style('my_widget_css', get_template_directory_uri() . '/widget/css/style.css','','1.0.2');
  wp_enqueue_style('my_admin_css', get_template_directory_uri() .'/admin/css/my_admin.css','','1.1.2');
  wp_enqueue_style('ankle_admin_css', get_template_directory_uri() .'/admin/css/ankle_admin.css','','1.0.0');
  wp_enqueue_style('lightcase_style', get_template_directory_uri() . '/admin/js/lightcase/lightcase.css','','1.0.2');
}
add_action('admin_print_styles', 'my_admin_styles');


// ビジュアルエディタ用スタイルシートの読み込み
function wpdocs_theme_add_editor_styles() {
  add_theme_support('editor-styles');
  add_editor_style('admin/css/editor-style-03.css');//管理画面用のスタイルシートを変更した場合は、ファイルの名前と番号を変える （キャッシュ対策）
}
add_action( 'admin_init', 'wpdocs_theme_add_editor_styles' );


// ウィジェット ------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/widget/tag_list.php' );
require_once ( dirname(__FILE__) . '/widget/tab_post_list.php' );
require_once ( dirname(__FILE__) . '/widget/search_box.php' );

$options = get_design_plus_option();
$news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-horizon' );

register_sidebar(array(
  'before_widget' => '<div class="widget_content clearfix %2$s" id="%1$s">'."\n",
  'after_widget' => "</div>\n",
  'before_title' => '<h3 class="widget_headline"><span>',
  'after_title' => "</span></h3>",
  'name' => __('Common widget', 'tcd-horizon'),
  'description' => __('Widgets set in this area are displayed as basic widget in the sidebar of all pages. If there are individual settings, the widget will be displayed.', 'tcd-horizon'),
  'id' => 'common_widget'
));
register_sidebar(array(
  'before_widget' => '<div class="widget_content clearfix %2$s" id="%1$s">'."\n",
  'after_widget' => "</div>\n",
  'before_title' => '<h3 class="widget_headline"><span>',
  'after_title' => "</span></h3>",
  'name' => __('Common widget (smarphone)', 'tcd-horizon'),
  'description' => __('Widgets set in this area are displayed as basic widget in the sidebar of all pages. If there are individual settings, the widget will be displayed.', 'tcd-horizon'),
  'id' => 'common_widget_mobile'
));
register_sidebar(array(
  'before_widget' => '<div class="widget_content clearfix %2$s" id="%1$s">'."\n",
  'after_widget' => "</div>\n",
  'before_title' => '<h3 class="widget_headline"><span>',
  'after_title' => "</span></h3>",
  'name' => __('Blog page', 'tcd-horizon'),
  'id' => 'single_widget'
));
register_sidebar(array(
  'before_widget' => '<div class="widget_content clearfix %2$s" id="%1$s">'."\n",
  'after_widget' => "</div>\n",
  'before_title' => '<h3 class="widget_headline"><span>',
  'after_title' => "</span></h3>",
  'name' => __('Blog page (smartphone)', 'tcd-horizon'),
  'description' => __('This widget will be replaced with normal widget when a user accesses the site by smartphone.', 'tcd-horizon'),
  'id' => 'single_widget_mobile'
));
register_sidebar(array(
  'before_widget' => '<div class="widget_content clearfix %2$s" id="%1$s">'."\n",
  'after_widget' => "</div>\n",
  'before_title' => '<h3 class="widget_headline"><span>',
  'after_title' => "</span></h3>",
  'name' => sprintf(__('%s page', 'tcd-horizon'), $news_label),
  'id' => 'news_single_widget'
));
register_sidebar(array(
  'before_widget' => '<div class="widget_content clearfix %2$s" id="%1$s">'."\n",
  'after_widget' => "</div>\n",
  'before_title' => '<h3 class="widget_headline"><span>',
  'after_title' => "</span></h3>",
  'name' => sprintf(__('%s page (smartphone)', 'tcd-horizon'), $news_label),
  'description' => __('This widget will be replaced with normal widget when a user accesses the site by smartphone.', 'tcd-horizon'),
  'id' => 'news_single_widget_mobile'
));


// ウィジェットのブロックエディタ無効化
function example_theme_support() {
  remove_theme_support( 'widgets-block-editor' );
}
add_action( 'after_setup_theme', 'example_theme_support' );


// アーカイブウィジェットのタイトルが空の場合見出しを表示しない
function filter_wp_widget_archives_widget_title ( $title, $instance = array(), $id_base = null ) {
	if ( 'archives' === $id_base && empty( $instance['title'] ) || 'categories' === $id_base && empty( $instance['title'] )) {
		$title = '';
	}
	return $title;
}
add_filter( 'widget_title', 'filter_wp_widget_archives_widget_title', 10, 3 );


// カードリンクパーツ --------------------------------------------------------------------------------
require get_template_directory() . '/functions/clink.php';


// おすすめ記事 --------------------------------------------------------------------------------
require get_template_directory() . '/functions/recommend.php';


// meta title meta description  --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/seo.php' );


// 管理画面の記事一覧、クイック編集 --------------------------------------------------------------------------------
require get_template_directory() . '/functions/admin_column.php';
require get_template_directory() . '/functions/quick_edit.php';


// カスタムフィールド --------------------------------------------------------------------------------
require get_template_directory() . '/functions/page_cf.php';
require get_template_directory() . '/functions/page_about.php';
require get_template_directory() . '/functions/work_cf.php';


// 並び替え --------------------------------------------------------------------------------
require get_template_directory() . '/functions/post_order.php';


// カスタムスクリプト --------------------------------------------------------------------------------
require get_template_directory() . '/functions/custom_script.php';


// カスタムCSS --------------------------------------------------------------------------------
require get_template_directory() . '/functions/custom_css.php';


// ビジュアルエディタにクイックタグを追加 --------------------------------------------------------------------------------
require get_template_directory() . '/functions/custom_editor.php';


// ショートコード --------------------------------------------------------------------------------
require get_template_directory() . '/functions/short_code.php';


// カスタムページリンク  --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/custom_page_link.php' );


// OGP tag  -------------------------------------------------------------------------------------------
require get_template_directory() . '/functions/ogp.php';


// 次のページリンク  --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/next_prev.php' );


//ロゴ用関数 --------------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/logo.php' );


// プロフィール追加情報 --------------------------------------------------------------------------------
require get_template_directory() . '/functions/user-profile.php';


// ロードアイコン -----------------------------------------------------------------------------
require get_template_directory() . '/functions/load_icon.php';
require get_template_directory() . '/functions/footer_script.php';


// パスワード保護 -----------------------------------------------------------------------------
require_once ( dirname(__FILE__) . '/functions/password_form.php' );


// 高速化 --------------------------------------------------------------------------------
require ( dirname(__FILE__) . '/functions/acceleration.php' );


// ビジュアルエディタに表(テーブル)の機能を追加 -----------------------------------------------
function mce_external_plugins_table($plugins) {
    $plugins['table'] = 'https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.7.4/plugins/table/plugin.min.js';
    return $plugins;
}
add_filter( 'mce_external_plugins', 'mce_external_plugins_table' );

// tinymceのtableボタンにclass属性プルダウンメニューを追加
function mce_buttons_table($buttons) {
    $buttons[] = 'table';
    return $buttons;
}
add_filter( 'mce_buttons', 'mce_buttons_table' );

function bootstrap_classes_tinymce($settings) {
  $styles = array(
    array('title' => __('Default style', 'tcd-horizon'), 'value' => ''),
    array('title' => __('No border', 'tcd-horizon'), 'value' => 'table_no_border'),
    array('title' => __('Display only horizontal border', 'tcd-horizon'), 'value' => 'table_border_horizontal')
  );
  $settings['table_class_list'] = json_encode($styles);
  return $settings;
}
add_filter('tiny_mce_before_init', 'bootstrap_classes_tinymce');


// ビジュアルエディタに書体を追加 ---------------------------------------------------------------------
add_filter('mce_buttons', function($buttons){
  array_unshift($buttons, 'fontselect');
  return $buttons;
});
add_filter('tiny_mce_before_init', function($settings){
  $settings['font_formats'] =
    "メイリオ=Arial, 'ヒラギノ角ゴ ProN W3', 'Hiragino Kaku Gothic ProN', 'メイリオ', Meiryo, sans-serif;" .
    "游ゴシック='Hiragino Sans', 'ヒラギノ角ゴ ProN', 'Hiragino Kaku Gothic ProN', '游ゴシック', YuGothic, 'メイリオ', Meiryo, sans-serif;" .
    "游明朝='Times New Roman' , '游明朝' , 'Yu Mincho' , '游明朝体' , 'YuMincho' , 'ヒラギノ明朝 Pro W3' , 'Hiragino Mincho Pro' , 'HiraMinProN-W3' , 'HGS明朝E' , 'ＭＳ Ｐ明朝' , 'MS PMincho' , serif;" .
    "Andale Mono=andale mono,times;" .
    "Arial=arial,helvetica,sans-serif;" .
    "Arial Black=arial black,avant garde;" .
    "Book Antiqua=book antiqua,palatino;" .
    "Comic Sans MS=comic sans ms,sans-serif;" .
    "Courier New=courier new,courier;" .
    "Georgia=georgia,palatino;" .
    "Helvetica=helvetica;" .
    "Impact=impact,chicago;" .
    "Symbol=symbol;" .
    "Tahoma=tahoma,arial,helvetica,sans-serif;" .
    "Terminal=terminal,monaco;" .
    "Times New Roman=times new roman,times;" .
    "Trebuchet MS=trebuchet ms,geneva;" .
    "Verdana=verdana,geneva;" .
    "Webdings=webdings;" .
    "Wingdings=wingdings,zapf dingbats";
  ;
  return $settings;
});


// ビジュアルエディタに文字サイズを追加 ---------------------------------------------------------------------
function add_font_size_to_tinymce( $buttons ) {
  array_unshift( $buttons, 'fontsizeselect' ); 
  return $buttons;
}
add_filter( 'mce_buttons_2', 'add_font_size_to_tinymce' );

function change_font_size_of_tinymce( $initArray ){
  $initArray['fontsize_formats'] = "10px 11px 12px 14px 16px 18px 20px 24px 28px 32px 38px";
  return $initArray;
}
add_filter( 'tiny_mce_before_init', 'change_font_size_of_tinymce' );


// ユーザーエージェントを判定するための関数---------------------------------------------------------------------
function is_mobile() {

  //タブレットも含める場合はwp_is_mobile()

  $match = 0;

  $ua = array(
   'iPhone', // iPhone
   'iPod', // iPod touch
   'Android.*Mobile', // 1.5+ Android *** Only mobile
   'Windows.*Phone', // *** Windows Phone
   'dream', // Pre 1.5 Android
   'CUPCAKE', // 1.5+ Android
   'BlackBerry', // BlackBerry
   'BB10', // BlackBerry10
   'webOS', // Palm Pre Experimental
   'incognito', // Other iPhone browser
   'webmate' // Other iPhone browser
  );

  $pattern = '/' . implode( '|', $ua ) . '/i';
  $match   = preg_match( $pattern, $_SERVER['HTTP_USER_AGENT'] );

  if ( $match === 1 ) {
    return TRUE;
  } else {
    return FALSE;
  }

}


// videoタグやyoutubeの自動再生に対応しているか判定 ----------------------------------------------
// Android 標準ブラウザは不可、Android版 Chrome ver53以下は不可、iOS ver10以下は不可、それ以外は再生を許可
function auto_play_movie() {
  $ua = mb_strtolower($_SERVER['HTTP_USER_AGENT']);
  // Android -----------------------------------
  if( preg_match('/android/ui', $ua) ) {
    //echo 'Android<br />';
    // 標準ブラウザ
    if (strpos($ua, 'android') !== false && strpos($ua, 'linux; u;') !== false && strpos($ua, 'chrome') === false) {
      return FALSE;
    // Chrome
    } elseif ( preg_match('/(chrome)\/([0-9\.]+)/', $ua , $matches) ){
      $match = (float) $matches[2];
      $version = floor($match);
      if($version < 53){
        return FALSE;
      } else {
        return TRUE;
      }
    } else {
      return TRUE;
    }
  // iOS ---------------------------------------
  } elseif(preg_match('/iphone|ipod|ipad/ui', $ua)) {
    //echo 'iOS<br />';
    if ( preg_match('/(iphone|ipod|ipad) os ([0-9_]+)/', $ua, $matches) ) {
      $matches[2] = (float) str_replace('_', '.', $matches[2]);
      $version = floor($matches[2]);
      if($version < 10){
        return FALSE;
      } else {
        return TRUE;
      }
    } else {
      return TRUE;
    }
  // PC等、その他のOS ---------------------------------------
  } else {
    //echo 'OTHER OS<br />';
    return TRUE;
  }
}


// スクリプトのバージョン管理 ----------------------------------------------------------------------------------------------
function version_num() {

 if (function_exists('wp_get_theme')) {
   $theme_data = wp_get_theme();
 } else {
   $theme_data = get_theme_data(TEMPLATEPATH . '/style.css');
 };

 $current_version = $theme_data['Version'];

 return $current_version;

};


// オリジナルの抜粋記事 --------------------------------------------------------------------------------
function trim_excerpt($a) {

 if(has_excerpt()) { 

   $base_content = get_the_excerpt();
   $base_content = str_replace(array("\r\n", "\r", "\n"), "", $base_content);
   $trim_content = mb_substr($base_content, 0, $a ,"utf-8");

 } else {

   $base_content = get_the_content();
   $base_content = preg_replace('!<style.*?>.*?</style.*?>!is', '', $base_content);
$base_content = preg_replace('!<script.*?>.*?</script.*?>!is', '', $base_content);
$base_content = preg_replace('/\[.+\]/','', $base_content);
$base_content = strip_tags($base_content);
$trim_content = mb_substr($base_content, 0, $a,"utf-8");
$trim_content = str_replace(']]>', ']]&gt;', $trim_content);
$trim_content = str_replace(array("\r\n", "\r", "\n" , "&nbsp;"), "", $trim_content);
$trim_content = htmlspecialchars($trim_content);

};

return $trim_content;

};
function trim_desc($desc,$num) {

$trim_desc = mb_substr($desc, 0, $num ,"utf-8");
$count_word = mb_strlen($trim_desc,"utf-8");
return $trim_desc;

};

//抜粋からPタグを取り除く
remove_filter( 'the_excerpt', 'wpautop' );


// 記事タイトルの文字数制限 --------------------------------------------------------------------------------
function trim_title($num) {
$base_title = strip_tags(get_the_title());
$trim_title = mb_substr($base_title, 0, $num ,"utf-8");
$count_title = mb_strlen($trim_title,"utf-8");
if($count_title > $num-1) {
echo $trim_title . '…';
} else {
echo $trim_title;
};
};

function trim_title2($num) {
$base_title = strip_tags(get_the_title());
$trim_title = mb_substr($base_title, 0, $num ,"utf-8");
$count_title = mb_strlen($trim_title,"utf-8");
if($count_title > $num-1) {
return $trim_title . '…';
} else {
return $trim_title;
};
};

/* ショートコード用 */
function trim_title_sc($num) {
$base_title = get_the_title();
$trim_title = mb_substr($base_title, 0, $num ,"utf-8");
$count_title = mb_strwidth($trim_title,"utf-8");
if($count_title > $num-1) {
return $trim_title . '…';
} else {
return $trim_title;
};
};


// タイトルをエンコード --------------------------------------------------------------------------------
function get_encoded_title($title){
return urlencode(mb_convert_encoding($title, "UTF-8"));
}


// セルフピンバックを禁止する -------------------------------------------------------------------------------------
function no_self_ping( &$links ) {
$home = home_url();
foreach ( $links as $l => $link )
if ( 0 === strpos( $link, $home ) )
unset($links[$l]);
}
add_action( 'pre_ping', 'no_self_ping' );


// RSS用のフィードを追加 ---------------------------------------------------------------------------------------------------
add_theme_support( 'automatic-feed-links' );


//　ヘッダーから余分なMETA情報を削除 --------------------------------------------------------------------
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );


// インラインスタイルを取り除く --------------------------------------------------------------------------------
function remove_recent_comments_style() {
global $wp_widget_factory;
remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'remove_recent_comments_style' );

function remove_adminbar_inline_style() {
remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('get_header', 'remove_adminbar_inline_style');


//　サムネイルの設定 --------------------------------------------------------------------------------
if ( function_exists('add_theme_support') ) {
add_theme_support( 'post-thumbnails' );
add_image_size( 'size1', 300, 300, true ); // widget
add_image_size( 'size2', 483, 322, true ); // blog related post
add_image_size( 'size3', 723, 472, true ); // blog archive
add_image_size( 'size4', 1200, 776, true ); // blog single page
add_image_size( 'size5', 724, 825, true ); // work archive page
}


// アイキャッチ画像登録エリアに推奨サイズを表示する
function message_image_meta_box($content, $post_id, $thumbnail_id) {
$post = get_post($post_id);
$options = get_design_plus_option();
if ( $post->post_type == 'post' || $post->post_type == 'news') {
$content .= '<p>' . sprintf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '1200', '776') . '
</p>';
return $content;
}
if ( $post->post_type == 'work') {
$content .= '<p>' . sprintf(__('Recommend image size. Width:%1$spx, Height:%2$spx.', 'tcd-horizon'), '724', '825') . '
</p>';
return $content;
}
if ( $post->post_type == 'page') {
$content .= '<p>' . sprintf(__('Recommend image size. Width:%1$spx, Height:%2$spx.<br>This image will be used in search
    result and OGP tag.', 'tcd-horizon'),'1200','630') . '</p>';
return $content;
}
return $content;
}
add_filter('admin_post_thumbnail_html', 'message_image_meta_box', 10, 3);


//require get_template_directory() . '/functions/blur_image.php'; //ぼかし画像


// カスタムメニューの設定 --------------------------------------------------------------------------------
if(function_exists('register_nav_menu')) {
register_nav_menu( 'global-menu', __( 'Global menu', 'tcd-horizon' ));
}

// current-menu-itemを付ける
function custom_active_item_classes($classes = array(), $menu_item = false) {
if(is_single()){
global $post;
$id = ( isset( $post->ID ) ? get_the_ID() : NULL );
if (isset( $id )){
$classes[] = ($menu_item->url == get_post_type_archive_link($post->post_type)) ? 'current-menu-item' : '';
}
}
return $classes;
}
add_filter( 'nav_menu_css_class', 'custom_active_item_classes', 10, 2 );


// メガメニュー --------------------------------------------------------------------------------
require get_template_directory() . '/functions/menu.php';
if ( ! function_exists( 'wp_get_nav_menu_name' ) ) {
function wp_get_nav_menu_name( $location ) {
$menu_name = '';
$locations = get_nav_menu_locations();
if ( isset( $locations[ $location ] ) ) {
$menu = wp_get_nav_menu_object( $locations[ $location ] );
if ( $menu && $menu->name ) {
$menu_name = $menu->name;
}
}
return apply_filters( 'wp_get_nav_menu_name', $menu_name, $location );
}
}


// 絵文字を消す ------------------------------------------------------------------
function disable_emoji() {
$options = get_design_plus_option();
if ( $options['use_emoji'] == 0 ) {
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
} elseif ( $options['use_css_optimization'] ) {
// 絵文字styleが先頭にある関係でCSS最適化+common.css未生成時に不具合起こる対策
remove_action( 'wp_print_styles', 'print_emoji_styles' );
add_action( 'wp_head', 'print_emoji_styles', 10 );
}
}
add_action( 'init', 'disable_emoji' );


// bodyタグにclassを追加 --------------------------------------------------------------------------------
function tcd_body_classes($classes) {
global $wp_query, $post;
$options = get_design_plus_option();

if(wp_is_mobile()){ $classes[] = 'mobile_device'; }

if($options['show_header_message']) { $classes[] = 'show_header_message'; }

if(
$options['show_loading'] && is_front_page() && $options['loading_display_page'] == 'type1' &&
$options['loading_display_time'] == 'type1' && !isset($_COOKIE['first_visit']) ||
$options['show_loading'] && is_front_page() && $options['loading_display_page'] == 'type1' &&
$options['loading_display_time'] == 'type2' ||
$options['show_loading'] && $options['loading_display_page'] == 'type2' && $options['loading_display_time'] == 'type1'
&& !isset($_COOKIE['first_visit']) ||
$options['show_loading'] && $options['loading_display_page'] == 'type2' && $options['loading_display_time'] == 'type2'
){
$classes[] = 'use_loading_screen';
};

if( is_page() && (get_post_meta($post->ID, 'hide_page_header_bar', true) == 'yes') ) { $classes[] =
'hide_page_header_bar'; };
if( is_page() && (get_post_meta($post->ID, 'page_hide_footer', true) == 'yes') ) { $classes[] = 'hide_footer'; };

if( is_404() ) { $classes[] = 'home'; };

if(is_archive()) {
global $wp_query;
if($wp_query->max_num_pages == 1) {
$classes[] = 'no_page_nav';
}
}

if( is_single() && (!comments_open() && !pings_open()) ) { $classes[] = 'no_comment_form'; };

if (wp_is_mobile()) {
$classes[] = 'mobile_device';
};

if ( is_mobile() && ($options['footer_bar_display'] == 'type1') ) { $classes[] = 'show_footer_bar dp-footer-bar-type1';
};

if ( is_mobile() && ($options['footer_bar_display'] == 'type2') ) { $classes[] = 'show_footer_bar dp-footer-bar-type2';
};

return array_unique($classes);
};
add_filter('body_class','tcd_body_classes');


// HEXをRGBに変換 ------------------------------------------------------------------
function hex2rgb($hex) {
$hex = str_replace("#", "", $hex);

if(strlen($hex) == 3) {
$r = hexdec(substr($hex,0,1).substr($hex,0,1));
$g = hexdec(substr($hex,1,1).substr($hex,1,1));
$b = hexdec(substr($hex,2,1).substr($hex,2,1));
} else {
$r = hexdec(substr($hex,0,2));
$g = hexdec(substr($hex,2,2));
$b = hexdec(substr($hex,4,2));
}
$rgb = array($r, $g, $b);
return $rgb;
}


// archive_title() 関数をカスタマイズ --------------------------------------------------------------------------------
function monolith_archive_title( $title ) {
global $author, $post, $wp_query;
if ( is_author() ) {
$title = get_the_author_meta( 'display_name', $author );
} elseif ( is_category() || is_tag() ) {
$title = single_term_title( '', false );
} elseif ( is_day() ) {
$title = get_the_time( __( 'F jS, Y', 'tcd-horizon' ), $post );
} elseif ( is_month() ) {
$title = get_the_time( __( 'F, Y', 'tcd-horizon' ), $post );
} elseif ( is_year() ) {
$title = get_the_time( __( 'Y', 'tcd-horizon' ), $post );
} elseif ( is_search() ) {
if ( $wp_query->found_posts ) {
//$title = sprintf( __( 'Search results for - ', 'tcd-horizon' ) . get_search_query()
} else {
$title = __( 'Search result', 'tcd-horizon' );
}
}
return $title;
}
add_filter( 'get_the_archive_title', 'monolith_archive_title', 10 );


// カスタムコメント --------------------------------------------------------------------------------------

if (function_exists('wp_list_comments')) {
// comment count
add_filter('get_comments_number', 'comment_count', 0);
function comment_count( $commentcount ) {
global $id;
$_commnets = get_comments('post_id=' . $id);
$comments_by_type = separate_comments($_commnets);
return count($comments_by_type['comment']);
}
}


function custom_comments($comment, $args, $depth) {
$GLOBALS['comment'] = $comment;
global $commentcount;
if(!$commentcount) {
$commentcount = 0;
}
?>

<li class="comment <?php if($comment->comment_author_email == get_the_author_meta('email')) {echo 'admin-comment';} else {echo 'guest-comment';} ?>"
    id="comment-<?php comment_ID() ?>">
    <div class="comment-meta clearfix">
        <div class="comment-meta-left">
            <?php if (function_exists('get_avatar') && get_option('show_avatars')) { echo get_avatar($comment, 35); } ?>

            <ul class="comment-name-date">
                <li class="comment-name">
                    <?php if (get_comment_author_url()) : ?>
                    <a id="commentauthor-<?php comment_ID() ?>"
                        class="url <?php if($comment->comment_author_email == get_the_author_meta('email')) {echo 'admin-url';} else {echo 'guest-url';} ?>"
                        href="<?php comment_author_url() ?>" rel="nofollow">
                        <?php else : ?>
                        <span id="commentauthor-<?php comment_ID() ?>">
                            <?php endif; ?>

                            <?php comment_author(); ?>

                            <?php if(get_comment_author_url()) : ?>
                    </a>
                    <?php else : ?>
                    </span>
                    <?php endif; ?>
                <li class="comment-date"><?php echo get_comment_time('Y.m.d'); echo get_comment_time(' g:ia'); ?></li>
            </ul>
        </div>

        <ul class="comment-act">
            <?php if (function_exists('comment_reply_link')) { 
        if ( get_option('thread_comments') == '1' ) { ?>
            <li class="comment-reply">
                <?php comment_reply_link(array_merge( $args, array('add_below' => 'comment-content', 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => '<span><span>'.__('REPLY','tcd-horizon').'</span></span>'))) ?>
            </li>
            <?php   } else { ?>
            <li class="comment-reply"><a href="javascript:void(0);"
                    onclick="MGJS_CMT.reply('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment');"><?php _e('REPLY', 'tcd-horizon'); ?></a>
            </li>
            <?php   }
      } else { ?>
            <li class="comment-reply"><a href="javascript:void(0);"
                    onclick="MGJS_CMT.reply('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment');"><?php _e('REPLY', 'tcd-horizon'); ?></a>
            </li>
            <?php } ?>
            <li class="comment-quote"><a href="javascript:void(0);"
                    onclick="MGJS_CMT.quote('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment-content-<?php comment_ID() ?>', 'comment');"><?php _e('QUOTE', 'tcd-horizon'); ?></a>
            </li>
            <?php edit_comment_link(__('EDIT', 'tcd-horizon'), '<li class="comment-edit">', '</li>'); ?>
        </ul>

    </div>
    <div class="comment-content post_content" id="comment-content-<?php comment_ID() ?>">
        <?php if ($comment->comment_approved == '0') : ?>
        <span class="comment-note"><?php _e('Your comment is awaiting moderation.', 'tcd-horizon'); ?></span>
        <?php endif; ?>
        <?php comment_text(); ?>
    </div>

    <?php

}


/* 記事編集画面のカテゴリー階層を保つ */
function lig_wp_category_terms_checklist_no_top( $args, $post_id = null ) {
  $args['checked_ontop'] = false;
  return $args;
}
add_action( 'wp_terms_checklist_args', 'lig_wp_category_terms_checklist_no_top' );



// ブログアーカイブページの表示数 --------------------------------------------------------------------------------
function change_blog_num( $query ) {
  $options = get_design_plus_option();
  if(is_mobile()){
    $post_num = $options['archive_blog_num_sp'];
  } else {
    $post_num = $options['archive_blog_num'];
  }
  if( (!is_admin() && is_archive()) || (!is_admin() && is_home()) || (!is_admin() && is_search())) {
    if($query->is_main_query()) {
      $query->set('posts_per_page', $post_num);
      return;
    };
  }
}
add_action( 'pre_get_posts', 'change_blog_num' );


// カスタム投稿の数が多い為、メディアメニューの位置を変更 ----------------------------------------------------------
function customize_menus(){
  global $menu;
  $menu[19] = $menu[10];
  unset($menu[10]);
}
add_action( 'admin_menu', 'customize_menus' );


// カスタム投稿「お知らせ」 --------------------------------------------------------------------------------
$options = get_design_plus_option();
$news_label = $options['news_label'] ? esc_html( $options['news_label'] ) : __( 'News', 'tcd-horizon' );
$news_slug = $options['news_slug'] ? sanitize_title( $options['news_slug'] ) : 'news';
$news_labels = array(
  'name' => $news_label,
  'add_new' => __( 'Add New', 'tcd-horizon' ),
  'add_new_item' => __( 'Add New Item', 'tcd-horizon' ),
  'edit_item' => __( 'Edit', 'tcd-horizon' ),
  'new_item' => __( 'New item', 'tcd-horizon' ),
  'view_item' => __( 'View Item', 'tcd-horizon' ),
  'search_items' => __( 'Search Items', 'tcd-horizon' ),
  'not_found' => __( 'Not Found', 'tcd-horizon' ),
  'not_found_in_trash' => __( 'Not found in trash', 'tcd-horizon' ),
  'parent_item_colon' => ''
);

register_post_type( 'news', array(
  'label' => $news_label,
  'labels' => $news_labels,
  'public' => true,
  'publicly_queryable' => true,
  'menu_position' => 5,
  'show_ui' => true,
  'query_var' => true,
  'rewrite' => array( 'slug' => $news_slug ),
  'capability_type' => 'post',
  'has_archive' => true,
  'hierarchical' => false,
  'supports' => array( 'title', 'editor', 'thumbnail' ),
  'show_in_rest' => false	// ブロックエディターを使用しない、REST APIで表示しない
));


/* アーカイブページの記事数を変更 */
function change_news_num( $query ) {
  $options = get_design_plus_option();
  if(is_mobile()){
    $post_num = $options['archive_news_num_sp'];
  } else {
    $post_num = $options['archive_news_num'];
  }
  if( !is_admin() && is_post_type_archive('news')) {
    if($query->is_main_query()) {
      $query->set('posts_per_page', $post_num);
      return;
    };
  }
}
add_action( 'pre_get_posts', 'change_news_num' );


// カスタム投稿「ワークス」 --------------------------------------------------------------------------------
$work_label = $options['work_label'] ? esc_html( $options['work_label'] ) : __( 'Work', 'tcd-horizon' );
$work_slug = $options['work_slug'] ? sanitize_title( $options['work_slug'] ) : 'work';
$work_labels = array(
  'name' => $work_label,
  'add_new' => __( 'Add New', 'tcd-horizon' ),
  'add_new_item' => __( 'Add New Item', 'tcd-horizon' ),
  'edit_item' => __( 'Edit', 'tcd-horizon' ),
  'new_item' => __( 'New item', 'tcd-horizon' ),
  'view_item' => __( 'View Item', 'tcd-horizon' ),
  'search_items' => __( 'Search Items', 'tcd-horizon' ),
  'not_found' => __( 'Not Found', 'tcd-horizon' ),
  'not_found_in_trash' => __( 'Not found in trash', 'tcd-horizon' ),
  'parent_item_colon' => ''
);

register_post_type( 'work', array(
  'label' => $work_label,
  'labels' => $work_labels,
  'public' => true,
  'publicly_queryable' => true,
  'menu_position' => 5,
  'show_ui' => true,
  'query_var' => true,
  'rewrite' => array( 'slug' => $work_slug ),
  'capability_type' => 'post',
  'has_archive' => true,
  'hierarchical' => false,
  'supports' => array( 'title', 'thumbnail' ),
  'show_in_rest' => false	// ブロックエディターを使用しない、REST APIで表示しない
));


/* アーカイブ・カテゴリーページの記事数を変更 */
function change_work_num( $query ) {
  $options = get_design_plus_option();
  $post_num = -1;
  if( !is_admin() && is_post_type_archive('work') ) {
    if($query->is_main_query()) {
      $query->set('posts_per_page', $post_num);
      return;
    };
  }
}
add_action( 'pre_get_posts', 'change_work_num' );


/* 説明文を削除 */
add_filter('manage_edit-work_category_columns', function ($columns) {
  if( isset( $columns['description'] ) )
  unset( $columns['description'] );
  return $columns;
});


// 全てのカスタムフィールドを検索対象に含める --------------------------------------------------------------------------------
function cf_search_join($join, $query) {
    global $wpdb;
    if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {
        $join .=' LEFT JOIN '.$wpdb->postmeta. ' AS tcd_pm_search ON '. $wpdb->posts . '.ID = tcd_pm_search.post_id ';
    }
    return $join;
}
add_filter('posts_join', 'cf_search_join', 10, 2);

function cf_search_where($where, $query) {
    global $wpdb;
    if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (tcd_pm_search.meta_value LIKE $1)", $where);
    }
    return $where;
}
add_filter('posts_where', 'cf_search_where', 10, 2);

function cf_search_distinct($distinct, $query) {
    global $wpdb;
    if ( ! is_admin() && $query->is_main_query() && $query->is_search() ) {
        return "DISTINCT";
    }
    return $distinct;
}
add_filter('posts_distinct', 'cf_search_distinct', 10, 2);


// 検索対象にする記事タイプを設定 --------------------------------------------------------------------------------
function SearchFilter($query) {
  $options = get_design_plus_option();
  if ( !is_admin() && $query->is_main_query() && $query->is_search() ) {
    $post_types = array();
    if($options['search_type_post'] == 'yes'){
      array_push($post_types,'post');
    }
    if($options['search_type_page'] == 'yes'){
      array_push($post_types,'page');
    }
    if($options['search_type_news'] == 'yes'){
      array_push($post_types,'news');
    }
    if($options['search_type_work'] == 'yes'){
      array_push($post_types,'work');
    }
    $query->set('post_type', $post_types );

    if($options['search_type_post'] == 'no' && $options['search_type_page'] == 'no' && $options['search_type_news'] == 'no' && $options['search_type_work'] == 'no'){
      $query->set('name', 'set_dummy_page_id' );
    }

    if($options['search_type_page'] == 'yes'){
      $front_page_id = get_option('page_on_front');
      if($front_page_id){
        $query->set('post__not_in', array($front_page_id) );
      }
    }
  }
}
add_action( 'pre_get_posts','SearchFilter' );


// タイトルとurlをコピーのスクリプト --------------------------------------------------------------------------------
function copy_title_url_script() {
  global $options;
  if ( ! $options ) $options = get_design_plus_option();

  if ( (is_singular('post') && $options['single_blog_show_copy_top'] == 'display') || (is_singular('news') && $options['single_news_show_copy_top'] == 'display') ) {
    wp_enqueue_script( 'copy_title_url', get_template_directory_uri().'/js/copy_title_url.js', array(), version_num(), true );
  }
}
add_action( 'wp_enqueue_scripts', 'copy_title_url_script' );


// カテゴリー編集画面にIDを表示する ------------------------------------------------------------------------------------
function add_category_columns( $columns ) {
  echo '<style>
  .taxonomy-category .manage-column.num {width: 90px;}
  .taxonomy-category .manage-column.column-id {width: 60px;}
  </style>';

  $columns['id'] = 'ID';
  return $columns;
}
function add_category_sortable_columns( $columns ) {
  $columns['id'] = 'ID';
  return $columns;
}
function custom_category_column( $content, $column_name, $term_id ) {
  if ( $column_name == 'id' ) {
    echo $term_id;
  }
}
add_filter( 'manage_edit-category_columns', 'add_category_columns' );
add_filter( 'manage_edit-category_sortable_columns', 'add_category_sortable_columns' );
add_action( 'manage_category_custom_column', 'custom_category_column', 10, 3 );


// ページのナビの有無をチェック ---------------------------------------------------------------------------------------
function show_posts_nav() {
  global $wp_query;
  return ($wp_query->max_num_pages > 1);
};


// ブログ用固定ページかっらメタボックス削除 ------------------------------------------------------------------------
function tcd_remove_meta_boxes() {
  global $typenow, $post;

  // ホームページ・投稿ページ表示に設定されているに固定ページ編集時
  if ( 'page' === $typenow && ! empty( $post->ID ) && 'page' === get_option('show_on_front') && in_array( $post->ID, array( get_option( 'page_on_front' ), get_option( 'page_for_posts' ) ) ) ) {
    remove_meta_box( 'page_header_meta_box', 'page', 'normal' );
    remove_meta_box( 'select_pw_meta_box', 'page', 'normal' );
    remove_meta_box( 'postexcerpt', 'page', 'normal' );
    remove_meta_box( 'pageparentdiv', 'page', 'normal' );
  }

}
add_action( 'add_meta_boxes', 'tcd_remove_meta_boxes', 999 );

// GALLERYへのスライド設定（URLから"/gt3_gallery/"を取り除き”#cb_content_コンテンツ番号”を挿入） ------------------------------------------------------------------------

function remcat_function($link) {
  return str_replace("gt3_gallery", "/", "#cb_content_5",$link);
  }
  add_filter('user_trailingslashit', 'remcat_function');
  function remcat_flush_rules() {
  global $wp_rewrite;
  $wp_rewrite->flush_rules();
  }
  add_action('init', 'remcat_flush_rules');
  function remcat_rewrite($wp_rewrite) {
  $new_rules = array('(.+)/page/(.+)/?' => 'index.php?category_name='.$wp_rewrite->preg_index(1).'&paged='.$wp_rewrite->preg_index(2));
  $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
  }
  add_filter('generate_rewrite_rules', 'remcat_rewrite');
  

?>