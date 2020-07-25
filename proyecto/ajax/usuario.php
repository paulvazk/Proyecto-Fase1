<?php
     //llamando a la conexion de la base de datos
     require_once("../config/conexion.php");
     //Llamar al modelo usuarios
     require_once("../modelos/Usuarios.php");
     //creando objecto usuario instanciandolo de la clase usuarios
     $usuarios = new Usuarios();
     

?>