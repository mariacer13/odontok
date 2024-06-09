<?php
    class ProcedureModel{

        //Atributos
        private $Connection;

        //Metodo constructor
        function __construct($Connection){
            $this->Connection = $Connection;
        }

        //Metodo para insertar un nuevo procedimiento
        function insertProcedure($name_procedure,$description_procedure,$state_procedure){
            $SQL = "INSERT INTO ODONTOK.PROCEDURE (COD_PROCEDURE,NAME_PROCEDURE,DESCRIPTION_PROCEDURE,STATE_PROCEDURE)
            VALUES (DEFAULT,'$name_procedure','$description_procedure','$state_procedure')";
            $this->Connection->query($SQL);
        }

        //Metodo para listar todos los procedimientos
        function paginateProcedures(){
            $SQL = "SELECT * FROM ODONTOK.PROCEDURE ORDER BY STATE_PROCEDURE ASC";
            $this->Connection->query($SQL);
            return $this->Connection->fetchAll();
        }

        function updateProcedure($cod_procedure,$name_procedure,$description_procedure,$state_procedure){
            $SQL = "UPDATE ODONTOK.PROCEDURE SET 
            NAME_PROCEDURE = '$name_procedure',
            DESCRIPTION_PROCEDURE = '$description_procedure',
            STATE_PROCEDURE = '$state_procedure'
            WHERE COD_PROCEDURE = $cod_procedure";
            $this->Connection->query($SQL);
        }

        //---------------------- METODOS PARA BUSCAR ---------------------------
        function searchNameProcedure($name_procedure){
            $SQL = "SELECT * FROM ODONTOK.PROCEDURE WHERE NAME_PROCEDURE LIKE '%$name_procedure%' ORDER BY STATE_PROCEDURE ASC";
            $this->Connection->query($SQL);
            return $this->Connection->fetchAll();
        }

        function searchProcedureState($state_procedure){
            $SQL = "SELECT * FROM ODONTOK.PROCEDURE WHERE STATE_PROCEDURE = '$state_procedure'";
            $this->Connection->query($SQL);
            return $this->Connection->fetchAll();
        }

        function selectProcedure($cod_procedure){
            $SQL = "SELECT * FROM ODONTOK.PROCEDURE WHERE COD_PROCEDURE = '$cod_procedure'";
            $this->Connection->query($SQL);
            return $this->Connection->fetchAll();
        }

        //--------------------- METODOS PARA VALIDAR REPETIDOS ------------------------------
        function duplicateNameProcedure($name_procedure){
            $SQL = "SELECT NAME_PROCEDURE FROM ODONTOK.PROCEDURE WHERE NAME_PROCEDURE = '$name_procedure'";
            $this->Connection->query($SQL);
            return $this->Connection->fetchAll();
        }

        function duplicateNameUpdateProcedure($cod_procedure,$name_procedure){
            $SQL = "SELECT NAME_PROCEDURE 
            FROM ODONTOK.PROCEDURE 
            WHERE NAME_PROCEDURE = '$name_procedure'
            AND COD_PROCEDURE <> $cod_procedure";
            $this->Connection->query($SQL);
            return $this->Connection->fetchAll();
        }

    }

?>