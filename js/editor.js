$(document).ready(function () {

    /*Script que realiza el movimiento del editor HTML*/
    //función que actuliza en tiempo real el iframe segun el contenido que vayamos escribiendo en los textarea
    function actualizar() {
        $('iframe').contents().find('html').html('<html><head><style type="text/css">' + $('#cssPanel').val() + '</style></head><body>' + $('#htmlPanel').val()) + '</body></html>';
        document.getElementById('outputPanel').contentWindow.eval($('#javascriptPanel').val());
    }

    $('.boton').hover(function () {
        $(this).addClass('boton-hover');
    }, function () {
        $(this).removeClass('boton-hover');
    });
    $('.boton').click(function () {
        $(this).toggleClass('activo');//alterna entre dos clases
        $(this).removeClass('boton-hover');
        var panelID = $(this).attr('id') + 'Panel';
        $('#' + panelID).toggleClass('nv');
        var numeroPanelesActivos = 4 - $('.nv').length; //De esta manera se el numero de paneles activos que tengo
        $('.pnl').width(($(window).width() / numeroPanelesActivos) - 20); //me divide la pantalla segun el numero de paneles que tengo activados
    });
    $('.pnl').height($(window).height() - $('#head-editor').height());
    $('.pnl').width($(window).width() / 2 - 20);

    actualizar();

    //Al escribir en cualquier textarea se actualice en el iframe directamente.
    $('textarea').on('change keyup paste', function () {
        actualizar();
    });

});