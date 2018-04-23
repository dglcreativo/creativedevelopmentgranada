<?php 

    class Codigo{

        private $nombre_archivo;

        //creación de los métodos get y set

        public function getNombreArchivo(){return $this->nombre_archivo;}
        public function setNombreArchivo($nombre_archivo){
                $this->nombre_archivo = $nombre_archivo;
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

        /*constructor de 1 parámetro
          Recibe un parámetro: usuario */
        public function __construct1($nombre_archivo) {
            Codigo::setNombreArchivo($nombre_archivo);
        }
    }

