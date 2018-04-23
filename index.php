<?php 

session_start();
include('functions.php');
?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title>Academía Creative Development Granada</title>
        <link rel="icon" type="image/png" href="images/logotipo.png">
        <link rel="stylesheet" href="css/estilos.css">
        
        <!-- Scripts -->
            <script type="text/javascript" src="js/jquery.js"></script>
            <script type="text/javascript" src="js/script.js"></script>
            <script type="text/javascript" src="js/waypoint.js"></script>
            <script type="text/javascript" src="js/cajasflotantes.js"></script>
            <script type="text/javascript" src="js/headroom.min.js"></script>
            <script type="text/javascript" src="js/menu.js"></script>
    </head>

    <body>
        <?php
            if(isset($_REQUEST['operacion']) && $_REQUEST['operacion']=="registrarse"){
                if(!$request = validarDatos()){
                    $guardarAlumnoIndex=guardarAlumnoIndex();
                    validarImg();
                }
            } 
            
            $error = validarUsuario();  
            if (isset($error)&&$error!="") echo "<div id='errores' class='errores-reg'>". $error . "</div>";
            if(isset($guardarAlumnoIndex)) echo "<div id='errores' class='errores-reg'>". $guardarAlumnoIndex . "</div>";                   
        ?>

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
                        <a href="#navbar" class="btn-foot bajar">Menu</a>
                    </article>
                    <h1><img src="images/logotipo-white2.png" alt="logotipo"></h1>
                    <p class="course-description">Elige el curso el que mas se adapte a tus necesidades.</p>
                    <div class="buttons">
                        <a href="cursos.php" class="btn2">Cursos CdG</a>
                    </div>
                </section>

                <!-- Cajas flotantes -->
                <div class="boxext">
                    <div class="boxint animated">
                        <div class="boxcenter">
                            <h2>Mandanos tu correo electrónico</h2>
                            <p>y nosotros nos pondremos en contacto contigo lo mas pronto posible</p>
                            <form action="" class="form" method="post">
                                <fieldset>
                                    <div class="col">
                                        <label>EMAIL <span class="tooltip">?</span></label>
                                        <input type="email" name="emailponercontacto">
                                    </div>
                                </fieldset>
                                <input type="submit" class="btn-foot" name="operacion" value="enviar correo">
                            </form>
                            <a class="cerrarponercontacto cerrar"><i class="font-icon-remove"></i></a>
                        </div>
                    </div>
                </div>
                <!-- Fin caja mostrar contacto -->

                <div class="boxext-reg">
                    <div class="boxint-reg animated">
                        <div class="boxcenter">
                            <h2>Formulario de registro</h2>
                            <form action="<?php echo $_SERVER['PHP_SELF'];?>" class="form" method="post" enctype="multipart/form-data">
                                <fieldset>
                                   <div class="radio">
                                        <?php 

                                            if(isset($_REQUEST['operacion']) && $_REQUEST['operacion']=="registrarse") {
                                                
                                                if(empty($_REQUEST['insert-radio'])){
                                                    echo '<span class="error">Debes seleccionar el alumno, gracias</span>';

                                                }               
                                            }

                                        ?>
                                        <input type="radio" name="insert-radio" value="profesor" id="profesor" disabled>
                                        <label for="profesor">Profesor</label>
                                        <input type="radio" name="insert-radio" value="alumno" id="alumno">
                                        <label for="alumno">Alumno</label>
                                    </div>
                                    <div class="colreg file">
                                        <input type="file" id="imgFile" name="foto">
                                        <img src="#" alt="" id="preViewImg">
                                        <a class="borrarImg"><i class="font-icon-remove"></i></a>
                                        <span class="error"><?php if(isset($request['dni']))echo $request['dni'];?></span>
                                    </div>
                                    <div class="colreg">
                                        <input type="text" name="dni" placeholder="DNI">
                                        <span class="error"><?php if(isset($request['dni']))echo $request['dni'];?></span>
                                        <input type="text" name="usuario" placeholder="USUARIO">
                                        <span class="error"><?php if(isset($request['usuario']))echo $request['usuario'];?></span>
                                        <input type="password" name="password" placeholder="PASSWORD">
                                        <span class="error"><?php if(isset($request['password']))echo $request['password'];?></span>
                                        <input type="email" name="email" placeholder="EMAIL">
                                        <span class="error"><?php if(isset($request['email']))echo $request['email'];?></span>
                                    </div>
                                </fieldset>
                                <input type="submit" class="btn-foot" name="operacion" value="registrarse">
                            </form>
                            <a class="cerrarregistro cerrar"><i class="font-icon-remove"></i></a>
                        </div>
                    </div>
                </div>
                <!-- Fin caja mostrar registro -->
                <!-- Fin cajas flotantes -->

            </header>
            <!-- Final del header -->

            <nav id="navbar" class="navbar">
                <div id="logo">
                    <img src="images/logotipo.png" alt="Academía Creative Development Granada">
                    <h4></h4>
                    <span class="btn-responsive" id="btn-responsive"><i class="icon font-icon-reorder"></i></span>
                </div>
                <div class="links" id="links">
                    <a href="#who">Acerca de</a>
                    <a href="#services">Cursos</a>
                    <a href="#teacher">Profesores</a>
                    <a href="#ubication">Ubicación</a>
                </div>
            </nav>
            <!-- Final del menu de navegacion -->

            <!--<section id="quote" class="quote-r content">
            <article class="contain-article">
                <h2 class="title-quote">Creative Development Granada<span class="font-icon-blockquote"></span></h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto optio ad quo tempore, nulla eaque reprehenderit, minima sit esse recusandae quas explicabo excepturi. At, sequi!</p>
            </article>          
            </section>Final de la seccion quote -->

            <section id="editor" class="editor content position-page">
                <article class="contain-article">
                    <h2 class="title">Creative <span>HTML</span> editor</h2>
                    <p>El editor de HTML le permite editar el código fuente en línea sin necesidad de descargar ninguna aplicación. GARANTIZADO, el mejor software constructor de páginaS web visual se puede encontrar por ahí!</p>
                    <p><a href="editor.php" class="btn" target="_blank">Editor HTML</a></p>
                </article>
            </section>
            <!-- Final de la seccion editor -->

            <section id="campus" class="content">
                <h2 class="title">Campus virtual</h2>
                <article class="campus">
                    <aside class="editor-html">
                        <p><a href="editor.php" class="btn-full" target="_blank">Editor HTML</a></p>
                        <p><a href="cursos.php" class="btn-full">Cursos CdG</a></p>
                        <p class="last">Para poder acceder al editor html de nuestro sitio web debes de estar registrado en nuestra plataforma. En los cursos que encontraras en este acceso podrás inscribirte de una froma sencilla, podrás ver las instrucciones dentro de cada curso.</p>

                    </aside>
                    <aside class="form-registro">
                        <h3>Indentificación y registro</h3>
                        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                            <input type="text" name="usuario" placeholder="Usuario">
                            <input type="password" name="password" placeholder="Contraseña">
                            <input type="submit" class="btn-foot" name="operacion" value="entrar">
                            <?php 

                            if(!isset($_SESSION['usuario'])){
                                echo '<a href="#" class="btn-link mostrarregistro">Registrate!!</a>';
                            }else{
                                echo '';
                            }

                            ?>
                        </form>
                    </aside>
                </article>
            </section>
            <!-- Final de la seccion del registro -->

            <section id="who" class="who content position-page">
                <h2 class="title">acerca de...</h2>
                <p>Creative Development Granada es una versión digital, innovadora y práctica de la academia tradicional. Un lugar donde los alumnos sin necesidad de desplazamientos asisten a clase en un campus virtual a través de videoconferencias y con la inestimable ayuda de las pizarras digitales. Más de 30 años de experiencia y unos óptimos resultados impartiendo este tipo de formación, nos avalan. En este tiempo, nuestra metodología formativa ha ido evolucionando, desde las clases presenciales iniciales, pasando por las clases online, hasta llegar a la innovadora metodología ONROOM actual.</p>
                <p class="last">Con esta metodología hacemos posible que en el proceso de aprendizaje, se desplace el conocimiento y no las personas. Hoy en día, contamos con más de cinco mil clases explicativas desarrolladas de forma amena e intuitiva, ejercicios prácticos y pruebas de autoevaluación que te ayudarán a conseguir tus objetivos. </p>
            </section>
            <!-- Final sección quienes somos -->

            <section id="services" class="services content position-page">
                <h2 class="title">Cursos</h2>
                <p>Contamos con una amplia gama de cursos, los cuales van dirigidos a personas que quieren emprender su tiempo en aprender y en especializarse en algo que les guste y les apasione. La gama de cursos que impartimos pueden ser de Desarrollo web, Diseño Gráfico y de Programación.</p>
                <p><a href="cursos.php" class="btn-full">Cursos CdG</a></p>

                <ul class="list-services">
                    <li>
                        <a href="#" class="product-list">
                            <span class="inner">
                                <img src="images/programacion.jpg" alt="" class="prod-image" />
                                <span class="title">css3 avanzado</span>
                            <span class="desc">Hojas de estilo en cascada (o CSS, siglas en inglés de Cascading Stylesheets) es un lenguaje de diseño gráfico para definir y crear la presentación de un documento estructurado escrito en un lenguaje de marcado. Es muy usado para establecer el diseño visual de las páginas web, e interfaces de usuario escritas en HTML o XHTML.</span>
                            <span class="btn-full">CSS3 avanzado</span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="product-list">
                            <span class="inner">
                                <img src="images/web.jpg" alt="" class="prod-image" />
                                <span class="title">Wordpress de 0 100</span>
                            <span class="desc">WordPress es un sistema de gestión de contenidos o CMS (por sus siglas en inglés, Content Management System) enfocado a la creación de cualquier tipo de sitio web. Originalmente alcanzó una gran relevancia usado para la creación de blogs, para convertirse con el tiempo en una de las principales herramientas para la creación de páginas web comerciales.</span>
                            <span class="btn-full">Wordpress de 0 a 100</span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="product-list">
                            <span class="inner">
                                <img src="images/grafico.jpg" alt="" class="prod-image" />
                                <span class="title">JavaScript total</span>
                            <span class="desc">JavaScript (abreviado comúnmente JS) es un lenguaje de programación interpretado, dialecto del estándar ECMAScript. Se define como orientado a objetos, basado en prototipos, imperativo, débilmente tipado y dinámico.</span>
                            <span class="btn-full">JavaScript total</span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="product-list">
                            <span class="inner">
                                <img src="images/grafico.jpg" alt="" class="prod-image" />
                                <span class="title">Bootstrap 4</span>
                            <span class="desc">Bootstrap es un framework o conjunto de herramientas de Código abierto para diseño de sitios y aplicaciones web. Contiene plantillas de diseño con tipografía, formularios, botones, cuadros, menús de navegación y otros elementos de diseño basado en HTML y CSS, así como, extensiones de JavaScript opcionales adicionales.</span>
                            <span class="btn-full">Bootstrap 4</span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="product-list">
                            <span class="inner">
                                <img src="images/programacion.jpg" alt="" class="prod-image" />
                                <span class="title">Introducción a jquery</span>
                            <span class="desc">jQuery es una biblioteca multiplataforma de JavaScript, creada inicialmente por John Resig, que permite simplificar la manera de interactuar con los documentos HTML, manipular el árbol DOM, manejar eventos, desarrollar animaciones y agregar interacción con la técnica AJAX a páginas web. Fue presentada el 14 de enero de 2006 en el BarCamp NYC</span>
                            <span class="btn-full">Introducción a Jquery</span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="product-list">
                            <span class="inner">
                                <img src="images/web.jpg" alt="" class="prod-image" />
                                <span class="title">MySQL</span>
                            <span class="desc">MySQL es un sistema de gestión de bases de datos relacional desarrollado bajo licencia dual GPL/Licencia comercial por Oracle Corporation y está considerada como la base datos open source más popular del mundo.</span>
                            <span class="btn-full">MySQL</span>
                            </span>
                        </a>
                    </li>
                    <!--<li>
                        <figure>
                            <figcaption>CSS3 Avanzado</figcaption>
                            <a href="images/web.jpg">
                                <span></span>
                                <span><i class="font-icon-zoom-in"></i></span>
                            </a>
                            <img src="images/web.jpg" alt="web">
                        </figure>
                    </li>
                    <li>
                        <figure>
                            <figcaption>Wordpress de 0 a 100</figcaption>
                            <a href="images/grafico.jpg">
                                <span></span>
                                <span><i class="font-icon-zoom-in"></i></span>
                            </a>
                            <img src="images/grafico.jpg" alt="grafico">
                        </figure>
                    </li>
                    <li>
                        <figure>
                            <figcaption>Javascript total</figcaption>
                            <a href="images/programacion.jpg">
                                <span></span>
                                <span><i class="font-icon-zoom-in"></i></span>
                            </a>
                            <img src="images/programacion.jpg" alt="programacion">
                        </figure>
                    </li>
                    <li>
                        <figure>
                            <figcaption>Bootstrap 4</figcaption>
                            <a href="images/web.jpg">
                                <span></span>
                                <span><i class="font-icon-zoom-in"></i></span>
                            </a>
                            <img src="images/programacion.jpg" alt="web">
                        </figure>
                    </li>
                    <li>
                        <figure>
                            <figcaption>Introducción a jquery</figcaption>
                            <a href="images/grafico.jpg">
                                <span></span>
                                <span><i class="font-icon-zoom-in"></i></span>
                            </a>
                            <img src="images/web.jpg" alt="grafico">
                        </figure>
                    </li>
                    <li>
                        <figure>
                            <figcaption>mysql</figcaption>
                            <a href="images/programacion.jpg">
                                <span></span>
                                <span><i class="font-icon-zoom-in"></i></span>
                            </a>
                            <img src="images/grafico.jpg" alt="programacion">
                        </figure>
                    </li>-->
                </ul>
            </section>
            <!-- Final de la seccion servicios -->

            <section id="quote" class="quote-r content position-page">
                <article class="contain-article">
                    <h2 class="title-quote">Creative Development Granada<span class="font-icon-blockquote"></span></h2>
                    <p>Creative Development Granada es una versión digital, innovadora y práctica de la academia tradicional. Un lugar donde los alumnos sin necesidad de desplazamientos asisten a clase en un campus virtual a través de videoconferencias y con la inestimable ayuda de las pizarras digitales.</p>
                </article>
            </section>
            <!-- Final de la seccion quote -->

            <section id="teacher" class="teacher content position-page">
                <article class="contain-article">
                    <h2 class="title">Nuestros profesores</h2>
                    <p>En el Creative Development Granada contratamos a los mejores docentes porque creemos que son la clave para un buen aprendizaje.
                        <br>Nuestros profesores, altamente cualificados y con muchos años de experiencia, comprenden las distintas necesidades y los intereses tanto de los niños y jóvenes como de los adultos, animan a sus alumnos a participar activamente en el proceso del aprendizaje y les ayudan a aprovechar al máximo su potencial.</p>
                    <div class="dialog-left"><img src="images/avatar_1-67b8c101e8.png">
                        <span class="pc-name font-regular">Carla Fernandez</span>
                        <div class="content-dialog">
                            <div class="content-introduce">Creo que CdG es una compañía "perfecta". Porque 'perfeccionar' significa siempre intentar lo mejor, esforzándose siempre por mejorar, siempre considerando el bienestar y el futuro de nuestros estudiantes, y siempre promoviendo un mañana mejor.</div>
                        </div>
                    </div>
                    <div class="dialog-right limpiar"><img src="images/avatar_4-7444389705.png">
                        <span class="pc-name font-regular">Sonia Caro</span>
                        <div class="content-dialog">
                            <div class="content-introduce">Cdg, excelente para aprender lo que necesitas. APUNTATE!! Veras como te encanta nuestro método de aprendizaje y adquiriras conocimientos rapidamente.</div>
                        </div>
                    </div>
                    <a href="teacher.php" class="btn2">Nuestros profesores</a>
                </article>
            </section>
            <!-- Final de la sección profesores -->

            <section id="ubication" class="ubication content position-page">
                <h2 class="title">Ubicación</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ea totam possimus maiores voluptas, beatae est accusantium fugiat aut, illum perferendis quis nihil eligendi nobis architecto, adipisci expedita magnam, consectetur inventore!</p>
                <figure class="map">
                    <img src="images/ubicacion.png" alt="ubicación">
                </figure>
            </section>
            <!-- Final de la sección de ubicación -->

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
