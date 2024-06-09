<?php
//---------------------ARCHIVO-PACIENTE-----------------//
class PatientView
{
    //Metodo para mostrar el formulario para insertar un nuevo paciente 
    function showFormPatient($array_document_type,$array_blood_type)
    {
?>
        <div>
            <form id="insert_patient">
                <!-- Nombres del paciente -->
                <div class="row">
                    <div class="form-group col">
                        <label for="name_patient">Nombre(s) del paciente</label>
                        <input type="text" class="form-control" id="name_patient" name="name_patient">
                    </div>


                    <!--Apellidos del paciente -->
                    <div class="form-group col">
                        <label for="names">Apellido(s) del paciente</label>
                        <input type="text" class="form-control" id="last_name_patient" name="last_name_patient">
                    </div>
                </div>
                <div class="row">
                    <!--Tipo de documento -->
                    <div class="form-group col">
                        <label for="state">Tipo de documento </label>
                        <select class="form-control" id="cod_document_type" name="cod_document_type" aria-label="Default select example">
                            <option>Seleccione el tipo de documento</option>
                            <?php
                            foreach ($array_document_type as $typeDocument) {
                                $cod_document_type = $typeDocument->cod_document_type;
                                $name_document_type = $typeDocument->name_document_type;
                            ?>
                                <option value="<?php echo $cod_document_type ?>"><?php echo $name_document_type ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <!--numero de documento -->
                    <div class="form-group col">
                        <label for="names"> N&uacute;mero de documento</label>
                        <input type="text" class="form-control" id="number_document" name="number_document">
                    </div>
                </div>

                <div class="row">
                    
                    <!--Tipo de sangre -->
                    <div class="form-group col">
                        <label for="state">Grupo sanguineo</label>
                        <select class="form-control" id="cod_blood_type" name="cod_blood_type" aria-label="Default select example">
                            <option>Seleccione el grupo sanguineo </option>
                            <?php
                            foreach ($array_blood_type as $blood_type) {
                                $cod_blood_type = $blood_type->cod_blood_type;
                                $blood_type = $blood_type->blood_type;
                            ?>
                                <option value="<?php echo $cod_blood_type ?>"><?php echo $blood_type ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>  
                    <!--Tipo de sangre -->
                    <div class="form-group col">
                        <label for="birth_date">Fecha de nacimiento</label>
                        <input type="date" class="form-control" id="birth_date" name="birth_date">
                    </div>    


                </div>
                <!--correo electronico -->
                <div class="row">
                    <div class="form-group col-6">
                        <label for="names">Correo electr&oacute;nico </label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group col-6">
                        <label for="names">Celular</label>
                        <input type="number" class="form-control" id="phone" name="phone">
                    </div>
                    
                </div>

                <button type="button" class="btn btn-primary float-right mt-4" onclick="Patient.insertPatient()">
                    <i class="fas fa-save mr-2"></i> Guardar
                </button>
            </form>
        </div>


    <?php
    }

    //Metodo para listar los procedimientos
    function paginatePatients($array_patients)
    {
    ?>
        <!-- Listado de opciones de la parte superiror -->
        <div class="card">
            <div class="card-header row">
                <div class="col-4 ">
                    <?php if($_SESSION['cod_role'] == 104) { ?>
                        <button type="button" class="btn btn-success float-left" onclick="Patient.showFormPatient()">
                            <i class="fa-solid fa-user-plus mr-2"></i> Registrar pacientes
                        </button>
                    <?php } ?>
                </div>
                <!-- CAMPO PARA BUSCAR POR DOCUMENTO-->
                <div class="col">
                    <form id="search_patient" class="row justify-content-end">
                        <input class="col-4 form-control mr-3" type="text" name="number_document" id="number_document" placeholder="Documento del paciente">
                        <button type="button" class="btn btn-primary float-right col-2" onclick="Patient.searchNumberDocument()">
                            <i class="fa-solid fa-magnifying-glass mr-3"></i> Buscar
                        </button>
                    </form>
                </div>


            </div>
        </div>

        <!-- TABLA QUE LISTA LOS PACIENTES -->
        <div class="card">
            <div class="card-header font-weight-bold light" style="background-color: #0077b6;color:white;">
                Listado de pacientes
            </div>
            <div class="card-body ">

                <div class="table-responsive">
                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <!-- DATOS DEL PACIENTE PARA LISTAR -->
                                <th>Nombre(s) del paciente</th>
                                <th>Apellido(s) del paciente</th>
                                <th>N&uacute;mero de documento</th>
                                <th>Edad</th>
                                <?php if($_SESSION['cod_role'] == 104) { ?>
                                    <th>Acci&oacute;n</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($array_patients as $patient) {
                                $cod_patient = $patient->cod_patient;
                                $name_patient = $patient->name_patient;
                                $last_name_patient = $patient->last_name_patient;
                                $number_document = $patient->number_document;
                                $age = $patient->age;
                            ?>
                                <tr>
                                    <td><?php echo $name_patient ?></td>
                                    <td><?php echo $last_name_patient ?></td>
                                    <td><?php echo $number_document ?></td>          
                                    <td><?php echo $age ?></td>
                                    <?php if($_SESSION['cod_role'] == 104) { ?>
                                        <td>
                                            <i class="fa-sharp fa-solid fa-pen-to-square" onclick="Patient.showPatient('<?php echo $cod_patient ?>');" style="color: #16a239;cursor:pointer;"></i>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    <?php
    }


    function showPatient($patient,$array_document_type,$array_blood_type)
    {
        $cod_patient = $patient[0]->cod_patient;
        $name_patient = $patient[0]->name_patient;
        $last_name_patient = $patient[0]->last_name_patient;
        $cod_document_type = $patient[0]->cod_document_type;
        $number_document = $patient[0]->number_document;
        $birth_date = $patient[0]->birth_date;
        $cod_blood_type = $patient[0]->cod_blood_type;
        $phone = $patient[0]->phone;
        $email = $patient[0]->email;
    ?>
        <div>
            <form id="update_patient">
                <!-- Nombres del paciente -->
                <div class="row">
                    <div class="form-group col">
                        <label for="names">Nombre(s) del paciente</label>
                        <input type="text" class="form-control" id="name_patient" name="name_patient" value="<?php echo $name_patient ?>">
                    </div>

                    <!--Apellidos del paciente -->
                    <div class="form-group col">
                        <label for="names">Apellido(s) del paciente</label>
                        <input type="text" class="form-control" id="last_name_patient" name="last_name_patient" value="<?php echo $last_name_patient ?>">
                    </div>
                </div>
                <div class="row">
                    <!--Tipo de documento -->
                    <div class="form-group col">
                        <label for="state">Tipo de documento </label>
                        <select class="form-control" id="cod_document_type" name="cod_document_type" aria-label="Default select example">
                            <option value="todo">Seleccione el tipo de documento</option>
                            <?php
                                foreach ($array_document_type as $typeDocument) {
                                    $cod_document_typeA = $typeDocument->cod_document_type;
                                    $name_document_typeA = $typeDocument->name_document_type;
                                    if ($cod_document_typeA == $cod_document_type) {
                                ?>
                                        <option selected value="<?php echo $cod_document_typeA ?>"><?php echo $name_document_typeA ?></option>
                                    <?php
                                    } else {
                                    ?>
                                        <option value="<?php echo $cod_document_typeA ?>"><?php echo $name_document_typeA ?></option>
                                <?php
                                    }
                                }
                                ?>
                        </select>
                    </div>
                    <!--numero de documento -->
                    <div class="form-group col">
                        <label for="names"> N&uacute;mero de documento</label>
                        <input type="text" class="form-control" id="number_document" name="number_document" value="<?php echo $number_document ?>">
                    </div>
                </div>

                <div class="row">
                    
                    <!--Tipo de sangre -->
                    <div class="form-group col">
                        <label for="state">Grupo sanguineo</label>
                        <select class="form-control" id="cod_blood_type" name="cod_blood_type" aria-label="Default select example">
                            <option>Seleccione el grupo sanguineo </option>
                            <?php
                                foreach ($array_blood_type as $bloodType) {
                                    $cod_blood_typeA = $bloodType->cod_blood_type;
                                    $blood_type = $bloodType->blood_type;
                                    if ($cod_blood_typeA == $cod_blood_type) {
                                ?>
                                        <option selected value="<?php echo $cod_blood_typeA ?>"><?php echo $blood_type ?></option>
                                    <?php
                                    } else {
                                    ?>
                                        <option value="<?php echo $cod_blood_typeA ?>"><?php echo $blood_type ?></option>
                                <?php
                                    }
                                }
                                ?>
                        </select>
                    </div>
                     <!--Tipo de sangre -->
                     <div class="form-group col">
                        <label for="birth_date">Fecha de nacimiento</label>
                        <input type="date" class="form-control" id="birth_date" name="birth_date" value="<?php echo $birth_date?>">
                    </div>    


                </div>
                <!--correo electronico -->
                <div class="row">
                    <div class="form-group col-6">
                        <label for="names">Correo electr&oacute;nico </label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email ?>">
                    </div>
                    <!--Numero de telefono -->
                    <div class="form-group col">
                        <label for="names">N&uacute;mero de tel&eacute;fono</label>
                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone ?>">
                    </div>
                </div>


                <button type="button" class="btn btn-primary float-right mt-4"onclick="Patient.updatePatient('<?php echo $cod_patient;?>')">
                    <i class="fas fa-save mr-2"></i> Actualizar
                </button>

            </form>
        </div>


<?php



    }
}
?>