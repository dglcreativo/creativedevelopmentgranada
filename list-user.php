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
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Insertar usuarios</title>
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
        <a href="delete-user.php">Eliminar Usuario</a>
        <a href="list-user.php" class="active">Listar Usuarios</a>
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
        <p>Sección desde donde se pueden ver un listado con los alumnos mregistrados y los cursos que imparten.</p>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" class="form-insert" method="post">
            <div class="radio">
                <input type="radio" name="insert-radio" value="profesor" id="profesor1">
                <label for="profesor1">Profesor</label>
                <input type="radio" name="insert-radio" value="alumno" id="alumno1">
                <label for="alumno1">Alumno</label>
            </div>                
            <input class="btn-foot" type="submit" name="operacion" value="ver listado">
        </form><br>
        <?php 

            if(isset($_REQUEST['operacion']) && $_REQUEST['operacion']=="ver listado") {
                
                if(isset($_REQUEST['insert-radio']) && $_REQUEST['insert-radio'] == "alumno"){
                    echo listarAlumno();

                }else{
                    if(isset($_REQUEST['insert-radio']) && $_REQUEST['insert-radio'] == "profesor"){
                        echo listarProfesor();

                    }else{
                        echo '<span class="error">Debes seleccionar profesores o alumnos, gracias.</span>';
                    }
                }                
            }
        ?>
    </section>
</body>
</html>