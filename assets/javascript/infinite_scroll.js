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
    $.ajax({
//      url: base_url + "infscroll/ajax_customer_list/" + count,
      url: "http://localhost.slyset.com/index.php/search/ajax_search_result/1/" + count,
      async: false,
      dataType: "html",
      success: function(data) {
        if (data != "End")
          $('.search_results_wrapper').append(data);
        else
          reachedEnd = true;
      }
    })
  }
}