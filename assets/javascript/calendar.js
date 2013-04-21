

 function hover()
 {
document.getElementsByClassName('ui-state-default ui-state-highlight ui-state-active ui-state-hover').onclick = alert("test ok");
//document.getElementsByClassName('ui-state-default ui-state-active')

	}
             
             
function testaffichage(date)
{  
                var evenement = false ;
              
                if (joursEvenement != null) {
                    for (i = 0; i < joursEvenement.length; i++) {
                        if (date.getMonth() == joursEvenement[i][0] - 1 && date.getDate() == joursEvenement[i][1] && date.getFullYear() == joursEvenement[i][2]) {
                            evenement = true;
                        }
                    }
                }  
                if (evenement) return [true, 'css_jour_evenement'] ;
                else return [true, ''] ;
            }
             

     
        $('#datepicker').datepicker({  

            inline: true,  
            showOtherMonths: true,  
            dayNamesMin: ['', '', '', '', '', '', ''], 
             beforeShowDay: testaffichage, 

        });  
         

 
    /*
    
       function creerCalendrier(date) {
  
                var evenement = false ;
              
                if (joursEvenement != null) {
                    for (i = 0; i < joursEvenement.length; i++) {
                        if (date.getMonth() == joursEvenement[i][0] - 1 && date.getDate() == joursEvenement[i][1] && date.getFullYear() == joursEvenement[i][2]) {
                            evenement = true;
                        }
                    }
                }  
                if (evenement) return [false, 'css_jour_evenement'] ;
                else return [false, ''] ;
            }
             
        
    
    
    */
   
 