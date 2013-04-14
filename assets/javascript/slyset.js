$(document).ready(function() {
  
  var $container = $('.content');
  $container.imagesLoaded(function(){
    $container.masonry({
      itemSelector: '.box'
//      columnWidth : 100,
//      isFitWidth: true,
//      isAnimated:true
    });
  });

});