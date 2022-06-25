<?php
     // display loading screen -----------------------------------------------------------------
     function show_loading_screen(){
       $options = get_design_plus_option();
?>
<script>

jQuery(window).bind("pageshow", function(event) {
  if (event.originalEvent.persisted) {
    window.location.reload()
  }
});


function after_load() {

  jQuery('#site_loader_logo').addClass('active');
  jQuery('body').addClass('end_loading');
  setTimeout(function(){
    jQuery('html').addClass('end_loading_show_scroll_bar');
  }, 100);
  setTimeout(function(){
    jQuery(window).trigger('horizon-scroll-start').trigger('scroll');
  }, 1100);

  <?php
       // トップページ、アバウトページ -----------------------------------
       global $post;
       if ( ( is_front_page() && $options['contents_builder']) || ( is_front_page() && $options['mobile_contents_builder']) || (is_page_template('page-about.php') && get_post_meta( $post->ID, 'lp_content', true )) ) {
          // コンテンツビルダー
         $contents_builder = '';
         if(is_front_page()){
           if(is_mobile() && $options['mobile_index_content_type'] == 'type2') {
             $contents_builder = $options['mobile_contents_builder'];
           } else {
             $contents_builder = $options['contents_builder'];
           }
         } elseif(is_page_template('page-about.php')) {
           $contents_builder = get_post_meta( $post->ID, 'lp_content', true );
         }
         if ($contents_builder) :
           foreach($contents_builder as $content) :
             if ( $content['cb_content_select'] == 'image_slider' && $content['show_content'] ) {
               if ( empty( $cb_image_slider_first_js_rendered ) ) {
                 $cb_image_slider_first_js_rendered = true;
  ?>
  jQuery('.cb_slider').slick('slickPlay');
  jQuery('.cb_slider .first_item').addClass('animate');
  setTimeout(function(){
    jQuery('.cb_slider .first_item .animate_item').each(function(i){
      jQuery(this).delay(i *700).queue(function(next) {
        jQuery(this).addClass('animate');
        next();
      });
    });
  }, 1500);
  <?php if($content['show_news_ticker']){ ?>
  jQuery('.cb_news_ticker .post_list').slick('slickPlay');
  <?php }; ?>
  <?php
               };
             };
           endforeach;
         endif;
       }
  ?>

  <?php if(!is_front_page()) { ?>
  setTimeout(function(){
    jQuery("body").addClass('start_animate');
  }, 500);
  jQuery("#page_header .animate_item").each(function(i){
    jQuery(this).delay(i *700).queue(function(next) {
      jQuery(this).addClass('animate');
      next();
    });
  });
  <?php }; ?>

}

jQuery(function($){

  <?php if ( $options['loading_display_time'] == 'type1' && !isset($_COOKIE['first_visit']) ) { ?>
  $.cookie('first_visit', 'on', {
    path:'/'
  });
  <?php }; ?>

  <?php if ( $options['loading_display_time'] == 'type1' ){ ?>
  if ($.cookie('first_visit') != 'on') {
  <?php }; ?>
    <?php if ( $options['loading_display_page'] == 'type2' ){ ?>
    $('a:not([href*=#]):not([target]):not(.no_move_page)').click(function(){
      var url = $(this).attr('href');
      if(url && !$('body').hasClass('hscroll-dragging')){
        $('#site_loader_overlay').addClass('move_next_page');
        setTimeout(function(){
          location.href = url;
        }, 300);
      }
      return false;
    });
    <?php }; ?>
  <?php if ( $options['loading_display_time'] == 'type1' ){ ?>
  };
  <?php }; ?>

  if( $('#site_loader_overlay').length ){
    var winH = $(window).innerHeight();
    $('#site_loader_overlay').css('height', winH);
    $('#site_loader_overlay').addClass('animate');
    $(window).on('resize', function(){
      var winH = $(window).innerHeight();
      $('#site_loader_overlay').css('height', winH);
      $('#site_loader_overlay').addClass('animate');
    });
  }

  <?php if ($options['loading_type'] == 'type4' || $options['loading_type'] == 'type5') { ?>
  $('#site_loader_logo').addClass('active');
  <?php }; ?>

  setTimeout(function(){
    if( $('#site_loader_overlay').is(':visible') ) {
      after_load();
    }
  }, 10000);

});

(function($) {
  $(window).on('load', function(){
    setTimeout(function(){
      after_load();
    }, <?php if ($options['loading_type'] == 'type4' || $options['loading_type'] == 'type5') { echo '2500'; } else { echo '500'; }; ?>);
  });
})(jQuery);

</script>
<?php
     };

     // no loading screen ------------------------------------------------------------------------------------------------------------------
     function no_loading_screen(){
       $options = get_design_plus_option();
?>
<script>

<?php if(wp_is_mobile()) { ?>
jQuery(window).bind("pageshow", function(event) {
  if (event.originalEvent.persisted) {
    window.location.reload()
  }
});
<?php }; ?>

jQuery(document).ready(function($){

  <?php if(!is_front_page()) { ?>
  $("body").addClass('start_animate');
  $("#page_header .animate_item").each(function(i){
    $(this).delay(i *700).queue(function(next) {
      $(this).addClass('animate');
      next();
    });
  });
  <?php }; ?>

  $(window).trigger('horizon-scroll-start').trigger('scroll');

});

</script>
<?php } ?>