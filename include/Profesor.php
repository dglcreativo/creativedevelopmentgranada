<?php

    class Profesor{
        
        private $dni_profesor;
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
        public function getDniProfesor(){return $this->dni_profesor;}
        public function setDniProfesor($dni_profesor){
            $this->dni_profesor = $dni_profesor;
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
        
        //constructor con los 11 parametros
        public function __construct11($dni_profesor,$usuario,$password,$tipo,$nombre,$apellido1,$apellido2,$email,$telefono,$provincia,$foto) {
            Profesor::setDniProfesor($dni_profesor);
            Profesor::setUsuario($usuario);
            Profesor::setPassword($password);
            Profesor::setTipo($tipo);
            Profesor::setNombre($nombre);
            Profesor::setApellido1($apellido1);
            Profesor::setApellido2($apellido2);
            Profesor::setEmail($email);
            Profesor::setTelefono($telefono);
            Profesor::setProvincia($provincia);
            Profesor::setFoto($foto);
        }
        
        //contructor con 9 parametros
        public function __construct10($dni_profesor,$usuario,$tipo,$nombre,$apellido1,$apellido2,$email,$telefono,$provincia,$foto) {
            Profesor::setDniProfesor($dni_profesor);
            Profesor::setUsuario($usuario);
            Profesor::setTipo($tipo);
            Profesor::setNombre($nombre);
            Profesor::setApellido1($apellido1);
            Profesor::setApellido2($apellido2);
            Profesor::setEmail($email);
            Profesor::setTelefono($telefono);
            Profesor::setProvincia($provincia);
            Profesor::setFoto($foto);
        }

        /*constructor de 1 parámetro
          Recibe un parámetro: usuario */
        public function __construct1($dni_profesor) {
            Profesor::setDniProfesor($dni_profesor);
        }
    }
?>