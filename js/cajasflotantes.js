$(document).ready(function(e) {
    
    function darEfecto(efecto) {
        var el = $('.boxint, .boxint-reg');
        el.addClass(efecto);
        el.one('webkitAnimationEnd oanimationend msAnimationEnd animationend',
        function (e) {
            el.removeClass(efecto);
        });
    }
    function mostrar(e) {
        e.preventDefault();
        $(".boxext").show();
        darEfecto("bounceIn");
    }
    function ocultar() {
        $(".boxext").fadeOut("fast", function() {
            setTimeout(function() {
                $(".boxint").removeClass("bounceIn");
            }, 5);
        });         
    }
    function mostrarreg(e){
        e.preventDefault();
        $('.boxext-reg').show();
        darEfecto('swing');
    }
    function ocultarreg(){
        $('.boxext-reg').fadeOut('fast', function(){
            setTimeout(function(){
                $('.boxint-reg').removeClass('swing');
            }, 5);
        });
    }
    $("a.mostrarponercontacto").click(mostrar);
    $('a.mostrarregistro').click(mostrarreg);
    $("a.cerrarponercontacto").click(ocultar);
    $('a.cerrarregistro').click(ocultarreg);
    
});