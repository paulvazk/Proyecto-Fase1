/**
 * Se genera las funciones dinamicas con Jquery
 */
var tabla;
     //Primera Funcion que se ejecuta
     function init() {
          //Va a servir de referancia para llamar a los demas
     }
     //Funcion que limpia los campos del formulario 
     function limpiar() {
          $("#cedula").val("");
          $("#nombre").val("");
          $("#apellido").val("");
          $("#cargo").val("");
          $("#usuario").val("");
          $("#password1").val("");
          $("#password2").val("");
          $("#telefono").val("");
          $("#email").val("");
          $("#direccion").val("");
          $("#estado").val("");
          $("#id_usuario").val("");
     }
     //Funcion para listar
     function listar() {
          tabla = $('#usuario_data').dataTable({
               "aProcesing": true,//Se activa el procesamiento del datatables
               "aServerSide": true,//Paginacion y filtracion realizados por el servidor
               dom: "Bfrtip",//Definimos los elementos del control de tabla
               buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'csvHtml5',
                    'pdf'
               ],//botones para exportar en formatos 
               "ajax"://Parametros Ajax
                    {
                         url:'../ajax/usuarios.php?op=listar',
                         type : "get",
                         dataType: "json",
                         error: function (e) {
                              console.log('====================================');
                              console.log(e.responseText);
                              console.log('====================================');
                         }
                    },
               "bDestroy": true,
               "responsive": true,//Tabla responsive
               "bInfo": true,
               "iDisplayLength": 10,//Por cada 10 registros se hace la paginacion
               "order":[[0, "desc"]],//Se ordena por (columna, orden) 
          
          //Agregando la traduccion     
	     "language": {
 
                    "sProcessing":     "Procesando...",
                         
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                         
                    "sZeroRecords":    "No se encontraron resultados",
                         
                    "sEmptyTable":     "Ningún dato disponible en esta tabla",
                    
                    "sInfo":           "Mostrando un total de _TOTAL_ registros",
                         
                    "sInfoEmpty":      "Mostrando un total de 0 registros",
                         
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                         
                    "sInfoPostFix":    "",
                         
                    "sSearch":         "Buscar:",
                         
                    "sUrl":            "",
                         
                    "sInfoThousands":  ",",
                         
                    "sLoadingRecords": "Cargando...",
			 
		          "oPaginate": {
			 
		               "sFirst":    "Primero",
		 
                         "sLast":     "Último",
                    
                         "sNext":     "Siguiente",
                    
                         "sPrevious": "Anterior"
			 
	          	    },
			 
		          "oAria": {
			 
                         "sSortAscending":  ": Ordenar de manera ascendente",
                         
                         "sSortDescending": ": Ordenar de manera descendente"
                         
                         }
		   }//cerrando traduccion del language

          }).DataTable();

     }

     //Mostrando datos del usuario en la ventana modal del formulario
     function mostrar(id_usuario) {
          $.post("../ajax/usuario.php?op=mostrar", {id_usuario : id_usuario}, function (data, status) {
             data = JSON.parse(data);
               //Mostar modal
               $("#usuarioModal").modal("show");  
               //Valor de la cedula y los demas campos, los retorna en JSON 511 2030
               $("#cedula").val(data.cedula);
               $("#nombre").val(data.nombre);
               $("#apellido").val(data.apellido);
               $("#cargo").val(data.cargo);
               $("#usuario").val(data.usuario);
               $("#password1").val(data.password1);
               $("#password2").val(data.password2);
               $("#telefono").val(data.telefono);
               $("#email").val(data.email);
               $("#direccion").val(data.direccion);
               $("#estado").val(data.estado);
               //texto que se va a mostrar
               $(".modal-title").text("Editar Usuarios");
               $("#id_usuario").val(data.id_usuario);

               $("#action").val("Edit");                              
               
          });
     }
     //La funcion guardaryeditar(e); se llama cuando se da click al boton  
     function guardaryeditar(e) {
          //Evitamos la accion determinada del eventos
          
     }


     //Llamando a la funcion
     init();
