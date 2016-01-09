function resizeEvent(){
  var unslider = null;
  var homeUnslide = null;

  var unslider = jQuery('.homeQuotes').unslider({
                    speed: 750
                 });
  jQuery('.unslider-arrow').click(function() {
      var fn = this.className.split(' ')[1];
      unslider.data('unslider')[fn]();
  });

  var homeUnslide = jQuery('.heroSlider').unslider({
                      dots: true
                    });

  //Our team tabs
  jQuery('.tabNav a').click(function(e){
    e.preventDefault();

    jQuery('.tabNav a').removeClass('active');
    jQuery('.tab_panel').removeClass('open');

    jQuery(this).addClass('active');
    var target = jQuery(this).attr('href');
    jQuery(target).addClass('open');
  });
}

jQuery(document).ready(function(){
  //INIT on page load
  resizeEvent();

  //Remove link from first level breadcrumbs
  jQuery('.speedBar').find('.cat_post').first().attr('href', '');

  //trucation
  var maxHeight = 0,
      $quotes = jQuery('.homeQuotes li');

  $quotes.each(function(){
    var itemHeight = jQuery(this).height();
    if(itemHeight > maxHeight){
      maxHeight = itemHeight;
    }
  });

  $quotes.css({'height': maxHeight});

  //add placeholder to get thebuzz section
  jQuery('#simpleCC_fname').attr("placeholder","First Name");
  jQuery('#simpleCC_lname').attr("placeholder","Last Name");
  jQuery('#simpleCC_email').attr("placeholder","Email");
});

//Re init sliders when page is resized
window.onresize = function(event) {
  resizeEvent();
};
