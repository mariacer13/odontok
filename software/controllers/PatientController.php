<?php

require_once "models/PatientModel.php";
require_once "views/PatientView.php";

class PatientController
{

    //Metodo para insertar nuevos pacientes
    function insertPatient(){

        //Obtener todos los datos almacenados en formulario
        $name_patient = $_POST['name_patient'];//
        $last_name_patient = $_POST['last_name_patient'];//
        $cod_document_type = $_POST['cod_document_type'];//
        $number_document = $_POST['number_document'];//
        $cod_blood_type = $_POST['cod_blood_type'];//
        $birth_date = $_POST['birth_date'];
        $email = $_POST['email'];//
        $phone = $_POST['phone'];//

        //Obtener la conexion 
        $Connection = new Connection();
        $PatientModel = new PatientModel($Connection);

        //Saber si un documento ya existe en la base de datos
        $array_document_number = $PatientModel->duplicateDocumentNumber($number_document);

        //Saber que si se llenaron los campos
        if (
            $name_patient == "" || $last_name_patient == "" || $cod_document_type == "Seleccione el tipo de documento" ||
            $number_document == "" || $cod_blood_type == "Seleccione el grupo sanguineo" || $birth_date == "" 
        ) {
            $array_message = ['message' => 'Hay campos obligatorios por llenar'];
            exit(json_encode($array_message));
            //Validar que el numero de documento sea numerico y de 10 digitos
        } else if (!(ctype_digit($number_document)) || strlen($number_document) != 10) {
            $array_message = ['message' => 'Error en el numero de documento'];
            exit(json_encode($array_message));
            //Validar que las dos contraseñas coincidan    
        } else if ($array_document_number) {
            $array_message = ['message' => 'Ya existe un usuario con ese documento'];
            exit(json_encode($array_message));
        }else if($email != "" && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $array_message = ['message' => 'El correo electronico esta mal escrito'];
            exit(json_encode($array_message));
        }else if($phone != "" && (!(ctype_digit($phone)) || strlen($phone) != 10 )){
            $array_message = ['message' => 'El numero celular esta mal escrito'];
            exit(json_encode($array_message));
        }else{
            $PatientModel->insertPatient(
                $cod_document_type,
                $cod_blood_type,
                $name_patient,
                $last_name_patient,
                $number_document,
                $birth_date,
                $phone,
                $email    
            );
            $array_patients = $PatientModel->paginatePatients();
            $PatientView = new PatientView();
            $PatientView->paginatePatients($array_patients);

        }

    }

    //Metodo para buscar usuarios
    function searchPatientDocument()
    {
        //Obtener los datos del formulario
        $number_document = $_POST['number_document'];
        //Obtener la conexion
        $Connection = new Connection();
        $PatientModel = new PatientModel($Connection);
        
        if ($number_document == "") {//Si el documento es vacio
            $array_patients = $PatientModel->paginatePatients();           
        }else{
            if(!(ctype_digit($number_document)) || strlen($number_document) != 10){
                $array_message = ['message' => 'Error en el numero de documento'];
                exit(json_encode($array_message));
            }else{
                $array_patients = $PatientModel->searchPatientDocument($number_document);
            }
        }
        $PatientView = new PatientView();
        $PatientView->paginatePatients($array_patients); // Se muestran todos los usuarios
    }

    //Metodo para listar todos los pacientes
    function paginatePatients()
    {
        //Obtener la conexion
        $Connection = new Connection();

        //Obtener todos los pacientes
        $PatientModel =  new PatientModel($Connection);
        $array_patients = $PatientModel->paginatePatients();

        //Mostrar informacion
        $PatientView = new PatientView();
        $PatientView->paginatePatients($array_patients);
    }


    //Metodo para mostrar el formulario e ingresar un nuevo usuario
    function showFormPatient()
    {

        $Connection = new Connection();
        $PatientModel = new PatientModel($Connection);

        //Traer todos los tipos de documento
        $array_document_type = $PatientModel->paginateDocumentType();
        //Traer todos los tipos de grupo sanguineos
        $array_blood_type = $PatientModel->paginateBloodType();

        $PatientView = new PatientView();
        $PatientView->showFormPatient($array_document_type,$array_blood_type);
    }

    function showPatient(){

        $cod_patient = $_POST['cod_patient'];

        //Metodo para conectarme a la base de datos
        $Connection = new Connection();
        $PatientModel = new PatientModel($Connection);

        $patient = $PatientModel->selectPatient($cod_patient);
        //Traer todos los tipos de documento
        $array_document_type = $PatientModel->paginateDocumentType();
        //Traer todos los tipos de grupo sanguineos
        $array_blood_type = $PatientModel->paginateBloodType();
        //Cargar y mostrar vistas
        $PatientView = new PatientView();
        $PatientView->showPatient($patient,$array_document_type,$array_blood_type);
    }


    
    //Metodo para actualizar un pciente
    function updatePatient(){

        //Obtener todos los datos almacenados en formulario
        $cod_patient = $_POST['cod_patient'];
        $name_patient = $_POST['name_patient'];//
        $last_name_patient = $_POST['last_name_patient'];//
        $cod_document_type = $_POST['cod_document_type'];//
        $number_document = $_POST['number_document'];//
        $cod_blood_type = $_POST['cod_blood_type'];//
        $birth_date = $_POST['birth_date'];
        $email = $_POST['email'];//
        $phone = $_POST['phone'];//

        //Obtener la conexion 
        $Connection = new Connection();
        $PatientModel = new PatientModel($Connection);

        //Saber si un documento ya existe en la base de datos
        $array_document_number = $PatientModel->duplicateDocumentNumberUpdate($cod_patient,$number_document);

        //Saber que si se llenaron los campos
        if (
            $name_patient == "" || $last_name_patient == "" || $cod_document_type == "Seleccione el tipo de documento" ||
            $number_document == "" || $cod_blood_type == "Seleccione el grupo sanguineo" || $birth_date == "" 
        ) {
            $array_message = ['message' => 'Hay campos obligatorios por llenar'];
            exit(json_encode($array_message));
            //Validar que el numero de documento sea numerico y de 10 digitos
        } else if (!(ctype_digit($number_document)) || strlen($number_document) != 10) {
            $array_message = ['message' => 'Error en el numero de documento'];
            exit(json_encode($array_message));
            //Validar que las dos contraseñas coincidan    
        } else if ($array_document_number) {
            $array_message = ['message' => 'Ya existe un usuario con ese documento'];
            exit(json_encode($array_message));
        }else if($email != "" && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $array_message = ['message' => 'El correo electronico esta mal escrito'];
            exit(json_encode($array_message));
        }else if($phone != "" && (!(ctype_digit($phone)) || strlen($phone) != 10 )){
            $array_message = ['message' => 'El numero celular esta mal escrito'];
            exit(json_encode($array_message));
        }else{
            $PatientModel->updatePatient(
                $cod_patient,
                $cod_document_type,
                $cod_blood_type,
                $name_patient,
                $last_name_patient,
                $number_document,
                $birth_date,
                $phone,
                $email    
            );
            $array_patients = $PatientModel->paginatePatients();
            $PatientView = new PatientView();
            $PatientView->paginatePatients($array_patients);

        }
    }
   
}
