<?php

class UserView
{
    //Metodo para mostrar el formulario para insertar un nuevo usuario 
    function showFormUser($arrayTypeDocument, $arrayRol)
    {
?>
        <div>
            <form id="insert_user">
                <!-- Nombres del usuario -->
                <div class="row">
                    <div class="form-group col">
                        <label for="names">Nombre(s) del usuario</label>
                        <input type="text" class="form-control" id="names" name="names">
                    </div>
                    <div class="form-group col">
                        <label for="lastNames">Apellido(s) del usuario</label>
                        <input type="text" class="form-control" id="lastNames" name="lastNames">
                    </div>
                </div>

                <!-- Campos para el documento -->
                <div class="row">
                    <div class="col">
                        <label for="state">Tipo de documento</label>
                        <select class="form-control" id="document_type" name="document_type" aria-label="Default select example">
                            <option selected>Seleccione un tipo de documento</option>
                            <?php
                            foreach ($arrayTypeDocument as $typeDocument) {
                                $cod_document_type = $typeDocument->cod_document_type;
                                $name_document_type = $typeDocument->name_document_type;
                            ?>
                                <option value="<?php echo $cod_document_type ?>"><?php echo $name_document_type ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group col">
                        <label for="document">Ingrese el numero de documento</label>
                        <input type="text" class="form-control" id="document_number" name="document_number">
                    </div>
                </div>

                <div class="form-group">
                    <label for="userName">Username</label>
                    <input type="text" class="form-control" id="userName" name="userName">
                </div>

                <!-- Campos para pedir una contraseña -->
                <div class="row">
                    <div class="form-group col">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group col">
                        <label for="confirmPassword">Confirmar contraseña</label>
                        </i><input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                    </div>
                </div>

                <!-- Ultimos campos del usuario -->
                <div class="row">
                    <div class="col">
                        <label for="">Estado</label>
                        <select class="form-control" id="state" name="state" aria-label="Default select example">
                            <option select>Seleccione un estado</option>
                            <option value="A">ACTIVO</option>
                            <option value="I">INACTIVO</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="">Rol</label>
                        <select class="form-control col" id="rol" name="rol" aria-label="Default select example">
                            <option selected>Seleccione un rol</option>
                            <?php
                            foreach ($arrayRol as $role) {
                                $cod_role = $role->cod_role;
                                $name_role = $role->name_role;
                            ?>
                                <option value="<?php echo $cod_role ?>"><?php echo $name_role ?></option>
                            <?php
                            }
                            ?>

                        </select>
                    </div>
                </div>


                <button type="button" class="btn btn-primary float-right mt-4" onclick="User.insertUser()">
                    <i class="fas fa-save mr-2"></i> Guardar
                </button>

            </form>
        </div>


    <?php
    }

    //Metodo para listar los usuarios
    function paginateUsers($array_user)
    {
    ?>
        <!-- Listado de opciones de la parte superiror -->
        <div class="card">
            <div class="card-header row">
                <div class="col-4">
                    <button type="button" class="btn btn-success float-left" onclick="User.showFormUser()">
                        <i class="fa-solid fa-user-plus mr-2"></i> Agregar usuario
                    </button>
                </div>
                <!-- FORMULARIO PARA BUSCAR -->
                <div class="col">
                    <form id="search_user" class="row justify-content-end">

                        <input class="col-4 form-control mr-3" type="text" name="document_number" id="document_number" placeholder="Numero de documento">
                        <button type="button" class="btn btn-primary float-right col-2 mr-3" onclick="User.searchNumberDocument()">
                            <i class="fa-solid fa-magnifying-glass mr-3"></i> Buscar
                        </button>

                        <!-- Listar por estado -->
                        <select onchange="User.searchState();" class="col-4 form-control" id="state" name="state" aria-label="Default select example">
                            <option select>Seleccione un estado</option>
                            <option value="todo">TODOS</option>
                            <option value="A">ACTIVO</option>
                            <option value="I">INACTIVO</option>
                        </select>
                    </form>
                </div>

            </div>
        </div>

        <!-- TABLA QUE LISTA LOS USUARIOS -->
        <div class="card">
            <div class="card-header font-weight-bold light" style="background-color: #0077b6;color:white;">
                Listar usuarios
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <th>Codigo</th>
                                <th>Documento</th>
                                <th>Nombre</th>
                                <th>Estado</th>
                                <th>Cargo</th>
                                <th>Acci&oacute;n</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($array_user as $user) {
                                $cod_user = $user->cod_user;
                                $document_number = $user->document_number;
                                $name = $user->name_user;
                                $name_state = $user->state;
                                $name_role = $user->name_role;
                            ?>
                                <tr>
                                    <td><?php echo $cod_user ?></td>
                                    <td><?php echo $document_number ?></td>
                                    <td><?php echo $name ?></td>
                                    <td><?php echo($name_state == 'A' ? 'Activo':'Inactivo'); ?></td>           
                                    <td><?php echo $name_role ?></td>
                                    <td>
                                        <i class="fa-sharp fa-solid fa-pen-to-square" onclick="User.showUser('<?php echo $cod_user ?>');" style="color: #16a239;cursor:pointer;"></i>
                                    </td>
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


    function showUser($user, $arrayTypeDocument, $arrayRol)
    {
        $cod_user = $user[0]->cod_user;
        $username = $user[0]->username;
        $user_last_name = $user[0]->user_last_name;
        $cod_document_type = $user[0]->cod_document_type;
        $document_number = $user[0]->document_number;
        $usser = $user[0]->usser;
        $password_user = $user[0]->password_user;
        $state = $user[0]->state;
        $cod_role = $user[0]->cod_role;
        $Estado = $state == 'A' ? 'Activo':'Inactivo';

                                    

    ?>
        <div>
            <form id="update_user">
                <!-- Nombres del usuario -->
                <div class="row">
                    <div class="form-group col">
                        <label for="names">Nombre(s) del usuario</label>
                        <input type="text" class="form-control" id="names" name="names" value="<?php echo $username ?> ">
                    </div>
                    <div class="form-group col">
                        <label for="lastNames">Apellido(s) del usuario</label>
                        <input type="text" class="form-control" id="lastNames" name="lastNames" value="<?php echo $user_last_name ?>">
                    </div>
                </div>

                <!-- Campos para el documento -->
                <div class=" row">
                        <div class="col">
                            <label for="state">Tipo de documento</label>
                            <select class="form-control" id="document_type" name="document_type" aria-label="Default select example">
                                <?php
                                foreach ($arrayTypeDocument as $typeDocument) {
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

                        <div class="form-group col">
                            <label for="document">Ingrese el numero de documento</label>
                            <input type="text" class="form-control" id="document_number" name="document_number" value="<?php echo $document_number ?>">
                    </div>
                </div>

                <div class=" form-group">
                            <label for="userName">Username</label>
                            <input type="text" class="form-control" id="userName" name="userName" value="<?php echo $usser ?>">
                </div>

                <!-- Campos para pedir una contraseña -->
                <div class=" row">
                            <div class="form-group col">
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" value="<?php echo $password_user ?>">
                    </div>
                    <div class=" form-group col">
                                <label for="confirmPassword">Confirmar contraseña</label>
                                </i><input type="password" class="form-control" id="confirmPassword" name="confirmPassword">
                            </div>
                        </div>

                        <!-- Ultimos campos del usuario -->
                        <div class="row">
                            <div class="col">
                                <label for="">Estado</label>
                                <select class="form-control" id="state" name="state" aria-label="Default select example">
                                    <?php if ($Estado == 'Activo'){?>
                                        <option value="A">ACTIVO</option>                                    
                                        <option value="I">INACTIVO</option>
                                    <?php } else { ?>                                                                        
                                        <option value="I">INACTIVO</option>
                                        <option value="A">ACTIVO</option>    
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col">
                                <label for="">Rol</label>
                                <select class="form-control col" id="rol" name="rol" aria-label="Default select example">

                                    <?php
                                    foreach ($arrayRol as $role) {
                                        $cod_roleA = $role->cod_role;
                                        $name_roleA = $role->name_role;
                                        if ($cod_roleA == $cod_role) {

                                    ?>
                                            <option selected value="<?php echo $cod_roleA ?>"><?php echo $name_roleA ?></option>
                                        <?php
                                        } else {
                                        ?>
                                        <option value="<?php echo $cod_roleA ?>"><?php echo $name_roleA ?></option>
                                    <?php
                                        }
                                    }
                                    ?>

                                </select>
                            </div>
                        </div>


                        <button type="button" class="btn btn-success float-right mt-4" onclick="User.updateUser('<?php echo $cod_user;?>')">
                            <i class="fa-sharp fa-solid fa-pen-to-square"></i> Actualizar
                        </button>

            </form>
        </div>


<?php



    }
}
?>