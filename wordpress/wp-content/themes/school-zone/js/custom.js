jQuery(document).ready(function($) {
    /** Header Search form show/hide */
    $('html').click(function() {
        $('.example').slideUp();
    });

    $('.site-header .form-section').click(function(event) {
        event.stopPropagation();
    });

    $("#search-btn").click(function() {
        $(".example").slideToggle();
        return false;
    });

    //accessibility menu
    $("#top-navigation ul li a").focus(function(){
       $(this).parents("li").addClass("focus");
   }).blur(function(){
       $(this).parents("li").removeClass("focus");
   });
});
