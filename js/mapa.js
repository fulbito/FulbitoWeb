  var pos = null;
  var map = null;
  var marker = null;
  var cityCircle = null;

  function initialize(lat, lng, desc)
  {
    var zoom = 10;
    if(lat == "")
    {
        lat = "-38.4192641";
        zoom = 3;
    }
    if(lat == "")
        lng = "-63.5989206";

    var mapOptions = {
      center: new google.maps.LatLng(lat, lng),
      zoom: zoom,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

    pos = new google.maps.LatLng($("#lat").val(), $("#lng").val());
    marker = new google.maps.Marker({
      position: pos,
      map: map,
      title:"algo"
    });

    var radioOptions = {
      strokeColor: "#FF0000",
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: "#FF0000",
      fillOpacity: 0.35,
      map: map,
      center: pos,
      radius: ($("#radio").val()*1000)
    };
    cityCircle = new google.maps.Circle(radioOptions);
  }

  function actualizar_mapa()
  {
    pos = new google.maps.LatLng($("#lat").val(), $("#lng").val());
    map.setCenter(pos);
    map.setZoom(10);
    marker.setPosition(pos);
    actualizar_radio();
  }

  function actualizar_radio()
  {
    $("#radio2").val($("#radio").val());
    var radioOptions = {
      strokeColor: "#FF0000",
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: "#FF0000",
      fillOpacity: 0.35,
      map: map,
      center: pos,
      radius: ($("#radio").val()*1000)
    };

    cityCircle.setOptions(radioOptions);
  }

  function actualizar_radio2()
  {
    $("#radio").val($("#radio2").val());
    var radioOptions = {
      strokeColor: "#FF0000",
      strokeOpacity: 0.8,
      strokeWeight: 2,
      fillColor: "#FF0000",
      fillOpacity: 0.35,
      map: map,
      center: pos,
      radius: ($("#radio").val()*1000)
    };

    cityCircle.setOptions(radioOptions);
  }
