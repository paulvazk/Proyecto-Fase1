<?php

     class Conectar
     {    
          //Atributo
          protected $dbh;
          //funcion tipo protegida
          protected function conexion (){
               try {
                    $conectar = $this -> dbh = new PDO("mysql:local = localhost; dbname = dbproyecto","root","");
                    //Se intancia una clase de Pph Data Object (PDO) y se realiza la conexion
                    return $conectar; 
                    //Se regresa la conexion
               } catch (Execption $e) {
                    //EN CASO DE FALLA SE IMPRIME UN MENSAJE DE ERROR
                    print "Error: " . $e -> getMessage() . "<br/>";
                    die();
               }   
          }//Cierre de la funcion conexion
          //Funcion que evita problemas con los caracteres especiales del espa;ol
          public function set_names(){
               return $this->dbh->query("SET NAMES 'utf8'");
          }
          public function ruta(){
               //funcion para la rutas cy que cy
               //se llamara en otros metodos
               return "http://localhost:8080/proyecto2/";
          }
     

     }//Cierre de la clase Conectar
     
?>