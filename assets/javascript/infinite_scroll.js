var reachedEnd = false; /*Flag to check the end of records*/
 
/*checking the end of the document*/
$(window).scroll(function(){
  if ($(window).scrollTop() == $(document).height() - $(window).height()){
 
    /*calling the function to get the ajax data*/
    lastPostFunc();
  }
});
 
function lastPostFunc() {
 
  var trs = $('.search_results_wrapper .search_result'); /*get the number of trs*/
  var count = trs.length; /*this will work as the offset*/
 
  /*Restricting the request if the end is reached.*/
  if (reachedEnd == false) {
      
    var ajaxLoader = $('.search_results_wrapper').find(".ajax_loader");

    ajaxLoader.show();
    ajaxLoader.fadeIn(500).html('<img src="http://localhost.slyset.com/assets/images/common/ajax-loader.gif" />Loading results...');
      
    $.ajax({
//      url: base_url + "infscroll/ajax_customer_list/" + count,
      url: "http://localhost.slyset.com/index.php/search/ajax_search_result/1/" + count,
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
    })
  }
}