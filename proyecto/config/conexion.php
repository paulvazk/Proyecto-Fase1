<?php
     class Conectar
     {    
          protected $dbh;
          //Se realiza la proteccion de la conexion
          public function conexion (){
               try {
                    $conectar = $this -> dbh = new PDO("mysql:local = localhost; dbname = dbproyecto","root","vacp990914");
                    //Se intancia una clase de PDO y se realiza la conexion
                    return $conectar; 
                    //Se regresa la conexion
               } catch (Execption $e) {
                    //EN CASO DE FALLA SE IMPRIME UN MENSAJE DE ERROR
                    print "Error: " . $e -> getMessage() . "<br/>";
                    die();
               }   
          }//Cierre de la funcion 

     }//Cierre de la clase Conectar
     
     public function set_name(){
          return $this -> dbh -> query("SET NAMES 'utf8' " );
     }

     public function ruta(){
          return "http://localhost:8080/proyecto2/";
     }
?>