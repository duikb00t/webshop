<div id="location-map" style="height: 500px;"></div>

<script>
    //AIzaSyAQ1vHHgU-naArhlFsQOZKcy_Lp3yPHh7Y
    function initMap () {
        var wtg = {lat: 53.235926, lng: 6.590660};

        var map = new google.maps.Map(document.getElementById('location-map'), {
            zoom: 14,
            center: wtg,
            gestureHandling: 'cooperative',
            scrollwheel: false
        });

        var marker = new google.maps.Marker({
            position: wtg,
            map: map
        });
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQ1vHHgU-naArhlFsQOZKcy_Lp3yPHh7Y&callback=initMap">
</script>