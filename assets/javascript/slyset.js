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
        var usercomment = $(this).find("#usercomment").val();
        var messageid = $(this).find("#messageid").val();
        var thisParent = $(this).parent();
        var dataString = 'usercomment='+usercomment+'&messageid='+messageid;

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

    //Modifie l'affichage des checkboxs pour le choix de thème perso
    $userType = $('.personnaliser #themes label');
    $userType.click(function(){
        $('.personnaliser #themes input:checkbox').attr('checked', false);
        $(this).prev('.personnaliser #themes input:checkbox').attr('checked', true);
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