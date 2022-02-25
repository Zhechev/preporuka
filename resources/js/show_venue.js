$( document ).ready(function() {
    venue_id = $('#venue_id').val();

    // Add comment to Venue
    $( "#utf_add_comment" ).on("submit", function( e ) {
        this.enterKeyHint.preventDefault();
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

            }
        });
    });
})
