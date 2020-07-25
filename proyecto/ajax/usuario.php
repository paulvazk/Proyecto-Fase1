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
     

?>