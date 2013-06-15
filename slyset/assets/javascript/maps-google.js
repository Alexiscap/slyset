			function initialisation(){
				var Tours = new google.maps.LatLng(47.389982, 0.688877);
				var optionsCarte = {
					zoom: 8,
					center: new google.maps.LatLng(0,0),
					mapTypeId: google.maps.MapTypeId.ROADMAP
				}
				var maCarte = new google.maps.Map(document.getElementById("plan_google"), optionsCarte);
				var optionsMarqueur = {
					position: Tours,
					map: maCarte,
					title: "Carte centrée sur ce marqueur"
				}
				var marqueur = new google.maps.Marker(optionsMarqueur);
				maCarte.setCenter(marqueur.getPosition());
			 }
			 google.maps.event.addDomListener(window, 'load', initialisation);
