  var pos = null;
  var map = null;
  var marker = null;
  var cityCircle = null;

  function initialize()
  {

    var mapOptions = {
      center: new google.maps.LatLng("-38.4192641", "-63.5989206"),
      zoom: 3,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

    pos = new google.maps.LatLng($("#lat").val(), $("#lng").val());
    marker = new google.maps.Marker({
      position: pos,
      map: map,
      title:"algo"
    });

    var populationOptions = {
      strokeColor: "#FF0000",
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: "#FF0000",
      fillOpacity: 0.35,
      map: map,
      center: pos,
      radius: 0
    };
    cityCircle = new google.maps.Circle(populationOptions);
  }

  function actualizar_mapa()
  {
    pos = new google.maps.LatLng($("#lat").val(), $("#lng").val());
    map.setCenter(pos);
    map.setZoom(10);
    marker.setPosition(pos);
    var populationOptions = {
      strokeColor: "#FF0000",
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: "#FF0000",
      fillOpacity: 0.35,
      map: map,
      center: pos,
      radius: ($("#radio").val()*1000)
    };

    cityCircle.setOptions(populationOptions);
  }

  $(document).ready(function(){
    google.maps.event.addDomListener(window, 'load', initialize);
  })
