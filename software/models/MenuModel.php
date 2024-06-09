<?php

class MenuModel
{

    private $Connection;

    function __construct($Connection)
    {
        $this->Connection = $Connection;
    }

    //Funcion para listar el usuario que inicio sesion
    function listUser($cod_user)
    {
        $sql = "SELECT * FROM ODONTOK.USER WHERE
        COD_USER = '$cod_user'";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    //Funcion para saber cuantos usuarios hay registrados
    function numUsers()
    {
        $sql = "SELECT count(*) FROM ODONTOK.USER";
        $this->Connection->query($sql);
        return $this->Connection->fetchAll();
    }

    //Funcion para saber cuantos procedimientos hay registrados
    function numProcedures(){
        $SQL = "SELECT count(*) AS NUM_PROCEDURES FROM ODONTOK.PROCEDURE";
        $this->Connection->query($SQL);
        return $this->Connection->fetchAll();
    }

    //Funcion para saber cuantos procedimientos hay registrados
    function numPatients(){
        $SQL = "SELECT count(*) AS NUM_PATIENTS FROM ODONTOK.PATIENT";
        $this->Connection->query($SQL);
        return $this->Connection->fetchAll();
    }


}
