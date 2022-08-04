<!DOCTYPE html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>PHP/MySQL & Google Maps Example</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCatE4JSXhSxv4A4rOyEpYYa-lx4K5Fc3Y"
            type="text/javascript"></script>
    <script type="text/javascript">

    function load() {
      var map = new google.maps.Map(document.getElementById("map"), {
		center: new google.maps.LatLng(37.510357, 22.372385),
        zoom: 18,
        mapTypeId: 'roadmap'
      });
      var infoWindow = new google.maps.InfoWindow;

      downloadUrl("phpsqlajax_genxml.php", function(data) {
        var xml = data.responseXML;
        var markers = xml.documentElement.getElementsByTagName("marker");
        for (var i = 0; i < markers.length; i++) {
          var name = markers[i].getAttribute("name");
          var content = markers[i].getAttribute("content");
          var type = markers[i].getAttribute("type");
          var point = new google.maps.LatLng(
              parseFloat(markers[i].getAttribute("latitude")),
              parseFloat(markers[i].getAttribute("longitude")));
          var content = markers[i].getAttribute("content");
          var icon = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';
          var marker = new google.maps.Marker({
            map: map,
            position: point,
            icon: 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png'
          });

		   
          bindInfoWindow(marker, map, infoWindow, content, name);
        }
      });
    }

	
	function SelectElement(valueToSelect)
	{    
	
    var element = document.getElementById("markerList");
    element.value = valueToSelect;
	
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

    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
          request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function doNothing() {}

  </script>

  </head>

  <body onload="load()">
    <div id="map" style="width: 92%; height: 71%"></div>
  </body>

</html>