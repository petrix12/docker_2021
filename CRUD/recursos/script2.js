$(document).ready(function(){
    /**/
    $.ajax({
        type: "GET",
        url: "mostrar-empleado.php",
       
        success: function(data) {
            $("#tabla").html(data)
          
        }
    });
})