<?php

    class Alumno{
        
        private $dni_alumno;
        private $usuario;
        private $password;
        private $tipo;
        private $nombre;
        private $apellido1;
        private $apellido2;
        private $email;
        private $telefono;
        private $provincia;
        private $foto;
        
        //creación de los métodos get y set
        public function getDniAlumno(){return $this->dni_alumno;}
        public function setDniAlumno($dni_alumno){
            $this->dni_alumno = $dni_alumno;
        }
        public function getUsuario(){return $this->usuario;}
        public function setUsuario($usuario){
            $this->usuario = $usuario;
        }
        public function getPassword(){return $this->password;}
        public function setPassword($password){
            $this->password = $password;
        }
        public function getTipo(){return $this->tipo;}
        public function setTipo($tipo){
            $this->tipo = $tipo;
        }
        public function getNombre(){return $this->nombre;}
        public function setNombre($nombre){
            $this->nombre = $nombre;
        }
        public function getApellido1(){return $this->apellido1;}
        public function setApellido1($apellido1){
            $this->apellido1 = $apellido1;
        }
        public function getApellido2(){return $this->apellido2;}
        public function setApellido2($apellido2){
            $this->apellido2 = $apellido2;
        }
        public function getEmail(){return $this->email;}
        public function setEmail($email){
            $this->email = $email;
        }
        public function getTelefono(){return $this->telefono;}
        public function setTelefono($telefono){
            $this->telefono = $telefono;
        }
        public function getProvincia(){return $this->provincia;}
        public function setProvincia($provincia){
            $this->provincia = $provincia;
        }
        public function getFoto(){return $this->foto;}
        public function setFoto($foto){
            $this->foto = $foto;
        }
        
        //Constructores
        
        //contructor princial que permite la sobrecarga
        public function __construct() { 
            $a = func_get_args(); 
            $i = func_num_args(); 
            if (method_exists($this,$f='__construct'.$i)) { 
                call_user_func_array(array($this,$f),$a); 
            } 
        }
        
        //Constructor con 11 parametros
        public function __construct11($dni_alumno,$usuario,$password,$tipo,$nombre,$apellido1,$apellido2,$email,$telefono,$provincia,$foto) {
            Alumno::setDniAlumno($dni_alumno);
            Alumno::setUsuario($usuario);
            Alumno::setPassword($password);
            Alumno::setTipo($tipo);
            Alumno::setNombre($nombre);
            Alumno::setApellido1($apellido1);
            Alumno::setApellido2($apellido2);
            Alumno::setEmail($email);
            Alumno::setTelefono($telefono);
            Alumno::setProvincia($provincia);
            Alumno::setFoto($foto);
        }
        
        //Constructor con 9 parametros
        public function __construct10($dni_alumno,$usuario,$tipo,$nombre,$apellido1,$apellido2,$email,$telefono,$provincia,$foto) {
            Alumno::setDniAlumno($dni_alumno);
            Alumno::setUsuario($usuario);
            Alumno::setTipo($tipo);
            Alumno::setNombre($nombre);
            Alumno::setApellido1($apellido1);
            Alumno::setApellido2($apellido2);
            Alumno::setEmail($email);
            Alumno::setTelefono($telefono);
            Alumno::setProvincia($provincia);
            Alumno::setFoto($foto);
        }

        /*constructor de 1 parámetro
          Recibe un parámetro: usuario */
        public function __construct1($dni_alumno) {
            Alumno::setDniAlumno($dni_alumno);
        }
    }
?>