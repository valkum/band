
(function ($) {

Drupal.behaviors.flux = {
  attach: function (context, settings) {
    //START
    $('#block-menu-menu-pushtape h2').click(function(){
      $('#block-menu-menu-pushtape ul.menu:first-child').toggleClass('expanded');
    });

    // Animate.
    var $html = $('html');
    var $doc = $(document);
    var $win = $(window);
    var docHeight = $doc.height();
    var winHeight = $(window).height();
    function updateBG() {
      var x = ($doc.scrollTop() / (docHeight - winHeight)) * 100;
      $html.css('background-position','50% '+ x +'%');
    }
    if((docHeight - winHeight) > 500) {
      $doc.scroll(function() {window.requestAnimationFrame(updateBG)});
    }//END
  }
};

}(jQuery));
