<?php 

    class Foro{

        private $autor;        
        private $fecha;
        private $titulo;
        private $contenido;

        //creción de los métodos get y set

        public function getAutor(){return $this->autor;}
        public function setAutor($autor){
                $this->autor = $autor;
        }
        public function getFecha(){return $this->fecha;}
        public function setFecha($fecha){
                $this->fecha = $fecha;
        }
        public function getTitulo(){return $this->titulo;}
        public function setTitulo($titulo){
                $this->titulo = $titulo;
        }
        public function getContenido(){return $this->contenido;}
        public function setContenido($contenido){
                $this->contenido = $contenido;
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

        public function __construct4($autor,$fecha,$titulo,$contenido){
            Foro::setAutor($autor);
            Foro::setFecha($fecha);
            Foro::setTitulo($titulo);
            Foro::setContenido($contenido);
        }

        /*constructor de 1 parámetro
          Recibe un parámetro: usuario */
        public function __construct1($cod_foro) {
            Foro::setCodigoForo($cod_foro);
        }
    }
