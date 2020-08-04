<?php
     //llamando a la conexion de la base de datos
     require_once("../config/conexion.php");
     //Llamar al modelo usuarios
     require_once("../modelos/Usuarios.php");
     //creando objecto usuario instanciandolo de la clase usuarios
     $usuarios = new Usuarios();
     //se va a declarar la variable de los valores que se van a enviar por el formulario y recibiremos por AJAX asi decimos que si existe el parametro que estamos recibiendo
     $id_usuarios = isset($_POST["id_usuarios"]);
     $nombre = isset($_POST["nombre"]);
     $apellido = isset($_POST["apellido"]);
     $cedula = isset($_POST["cedula"]);
     $telefono = isset($_POST["telefono"]);
     $email = isset($_POST["email"]);
     $direccion = isset($_POST["direccion"]);
     $cargo = isset($_POST["cargo"]);
     $usuario = isset($_POST["usuario"]);
     $password = isset($_POST["password"]);
     $password2 = isset($_POST["password2"]);
     //Esto es  lo que se envia por parte del formulario
     $estado = isset($_POST["estado"]);
     //casos de operaciones 
     switch ($_GET["op"]) {

          case "guardaryeditar":
               /*
                * se verifica si existe la cedula y correo en la base de datos
                * Si ya existe un registro con la cedula o correo 
                * entonces no se registra el usuario
                */
               $datos = $usuarios -> get_cedula_correo_del_usuario($_POST(["cedula"]),$_POST(["email"]));
               //Condionnal que sirve para verificar que coincidan las contrase;as
               if ($password1 == $password2) {
                    /*
                     * Si el id no existe entonces lo registra 
                     * Importante: Se debe de poner el $_POST si no no funciona
                     */
                    if (empty($_POST["id_usuario"])) {
                         /*
                          * En caso de que coincidan los passwords se verifica
                          * Si existe la cedula y el correo en la base de datos 
                          * En caso de que ya exista el registro con la cedula o el correo
                          * No se registrara 
                          */
                         if (is_array($datos) == true and count($datos) == 0) {
                              //Si no existe el usuario realizamos el registro
                              //Creando objecto que llama al metodo regitrar usuario
                              $usuarios -> registrar_usuarios($nombre, $apellido, $cedula, $telefono, $email, $direccion, $cargo, $usuario, $password1, $password2, $estado);
                              //Mnadar mensaje
                              $messages[] = "Usuario Registrado Exitosamente";
                         }else{
                              //En caso de que existe
                              $messages[] = "Usuario o Cedula Ya Existe";

                         }

                    } //Cierre de la validacion del empty
                    else{
                         /*
                          * Si ya existe el usuario editamos al usuario
                          */
                         //creando objeto
                         $usuarios -> editar_usuario($id_usuario, $nombre, $apellido, $cedula, $telefono, $email, $direccion, $cargo, $usuario, $password1, $password2, $estado);
                         $messages[] = "Se ha editado un Usuario Exitosamente";
                    }


               } else {
                    /*
                     * Si no coincide el password, se muestra mensaje de error
                     */
                    $errors[] = "Verifique su contraseña no coincide";
               }
               
               //Creando mensajes personalizadps
               if (isset($messages)) {
                    //Mensaje de exito
                    ?>
                         <div class="alert alert-success" role="alert">
                              <button type="button" class="close" data-dismiss="alert">
                                   &times;
                              </button>
                              <strong>Bien hecho</strong>
                              <?php 
                                   foreach($messages as $message){
                                        echo $message;
                                   }
                              ?>
                         </div>
                    <?php
               }
               //Mensajes de error
               if (isset($errors)) {
                    ?>
                         <div class="alert alert-danger" role="alert">
                              <button type="button" class="close" data-dismiss="alert">
                                   &times;
                              </button>
                              <strong>Ocurrio algo mal</strong>
                              <?php 
                                   foreach($errors as $error){
                                        echo $error;
                                   }
                              ?>
                         </div>
                    <?php                   
               }
          break;

          case "mostar":
               /*
                * Se seleccionara el id del usuario
                * El parametro id_usuario se envia por AJAX cuando se edita el usuario
                */
                $datos = $usuarios -> get_usuario_por_id($_POST["id_usuario"]);
               //Validacion si es que existe el id_usuario
               if (is_array($datos) == true and count($datos) > 0) {
                    foreach ($datos as $row ) {

                         $output["cedula"] = $row["cedula"];
                         $output["nombre"] = $row["nombre"];
                         $output["apellido"] = $row["apellido"];
                         $output["cargo"] = $row["cargo"];
                         $output["usuario"] = $row["usuario"];
                         $output["password1"] = $row["password1"];
                         $output["password2"] = $row["password2"];
                         $output["telefono"] = $row["telefono"];
                         $output["correo"] = $row["correo"];
                         $output["direccion"] = $row["direccion"];
                         $output["estado"] = $row["estado"];
  
                    }
                    //regresando datos en json
                    echo json_encode($output);

               } else {
                    //En caso de que no exista el usuario
                    $errors[] = "El usuario no existe en los registros";
               }
               //Mensajes de error
               if (isset($errors)) {
                    ?>
                         <div class="alert alert-danger" role="alert">
                              <button type="button" class="close" data-dismiss="alert">
                                   &times;
                              </button>
                              <strong>Ocurrio algo mal</strong>
                              <?php 
                                   foreach($errors as $error){
                                        echo $error;
                                   }
                              ?>
                         </div>
                    <?php                   
               }
          break;

          case "activarydesactivar":
               /**
                * Cambiamos el estado del usuario
                */
                $datos = $usuarios -> get_usuario_por_id($_POST["id_usuario"]);
                //Valida el id del usuario
                    if (is_array($datos) == true and count($datos) > 0) {
                         //edita el estado del usuario
                         $usuarios -> editar_estado($_POST["id_usuario"], $_POST["est"]);
                    }           
          break; 

          case "listar":
               //Iniciando funcion listar
               $datos = $usuarios -> get_usuarios();

               //declarando el array
               $data = Array();

               //Verificando ESTADO
               $est = '';
               //Variable de atributo  con clases de boodestrap :V
               $atrib = "btn btn-success btn-md estado";
               if ($row["estado"] == 0) {
                    # code...
                    $est = 'INACTIVO';
                    $atrib = 'btn btn-warning btn-md estado';

               } else {
                    # code...
                    if ($row["estado"] == 1) {
                         # code...
                         $est = 'ACTIVO';
                    }
               }
               //Recorremos los campos de manera independiente
               foreach($datos as $row) { 
                    //aqui se va agregar en el array
                    $sub_array = array();
                    //Validacion del cargo
                    if ($row["cargo"] == 1) {
                         # code...
                         $cargo = "ADMINISTRADOR";

                    }
                    else {
                         if ($row["cargo"] == 0) {
                              # code...
                              $cargo = "EMPLEADO";
                         }
                    }
                    //Campos de la tabla usuarios
                    $sub_array[] = $row["cedula"];
                    $sub_array[] = $row["nombres"];
                    $sub_array[] = $row["apellidos"];
                    $sub_array[] = $row["usuario"];
                    $sub_array[] = $cargo;
                    $sub_array[] = $row["telefono"];
                    $sub_array[] = $row["correo"];
                    $sub_array[] = $row["direccion"];
                    $sub_array[] = date("d-m-y",strtotime($row["fecha_ingreso"]));//ordenar por fechas

                    //Creando boton de cambio de estado con un evento onclick asi mismo concatena el id y el estado
                    $sub_array[] = '
                    <button type = "button" onClick = "cambiarEstado('.$row["id_usuario"].','.$row["estado"].');" name = "estado" id = "'.$row["id_usuario"].'" class = "'.$atrib.'">'
                    .$est.
                    '</button>';

                    //Creando boton de editar
                    $sub_array[] = '
                    <button type = "button" onClick = "mostrar('.$row["id_usuario"].');"  id = "'.$row["id_usuario"].'" class = "btn btn-warning btn-md update">
                    <i class="glyphicon glyphicon-edit"></i>
                         Editar
                    </button>';

                    //Creando Boton de eliminar
                    $sub_array[] = '
                    <button type = "button" onClick = "eliminar('.$row["id_usuario"].');"  id = "'.$row["id_usuario"].'" class = "btn btn-danger btn-md">
                    <i class="glyphicon glyphicon-edit"></i>
                         Eliminar
                    </button>';

                    $data[] = $sub_array;

               }
               //Declarar otro array
               $results = array(

                    "sEcho" => 1,//Informacion para el datatable importante para tabular y paginar
                    "iTotalRecords" => count($data), //Se envia el total de registros al datatable
                    "iTotalDisplayRecords" => count($data),//Se envia el total de regisros que se van a visualizar
                    "aaData" => $data
               );
               //Impriminedo JSON
               echo json_encode($results);

               
          break;          
     }

?>