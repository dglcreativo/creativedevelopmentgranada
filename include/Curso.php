<?php 

    class Curso{

        private $cod_curso;
        private $nombre;
        private $descripcion;

        //creción de los métodos get y set

        public function getCodigoCurso(){return $this->cod_curso;}
        public function setCodigoCurso($cod_curso){
                $this->cod_curso = $cod_curso;
        }
        public function getNombre(){return $this->nombre;}
        public function setNombre($nombre){
                $this->nombre = $nombre;
        }
        public function getDescripcion(){return $this->descripcion;}
        public function setDescripcion($descripcion){
                $this->descripcion = $descripcion;
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

        public function __construct3($cod_curso,$nombre,$descripcion){
                Curso::setCodigoCurso($cod_curso);
                Curso::setNombre($nombre);
                Curso::setDescripcion($descripcion);
        }

        /*constructor de 1 parámetro
          Recibe un parámetro: usuario */
        public function __construct1($cod_curso) {
            Curso::setCodigoCurso($cod_curso);
        }
    }

