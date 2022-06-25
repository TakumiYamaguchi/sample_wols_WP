<?php

class tcdw_search_box_widget extends WP_Widget {

  function __construct() {
    parent::__construct(
      'tcdw_search_box_widget',// ID
      __( 'Filter and search (tcd ver)', 'tcd-horizon' ),
      array(
        'classname' => 'tcdw_search_box_widget',
        'description' => __('Displays category menu, archive menu, and search form in one widget.', 'tcd-horizon')
      )
    );
  }

  function widget($args, $instance) {

    extract( $args );
    $category_headline = $instance['category_headline'];
    $archive_headline = $instance['archive_headline'];
    $search_headline = $instance['search_headline'];
    $search_order = $instance['search_order'];

    // Before widget //
    echo $before_widget;

    if (!empty($search_order)) {
      foreach ( $search_order as $key => $value ) :
        if(!empty($value['show'])){
?>

  <?php if($value['title'] == 'category'){ ?>
  <div class="box_item">
   <h3 class="search_box_headline"><?php echo esc_html($category_headline); ?></h3>
   <div class="design_select_box">
    <label>OPEN</label>
    <?php
         $categories = get_categories(array('taxonomy' => 'category'));
         if ( $categories ) {
    ?>
    <select name="cat-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;">
     <option value="" selected="selected"><?php echo __( 'Select category', 'tcd-horizon'); ?></option>
     <?php foreach ( $categories as $category ) { ?>
     <option value="<?php echo esc_url(get_category_link($category->term_id)); ?>"><?php echo esc_html($category->name); ?></option>
     <?php }; ?>
    </select>
    <?php }; ?>
   </div>
  </div>
  <?php }; ?>

  <?php if($value['title'] == 'archive'){ ?>
  <div class="box_item">
   <h3 class="search_box_headline"><?php echo esc_html($archive_headline); ?></h3>
   <div class="design_select_box">
    <label>OPEN</label>
    <select name="archive-dropdown" onChange='document.location.href=this.options[this.selectedIndex].value;'> 
     <option value=""><?php echo __('Select Month','tcd-horizon'); ?></option> 
     <?php wp_get_archives( 'type=monthly&format=option&show_post_count=0' ); ?>
    </select>
   </div>
  </div>
  <?php }; ?>

  <?php if($value['title'] == 'search'){ ?>
  <div class="box_item">
   <h3 class="search_box_headline"><?php echo esc_html($search_headline); ?></h3>
   <div class="search_area">
    <form method="get" action="<?php echo esc_url(home_url('/')); ?>">
     <div class="search_input"><input type="text" value="" name="s" /></div>
     <div class="search_button"><input type="submit" value="<?php _e('Search','tcd-horizon'); ?>" /></div>
    </form>
   </div>
  </div>
  <?php }; ?>

<?php
         };
       endforeach;
     };

    // After widget //
    echo $after_widget;

  } // end function widget


  // Update Settings //
  function update($new_instance, $old_instance) {
    $instance['category_headline'] = $new_instance['category_headline'];
    $instance['archive_headline'] = $new_instance['archive_headline'];
    $instance['search_headline'] = $new_instance['search_headline'];
    $instance['search_order'] = $new_instance['search_order'];
    return $instance;
  }

  // Widget Control Panel //
  function form($instance) {
    $defaults = array( 'search_order' => array(array('title' => 'category', 'show' => '1'),array('title' => 'archive', 'show' => '1'),array('title' => 'search', 'show' => '1')), 'category_headline' => __('CATEGORY', 'tcd-horizon'),'archive_headline' => __('ARCHIVE', 'tcd-horizon'), 'search_headline' => __('SEARCH', 'tcd-horizon'));
    $instance = wp_parse_args( (array) $instance, $defaults );
?>
<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Headline of category', 'tcd-horizon'); ?></h3>
 <input class="widefat" name="<?php echo $this->get_field_name('category_headline'); ?>'" type="text" value="<?php echo $instance['category_headline']; ?>" />
</div>
<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Headline of archive', 'tcd-horizon'); ?></h3>
 <input class="widefat" name="<?php echo $this->get_field_name('archive_headline'); ?>'" type="text" value="<?php echo $instance['archive_headline']; ?>" />
</div>
<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Headline of search', 'tcd-horizon'); ?></h3>
 <input class="widefat" name="<?php echo $this->get_field_name('search_headline'); ?>'" type="text" value="<?php echo $instance['search_headline']; ?>" />
</div>
<div class="tcd_widget_content">
 <h3 class="tcd_widget_headline"><?php _e('Display setting', 'tcd-horizon'); ?></h3>
 <div class="theme_option_message2">
  <p><?php _e('You can change order by dragging each label.', 'tcd-horizon'); ?></p>
 </div>
 <div class="search_box_search_order">
  <?php
       if ( $instance['search_order'] && is_array( $instance['search_order'] ) ) :
         foreach ( $instance['search_order'] as $repeater_key => $repeater_value ) :
  ?>
  <div class="item repeater-item-<?php echo esc_attr( $repeater_key ); ?>">
   <p class="search_order_headline">
    <input id="<?php echo $this->get_field_id('search_order'); ?>[<?php echo esc_attr( $repeater_key ); ?>][show]" name="<?php echo $this->get_field_name('search_order'); ?>[<?php echo esc_attr( $repeater_key ); ?>][show]" type="checkbox" value="1" <?php if ( !empty($repeater_value['show']) ) echo 'checked="checked"'; ?> />
    <label for="<?php echo $this->get_field_id('search_order'); ?>[<?php echo esc_attr( $repeater_key ); ?>][show]"><?php if($repeater_value['title'] == 'category'){ _e('Display category', 'tcd-horizon'); } elseif($repeater_value['title'] == 'archive'){ _e('Display archive', 'tcd-horizon'); } else { _e('Display search', 'tcd-horizon'); }; ?></label>
   </p>
   <input class="search_order_input" type="hidden" name="<?php echo $this->get_field_name('search_order'); ?>[<?php echo esc_attr( $repeater_key ); ?>][title]" value="<?php if ( $repeater_value['title'] ) echo esc_attr( $repeater_value['title'] ); ?>">
  </div>
  <?php
         endforeach;
       endif;
  ?>
 </div>
</div>
<?php
  } // end function form

} // end class


function register_tcdw_search_box_widget() {
	register_widget( 'tcdw_search_box_widget' );
}
add_action( 'widgets_init', 'register_tcdw_search_box_widget' );


?>