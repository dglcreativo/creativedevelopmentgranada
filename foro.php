<?php
session_start();
if (!isset($_SESSION['usuario'])||empty($_SESSION['usuario'])) {
    die ("<p> Para entrar en esta sección debes <a href='index.php'>identificarse</a>.</p>");
}
include('functions.php');
?>

<!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <title>Foro</title>
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
            <a href="delete-user.php">Eliminar Usuario</a>
            <a href="list-user.php">Listar Usuarios</a>
            <a href="dashboard.php" class="active">Editar Perfil</a>
        </nav>
        <nav class="user-nav <?php if(isset($_SESSION['tipo']) && $_SESSION['tipo']=='profesor') echo "no-visible";?>">
            <a href="dashboard.php">Editar Perfil</a>
            <a href="my-courses.php">Mis Cursos</a>
            <a href="my-codes.php">Mis Codigos</a>
        </nav>
        <?php 

            if(isset($_SESSION['usuario'])){
                echo '<img class="img-avatar-dash btn-avatar" src="images/avatares/'.$_SESSION['foto'].'" alt="'.$_SESSION['foto'].'">';
                
            }

        ?>
        <section class="cnt">
            <ul class="">
                <li><a href="add-message.php" class="btn-foot">Crear mensaje</a></li>
                <li><a href="board.php" class="btn-foot">Ver los mensajes</a></li>
            </ul>
        </section>
    </body>
    </html>

