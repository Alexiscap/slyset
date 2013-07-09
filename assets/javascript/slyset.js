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
    var l = window.location;
    var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];

    $('.head_menu').click(function(){
        //$('.head_menu').next('.first-row').slideUp()
        if($(this).next('.one').is(":visible")==true)
        {
            $(this).next('.one').hide()
        }
        else
        {
            $(this).next('.one').show()

        }
    //$(this).next('.one:hidden').show()

    })
    $("select").change(function () {
        $("select option:selected")
        var str = "";
        var id_album = $("select option:selected").attr('class');
        var dataid = 'id_album=' + id_album;
        	var l = window.location;
			var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
        
        $.ajax({
            type: "POST",
            url : base_url +'/index.php/pi_ajout_paroles/get_morceaux',
            data: dataid,
            success: function(datas){
                $('.mor').remove();
                $(datas).show().insertAfter('select').slideDown('slow');
        	
            }
        })
       
    })

    if($('#tablesorter-cb').length > 0){
        $('#tablesorter-cb').tablesorter({
            theme: 'blue',
            widgets: ['zebra'],
            headers:{
                0:{
                    sorter:false
                }
            },
            cssAsc:	"headerSortUp",
            cssDesc: "headerSortDown"
        });
    }
    if($('#tablesorter-nocb').length > 0){
        $('#tablesorter-nocb').tablesorter();; 
    }

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
    
    //Ajoute la classe active au menu selon l'onflet choisi
    //    $("#menu-account li a, #menu-profile li a").click(function(){
    //        $(".active").removeClass("active");
    //        $(this).addClass("active");
    //    });
        
    //Utilisation du caroufredsel sur la page home
    if($("body.admin-articles").length > 0){
        $('#redactor').redactor({
            imageUpload: '/admin_articles/uploadImg'
        });

        

        //        $('#articles-tab th.article-title, #articles-tab th.article-date').click(function(e){
        //            e.preventDefault();
        //            var valFilter = $(this).children().attr('id');
        //            var byFilter = $(this).children('span');
        //            var orderBy = 'desc';
        //            var lastSegment = location.href.split('/').pop();
        //
        //            if(lastSegment == 'desc'){
        //                byFilter.removeClass().addClass('asc');
        //                orderBy = 'asc';
        //            } else if(lastSegment == 'asc'){
        //                byFilter.removeClass().addClass('desc');
        //                orderBy = 'desc';
        //            } else {
        //                byFilter.addClass('desc');
        //            }
        //            var basePath = 'http://' + window.location.hostname + '/index.php/';
        //            location.href = basePath + 'admin_articles/index/' + valFilter + '/' + orderBy;
        //        });
          
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
        
    }
    $('#tablesorter tbody tr').live('click', function () {               
        if ($(this).hasClass('even')) {
            $(this).removeClass('even');
            $(this).addClass('ui-selected');
        }
        else if ($(this).hasClass('odd')) {
            $(this).removeClass('odd');
            $(this).addClass('ui-selected');
        }
        else {
            $(this).removeClass('ui-selected');
            $("#tablesorter").trigger("update");
            $("#tablesorter").trigger("applyWidgets");                         
        }
    });
    //    $('#articles-tab table tr:nth-child(even), #comptes-tab table tr:nth-child(even), #results-tab table tr:nth-child(even)').addClass('even row-color-1');
    //    $('#articles-tab table tr:nth-child(odd), #comptes-tab table tr:nth-child(odd), #results-tab table tr:nth-child(odd)').addClass('odd row-color-2');
    
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
        var dataString = 'usercomment=' + comment + '&messageid=' + messageid;
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
    
    
    $('.ajout_comm form').submit(function(e){
	
  
        var baseurl = $(this).find("#baseurl").val();
        var comment = $(this).find("#usercomment").val();
        var messageid = $(this).find("#messageid").val();
        var thisParent = $(this).parent();
        var dataString = 'usercomment=' + comment + '&messageid=' + messageid;
        if(usercomment == '' || messageid == ''){
            alert('Veuillez renseigner un message !');
        } else {
            var ajaxLoader = $(this).parent().find(".ajax_loader");
           	var l = window.location;
			var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
        
            $.ajax({
                type: "POST",
                url :base_url + '/index.php/mc_photos/form_photo_user_comment',
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
    
    $('.like').live('click',function(){
        //var baseurl = $(this).find("#baseurl").val();
        var baseurl = window.location.host;
        var id_photo = $(this).attr('id');
        var coeur = $(this);
        var dataid = 'id_photo=' + id_photo;
        	var l = window.location;
			var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
        
        $.ajax({
            type: "POST",
            url : base_url + '/index.php/mc_photos/add_like',
            data: dataid,
            success: function(jelike){
                $(coeur).attr('src',base_url  + '/assets/images/musicien/pink_heart.png');
                $(coeur).next().text(parseInt($(coeur).next().text()) + 1);
                $(coeur).addClass('nolike');
                $(coeur).removeClass('like');
        	
            }
        })
    });
    
    $('.nolike').live('click',function(){
        var coeur = $(this);
        var baseurl = $(this).find("#baseurl").val();
        var id_photo = $(this).attr('id');
        var dataid = 'id_photo=' + id_photo;
        	var l = window.location;
			var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
        
        $.ajax({
            type: "POST",
            url : base_url + '/index.php/mc_photos/minus_like',
            data: dataid,
            success: function(jelike){
                $(coeur).attr('src',base_url + '/assets/images/musicien/icon_coeur.png');
                $(coeur).addClass('like');
                $(coeur).next().text(parseInt($(coeur).next().text()) - 1);
                $(coeur).removeClass('nolike');

            }
        })
    });
    
    $('.like-album').live('click',function(){
        var coeur = $(this);

        var baseurl = $(this).find("#baseurl").val();
        var fn_album = $(this).attr('id');
        var dataid = 'album_file_name=' + fn_album;
        	var l = window.location;
			var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
        
        $.ajax({
            type: "POST",
            url :  base_url + '/index.php/mc_photos/add_like_a',
            data: dataid,
            success: function(jelike){
                $(coeur).attr('src',base_url + '/assets/images/musicien/pink_heart.png');
                $(coeur).next().text(parseInt($(coeur).next().text()) + 1);
                $(coeur).addClass('nolike-album');
                $(coeur).removeClass('like-album');
            }
        })
    });
    
    $('.nolike-album').live('click',function(){
        var coeur = $(this);

        var baseurl = $(this).find("#baseurl").val();
        var file_name_album = $(this).attr('id');
        var dataid = 'file_name_album='+file_name_album;
        	var l = window.location;
			var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
        
        $.ajax({
            type: "POST",
            url : base_url + '/index.php/mc_photos/minus_like_a',
            data: dataid,
            success: function(jelike){
                $(coeur).attr('src',base_url + '/assets/images/musicien/icon_coeur.png');
          
                $(coeur).next().text(parseInt($(coeur).next().text()) - 1);
                $(coeur).addClass('like-album');
                $(coeur).removeClass('nolike-album');
            }
        })
    });
    
    $('.like-video').live('click',function(){
        var coeur = $(this);

        var baseurl = $(this).find("#baseurl").val();
        var video_nom = $(this).attr('id');
        var dataid = 'video_nom=' + video_nom;
        	var l = window.location;
			var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
        
        $.ajax({
            type: "POST",
            url : base_url + '/index.php/mc_photos/add_like_v',
            data: dataid,
            success: function(jelike){
                $(coeur).attr('src',base_url + '/assets/images/musicien/pink_heart.png');
                $(coeur).next().text(parseInt($(coeur).next().text()) + 1);
                $(coeur).addClass('nolike-video');
                $(coeur).removeClass('like-video');
            }
        })
    });
    
    $('.nolike-video').live('click',function(){
        var coeur = $(this);

        var baseurl = $(this).find("#baseurl").val();
        var video_nom = $(this).attr('id');
        var dataid = 'video_nom=' + video_nom;
        	var l = window.location;
			var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
        
        $.ajax({
            type: "POST",
            url : base_url + '/index.php/mc_photos/minus_like_v',
            data: dataid,
            success: function(jelike){
                $(coeur).attr('src',base_url + '/assets/images/musicien/icon_coeur.png');
          
                $(coeur).next().text(parseInt($(coeur).next().text()) - 1);
                $(coeur).addClass('like-video');
                $(coeur).removeClass('nolike-video');
            }
        })
    });
 
    $('.photo.box.col1').hover(
        function(){
    
            $(this).children('.edit').show();
        },
        function(){
            $(this).children('.edit').hide();
        }
        );
    

      
    //Ne plus assister a un concert
    $('.noparticiper_melo').click(function(){
        var baseurl = $(this).find("#baseurl").val();
        var id_concert = $(this).attr('id');
        var dataid = 'id_concert=' + id_concert;
        var divid = "#" + id_concert;
	var l = window.location;
			var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
        
        $.ajax({
            type: "POST",
            url :base_url + '/index.php/mc_concerts/delete_activity_concert',
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
    
    if($('body.abonnements').length>0)
    {
        $('.bouton .participer').click(function(){
            var a = $(this);
            var idwall_community = $(this).parents('.bouton').attr('id');
            var datawall = 'idwall_community=' + idwall_community;
			var l = window.location;
			var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
            $.ajax({
                type: "POST",
                url :base_url+'/index.php/melo_abonnements/delete_community_wall',
                data: datawall,
                success: function(){ //afficher le bon bouton
                    $(a).parents('.follower').slideUp();
                }
            })
            return false
        });
    }	
	
	
    if($('body.followers').length>0)
    {

        /*$('.bouton .participer').hover(
    
			 function () {
				$(this).addClass('unfollow');
   				$(this).children('.button_center').text('Ne plus suivre');
   				$(this).children('.button_left').addClass('button_left_abonne')
   				$(this).children('.button_center').addClass('button_center_abonne')
   				$(this).children('.button_right').addClass('button_right_abonne')

  			},
  	
  			function () {
  		
   				$('.button_center_abonne').text('Abonné');
   				$(this).children('.button_left').removeClass('button_left_abonne')
   				$(this).children('.button_center').removeClass('button_center_abonne')
   				$(this).children('.button_right').removeClass('button_right_abonne')
  			}
	
		);*/
		
        $('.bouton .follow_following').live('click',function(){
		
            var button = $(this);
            var id_user = $(this).attr('id');
            var dataid = 'id_user=' + id_user;
	var l = window.location;
			var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
        
            $.ajax({
                type: "POST",
                url : base_url + '/index.php/mc_followers/add_follow',
                data: dataid,
                success: function(){ //afficher le bon bouton

                    $(button).children('.button_left_red').addClass('button_left');	
                    $(button).addClass('participer');		
	
                    $(button).children('.button_center_red').addClass('button_center');
                    $(button).children('.button_right_red').addClass('button_right'); 
                    $(button).children('.button_center_red').text('Abonné');
  
                    $(button).children('.button_left_red').removeClass('button_left_red');		
                    $(button).children('.button_center_red').removeClass('button_center_red');
                    $(button).children('.button_right_red').removeClass('button_right_red');
   				

                    $(button).removeClass('follow_following');		

                //	$(button).trigger('mouseenter');
                //		$(button).trigger('mouseleave');
                }
            })
            return false
        });
		
		
	
        $('.bouton .participer').live({
            click: function(){
                //alert('ok');  
                // $(this).children('.button_left').addClass('button_left_red')
                $(this).children('.button_center').text('Suivre');

 		  
                $(this).children('.button_left.button_left_abonne').addClass('button_left_red')
                $(this).children('.button_left.button_left_abonne').removeClass('button_left_abonne')
                $(this).children('.button_left').removeClass('button_left')

                $(this).children('.button_center.button_center_abonne').addClass('button_center_red')
                $(this).children('.button_center.button_center_abonne').removeClass('button_center_abonne')
                $(this).children('.button_center').removeClass('button_center')

                $(this).children('.button_right.button_right_abonne').addClass('button_right_red')
                $(this).children('.button_right.button_right_abonne').removeClass('button_right_abonne')
                $(this).children('.button_right').removeClass('button_right')

                $(this).addClass('follow_following');		
                $(this).removeClass('participer');		


                var button = $(this);
                var id_user = $(this).attr('id');
                var dataid = 'id_user=' + id_user;
	var l = window.location;
			var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
        
                $.ajax({
                    type: "POST",
                    url : base_url + '/index.php/mc_followers/delete_follow',
                    data: dataid,
                    success: function(){ //afficher le bon bouton

                        $(button).children('.button_left_abonne').addClass('button_left');	
	
                        $(button).children('.button_center_abonne').addClass('button_center');
                        $(button).children('.button_right_abonne').addClass('button_right'); 
                        $(button).children('.button_center').text('Suivre');
  
                        $(button).children('.button_left_abonne').removeClass('button_left_abonne');		
                        $(button).children('.button_center_abonne').removeClass('button_center_abonne');
                        $(button).children('.button_right_abonne').removeClass('button_right_abonne');
                    }
                })
                return false
            },
  		
            mouseenter:  function () {
                $(this).children('.button_center').text('Ne plus suivre');
                $(this).children('.button_left').addClass('button_left_abonne')
                $(this).children('.button_center').addClass('button_center_abonne')
                $(this).children('.button_right').addClass('button_right_abonne')

            },
  	
            mouseleave:	function () {
  		
                $('.button_center_abonne').text('Abonné');
                $(this).children('.button_left').removeClass('button_left_abonne')
                $(this).children('.button_center').removeClass('button_center_abonne')
                $(this).children('.button_right').removeClass('button_right_abonne')
            }
  
        });
		
    }
 
 
    if($("body.concert_mu").length > 0){
        //assister a un concert
    
        $('.participer').live('click',function(){
            var thisconcert = $(this);
            var baseurl = $(this).find("#baseurl").val();
            var id_concert = $(this).attr('id');
            var dataid = 'id_concert=' + id_concert;
            var divid = "#" + id_concert;
            	var l = window.location;
			var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
        
            $.ajax({
                type: "POST",
                url : base_url + '/index.php/mc_concerts/add_activity_concert',
                data: dataid,
          
                success: function(dataid){ //afficher le bon bouton
                    $(thisconcert).children('.button_center_red').text('J\'y vais');

                    $(thisconcert).children('.button_left_red').addClass('button_left'); 

                    $(thisconcert).children('.button_center_red').addClass('button_center');
                    $(thisconcert).children('.button_right_red').addClass('button_right'); 
  
                    $(thisconcert).children('.button_left_red').removeClass('button_left_red');		
                    $(thisconcert).children('.button_center_red').removeClass('button_center_red');
                    $(thisconcert).children('.button_right_red').removeClass('button_right_red');
   					
                    $(thisconcert).addClass('noparticiper');
                    $(thisconcert).removeClass('participer');
                }
            })
            return false;
        });
    
        // ne plus assister a un concert
        $('.noparticiper').live({
            click: function(){
                var thisconcert = $(this);
                var baseurl = $(this).find("#baseurl").val();
                var id_concert = $(this).attr('id');
                var dataid = 'id_concert=' + id_concert;
                var divid = "#" + id_concert;
            	var l = window.location;
			var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
        
                $.ajax({
                    type: "POST",
                    url : base_url + '/index.php/mc_concerts/delete_activity_concert',
                    data: dataid,
          
                    success: function(dataid){ //afficher le bon bouton
                        $(thisconcert).children('.button_center').text('Je veux y aller');


  
                        $(thisconcert).children('.button_left.button_left_abonne').addClass('button_left_red')
                        $(thisconcert).children('.button_left.button_left_abonne').removeClass('button_left_abonne')
                        $(thisconcert).children('.button_left').removeClass('button_left')

                        $(thisconcert).children('.button_center.button_center_abonne').addClass('button_center_red')
                        $(thisconcert).children('.button_center.button_center_abonne').removeClass('button_center_abonne')
                        $(thisconcert).children('.button_center').removeClass('button_center')

                        $(thisconcert).children('.button_right.button_right_abonne').addClass('button_right_red')
                        $(thisconcert).children('.button_right.button_right_abonne').removeClass('button_right_abonne')
                        $(thisconcert).children('.button_right').removeClass('button_right')
                        $(thisconcert).addClass('participer')
                        $(thisconcert).removeClass('noparticiper')

                    }
                })
                return false;
            },
        	
        	
  		
            mouseenter:  function () {
                $(this).children('.button_center').text('Je n\'y vais plus');
                $(this).children('.button_left').addClass('button_left_abonne')
                $(this).children('.button_center').addClass('button_center_abonne')
                $(this).children('.button_right').addClass('button_right_abonne')

            },
  	
            mouseleave:	function () {
  		
                $('.button_center_abonne').text('J\'y vais');
                $(this).children('.button_left').removeClass('button_left_abonne')
                $(this).children('.button_center').removeClass('button_center_abonne')
                $(this).children('.button_right').removeClass('button_right_abonne')
            }
        });
    
    }
    
    
    
    if($("body.concert_melo").length > 0){
    
        $('.participer').click(function(){
            var concert = $(this);
            var baseurl = $(this).find("#baseurl").val();
            var id_concert = $(this).attr('id');
            var dataid = 'id_concert=' + id_concert;
            var divid = "#" + id_concert;
	var l = window.location;
			var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
        
            $.ajax({
                type: "POST",
                url : base_url + '/index.php/mc_concerts/delete_activity_concert',
                data: dataid,
                success: function(jego){ //afficher le bon bouton

                    $(concert).parents('.all-info-concert').slideUp();
                }
            })
            return false
        });
    
    }
    
    
    $('.add-follow').live('click',function(){
      
        var button = $(this);
        var id_user = $(this).attr('id');
        var dataid = 'id_user=' + id_user;
	var l = window.location;
			var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
        
        $.ajax({
            type: "POST",
            url : base_url + '/index.php/mc_followers/add_follow',
            data: dataid,
            success: function(){ //afficher le bon bouton

                $(button).children('.button_left').addClass('button_left_abonne');	
                $(button).addClass('delete-follow');		
	
                $(button).children('.button_center').addClass('button_center_abonne');
                $(button).children('.button_right').addClass('button_right_abonne'); 
                $(button).children('.button_center').text('Ne plus suivre');
  
                $(button).children('.button_left').removeClass('button_left');		
                $(button).children('.button_center').removeClass('button_center');
                $(button).children('.button_right').removeClass('button_right');
                $(button).removeClass('add-follow');		
            }
        })
        return false
    });
    
    $('.delete-follow').live('click',function(){
      
        var button = $(this);
        var id_user = $(this).attr('id');
        var dataid = 'id_user=' + id_user;
	var l = window.location;
			var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
        
        $.ajax({
            type: "POST",
            url : base_url + '/index.php/mc_followers/delete_follow',
            data: dataid,
            success: function(){ //afficher le bon bouton

                $(button).children('.button_left_abonne').addClass('button_left');	
                $(button).addClass('delete-follow');		
	
                $(button).children('.button_center_abonne').addClass('button_center');
                $(button).children('.button_right_abonne').addClass('button_right'); 
                $(button).children('.button_center').text('Suivre');
  
                $(button).children('.button_left_abonne').removeClass('button_left_abonne');		
                $(button).children('.button_center_abonne').removeClass('button_center_abonne');
                $(button).children('.button_right_abonne').removeClass('button_right_abonne');
                $(button).removeClass('delete-follow');	
                $(button).addClass('add-follow');		
	
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
    
     
    
    if($("body.achats").length > 0){
     
        $('.bt_supp_playlist').click(function(){
            $('.checkbox-article:checked').each(function(){
                var a =  $(this).val();
     				var l = window.location;
			var base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
        
                var dataid = 'commande=' + a;
                $.ajax({
                    type: "POST",
                    url : base_url + '/index.php/melo_achats/delete_panier',
                    data: dataid,
                    success: function(){ //afficher le bon bouton
                        $('.even.row-color-'+a).slideUp();
                    }
                });
            });
        });     
		
        $('.play_achat').hover(
            function(){
                $(this).hide()
            },
            function() {
                $(this).show()
            }
		   
            )
    };
    
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
