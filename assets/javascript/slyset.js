$(document).ready(function() {
  
  $("input[placeholder]").placeHeld();
  
  $userType = $('.step-form label');
  $userType.click(function(){
    $('input:checkbox').attr('checked', false);
    $(this).prev('input:checkbox').attr('checked', true);
  })
  
  $container = $('.content');
  $container.imagesLoaded(function(){
    $container.masonry({
      itemSelector: '.box'
//      columnWidth : 100,
//      isFitWidth: true,
//      isAnimated:true
    });
  });

});