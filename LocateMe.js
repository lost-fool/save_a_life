var x = document.getElementById("omed");
function getLocation() 
{
  if (navigator.geolocation) 
  {
    navigator.geolocation.getCurrentPosition(showPosition);
  } 
  else 
  {
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) 
{
   x.innerHTML = "Latitude: " + position.coords.latitude + 
   "<br>Longitude: " + position.coords.longitude; 
}

$(document).ready(function(){
  $("p").on("click", function(){
    console.log("Success");
    getLocation();
  });
});
