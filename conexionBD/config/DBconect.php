<?php
    class Database {
    
        public $db; //Controladores de db
        private static $dns ="mysql:host=localhost;dbname=prueba"; //url de la BD
        private static $user ="root"; //usuario de conexion
        private static $pass ="";   //contraseña del usuario
        private static $instance;  //instancia de la conexion

        public function ___construct(){
            $this->db = new PDO(self::$dns, self::$user, self::$pass);
        }

        public static function getInstance(){
            if(!isset(self::$instance)){
                $object = __CLASS__;
                self::$instance = new $object;
            }
            return self::$instance;
        }

        public function insertar($nombre, $apellido, $edad, $email){

            try{
                $conexion = Database::getInstance(); //obtiene la instania de la clase
                $query = $conexion->db->prepare("INSERT INTO persona (nombre, apellido, email, edad) VALUES (:nombre, :apellido, :email, :edad)");
                $query->execute(
                    array(
                        ':nombre' => $nombre,
                        ':apellido' => $apellido,
                        ':email' => $email,
                        ':edad' => $edad
                    )
                 ); //retornar 1 si fue exitoso

                 return 1;

            } catch(PDOException $error){
                return 0; //retorna 0 si falla
            }
        }

    }
?>