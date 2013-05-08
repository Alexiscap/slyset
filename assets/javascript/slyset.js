function playMasonry(){
  $container = $('.content');

  $container.imagesLoaded(function(){
    $container.masonry({
      itemSelector: '.box'
      //columnWidth : 100,
      //isFitWidth: true,
      //isAnimated:true
    });
  });
}

$(document).ready(function() {
  
  //Uniformise les placeholder pour tous les navigateurs
  $("input[placeholder], textarea[placeholder]").each(function(){
    $("input[placeholder]").placeHeld();
  });
  
  //Modifie l'affichage des checkboxs pour le choix de compte à l'inscription
  $userType = $('.step-form #type-user label');
  $userType.click(function(){
    $('.step-form #type-user input:checkbox').attr('checked', false);
    $(this).prev('.step-form #type-user input:checkbox').attr('checked', true);
  })
  
  //Modifie l'apparence des checkboxs
  $checkboxs = $('input:checkbox');
  $checkLabel = $('.checkbox-style label');
  $checkLabel.prepend('<span/>');
  
  
  //Appel de la fonction masonry uniquement sur la page photos/vidéos
  if($("body.photos_videos").length > 0){
    playMasonry();
  }
    
});