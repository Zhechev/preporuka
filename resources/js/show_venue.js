$( document ).ready(function() {
    venue_id = $('#venue_id').val();

    // Add comment to Venue
    $( "#utf_add_comment" ).submit(function( event ) {
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
                if (!data['error']) {
                    showPopUp('message_popup', 'green', 'Успех!', 'Успешно добавихте нов коментар!');
                    $('.utf_leave_rating input:radio').prop('checked', false);
                    $('#textarea-review-content').val('');
                    if (data['rating']) {

                    }
                } else {
                    showPopUp('message_popup', 'red', 'Грешка!', 'Добавянето на коментар не беше успешно, свържете се с администратор!');
                }
            }
        });
    });


    // Map shown
    $.ajax({
        url: '/venues/getcoordinates/',
        type: "GET",
        data: {'venue_id': venue_id},
        success:function(data) {
            console.log(venue_id)
            if (data) {
                var mymap = L.map('map').setView([data[0].lat, data[0].lng], 7);

                $('#map').css('width', $('.vc_custom_1538133669144').width());

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                    accessToken: 'not-needed',
                }).addTo(mymap)

                for (key in data) {
                    lat = data[key].lat;
                    lng = data[key].lng;
                    console.log(lat, lng)
                    marker = L.marker([lat, lng]).addTo(mymap);
                    marker.bindPopup(data[key].name);
                }
            } else {
                var mymap = L.map('map').setView([42.634, 25.307], 7);

                $('#map').css('width', $('.vc_custom_1538133669144').width());
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                    accessToken: 'not-needed',
                }).addTo(mymap)
            }
        }
    });
})