<?php


  session_start();
//  require_once('../../vendor/autoload.php');
  
  
 class Conectar {

 	protected $dbh;
	 
	 
 	    protected function conexion(){


 		 try {
			  $databse = getenv('DBNAME');
			  $userdb=getenv('USERDB');
			  $passwordSql=getenv('PASSWORD');
 			$conectar = $this->dbh = new PDO("mysql:local=localhost;dbname=$databse","root","");
		   
		     return $conectar;
 			
 		  } catch (Exception $e) {

 			print "¡Error!: " . $e->getMessage() . "<br/>";
            die();  
 			
 		  }
 


	    } //cierre de llave de la function conexion()


		 public function set_names(){

		 	return $this->dbh->query("SET NAMES 'utf8'");
		 }


		 public function ruta(){
			 $routerInit = getenv('RUTAINIT');
		 	return "http://localhost:9090/Proyecto-Fase1/proyecto/";
		 }

		   //Función para convertir fecha del mes de numero al nombre, ejemplo de 01 a enero
	      public static function convertir($string){

	         $string = str_replace(
	         array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'),
	         array('ENERO', 'FEBRERO', 'MARZO', 'ABRIL', 'MAYO', 'JUNIO', 'JULIO', 'AGOSTO', 'SEPTIEMBRE', 'OCTUBRE', 'NOVIEMBRE', ' DICIEMBRE'),
	         $string
	        );        
	        return $string;
	      }

	

	}//cierre de llave conectar 		
		  	
?>