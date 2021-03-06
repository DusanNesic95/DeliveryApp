$(document).ready(function() {

  $(function () {
    var body = $('#logo');
    var backgrounds = [
      'url(../img/soda1.png)',
      'url(../img/water.png)',
      'url(../img/chips.png)',
      'url(../img/chicken.jpg)',
      'url(../img/ice.jpg)',
      'url(../img/cola.jpg)',
      'url(../img/mix.jpg)',
      'url(../img/peanut.jpg)',
      'url(../img/sona.png)',
      'url(../img/meat.jpg)'];
    var current = 0;

    function nextBackground() {
        body.css(
            'background',
        backgrounds[current = ++current % backgrounds.length]);

        setTimeout(nextBackground, 5000);
    }
    setTimeout(nextBackground, 5000);
    body.css('background', backgrounds[0]);
  });

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
    localStorage.setItem('type', 'receiver');
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

      $.post('http://192.168.1.10:90/deliveryapp/adduserservice.php', JSON.stringify(object), function(response) {
        if (response != null) {
          localStorage.setItem('array', response);
          window.location.href = "nearbyReceive.html";
        } else {
          alert("Internet connection problem!");
        }
      });
    }
  });

  setTimeout(function() {
    var data = localStorage.getItem('array');
    if (data != null && data != "") {
      var array = JSON.parse(data);
      var trHTML = '';
      for (var i = 0; i < array.length; i++) {
        console.log(array[i].name, array[i].number);
        trHTML += '<tr><td>' + array[i].name + '</td><td>' + array[i].number + '</td></tr>';
      }
      $('#personTable').append(trHTML);
    }
    localStorage.setItem('array', "");
  }, 2000);
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
