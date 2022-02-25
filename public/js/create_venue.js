var mymap = L.map('map').setView([42.6266999, 25.189417], 7);

$(function() {

    console.log(i18n);

    // Map start
    $('#map').css("width", $('.vc_custom_1538133669144').width());
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        accessToken: 'not-needed',
    }).addTo(mymap)

    var marker;

    mymap.on("click", function (e) {
        $(".mapCoords").remove();
        var element = $('<input type="hidden" class="mapCoords"  name="mapCoords" value="' + e.latlng.lat + '|' + e.latlng.lng + '"/>');
        $('#map').append(element);
        $("#lat").val(e.latlng.lat);
        $("#lng").val(e.latlng.lng);

        if (marker) {
            mymap.removeLayer(marker);
        }
        marker = new L.Marker(e.latlng).addTo(mymap);
    });

    // Map end


    // Map change
    $("#city_id").on("change", function() {
        let lat = $(this).find(':selected').data('lat');
        let lng = $(this).find(':selected').data('lng');
        mymap.setView(new L.LatLng(lat, lng), 11);
    });

    // Validation START

    $("#title").on("keyup", function() {
        checkTitle();
    });

    $("#address").on("keyup", function() {
        checkAddress();
    });

    $("#phone").on("keyup", function() {
        checkPhone();
    });

    $("#email").on("keyup", function() {
        checkEmail();
    });

    $("#content_bg").on("keyup", function() {
        checkContentBG();
    });

    $("#add_venue_form").on("submit", function(e) {
        e.preventDefault();

        console.log(!checkTitle(), !checkCity(), !checkAddress(), !checkPhone(), !checkEmail(), !checkContentBG());

        if (!checkTitle() || !checkCity() || !checkAddress() || !checkPhone() || !checkEmail() || !checkContentBG()) {
            return;
        }

        this.submit();
    });

    function checkTitle() {
        obj = $("#title");

        if (obj.val().length < 3) {
            setError(obj.attr('id'), i18n.validation.required_3);
            return false;
        } else {
            freeError(obj.attr('id'));
        }

        return true;
    };

    function checkAddress() {
        obj = $("#address");

        if (obj.val().length < 5) {
            setError(obj.attr('id'), i18n.validation.required_5);
            return false;
        } else {
            freeError(obj.attr('id'));
        }

        return true;
    }

    function checkPhone() {
        obj = $("#phone");

        if (!isMobilePhone(obj.val())) {
            setError(obj.attr('id'), i18n.validation.phone);
            return false;
        } else {
            freeError(obj.attr('id'));
        }

        return true;
    }

    function checkEmail() {
        obj = $("#email");

        if (!isValidEmail(obj.val())) {
            setError(obj.attr('id'), i18n.validation.email);
            return false;
        } else {
            freeError(obj.attr('id'));
        }

        return true;
    }

    function checkContentBG() {
        obj = $("#content_bg");

        if (obj.val().length < 10) {
            setError(obj.attr('id'), i18n.validation.required_10);
            return false;
        } else {
            freeError(obj.attr('id'));
        }

        return true;
    }

    function checkCity() {
        obj = $("#city_id");
        console.log(obj.val());
        if (!obj.val()) {
            setError("city_id_div", i18n.validation.required_10);
            return false;
        } else {
            freeError("city_id_div");
        }

        return true;
    }

    // Validation END

});
