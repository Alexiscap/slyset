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

$(document).ready(function(){
//    Shadowbox.open({
////        content:    'application/views/lightbox/pi_ajout_concerts.php',
//        player:     "iframe",
//        height:     600,
//        width:      700
//    });
  
    if($("#shadowbox").length > 0){
        Shadowbox.init({
            skipSetup: true
        });

        $("#shadowbox").click(function(){
            Shadowbox.open({
                content: '#shadow',
                title: 'Ajouter un article',
                player: 'inline',
                width: 510,
                height: 475
            });
        });
    }
    
     $(".check_all").click(function(){
        var inputs = $("form input[type='checkbox']");

        for(var i = 0; i < inputs.length; i++){
            var type = inputs[i].getAttribute("type");
            if(type == "checkbox") {
                if(this.checked) {
                    inputs[i].checked = true;
                } else {
                    inputs[i].checked = false;
                }
            }
        }
    });
    
    //Utilisation du caroufredsel sur la page home
    if($("body.admin-articles").length > 0){
        $('#redactor').redactor();

        $('#articles-tab th.article-title, #articles-tab th.article-date').click(function(e){
            e.preventDefault();
            var valFilter = $(this).children().attr('id');
            var byFilter = $(this).children('span');
            var orderBy = 'desc';
            var lastSegment = location.href.split('/').pop();

            if(lastSegment == 'desc'){
                byFilter.removeClass().addClass('asc');
                orderBy = 'asc';
            } else if(lastSegment == 'asc'){
                byFilter.removeClass().addClass('desc');
                orderBy = 'desc';
            } else {
                byFilter.addClass('desc');
            }

//            var multiClass = byFilter.attr('class');
//            var arrayClass = multiClass.split(' ');

            var basePath = 'http://' + window.location.hostname + '/index.php/';
            location.href = basePath + 'admin_articles/index/' + valFilter + '/' + orderBy;
        });
          
        var pathname = window.location.hash;
        if(pathname.indexOf('#open') > -1){
            $('#wysiwyg-block').slideToggle('slow');
        }

         $('#wysiwyg-link').toggle(
            function (){
                event.preventDefault();
                window.location.hash = this.hash;
                $('#wysiwyg-block').slideToggle('slow');
            },
            function (){
                event.preventDefault();
                location.hash = 'close';
                $('#wysiwyg-block').slideToggle('slow');
            }
        );

        $('#articles-tab td .article-actions').hide();
        $('#articles-tab tr').hover(function() {
            $(this).find('.article-actions').show();
    //              $(this).find('.article-actions').stop().fadeIn();
        }, function(){
            $(this).find('.article-actions').hide();
    //              $(this).find('.article-actions').stop().fadeOut();
        });
        
        $('#articles-tab table tr:nth-child(even)').addClass('even row-color-1');
        $('#articles-tab table tr:nth-child(odd)').addClass('odd row-color-2');
    }
    
    
    
    
    $('.form_comments form').submit(function(){
        var baseurl = $(this).find("#baseurl").val();
        var usercomment = $(this).find("#usercomment").val();
        var messageid = $(this).find("#messageid").val();
        var thisParent = $(this).parent();
        var dataString = 'usercomment=' + usercomment + '&messageid=' + messageid;

        if(usercomment == '' || messageid == ''){
            alert('Veuillez renseigner un message !');
        } else {
            var ajaxLoader = $(this).parent().find(".ajax_loader");
            
            ajaxLoader.show();
            ajaxLoader.fadeIn(500).html('<img src="'+baseurl+'assets/images/common/ajax-loader.gif" />Loading Comment...');

            $(this).find("#usercomment").val("");
            
            $.ajax({
                type: "POST",
                url : baseurl + 'index.php/mc_actus/form_wall_user_comment/',
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
    
    
    //Commentaires photos
    $('.comment-form form').submit(function(){
        var baseurl = $(this).find("#baseurl").val();
        var comment = $(this).find("#usercomment").val();
        var messageid = $(this).find("#messageid").val();
        var thisParent = $(this).parent();
        var dataString = 'usercomment=' + usercomment + '&messageid=' + messageid;

        if(usercomment == '' || messageid == ''){
            alert('Veuillez renseigner un message !');
        } else {
            var ajaxLoader = $(this).parent().find(".ajax_loader");
            
            ajaxLoader.show();
            $.ajax({
                type: "POST",
                url : baseurl + 'index.php/mc_photos/form_photo_user_comment',
                data: dataString,
                success: function(comment){
                    $(comment).hide().insertBefore(thisParent).slideDown('slow');
                    ajaxLoader.fadeOut(1000);
                    $(".content").masonry('reload');
               }
            })
            return false;
        }
    });
    
    //Commentaires albums
    $('.comment-form-album form').submit(function(){
        var baseurl = $(this).find("#baseurl").val();
        var usercomment = $(this).find("#usercomment").val();
        var messageid = $(this).find("#messageid").val();
        var thisParent = $(this).parent();
        var dataString = 'usercomment=' + usercomment + '&messageid=' + messageid;

        if(usercomment == '' || messageid == ''){
            alert('Veuillez renseigner un message !');
        } else {
            var ajaxLoader = $(this).parent().find(".ajax_loader");
            ajaxLoader.show();
            
            $.ajax({
                type: "POST",
                url : baseurl + 'index.php/mc_photos/form_album_user_comment',
                data: dataString,
                success: function(comment){
                    $(comment).hide().insertBefore(thisParent).slideDown('slow');
                    ajaxLoader.fadeOut(1000);
                    $(".content").masonry( 'reload');
               }
            })
            return false;
        }
    });
    
    $('.comment-form-video form').submit(function(){
        var baseurl = $(this).find("#baseurl").val();
        var usercomment = $(this).find("#usercomment").val();
        var messageid = $(this).find("#messageid").val();
        var thisParent = $(this).parent();
        var dataString = 'usercomment=' + usercomment + '&messageid=' + messageid;

        if(usercomment == '' || messageid == ''){
            alert('Veuillez renseigner un message !');
        } else {
            var ajaxLoader = $(this).parent().find(".ajax_loader");
            ajaxLoader.show();
            
            $.ajax({
                type: "POST",
                url : baseurl + 'index.php/mc_photos/form_video_user_comment',
                data: dataString,
                success: function(comment){
                    $(comment).hide().insertBefore(thisParent).slideDown('slow');
                    ajaxLoader.fadeOut(1000);
                    $(".content").masonry( 'reload');
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
       //var baseurl = $(this).find("#baseurl").val();
        var baseurl = window.location.host;
  	    var id_photo = $(this).attr('id');
  	    var coeur = $(this);
       	var dataid = 'id_photo=' + id_photo;
        
        $.ajax({
            type: "POST",
            url : baseurl + '/add_like',
            data: dataid,
            success: function(jelike){
           	$(coeur).attr('src','../assets/images/musicien/pink_heart.png');

            }
        })
    });
    
    $('.nolike').click(function(){
        var baseurl = $(this).find("#baseurl").val();
  	    var id_photo = $(this).attr('id');
       	var dataid = 'id_photo=' + id_photo;
        
        $.ajax({
            type: "POST",
            url : baseurl + '/slyset/index.php/mc_photos/minus_like',
            data: dataid,
            success: function(jelike){
                alert('ok executé');
            }
        })
    });
    
    $('.like-album ').click(function(){
        var baseurl = $(this).find("#baseurl").val();
  	    var fn_album = $(this).attr('id');
       	var dataid = 'album_file_name=' + fn_album;
        
        $.ajax({
            type: "POST",
            url : baseurl + '/slyset/index.php/mc_photos/add_like_a',
            data: dataid,
            success: function(jelike){
                alert('ok executé');
            }
        })
    });
    
    $('.nolike-album').click(function(){
        var baseurl = $(this).find("#baseurl").val();
  	    var file_name_album = $(this).attr('id');
       	var dataid = 'file_name_album='+file_name_album;
        
        $.ajax({
            type: "POST",
            url : baseurl + '/slyset/index.php/mc_photos/minus_like_a',
            data: dataid,
            success: function(jelike){
                alert('ok executé');
            }
        })
    });
    
    $('.like-video').click(function(){
        var baseurl = $(this).find("#baseurl").val();
  	    var video_nom = $(this).attr('id');
       	var dataid = 'video_nom=' + video_nom;
        
        $.ajax({
            type: "POST",
            url : baseurl + '/slyset/index.php/mc_photos/add_like_v',
            data: dataid,
            success: function(jelike){
                alert('ok executé');
            }
        })
    });
    
    $('.nolike-video').click(function(){
        var baseurl = $(this).find("#baseurl").val();
        var video_nom = $(this).attr('id');
       	var dataid = 'video_nom=' + video_nom;
        
        $.ajax({
            type: "POST",
            url : baseurl + '/slyset/index.php/mc_photos/minus_like_v',
            data: dataid,
            success: function(jelike){
                alert('ok executé');
            }
        })
    });
    
    //assister a un concert
    $('.participer').click(function(){
        var baseurl = $(this).find("#baseurl").val();
        var id_concert = $(this).attr('id');
        var dataid = 'id_concert=' + id_concert;
        var divid = "#" + id_concert;
            
        $.ajax({
            type: "POST",
            url :'/slyset/index.php/mc_concerts/add_activity_concert',
            data: dataid,
          
            success: function(dataid){ //afficher le bon bouton
                var newe = '<a id=' + id_concert + ' href="#" class="noparticiper"><span class="button_left"></span><span  class="button_center">Je n\'y vais plus</span><span class="button_right"></span></a>';
                $('.participer').replaceWith(newe);
                $(newe).trigger('click');
            }
        })
        return false;
    });
      
    //Ne plus assister a un concert
    $('.noparticiper_melo').click(function(){
        var baseurl = $(this).find("#baseurl").val();
        var id_concert = $(this).attr('id');
        var dataid = 'id_concert=' + id_concert;
        var divid = "#" + id_concert;

        $.ajax({
            type: "POST",
            url :'/slyset/index.php/mc_concerts/delete_activity_concert',
            data: dataid,
            success: function(jego){ //afficher le bon bouton

              $('#concert_id_'+id_concert).slideUp();
            }
        })
        return false
    });
    
    
    
    // - my follower -
    // hover bouton
    $('.bouton .my-follow').hover(
    
	 function () {
		$(this).addClass('unfollow');
   		$(this).children('.button_center_abonne').text('Ne plus suivre');
   		$(this).children('.button_left_abonne').addClass('button_left')
   		$(this).children('.button_center_abonne').addClass('button_center')
   		$(this).children('.button_right_abonne').addClass('button_right')

  		},
  	
  	function () {
  		
   		$('.button_center_abonne').text('Abonné');
   		$(this).children('.button_left_abonne').removeClass('button_left')
   		$(this).children('.button_center_abonne').removeClass('button_center')
   		$(this).children('.button_right_abonne').removeClass('button_right')
  	}
   // $(this).replaceWith(one).show()},
    //function(){$(this).replaceWith(two).show()
    
    );
    
     $('.bouton .my-follow').click(function(){
     	var idwall_community = $(this).parents('.bouton').attr('id');
     	var datawall = 'idwall_community=' + idwall_community;

     	 $.ajax({
            type: "POST",
            url :'/slyset/index.php/melo_abonnements/delete_community_wall',
            data: datawall,
            success: function(){ //afficher le bon bouton
				$('#my-follower-melo-'+idwall_community).slideUp();
            }
        })
        return false
     });
    
    
    //Utilisation du caroufredsel sur la page home
    if($("body.home").length > 0){
        $("#coverflow").children().filter(":eq(1)").addClass('current-item');
        
        $("#coverflow").carouFredSel({
            item: 3,
            width: 770,
            height: 268,
            synchronise: true,
            scroll: {
              items: 1,
              fx: 'scroll',
              pauseOnHover: true,
              duration: 1000
            },
            pagination: "#pagination",
            prev:  {
                button: "#pagination-prev",
                onBefore: function(data){
                    var pos = $("#coverflow").triggerHandler("currentPosition");
                    $(this).children().removeClass('current-item');
                },
                onAfter: function(data){
                    var pos = $("#coverflow").triggerHandler("currentPosition");
                    $(this).children().filter(":eq(1)").addClass('current-item');
                }
            },
            next:  {
                button: "#pagination-next",
                onBefore: function(data){
                    var pos = $("#coverflow").triggerHandler("currentPosition");
//                    $(this).children('.current-item').delay(2000).css("marginTop","25px");
                    $(this).children().removeClass('current-item');
                },
                onAfter: function(data){
                    var pos = $("#coverflow").triggerHandler("currentPosition");
                    $(this).children().filter(":eq(1)").toggleClass('current-item');
//                    $(this).children('.current-item').delay(2000).css("marginTop","0");
                }
            },
            mousewheel: true,
            auto: {
                onBefore: function(data){
                    var pos = $("#coverflow").triggerHandler("currentPosition");
                    $(this).children().filter(":eq(1)").toggleClass('current-item');
                    $(this).children().removeClass('current-item');
                },
                onAfter: function(data){
                    var pos = $("#coverflow").triggerHandler("currentPosition");
                    $(this).children().filter(":eq(1)").toggleClass('current-item');
                }
            }
        });

//        highlight(unhighlight($("#coverflow2 > *")));
        
        $("#coverflow a").hover(
            function(){
                $(this).append('<div class="coverflow_player" style="display:none;"><span class="coverflow_player_btn"></span></div>').fadeIn('slow');
                $(this).find('.coverflow_player').fadeIn(250, function(){
                    $(this).show();
                });
            },
            function(){
                $(this).find('.coverflow_player').fadeOut(250, function(){
                    $(this).remove();
                });
            }
        );
    }

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

    //Modifie l'affichage des checkboxs pour le choix de thème perso
    $userType = $('.personnaliser #themes label');
    $userType.click(function(){
        $('.personnaliser #themes input:checkbox').attr('checked', false);
        $(this).prev('.personnaliser #themes input:checkbox').attr('checked', true);
    });

    //Modifie l'apparence des checkboxs
    $checkboxs = $('input:checkbox');
    $checkLabel = $('.checkbox-style label, .checkbox-style2 label');
    $checkLabel.prepend('<span/>');


    //Appel de la fonction masonry uniquement sur la page photos/vidéos
    if($("body.photos_videos").length > 0){
        playMasonry();
    }
    
    //Appel de la fonction
    if($("input[type=file]").length > 0){
        $(".upload-file-container").change(function(e){
            $in = $(this).find("input[type=file]");
            $(this).next(".upload_photo_name_file").html($in.val().replace(/C:\\fakepath\\/i, ''));
        });
    }
    
    //Appel de la fonction
    if($("body.musicien_actus").length > 0){
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
    
    if($("body.personnaliser").length > 0){
        $('#colorpickerField1').ColorPicker({
            onSubmit: function(hsb, hex, rgb, el) {
                $(el).val('#' + hex);
                $(el).ColorPickerHide();
                $('#colorpickerField1').prev().css('background','#' + hex);
            },
            onBeforeShow: function () {
               $(this).ColorPickerSetColor(this.value);
            },
            onChange: function(hsb, hex, rgb, el){
                $('#colorpickerField1').val('#' + hex);
                $("body").css("background",'#' + hex);
                $('#colorpickerField1').prev().css('background','#' + hex);
            }
        })
        .bind('keyup', function(){
            $(this).ColorPickerSetColor(this.value);
        });
        
        $('#colorpickerField2').ColorPicker({
            onSubmit: function(hsb, hex, rgb, el) {
                $(el).val('#' + hex);
                $(el).ColorPickerHide();
                $('#colorpickerField2').prev().css('background','#' + hex);
            },
            onBeforeShow: function () {
               $(this).ColorPickerSetColor(this.value);
            },
            onChange: function(hsb, hex, rgb, el){
                $('#colorpickerField2').val('#' + hex);
                $("aside#right").css("backgroundColor",'#' + hex);
                $('#colorpickerField2').prev().css('background','#' + hex);
            }
        })
        .bind('keyup', function(){
            $(this).ColorPickerSetColor(this.value);
        });
        
        $('#colorpickerField3').ColorPicker({
            onSubmit: function(hsb, hex, rgb, el) {
                $(el).val('#' + hex);
                $(el).ColorPickerHide();
                $('#colorpickerField3').prev().css('background','#' + hex);
            },
            onBeforeShow: function () {
               $(this).ColorPickerSetColor(this.value);
            },
            onChange: function(hsb, hex, rgb, el){
                $('#colorpickerField3').val('#' + hex);
                $(".content a").css("color",'#' + hex);
                $('#colorpickerField3').prev().css('background','#' + hex);
            }
        })
        .bind('keyup', function(){
            $(this).ColorPickerSetColor(this.value);
        });
        
        $('#colorpickerField4').ColorPicker({
            onSubmit: function(hsb, hex, rgb, el) {
                $(el).val('#' + hex);
                $(el).ColorPickerHide();
                $('#colorpickerField4').prev().css('background','#' + hex);
            },
            onBeforeShow: function () {
               $(this).ColorPickerSetColor(this.value);
            },
            onChange: function(hsb, hex, rgb, el){
                $('#colorpickerField4').val('#' + hex);
                $("p.head-title, p.head-title span").css("color",'#' + hex);
                $('#colorpickerField4').prev().css('background','#' + hex);
            }
        })
        .bind('keyup', function(){
            $(this).ColorPickerSetColor(this.value);
        });
    }
    
});

function bt_edit(){
    document.getElementById('select').getElementsByClassName('miniat_titre')[0].style.display="inline";
}

function cache_edit(){
    document.getElementById('select').getElementsByClassName('miniat_titre')[0].style.display="none";
}

function edit_photo(){
    document.getElementById('select').getElementsByClassName('edit')[0].style.visibility="visible";
    document.getElementById('select').getElementsByClassName('open_alb')[0].style.visibility="visible";
}

function cache_photo(){
		document.getElementById('select').getElementsByClassName('edit')[0].style.visibility="hidden";
    document.getElementById('select').getElementsByClassName('open_alb')[0].style.visibility="hidden";
}

function showComment(divid) {
    var divid = document.getElementById(divid);
    
    if(divid.style.display == 'none'){ 
        divid.style.display = 'block'; 
        $(".content").masonry('reload');

    } else { 
        divid.style.display = 'none';
        $(".content").masonry('reload');
    }
}
