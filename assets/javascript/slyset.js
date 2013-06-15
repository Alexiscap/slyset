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

$(document).ready(function(){
  
    var baseurl = $('#baseurl').val();
    $('.form_comments form').submit(function(){
//        dataString2 = $(this).serialize();
//         alert(dataString2);
//        $.ajax({
//            url : baseurl + 'index.php/mc_actus/form_wall_user_comment',
//            data : $('.form_comments form').serialize(),
//            type: "POST",
//            success : function(usercomment){
//                alert($('form').serialize());
//                alert(usercomment);
//                $(usercomment).hide().insertBefore('#insertbeforMe').slideDown('slow');
//            }
//        })

        var usercomment = $(this).find("#usercomment").val();
        var messageid = $(this).find("#messageid").val();
        var thisParent = $(this).parent();
        var dataString = 'usercomment='+usercomment+'&messageid='+messageid;
    //            var dataString = 'usercomment='+usercomment;

        if(usercomment == '' || messageid == ''){
            alert('Veuillez renseigner un message !');
        } else {
            var ajaxLoader = $(this).parent().find(".ajax_loader");
            
            ajaxLoader.show();
            ajaxLoader.fadeIn(500).html('<img src="'+baseurl+'assets/images/common/ajax-loader.gif" />Loading Comment...');

            $.ajax({
                type: "POST",
                url : baseurl + 'index.php/mc_actus/form_wall_user_comment',
                data: dataString,

                success: function(comment){
                    $(comment).hide().insertBefore(thisParent).slideDown('slow');
                    ajaxLoader.fadeOut(1000);
//                    ajaxLoader.hide();
               }
            })
            return false;
        }
    });
    
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
              duration: 1000
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

//    $("#coverflow2 a:nth-child(2)").addClass("testt");
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
    
    
    //Appel de la fonction
    if($("body.musicien_actus").length > 0){
        $('input[type=file]').change(function(e){
            $in = $(this);
            $(".upload_photo_name_file").html($in.val().replace(/C:\\fakepath\\/i, ''));
        });
      
        $(".actus_post .actus_post_links a").click(function(e){
            var cls = $(this).attr('href').replace('#', '');
            var desact =  $(".actus_post .actus_post_links").find('.active').removeClass('active')
            var act =$(this).addClass("active");
            
            location.hash = cls;
            
            var newForm = location.hash;
            $(".actus_post form").css("display","none");
//            $(newForm).css("display","block");
            $(newForm).slideToggle('slow', "swing");
            
            window.location.hash = "";
            e.preventDefault();
        });
    }
    
});




 
$(document).ready(function(){
  
    var baseurl = $('#baseurl').val();
    //commentaire photo
    $('.comment-form form').submit(function(){
//        dataString2 = $(this).serialize();
//         alert(dataString2);
//        $.ajax({
//            url : baseurl + 'index.php/mc_actus/form_wall_user_comment',
//            data : $('.form_comments form').serialize(),
//            type: "POST",
//            success : function(usercomment){
//                alert($('form').serialize());
//                alert(usercomment);
//                $(usercomment).hide().insertBefore('#insertbeforMe').slideDown('slow');
//            }
//        })

        var usercomment = $(this).find("#usercomment").val();
        var messageid = $(this).find("#messageid").val();
        var thisParent = $(this).parent();
        var dataString = 'usercomment='+usercomment+'&messageid='+messageid;
    //            var dataString = 'usercomment='+usercomment;

        if(usercomment == '' || messageid == ''){
            alert('Veuillez renseigner un message !');
        } else {
            var ajaxLoader = $(this).parent().find(".ajax_loader");
            
            ajaxLoader.show();
          //  ajaxLoader.fadeIn(500).html('<img src="'+baseurl+'assets/images/common/ajax-loader.gif" />Loading Comment...');
            $.ajax({

                type: "POST",
                url : baseurl + 'index.php/mc_photos/form_photo_user_comment',
                data: dataString,

                success: function(comment){
                    $(comment).hide().insertBefore(thisParent).slideDown('slow');
                    ajaxLoader.fadeOut(1000);
                    jQuery(".content").masonry( 'reload' );

//                    ajaxLoader.hide();
               }
            })
            return false;
        }
    });
    //commentaire album
    $('.comment-form-album form').submit(function(){
//        dataString2 = $(this).serialize();
//         alert(dataString2);
//        $.ajax({
//            url : baseurl + 'index.php/mc_actus/form_wall_user_comment',
//            data : $('.form_comments form').serialize(),
//            type: "POST",
//            success : function(usercomment){
//                alert($('form').serialize());
//                alert(usercomment);
//                $(usercomment).hide().insertBefore('#insertbeforMe').slideDown('slow');
//            }
//        })

        var usercomment = $(this).find("#usercomment").val();
        var messageid = $(this).find("#messageid").val();
        var thisParent = $(this).parent();
        var dataString = 'usercomment='+usercomment+'&messageid='+messageid;
    //            var dataString = 'usercomment='+usercomment;

        if(usercomment == '' || messageid == ''){
            alert('Veuillez renseigner un message !');
        } else {
            var ajaxLoader = $(this).parent().find(".ajax_loader");
            
            ajaxLoader.show();
          //  ajaxLoader.fadeIn(500).html('<img src="'+baseurl+'assets/images/common/ajax-loader.gif" />Loading Comment...');
            $.ajax({

                type: "POST",
                url : baseurl + 'index.php/mc_photos/form_album_user_comment',
                data: dataString,

                success: function(comment){
                    $(comment).hide().insertBefore(thisParent).slideDown('slow');
                    ajaxLoader.fadeOut(1000);
                    jQuery(".content").masonry( 'reload' );

//                    ajaxLoader.hide();
               }
            })
            return false;
        }
    });
      $('.comment-form-video form').submit(function(){

        var usercomment = $(this).find("#usercomment").val();
        var messageid = $(this).find("#messageid").val();
        var thisParent = $(this).parent();
        var dataString = 'usercomment='+usercomment+'&messageid='+messageid;
    //            var dataString = 'usercomment='+usercomment;

        if(usercomment == '' || messageid == ''){
            alert('Veuillez renseigner un message !');
        } else {
            var ajaxLoader = $(this).parent().find(".ajax_loader");
            
            ajaxLoader.show();
          //  ajaxLoader.fadeIn(500).html('<img src="'+baseurl+'assets/images/common/ajax-loader.gif" />Loading Comment...');
            $.ajax({

                type: "POST",
                url : baseurl + 'index.php/mc_photos/form_video_user_comment',
                data: dataString,

                success: function(comment){
                    $(comment).hide().insertBefore(thisParent).slideDown('slow');
                    ajaxLoader.fadeOut(1000);
                    jQuery(".content").masonry( 'reload' );

//                    ajaxLoader.hide();
               }
            })
            return false;
        }
    });
    //like photo
    //1 incrementer de 1
    // select du login connecté
    // changement classe du couer pour rose !
  	$('.like').click(function(){
  	    var id_photo = $(this).attr('id');
       	var dataid = 'id_photo='+id_photo;
            $.ajax({

                type: "POST",
                url : 'http://127.0.0.1/slyset/index.php/mc_photos/add_like',
                data: dataid,
                success: function(jelike){
                
              alert('ok executé')
                   
                    }

           
            })
    });
    $('.nolike').click(function(){
  	    var id_photo = $(this).attr('id');
       	var dataid = 'id_photo='+id_photo;
            $.ajax({

                type: "POST",
                url : 'http://127.0.0.1/slyset/index.php/mc_photos/minus_like',
                data: dataid,
                success: function(jelike){
                
              alert('ok executé')
                   
                    }

           
            })
    });
    $('.like-album ').click(function(){
  	    var fn_album = $(this).attr('id');
       	var dataid = 'album_file_name='+fn_album;
            $.ajax({
            

                type: "POST",
                url : 'http://127.0.0.1/slyset/index.php/mc_photos/add_like_a',
                data: dataid,
                success: function(jelike){
                
              alert('ok executé')
                   
                    }

           
            })
    });
    $('.nolike-album').click(function(){
  	    var file_name_album = $(this).attr('id');
       	var dataid = 'file_name_album='+file_name_album;
            $.ajax({

                type: "POST",
                url : 'http://127.0.0.1/slyset/index.php/mc_photos/minus_like_a',
                data: dataid,
                success: function(jelike){
                
              alert('ok executé')
                   
                    }

           
            })
    });
    $('.like-video ').click(function(){
  	    var video_nom = $(this).attr('id');
       	var dataid = 'video_nom='+video_nom;
            $.ajax({
            

                type: "POST",
                url : 'http://127.0.0.1/slyset/index.php/mc_photos/add_like_v',
                data: dataid,
                success: function(jelike){
                
              alert('ok executé')
                   
                    }

           
            })
    });
    $('.nolike-video').click(function(){
  	    var video_nom = $(this).attr('id');
       	var dataid = 'video_nom='+video_nom;
            $.ajax({

                type: "POST",
                url : 'http://127.0.0.1/slyset/index.php/mc_photos/minus_like_v',
                data: dataid,
                success: function(jelike){
                
              alert('ok executé')
                   
                    }

           
            })
    });
    //assister a un concert
     $('.participer').click(function(){

    	var id_concert = $(this).attr('id');
    	var dataid = 'id_concert='+id_concert;
		var divid = "#"+id_concert;
            $.ajax({

                type: "POST",
                url : 'http://127.0.0.1/slyset/index.php/mc_concerts/add_activity_concert',
                data: dataid,
                //afficher le bon bouton
                success: function(dataid){
                var newe = '<a id='+id_concert+' href="#" class="noparticiper"><span class="button_left"></span><span  class="button_center">Je n\'y vais plus</span><span class="button_right"></span></a>';
                $('.participer').replaceWith(newe);
				$(newe).trigger('click');

				//$('<a id='+id_concert+' href="#" class="noparticiper"><span class="button_left"></span><span  class="button_center">Je n\'y vais plus</span><span class="button_right"></span></a>').click(go));
            //   $( '<a id='+id_concert+'href="#" class="participer"><span class="button_left"></span><span  class="button_center">J\'y vais</span><span class="button_right"></span></a>' ).appendTo( "#concert_activity" );
              
              /*  $(this).hide();*/
				//$('.content').append('<a id="'+id_concert+' href="#" class="noparticiper"><span class="button_left"></span><span  class="button_center">Je ny vais plus</span><span class="button_right"></span></a>');

               // $('#'+id_concert+'.noparticiper').toggle();
                   
                    }

           
            })
          return false;

        
    });
    //ne plus assister a un concert
       $('.noparticiper').click(function(){

    	var id_concert = $(this).attr('id');
    	var dataid = 'id_concert='+id_concert;
		var divid = "#"+id_concert;
            $.ajax({

                type: "POST",
                url : 'http://127.0.0.1/slyset/index.php/mc_concerts/delete_activity_concert',
                data: dataid,
                //afficher le bon bouton
                success: function(jego){
                
                $('.noparticiper').replaceWith('<a id='+id_concert+' href="#" class="participer"><span class="button_left"></span><span  class="button_center">J\'y vais</span><span class="button_right"></span></a>');

                   
                    }

           
            })
        return false
    });
    /*
   $('.img_cover').live({
        mouseenter:
           function()
           {
            $(this).siblings('.edit').toggle();
			//$(".edit").show();
           },
        mouseleave:
           function()
           {

           }
       
		
	})*/
    


});



function showComment(divid) {
  var divid = document.getElementById(divid); 
  if(divid.style.display=='none') { 
    divid.style.display = 'block'; 
	jQuery(".content").masonry( 'reload' );

  } else { 
    divid.style.display = 'none';
    jQuery(".content").masonry( 'reload' );

  }
}





