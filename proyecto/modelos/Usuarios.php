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


          //Segundo Metodo
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
     }
     
?>