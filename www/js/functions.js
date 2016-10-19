$(document).ready(function() {
  var type = localStorage.getItem('type');
  var name = "";
  var number = "";

  $("#firstOpt").click(function() {
    localStorage.setItem('type', 'deliver');
  });

  $("#secondOpt").click(function() {
    localStorage.setItem('type', 'receive');
  });

  $("#submitBtn").click(function() {
    name = $("#name").val();
    number = $("#number").val();
    if (name == "" || number == "") {
      $("#emptyFields").delay(200).hide(0, function() {
          $("#emptyFields").fadeIn().delay(1300).fadeOut(300);
      });
    } else {
      if (type == "deliver") {
        window.location.href = "nearbyReceive.html";
      } else {
        window.location.href = "nearbyDelivery.html";
      }
    }
  });
});

function initMap() {
  var uluru = {lat: -25.363, lng: 131.044};
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 4,
    center: uluru
  });
  var marker = new google.maps.Marker({
    position: uluru,
    map: map
  });
}
