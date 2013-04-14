$(document).ready(function() {
  
  var $container = $('#col_mil');
  $container.imagesLoaded(function(){
    $container.masonry({
      itemSelector: '.box',
//      columnWidth : 100,
//      isFitWidth: true,
//      isAnimated:true
    });
  });

});