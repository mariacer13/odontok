<?php

    class PatientModel{

        private $Connection;

        //Metodo constrcutor
        function __construct($Connection)
        {
            $this->Connection = $Connection;
        }


        //Metodo para insertar nuevos pacientes
        function insertPatient($cod_document_type,$cod_blood_type,$name_patient,$last_name_patient,$number_document,$birth_date,$phone,$email){
            $SQL = "INSERT INTO ODONTOK.PATIENT (COD_PATIENT,COD_DOCUMENT_TYPE,COD_BLOOD_TYPE,NAME_PATIENT,LAST_NAME_PATIENT,
            NUMBER_DOCUMENT,BIRTH_DATE,PHONE,EMAIL)
            VALUES (DEFAULT,'$cod_document_type','$cod_blood_type','$name_patient','$last_name_patient'
            ,'$number_document','$birth_date','$phone','$email')";
            $this->Connection->query($SQL);
        }

        //Metodo para listar todos los usuarios
        function paginatePatients()
        {
            $SQL = "SELECT COD_PATIENT,NAME_PATIENT,LAST_NAME_PATIENT,NUMBER_DOCUMENT, date_part('year', age(birth_date)) AS age 
            FROM ODONTOK.PATIENT";
            $this->Connection->query($SQL);
            return $this->Connection->fetchAll();
        }

        function updatePatient($cod_patient,$cod_document_type,$cod_blood_type,$name_patient,$last_name_patient,$number_document,$birth_date,$phone,$email){
            $SQL = "UPDATE ODONTOK.PATIENT SET COD_DOCUMENT_TYPE = '$cod_document_type', COD_BLOOD_TYPE = '$cod_blood_type',
            NAME_PATIENT = '$name_patient',LAST_NAME_PATIENT = '$last_name_patient',NUMBER_DOCUMENT = '$number_document',
            BIRTH_DATE = '$birth_date', PHONE = '$phone', EMAIL = '$email'
            WHERE COD_PATIENT = '$cod_patient'";
            $this->Connection->query($SQL);
        }

        

        //---------------------------- METODOS PARA LISTAR
        function paginateDocumentType(){
            $SQL = "SELECT *
            FROM ODONTOK.DOCUMENT_TYPE";
            $this->Connection->query($SQL);
            return $this->Connection->fetchAll();
        }

        function paginateBloodType(){
            $SQL = "SELECT *
            FROM ODONTOK.BLOOD_TYPE";
            $this->Connection->query($SQL);
            return $this->Connection->fetchAll();
        }


        //------------------ METODOS PARA BUSCAR ----------------------------------

        function selectPatient($cod_patient){
            $SQL = "SELECT * FROM ODONTOK.PATIENT WHERE COD_PATIENT = '$cod_patient'";
            $this->Connection->query($SQL);
            return $this->Connection->fetchAll();
        }

        function searchPatientDocument($number_document){
            $SQL = "SELECT NAME_PATIENT,LAST_NAME_PATIENT,NUMBER_DOCUMENT, date_part('year', age(birth_date)) AS age 
            FROM ODONTOK.PATIENT
            WHERE number_document = '$number_document'";
            $this->Connection->query($SQL);
            return $this->Connection->fetchAll();
        }

        //---------------- METODOS  PARA VALIDAR REPETIDOS -------------

        //Saber si un documento ya existe en la base de datos
        function duplicateDocumentNumber($number_document)
        {
            $sql = "SELECT * FROM ODONTOK.PATIENT WHERE NUMBER_DOCUMENT = '$number_document'";
            $this->Connection->query($sql);
            return $this->Connection->fetchAll();
        }
        //Saber si un documento ya existe en la base de datos
        function duplicateDocumentNumberUpdate($cod_patient,$number_document)
        {
            $sql = "SELECT * FROM ODONTOK.PATIENT WHERE NUMBER_DOCUMENT = '$number_document'
            AND COD_PATIENT <> '$cod_patient'";
            $this->Connection->query($sql);
            return $this->Connection->fetchAll();
        }




    }


?>