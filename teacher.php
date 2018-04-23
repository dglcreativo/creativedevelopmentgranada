<?php 

session_start();
include('functions.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Profesores | Creative Development Granada</title>
    <link rel="icon" type="image/png" href="images/logotipo.png">
    <link rel="stylesheet" href="css/estilos.css">
    <style>
    
        .teacher1, .teacher2, .teacher3{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-flow: column;
            width: 100%;
            height: 75%;
            background: url(../images/main.jpg) repeat fixed 100%;
            /*background-size: cover;*/
        }
        .separator{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-flow: column;
            width: 100%;
            height: 25%;
        }
        .teacher1{background: url(images/OAYT3M0.jpg) repeat fixed 100%}
        .teacher2{background: #ff9004}
        .teacher3{background: url(images/libros.jpg) repeat fixed 100%}
        .teacher1 p, .teacher2 p, .teacher3 p{width: 750px}
        .teacher1 img, .teacher2 img, .teacher3 img{
            border: 5px solid #f0db49;
            border-radius: 50%;
        }
    
    </style>
</head>
<body>
    <header class="windows">
        <section class="header">

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
            <h1><img src="images/logotipo-white2.png" alt="logotipo"></h1>
            <p class="course-description">Elige el curso el que mas se adapte a tus necesidades.</p>
            <div class="buttons">
                <a href="cursos.php" class="btn2">Cursos CdG</a>
            </div>
        </section>
    </header>
    <section class="separator">
        <h2 class="title-separator">Bootstrap 4 y CSS3 Avanzado</h2>
    </section>
    <section class="teacher1">
        <img src="images/avatar_1-67b8c101e8.png">
        <h2 class="title">Carla Fernanadez</h2>
        <p>Creo que CdG es una compañía "perfecta". Porque 'perfeccionar' significa siempre intentar lo mejor, esforzándose siempre por mejorar, siempre considerando el bienestar y el futuro de nuestros estudiantes, y siempre promoviendo un mañana mejor.</p>
    </section>
    <section class="separator">
        <h2 class="title-separator">Jquery y JavaScript</h2>
    </section>
    <section class="content teacher2">
        <img src="images/avatar_4-7444389705.png">
        <h2 class="title">Sonia Caro</h2>
        <p>Cdg, excelente para aprender lo que necesitas. APUNTATE!! Veras como te encanta nuestro método de aprendizaje y adquiriras conocimientos rapidamente.</p>
    </section>
    <section class="separator">
        <h2 class="title-separator">MySQL y Wordpress</h2>
    </section>
    <section class="content teacher3">
        <img src="images/avatar_antonio70.png">
        <h2 class="title">Antonio Garcia</h2>
        <p>Cdg, excelente para aprender lo que necesitas. APUNTATE!! Veras como te encanta nuestro método de aprendizaje y adquiriras conocimientos rapidamente.</p>
    </section>
    <section id="ubication" class="ubication content position-page">
        <h2 class="title">Ubicación</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea totam possimus maiores voluptas, beatae est accusantium fugiat aut, illum perferendis quis nihil eligendi nobis architecto, adipisci expedita magnam, consectetur inventore!</p>
        <figure class="map">
            <img src="images/ubicacion.png" alt="ubicación">
        </figure>
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
</body>
</html>