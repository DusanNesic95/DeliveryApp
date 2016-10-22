$(document).ready(function() {

  var lat = 0;
  var long = 0;
  navigator.geolocation.getCurrentPosition(function(position) {
      lat = position.coords.latitude;
      long = position.coords.longitude;
  }, function() {
      alert("Your phone does not support GPS location!");
  }, {maximumAge:60000, timeout:15000, enableHighAccuracy:true});

  var type = localStorage.getItem('type');
  var name = "";
  var number = "";

  $("#firstOpt").click(function() {
    localStorage.setItem('type', 'deliver');
  });

  $("#secondOpt").click(function() {
    localStorage.setItem('type', 'receive');
  });

  $("#submit").click(function() {
    console.log(lat, long);
    name = $("#name").val();
    number = $("#number").val();
    if (name == "" || number == "") {
      $("#emptyFields").delay(200).hide(0, function() {
          $("#emptyFields").fadeIn().delay(1300).fadeOut(300);
      });
    } else {
      var object = {
        name : name,
        number : number,
        latitude : lat,
        longitude : long,
        role : type
      }

      $.post('http://localhost:90/deliveryapp/adduserservice.php', JSON.stringify(object), function(response) {
        if (response != null) {
          console.log(response);
          window.location.href = "nearbyReceive.html";
        } else {
          alert("Internet connection problem!");
        }
      });
    }
  });
});

var options = {
  enableHighAccuracy: true,
  timeout: 5000,
  maximumAge: 0
};

function success(pos) {
  console.log('Function is called againp!');
  var crd = pos.coords;

  alert('Your current position is:');
  alert('Latitude : ' + crd.latitude);
  alert('Longitude: ' + crd.longitude);
  alert('More or less ' + crd.accuracy + ' meters.');
};

function error(err) {
  console.warn('ERROR(' + err.code + '): ' + err.message);
};