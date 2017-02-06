jQuery(document).ready(function($){
  
  var mn = $(".site-header");
      mns = "shrink";
      hdr = $('.site-header').height()-10;

  $(window).scroll(function() {
    if( $(this).scrollTop() > hdr ) {
      mn.addClass(mns);
    } else {
      mn.removeClass(mns);
    }
  });
});