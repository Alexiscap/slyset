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

function highlight(items) {    
//    items.filter(":eq(1)").css({
//        paddingTop: 0,
//        width   : 238,
//        height  : 238,
//        display  : "block"
//    });
    
    items.filter(":eq(1)").animate({
        "paddingTop": "0",
        "width"   : "238",
        "height"  : "238",
        "display"  : "block",
        "opacity": "1",
        "filter": "alpha(opacity=100)"
    }, 500);
    
    $("#coverflow2 a").first().css("marginLeft", -5);
    return items;
}

function unhighlight(items) {
//    items.css({
//      paddingTop: 22,
//      marginLeft: 10,
//      width   : 188,
//      height  : 188,
//      display  : "block"
//    });
    
    items.animate({
        "paddingTop": "22",
        "marginLeft": "10",
        "width"   : "188",
        "height"  : "188",
        "display"  : "block",
        "opacity": "0.6",
        "filter": "alpha(opacity=60)",
        "box-shadow": "0 0 7px 3px #2B2B2B"
    }, 500);
    
    return items;
}

$(document).ready(function() {

    //Utilisation du caroufredsel sur la page home
    if($("body.home").length > 0){
        $("#coverflow2").carouFredSel({
            item: 3,
            width: 770,
            height: 268,
            scroll: {
              items: 1,
              fx: 'scroll',
              pauseOnHover: true,
              duration: 1500
            },
            pagination: "#pagination",
            prev: "#pagination-prev",
            next: "#pagination-next",
            mousewheel: true,
            auto: {
                onBefore: function(data) {
                    unhighlight(data.items.old);
                },
                onAfter: function(data) {
                    highlight(data.items.visible);
                }
            }
        });

        highlight(unhighlight($("#coverflow2 > *")));
        
        $("#coverflow2 a").hover(
            function(){
                $(this).append('<span class="coverflow_player"></span>');
                
                //$('.coverflow_player').css("top", $(this).find('.coverflow-img').height("-=60"));
//                alert($(this).height());
//                alert($(this).height() + ' + ' + $(this).height("-=60"));
            },
            function(){
                $('.coverflow_player').remove();
            }
        );
    }

//      $("#coverflow2 a:nth-child(2)").addClass("testt");
//    $("#coverflow2 a + a").css("width","300");
//    $("#coverflow2 a + a img").css("width","300");

//      var items = $("#coverflow2").triggerHandler("currentVisible");
//      items.addClass("foo");
//      if ( items ) {
//          items.addClass("foo");
//      } else {
//          items.removeClass("foo");
//      }
//
//      
//      var scrolling = $("#coverflow2").triggerHandler("isScrolling");
//      if ( scrolling ) {
//          $("#coverflow2").addClass( "scrolling" );
//      } else {
//          $("#coverflow2").removeClass("scrolling");
//      }


    //Uniformise les placeholder pour tous les navigateurs
    $("input[placeholder], textarea[placeholder]").each(function(){
        $("input[placeholder]").placeHeld();
    });

    //Modifie l'affichage des checkboxs pour le choix de compte à l'inscription
    $userType = $('.step-form #type-user label');
    $userType.click(function(){
        $('.step-form #type-user input:checkbox').attr('checked', false);
        $(this).prev('.step-form #type-user input:checkbox').attr('checked', true);
    });

    //Modifie l'apparence des checkboxs
    $checkboxs = $('input:checkbox');
    $checkLabel = $('.checkbox-style label');
    $checkLabel.prepend('<span/>');


    //Appel de la fonction masonry uniquement sur la page photos/vidéos
    if($("body.photos_videos").length > 0){
        playMasonry();
    }
    
});