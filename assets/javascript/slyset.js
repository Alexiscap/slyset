$(document).ready(function() {
  
  $("input[placeholder]").placeHeld();
  
  $userType = $('.step-form #type-user label');
  $userType.click(function(){
    $('.step-form #type-user input:checkbox').attr('checked', false);
    $(this).prev('.step-form #type-user input:checkbox').attr('checked', true);
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