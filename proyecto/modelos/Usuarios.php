<?php
     //Llamando a la conexion de base de datos
     require_once("../config/conexion.php");
     //creando clase que extiende de la clase conectar
     class Usuarios extends Conectar{
          //primer metodo Vamos a listar los usuarios
          public function get_usuarios(){
               //se crea varaible para llamar al metodo conexion
               $conectar = parent :: conexion();
               parent :: set_names();
               //Realizando consulta a la tabla usuarios
               $sql="SELECT * FROM usuarios";
               //Conexion
               $sql = $conectar -> prepare($sql);
               //Ahora vamos a ejecutar la consulta
               $sql -> execute();
               
               return $resultado=$sql->fetchAll();

          }


          //Segundo Metodo para registrar un usuario
          public function registrar_usuarios( $nombre, $apellido, $cedula, $telefono, $email, $direccion, $cargo, $usuario, $password1, $password2, $estado ){
               //se crea varaible para llamar al metodo conexion
               $conectar = parent :: conexion();
               parent :: set_names();

               $sql = "INSERT INTO usuarios VALUES(null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,
                now(), ?);";
               
               //Conexion
               $sql = $conectar -> prepare($sql);

               //Llamado atraves del formulario
               $sql -> bindValue(1, $_POST["nombre"]);
               $sql -> bindValue(2, $_POST["apellido"]);
               $sql -> bindValue(3, $_POST["cedula"]);
               $sql -> bindValue(4, $_POST["telefono"]);
               $sql -> bindValue(5, $_POST["email"]);
               $sql -> bindValue(6, $_POST["direccion"]);
               $sql -> bindValue(7, $_POST["cargo"]);
               $sql -> bindValue(8, $_POST["usuario"]);
               $sql -> bindValue(9, $_POST["password1"]);
               $sql -> bindValue(10, $_POST["password2"]);
               $sql -> bindValue(11, $_POST["estado"]);

               //Ahora vamos a ejecutar la consulta
               $sql -> execute();
               
          }
          //tercer metodo para editar usuario
          public function editar_usuario($id_usuario, $nombre, $apellido, $cedula, $telefono, $email, $direccion, $cargo, $usuario, $password1, $password2, $estado ){
               //se crea varaible para llamar al metodo conexion
               $conectar = parent :: conexion();
               parent :: set_names();
               //Llamado de la consulta
               $sql = "UPDATE usuarios SET 
                    nombres = ?,
                    apellidos = ?,
                    cedula = ?,
                    telefono = ?,
                    correo = ?,
                    direccion = ?,
                    cargo = ?,
                    usuario = ?,
                    password = ?,
                    password2= ?,
                    estado = ?

                    WHERE
                    id_usuario = ?
               
               ";
               //Conexion y preparar la consulta
               $sql = $conectar -> prepare($sql);

               //Llamado atraves del formulario
               $sql -> bindValue(1, $_POST["nombre"]);
               $sql -> bindValue(2, $_POST["apellido"]);
               $sql -> bindValue(3, $_POST["cedula"]);
               $sql -> bindValue(4, $_POST["telefono"]);
               $sql -> bindValue(5, $_POST["email"]);
               $sql -> bindValue(6, $_POST["direccion"]);
               $sql -> bindValue(7, $_POST["cargo"]);
               $sql -> bindValue(8, $_POST["usuario"]);
               $sql -> bindValue(9, $_POST["password1"]);
               $sql -> bindValue(10, $_POST["password2"]);
               $sql -> bindValue(11, $_POST["estado"]);
               $sql -> bindValue(12, $_POST["id_usuario"]);

               //Ahora vamos a ejecutar la consulta
               $sql -> execute();
          }

          //Cuarto Metodo muestra los datos del usuario por id
          public function get_usuario_por_id ($id_usuario) {
               //se crea varaible para llamar al metodo conexion
               $conectar = parent :: conexion();
               parent :: set_names();
               $sql = "SELECT * FROM usuarios WHERE id_usuario = ?"; 
               //Conexion y preparar la consulta
               $sql = $conectar -> prepare($sql);
               //Llamado atraves del formulario
               $sql -> bindValue(1, $_POST["id_usuario"]);
               //Ahora vamos a ejecutar la consulta
               $sql -> execute();
               //Regresando el valor
               return $resultado=$sql->fetchAll();
          }
          //Funcion que Editaa el estado del usario si esta activo o no
          public function editar_estado($id_usuario, $estado){
               //Metodo recibido por ajax
               //se crea varaible para llamar al metodo conexion
               $conectar = parent :: conexion();
               parent :: set_names();
               //El parametro se envia por via ajax
               if ($_POST["est"] == "0") {
                    $estado = 1;
                    //inactivo
               } else{
                    //activo
                    $estado = 0;
               }

               //Consulta sql
               $sql = "UPDATE usuarios SET 
               estado = ?
               WHERE id_usuario = ? 
               ";
               //Conexion y preparar la consulta
               $sql = $conectar -> prepare($sql);
               //
               $sql -> bindValue(1,$id_usuario);
               $sql -> bindValue(2,$estado);
               //Ahora vamos a ejecutar la consulta
               $sql -> execute();
          }

          //Funcion que valida correo y cedula del usuario
          public function get_cedula_correo_del_usuario($cedula, $email){
               //se crea varaible para llamar al metodo conexion
               $conectar = parent :: conexion();
               parent :: set_names();
               //Preparando consulta
               $sql = "SELECT * FROM usuarior WHERE cedula = ? OR correo = ?";
               //Conexion y preparar la consulta
               $sql = $conectar -> prepare($sql);
               //
               $sql -> bindValue(1,$cedula);
               $sql -> bindValue(2,$email);
               //Ahora vamos a ejecutar la consulta
               $sql -> execute();
               //
               return $resultado = $sql -> fetchAll();
                              
          }

     }
     
?>