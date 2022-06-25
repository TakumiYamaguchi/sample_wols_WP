(function($) {


  $(window).on('load resize', function(){

    var body = $("body");
    var header_message = $("#header_message");

    var header_message_height = 0;
    if(header_message.length){
      header_message_height = header_message.innerHeight();
    }

    if($(window).scrollTop() > header_message_height) {
      body.addClass("header_fix");
    } else {
      body.removeClass("header_fix");
    };

    $(window).scroll(function () {
      if (body.hasClass('show-horizontal')) return;

      if($(this).scrollTop() > header_message_height) {
        body.addClass("header_fix");
      } else {
        body.removeClass("header_fix");
      };
    });

  });

})(jQuery);