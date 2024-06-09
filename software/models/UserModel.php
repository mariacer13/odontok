<?php
class UserModel
{
    private $Connection;

    //Metodo constrcutor
    function __construct($Connection)
    {
        $this->Connection = $Connection;
    }


    //Metodo para insertar un usuaro
    function insertUser(
        $cod_role,
        $cod_document_type,
        $state,
        $username,
        $user_last_name,
        $document_number,
        $usser,
        $password
    ) {
        $sql = "INSERT INTO ODONTOK.USER (COD_USER,COD_ROLE,COD_DOCUMENT_TYPE,USERNAME,USER_LAST_NAME,DOCUMENT_NUMBER,USSER,PASSWORD_USER,STATE)
        VALUES (DEFAULT,$cod_role,$cod_document_type,'$username','$user_last_name','$document_number','$usser','$password','$state')";
        $this->Connection->query($sql);
    }

    //Metodo para listar todos los usuarios
    function paginateUser()
    {
        $sql = "SELECT CONCAT(US.COD_ROLE,US.COD_USER) AS COD_USER,US.DOCUMENT_NUMBER,CONCAT(US.USERNAME,' ',US.USER_LAST_NAME) AS NAME_USER,
		US.STATE,ROL.NAME_ROLE
        FROM ODONTOK.USER US
        INNER JOIN ODONTOK.ROLE ROL
        ON US.COD_ROLE = ROL.COD_ROLE
        ORDER BY US.state ASC";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    //Metodo para actualizar un procedimiento
    function updateUser(
        $cod_user,
        $cod_role,
        $cod_document_type,
        $cod_state,
        $username,
        $user_last_name,
        $document_number,
        $usser,
        $password
    ) {
        $sql = "UPDATE ODONTOK.USER SET COD_ROLE = '$cod_role', COD_DOCUMENT_TYPE = '$cod_document_type',
        STATE = '$cod_state', USERNAME = '$username', USER_LAST_NAME = '$user_last_name',
        DOCUMENT_NUMBER = '$document_number', USSER = '$usser', PASSWORD_USER = '$password' WHERE COD_USER = '$cod_user'";
        $this->Connection->query($sql);
    }



    //--------------------------------------- LISTAR TABLAS 

    //Metodo para traer en un array todos los tipos de documento
    function paginateDocumentType()
    {
        $sql = "SELECT * FROM ODONTOK.DOCUMENT_TYPE ";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    //Metodo para listar los roles
    function paginateRol()
    {
        $sql = "SELECT * FROM ODONTOK.ROLE";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    //----------------------------- METODOS PARA BUSCAR--------

    //Metodo para buscar por documento
    function searchUserDocument($document_number)
    {
        $sql = "SELECT CONCAT(US.COD_USER,US.COD_ROLE) AS COD_USER,US.DOCUMENT_NUMBER,CONCAT(US.USERNAME,' ',US.USER_LAST_NAME) AS NAME_USER,
		US.STATE,ROL.NAME_ROLE
        FROM ODONTOK.USER US
        INNER JOIN ODONTOK.ROLE ROL
        ON US.COD_ROLE = ROL.COD_ROLE
        WHERE US.DOCUMENT_NUMBER = '$document_number'";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    //Metodo para buscar por estado
    function searchUserState($state)
    {
        $sql = "SELECT CONCAT(US.COD_USER,US.COD_ROLE) AS COD_USER,US.DOCUMENT_NUMBER,CONCAT(US.USERNAME,' ',US.USER_LAST_NAME) AS NAME_USER,
		US.STATE,ROL.NAME_ROLE
        FROM ODONTOK.USER US
        INNER JOIN ODONTOK.ROLE ROL
        ON US.COD_ROLE = ROL.COD_ROLE
        WHERE US.state = '$state'";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    //Metodo para seleccionar un usuario en concreto
    function selectUser($cod_user)
    {
        $sql = "SELECT *  FROM ODONTOK.USER WHERE CONCAT(COD_ROLE,COD_USER) = '$cod_user'";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    //---------------- METODOS  PARA VALIDAR REPETIDOS -------------

    //Saber si un documento ya existe en la base de datos
    function duplicateDocumentNumber($document_number)
    {
        $sql = "SELECT * FROM ODONTOK.USER WHERE DOCUMENT_NUMBER='$document_number'";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    //Saber si un numero de documento no es repetido
    function duplicateDocumentNumberUpdate($document_number, $cod_user_update)
    {
        $sql = "SELECT * FROM ODONTOK.USER WHERE DOCUMENT_NUMBER='$document_number'
        AND COD_USER <> '$cod_user_update'";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    //Saber si un nombre de usuario esta en la base de datos 
    function duplicateUsser($usser)
    {
        $sql = "SELECT * FROM ODONTOK.USER WHERE USSER='$usser'";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    //Saber que el nuevo usuario no esta dupli
    function duplicateUsserUpdate($usser, $cod_user_update)
    {
        $sql = "SELECT * FROM ODONTOK.USER WHERE USSER='$usser'
        AND COD_USER <> '$cod_user_update'";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }
}
