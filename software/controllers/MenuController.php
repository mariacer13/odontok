<?php

require_once "views/MenuView.php";
require_once "models/MenuModel.php";

//Controller
class MenuController {
    
    // Metodo para mostrar el menu de la dashboard
    function validateMenu(){

        //Crear una conexion
        $Connection = new Connection();
        $MenuModel = new MenuModel($Connection);

        $user = $MenuModel->listUser($_SESSION["cod_user"]);
        //Botener el numero de pacientes 
        $num_users = $MenuModel->numUsers()[0]->count;
        //Obtener el numero de procedimientos
        $num_procedures = $MenuModel->numProcedures()[0]->num_procedures;
        //Obtener el numero de pacientes registrados
        $num_patients = $MenuModel->numPatients()[0]->num_patients;
        
        $MenuView=new MenuView();  
        
        $MenuView->showMenu($user,$num_users,$num_procedures,$num_patients);
        
    }

    //Funcion para mostrar de nuevo la interfaz principal
    function validateHome(){
        //Crear una conexion
        $Connection = new Connection();
        $MenuModel = new MenuModel($Connection);
        //Botener el numero de pacientes 
        $num_users = $MenuModel->numUsers()[0]->count;
        //Obtener el numero de procedimientos
        $num_procedures = $MenuModel->numProcedures()[0]->num_procedures;
        //Obtener el numero de pacientes registrados
        $num_patients = $MenuModel->numPatients()[0]->num_patients;
        
        $MenuView=new MenuView();  
        
        $MenuView->showStartePage($num_users,$num_procedures,$num_patients);
    }
    
}
