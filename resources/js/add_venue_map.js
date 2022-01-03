var mymap = L.map('map').setView([42.148271, 24.750240], 17);

$(document).ready(function() {
    $('#map').css('width', $('.vc_custom_1538133669144').width());
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        accessToken: 'not-needed',
    }).addTo(mymap)

    mymap.on('click', onMapClick);
});

function onMapClick(e) {
    var element = $('<label>test:</label><input type="hidden" name="map_coords" value="' + e.latlng.lat + '|' + e.latlng.lng + '"/>');
    $('#map').append(element);

    var marker = L.marker([e.latlng.lat, e.latlng.lng]).addTo(mymap);
    marker.on('click',function(e) {
        element.remove();
        this.remove();
    });
}