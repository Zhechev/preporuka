$(function() {


    // Map
    var lat = $("#lat").val();
    var lng = $("#lng").val();

    if (lat && lng && lat != 'null' && lng != 'null') {

        var mymap = L.map('map').setView([lat, lng], 7);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            accessToken: 'not-needed',
        }).addTo(mymap);

        marker = L.marker([lat, lng]).addTo(mymap);
        mymap.setView(new L.LatLng(lat, lng), 14);
    }

    // Add Review to Venue
    $("#addReview").on("submit", function( event ) {
        event.preventDefault();
        url = $(this).attr('action');
        var form = $(this);
        formData = new FormData(form[0]);
        $.ajax({
            url: url,
            type: "POST",
            processData: false,
            contentType: false,
            data: formData,
            success:function(data) {
                console.log(data);
            }
        });
    });
});
