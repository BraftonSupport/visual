jQuery(document).ready(function($){

  // making sure the navigation works on the home page as well as on the blog pages
  $( '.home .main-navigation a' ).each(function(){
    var string = $(this).attr('href');
    string=string.replace(/http.+?(?=#)/g, '');
    $(this).attr('href', string);
  })

  // back to top button
  $(window).scroll(function() {
    if( $(this).scrollTop() > 250 ) {
      $('#scrollTopbutton').show();
    } else {
      $('#scrollTopbutton').hide();
    }
  });

  // smooth scroll
  $('a[href*="#"]:not([href="#"])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html, body').animate({
          scrollTop: (target.offset().top)-125
        }, 1000);
        return false;
      }
    }
  });

  // Homepage team image border color the same as the background
  var bg = $( ".teammiddle" ).parents(".background").css('background-color');
  if (bg == 'rgba(0, 0, 0, 0)' ){
  bg='#f0f0f0';
  }
  $( ".teammiddle img" ).css("border-color", bg);

  $(".fa-spinner").fadeTo( 0, 1 ).delay(150).fadeTo( "fast", 0 );
  $( ".team .container:first-of-type").removeClass('hide');

  $( ".team .container:not(:first-of-type) .previous.button" ).click( function() {
    $(".fa-spinner").fadeTo( 0, 1 ).delay(150).fadeTo( "fast", 0 );
    $(this).parents(".container").addClass('hide');
    $(this).parents(".container").prev().removeClass('hide');
  });

  $( ".team .container:not(:last-of-type) .next.button" ).click( function() {
    $(".fa-spinner").fadeTo( 0, 1 ).delay(150).fadeTo( "fast", 0 );
    $(this).parents(".container").addClass('hide');
    $(this).parents(".container").next().removeClass('hide');
  });

  $('.main-navigation a').click(function() {
    $('#menu-toggle').trigger('click');
  });

  // Toggle search in header

  $('.header-right a.button').click(function() {
    $('#header-search-form').fadeToggle();
  });

});