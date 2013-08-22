var l = window.location;
var base_url = '';
var base_url_noindex = '';

if(l.pathname.split('/')[2] == "index.php"){
    base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1] + "/" + l.pathname.split('/')[2];
    base_url_noindex = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
} else {
    base_url = l.protocol + "//" + l.host + "/" + l.pathname.split('/')[1];
    base_url_noindex = l.protocol + "//" + l.host;
}

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

// Keyboard shortcuts
$(document).keydown(function(e) {
    var unicode = e.charCode ? e.charCode : e.keyCode;
    // right arrow
    if (unicode == 39) {
        var next = $('li.playing').next();
        if (!next.length) next = $('ul li').first();
        next.click();
    // back arrow
    } else if (unicode == 37) {
        var prev = $('li.playing').prev();
        if (!prev.length) prev = $('ul li').last();
        prev.click();
    // spacebar
    } else if (unicode == 32) {
        audio.playPause();
    }
});


$(document).on('submit', ".form_comments form", function(){
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
            }
        })
            
        return false;
    }
});
   

$(document).ready(function(){
    if($(".iframe, .iframe-upload, .bigiframe").length > 0){
        $(".iframe").colorbox({
            iframe:true, 
            width:"45%", 
            height:"65%",
            onClosed:function(){
            //$('.content').load('30 .content');
            }
        });

        $(".iframe-upload").colorbox({
            iframe:false, 
            width:"45%", 
            height:"65%"
        });

        $(".bigiframe").colorbox({
            iframe:true, 
            width:"65%", 
            height:"85%"
        });
    }

    $(".open_player").click(function(event) {
        var href = $(this).attr('href');
        window.open(href, '', 'resizable=no, height=445, width=650, toolbar=no, directories=no, status=no, location=no menubar=no');
        //        return false;
        event.preventDefault();
    });
    
    if ($("audio").length > 0){
        // Setup the player to autoplay the next track
        var a = audiojs.createAll({
            trackEnded: function() {
                if ($('.random').hasClass('disable')) {
                    var next = $('ul li.playing').next();
                    if (!next.length) next = $('ul li').first();
                    next.addClass('playing').siblings().removeClass('playing');
                    audio.load($('a', next).attr('data-src'));
                    audio.play();
                } else if($('.random').hasClass('enable')){
                    var list = $("ul li").toArray();
                    var elemlength = list.length;
                    var randomnum = Math.floor(Math.random()*elemlength);
                    var randomitem = list[randomnum];

//                    randomitem.play();
                    randomitem.addClass('playing').siblings().removeClass('playing');
                    audio.load($('a', randomitem).attr('data-src'));
                    audio.play();
                }
            },
            updatePlayhead: function() {},
            loadStarted: function() {}
        });


        $('.audiojs .play-pause .play').before('<p class="prev"></p>');
        $('.audiojs .play-pause .pause').after('<p class="next"></p>');
        
        // Load in the first track
        var audio = a[0];
        first = $('ul a').attr('data-src');
        $('ul li').first().addClass('playing');
        audio.load(first);
        
    //    $(window.opener).find('#played').html(first);
    $('audio').bind("play", function(){
        var currentAudio = $('ul li.playing').text();
        $('#played .infos .ecoute', window.opener.document).html(currentAudio);
    });

        // Load in a track on click
        $('ul li').click(function(e) {
            e.preventDefault();
            $(this).addClass('playing').siblings().removeClass('playing');
            audio.load($('a', this).attr('data-src'));
            audio.play();
        });
        
        
        // Load prev track on click
        $('p.prev').click(function(e) {
            e.preventDefault();
            var prev = $('li.playing').prev();
            if (!prev.length) prev = $('ul li').last();
            prev.click();
        });
        
        // Load next track on click
        $('p.next').click(function(e) {
            e.preventDefault();
            //            var next = $('li.playing').next();
            //            if (!next.length) next = $('ul li').first();
            //            next.click();
            
            var next = $('ul li.playing').next();
            if (!next.length) next = $('ul li').first();
            next.addClass('playing').siblings().removeClass('playing');
            audio.load($('a', next).attr('data-src'));
            audio.play();
        });
        
        $("#vol-slider").slider({
            orientation: "vertical",
            range: "min",
            min: 0,
            max: 100,
            value: 50,
            slide : function(event, ui){
                var volume = ui.value / 100;
                audio.setVolume(volume);
            }
        });
                
        $(".random.disable").toggle(function(e){
            $(this).removeClass('disable').addClass('enable');
            var list = $("ul li").toArray();
            var elemlength = list.length;
            var randomnum = Math.floor(Math.random()*elemlength);
            var randomitem = list[randomnum];
            
            randomitem.play();
            console.log(list);
        },function(e){
            $(this).removeClass('enable').addClass('disable');
        });
        
        $(".loop.disable").toggle(function(e){
            $(this).removeClass('disable').addClass('enable');
            $('audio').attr('loop', 'loop');
        },function(e){
            $(this).removeClass('enable').addClass('disable');
            $('audio').removeAttr('loop');
        });
        
        $(".vol.disable").hover(function(e){
            $(this).removeClass('disable').addClass('enable');
            $(this).parent().find('#vol-slider').css('display', 'inline-block');
        },function(e){
            $(this).removeClass('enable').addClass('disable');
            $(this).parent().find('#vol-slider').css('display', 'none');
        });

        $('audio').bind("timeupdate", function(){
            var rem = parseInt(this.duration - this.currentTime, 10);
            var pos = (this.currentTime / this.duration) * 100;
            var mins = Math.floor(rem / 60, 10);
            var secs = rem - mins * 60;
            
            if(!isNaN(rem)){
//                $('.audiojs .time').hide();
//            } else {
//                $('.audiojs .time').show();
                $('.audiojs .time').html('-' + mins + ':' + (secs > 9 ? secs : '0' + secs));
            }
             
            
//            var s = parseInt(this.currentTime % 60);
//            var m = parseInt((this.currentTime / 60) % 60);
//            console.log(m + ':' + s);
             
//            console.log(this.duration);
//            console.log(this.currentTime);
//            console.log((this.currentTime / this.duration) * 100);
        });
    }
    
//    var p = $('audio');
//    function isPlaying(p) { return !audelem.paused; }
//
//    if(isPlaying(p)){
//    $('#played').html('EN COURSS');
//    }

    $('.iframe').bind('contextmenu', function(e) {
        return false;
    }); 
  
    //status actif du menu de gauche
    if ($('body').attr('class') != 'home' && $('aside').length > 0)
    {
        var class_current = $('body').attr('class');
        var css_init = $('aside').find('#'+ class_current + ' .icon').css('background-position');
        var css_new = '-22px ' + css_init.slice(4,10);
	
        $('aside').find('#'+ class_current + ' .icon').css('background-position',css_new)
        $('aside').find('#'+ class_current + ' a').css('color','#01adbb')
    }
	
    //affichage bloc contenu side bar de droite

    if($('body.followers').length>0||$('body.abonnements').length>0||$('body.melo_actu').length>0||$('body.reglages').length>0||$('body.achats').length>0||$('body.concert_melo').length>0||$('body.musicien_actus').length>0||$('body.concert_mu').length>0||$('body.partitions').length>0||$('body.stats').length>0||$('body.personnaliser').length>0)
    {
        $('#top_titre').show();
        $('#last_photo').show();
        $('#reseaux_ailleur').show();
    }
    
    if($('body.photos_videos').length>0)
    {
        $('#top_titre').show();
        //  $('#last_photo').show();
        $('#reseaux_ailleur').show();
    	
        $('.del').click(function(){
            var this_comm = $(this);
            id_comm  = $(this).attr('id');
            dataid = 'id_comm='+id_comm;
            $.ajax({
                type: "POST",
                url : base_url +'/mc_photos/delete_comment',
                data: dataid,
                success: function(){
                    $(this_comm).parents('.comm').slideUp();
                }
            });
        });
    }
    
    if($('body.playlist').length>0)
    {
        $('.coeur').live('click',function()
        {
            var coeur = $(this);
            var id_morceau = $(this).parents('tr').attr('id');
            datalike = 'id_morceau='+id_morceau;
            $.ajax({
                type: "POST",
                url : base_url +'/melo_playlist/add_like',
                data: datalike,
                success: function(){
                    coeur.addClass('coeur_actif');
                    coeur.removeClass('coeur')
                // $(this_comm).parents('.comm').slideUp();
                }
            });
        })
    	
        $('.coeur_actif').live('click',function()
        {    
            var coeur = $(this);
            var id_morceau = $(this).parents('tr').attr('id');
            datalike = 'id_morceau='+id_morceau;
            $.ajax({
                type: "POST",
                url : base_url +'/melo_playlist/delete_like',
                data: datalike,
                success: function(){
                    coeur.addClass('coeur');
                    coeur.removeClass('coeur_actif')
                // $(this_comm).parents('.comm').slideUp();
                }
            });
        })
    }    

    if($('body.playlist').length>0||$('body.musique').length > 0){
        //  $('#top_titre').show();
        $('#last_photo').show();
        $('#reseaux_ailleur').show();
    }

    $('.mise-panier').click(function(){

        var la_cmd = $(this);
        doc_id = $(this).attr('id');
        prix = $(this).parents('td').attr('id');
        nom = $('.mise-panier').parents('td').attr('class')

        var dataid = 'prix=' + prix + '&&doc_id=' + doc_id + '&&nom=' + nom;
        //infos necessaire : prix  (children)
        // prix
        //type (partition ou parole)
        //morceau nom (children)
        //Utilisateur_id -> session
        $.ajax({
            type: "POST",
            url : base_url +'/mc_partitions/panier',
            data: dataid,
            success: function(datas){
                $(la_cmd).text('Au Panier');
            }
        })
    });

    $('.head_menu').click(function(){
         
        //            $(this).next('.one').stop();
        //$('.head_menu').next('.first-row').slideUp()
        if($(this).next('.one').is(":visible") == true){
            $(this).next('.one').stop(true).slideToggle(500);
        } else {
            $(this).next('.one').stop(true).slideToggle(500);
        }
    //$(this).next('.one:hidden').show()
    });
   
    //ajout_paroles ajout_partitions
    if($("body.ajout_paroles").length > 0){

        $("select").change(function () {
            $("select option:selected")
            var str = "";
            var id_album = $("select option:selected").attr('class');
            var dataid = 'id_album=' + id_album;
        
            $.ajax({
                type: "POST",
                url : base_url +'/pi_ajout_paroles/get_morceaux',
                data: dataid,
                success: function(datas){
                    $('.mor').remove();
                    $(datas).show().insertAfter('select').slideDown('slow');
                }
            })
        });
    }

    if($("body.ajout_partitions").length > 0){
        $("select").change(function () {
            $("select option:selected")
            var str = "";
            var id_album = $("select option:selected").attr('class');
            var dataid = 'id_album=' + id_album;
        
            $.ajax({
                type: "POST",
                url : base_url +'/pi_ajout_partitions/get_morceaux',
                data: dataid,
                success: function(datas){
                    $('.mor').remove();
                    $(datas).show().insertAfter('select').slideDown('slow');
                }
            })
        });
    }

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
        $('#tablesorter-nocb').tablesorter({
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
    	//var inputs =  $(this).parents('form').find("checkbox-article");  
  	
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
        }, function(){
            $(this).find('.article-actions').hide();
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
    
    if($("body.musicien_actus").length > 0){ 
        $('.form_comments form').submit(function(){
            alert('test');
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
    };
       
        if($("body.photos_videos").length > 0){
	
		var photo = $(this).parents('.photo'); 
		
        $('.bord_photo a').click(function(){
            if($(this).parents('.bord_photo').next('.allcomment').is(':visible') == false)
            {
                $(this).parents('.bord_photo').next('.allcomment').show();
				
				var photo_height=photo.height();
				var comm_height=photo.find('.allcomment').height();
				comm_height+=50;
				var total_height=photo_height-comm_height;
				photo.find('.open_alb').css("height",total_height+"px");
				
                $(".content").masonry('reload');
            }
            else
            {
                $(this).parents('.bord_photo').next('.allcomment').hide();
                $(".content").masonry('reload');
            }
   
        });
		
		$('.photo').hover(function(){
			var photo_height=$(this).height();
            if($(this).find('.allcomment').is(':visible') == true)
            {   
				var comm_height=$(this).find('.allcomment').height();
				comm_height+=50;
				var total_height=photo_height-comm_height;
				$(this).find('.open_alb').css("height",total_height+"px");
            }
            else
            {
                $('.open_alb').css("height","calc(100% - 53px);");
            }
   
        });
    };

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
        
            $.ajax({
                type: "POST",
                url :base_url + '/mc_photos/form_photo_user_comment',
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
        var id_photo = $(this).attr('id');
        var coeur = $(this);
        var dataid = 'id_photo=' + id_photo;
        
        $.ajax({
            type: "POST",
            url : base_url + '/mc_photos/add_like',
            data: dataid,
            success: function(jelike){
                $(coeur).attr('src',base_url_noindex  + '/assets/images/musicien/pink_heart.png');
                $(coeur).next().text(parseInt($(coeur).next().text()) + 1);
                $(coeur).addClass('nolike');
                $(coeur).removeClass('like');
        	
            }
        })
    });
    
    $('.like').mouseover(function(){
        var coeur = $(this);
        $(coeur).attr('src',base_url_noindex + '/assets/images/musicien/pink_heart.png');     	
    });
    
    $('.like').mouseout(function(){
        var coeur = $(this);
        $(coeur).attr('src',base_url_noindex + '/assets/images/musicien/icon_coeur.png');     	
    });
    
    $('.nolike').live('click',function(){
        var coeur = $(this);
        var baseurl = $(this).find("#baseurl").val();
        var id_photo = $(this).attr('id');
        var dataid = 'id_photo=' + id_photo;
        
        $.ajax({
            type: "POST",
            url : base_url + '/mc_photos/minus_like',
            data: dataid,
            success: function(jelike){
                $(coeur).attr('src',base_url_noindex + '/assets/images/musicien/icon_coeur.png');
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
        
        $.ajax({
            type: "POST",
            url :  base_url + '/mc_photos/add_like_a',
            data: dataid,
            success: function(jelike){
                $(coeur).attr('src',base_url_noindex + '/assets/images/musicien/pink_heart.png');
                $(coeur).next().text(parseInt($(coeur).next().text()) + 1);
                $(coeur).addClass('nolike-album');
                $(coeur).removeClass('like-album');
            }
        })
    });
    
    $('.like-album').mouseover(function(){
        var coeur = $(this);
        $(coeur).attr('src',base_url_noindex + '/assets/images/musicien/pink_heart.png');     	
    });
    
    $('.like-album').mouseout(function(){
        var coeur = $(this);
        $(coeur).attr('src',base_url_noindex + '/assets/images/musicien/icon_coeur.png');     	
    });
    
    $('.nolike-album').live('click',function(){
        var coeur = $(this);

        var baseurl = $(this).find("#baseurl").val();
        var file_name_album = $(this).attr('id');
        var dataid = 'file_name_album='+file_name_album;
        
        $.ajax({
            type: "POST",
            url : base_url + '/mc_photos/minus_like_a',
            data: dataid,
            success: function(jelike){
                $(coeur).attr('src',base_url_noindex + '/assets/images/musicien/icon_coeur.png');
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
        
        $.ajax({
            type: "POST",
            url : base_url + '/mc_photos/add_like_v',
            data: dataid,
            success: function(jelike){
                $(coeur).attr('src',base_url_noindex + '/assets/images/musicien/pink_heart.png');
                $(coeur).next().text(parseInt($(coeur).next().text()) + 1);
                $(coeur).addClass('nolike-video');
                $(coeur).removeClass('like-video');
            }
        })
    });
    
    $('.like-video').mouseover(function(){
        var coeur = $(this);
        $(coeur).attr('src',base_url_noindex + '/assets/images/musicien/pink_heart.png');     	
    });
    
    $('.like-video').mouseout(function(){
        var coeur = $(this);
        $(coeur).attr('src',base_url_noindex + '/assets/images/musicien/icon_coeur.png');     	
    });
    
    $('.nolike-video').live('click',function(){
        var coeur = $(this);

        var baseurl = $(this).find("#baseurl").val();
        var video_nom = $(this).attr('id');
        var dataid = 'video_nom=' + video_nom;
        
        $.ajax({
            type: "POST",
            url : base_url + '/mc_photos/minus_like_v',
            data: dataid,
            success: function(jelike){
                $(coeur).attr('src',base_url_noindex + '/assets/images/musicien/icon_coeur.png');
          
                $(coeur).next().text(parseInt($(coeur).next().text()) - 1);
                $(coeur).addClass('like-video');
                $(coeur).removeClass('nolike-video');
            }
        })
    });
 
    $('.photo.box.col1').hover(
        function(){
    
            $(this).children('.edit').show();
            $(this).children('.open_alb').show();
        },
        function(){
            $(this).children('.edit').hide();
            $(this).children('.open_alb').hide();
        }
        );
    

      
    //Ne plus assister a un concert
    $('.noparticiper_melo').click(function(){
        var baseurl = $(this).find("#baseurl").val();
        var id_concert = $(this).attr('id');
        var dataid = 'id_concert=' + id_concert;
        var divid = "#" + id_concert;
        
        $.ajax({
            type: "POST",
            url :base_url + '/mc_concerts/delete_activity_concert',
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
        $('.bouton .participer').live({
            click: function(){
                var a = $(this);
                var idwall_community = $(this).parents('.bouton').attr('id');
                var datawall = 'idwall_community=' + idwall_community;
                $.ajax({
                    type: "POST",
                    url :'../melo_abonnements/delete_community_wall',
                    data: datawall,
                    success: function(){ //afficher le bon bouton
                        $(a).parents('.follower').slideUp();
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
        
        
    };	
	
	
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
        
            $.ajax({
                type: "POST",
                url : base_url + '/mc_followers/add_follow',
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
        
                $.ajax({
                    type: "POST",
                    url : base_url + '/mc_followers/delete_follow',
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
        
            $.ajax({
                type: "POST",
                url : base_url + '/mc_concerts/add_activity_concert',
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
        
                $.ajax({
                    type: "POST",
                    url : base_url + '/mc_concerts/delete_activity_concert',
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
        $('.participer').live({
            click: function(){
                var concert = $(this);
                var baseurl = $(this).find("#baseurl").val();
                var id_concert = $(this).attr('id');
                var dataid = 'id_concert=' + id_concert;
                var divid = "#" + id_concert;
        
                $.ajax({
                    type: "POST",
                    url : base_url + '/mc_concerts/delete_activity_concert',
                    data: dataid,
                    success: function(jego){ //afficher le bon bouton
                        $(concert).parents('.all-info-concert').slideUp();
                    }
                })
                return false
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
    
    $('.add-follow').live('click',function(){
        var button = $(this);
        var id_user = $(this).attr('id');
        var dataid = 'id_user=' + id_user;
        
        $.ajax({
            type: "POST",
            url : base_url + '/mc_followers/add_follow',
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
        
        $.ajax({
            type: "POST",
            url : base_url + '/mc_followers/delete_follow',
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
    
    if($("body.home").length > 0){
        $("#coverflow").carouFredSel({
            items: 1,
            direction: "left",
            height: "100%",
            //            width: 770,
            //            height: 308,
            auto: {
                fx : "crossfade",
                easing : "linear",
                duration	: 1000,
                timeoutDuration: 3000,
                pauseOnHover: true
            },
            pagination: {
                container: "#pagination",
                fx : "crossfade",
                easing : "linear",
                duration: 500
            },
            prev:  {
                button: "#pagination-prev",
                fx : "crossfade",
                easing : "linear",
                duration: 500
            },
            next:  {
                button: "#pagination-next",
                fx : "crossfade",
                easing : "linear",
                duration: 500
            },
            mousewheel: true
        });
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
   
    };
    
    //Appel de la fonction
    if($("input[type=file]").length > 0){
        $(".upload-file-container").change(function(e){
            $in = $(this).find("input[type=file]");
            $(this).next(".upload_photo_name_file").html($in.val().replace(/C:\\fakepath\\/i, ''));
        });
    }
    
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
           $(this).parents('.panier').find('.checkbox-article:checked').each(function(){
                var a =  $(this).val();
        
                var dataid = 'commande=' + a;
                $.ajax({
                    type: "POST",
                    url : base_url + '/melo_achats/delete_panier',
                    data: dataid,
                    success: function(){ //afficher le bon bouton
                        $('.even.row-color-'+a).slideUp();
                    }
                });
            });
        });     
		
        $('tr').hover(
            function(){
                $(this).find('.play_achat').css('visibility', 'visible');
            },
            function() {
                $(this).find('.play_achat').css('visibility', 'hidden');
            }
            );
    }
    
    //supprimer morceau playlist
    
    if($("body.playlist").length > 0){
    $('.bt_supp_playlist').click(function(){
           $(this).parents('form').find('.checkbox-article:checked').each(function(){
                var a =  $(this).val();
                var dataid = 'track_pl=' + a;
                $.ajax({
                    type: "POST",
                    url : base_url + '/melo_playlist/delete_from_pl',
                    data: dataid,
                    success: function(){ //afficher le bon bouton

                        $('.even.row-color-'+a).slideUp();
                    }
                });
            });
        });  
		
	 $('.cadis_pl').click(function(){
           $(this).parents('form').find('.checkbox-article:checked:not(#article-all)').each(function(){
                var a =  $(this).val();
                var track_title = $(this).parents('tr').children('.article-title').text().trim()
                var dataid = 'track_pl=' + a;
                $.ajax({
                    type: "POST",
                    url : base_url + '/melo_playlist/pl_to_panier',
                    data: dataid,
                    success: function(data){ //afficher le bon bouton
						if(data=='ajout')
						{
                        	$('#modal').reveal({ // The item which will be opened with reveal
							animation: 'fade',                   // fade, fadeAndPop, none
							animationspeed: 600,                       // how fast animtions are
							closeonbackgroundclick: true,              // if you click background will modal close?
							dismissmodalclass: 'close'    // the class of a button or element that will close an open modal
							});
						return false;
                    	}
                    	else
                    	{
                    		$('.morceau_panier_already').text(track_title+' est déja dans votre panier');
                    		//renvoyer l'id et metrte une alert sur le tableau
                    		$('#modal_already').reveal({ // The item which will be opened with reveal
								animation: 'fade',                   // fade, fadeAndPop, none
								animationspeed: 600,                       // how fast animtions are
								closeonbackgroundclick: true,              // if you click background will modal close?
								dismissmodalclass: 'close'    // the class of a button or element that will close an open modal
							});

							return false;
                    	
                    	}
                   }
                });
          });
        }); 	
        
      $('.cadis').click(function(){
                var a =  $(this).parents('tr').attr('id');
				var cadis = $(this);
                var track_title = $(this).parents('tr').children('.article-title').text().trim()
                var dataid = 'track_pl=' + a;
                $.ajax({
                    type: "POST",
                    url : base_url + '/melo_playlist/pl_to_panier',
                    data: dataid,
                    success: function(data){ //afficher le bon bouton
						if(data=='ajout')
						{
                        	$('#modal').reveal({ // The item which will be opened with reveal
							animation: 'fade',                   // fade, fadeAndPop, none
							animationspeed: 600,                       // how fast animtions are
							closeonbackgroundclick: true,              // if you click background will modal close?
							dismissmodalclass: 'close'    // the class of a button or element that will close an open modal
							});
							  cadis.addClass('cadis_actif');
                   cadis.removeClass('cadis')
						return false;
                    	}
                    	else
                    	{
                    		$('.morceau_panier_already').text(track_title+' est déja dans votre panier');
                    		//renvoyer l'id et metrte une alert sur le tableau
                    		$('#modal_already').reveal({ // The item which will be opened with reveal
								animation: 'fade',                   // fade, fadeAndPop, none
								animationspeed: 600,                       // how fast animtions are
								closeonbackgroundclick: true,              // if you click background will modal close?
								dismissmodalclass: 'close'    // the class of a button or element that will close an open modal
							});

							return false;
                    	
                    	}
                   }
                
          		});
        }); 	   
  
    	$('.coeur').live('click',function()
    	{
    		var coeur = $(this);
    		var id_morceau = $(this).parents('tr').attr('id');
    		datalike = 'id_morceau='+id_morceau;
    		$.ajax({
                type: "POST",
                url : base_url +'/melo_playlist/add_like',
                data: datalike,
                success: function(){
                   coeur.addClass('coeur_actif');
                   coeur.removeClass('coeur')
                   // $(this_comm).parents('.comm').slideUp();
                }
            });
    	})
    	
    	$('.coeur_actif').live('click',function()
    	{    
    		var coeur = $(this);
    		var id_morceau = $(this).parents('tr').attr('id');
    		datalike = 'id_morceau='+id_morceau;
    		$.ajax({
                type: "POST",
                url : base_url +'/melo_playlist/delete_like',
                data: datalike,
                success: function(){
                  coeur.addClass('coeur');
                   coeur.removeClass('coeur_actif')
                   // $(this_comm).parents('.comm').slideUp();
                }
            });
    	})
    	
    	
    	$('.edit-pl').click(function()
    	{
    		var that = $(this);
    		var value = $(this).parents('.descri_playlist').find('.nom_pl').text();
    		$(this).parents('.descri_playlist').find('.nom_pl').replaceWith("<input class='nom_pl' value='"+value+"' type='text'/>");
			$(document).keypress(function(e) {
    		if(e.which == 13) {
    			 var title_new = $(that).parents('.descri_playlist').find('input[type=text].nom_pl').val();
				dataid = 'title_init=' + value + '&&title_new=' + title_new;
            $.ajax({
           
                type: "POST",
                url : base_url +'/melo_playlist/change_title_pl',
                data: dataid,
                success: function(){
                       		$(that).parents('.descri_playlist').find('input[type=text].nom_pl').replaceWith('<span class="nom_pl">'+$(that).parents('.descri_playlist').find('input[type=text].nom_pl').val()+'</span>');

                }
            });
    			}
			});
			
		
		
    	}
    	)
    	
    }
    
    if($("body.musique").length > 0)
    {   
    	$("body").bind('click', function(ev) {
    		var myID = ev.target.id;
   		 	if (myID !== 'playlist_alert') {
        		$('#playlist_alert').hide();
    		}
    		var myID = ev.target.id;
   		 	if (myID !== 'album_une_alert') {
        		$('#album_une_alert').hide();
    		}
		});
		
    	$('.bt_playlist').live('click',function(e){
    		var this_pl = $(this);
    		var top = $(this).offset().top;
    		var left =  $(this).offset().left;
    		var t = top - 30;
    		var l = left - 210;
    		
    		//alert($(this).currentTarget);
    		if($("#playlist_alert").is(':visible')==false)
 		   	{
        		 $("#playlist_alert").show().offset({left:l,top:t});
			}
			else
			{
		  		$("#playlist_alert").hide();
			}     
		
           	
       	 	$('#playlist_alert a').click(function()
        	{
        		var pl = $(this).text();
        		$(this_pl).closest('form').find('.checkbox-article:checked:not(#article-all)').each(function(){
        			var check = $(this).val();
        			var id_morceau = $(this).parents('tr').find('p').attr('class');
        			dataid = 'pl='+pl+'&&id_track='+id_morceau;
        			$.ajax({
       	            	type: "POST",
        	            url : base_url + '/mc_musique/to_pl',
            	        data: dataid,
                	    success: function(data){ //afficher le bon bouton
						
							$('#modal').reveal({ // The item which will be opened with reveal
							animation: 'fade',                   // fade, fadeAndPop, none
							animationspeed: 600,                       // how fast animtions are
							closeonbackgroundclick: true,              // if you click background will modal close?
							dismissmodalclass: 'close'    // the class of a button or element that will close an open modal
							});
							
						return false;
						
						}
					});
				});
			});
		});
		
		$('.panier_alb').click(function()
		{
			var album_id = $(this).attr('id');
			dataid = 'album_id='+album_id;

			$.ajax({
       	            	type: "POST",
        	            url : base_url + '/mc_musique/alb_to_panier',
            	       data: dataid,
                	    success: function(data){ 
                	    if (data=="ajout")
                	    {
                	    	$('#modal-panier').reveal({ // The item which will be opened with reveal
							animation: 'fade',                   // fade, fadeAndPop, none
							animationspeed: 600,                       // how fast animtions are
							closeonbackgroundclick: true,              // if you click background will modal close?
							dismissmodalclass: 'close'    // the class of a button or element that will close an open modal
							});
							return false
                	    }
                	    else
                	    {
                	    $('#modal-already-panier').reveal({ // The item which will be opened with reveal
							animation: 'fade',                   // fade, fadeAndPop, none
							animationspeed: 600,                       // how fast animtions are
							closeonbackgroundclick: true,              // if you click background will modal close?
							dismissmodalclass: 'close'    // the class of a button or element that will close an open modal
							});
							return false
                	    }
                	    }
			
			});
		});
		
		
		$('.bt_middle').live('click',function(e){
    		var this_pl = $(this);
    		var top = $(this).offset().top;
    		var left =  $(this).offset().left;
    		var t = top + 30;
    		var l = left -50 ;
    		
    		//alert($(this).currentTarget);
    		if($("#album_une_alert").is(':visible')==false)
 		   	{
        		 $("#album_une_alert").show().offset({left:l,top:t});
			}
			else
			{
		  		$("#album_une_alert").hide();
			}     
			
			$('#album_une_alert a').click(function()
        	{
        		var title_alb = $(this).text();
        			var id_alb = $(this).attr('id');
        			dataid = 'id_alb='+id_alb;
        			$.ajax({
       	            	type: "POST",
        	            url : base_url + '/mc_musique/put_alaune',
            	        data: dataid,
                	    success: function(data){ 
                	    //$('#une_alb').hide();
                	      //location.reload();
						//$('#une_alb').load('http://localhost/slyset/index.php/musique/30 #une_alb');
                	    //$('#une_alb').load('http://localhost/slyset/index.php/musique/30 #une_alb');
						 
                	    //$('#une_alb').show();

							    //afficher le bon bouton
						/*
							$('#album_une_alert').reveal({ // The item which will be opened with reveal
							animation: 'fade',                   // fade, fadeAndPop, none
							animationspeed: 600,                       // how fast animtions are
							closeonbackgroundclick: true,              // if you click background will modal close?
							dismissmodalclass: 'close'    // the class of a button or element that will close an open modal
							});
							
						return false;
						*/
						}
					});
				});
			
			
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
