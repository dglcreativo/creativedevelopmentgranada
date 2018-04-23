<?php 

session_start();
include('functions.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Cursos | Creative Development Granada</title>
	<link rel="icon" type="image/png" href="images/logotipo.png">
	<link rel="stylesheet" href="css/estilos.css">
	<style>
        .h100{
            height: 100%;
            display: flex;
            align-items: center;
        }
        .course-menu{
            position: fixed;
            top: 100px;
            width: 250px;
            background: #ffffff;
            border-radius: 10px 10px 10px 10px;
            border: 1px solid #dedede;
            text-align: center;
        }
        .course-menu a{
            display: block;
            position: relative;
            border-bottom: 1px solid #dedede;
            color: #333333;
            padding: 5px 0;
            
        }
        .course-menu a:hover{
            background: #ff9004;
            color: #ffffff;
        }
        .course-menu a:last-child{
            border-bottom: none;
        }
        .course-menu a:first-child:hover{
            border-radius: 10px 10px 0 0;
        }
        .course-menu a:last-child:hover{
            border-radius: 0px 0px 10px 10px;
        }
		.dflex{
			display: flex;
			justify-content: center;
			align-items: center;
		}
		.maquetacionweb, .javascript, .jquery {
			width: 100%;
            padding: 80px 50px;
            background: #ffbd04;
		}
        .wordpress, .bootstrap, .mysql{
            width: 100%;
            padding: 80px 50px;
            background: #ffffff;
        }
        .maquetacionweb p, .wordpress p,
        .javascript p, .bootstrap p,
        .jquery p, .mysql p {
            margin-bottom: 10px;
            text-align: justify;
        }
        .maquetacionweb ul, .wordpress ul,
        .javascript ul, .bootstrap ul,
        .jquery ul, .mysql ul {
            text-align: left;
            list-style: square;
            margin-bottom: 20px;
        }
        .maquetacionweb ul li > ul, .wordpress ul li > ul,
        .javascript ul li > ul, .bootstrap ul li > ul,
        .jquery ul li > ul, .mysql ul li > ul {
            list-style: circle;
            text-align: auto;
            margin-left: 20px;
        }
        .wordpress{
            width: 100%;
            background: #ffffff;
        }
		article img{
			width: 85%;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 3px 3px 15px #333333;
		}
	.maquetacionweb article, .wordpress article,
        .javascript article, .bootstrap article,
        .jquery article, .mysql article {
			width: 48%;
			margin: 0 1% 0 1%;
		}

	</style>
</head>
<body>
    <nav id="course-menu" class="course-menu contain-menu">
        <a href="#mw">Maquetación Web</a>
        <a href="#wp">Wordpress</a>
        <a href="#js">Javascript</a>
        <a href="#bs">Bootstrap</a>
        <a href="#jq">Jquery</a>
        <a href="#ms">MySQL</a>
    </nav>
    
    <!-- Final de la seccion servicios -->

    <section id="quote" class="quote h100 content position-page">
        <article class="contain-foot-reg">
            <?php 

            if(!isset($_SESSION['usuario'])){
                echo '<a href="#campus" class="btn-foot campus-bajar">Campus online</a>';
            }else{
                echo '<a class="btn-foot" href="dashboard.php" title="'.$_SESSION['nombre'].'">Ir al panel de: '.$_SESSION['nombre'].'</a><img class="img-avatar btn-avatar" src="images/avatares/'.$_SESSION['foto'].'" alt="'.$_SESSION['foto'].'">';

            }

             ?>
            <?php 

                if(!isset($_SESSION['usuario'])){
                    echo '<a href="#" class="btn-foot mostrarregistro">Registrate!!</a>';
                }else{
                    echo '';
                }

             ?>
        </article>
        <article class="contain-menu">
            <a href="index.php" class="btn-foot bajar">Inicio</a>
        </article>
        <article class="contain-article">
            <h2 class="title-quote"><span class="font-icon-blockquote"></span>Cursos CDG</h2>
            <p>Aquí encontrarás los cursos que actualmente imparte nuestro centro de enseñanza CREATIVE DEVELOPMENT GRANADA, entros ellos encontrarás aquel curso que te interesa para tu campo de trabajo y con el que aprenderás de una manera rapida, sencilla y sin moverte de tu casa.</p>
        </article>
    </section>
    <section id="mw" class="maquetacionweb content">
        <h2 class="title">Maquetación Web</h2>
        
        <div class="dflex">
            <article>
            <img src="images/main2.jpg" alt="">
            </article>
            <article>
                <p>Maquetación con estándares W3C, desarrollo responsive, animación HTML5</p>
                <p>Con este Curso especializado en maquetación web con HTML5 y CSS3 aprenderás desde cero a desarrollar con éxito cualquier proyecto web basado en tecnologías HTML5, incluyendo aquellos que requieren ser "responsive" para adaptarse eficazmente a cada dispositivo.</p>
                <p>En el curso los alumnos aprenderán, además de las distintas técnicas de maquetación web siguiendo estándares W3C, todos los secretos de la creación de animaciones, transiciones y transformaciones utilizando CSS, algo vital para la creación de banners aplicables al mundo mobile y de esos elementos de interfaz que ayudan a mejorar la experiencia del usuario.</p>
                <p><strong>PROGRAMA DE CONTENIDOS</strong></p>
                <ul>
                    <li>Organización del desarrollo de un proyecto web</li>
                    <li>Tipografía aplicada al diseño interactivo</li>
                    <li>Maquetación web según estándares HTML5 y CSS3
                        <ul>
                            <li>Terminología y sintaxis</li>
                            <li>Elementos estructurales de HTML5 y su valor semántico</li>
                        </ul>
                    </li>
                </ul>
                <p><a href="" class="btn-full2">Ver más sobre el curso de maquetación web <i class="font-icon-arrow-light-round-right"></i></a></p>
            </article>
        </div>
    	
    </section>

    <section id="wp" class="wordpress content">
        <h2 class="title">Wordpress</h2>
        
        <div class="dflex">
            <article>
                <p>WordPress es una avanzada plataforma semántica de publicación web profesional orientada a la estética, los estándares web y la usabilidad. WordPress es libre y, al mismo tiempo, gratuíto.</p>
                <p>Gracias a nuestro curso de wordpress y el programa, podrás crear webs 2.0 en apenas unas horas con una profesionalidad y eficacia sin precedentes.</p>
                <p><strong>PROGRAMA DE CONTENIDOS</strong></p>
                <ul>
                    <li>Instalación
                        <ul>
                            <li>Descargar wordpress</li>
                            <li>xampp para windows</li>
                            <li>La base de datos</li>
                            <li>Novedades de WP</li>
                        </ul>
                    </li>
                </ul>  
                <p><a href="" class="btn-full2">Ver más sobre el curso de wordpress <i class="font-icon-arrow-light-round-right"></i></a></p>
            </article>
            <article>
            <img src="images/main4.jpg" alt="">
            </article>
            
        </div>
        
    </section>
    
    <section id="js" class="javascript content">
        <h2 class="title">Javascript</h2>
        
        <div class="dflex">
            <article>
            <img src="images/main2.jpg" alt="">
            </article>
            <article>
                <p>Maquetación con estándares W3C, desarrollo responsive, animación HTML5</p>
                <p>Con este Curso especializado en maquetación web con HTML5 y CSS3 aprenderás desde cero a desarrollar con éxito cualquier proyecto web basado en tecnologías HTML5, incluyendo aquellos que requieren ser "responsive" para adaptarse eficazmente a cada dispositivo.</p>
                <p>En el curso los alumnos aprenderán, además de las distintas técnicas de maquetación web siguiendo estándares W3C, todos los secretos de la creación de animaciones, transiciones y transformaciones utilizando CSS, algo vital para la creación de banners aplicables al mundo mobile y de esos elementos de interfaz que ayudan a mejorar la experiencia del usuario.</p>
                <p><strong>PROGRAMA DE CONTENIDOS</strong></p>
                <ul>
                    <li>Organización del desarrollo de un proyecto web</li>
                    <li>Tipografía aplicada al diseño interactivo</li>
                    <li>Maquetación web según estándares HTML5 y CSS3
                        <ul>
                            <li>Terminología y sintaxis</li>
                            <li>Elementos estructurales de HTML5 y su valor semántico</li>
                        </ul>
                    </li>
                </ul>
                <p><a href="" class="btn-full2">Ver más sobre el curso de Javascript <i class="font-icon-arrow-light-round-right"></i></a></p>
            </article>
        </div>
    	
    </section>

    <section id="bs" class="bootstrap content">
        <h2 class="title">Bootstrap</h2>
        
        <div class="dflex">
            <article>
                <p>WordPress es una avanzada plataforma semántica de publicación web profesional orientada a la estética, los estándares web y la usabilidad. WordPress es libre y, al mismo tiempo, gratuíto.</p>
                <p>Gracias a nuestro curso de wordpress y el programa, podrás crear webs 2.0 en apenas unas horas con una profesionalidad y eficacia sin precedentes.</p>
                <p><strong>PROGRAMA DE CONTENIDOS</strong></p>
                <ul>
                    <li>Instalación
                        <ul>
                            <li>Descargar wordpress</li>
                            <li>xampp para windows</li>
                            <li>La base de datos</li>
                            <li>Novedades de WP</li>
                        </ul>
                    </li>
                </ul>  
                <p><a href="" class="btn-full2">Ver más sobre el curso de bootstrap <i class="font-icon-arrow-light-round-right"></i></a></p>
            </article>
            <article>
            <img src="images/main4.jpg" alt="">
            </article>
            
        </div>
        
    </section>
    
    <section id="jq" class="jquery content">
        <h2 class="title">Jquery</h2>
        
        <div class="dflex">
            <article>
            <img src="images/main2.jpg" alt="">
            </article>
            <article>
                <p>Maquetación con estándares W3C, desarrollo responsive, animación HTML5</p>
                <p>Con este Curso especializado en maquetación web con HTML5 y CSS3 aprenderás desde cero a desarrollar con éxito cualquier proyecto web basado en tecnologías HTML5, incluyendo aquellos que requieren ser "responsive" para adaptarse eficazmente a cada dispositivo.</p>
                <p>En el curso los alumnos aprenderán, además de las distintas técnicas de maquetación web siguiendo estándares W3C, todos los secretos de la creación de animaciones, transiciones y transformaciones utilizando CSS, algo vital para la creación de banners aplicables al mundo mobile y de esos elementos de interfaz que ayudan a mejorar la experiencia del usuario.</p>
                <p><strong>PROGRAMA DE CONTENIDOS</strong></p>
                <ul>
                    <li>Organización del desarrollo de un proyecto web</li>
                    <li>Tipografía aplicada al diseño interactivo</li>
                    <li>Maquetación web según estándares HTML5 y CSS3
                        <ul>
                            <li>Terminología y sintaxis</li>
                            <li>Elementos estructurales de HTML5 y su valor semántico</li>
                        </ul>
                    </li>
                </ul>
                <p><a href="" class="btn-full2">Ver más sobre el curso de jquery <i class="font-icon-arrow-light-round-right"></i></a></p>
            </article>
        </div>
    	
    </section>

    <section id="ms" class="mysql content">
        <h2 class="title">MySQL</h2>
        
        <div class="dflex">
            <article>
                <p>WordPress es una avanzada plataforma semántica de publicación web profesional orientada a la estética, los estándares web y la usabilidad. WordPress es libre y, al mismo tiempo, gratuíto.</p>
                <p>Gracias a nuestro curso de wordpress y el programa, podrás crear webs 2.0 en apenas unas horas con una profesionalidad y eficacia sin precedentes.</p>
                <p><strong>PROGRAMA DE CONTENIDOS</strong></p>
                <ul>
                    <li>Instalación
                        <ul>
                            <li>Descargar wordpress</li>
                            <li>xampp para windows</li>
                            <li>La base de datos</li>
                            <li>Novedades de WP</li>
                        </ul>
                    </li>
                </ul>  
                <p><a href="" class="btn-full2">Ver más sobre el curso de MySQL <i class="font-icon-arrow-light-round-right"></i></a></p>
            </article>
            <article>
            <img src="images/main4.jpg" alt="">
            </article>
            
        </div>
        
    </section>

    <footer class="position-page limpiar">
        <section class="footer">
            <span class="copy">Academía Creative Development Granada &copy; 2017</span>
        </section>
        <section class="socialmedia">
            <a href="#"><i class="font-icon-social-facebook"></i></a>
            <a href="#"><i class="font-icon-social-twitter"></i></a>
        </section>
    </footer>
    <!-- Final del footer -->
</body>
</html>