<?php

    require_once "models/ProcedureModel.php";
    require_once "views/ProcedureView.php";

    class ProcedureController{


        //Metodo para insertar un nuevo procedumiento
        function insertProcedure(){
            //Obtener el objeto para la conexion a la base de datos
            $Connnection = new Connection();
            $ProcedureModel = new ProcedureModel($Connnection);

            //Obtener los datos del formulario 
            $name_procedure = $_POST['name_procedure'];
            $state_procedure = $_POST['state_procedure'];
            $description_procedure = $_POST['description_procedure'];

            //Transformar el nombre todo a mayusculas
            $name_procedure = strtoupper($name_procedure);
            $duplicateProcedure = $ProcedureModel->duplicateNameProcedure($name_procedure);

            //Saber la longitud de la descripcion 
            $longitud = strlen(trim($description_procedure));

            if($name_procedure == "" || $state_procedure == "Estado" || $description_procedure == ''){
                $array_message = ['message' => 'Por favor llene todos los campos'];
                exit(json_encode($array_message));
            }else if($duplicateProcedure){
                $array_message = ['message' => 'Ya hay un procedimiento con ese nombre'];
                exit(json_encode($array_message));
            }else if($longitud > 200){
                $array_message = ['message' => 'La descripcion es demasiado extensa'];
                exit(json_encode($array_message));
            }else{
                $ProcedureModel->insertProcedure($name_procedure,$description_procedure,$state_procedure);
                $ProcedureView = new ProcedureView();
                $array_procedure = $ProcedureModel->paginateProcedures();

                $ProcedureView->paginateProcedures($array_procedure);
            }
        }

         //Metodo para consultar por nombre de procedimiento
        function searchNameProcedure(){

            //Obtener el nombre del procedimiento buscado
            $name_procedure = $_POST['name_procedure'];
            $name_procedure = trim($name_procedure);
            $name_procedure = strtoupper($name_procedure);

            //Obtener herramientas para consultar
            $Connnection = new Connection();
            $ProcedureModel = new ProcedureModel($Connnection);

            if($name_procedure == ""){
                $array_procedure = $ProcedureModel->paginateProcedures();
            }else{
                $array_procedure = $ProcedureModel->searchNameProcedure($name_procedure);
            }

            //Crear vista para mostrar
            $ProcedureView = new ProcedureView();
            $ProcedureView->paginateProcedures($array_procedure);
        
        }

        //Metodo para consultar por estado 
        function searchProcedureState(){
            //Obtener el estado seleccionado
            $state_procedure = $_POST['state'];

            $Connnection = new Connection();
            $ProcedureModel = new ProcedureModel($Connnection);


            if($state_procedure == 'todo'){
                $array_procedure = $ProcedureModel->paginateProcedures();
            }else{
                $array_procedure = $ProcedureModel->searchProcedureState($state_procedure);
            }
            //Crear vista para mostrar
            $ProcedureView = new ProcedureView();
            $ProcedureView->paginateProcedures($array_procedure);

            
        }

        //Metodo para listar todos los procedimientos disponibles
        function paginateProcedures(){

            //Crear conexion a la base de datos
            $Connnection = new Connection();
            $ProcedureModel = new ProcedureModel($Connnection);

            //Traer los procedimientos almacenados en la base de datos
            $array_procedure = $ProcedureModel->paginateProcedures();


            //Crear la vista
            $ProcedureView = new ProcedureView();
            $ProcedureView->paginateProcedures($array_procedure);
        }

        //Metodo para mostrar el formulario de un procedimiento
        function showFormProcedure(){
             //Crear la vista
             $ProcedureView = new ProcedureView();
             $ProcedureView->showFormProcedure();
        }

       
        //Metodo para mostrar los datos precargados de un usuario
        function showProcedure(){
            //Obtener el codigo del procedimiento
            $cod_procedure = $_POST['cod_procedure'];
            
            //Crear la conexon
            $Connnection = new Connection();
            $ProcedureModel = new ProcedureModel($Connnection);

            $procedure = $ProcedureModel->selectProcedure($cod_procedure);

            //Mostrar el formulario de actualizacion 
            $ProcedureView = new ProcedureView();
            $ProcedureView->showProcedure($procedure);
        }

        //Funcion para actulizar un procedimiento
        function updateProcedure(){
            //Obtener el objeto para la conexion a la base de datos
            $Connnection = new Connection();
            $ProcedureModel = new ProcedureModel($Connnection);

            //Obtener los datos del formulario 
            $cod_procedure = $_POST['cod_procedure'];
            $name_procedure = $_POST['name_procedure'];
            $state_procedure = $_POST['state_procedure'];
            $description_procedure = $_POST['description_procedure'];

            //Transformar el nombre todo a mayusculas
            $name_procedure = strtoupper($name_procedure);
            $duplicateProcedure = $ProcedureModel->duplicateNameUpdateProcedure($cod_procedure,$name_procedure);

            //Saber la longitud de la descripcion 
            $longitud = strlen(trim($description_procedure));

            if($name_procedure == "" || $state_procedure == "Estado" || $description_procedure == ''){
                $array_message = ['message' => 'Por favor llene todos los campos'];
                exit(json_encode($array_message));
            }else if($duplicateProcedure){
                $array_message = ['message' => 'Ya hay un procedimiento con ese nombre'];
                exit(json_encode($array_message));
            }else if($longitud > 200){
                $array_message = ['message' => 'La descripcion es demasiado extensa'];
                exit(json_encode($array_message));
            }else{
                $ProcedureModel->updateProcedure($cod_procedure,$name_procedure,$description_procedure,$state_procedure);

                $ProcedureView = new ProcedureView();
                $array_procedure = $ProcedureModel->paginateProcedures();

                $ProcedureView->paginateProcedures($array_procedure);
            }
        }

    }
?>