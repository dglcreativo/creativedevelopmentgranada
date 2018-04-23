$(document).ready(function() {
    
    //ocultar los errores en un tiempo determinado
    setTimeout(function(){
        $("#errores").fadeOut("fast");
    }, 4500);
    
    setTimeout(function(){
        $(".errores-reg, .error").fadeOut("fast");
    }, 4500);
        
    function readURL(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#preViewImg').attr('src', e.target.result)
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(document).on('change', '#imgFile', function(){
        readURL(this);
        $('#imgFile').hide();
        $('#preViewImg').css('display', 'block');
    });

    function borrarFoto(){
        $('#preViewImg').hide('fast');
        $('#imgFile').show();
        $('#imgActual').val('');
        readURL(this);
    }
    $('a.borrarImg').click(borrarFoto);
    
});