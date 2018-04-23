<?php
    session_start();
    setcookie($_SESSION['usuario']);
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

    if (isset($_REQUEST['operacion']) && $_REQUEST['operacion'] == "insertar usuario") {
        $validarDatos = validarDatos();
        $validarImg = validarImg();

        if (!$validarDatos) {
            if (!$validarImg) {
                $guardar = guardarUsuario();
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title>Insertar usuarios</title>
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
            <a href="user-insert.php" class="active">Insertar Usuario</a>
            <a href="update-user.php">Modificar Usuario</a>
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

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-insert" method="post" enctype="multipart/form-data">
            <div class="radio">
                <input type="radio" name="insert-radio" value="profesor" id="profesor">
                <label for="profesor">Profesor</label>
                <input type="radio" name="insert-radio" value="alumno" id="alumno" checked>
                <label for="alumno">Alumno</label>
            </div>
        <?php
        if (isset($guardar))
            echo $guardar;
        ?>
            <div class="dflexsa">
                <section class="column1">
                    <input type="text" placeholder="Usuario" name="usuario">
                    <span class="error"><?php if (isset($validarDatos['usuario'])) echo $validarDatos['usuario'] ?></span>
                    <input type="password" placeholder="Contraseña" name="password">
                    <span class="error"><?php if (isset($validarDatos['password'])) echo $validarDatos['password'] ?></span>
                    <div class="file">
                        <input type="file" id="imgFile" name="foto">
                        <img src="#" alt="" id="preViewImg">
                        <a class="borrarImg"><i class="font-icon-remove"></i></a>
                    </div>
                    <span class="error"><?php if (isset($validarImg)) echo $validarImg ?></span>
                </section>
                <section class="column2">
                    <input type="text" placeholder="DNI" name="dni">
                    <span class="error"><?php if (isset($validarDatos['dni'])) echo $validarDatos['dni'] ?></span>
                    <input type="text" placeholder="Nombre" name="nombre">
                    <span class="error"><?php if (isset($validarDatos['nombre'])) echo $validarDatos['nombre'] ?></span>
                    <input type="text" placeholder="Primer Apellido" name="apellido1">
                    <span class="error"><?php if (isset($validarDatos['apellido1'])) echo $validarDatos['apellido1'] ?></span>
                    <input type="text" placeholder="Segundo Apellido" name="apellido2">
                    <span class="error"><?php if (isset($validarDatos['apellido2'])) echo $validarDatos['apellido2'] ?></span>
                    <input type="text" placeholder="Email" name="email">
                    <span class="error"><?php if (isset($validarDatos['email'])) echo $validarDatos['email'] ?></span>
                    <input type="text" placeholder="Telefono" name="telefono">
                    <span class="error"><?php if (isset($validarDatos['telefono'])) echo $validarDatos['telefono'] ?></span>
                    <input type="text" placeholder="Provincia" name="provincia">
                    <span class="error"><?php if (isset($validarDatos['provincia'])) echo $validarDatos['provincia'] ?></span>
                </section>
                <section class="column3">
                    <p>Para insertar nuevos usuarios en nuestro centro, ya sean profesores o alumnos, rellena los campos del formulario e inserta el usuario.</p>
                    <input type="submit" class="btn-foot" name="operacion" value="insertar usuario">
                </section>
            </div><br>
        </form>
    </body>
</html>