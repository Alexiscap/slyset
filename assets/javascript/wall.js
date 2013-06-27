$( document ).ready(function() 
{
   $('.top').click(function(){
      	var baseurl = window.location.host;

   		var id_wall = $(this).attr('id');
    	var data_id_wall = 'id_wall='+id_wall;
    	
    	$.ajax({
    		type: "POST",
            url :  '/slyset/index.php/melo_wall/delete_from_wall',
            data: data_id_wall,
                success: function(){
        			$('#'+id_wall).slideUp();
  	 		 	}
    	});
	});
   setInterval(function() {
var url = window.location.pathname.split( '/' );

var segment_user = url[4];
      var nbrelm = $("#content").children();
     /* nbrelm.each(function(index){

    dataid = ($(this)).attr('id');
             alert(dataid+' '+index);

      })
      */
          id_last = ($(nbrelm)).attr('id');
       dataid = 'id_last='+id_last+'&id_user='+segment_user;
//alert(dataid)

   
    $.ajax({

                type: "POST",
                url : 'http://127.0.0.1/slyset/index.php/melo_wall/get_difference',
                data: dataid,
                //afficher le bon bouton
                success: function(data){
              	  $(data).hide().insertBefore(".artist_post:first").slideDown('slow');
              	
              	  	
              	  		
    					
    	
                }
	    
     		});
     		
   
}, 5000);
/*
  document.getElementById('test').onclick(function(){
     alert('test');
              	  	//	$(data).hide().insertBefore(".artist_post:first").slideDown('slow');
              	  		});
*/
   
});