$(function () {

    var cabecera = document.getElementById('navbar');
    var headroom = new Headroom(cabecera);
    headroom.init();

    var ancho = $(window).width(),
        enlaces = $('#links'),
        btnResponsive = $('#btn-responsive'),
        icono = $('#btn-responsive .icon');

    if (ancho < 768) {
        enlaces.hide();
        icono.addClass('font-icon-reorder');
    };

    btnResponsive.on('click', function (e) {
        enlaces.slideToggle();
        icono.toggleClass('font-icon-reorder');
        icono.toggleClass('font-icon-remove');
    });

    $(window).on('resize', function () {
        if ($(this).width() > 768) {
            enlaces.show();
            icono.toggleClass('font-icon-reorder');
            icono.toggleClass('font-icon-remove');
        } else {
            enlaces.hide();
        }
    });

    $('#navbar #links a, .bajar').click(function(e){
        e.preventDefault();
        var ir = jQuery(this).attr('href');
        var menu= $('#navbar #links a').removeClass('active');
        
        $('body,html').stop(true,true).animate({            
            scrollTop: $(ir).offset().top
        },1000);
    });
    
    $('.campus-bajar').click(function(e){
        e.preventDefault();
        var ir = jQuery(this).attr('href');
        var menu= $('nav a').removeClass('active');
        $('body,html').stop(true,true).animate({            
        scrollTop: $(ir).offset().top-60
        },1000);
    });

    //color activo del menu
    $('.position-page').waypoint(  
    function(direccion) {
    if (direccion ==='down') {            
        var seccion = $(this).attr('id');            
    } else {
        var anterior = $(this).prev();
        var seccion = $(anterior).attr('id');                    
    }
        $('.active').removeClass('active');
        $('.navbar a[href=#'+seccion+']').addClass('active');
    }, { offset: '25%' });

    //convierte el menu en pegajoso
    var altura = $('.navbar').offset().top;  
    $(window).on('scroll', function(){
        if ( $(window).scrollTop() > altura ){
            $('.navbar').addClass('sticky-menu');
        } else {
            $('.navbar').removeClass('sticky-menu');
        }
    });
    
});
