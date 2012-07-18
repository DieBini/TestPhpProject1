
$(document).ready(function() {
    //click event für submit button


    $(document).on('click', '#submit', function() {

    
        //Daten von den HTML Feldern in JS-Vars übersetzen
        var name = $('input[name=name]');
        var email = $('input[name=email]');
        var comment = $('textarea[name=comment]');
 
        //die Daten sollen per GET an das PHP Skript weitergeleitet werden. Dafür bauen wir einen 
        //String
        var data = 'name=' + name.val() + '&email=' + email.val()
        + '&comment='  + encodeURIComponent(comment.val());
 
        //alle Textfelder deaktivieren
        $('.text').attr('disabled','true');

        //Icon während des Requests einblenden
        $('.loading_icon').show();
    
        //Request abschicken
        $.ajax({
            
            //Ort des Skriptes in dem die per GET übertragenen Daten verarbeitet werden sollen
            url: "saveData.php",
            //Angabe der GET Methode, auch POST wäre möglich. Allerdings nur sinnvoll
            //bei größeren Datenmengen
            type: "GET",
            //Daten die gesendet werden sollen			
            data: data,
 
            //bei Antwort des Requests (Response)
            success: function (reqCode) {
                alert("success");
                //wenn saveData.php true bzw. den Status 1 zurückliefert
                if (reqCode==1) {
                    //verstecken des Formulars
                    $('.form').fadeOut('slow');
                    //anzeigen der Erfolgsmeldung
                    $('.done').fadeIn('slow');
 
                //wenn der Request eine Form von false zurückschickt, Fehler ausgeben.
                } else{
                    alert('Fehler beim Abschicken des Formulares.');
                }
            }
        });
 
        return false;
    //der return wird benötigt, damit das Formular nicht tatsächlich abgeschickt wird und         
    //sich nicht wie ein normales Form mit Seiten Refresh verhält.
    });
});