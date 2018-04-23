<?php 

session_start();
setcookie($_SESSION['usuario']);
if (!isset($_SESSION['usuario'])) {
    die ("<p>Para entrar en el dasboard de la aplicación debes <a href='index.php'>identificarte</a>.</p>");

}else{
    if(isset($_SESSION['usuario'])){

        if(isset($_SESSION['tipo']) && $_SESSION['tipo']=='alumno'){
            die ("<p>Los alumnos no tiene acceso a esta pagina.<a href='index.php'>Atras</a>.</p>");
        }
    }
}
include('functions.php');

if(isset($_REQUEST['operacion']) && $_REQUEST['operacion']=="buscar usuario"){
    $validarDatos=validarDatos();

    if(!$validarDatos){
        $datosUsuario = buscarUsuario();
    }
        
}
if(isset($_REQUEST['operacion']) && $_REQUEST['operacion']=="eliminar usuario"){
    $validarDatos=validarDatos();

    if(!$validarDatos){
        $borrarAlumno=borrarAlumno();
    }
        
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Eliminar Usuarios</title>
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

    <nav class="user-nav <?php if(isset($_SESSION['tipo']) && $_SESSION['tipo']=='alumno') echo "no-visible";?>">
        <a href="user-insert.php">Insertar Usuario</a>
        <a href="update-user.php">Modificar Usuario</a>
        <a href="delete-user.php" class="active">Eliminar Usuario</a>
        <a href="list-user.php">Listar Usuarios</a>
        <a href="dashboard.php">Editar Perfil</a>
    </nav>
    <nav class="user-nav <?php if(isset($_SESSION['tipo']) && $_SESSION['tipo']=='profesor') echo "no-visible";?>">
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
        <p>Sección donde se puede borrar un usuario buscando por su dni.</p>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" class="form-insert" method="post">
            <fieldset>
                
                <input type="text" placeholder="DNI del usuario a eliminar..." name="dni">
                <span class="error"><?php if(isset($validarDatos['dni'])) echo $validarDatos['dni'] ?></span>
            </fieldset>
            <input class="btn-foot" type="submit" name="operacion" value="buscar usuario">
        </form><br>
        
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-insert" method="post" enctype="multipart/form-data">
            
            <?php if(isset($borrarAlumno)) echo $borrarAlumno ?>
            <div class="dflexsa">
                <section class="column1">
                    <input type="text" placeholder="Usuario" name="usuario" value="<?php if (isset($datosUsuario['usuario'])) echo $datosUsuario['usuario'] ?>">
                    <span class="error"><?php if (isset($validarDatos['usuario'])) echo $validarDatos['usuario'] ?></span>
                </section>

                <section class="column2">
                    <input type="text" placeholder="DNI" name="dni" value="<?php if (isset($datosUsuario['dni_alumno'])) echo $datosUsuario['dni_alumno']; if (isset($datosUsuario['dni_profesor'])) echo $datosUsuario['dni_profesor'] ?>">
                    <span class="error"><?php if (isset($validarDatos['dni'])) echo $validarDatos['dni'] ?></span>
                </section>

                <section class="column3">
                    <p>Para eliminar los datos del usuario pulsa sobre eliminar usuario.</p>
                    <input class="btn-foot" type="submit" name="operacion" value="eliminar usuario">
                </section>
            </div><br>
        </form>
    </section>
</body>
</html>