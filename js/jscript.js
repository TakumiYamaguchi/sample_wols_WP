jQuery(document).ready(function($){

  var $window = $(window);
  var $body = $('body');

  $("a").bind("focus",function(){if(this.blur)this.blur();});
  $("a.target_blank").attr("target","_blank");


  // mega menu -------------------------------------------------

  $("#global_menu .megamenu_type2").each(function () {
    var mega_menu_id = $(this).data('megamenu');
    if( $(this).next('.sub-menu').length ){
      var mega_menu_list = $(this).next('.sub-menu').clone(true);
      $('#'+mega_menu_id).prepend(mega_menu_list);
    }
  });

  $('a.megamenu_button').parent().addClass('megamenu_parent');

  // mega menu basic animation
  $('[data-megamenu]').each(function() {

    var mega_menu_button = $(this);
    var sub_menu_wrap =  "#" + $(this).data("megamenu");
    var hide_sub_menu_timer;
    var hide_sub_menu_interval = function() {
      if (hide_sub_menu_timer) {
        clearInterval(hide_sub_menu_timer);
        hide_sub_menu_timer = null;
      }
      hide_sub_menu_timer = setInterval(function() {
        if (!$(mega_menu_button).is(':hover') && !$(sub_menu_wrap).is(':hover')) {
          $(sub_menu_wrap).stop().css('z-index','100').removeClass('active_mega_menu');
          clearInterval(hide_sub_menu_timer);
          hide_sub_menu_timer = null;
        }
      }, 20);
    };

    mega_menu_button.hover(
     function(){
       if (hide_sub_menu_timer) {
         clearInterval(hide_sub_menu_timer);
         hide_sub_menu_timer = null;
       }
       if ($('html').hasClass('pc')) {
         $(this).parent().addClass('active_megamenu_button');
         $(this).parent().find("ul").addClass('megamenu_child_menu');
         $(sub_menu_wrap).stop().css('z-index','200').addClass('active_mega_menu');
         if( $('.megamenu_slider').length ){
           $('.megamenu_slider').slick('setPosition');
         };
       }
     },
     function(){
       if ($('html').hasClass('pc')) {
         $(this).parent().removeClass('active_megamenu_button');
         $(this).parent().find("ul").removeClass('megamenu_child_menu');
         hide_sub_menu_interval();
       }
     }
    );

    $(sub_menu_wrap).hover(
      function(){
        $(mega_menu_button).parent().addClass('active_megamenu_button');
      },
      function(){
        $(mega_menu_button).parent().removeClass('active_megamenu_button');
      }
    );


    $('#header').on('mouseout', sub_menu_wrap, function(){
     if ($('html').hasClass('pc')) {
       hide_sub_menu_interval();
     }
    });

  }); // end mega menu


  // header search
  $("#header_search_button").on('click',function() {
    if($(this).parent().hasClass("active")) {
      $(this).parent().removeClass("active");
      return false;
    } else {
      $(this).parent().addClass("active");
      $('#header_search_input').focus();
      return false;
    }
  });


  // global menu
  $("#global_menu li:not(.megamenu_parent)").hover(function(){
    $(">ul:not(:animated)",this).slideDown("fast");
    $(this).addClass("active");
  }, function(){
    $(">ul",this).slideUp("fast");
    $(this).removeClass("active");
  });


  //fixed footer content
  var fixedFooter = $('#fixed_footer_content');
  fixedFooter.removeClass('active');
  $window.scroll(function () {
    if ($body.hasClass('show-horizontal')) return;

    if ($(this).scrollTop() > 330) {
      fixedFooter.addClass('active');
    } else {
      fixedFooter.removeClass('active');
    }
  });
  $('#fixed_footer_content .close').click(function() {
    $("#fixed_footer_content").hide();
    return false;
  });


  // comment button
  $("#comment_tab li").click(function() {
    $("#comment_tab li").removeClass('active');
    $(this).addClass("active");
    $(".tab_contents").hide();
    var selected_tab = $(this).find("a").attr("href");
    $(selected_tab).fadeIn();
    return false;
  });


  //custom drop menu widget
  $(".tcdw_custom_drop_menu li:has(ul)").addClass('parent_menu');
  $(".tcdw_custom_drop_menu li").hover(function(){
     $(">ul:not(:animated)",this).slideDown("fast");
     $(this).addClass("active");
  }, function(){
     $(">ul",this).slideUp("fast");
     $(this).removeClass("active");
  });


  // design select box widget
  $(".design_select_box select").on("click" , function() {
    $(this).closest('.design_select_box').toggleClass("open");
  });
  $(document).mouseup(function (e){
    var container = $(".design_select_box");
    if (container.has(e.target).length === 0) {
      container.removeClass("open");
    }
  });


  //archive list widget
  if ($('.p-dropdown').length) {
    $('.p-dropdown__title').click(function() {
      $(this).toggleClass('is-active');
      $('+ .p-dropdown__list:not(:animated)', this).slideToggle();
    });
  }


  //category widget
  $(".tcd_category_list li:has(ul)").addClass('parent_menu');
  $(".tcd_category_list li.parent_menu > a").parent().prepend("<span class='child_menu_button'></span>");
  $(".tcd_category_list li .child_menu_button").on('click',function() {
     if($(this).parent().hasClass("open")) {
       $(this).parent().removeClass("active");
       $(this).parent().removeClass("open");
       $(this).parent().find('>ul:not(:animated)').slideUp("fast");
       return false;
     } else {
       $(this).parent().addClass("active");
       $(this).parent().addClass("open");
       $(this).parent().find('>ul:not(:animated)').slideDown("fast");
       return false;
     };
  });


  //tab post list widget
  $('.widget_tab_post_list_button').on('click', '.tab1', function(){
    $(this).siblings().removeClass('active');
    $(this).addClass('active');
    $(this).closest('.tab_post_list_widget').find('.widget_tab_post_list1').addClass('active');
    $(this).closest('.tab_post_list_widget').find('.widget_tab_post_list2').removeClass('active');
    return false;
  });
  $('.widget_tab_post_list_button').on('click', '.tab2', function(){
    $(this).siblings().removeClass('active');
    $(this).addClass('active');
    $(this).closest('.tab_post_list_widget').find('.widget_tab_post_list2').addClass('active');
    $(this).closest('.tab_post_list_widget').find('.widget_tab_post_list1').removeClass('active');
    return false;
  });


  //search widget
  $('.widget_search #searchsubmit').wrap('<div class="submit_button"></div>');
  $('.google_search #searchsubmit').wrap('<div class="submit_button"></div>');


  //calendar widget
  $('.wp-calendar-table td').each(function () {
    if ( $(this).children().length == 0 ) {
      $(this).addClass('no_link');
      $(this).wrapInner('<span></span>');
    } else {
      $(this).addClass('has_link');
    }
  });


  // FAQ list
  $('.faq_list .title').on('click', function() {
    var desc = $(this).next('.desc_area');
    var acc_height = desc.find('.desc').outerHeight(true);
    if($(this).hasClass('active')){
      desc.css('height', '');
      $(this).removeClass('active');
    }else{
      desc.css('height', acc_height);
      $(this).addClass('active');
    }
  });


  // quick tag - underline ------------------------------------------
  if ($('.q_underline').length) {
    var gradient_prefix = null;

    $('.q_underline').each(function(){
      var bbc = $(this).css('borderBottomColor');
      if (jQuery.inArray(bbc, ['transparent', 'rgba(0, 0, 0, 0)']) == -1) {
        if (gradient_prefix === null) {
          gradient_prefix = '';
          var ua = navigator.userAgent.toLowerCase();
          if (/webkit/.test(ua)) {
            gradient_prefix = '-webkit-';
          } else if (/firefox/.test(ua)) {
            gradient_prefix = '-moz-';
          } else {
            gradient_prefix = '';
          }
        }
        $(this).css('borderBottomColor', 'transparent');
        if (gradient_prefix) {
          $(this).css('backgroundImage', gradient_prefix+'linear-gradient(left, transparent 50%, '+bbc+ ' 50%)');
        } else {
          $(this).css('backgroundImage', 'linear-gradient(to right, transparent 50%, '+bbc+ ' 50%)');
        }
      }
    });

    $window.on('scroll.q_underline', function(){
      $('.q_underline:not(.is-active)').each(function(){
        if ($body.hasClass('show-horizontal')) {
          var left = $(this).offset().left;
          if (window.scrollX > left - window.innerHeight) {
            $(this).addClass('is-active');
          }
        } else {
          var top = $(this).offset().top;
          if (window.scrollY > top - window.innerHeight) {
            $(this).addClass('is-active');
          }
        }
      });
      if (!$('.q_underline:not(.is-active)').length) {
        $window.off('scroll.q_underline');
      }
    });
  }


  //return top button
  var return_top_button = $('#return_top');
  $('a',return_top_button).click(function() {
    var myHref= $(this).attr("href");
    var myPos = $(myHref).offset().top;
    $("html,body").animate({scrollTop : myPos}, 1000, 'easeOutExpo');
    return false;
  });
  return_top_button.removeClass('active');
  $window.scroll(function () {
    if ($body.hasClass('show-horizontal')) return;

    if ($(this).scrollTop() > 100) {
      return_top_button.addClass('active');
    } else {
      return_top_button.removeClass('active');
    }
  });


  var return_top_button2 = $('#return_top2');
  $('a',return_top_button2).click(function() {
    var myHref= $(this).attr("href");
    var myPos = $(myHref).offset().top;
    $("html,body").animate({scrollTop : myPos}, 1000, 'easeOutExpo');
    return false;
  });


// responsive ------------------------------------------------------------------------
var mql = window.matchMedia('screen and (min-width: 1301px)');
function checkBreakPoint(mql) {

  if(mql.matches){ //PC

    $("html").removeClass("mobile");
    $("html").addClass("pc");

    $("#drawer_menu a[href*=#]").off('click.drawerAnchorLink');

  } else { //smart phone

    $("html").removeClass("pc");
    $("html").addClass("mobile");


    // drawer menu
    if( $('#drawer_menu').length ){

      $('#drawer_menu .menu a').wrapInner('<span class="title"></span>');
      $('#drawer_menu .menu-item-has-children > a > span').after('<span class="button"></span>');

      $('#drawer_menu .menu-item-has-children > ul').each(function () {
        var child_menu_height = $(this).height();
        $(this).data('menu_height',child_menu_height).css('height','0');
      });

      var drawer_menu_height = $window.height();
      var drawer_menu_content_height = $("#drawer_menu_content_inner").height() + 10;
      $("#drawer_menu_content_inner").css("padding-top", (drawer_menu_height - drawer_menu_content_height) / 2);
      $(window).on('resize', function(){
        var drawer_menu_height = $window.height();
        $("#drawer_menu_content_inner").css("padding-top", (drawer_menu_height - drawer_menu_content_height) / 2);
      });

      $("#drawer_menu_button").on('click',function() {
        $('body').addClass("open_drawer_menu");
        return false;
      });

      $("#drawer_menu .close_button").on('click',function() {
        $('body').removeClass("open_drawer_menu");
        return false;
      });

      $("#drawer_menu .menu .button").on('click',function() {
        if($(this).closest('.menu-item-has-children').hasClass("active")) {
          $(this).closest('.menu-item-has-children').removeClass("active");
          $(this).closest('.menu-item-has-children').find('.sub-menu').css('height','0').removeClass('active');
          return false;
        } else {
          $(this).closest('.menu-item-has-children').addClass("active");
          var menu_height = $(this).closest('.menu-item-has-children').find('.sub-menu').data('menu_height');
          $(this).closest('.menu-item-has-children').find('.sub-menu').addClass('active').css('height',menu_height);
          return false;
        };
      });

      $('#drawer_menu a[href*=#]').off('click.drawerAnchorLink').on('click.drawerAnchorLink',function() {
        if (this.hash === '#' || this.target || this.hostname !== location.hostname || this.pathname !== location.pathname) return;
        var $target = $(this.hash);
        if (!$target.length) return;

        $body.addClass('drawer_menu_fade');

        var $drawer_menu = $('#drawer_menu');
        $drawer_menu.fadeOut(300, function(){
            $body.removeClass('open_drawer_menu drawer_menu_fade');

            setTimeout(function(){
              $drawer_menu.show();
            }, 700);
        });
      });

    }; // END drawer menu

  };

};
mql.addListener(checkBreakPoint);
checkBreakPoint(mql);


});