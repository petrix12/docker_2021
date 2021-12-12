$(document).ready(function(){
    /**/
    $.ajax({
        type: "GET",
        url: "../../backend/mostrar-empleado.php",
       
        success: function(data) {
            $("#tabla").html(data)
        }
    });
})