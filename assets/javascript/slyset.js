/**********************
 ** GLOBAL VARIABLES **
 *********************/
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


/**********************
 *** CUSTOM FUNCTION **
 *********************/
function playMasonry(){
    $container = $('.content');

    $container.imagesLoaded(function(){
        $container.masonry({
            itemSelector: '.box'
        });
    });
}

function playedState(){
    var t = $('#played .infos .ecoute').hide().html('- Aucune piste -').fadeIn('fast');
    return t;
}


/**********************
 *** JQUERY KEYDOWN ***
 *********************/
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


/**********************
 ****** JQUERY ON *****
 *********************/
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


/**********************
 **** JQUERY READY ****
 *********************/
$(document).ready(function(){
    $('#played .infos .ecoute').hide().html('- Aucune piste -').fadeIn('fast');
    
    if($(".iframe, .iframe-upload, .bigiframe").length > 0){
        $(".iframe").colorbox({
            iframe:true, 
            width:"45%", 
            height:"65%"
        });

        $(".iframe-upload").colorbox({
            iframe:false, 
            width:"45%", 
            height:"65%",
            onClosed:function(){
                location.reload(true);
            }
        });

        $(".bigiframe").colorbox({
            iframe:true, 
            width:"65%", 
            height:"85%"
        });
    }

    $(".open_player").click(function(event) {
        var href = $(this).attr('href');

        var popup = window.open(href, 'Player Slyset', 'resizable=no, top=150, left=400, height=445, width=650, toolbar=no, directories=no, status=no, location=no menubar=no');
        popup.focus();

        event.preventDefault();
    });
    
    //    if (window.opener != null && !window.opener.closed){
    //        alert('null');
    //    } else {
    //        console.log(window.opener);
    //        $(window).unload(function() {
    //            window.opener.playedState();
    //        });
    //    }
    
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
            }
        });

        // Add controls
        $('.audiojs .play-pause .play').before('<p class="prev"></p>');
        $('.audiojs .play-pause .pause').after('<p class="next"></p>');
        
        // Show text on header main frame
        $('audio').bind('play', function(){
            var currentAudio = $('ul li.playing').text();
            $('#played .infos .ecoute', window.opener.document).hide().html(currentAudio).fadeIn('fast');
        	
        	//show info on player (left side)
        	$('.title').text($('.playing .track').text());
        	$('.artist').text($('.playing .artiste').text());
        	var img_cover = $('.playing .cover_alb').attr('href');
        	$('.current-music').css("background", "url("+img_cover+") no-repeat 0 0 transparent");  
        	$('.current-music').css("background-size", "100%");  
        	
        	//increment ecoute value 
        	var id_morceau = $('.playing .cover_alb').attr('id');
        	var dataecoute = 'id_morceau='+id_morceau;
        	$.ajax({
            type: "POST",
            url : base_url +'/mc_musique/calcul_ecoute',
                data: dataecoute,
                success: function(){
                }
            });
            
            //already like the track ?
           	var id_morceau = $('.playing .cover_alb').attr('id');
        	var dataecoute = 'id_morceau='+id_morceau;
        	$.ajax({
            type: "POST",
            url : base_url +'/mc_musique/already_like_track',
                data: dataecoute,
                success: function(resul){
                	if (resul == "yes")
                	{
                		$('.like').addClass('enable');
                		$('.like').removeClass('disable');
                	}
                	if(resul == "no")
                	{
                		$('.like').addClass('disable');	
                		$('.like').removeClass('enable');
                	}
                }
            });
        	        	


        });
        $('audio').bind('pause', function(){
            var currentAudio = $('ul li.playing').text();
            $('#played .infos .ecoute', window.opener.document).hide().html(currentAudio + ' - paused').fadeIn('fast');
        });
        
        // Load in the first track
       /* 
       ---	Code initial : sans le debut sur un morceau specifique ---
      	
       	var audio = a[0];
        first = $('ul a').attr('data-src');
        $('ul li').first().addClass('playing');
        audio.load(first);
        */
        
        // Load in the first track or specific track (if mentionned on url)
        var audio = a[0];
        var id_morceau_url = l.pathname.split('/')[8];
        
        if(typeof id_morceau_url !== 'undefined')
        {
        	var track_first_force = $('ul').find('#'+id_morceau_url);
        	track_first_force.attr('class','cover_alb first_force');
        	first = $(".first_force").prev().attr('data-src');
        	$(".first_force").parents('li').addClass('playing');
        }
        else
        {
        	first = $('ul a').attr('data-src');
        	$('ul li').first().addClass('playing');
        }
        	audio.load(first);
        
        
        
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
                $('.audiojs .new-time').html('-' + mins + ':' + (secs > 9 ? secs : '0' + secs));
            }
             
            
        //                    var s = parseInt(this.currentTime % 60);
        //                    var m = parseInt((this.currentTime / 60) % 60);
        //                    console.log(m + ':' + s);
        //             
        //                    console.log(this.duration);
        //                    console.log(this.currentTime);
        //                    console.log((this.currentTime / this.duration) * 100);
        });
        
        //add like
       $('.like.disable').live('click',function()
       {
       		var item_like = $(this);
       		var id_morceau = $('.playing .cover_alb').attr('id');
       		var dataecoute = 'id_morceau='+id_morceau;
        	$.ajax({
            type: "POST",
            url : base_url +'/melo_playlist/add_like',
                data: dataecoute,
                success: function(){
                	item_like.removeClass('disable');
                	item_like.addClass('enable');
                }
            });
       })
       
       //delete like
       $('.like.enable').live('click',function()
       {
       		var item_like = $(this);
       		var id_morceau = $('.playing .cover_alb').attr('id');
       		var dataecoute = 'id_morceau='+id_morceau;
        	$.ajax({
            type: "POST",
            url : base_url +'/melo_playlist/delete_like',
                data: dataecoute,
                success: function(){
                	item_like.removeClass('enable');
                	item_like.addClass('disable');
                }
            });
       })

        
        
    
    //    $('audio').bind("play", function(){
    //        var currentAudio = $('ul li.playing').text();
    //        $('#played .infos .ecoute', window.opener.document).html(currentAudio);
    //        
    ////    });
    //        alert('test12' + currentAudio);

    // console.log(window.opener.focus());
    //http://ektaraval.blogspot.fr/2011/05/how-to-set-focus-to-child-window.html

    //    var p = $('audio');
    //    function isPlaying(p) { return !audelem.paused; }
    //
    //    if(isPlaying(p)){
    //    $('#played').html('EN COURSS');
    //    }
    
    $('.more_albpl').click(function(){
    	if($('.drop').is(':visible')==false)
    	{
    		$('.drop').show();
    	}
    	else
    	{
    		$('.drop').hide();
    	}
    });
    $('.addto').click(function(){
    	if($('.get_pls').is(':visible')==false)
    	{
    		$('.get_pls').show();
    	}
    	else
    	{
    		$('.get_pls').hide();
    	}
    });
    	$('.modal_alert.get_pls a').click(function(e)
    	{
    		e.preventDefault();
    		var playlist = $(this).text();
    		var id_morceau = $('.playing .cover_alb').attr('id');
    		dataid = 'pl='+playlist+'&&id_track='+id_morceau;
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
    }

    $('.iframe').bind('contextmenu', function(e) {
        return false;
    }); 
  
    //status actif du menu de gauche
    if ($('body').attr('class') != 'home' && $('body').attr('class') != 'search' && $('aside').attr('class') != 'admin-aside' && $('aside').length > 0)
    {
        var class_current = $('body').attr('class');
        var css_init = $('aside').find('#'+ class_current + ' .icon').css('background-position');
        var css_new = '-22px ' + css_init.slice(4,10);
	
        $('aside').find('#'+ class_current + ' .icon').css('background-position',css_new)
        $('aside').find('#'+ class_current + ' a').css('color','#01adbb')
    }
	
    //affichage bloc contenu side bar de droite

    if($('body.melo_actu').length>0||$('body.followers').length>0||$('body.abonnements').length>0||$('body.melo_actu').length>0||$('body.reglages').length>0||$('body.achats').length>0||$('body.concert_melo').length>0||$('body.musicien_actus').length>0||$('body.concert_mu').length>0||$('body.partitions').length>0||$('body.stats').length>0||$('body.personnaliser').length>0)
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
        $('#top_titre').show();
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
                var panier_notif = parseInt($('.notif').text().trim()) + 1;
                $('.notif').html('<div>' + panier_notif  + '</div>');
                
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
    /* if($("body.ajout_paroles").length > 0){

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
    }*/
    
    //affichage des morceaux pop in edition doc
    $("select[name*='album_doc']").change(function () {
        var str = "";
        var type = $('.content-pi-cent').attr('id');
        var id_album = $("select option:selected").attr('class');
        var dataid = 'id_album=' + id_album + '&&type='+type;
        $.ajax({
            type: "POST",
            url : base_url +'/pop_in_general/get_morceaux',
            data: dataid,
            success: function(datas){
                $('.mor').remove();
                $(datas).show().insertAfter('select').slideDown('slow');
            }
        })
    });
      

	
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#preview').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $(".photo_up").change(function(){
        readURL(this);
    });

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
    
    /*Specification second tableau page*/
    if($('.tout_titre #tablesorter-cb').length > 0){
        $('.tout_titre #tablesorter-cb').tablesorter({
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
    
    /*Tableau sans checkbox*/
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
    
    if($("body.admin-articles").length > 0){
        $('#redactor').redactor({
            imageUpload: '/admin_articles/uploadImg'
        });
          
        var pathname = window.location.hash;
        if(pathname.indexOf('#open') > -1){
            $('#wysiwyg-block').slideToggle('slow');
        }

        $('#wysiwyg-link').toggle(
            function (e){
                e.preventDefault();
                window.location.hash = this.hash;
                $('#wysiwyg-block').slideToggle('slow');
            },
            function (e){
                e.preventDefault();
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
            //alert('test');
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
        $('.bord_photo a').click(function(){
            if($(this).parents('.bord_photo').next('.allcomment').is(':visible') == false)
            {
                $(this).parents('.bord_photo').next('.allcomment').show();
				
                var photo_height=$(this).parents('.box').height();
                var comm_height=$(this).parents('.box').find('.allcomment').height();
                comm_height+=55;
                var total_height=photo_height-comm_height;
                $(this).parents('.box').find('.open_alb').css("height",total_height+"px");
				
                $(".content").masonry('reload');
            }
            else
            {
                $(this).parents('.bord_photo').next('.allcomment').hide();
                $(".content").masonry('reload');
            }
   
        });
		
        $('.box').hover(function(){
            var photo_height=$(this).height();
            var cover_height=$(this).find('.img_cover').height();
            cover_height=cover_height-27;
            cover_height=(cover_height-43)/2;
            $(this).find('.open_alb').find('img').css("margin-top",cover_height+"px");
            if($(this).find('.allcomment').is(':visible') == true)
            {   
                var comm_height=$(this).find('.allcomment').height();
                comm_height+=55;
                var total_height=photo_height-comm_height;
                $(this).find('.open_alb').css("height",total_height+"px");
            }
            else
            {
                $('.open_alb').css("height","calc(100% - 53px);");
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
    
    
    $('.ajout_comm form').submit(function(){
    alert('jkl');
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
                   
                    $(".content").masonry('reload');
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
                    $(".content").masonry('reload');
                }
            })
            return false;
        }
    });
    
    $('.comment-form-alb-wall').submit(function(){
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
                url : baseurl + 'index.php/mc_photos/form_album_wall_user_comment',
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
    
    $('.like').live('mouseover',function(){
        var coeur = $(this);
        $(coeur).attr('src',base_url_noindex + '/assets/images/musicien/pink_heart.png');     	
    });
    
    $('.like').live('mouseout',function(){
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
                http://localhost/slyset/assets/images/musicien/pink_heart.png
                 $(coeur).removeClass('like-album');
                $(coeur).addClass('nolike-album');
                $(coeur).attr('src',base_url_noindex + '/assets/images/musicien/pink_heart.png');

               
            }
        })
    });
    
    $('.like-album').live('mouseover',function(){
        var coeur = $(this);
        $(coeur).attr('src',base_url_noindex + '/assets/images/musicien/pink_heart.png');     	
    });
    
    $('.like-album').live('mouseout',function(){
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
    
    $('.like-video').live('mouseover',function(){
        var coeur = $(this);
        $(coeur).attr('src',base_url_noindex + '/assets/images/musicien/pink_heart.png');     	
    });
    
    $('.like-video').live('mouseout',function(){
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
 
    $('.box.col1').hover(
        function(){
    
            $(this).find('.photo').children('.edit').show();
            $(this).find('.photo').children('.open_alb').show();
        },
        function(){
            $(this).find('.photo').children('.edit').hide();
            $(this).find('.photo').children('.open_alb').hide();
        }
       );
    
 };
      
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
        
        $('.filtre').live('click',function()
        {
        	$(this).addClass('select');
        	var type_select = $(this).children('span').text();
        	$('.search_filter').each(function()
        	{
        		var bloc_type_joue = $(this).find('.wall-flux-content-right-text').attr('id')

        		if (bloc_type_joue.indexOf(type_select) != 0)
        		{
        			$(this).hide();
        		}
        	})
        })
        
    	$('.filtre.select').live('click',function()
        {
        	var type_select = $(this).children('span').text();
        	$(this).removeClass('select');
        	$('.search_filter').each(function()
        	{
        		var bloc_type_joue = $(this).find('.wall-flux-content-right-text').attr('id')
        		if (bloc_type_joue.indexOf(type_select) != 0)
        		{
        			$(this).show();
        		}
        	})
        })
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
            e.preventDefault();
            var cls = $(this).attr('href').replace('#', '');
            var desact =  $(".actus_post .actus_post_links").find('.active').removeClass('active')
            var act =$(this).addClass("active");
            
            location.hash = cls;
            
            var newForm = location.hash;
            $(".actus_post form").css("display","none");
            $(newForm).slideToggle('slow', "swing");
            
            window.location.hash = "";
        });
        
        $(".artist_post").each(function(){
            var comments = $(this).find('.comments');
            var limit = 2;
            
            if(comments.length > 2){
                comments.slice(limit).wrapAll('<div class="commentsWrapper"></div>');
                
                $(this).find('.commentsWrapper').before("<div class='linkCommentsWrapper'>Voir " + (comments.length - limit) + " de plus</div>");
                $(this).find('.commentsWrapper').hide();

                $(this).find('.linkCommentsWrapper').click(function(){
                    $(this).fadeOut('slow');
                    $(this).next('.commentsWrapper').slideDown('slow');
                });
            }
        });
    }
    
    if($("body.achats").length > 0){
    //suppression d'element du panier
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
		//hover des bouton plays
        $('tr').hover(
            function(){
                $(this).find('.play_achat').css('visibility', 'visible');
            },
            function() {
                $(this).find('.play_achat').css('visibility', 'hidden');
            }
           );
            
            //passage parametre commande id en url pour download
        	
        		var url = $('.ctr_dnw').attr('href');
       			$('.ctr_dnw').attr('href',url + '/') ;
       			url = $('.ctr_dnw').attr('href') ;
        		$('form.historiq_dwld .checkbox-article').change(function(){
        			var id_commande = [];
       				$('form.historiq_dwld .checkbox-article:checked').each(function(){
       					id_commande.push($(this).val());
       				});
       		     	var all_cmd =   id_commande.join("%20");
       				$('.ctr_dnw').attr('href', url + all_cmd);

       			
       		
       	
        })
    }
    if($("body .last_tunnel").length > 0){

   		var url = $('.ctr_dnw_part').attr('href');
       			$('.ctr_dnw_part').attr('href',url + '/') ;
       			url = $('.ctr_dnw_part').attr('href') ;
        		$('form.last_tunnel .checkbox-article').change(function(){
        			var id_commande = [];
       				$('form.last_tunnel .checkbox-article:checked').each(function(){
       					id_commande.push($(this).val());
       				});
       		     	var all_cmd =   id_commande.join("%20");
       				$('.ctr_dnw_part').attr('href', url + all_cmd);
       			});

    }
    
    //supprimer morceau playlist
    
    if($("body.playlist").length > 0){
        $('.bt_supp_playlist').click(function(){
        var pl_title = $(this).closest('.playlist').find('.nom_pl').text();
            $(this).parents('form').find('.checkbox-article:checked').each(function(){
            var to_hide = $(this).parents('tr');
                var a =  $(this).val();
                var dataid = 'track_pl=' + a + '&name_pl='+pl_title;
                $.ajax({
                    type: "POST",
                    url : base_url + '/melo_playlist/delete_from_pl',
                    data: dataid,
                    success: function(){ //afficher le bon bouton

                        $(to_hide).slideUp();
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
                            var panier_notif = parseInt($('.notif').text().trim()) + 1;
                			$('.notif').html('<div>' + panier_notif  + '</div>');
             
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
                        var panier_notif = parseInt($('.notif').text().trim()) + 1;
                		$('.notif').html('<div>' + panier_notif  + '</div>');
             
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
    
    if($("body.musique").length > 0){
        $('tr .delete').click(function(e){
            e.preventDefault();
            
            var that = $(this);
            
            var track_id = $(this).parent().prev().attr('class').split(' ')[0];
            var dataid = 'track_id=' + track_id;
            
            $.ajax({
                type: "POST",
                url : base_url +'/mc_musique/delete_track',
                data: dataid,
                success: function(data){
                    that.closest('tr').slideUp();
                }
            });
        });
        
        $("body").bind('click', function(ev) {
            var myID = ev.target.id;
            if (myID !== 'playlist_alert'&&myID !=='input_alert') {
                $('#playlist_alert').hide();
            }
            var myID = ev.target.id;
            if (myID !== 'album_une_alert') {
                $('#album_une_alert').hide();
            }
        });		
		
        //ajouter a une playlist
        $('.bt_playlist, .add,.bt_playlist.all_track').live('click',function(e){
        	e.preventDefault();
            var this_pl = $(this);
            var top = $(this).offset().top;
            var left =  $(this).offset().left;
            var t = top - 30;
            var l = left - 210;
    		
            if($("#playlist_alert").is(':visible')==false)
            {
                $("#playlist_alert").show().offset({
                    left:l,
                    top:t
                });
            }
            else
            {
                $("#playlist_alert").hide();
            }     
			
            if($(this).attr('class')=='bt_playlist')
            {
                var checkbox = $(this_pl).closest('form').find('.checkbox-article:checked:not(#article-all)');
            }
            if($(this).attr('class')=='bt_playlist all_track')
            {
                var checkbox = $('.alltrack_table').find('.checkbox-article:checked:not(#article-all)');
            }
			
			
          
            $('#playlist_alert a').not('.cree').click(function()
            {
                if($(this_pl).attr('class')=='bt_playlist'||$(this_pl).attr('class')=='bt_playlist all_track')
                {			
                    var pl = $(this).text();
                    checkbox.each(function(){
                        var check = $(this).val();
                        var id_morceau = $(this).parents('tr').find('p').attr('class');
                        id_morceau = id_morceau.slice(0,-9);
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
                                var panier_notif = parseInt($('.notif').text().trim()) + 1;
                				$('.notif').html('<div>' + panier_notif  + '</div>');
             
							
                                return false;					
                            }
                        });
                    });
                }
				
                if($(this_pl).attr('class')=='add')
                {
                    var pl = $(this).text();
                    var id_morceau = $(this_pl).parents('tr').find('p').attr('class');
                     id_morceau = id_morceau.slice(0,-9);
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
                            var panier_notif = parseInt($('.notif').text().trim()) + 1;
                			$('.notif').html('<div>' + panier_notif  + '</div>');
             
							
                            return false;					
                        }
                    });
					
                }
            });
			
            $('#playlist_alert a.cree').click(function()
            {
                if($(this_pl).attr('class')=='bt_playlist'||$(this_pl).attr('class')=='bt_playlist all_track')
                {			
                    var pl = $('#playlist_alert #input_alert').val();
                    checkbox.each(function(){
                        var check = $(this).val();
                        var id_morceau = $(this).parents('tr').find('p').attr('class');
                         id_morceau = id_morceau.slice(0,-9);
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
                                var panier_notif = parseInt($('.notif').text().trim()) + 1;
                				$('.notif').html('<div>' + panier_notif  + '</div>');
             
							
                                return false;					
                            }
                        });
                    });
                }
				
                if($(this_pl).attr('class')=='add')
                {
                    var pl = $('#playlist_alert #input_alert').val();
                    var id_morceau = $(this_pl).parents('tr').find('p').attr('class');
                    id_morceau = id_morceau.slice(0,-9);
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
							var panier_notif = parseInt($('.notif').text().trim()) + 1;
                			$('.notif').html('<div>' + panier_notif  + '</div>');
                            return false;					
                        }
                    });
					
                }
            });
        });
	
        //mise au panier album	
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
                        var panier_notif = parseInt($('.notif').text().trim()) + 1;
                		$('.notif').html('<div>' + panier_notif  + '</div>');
             
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
		
        //mise au panier morceau
        $('.bt_cadis.unealb, .bt_cadis.all_track').live('click',function()
        {
            var button = $(this);
            //alert($(this).attr('class'));
            if($(this).attr('class')=='bt_cadis unealb')
            {
                var check = $(this).closest('form').find('.checkbox-article:checked:not(#article-all)');
            }
            if($(this).attr('class')=='bt_cadis all_track')
            {
                var check = $('.alltrack_table').find('.checkbox-article:checked:not(#article-all)');
            }
				
            check.each(function(){
                var track_id = $(this).parents('tr').find('p').attr('class');
                dataid = 'track_id='+track_id;
                $.ajax({
                    type: "POST",
                    url : base_url + '/mc_musique/morceau_to_panier',
                    data: dataid,
                    success: function(data){ 
                        if (data=="ajout")
                        {
                            $('#modal-panier_track').reveal({ // The item which will be opened with reveal
                                animation: 'fade',                   // fade, fadeAndPop, none
                                animationspeed: 600,                       // how fast animtions are
                                closeonbackgroundclick: true,              // if you click background will modal close?
                                dismissmodalclass: 'close'    // the class of a button or element that will close an open modal
                            });
                            var panier_notif = parseInt($('.notif').text().trim()) + 1;
                			$('.notif').html('<div>' + panier_notif  + '</div>');
             
                            return false
                        }
                        else
                        {
                            $('#modal-already-panier_track').reveal({ // The item which will be opened with reveal
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
        });

        //bouton mettre a la une sur page musique
        $('.bt_middle').live('click',function(e){
            var top = $(this).offset().top;
            var left =  $(this).offset().left;
            var t = top + 30;
            var l = left -50 ;
   		
            //alert($(this).currentTarget);
            if($("#album_une_alert").is(':visible')==false)
            {
                $("#album_une_alert").show().offset({
                    left:l,
                    top:t
                });
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
                    cache: true,

                    $.ajax({
                        type: "POST",
                        cache: true,
                        url : base_url + '/mc_musique/put_alaune',
                        data: dataid,
                        success: function(data){ 
                            location.reload();

                        }
				
                    });
					
            });

			
			
        });
		
        //bouton mettre a la une sur page album
        $('.bt_middle.alb').live('click',function(){
		
            var alb = $('.title').attr('id');
		
            dataid = 'id_alb='+alb;
                cache: true,

                $.ajax({
                    type: "POST",
                    cache: true,
                    url : base_url + '/mc_musique/put_alaune',
                    data: dataid,
                    success: function(data){ 
                        $('.bt_noir.une').hide();
                        $('#modal_une').reveal({ // The item which will be opened with reveal
						
                            animation: 'fade',                   // fade, fadeAndPop, none
                            animationspeed: 600,                       // how fast animtions are
                            closeonbackgroundclick: true,              // if you click background will modal close?
                            dismissmodalclass: 'close'    // the class of a button or element that will close an open modal
                        });	
                	    
                    }
                });
		
        });
        
        
        $('.coeur').live('click',function(e)
        {
        	e.preventDefault();

            var coeur = $(this);
            var id_morceau = $(this).parents('.article-title').find('p').attr('class');
            id_morceau = id_morceau.slice(0,-9);
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
    	
        $('.coeur_actif').live('click',function(e)
        {    
            e.preventDefault();

            var coeur = $(this);
            var id_morceau = $(this).parents('.article-title').find('p').attr('class');
            id_morceau = id_morceau.slice(0,-9);
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
    document.getElementById('select').getElementsByClassName('miniat_titre')[0].style.display="inline-block";
}

function cache_edit(){
    document.getElementById('select').getElementsByClassName('miniat_titre')[0].style.display="none";
}

function show_play(){
    document.getElementById('select').getElementsByClassName('play')[0].style.visibility="visible";
}

function cache_play(){
    document.getElementById('select').getElementsByClassName('play')[0].style.visibility="hidden";
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
