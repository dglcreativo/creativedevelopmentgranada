<?php 
    require_once('include/Bd.php');
    require_once('include/Alumno.php');
    require_once('include/Profesor.php');
    require_once('include/Curso.php');
    require_once('include/Foro.php');

    /*Función que comprueba si existe una cookie de una sesión anterior para aplicar el color guardado en la cookie*/
    function colorFondo(){
        //si la sesión existe comprobamos la cookie
        if(isset($_SESSION['usuario'])){
            $login=$_SESSION['usuario'];
            if(isset($_COOKIE[$login])){
                echo $color="<body style='background-color:".$_COOKIE[$login]."'>";
            }else{
                echo $color="<body style='background-color:#ffffff'>";
            }
        }
    }

    /*Función que...

    */
    function borrarAlumno(){
        $respuesta = "";

        try {
            $dni = $_REQUEST['dni'];
            $alumno = new Alumno($dni);
            $foto=Bd::consultaFotoAlumno($alumno);
            if(Bd::eliminarAlumnos($alumno)){
                $img="images/avatares/".$foto['foto'];
                //eliminamos la imagen del servidor
                unlink($img);
                $respuesta = "<span class='error'>El alumno se ha eliminado correctamente</span>";
            }else{
                $respuesta = "<span class='error'>El alumno no se ha eliminado correctamente</span>";
            } 
        } catch (Exception $e) {
            $respuesta=$e->getMessage();
        }
        return $respuesta;
    }

    /*Función que

    */
    function buscarUsuario(){
        $respuesta = '';

        try {
            $dni = $_REQUEST['dni'];
            $alumno = new Alumno($dni);
            $profesor = new Profesor($dni);

            if($buscoAlumno = Bd::consultaAlumnoDni($alumno)){
               $respuesta = $buscoAlumno;

            }else{
                $buscoProfesor = Bd::consultaProfesorDni($profesor);
                $respuesta = $buscoProfesor; 
            }

        } catch (Exception $e) {
            $respuesta=$e->getMessage();
        }

        return $respuesta;
    }

    /* función que obtiene los datos de todos los comerciales, monta la tabla en la que se muestran los datos y
     * botones modificar y eliminar con su evento onclick que llama a la funcion js correspondiente
     * todo esto lo asigna a la etiqueta html con id listar, en el caso haber un error asignará el texto del error
    */
    function listarAlumno(){
        $linea = "";

        try {
            
            if($alumnos = Bd::consultaAlumnos()){
                $linea.='   <table class="ls"><tr class="lsfile-th">
                                <td class="celda-th">DNI</td>
                                <td class="celda-th">Usuario</td>
                                <td class="celda-th">Nombre</td>
                                <td class="celda-th">Primer Apellido</td>
                                <td class="celda-th">Segundo Apellido</td>
                                <td class="celda-th">Email</td>
                            </tr>';

            foreach($alumnos as $alumno){
                $linea.='   <tr class="lsfile">
                                <td class="celda">'.$alumno[0].'</td>
                                <td class="celda">'.$alumno[1].'</td>
                                <td class="celda">'.$alumno[4].'</td>
                                <td class="celda">'.$alumno[5].'</td>
                                <td class="celda">'.$alumno[6].'</td>
                                <td class="celda">'.$alumno[7].'</td>
                            </tr>';
                }
                $linea .= "</table>";
                $respuesta=$linea;
            }
        } catch (Exception $e) {
            $respuesta=$e->getMessage();
        }
        return $respuesta;
    }

    /* función que obtiene los datos de todos los comerciales, monta la tabla en la que se muestran los datos y
     * botones modificar y eliminar con su evento onclick que llama a la funcion js correspondiente
     * todo esto lo asigna a la etiqueta html con id listar, en el caso haber un error asignará el texto del error
    */
    function listarProfesor(){
        $linea = "";

        try {

            if($profesores = Bd::consultaProfesores()){
                $linea.='   <table class="ls"><tr class="lsfile-th">
                                <td class="celda-th">DNI</td>
                                <td class="celda-th">Usuario</td>
                                <td class="celda-th">Nombre</td>
                                <td class="celda-th">Primer Apellido</td>
                                <td class="celda-th">Segundo Apellido</td>
                                <td class="celda-th">Email</td>
                            </tr>';

            foreach($profesores as $profesor){
                $linea.='   <tr class="lsfile">
                                <td class="celda">'.$profesor[0].'</td>
                                <td class="celda">'.$profesor[1].'</td>
                                <td class="celda">'.$profesor[4].'</td>
                                <td class="celda">'.$profesor[5].'</td>
                                <td class="celda">'.$profesor[6].'</td>
                                <td class="celda">'.$profesor[7].'</td>
                            </tr>';
                }
                $linea .= "</table>";
                $respuesta=$linea;
            }
        } catch (Exception $e) {
            $respuesta=$e->getMessage();
        }
        return $respuesta;
    }

    /* Función que inicia la sesión en caso de ser usuario invitado y en el caso del usuario registrado
     * comprueba el usuario y la contraseña del usuario con la BBDD y si son correctos inicia la sesión
     * retorna un string con el texto del error en el caso de producirse, sino devuelve una cadena vacía */
    function validarUsuario(){

        $error="";
        // Comprobamos si ya se ha enviado el formulario
        if (isset($_REQUEST['operacion']) && $_REQUEST['operacion']=="entrar") {
            
            //recogemos los datos
            $usuario = $_REQUEST['usuario'];
            $password = $_REQUEST['password'];

            //si el usuario deja el formulario en blanco
            if (empty($usuario) || empty($password)) {
                $error = "Debes identificarte o registrarte.";
            }else {
                // Comprobamos los datos con la bbdd
                try{
                
                    $usuAlumno = new Alumno();
                    $usuAlumno->setUsuario($usuario);

                    $usuProfesor = new Profesor();
                    $usuProfesor->setUsuario($usuario);

                    if ($usu = Bd::compruebAlumno($usuAlumno)) {

                    } else {
                        $usu = Bd::compruebaProfesor($usuProfesor);
                    }

                    if($usu){

                        if(password_verify($password, $usu['password'])){
                            //session_start();
                            
                            if($usu['tipo'] == "alumno"){
                                $fila = Bd::compruebaRestoAlumno($usuAlumno);
                                $_SESSION['usuario']=$fila['usuario'];
                                $_SESSION['dniAlumno']=$fila['dni_alumno'];
                            } else{
                                if($usu['tipo'] == "profesor"){
                                    $fila = Bd::compruebaRestoProfesor($usuProfesor);
                                    $_SESSION['usuario']=$fila['usuario'];
                                    $_SESSION['dniProfesor']=$fila['dni_profesor'];
                                }
                                
                            }

                            $_SESSION['tipo']=$fila['tipo'];
                            $_SESSION['nombre']=$fila['nombre'];
                            $_SESSION['apellido1']=$fila['apellido1'];
                            $_SESSION['apellido2']=$fila['apellido2'];
                            $_SESSION['email']=$fila['email'];
                            $_SESSION['telefono']=$fila['telefono'];
                            $_SESSION['provincia']=$fila['provincia'];
                            $_SESSION['foto']=$fila['foto'];
                            

                            header("Location: index.php");
                        } else{
                            $error = "Usuario o contraseña no válidos";
                        }
                    } else{
                        $error = "No existe el usuario";
                    }

                } catch (Exception $e){
                    echo "Ha ocurrido un error y no se ha podido conectar con la base de datos2";
                }
            }
        }
        return $error;
    }

    //si la sesión existe y pinchamos en salir
    if(isset($_SESSION['usuario'])){
        if(isset($_REQUEST['salir'])&& $_REQUEST['salir']=='Salir'){

        // Recuperamos la información de la sesión
        session_start();
        // la eliminamos y redirigimos a index
        session_unset();
        header("Location: index.php");
        }
    }

    function guardarAlumnoIndex(){
        $dni = trim($_REQUEST['dni']);
        $usuario = trim($_REQUEST['usuario']);
        $password = trim($_REQUEST['password']);
        $tipo = $_REQUEST['insert-radio'];
        $email = trim($_REQUEST['email']);
        $foto = trim($_FILES['foto']['name']);

        $fotoTemporal = $_FILES['foto']['tmp_name'];

        if($_REQUEST['insert-radio'] == "alumno"){

            try{
                $nuevoAlumno = new Alumno();
                $nuevoAlumno->setDniAlumno($dni);
                $nuevoAlumno->setUsuario($usuario);
                $nuevoAlumno->setPassword($password);
                $nuevoAlumno->setTipo($tipo);
                $nuevoAlumno->setEmail($email);
                $nuevoAlumno->setFoto($foto);
                if(Bd::guardarAlumno($nuevoAlumno)){
                    move_uploaded_file($fotoTemporal,"images/avatares/" . $foto);
                    $respuesta="El usuario se ha registrado correctamente";
                }else{
                    $respuesta="El usuario no se ha podido registrar.";
                }

            }catch(Exception $e){
                $respuesta=$e->getMessage();
            }
        }
        return $respuesta;
    }
    
    //Funcion que registra al usuario en la bd desde el panel de administración
    function guardarUsuario(){
        $dni = trim($_REQUEST['dni']);
        $usuario = trim($_REQUEST['usuario']);
        $password = trim($_REQUEST['password']);
        $tipo = trim($_REQUEST['insert-radio']);
        $nombre = trim($_REQUEST['nombre']);
        $apellido1 = trim($_REQUEST['apellido1']);
        $apellido2 = trim($_REQUEST['apellido2']);
        $email = trim($_REQUEST['email']);
        $telefono = trim($_REQUEST['telefono']);
        $provincia = trim($_REQUEST['provincia']);
        $foto = trim($_FILES['foto']['name']);
        $fotoTemporal = $_FILES['foto']['tmp_name'];
        
        if($_REQUEST['insert-radio'] == "alumno"){

            try{
                $nuevoAlumno = new Alumno($dni,$usuario,$password,$tipo,$nombre,$apellido1,$apellido2,$email,$telefono,$provincia,$foto);
                if(Bd::guardarAlumno($nuevoAlumno)){
                    move_uploaded_file($fotoTemporal,"images/avatares/" . $foto);
                    $respuesta="<span class='error'>El alumno se ha registrado correctamente</span>";
                }else{
                    $respuesta="<span class='error'>El usuario no se ha podido registrar</span>";
                }

            }catch(Exception $e){
                $respuesta=$e->getMessage();
            }
           
        } else{
            try{
                $nuevoProfesor = new Profesor($dni,$usuario,$password,$tipo,$nombre,$apellido1,$apellido2,$email,$telefono,$provincia,$foto);
                if(Bd::guardarProfesor($nuevoProfesor)){
                    move_uploaded_file($fotoTemporal,"images/avatares/" . $foto);
                    $respuesta="<span class='error'>El profesor se ha registrado correctamente</span>";
                }else{
                    $respuesta="<span class='error'>El usuario no se ha podido registrar</span>";
                }

            }catch(Exception $e){
                $respuesta=$e->getMessage();
            }
        }

        return $respuesta;
        
    }
    
    //Funcion que registra al usuario en la bd desde el panel de administración
    function modificarUsuario(){
        //si estamos editando
        $actualizaSesion=true;
        if(isset($_SESSION['dniProfesor'])){
            $dni=trim($_SESSION['dniProfesor']);
        }
        if(isset($_SESSION['dniAlumno'])){
            $dni=trim($_SESSION['dniAlumno']);
        }
        
        $tipo = trim($_SESSION['tipo']);
        
        //si estamos modificando
        if(isset($_REQUEST['dni'])){
            $dni=trim($_REQUEST['dni']);
            $tipo = trim($_REQUEST['insert-radio']);
            $actualizaSesion=false;
        }
        
        //comun a editar y modificar
        $usuario = trim($_REQUEST['usuario']);
        $nombre = trim($_REQUEST['nombre']);
        $apellido1 = trim($_REQUEST['apellido1']);
        $apellido2 = trim($_REQUEST['apellido2']);
        $email = trim($_REQUEST['email']);
        $telefono = trim($_REQUEST['telefono']);
        $provincia = trim($_REQUEST['provincia']);
        
        $foto = '';
        $fotoTemporal = '';
        
        $actualizaUsuario=false;
        
        //Si escogemos una magen nueva
        if(isset($_FILES['foto']) && $_FILES['foto']['name'] != ""){
            $foto = trim($_FILES['foto']['name']);
            $fotoTemporal = $_FILES['foto']['tmp_name'];
        }
        
        //si mantenemos la imagen anterior y no cambiamos la img
        if(isset($_REQUEST['imgActual']) && $_REQUEST['imgActual']!=''){
            $foto = trim($_REQUEST['imgActual']);
        }
        
        //Si teniamos una imagen anteriormente guardada 
        if(isset($_REQUEST['imgAntigua']) && $_REQUEST['imgAntigua']!=''){
            $archivoBorrar="images/avatares/".$_REQUEST['imgAntigua'];
        }
        
        if($tipo == "alumno"){
            try{
                $alumno = new Alumno($dni,$usuario,$tipo,$nombre,$apellido1,$apellido2,$email,$telefono,$provincia,$foto);
                if(Bd::editarAlumno($alumno)){
                    $actualizaUsuario=true;
                    $respuesta="<span class='error'>El alumno se ha modificado correctamente</span>";
                }else{
                    $respuesta="<span class='error'>El alumno no se ha podido modificar</span>";
                }

            }catch(Exception $e){
                $respuesta=$e->getMessage();
            }
           
        } else{
            try{
                $nuevoProfesor = new Profesor($dni,$usuario,$tipo,$nombre,$apellido1,$apellido2,$email,$telefono,$provincia,$foto);
                if(Bd::editarProfesor($nuevoProfesor)){
                    //si se modifica el profesor de la sesion actualizamos la sesion
                    if($dni==$_SESSION['dniProfesor']){
                        $actualizaSesion=true;
                    }
                    $actualizaUsuario=true;
                    $respuesta="<span class='error'>El profesor se ha registrado correctamente</span>";
                }else{
                    $respuesta="<span class='error'>El profesor no se ha podido registrar</span>";
                }

            }catch(Exception $e){
                $respuesta=$e->getMessage();
            }
        }
        
        //si se han actualizado los datos, actualizamos la imagen
        if($actualizaUsuario){
            if(isset($_REQUEST['imgActual']) && $_REQUEST['imgActual']=='' && $_REQUEST['imgAntigua']){
                unlink($archivoBorrar);
            }

            if(isset($_FILES['foto']) && $_FILES['foto']['name'] != ""){
                move_uploaded_file($fotoTemporal,"images/avatares/" . $foto);
            }
            
            //si estamos editando actualizamos la sesion
            if($actualizaSesion){
                $_SESSION['usuario']=$usuario;
                $_SESSION['nombre']=$nombre;
                $_SESSION['apellido1']=$apellido1;
                $_SESSION['apellido2']=$apellido2;
                $_SESSION['email']=$email;
                $_SESSION['telefono']=$telefono;
                $_SESSION['provincia']=$provincia;
                $_SESSION['foto']=$foto;
            }
        }

        return $respuesta;
    }

    function validarImg(){

        $respuesta = false;

        if(isset($_FILES['foto']) && $_FILES['foto']['name'] != ""){

            if(strlen($_FILES['foto']['name'])<=35){
                //ahora cogemos los datos de la imagen
                $nombreFoto = $_FILES['foto']['name'];
                $nombreTemporal = $_FILES['foto']['tmp_name'];
                $tipoFoto = $_FILES['foto']['type'];
                $tamanoFoto = $_FILES['foto']['size'];

                /* definimos las extensiones que se van a permitir, dividimos el nombre del archivo y obtenemos la ultima parte que en su defecto es la extension del archivo*/
                $extPermitidas = array('jpg','jpeg','gif','png');
                $partesNombre = explode('.', $nombreFoto);
                $ext = end($partesNombre);

                //comprobamos que la extension se encuenta entre las extensiones permitidas y que el tipo del archivo es correcto
                $extCorrecta = in_array($ext, $extPermitidas);
                $tipoCorrecto = preg_match('/^image\/(pjpeg|jpeg|gif|png)$/', $tipoFoto);
                
                $limitArchivo = 1024 * 1024; //1MB

                // si todo es correcto
                if( $extCorrecta && $tipoCorrecto && $tamanoFoto <= $limitArchivo ){
                
                    //si existe algun error. $_FILES['']['error'] devuelve 0 si todo es correcto, de lo contrario devuelve el error
                    if($_FILES['foto']['error'] > 0 ){
                        $respuesta=$_FILES['foto']['error'];
                    }else{ 
                        //si todo es correcto, comprobamos si el archivo existe, sino existe guardamos el archivo en la ubicacion
                        if( file_exists( 'images/avatares/'.$nombreFoto) ){
                            $respuesta="El archivo ".$nombreFoto." existe";
                        }
                    }
                }else{
                    $respuesta="Archivo no es correcto";
                }
            }else{
                $respuesta="Nombre del archivo es muy largo";
            }
        }

        return $respuesta;
    }
    
    /**
     * FunciÃ³n que valida el nÃºmero de carracteres que contiene el mensaje del foro.
     */
    function validarMensaje(){
        $respuesta = false;
        
        if(isset($_REQUEST['contenido'])){
            if($_REQUEST["contenido"]=="" || strlen($_REQUEST['contenido']) > 500){
                $respuesta['contenido'] = 'El mensaje no puede estar vacio o contener mÃ¡s de 500 caracteres.';
            }
        }
        return $respuesta;
    }
    
    /**
     * FunciÃ³n que guarda el mensaje en la bbdd
     */
    function guardarMensaje(){
        $cod_curso = 'mysql01';
        $autor = $_SESSION['usuario'];
        $fecha = date("Y-m-d");
        $titulo = trim($_REQUEST['titulo']);
        $contenido = trim($_REQUEST['contenido']);
            try{
                $nuevoMensaje = new Foro($autor, $fecha, $titulo, $contenido);
                $curso = new Curso($cod_curso);
                if(Bd::insertaMensaje($nuevoMensaje,$curso)){
                    $respuesta="<span class='error'>El mensaje se ha guardado correctamente</span>";
                }else{
                    $respuesta="<span class='error'>El mensaje no se ha podido guardar</span>";
                }

            }catch(Exception $e){
                $respuesta=$e->getMessage();
            }
        return $respuesta;
    }
    
    /**
     * FunciÃ³n que listar todos los mensajes que hay registrados
     */
    function listarMensajes(){
        $linea = "";

        try {

            if($mensajes = Bd::consultaMensajes()){
                
                foreach($mensajes as $mensaje){
                    $linea.='   <div class="tabla-mensajes">
                                    <div class="uno">Usuario: '.$mensaje[1].'<div class="dos">Fecha: '.$mensaje[3].'</div></div>
                                    <div class="cuatro">'.$mensaje[4].'</div>
                                    <div class="tres">'.$mensaje[5].'</div>
                                </div>';
                }
                
                $respuesta=$linea;
            }
        } catch (Exception $e) {
            $respuesta=$e->getMessage();
        }
        return $respuesta;
    }


    /* Función que comprueba que los valores introducidos por teclado en el formulario sean correctos
     * si no hay ningún error devolvera false, de los contrario devolvera un array con los errores concretos
     * Recibe  parámetros con los datos del articulo 
     * Retorna false o un array con los errores.  
     */
    function validarDatos(){
        $respuesta=false;
        
    //controlamos que el código no este vacío y que tenga 3 dígitos
        if(isset($_REQUEST['dni'])){

            if($_REQUEST['dni']==""){
                $respuesta['dni']="El DNI no puede estar vacio";  

            }else{
                $dni = $_REQUEST['dni'];
                $letra = substr($dni, -1);
                $numeros = substr($dni, 0, -1);

                if (substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros%23, 1) == $letra && strlen($letra) == 1 && strlen ($numeros) == 8 ){
                    
                }else{
                    $respuesta['dni'] = "El DNI no es correcto, la letra tiene que ser mayúscula";
                }
            }
        }

        if(isset($_REQUEST['password']) && $_REQUEST['password']==""){
            $respuesta['password']="La contraseña no puede estar vacia";     
        }

        if(isset($_REQUEST['usuario']) && $_REQUEST['usuario']==""){
            $respuesta['usuario']="El usuario no puede estar vacio";     
        }else{
            if(isset($_REQUEST['usuario'])){
                if (!preg_match("/^[a-zA-Z0-9\-_]{3,12}$/", $_REQUEST['usuario'])) {
                    $respuesta['usuario'] = "El usuario debe contenidor de 3 a 12 caracteres";
                }
            }
            
        }

        if(isset($_REQUEST['nombre']) && $_REQUEST['nombre']==""){
            $respuesta['nombre']="El nombre no puede estar vacio";     
        }else{
            if(isset($_REQUEST['nombre'])){
                if (!preg_match("/^[a-zA-Z\-_]{2,30}$/", $_REQUEST['nombre'])) {
                    $respuesta['nombre'] = "El nombre no es correcto";
                }
            }
            
        }

        if(isset($_REQUEST['apellido1']) && $_REQUEST['apellido1']==""){
            $respuesta['apellido1']="El primer apellido no puede estar vacio";     
        }else{
            if(isset($_REQUEST['apellido1'])){
                if (!preg_match("/^[a-zA-Z\-_]{2,30}$/", $_REQUEST['apellido1'])) {
                    $respuesta['apellido1'] = "El primer apellido no es correcto";
                }
            }
        }

        if(isset($_REQUEST['apellido2']) && $_REQUEST['apellido2']==""){
            $respuesta['apellido2']="El segundo apellido no puede estar vacio";     
        }else{
            if(isset($_REQUEST['apellido2'])){
                if (!preg_match("/^[a-zA-Z\-_]{2,30}$/", $_REQUEST['apellido2'])) {
                    $respuesta['apellido2'] = "El segundo apellido no es correcto";
                }
            }
            
        }

        if(isset($_REQUEST['email']) && $_REQUEST['email']==""){
            $respuesta['email']="El correo electrónico no puede estar vacio";     
        }else{
            if(isset($_REQUEST['email'])){
                $patron="/^(.+\@.+\..+)$/";
                if(!preg_match($patron, $_REQUEST['email'])){
                    $respuesta['email'] = "El email no es correcto";
                }
            }
        }

        if(isset($_REQUEST['telefono']) && $_REQUEST['telefono']==""){
            $respuesta['telefono']="El telefono no puede estar vacio";     
        }else{
            if(isset($_REQUEST['telefono'])){
                $patron="/^[0-9\-_]{9}$/";
                if (!preg_match($patron, $_REQUEST['telefono'])) {
                    $respuesta['telefono'] = "El telefono no es correcto";
                }
            }
        }

        if(isset($_REQUEST['provincia']) && $_REQUEST['provincia']==""){
            $respuesta['provincia']="La provincia no puede estar vacia";     
        }else{
            if(isset($_REQUEST['provincia'])){
                $patron= "/^[a-zA-Z\-_]{2,30}$/";
                if (!preg_match($patron, $_REQUEST['provincia'])) {
                    $respuesta['provincia'] = "La provincia no es correcta";
                }
            }
        }

        return $respuesta;
    }
    
    /**
     */
    function listarCursosAlumno(){
        $respuesta = '';

        try {
            $dni=$_SESSION['dniAlumno'];
            $alumno=new Alumno($dni);
            if($cursos=Bd::consultaCursosAlumno($alumno)){
                foreach ($cursos as $curso){
                    $respuesta.= '  <section>
                                        <h2>'.$curso['nombre'].'</h2>
                                        <p>Programa del curso</p>
                                        <p>Contenido el curso</p>
                                        <div class="foro">
                                            <a class="btn-foot" href="foro.php?curso='.$curso['cod_curso'].'">Foro</a>
                                        </div>
                                    </section>';
                }
                
            }else{
                $respuesta="No estas matriculado en ningún curso";
            }

        } catch (Exception $e) {
            $respuesta=$e->getMessage();
        }

        return $respuesta;
    }
    
    function selectCursos(){
        $respuesta = '';

        try {
            if($cursos=Bd::consultaCursos()){
                foreach ($cursos as $curso){
                    $respuesta.= '<option value="'.$curso['cod_curso'].'">'.$curso['nombre'].'</option>';
                }
            }else{
                $respuesta="No hay cursos donde matricularte";
            }

        } catch (Exception $e) {
            $respuesta=$e->getMessage();
        }

        return $respuesta;
        
    }
    
    function matricularse(){
        try {
            $respuesta = '';
            $dni=$_SESSION['dniAlumno'];
            $codigoCurso=$_REQUEST['curso'];
            $alumno=new Alumno($dni);
            $curso=new Curso($codigoCurso);

            if(Bd::matricularAlumno($alumno,$curso)){
                $respuesta="Te has matriculado correctamente en el curso";
            }else{
                $respuesta="No ha sido posible matriculate en el curso, revisa si ya estas matriculado";
            }
        } catch (Exception $e) {
            $respuesta=$e->getMessage();
        }
        return $respuesta;
    }
?>
