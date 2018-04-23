<?php
    session_start();
    setcookie($_SESSION['usuario']);
    //controlamos que solo los medicos y el administrador identificados puedan acceder a esta seccion
    if (!isset($_SESSION['usuario'])) {
        die("<p>Para entrar en el dasboard de la aplicación debes <a href='index.php'>identificarte</a>.</p>");
    } else {
        if (isset($_SESSION['usuario'])) {

            if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'alumno') {
                die("<p>Los alumnos no tiene acceso a esta pagina.<a href='index.php'>Atras</a>.</p>");
            }
        }
    }
    include('functions.php');
    colorFondo();  //mostramos el color elegido por el usuario en preferencias de color

    if (isset($_REQUEST['operacion'])) {

        if ($_REQUEST['operacion'] == 'buscar usuario') {
            $validarDatos = validarDatos();
            if (!$validarDatos) {
                $datosUsuario = buscarUsuario();
            }
        }

        if ($_REQUEST['operacion'] == 'modificar usuario') {
            $validarDatos = validarDatos();
            $validarImg = validarImg();
            if (!$validarDatos) {
                if(!$validarImg){
                   $mensaje = modificarUsuario();
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title>Modificar usuarios</title>
        <link rel="icon" type="image/png" href="images/logotipo.png">
        <link rel="stylesheet" href="css/estilos.css">
        <!-- Scripts -->
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/script.js"></script>
    </head>
    <body class="dashboard">
        <header>
            <h1><img src="images/logotipo-white.png" alt="Academia Creative Development Granada"></h1>
            <h4><a href="index.php">CdG</a></h4>
            <section class="drch">
                <?php 
                    if(!isset($_SESSION['usuario'])){
                        echo "<a>No has iniciado sesión</a>";
                    }else{
                        echo "<a href='index.php' class='btn-reg'><i class='font-icon-home'></i></a>";
                        echo "<a class='btn-reg'>".$_SESSION['nombre']." ".$_SESSION['apellido1']." ".$_SESSION['apellido2']." </a>";
                    }

                        echo '<a><form action="'.$_SERVER["PHP_SELF"].'"method="post">
                                    <input type="submit" class="btn-foot" name="salir" value="Salir">
                                </form></a>';
                 ?>
            </section>
        </header>

        <nav class="user-nav <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'alumno') echo "no-visible"; ?>">
            <a href="user-insert.php">Insertar Usuario</a>
            <a href="update-user.php" class="active">Modificar Usuario</a>
            <a href="delete-user.php">Eliminar Usuario</a>
            <a href="list-user.php">Listar Usuarios</a>
            <a href="dashboard.php">Editar Perfil</a>
        </nav>
        <nav class="user-nav <?php if (isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'profesor') echo "no-visible"; ?>">
            <a href="dashboard.php" class="active">Editar Perfil</a>
            <a href="my-courses.php">Mis Cursos</a>
            <a href="my-codes.php">Mis Codigos</a>
        </nav>

        <?php 

            if(isset($_SESSION['usuario'])){
                echo '<img class="img-avatar-dash btn-avatar" src="images/avatares/'.$_SESSION['foto'].'" alt="'.$_SESSION['foto'].'">';
                
            }

        ?>
        <section class="cnt">
            <p>Sección donde se puede modificar un usuario buscandolo por su dni.</p>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-insert" method="post">
                <fieldset>
                    <input type="text" placeholder="DNI del usuario a modificar..." name="dni">
                    <span class="error"><?php if (isset($validarDatos['dni'])) echo $validarDatos['dni'] ?></span>
                </fieldset>
                <input class="btn-foot" type="submit" name="operacion" value="buscar usuario">
            </form><br>
        </section>

        <section class="cnt">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-insert" method="post" enctype="multipart/form-data">
                <div class="radio">
                    <input type="radio" name="insert-radio" value="profesor" id="profesor" <?php if (isset($datosUsuario['tipo']) && $datosUsuario['tipo']== "profesor") echo 'checked' ?>>
                    <label for="profesor">Profesor</label>
                    <input type="radio" name="insert-radio" value="alumno" id="alumno" <?php if (isset($datosUsuario['tipo']) && $datosUsuario['tipo'] == "alumno") echo 'checked' ?>>
                    <label for="alumno">Alumno</label>
                </div>
                <?php
                if (isset($mensaje)){
                    echo $mensaje;
                }
                ?>
                <div class="dflexsa">
                    <section class="column1">
                        <input type="text" placeholder="Usuario" name="usuario" value="<?php if (isset($datosUsuario['usuario'])) echo $datosUsuario['usuario'] ?>">
                        <span class="error"><?php if (isset($validarDatos['usuario'])) echo $validarDatos['usuario'] ?></span>
                        <input type="password" placeholder="Contraseña" name="password" disabled value="<?php if (isset($datosUsuario['password'])) echo $datosUsuario['password'] ?>">
                        <span class="error"><?php if (isset($validarDatos['password'])) echo $validarDatos['password'] ?></span>
                        
                        <div class="file">
                            
                            <?php 
                                if(isset($datosUsuario['foto']) && $datosUsuario['foto']!=''){
                                  echo'     <input type="file" id="imgFile" name="foto" style="display:none">
                                            <img src="images/avatares/'.$datosUsuario['foto'].'" style="display:block" id="preViewImg">
                                            <input type="hidden" name="imgAntigua" id="imgAntigua" value="'.$datosUsuario['foto'].'">
                                            <input type="hidden" name="imgActual" id="imgActual" value="'.$datosUsuario['foto'].'">
                                            <a class="borrarImg"><i class="font-icon-remove"></i></a>';
                                }else{
                                    echo'   <input type="file" id="imgFile" name="foto" >
                                            <img src="#" id="preViewImg">
                                            <a class="borrarImg"><i class="font-icon-remove"></i></a>';
                                }
                            ?>
                        </div>                        
                        <span class="error"><?php if (isset($validarImg)) echo $validarImg ?></span>
                    </section>
                    
                    <section class="column2">
                        <input type="text" placeholder="DNI" name="dni" disabled value="<?php if (isset($datosUsuario['dni_alumno'])) echo $datosUsuario['dni_alumno']; if (isset($datosUsuario['dni_profesor'])) echo $datosUsuario['dni_profesor'] ?>">
                        <span class="error"><?php if (isset($validarDatos['dni'])) echo $validarDatos['dni'] ?></span>
                        <input type="hidden"name="dni" value="<?php if (isset($datosUsuario['dni_alumno'])) echo $datosUsuario['dni_alumno']; if (isset($datosUsuario['dni_profesor'])) echo $datosUsuario['dni_profesor'] ?>">
                        <input type="text" placeholder="Nombre" name="nombre"  value="<?php if (isset($datosUsuario['nombre'])) echo $datosUsuario['nombre'] ?>">
                        <span class="error"><?php if (isset($validarDatos['nombre'])) echo $validarDatos['nombre'] ?></span>
                        <input type="text" placeholder="Primer Apellido" name="apellido1" value="<?php if (isset($datosUsuario['apellido1'])) echo $datosUsuario['apellido1'] ?>">
                        <span class="error"><?php if (isset($validarDatos['apellido1'])) echo $validarDatos['apellido1'] ?></span>
                        <input type="text" placeholder="Segundo Apellido" name="apellido2" value="<?php if (isset($datosUsuario['apellido2'])) echo $datosUsuario['apellido2'] ?>">
                        <span class="error"><?php if (isset($validarDatos['apellido2'])) echo $validarDatos['apellido2'] ?></span>
                        <input type="text" placeholder="Email" name="email" value="<?php if (isset($datosUsuario['email'])) echo $datosUsuario['email'] ?>">
                        <span class="error"><?php if (isset($validarDatos['email'])) echo $validarDatos['email'] ?></span>
                        <input type="text" placeholder="Telefono" name="telefono" value="<?php if (isset($datosUsuario['telefono'])) echo $datosUsuario['telefono'] ?>">
                        <span class="error"><?php if (isset($validarDatos['telefono'])) echo $validarDatos['telefono'] ?></span>
                        <input type="text" placeholder="Provincia" name="provincia" value="<?php if (isset($datosUsuario['provincia'])) echo $datosUsuario['provincia'] ?>">
                        <span class="error"><?php if (isset($validarDatos['provincia'])) echo $validarDatos['provincia'] ?></span>
                    </section>
                    
                    <section class="column3">
                        <p>Para modificar los datos del usuario cambia los datos y pulsa sobre modificar usuario.</p>
                        <input type="submit" class="btn-foot" name="operacion" value="modificar usuario">
                    </section>
                </div><br>
            </form>
        </section> 
    </body>
</html>