<?php

class Bd {
    /* Función para realizar la conexión con la base de datos, establecemos que los datos 
     * de la BBDD los obtengamos en utf-8 y habilitamos las excepciones */

    protected static function conexion() {
        try {
            $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
            $conexion = new PDO('mysql:host=localhost;dbname=creativedevelopmentgranada', 'root', '', $opciones);
            //$conexion = new PDO('mysql:host=mysql.hostinger.es;dbname=u129677433_cdg', 'u129677433_cdg', 'creativeGranada', $opciones);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conexion;
        } catch (PDOException $e) {
            echo "<p class='error'>Ha ocurrido un error y no se ha podido conectar con la base de datos. <a href='index.php'>Volver</a></p>";
        }
    }

    public static function compruebAlumno($alumno) {
        $usuario = $alumno->getUsuario();

        try {

            $valor = false;
            $sql = "SELECT password, tipo FROM alumno WHERE usuario = '$usuario'";
            $conexion = self::conexion();
            $resultado = $conexion->query($sql);

            //si la consulta tiene resultados es que el cliente existe
            if ($registro = $resultado->fetch()) {
                $valor = $registro;
            }
        } catch (PDOException $e) {
            throw new Exception("Ha ocurrido un error y no se ha podido consultar el alumno");
        }

        return $valor;
    }

    public static function compruebaProfesor($profesor) {
        $usuario = $profesor->getUsuario();

        try {

            $valor = false;
            $sql = "SELECT password, tipo FROM profesor WHERE usuario = '$usuario'";
            $conexion = self::conexion();
            $resultado = $conexion->query($sql);

            //si la consulta tiene resultados es que el cliente existe
            if ($registro = $resultado->fetch()) {
                $valor = $registro;
            }
        } catch (PDOException $e) {
            throw new Exception("Ha ocurrido un error y no se ha podido consultar el profesor");
        }

        return $valor;
    }

    public static function compruebaRestoAlumno($alumno) {
        $usuario = $alumno->getUsuario();

        try {

            $valor = false;
            $sql = "SELECT dni_alumno, usuario, tipo, nombre, apellido1, apellido2, email, telefono, provincia, foto FROM alumno WHERE usuario = '$usuario'";
            $conexion = self::conexion();
            $resultado = $conexion->query($sql);

            //si la consulta tiene resultados es que el alumno existe
            if ($registro = $resultado->fetch()) {
                $valor = $registro;
            }
        } catch (PDOException $e) {
            throw new Exception("Ha ocurrido un error y no se ha podido consultar los datos del alumno");
        }

        return $valor;
    }

    public static function compruebaRestoProfesor($profesor) {
        $usuario = $profesor->getUsuario();

        try {

            $valor = false;
            $sql = "SELECT dni_profesor, usuario, tipo, nombre, apellido1, apellido2, email, telefono, provincia, foto FROM profesor WHERE usuario = '$usuario'";
            $conexion = self::conexion();
            $resultado = $conexion->query($sql);

            //si la consulta tiene resultados es que el profesor existe
            if ($registro = $resultado->fetch()) {
                $valor = $registro;
            }
        } catch (PDOException $e) {
            throw new Exception("Ha ocurrido un error y no se ha podido consultar los datos del profesor");
        }

        return $valor;
    }

    /* Función que realiza una consulta todos los alumnos
      Retorna los datos delos alumnos de la BBDD y false si no existen datos */

    public static function consultaAlumnos() {

        try {
            $valor = false;
            $sql = "SELECT * FROM alumno";
            $conexion = self::conexion();
            $resultado = $conexion->query($sql);

            //si la consulta tiene resultados
            if ($resultado) {
                while ($registro = $resultado->fetch()) {
                    $valor[] = $registro;
                }
            }
        } catch (PDOException $e) {
            throw new Exception("Error al consultar, no se pueden mostrar los alumnos");
        }
        return $valor;
    }

    /* Función que realiza una consulta un alumno por su dni
      Retorna los datos delos alumnos de la BBDD y false si no existen datos */

    public static function consultaAlumnoDni($alumno) {
        $dni = $alumno->getDniAlumno();

        try {
            $valor = false;
            $sql = "SELECT * FROM alumno WHERE dni_alumno = '$dni'";
            $conexion = self::conexion();
            $resultado = $conexion->query($sql);

            //si la consulta tiene resultados
            if ($resultado) {
                while ($registro = $resultado->fetch()) {
                    $valor = $registro;
                }
            }
        } catch (PDOException $e) {
            throw new Exception("Error al consultar, no se pueden mostrar el alumno");
        }
        return $valor;
    }

    /* Función que realiza una consulta todos los profesores
      Retorna los datos delos alumnos de la BBDD y false si no existen datos */

    public static function consultaProfesores() {

        try {
            $valor = false;
            $sql = "SELECT * FROM profesor";
            $conexion = self::conexion();
            $resultado = $conexion->query($sql);

            //si la consulta tiene resultados
            if ($resultado) {
                while ($registro = $resultado->fetch()) {
                    $valor[] = $registro;
                }
            }
        } catch (PDOException $e) {
            throw new Exception("Error al consultar, no se pueden mostrar los profesores");
        }
        return $valor;
    }

    /* Función que realiza una consulta un profesor por su dni
      Retorna los datos delos alumnos de la BBDD y false si no existen datos */

    public static function consultaProfesorDni($profesor) {
        $dni = $profesor->getDniProfesor();

        try {
            $valor = false;
            $sql = "SELECT * FROM profesor WHERE dni_profesor = '$dni'";
            $conexion = self::conexion();
            $resultado = $conexion->query($sql);

            //si la consulta tiene resultados
            if ($resultado) {
                while ($registro = $resultado->fetch()) {
                    $valor = $registro;
                }
            }
        } catch (PDOException $e) {
            throw new Exception("Error al consultar, no se pueden mostrar el profesor");
        }
        return $valor;
    }

    //función que guarda a un alumno en la base de datos
    public static function guardarAlumno($alumno) {
        $dni = $alumno->getDniAlumno();
        $usuario = $alumno->getUsuario();
        $password = $alumno->getPassword();
        $passwordEncript = crypt($password, '$dgl');
        $tipo = $alumno->getTipo();
        $nombre = $alumno->getNombre();
        $apellido1 = $alumno->getApellido1();
        $apellido2 = $alumno->getApellido2();
        $email = $alumno->getEmail();
        $telefono = $alumno->getTelefono();
        $provincia = $alumno->getProvincia();
        $foto = $alumno->getFoto();

        try {
            $sql = "INSERT INTO alumno(dni_alumno, usuario, password, tipo, nombre, apellido1, apellido2, email, telefono, provincia, foto) VALUES ('$dni', '$usuario', '$passwordEncript', '$tipo', '$nombre', '$apellido1', '$apellido2', '$email', '$telefono', '$provincia', '$foto')";
            $conexion = self::conexion();
            $resultado = $conexion->exec($sql);
            $valor = false;

            if ($resultado == 1) {
                $valor = true;
            }
        } catch (Exception $e) {
            $error = $e->getCode();
            if ($error == "23000") {
                throw new Exception("<span class='error'>No se ha guardado el usuario porque ya existe</span>");
            } else {
                throw new Exception("Revise los datos, por favor");
            }
        }

        return $valor;
    }

    public static function guardarProfesor($profesor) {
        $dni = $profesor->getDniProfesor();
        $usuario = $profesor->getUsuario();
        $password = $profesor->getPassword();
        $passwordEncript = crypt($password, '$dgl');
        $tipo = $profesor->getTipo();
        $nombre = $profesor->getNombre();
        $apellido1 = $profesor->getApellido1();
        $apellido2 = $profesor->getApellido2();
        $email = $profesor->getEmail();
        $telefono = $profesor->getTelefono();
        $provincia = $profesor->getProvincia();
        $foto = $profesor->getFoto();

        try {
            $sql = "INSERT INTO profesor(dni_profesor, usuario, password, tipo, nombre, apellido1, apellido2, email, telefono, provincia, foto) VALUES ('$dni', '$usuario', '$passwordEncript', '$tipo', '$nombre', '$apellido1', '$apellido2', '$email', '$telefono', '$provincia', '$foto')";
            $conexion = self::conexion();
            $resultado = $conexion->exec($sql);
            $valor = false;

            if ($resultado == 1) {
                $valor = true;
            }
        } catch (Exception $e) {
            $error = $e->getCode();
            if ($error == "23000") {
                throw new Exception("<span class='error'>No se ha guardado el usuario porque ya existe</span>");
            } else {
                throw new Exception("Revise los datos, por favor");
            }
        }

        return $valor;
    }

    public static function eliminarAlumnos($alumno) {
        $dni = $alumno->getDniAlumno();

        try {
            $sql = "DELETE FROM alumno WHERE dni_alumno = '$dni'";
            $conexion = self::conexion();
            $resultado = $conexion->exec($sql);
            $valor = false;

            if ($resultado == 1) {
                $valor = true;
            }
        } catch (Exception $e) {
            $error = $e->getCode();
            if ($error == "23000") {
                throw new Exception("Error: No se ha podido eliminar el alumno.");
            } else {
                throw new Exception("Error: No se ha podido eliminar el alumno, porque no existe");
            }
        }

        return $valor;
    }
    
    /* Función que modifica los datos de un usuario concreto en la base de datos,
     * Recibe como parametro un objeto alumno con todos los datos.
    Retorna true si se modifican los datos correctamente, de lo contrario retorna false */
    public static function editarAlumno($alumno){
        $dni=$alumno->getDniAlumno();
        $usuario=$alumno->getUsuario();
        $tipo=$alumno->getTipo();
        $nombre=$alumno->getNombre();
        $apellido1=$alumno->getApellido1();
        $apellido2=$alumno->getApellido2();
        $email=$alumno->getEmail();
        $telefono=$alumno->getTelefono();
        $provincia=$alumno->getProvincia();
        $foto=$alumno->getFoto();

        try{
            $sql="UPDATE alumno SET usuario='$usuario', tipo='$tipo', nombre='$nombre', apellido1='$apellido1', apellido2='$apellido2', email='$email', telefono='$telefono', provincia='$provincia', foto='$foto' WHERE dni_alumno='$dni'";
            $conexion = self::conexion();
            $resultado=$conexion->exec($sql);
            $valido = false;

            //si el número de filas afectadas es 1 es que se ha insertado correctamente
            if($resultado==1){
                $valido=true; 
            }
        
        }catch(PDOException $e){
            $codigo_error=$e->getCode();

            if($codigo_error=="23000"){
                throw new Exception("<div class='error'>No se ha modificado el alumno, porque ya existe</div>");
            }else{
                throw new Exception("<div class='error'>No se ha podido modificar el alumno, revise los datos</div>");
            }
            
        }

        return $valido;
    }
    
    /* Función que modifica los datos de un usuario concreto en la base de datos,
     * Recibe como parametro un objeto profesor con todos los datos.
    Retorna true si se modifican los datos correctamente, de lo contrario retorna false */
    public static function editarProfesor($profesor){
        $dni=$profesor->getDniProfesor();
        $usuario=$profesor->getUsuario();
        $tipo=$profesor->getTipo();
        $nombre=$profesor->getNombre();
        $apellido1=$profesor->getApellido1();
        $apellido2=$profesor->getApellido2();
        $email=$profesor->getEmail();
        $telefono=$profesor->getTelefono();
        $provincia=$profesor->getProvincia();
        $foto=$profesor->getFoto();

        try{
            $sql="UPDATE profesor SET usuario='$usuario', tipo='$tipo', nombre='$nombre', apellido1='$apellido1', apellido2='$apellido2', email='$email', telefono='$telefono', provincia='$provincia', foto='$foto' WHERE dni_profesor='$dni'";
            $conexion = self::conexion();
            $resultado=$conexion->exec($sql);
            $valido = false;

            //si el número de filas afectadas es 1 es que se ha insertado correctamente
            if($resultado==1){
                $valido=true; 
            }
        
        }catch(PDOException $e){
            $codigo_error=$e->getCode();

            if($codigo_error=="23000"){
                throw new Exception("<div class='error'>No se ha modificado el profesor, porque ya existe</div>");
            }else{
                throw new Exception("<div class='error'>No se ha podido modificar el profesor, revise los datos</div>");
            }
            
        }

        return $valido;
    }
    
    /**
     */
    function consultaCursosAlumno($alumno){
        $dni=$alumno->getDniAlumno();
        
        try{
            $sql="SELECT c.nombre, c.cod_curso FROM matriculan m , curso c WHERE m.cod_curso=c.cod_curso AND m.dni_alumno='".$dni."';";
            $conexion = self::conexion();
            $resultado=$conexion->query($sql);
            $valor = false;

             //si la consulta tiene resultados
            if ($resultado) {
                while ($registro = $resultado->fetch()) {
                    $valor[] = $registro;
                }
            }
        
        }catch (PDOException $e) {
            throw new Exception("Error al consultar, no se pueden mostrar los cursos en los que estas matriculado");
        }

        return $valor;
    }
    
    public static function consultaCursos() {

        try {
            $valor = false;
            $sql = "SELECT * FROM curso";
            $conexion = self::conexion();
            $resultado = $conexion->query($sql);

            //si la consulta tiene resultados
            if ($resultado) {
                while ($registro = $resultado->fetch()) {
                    $valor[] = $registro;
                }
            }
        } catch (PDOException $e) {
            throw new Exception("Error al consultar, no se pueden mostrar los cursos");
        }
        return $valor;
    }
    
    public static function consultaFotoAlumno($alumno){
        $dni=$alumno->getDniAlumno();

        try{
            $valor = false;
            $sql="SELECT foto FROM alumno WHERE dni_alumno='".$dni."'";
            $conexion = self::conexion();
            $resultado=$conexion->query($sql);

            //si la consulta tiene resultados
            if($registro = $resultado->fetch()){
                $valor=$registro;
            }

        }catch(PDOException $e){
            throw new Exception("<div class='alert alert-danger'>Error al consultar la foto del alumno</div>");
        }

        return $valor;
    }
    
    /* Función que realiza una consulta todos los mensajes
      Retorna los datos de los mensajes de la BBDD y false si no existen datos */

    public static function consultaMensajes() {

        try {
            $valor = false;
            $sql = "SELECT * FROM foro";
            $conexion = self::conexion();
            $resultado = $conexion->query($sql);

            //si la consulta tiene resultados
            if ($resultado) {
                while ($registro = $resultado->fetch()) {
                    $valor[] = $registro;
                }
            }
        } catch (PDOException $e) {
            throw new Exception("Error al consultar, no se pueden mostrar los mensajes");
        }
        return $valor;
    }
    
     public static function insertaMensaje($mensaje){
        $cod_foro = '';
        $autor = $mensaje->getAutor();
        //$cod_curso = $mensaje->getCodigoCurso();
        $cod_curso = 'mysql01';
        $fecha = $mensaje->getFecha();
        $titulo = $mensaje->getTitulo();
        $contenido = $mensaje->getContenido();
        

        try {
            $sql = "INSERT INTO foro(cod_foro, autor, cod_curso, fecha, titulo, contenido) VALUES ('$cod_foro', '$autor', '$cod_curso', '$fecha', '$titulo', '$contenido')";
            $conexion = self::conexion();
            $resultado = $conexion->exec($sql);
            $valor = false;

            if ($resultado == 1) {
                $valor = true;
            }
        } catch (Exception $e) {
            $error = $e->getCode();
            if ($error == "23000") {
                throw new Exception("<span class='error'>No se ha guardado mensaje</span>");
            } else {
                throw new Exception("Revise los datos, por favor");
            }
        }

        return $valor;
    }
    
    function matricularAlumno($alumno, $curso){
        $dni = $alumno->getDniAlumno();
        $codCurso = $curso->getCodigoCurso();

        try {
            $sql = "INSERT INTO matriculan(dni_alumno, cod_curso)VALUES ('$dni', '$codCurso')";
            $conexion = self::conexion();
            $resultado = $conexion->exec($sql);
            $valor = false;

            if ($resultado == 1) {
                $valor = true;
            }
        } catch (Exception $e) {
            $error = $e->getCode();
            if ($error == "23000") {
                throw new Exception("<span class='error'>No se ha realizado la matricula porque ya estas matriculado</span>");
            } else {
                throw new Exception("Revise los datos, por favor");
            }
        }

        return $valor;
    }
}

?>