<?php

require_once "models/UserModel.php";
require_once "views/UserView.php";

class UserController {

    //Metodo para insertar un nuevo usuario
    function insertUser() {

        //Obtener todos los atributos
        $username = $_POST['names'];
        $user_last_name = $_POST['lastNames'];
        $cod_document_type = $_POST['document_type'];
        $document_number = $_POST['document_number'];
        $usser = $_POST['userName'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        $state = $_POST['state'];
        $cod_role = $_POST['rol'];

        $Connection = new Connection();
        $UserModel = new UserModel($Connection);

        //Validar si el documento que se esta ingresando ya le pertenece a una persona
        $array_document_number = $UserModel->duplicateDocumentNumber($document_number);
        //Validar que el usuario ingresado sea unico
        $array_usser = $UserModel->duplicateUsser($usser);

        //Saber que si se llenaron los campos
        if (
            $username == "" || $user_last_name == "" || $cod_document_type == "Seleccione un tipo de documento" ||
            $document_number == "" || $usser == "" || $password == "" || $confirmPassword == "" ||
            $state == 'Seleccione un estado' || $cod_role == "Seleccione un rol"
        ) {

            $array_message = ['message' => 'Hay campos por llenar'];
            exit(json_encode($array_message));

            //Validar que el numero de documento sea numerico y de 10 digitos
        } else if (!(ctype_digit($document_number)) || strlen($document_number) != 10) {
            $array_message = ['message' => 'Error en el numero de documento'];
            exit(json_encode($array_message));
            //Validar que las dos contraseñas coincidan    
        } else if ($password !== $confirmPassword) {
            $array_message = ['message' => 'Las contraseñas no coinciden'];
            exit(json_encode($array_message));
            //Saber si el documento que se esta ingresando ya esta asignado
        } else if ($array_document_number) {
            $array_message = ['message' => 'Ya existe un usuario con ese documento'];
            exit(json_encode($array_message));
        } else if ($array_usser) {
            $array_message = ['message' => 'Ya existe alguien con ese usuario'];
            exit(json_encode($array_message));
        } else {
            //Obtener los codigo en tipo numerico
            $cod_role = intval($cod_role);
            $cod_document_type = intval($cod_document_type);

            $UserModel->insertUser(
                $cod_role,
                $cod_document_type,
                $state,
                $username,
                $user_last_name,
                $document_number,
                $usser,
                $password
            );
        }

        $array_user = $UserModel->paginateUser();
        $UserView = new UserView();
        $UserView->paginateUsers($array_user);
    }


    //Metodo para buscar usuarios
    function searchUsersDocument()
    {
        //Obtener los datos del formulario
        $document_number = $_POST['document_number'];

        $Connection = new Connection();
        $UserModel = new UserModel($Connection);
        $UserView = new UserView();

        if ($document_number == "") {//Si el documento es vacio
            $array_user = $UserModel->paginateUser();
            $UserView->paginateUsers($array_user); // Se muestran todos los usuarios
        }else{
            if(!(ctype_digit($document_number)) || strlen($document_number) != 10){
                $array_message = ['message' => 'Error en el numero de documento'];
                exit(json_encode($array_message));
            }else{
                $array_users = $UserModel->searchUserDocument($document_number);
                $UserView->paginateUsers($array_users);
            }
        }
    }

    //Metodo para buscar por estado
    function searchUsersState(){

        //Obtener los datos del formulario
        $state = $_POST['state'];
        //Obtener la conexion
        $Connection = new Connection();
        $UserModel = new UserModel($Connection);

        if($state == "todo"){
            $array_users = $UserModel->paginateUser();           
        }else{
            $array_users = $UserModel->searchUserState($state);
        }
        //Mostrar los usuarios con el estado seleccionado
        $UserView = new UserView();
        $UserView->paginateUsers($array_users);
    }

    //Metodo para listar los usuarios
    function paginateUsers()
    {
        $Connection = new Connection();
        $UserModel = new UserModel($Connection);

        //Mostrar informacion
        $array_user = $UserModel->paginateUser();
        $UserView = new UserView();
        $UserView->paginateUsers($array_user);
    }

    
    //Metodo para mostrar el formulario e ingresar un nuevo usuario
    function showFormUser()
    {

        $Connection = new Connection();
        $UserModel = new UserModel($Connection);

        $arrayTypeDocument = $UserModel->paginateDocumentType();
        $arrayRol = $UserModel->paginateRol();
        //Crear y mostrar el formulario
        $UserView = new UserView();
        $UserView->showFormUser($arrayTypeDocument, $arrayRol);
    }

    //Metodo para mostrar un usuario
    function showUser(){

        $cod_user = $_POST['cod_user'];

        //Metodo para conectarme a la base de datos
        $Connection = new Connection();
        $UserModel = new UserModel($Connection);

        $user = $UserModel->selectUser($cod_user);
        $array_role = $UserModel->paginateRol();
        $array_type_document = $UserModel->paginateDocumentType();
        //Cargar y mostrar vistas
        $UserView = new UserView();
        $UserView->showUser($user,$array_type_document,$array_role);

    }

    function updateUser(){
        //Obtener todos los atributos
        $cod_user = $_POST['cod_user'];
        $username = $_POST['names'];
        $user_last_name = $_POST['lastNames'];
        $cod_document_type = $_POST['document_type'];
        $document_number = $_POST['document_number'];
        $usser = $_POST['userName'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];
        $state = $_POST['state'];
        $cod_role = $_POST['rol'];



        $Connection = new Connection();
        $UserModel = new UserModel($Connection);

        //Validar si el documento que se esta ingresando ya le pertenece a una persona
        $array_document_number = $UserModel->duplicateDocumentNumberUpdate($document_number,$cod_user);
        $array_usser = $UserModel->duplicateUsserUpdate($usser,$cod_user);

        //Saber que si se llenaron los campos
        if (
            $username == "" || $user_last_name == "" || $cod_document_type == "Seleccione un tipo de documento" ||
            $document_number == "" || $usser == "" || $password == "" || $confirmPassword == "" ||
            $state == 'Seleccione un estado' || $cod_role == "Seleccione un rol"
        ) {

            $array_message = ['message' => 'Hay campos por llenar'];
            exit(json_encode($array_message));

            //Validar que el numero de documento sea numerico y de 10 digitos
        } else if (!(ctype_digit($document_number)) || strlen($document_number) != 10) {
            $array_message = ['message' => 'Error en el numero de documento'];
            exit(json_encode($array_message));
            //Validar que las dos contraseñas coincidan    
        } else if ($password !== $confirmPassword) {
            $array_message = ['message' => 'Las contraseñas no coinciden'];
            exit(json_encode($array_message));
            //Saber si el documento que se esta ingresando ya esta asignado
        } else if ($array_document_number) {
            $array_message = ['message' => 'Ya existe un usuario con ese documento'];
            exit(json_encode($array_message));
        } else if ($array_usser) {
            $array_message = ['message' => 'Ya existe alguien con ese usuario'];
            exit(json_encode($array_message));
        } else {
            //Obtener los codigo en tipo numerico

            $cod_role = intval($cod_role);
            $cod_document_type = intval($cod_document_type);

            $UserModel->updateUser(
                $cod_user,
                $cod_role,
                $cod_document_type,
                $state,
                $username,
                $user_last_name,
                $document_number,
                $usser,
                $password
            );
        }

        $array_user = $UserModel->paginateUser();
        $UserView = new UserView();
        $UserView->paginateUsers($array_user);
    }
}
