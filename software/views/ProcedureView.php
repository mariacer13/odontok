<?php
//---------------------ARCHIVO-PROCEDIMIENTOS-----------------//
class ProcedureView
{
    //Metodo para mostrar el formulario para insertar un nuevo procedimiento 
    function showFormProcedure()
    {
    ?>
        <div>
            <form id="insert_procedure">
                <!-- Nombre del procedimiento -->
                <div class="row">
                    <div class="form-group col">
                        <label for="names">Nombre del procedimiento</label>
                        <input type="text" class="form-control" id="name_procedure" name="name_procedure">
                    </div>
                    <div class="col">
                         <!-- Estado en el que se encuentra el procedimiento -->
                        <label for="state_procedure">Estado del procedimiento</label>
                        <select class="form-control" id="state_procedure" name="state_procedure" aria-label="Default select example">
                            <option value="A" selected>ACTIVO</option>
                            <option value="I">INACTIVO</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                         <!-- descripcion del procedimiento -->
                    <div class="form-group col-6">
                        <label for="description_procedure">Descripción</label>
                        <textarea class="form-control" id="description_procedure" name="description_procedure" rows="8""></textarea>
                 
                </div>
                </div>
        </div>


        <button type=" button" class="btn btn-primary float-right mt-4" onclick="Procedure.insertProcedure()">
            <i class="fas fa-save mr-2"></i> Guardar
        </button>

        </form>
        </div>


    <?php
    }

    //Metodo para listar los procedimientos
    function paginateProcedures($array_procedure)
    {
    ?>
        <!-- Listado de opciones de la parte superiror -->
        <div class="card">
            <div class="card-header row">
                <div class="col-4">
                <?php if($_SESSION['cod_role'] == 104) { ?>
                    <button type="button" class="btn btn-success float-left" onclick="Procedure.showFormProcedure()">
                        <i class="fas fa-plus-square mr-2"></i>  Agregar procedimiento
                    </button>
                <?php } ?>
                </div>
                <!-- FORMULARIO PARA BUSCAR -->
                <div class="col">
                    <form id="search_procedure" class="row justify-content-end">

                        <input class="col-4 form-control mr-3" type="text" name="name_procedure" id="name_procedure" placeholder="Nombre del procedimiento">
                        <button type="button" class="btn btn-primary float-right col-2 mr-3" onclick="Procedure.searchNameProcedure()">
                            <i class="fa-solid fa-magnifying-glass mr-3"></i> Buscar
                        </button>

                        <!-- Listar por estado -->
                        <select onchange="Procedure.searchProcedureState();" class="col-4 form-control" id="state" name="state" aria-label="Default select example">
                            <option select>Seleccione un estado</option>
                            <option value="todo">TODOS</option>
                            <option value="A">ACTIVO</option>
                            <option value="I">INACTIVO</option>
                        </select>
                    </form>
                </div>

            </div>
        </div>

        <!-- TABLA QUE LISTA LOS PROCEDIMIENTOS -->
        <div class="card">
            <div class="card-header font-weight-bold light" style="background-color: #0077b6;color:white;">
                Listar procedimientos
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-striped ">
                        <thead>
                            <!--campos de la lista -->
                            <tr>
                                <th>Nombre del procedimiento</th>
                                <th>Estado</th>
                                <th>Descripci&oacute;n</th>
                                <?php if($_SESSION['cod_role'] == 104) { ?>
                                    <th>Acci&oacute;n</th>
                                <?php } ?>
                            </tr>
                            
                        </thead>
                        <!-- LISTAR LOS PROCEDIMIENTOS ALMACENADOS EN LA BASE DE DATOS -->
                        <tbody>
                            <?php  foreach ($array_procedure as $procedure){
                                    //Obtener todos los datos de un procedimiento
                                $cod_procedure = $procedure->cod_procedure;
                                $name_procedure = $procedure->name_procedure;
                                $state_procedure = $procedure->state_procedure;
                                $description_procedure = $procedure->description_procedure;
                            ?>
                            <tr>
                                <td><?php echo $name_procedure?></td>
                                <td><?php echo($state_procedure == 'A' ? 'Activo':'Inactivo'); ?></td>                                                                           
                                <td><?php echo $description_procedure?></td>
                                <?php if($_SESSION['cod_role'] == 104) { ?>
                                    <td>
                                        <i class="fa-sharp fa-solid fa-pen-to-square" onclick="Procedure.showProcedure('<?php echo $cod_procedure ?>');" style="color: #16a239;cursor:pointer;"></i>
                                    </td>
                                <?php } ?>
                            </tr> 
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    <?php
    }


    function showProcedure($procedure)
    {
        $cod_procedure = $procedure[0]->cod_procedure;
        $name_procedure = $procedure[0]-> name_procedure;
        $state_procedure= $procedure[0]->state_procedure;
        $description_procedure = $procedure[0]->description_procedure;

    ?>
        <div>
            <form id="update_procedure">
                <!-- Nombre del procedimiento -->
                <div class="row">
                    <div class="form-group col">
                        <label for="names">Nombre del procedimiento</label>
                        <input type="text" class="form-control" id="name_procedure" name="name_procedure" value="<?php echo $name_procedure?> ">
                    </div>
                    <!-- Estado del procedimiento -->
                    <div class="form-group col">
                        <label for="state">Estado del procedimiento</label>
                        <select class="form-control" id="state_procedure" name="state_procedure" aria-label="Default select example">
                                <?php if ($state_procedure == 'A'){?>
                                    <option value="A" selected>ACTIVO</option>                                    
                                    <option value="I">INACTIVO</option>
                                <?php } else { ?>                                                                        
                                    <option value="I" selected>INACTIVO</option>
                                    <option value="A">ACTIVO</option>    
                                <?php } ?>
                        </select>
                    </div>
                </div>
                <!-- Descripcion del procedimiento -->
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" id="description_procedure" name="description_procedure" rows="8" ><?php echo $description_procedure?></textarea>

                    </div>
                </div>

        </div>



        <button type="button" class="btn btn-success float-right mt-4" onclick="Procedure.updateProcedure('<?php echo $cod_procedure;?>')">
            <i class="fa-sharp fa-solid fa-pen-to-square"></i> Actualizar
        </button>

        </form>
        </div>


<?php



    }
}
?>