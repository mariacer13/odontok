<?php
require_once "../private_files_software/setting_connection.php";

class Connection {

    //Atributos 
    private $link;
    private $result;

    //Metodo para obtener la conexion
    function __construct(){

        //Datos para la conexion
        $ip = IP;
        $data_base = DATA_BASE;
        $port = PORT;
        $user = USER_POSTGRES;
        $password = PASSWORD_POSTGRES;

        //Realizar la conexion a la base de datos
        try{
            //Link para la conexion a la base de datos.
            $this->link = new PDO("pgsql:host=$ip;port=$port;dbname=$data_base",$user,$password);
            $this->link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            exit("Error para conectarse");
        }
    }

    //Funcion usada principalmente para modificar (eliminar, insertar, actualizar) la base de datos
    function query($sql) {
        $this->result = $this->link->query($sql) 
        or exit('Consulta mal estructurada');
    }

    //Funcion usada principalmente para seleccionar
    function fetchAll() {
        return $this->result->fetchAll(PDO::FETCH_OBJ);
    }


}

?>