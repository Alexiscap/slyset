

$('#datepicker').datepicker({ 
    inline: true,  
    showOtherMonths: true,  
    dayNamesMin: ['', '', '', '', '', '', ''], 
    beforeShowDay: function test (date) {
    
        var result = [true, '', null];
        var matching = $.grep(events, function(event) {
            return event.Date.valueOf() === date.valueOf();
        });
        
        if (matching.length) {
            result = [true, 'css_jour_evenement', null];
        }
        return result;
    },
    onSelect: function select (dateText) {
        var date,
            selectedDate = new Date(dateText),
            i = 0,
            event = null;
        
        while (i < events.length && !event) {
            date = events[i].Date;

            if (selectedDate.valueOf() === date.valueOf()) {
                event = events[i];
            }
            i++;
        }
        if (event) {
            document.getElementById('calendar_alert').innerHTML = event.Title;

  if(document.getElementById('calendar_alert').style.display =='none') { 
    document.getElementById('calendar_alert').style.display  = 'block'; 
  } else { 
    document.getElementById('calendar_alert').style.display  = 'none'; 
  }

        	//document.getElementById('calendar_alert').style.display = "block";
            //alert(event.Title);
        }
    }
    
});
 
   