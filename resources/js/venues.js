$( document ).ready(function() {

    $('#select_sort_category').on('change', function () {
        val = this.value;
        url = '/venues/all/' + this.value + '/1/';
        $('#sort_form').attr('action', url).submit();
        $('#select_sort_category').val(val);
    });


    // Add Venue JS

    $('#id_city').on('change', function() {
        if (this.value) {
            console.log(3344);
            $('.errorcodecity').hide();
        } else {
            $('.errorcodecity').show();
        }
    })


});


function getCookie(name) {
    var cookieValue = null;
    if (document.cookie && document.cookie !== '') {
        var cookies = document.cookie.split(';');
        for (var i = 0; i < cookies.length; i++) {
            var cookie = cookies[i].trim();
            if (cookie.substring(0, name.length + 1) === (name + '=')) {
                cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
                break;
            }
        }
    }
    return cookieValue;
}
