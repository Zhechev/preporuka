$( document ).ready(function() {
    // Search form submit
    $("#home-search-form").submit(function(e) {
        flag_validation = false;

         if (!$('#search-choose-category').val()) {
            $('#search-choose-category-div').effect( "shake" );
            flag_validation = true;
         }

         if (!$('#search-choose-city').val()) {
            $('#search-choose-city-div').effect( "shake" );
            flag_validation = true;
         }

        if (flag_validation) {
            e.preventDefault();
        }
    });


    $("#dialog_addVenue_part").find('input, textarea').click(function(evt) {
        $('.errorcode' + this.name).hide();
    })

    // Hide django core messages
    function hide_django_messages() {
        if ($(".messages").length) {
            setTimeout(function() {
                $(".messages").fadeOut('slow')
            }, 3000);
        }
    }
});

function showPopUp(id, type, title, content) {
        //var cancelar = 'Cancel';
        var buttonText = 'OK';

        var popFundo = '<div id="popFundo_' + id + '" class="popUpFundo ' + type + '"></div>'
        var janela = '<div id="' + id + '" class="popUp"><h1>' + title + "</h1><div><span>" + content + "</span></div><button class='puEnviar' data-parent=" + id + " id='" + id +"_enviar'>" + buttonText + "</button></div>";

        $("body").append(popFundo);
        $("body").append(janela);

        $("#popFundo_" + id).fadeIn("fast");
        $("#" + id).addClass("p " + type + " popUpEntrada");

        $("#" + id + '_enviar').on("click", function(){
            fetchPopUp(id);
        });
}

    function fetchPopUp(id) {
        if(id !== undefined) {
            $("#" + id).removeClass("popUpEntrada").addClass("popUpSaida");

                $("#popFundo_" + id).fadeOut(1000, function(){
                    $("#popFundo_" + id).remove();
                    $("#" + $(this).attr("id") + ", #" + id).remove();
                    if (!($(".popUp")[0])){
                    }
                });
        } else {
            $(".popUp").removeClass("popUpEntrada").addClass("popUpSaida");
                $(".popUpFundo").fadeOut(1000, function() {
                    $(".popUpFundo").remove();
                    $(".popUp").remove();
                });
        }
    }

