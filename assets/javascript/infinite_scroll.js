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

var reachedEnd = false;
var objHeight = $(window).height() - 50;
var last_scroll_top = 0;

$(window).scroll(function(e) {
    var st = $(this).scrollTop();

    if(st > last_scroll_top){
        if ($(window).scrollTop() + 250 > $(document).height() - $(window).height()) {
            if($("#any-background-home").length > 0){
                infiniteArticles();
            }
            
            if($("#any-background-admin-articles").length > 0){
                infiniteArticlesAdmin();
            }
            
            if($("#any-background-search").length > 0){
                infiniteResults();
            }

            if($("#any-background-admin-comptes").length > 0){
                infiniteComptes();
            }
        }
    }
    
    last_scroll_top = st;
});

function infiniteArticles() {
    var trs = $('#wall-flux .wall-flux-content');
    var count = trs.length - 1;
 
    if (reachedEnd == false) {
        var ajaxLoader = $('#wall-flux').find(".ajax_loader");

        ajaxLoader.show();
        ajaxLoader.fadeIn(500).html('<img src="' + base_url_noindex + '/assets/images/common/ajax-loader.gif" />');
      
        $.ajax({
            url: base_url + "/home/ajax_articles/1/" + count,
            async: false,
            dataType: "html",
            success: function(data) {
                if (data != "End"){
                    $('#wall-flux').append(data);
                    ajaxLoader.fadeOut(1000);
          
                    setTimeout(function(){
                        ajaxLoader.remove();
                    }, 1000);
                    
                } else {
                    reachedEnd = true;
                }
            }
        });
    }
}

function infiniteArticlesAdmin() {
    var trs = $('#articles-tab table tbody tr');
    var count = trs.length;
 
    if (reachedEnd == false) {
        var ajaxLoader = $('#articles-tab').find(".ajax_loader");

        ajaxLoader.show();
        ajaxLoader.fadeIn(500).html('<img src="' + base_url_noindex + '/assets/images/common/ajax-loader.gif" />');
        
        $.ajax({
            url: base_url + "/admin_articles/ajax_articles/1/" + count,
            async: false,
            dataType: "html",
            success: function(data) {
                if (data != "End"){
                    $('#articles-tab table tbody').append(data);
                    ajaxLoader.fadeOut(1000);
          
                    setTimeout(function(){
                        ajaxLoader.remove();
                    }, 1000);
                    
                    $('#articles-tab table tr').each(function(){
                        var check = $(this).find('.checkbox-style2').children();
                        var check_span = check.children();
                        
                        if(check_span.length == 0){
//                            $checkLabel = $('.checkbox-style label, .checkbox-style2 label');
                            check.prepend('<span/>');
                        }
                    });
                } else {
                    reachedEnd = true;
                }
            }
        });
    }
}

function infiniteResults() {
    var trs = $('.search_results_wrapper .search_result');
    var count = trs.length - 1;
 
    if (reachedEnd == false) {
        var ajaxLoader = $('.search_results_wrapper').find(".ajax_loader");

        ajaxLoader.show();
        ajaxLoader.fadeIn(500).html('<img src="' + base_url_noindex + '/assets/images/common/ajax-loader.gif" />');
      
        $.ajax({
            url: base_url + "/search/ajax_search_result/1/" + count,
            async: false,
            dataType: "html",
            success: function(data) {
                if (data != "End"){
                    $('.search_results_wrapper table tbody').append(data);
                    ajaxLoader.fadeOut(1000);
          
                    setTimeout(function(){
                        ajaxLoader.remove();
                    }, 1000);
                } else {
                    reachedEnd = true;
                }
            }
        });
    }
}

function infiniteComptes() {
    var trs = $('#comptes-tab tr');
    var count = trs.length - 1;
    var typeAccount = '';
 
    if($('#comptes-tab').hasClass('comptes_melos')){
        typeAccount = 'melomanes';
    } else if($('#comptes-tab').hasClass('comptes_musiciens')){
        typeAccount = 'musiciens';
    }
 
    if (reachedEnd == false) {
      
        var ajaxLoader = $('#comptes-tab').find(".ajax_loader");

        ajaxLoader.show();
        ajaxLoader.fadeIn(500).html('<img src="' + base_url_noindex + '/assets/images/common/ajax-loader.gif" />');
      
        $.ajax({
            url: base_url + "/admin_" + typeAccount + "/ajax_" + typeAccount + "/1/" + count,
            async: false,
            dataType: "html",
            success: function(data) {
                if (data != "End"){
                    $('#comptes-tab table tbody').append(data);
                    ajaxLoader.fadeOut(1000);
          
                    setTimeout(function(){
                        ajaxLoader.remove();
                    }, 1000);
                                        
                    $('#comptes-tab table tr').each(function(){
                        var check = $(this).find('.checkbox-style2').children();
                        var check_span = check.children();
                    
                        if(check_span.length == 0){
//                            $checkLabel = $('.checkbox-style label, .checkbox-style2 label');
                            check.prepend('<span/>');
                        }
                    });
                } else {
                    reachedEnd = true;
                }
            }
        });
    }
}