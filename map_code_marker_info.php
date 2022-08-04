<!DOCTYPE html>
  <head>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCatE4JSXhSxv4A4rOyEpYYa-lx4K5Fc3Y" 
            type="text/javascript"></script>	
    <script type="text/javascript">
	
	var marker;
	var selected_name = <?php echo json_encode($row['name'])?>;
	var selected_content =  <?php echo json_encode($row['content'])?>;
	var selected_lat =  <?php echo json_encode($row['latitude'])?>;
	var selected_lng =  <?php echo json_encode($row['longitude'])?>;
	
	var lng = parseFloat(selected_lng);
	var lat = parseFloat(selected_lat);
		
    function load() {
		
      var map = new google.maps.Map(document.getElementById("map"), {
        center: new google.maps.LatLng(selected_lat, selected_lng),
        zoom: 18,
        mapTypeId: 'roadmap'
      });
	  
      var infoWindow = new google.maps.InfoWindow;

		  marker = new google.maps.Marker({
		  position: {lng:lng,lat:lat},
          map: map,
		  icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'
        });
	  
          bindInfoWindow(marker, map, infoWindow, selected_content, selected_name);

    }

    function bindInfoWindow(marker, map, infoWindow, html, name) {
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
		
        infoWindow.open(map, marker);

			infoWindow.setContent("<p>" + name + "<br />" + 
            html + "<br />");	 
				 
		SelectElement(name);
 
      });
    }

  </script>
  </head>
  <body onload="load()">
    <div id="map" style="width: 92%; height: 71%"></div>
	<script> </script>
  </body>
</html>