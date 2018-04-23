<?php 

session_start();
if (!isset($_SESSION['usuario'])||empty($_SESSION['usuario'])) {
    die ("<p> Para entrar en esta sección debes <a href='index.php'>identificarse</a>.</p>");
}
include('functions.php');

if (isset($_REQUEST['operacion'])) {

    if ($_REQUEST['operacion'] == 'actualizar') {
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
        <title>Escritorio</title>
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
            <a href="dashboard.php" class="active">Editar Perfil</a>
            <a href="my-courses.php">Mis Cursos</a>
            <a href="my-codes.php">Mis Codigos</a>
        </nav>
        <?php 

            if(isset($_SESSION['usuario'])){
                echo '<img class="img-avatar-dash btn-avatar" src="images/avatares/'.$_SESSION['foto'].'" alt="'.$_SESSION['foto'].'">';
                
            }

        ?>
        <section class="ediPanel">
            <aside>
                <form>
                    <label>ELIGE EL COLOR DE TU PANEL</label>
                    <input name="profile-color" type="radio" value="#ffffff" id="color4" checked="checked">
                    <label for="color4" class="color4"></label>
                    
                    <input name="profile-color" type="radio" value="#ffbd04" id="color1">
                    <label for="color1" class="color1"></label>
    
                    <input name="profile-color" type="radio" value="#ff9004" id="color2">
                    <label for="color2" class="color2"></label>
    
                    <input name="profile-color" type="radio" value="#c08094" id="color3">
                    <label for="color3" class="color3"></label>
    
                    <input class="btn-profile" type="submit" name="operacion" value="guardar perfil">
                    <input type="submit" class="btn-profile" name="operacion" value="valores por defecto">
                </form>
                
            </aside>
        </section>
        <?php
            //si el usuario guarda un color, lo aplicamos y mandamos la cookie con el dato
            if(isset($_REQUEST['operacion'])&& $_REQUEST['operacion']=='guardar perfil'){
                echo "<body style='background-color:".$_REQUEST['profile-color']."'>";
                setcookie($_SESSION['usuario'],$_REQUEST['profile-color']);
                echo"<span class='errores-reg'>El color se ha guardado correctamente.</span>";

            }else{
                //si el usuario establece los valores por defecto, lo aplicamos y eliminamos la cookie
                if(isset($_REQUEST['operacion'])&& $_REQUEST['operacion']=='valores por defecto'){
                    echo "<body style='background-color:#ffffff'>";
                    setcookie($_SESSION['usuario'],false);
                    echo"<span class='errores-reg'>Se han restablecido los valores por defecto correctamente.</span>";
                }else{
                    //obtenemos el color de fondo de una sesión anterior si lo hubiera
                    colorFondo();
                }
            }
            
            if (isset($mensaje)){
                echo $mensaje;
            }
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-insert" method="post" enctype="multipart/form-data">
            <div class="dflexsa">
                <section class="column1">

                        <input type="text" placeholder="Usuario" name="usuario" value="<?php if (isset($_SESSION['usuario'])) echo $_SESSION['usuario'] ?>">
                        <div class="file">
                           <?php 
                                if(isset($_SESSION['foto']) && $_SESSION['foto']!=''){
                                  echo'     <input type="file" id="imgFile" name="foto" style="display:none">
                                            <img src="images/avatares/'.$_SESSION['foto'].'" style="display:block" id="preViewImg">
                                            <input type="hidden" name="imgAntigua" id="imgAntigua" value="'.$_SESSION['foto'].'">
                                            <input type="hidden" name="imgActual" id="imgActual" value="'.$_SESSION['foto'].'">
                                            <a class="borrarImg"><i class="font-icon-remove"></i></a>';
                                }else{
                                    echo'   <input type="file" id="imgFile" name="foto" >
                                            <img src="#" id="preViewImg">
                                            <a class="borrarImg"><i class="font-icon-remove"></i></a>';
                                }
                            ?>
                        </div>

                </section>
                <section class="column2">
                    
                    <input type="text" placeholder="Nombre" name="nombre" value="<?php if (isset($_SESSION['nombre'])) echo $_SESSION['nombre'] ?>">
                    <span class="error"><?php if (isset($validarDatos['nombre'])) echo $validarDatos['nombre'] ?></span>
                    <input type="text" placeholder="Primer Apellido" name="apellido1" value="<?php if (isset($_SESSION['apellido1'])) echo $_SESSION['apellido1'] ?>">
                    <span class="error"><?php if (isset($validarDatos['apellido1'])) echo $validarDatos['apellido1'] ?></span>
                    <input type="text" placeholder="Segundo Apellido" name="apellido2" value="<?php if (isset($_SESSION['apellido2'])) echo $_SESSION['apellido2'] ?>">
                    <span class="error"><?php if (isset($validarDatos['apellido2'])) echo $validarDatos['apellido2'] ?></span>
                    <input type="text" placeholder="Email" name="email" value="<?php if (isset($_SESSION['email'])) echo $_SESSION['email'] ?>">
                    <span class="error"><?php if (isset($validarDatos['email'])) echo $validarDatos['email'] ?></span>
                    <input type="text" placeholder="Telefono" name="telefono" value="<?php if (isset($_SESSION['telefono'])) echo $_SESSION['telefono'] ?>">
                    <span class="error"><?php if (isset($validarDatos['telefono'])) echo $validarDatos['telefono'] ?></span>
                    <input type="text" placeholder="Provincia" name="provincia" value="<?php if (isset($_SESSION['provincia'])) echo $_SESSION['provincia'] ?>">
                    <span class="error"><?php if (isset($validarDatos['provincia'])) echo $validarDatos['provincia'] ?></span>
                </section>
                <section class="column3">
                   <p>Para actualizar tu perfil de usuario rellena los campos y aztualizalos.</p>

                       <input type="submit" class="btn-foot" name="operacion" value="actualizar">

                    <p>Si ya no deseas seguir con nosotros, por favor elimina tu cuenta, esperamos que te hayan servido nuestros cursos para tu formación.</p>

                        <input type="submit" class="btn-foot" value="Eliminar cuenta">

                </section>
            </div>
        </form>
    </body>

    </html>
