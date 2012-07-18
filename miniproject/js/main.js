
$(document).ready(function() {

    $(document).on('click', '#submit', function() {

 
        // serialize data:
        var data = $("form :input").serialize();
        
        //alle Textfelder deaktivieren
        //$('.text').attr('disabled','true');

        //Icon während des Requests einblenden
        $('.loading_icon').show();

        //Request abschicken
        $.ajax({
            url: "ajaxmini.php",
            type: "GET",
            data: data,
            success: function (data) {
                    var json = $.parseJSON(data);
                    $(".done").html(json.hello+"<br />your ip: "+json.ip);
                    //$('.text').attr('disabled','false');
                    $('#form_container').fadeOut('slow');
                    $('.done').fadeIn('slow');
 
            }
        });

        return false;
    });
});


