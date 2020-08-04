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
               //Agregando la traaduccion
               "language":{
                    "sProcessing" : "Procesando...",
                    "sLengthMenu" : "Mostrar _MENU_ resgitros",
                    "sZeroRecords" : "",
                    "sEmpty" : "",
                    "" : "",
                    "" : "",
                    "" : "",
                    "" : "",
                    "" : "",
                    "" : "",
                    "" : "",
                    "" : "",
                    "" : "",
                    "" : "",
                    "" : "",
                    "" : "",
                    "" : "",
                    "" : "",
                    "" : "",
                    "" : "",
                    "" : "",
                    "" : "",
                    "" : "",
                    "" : "",
                    "" : "",

                    "" : "",
                    "" : "",

               }    
          }).DataTable();
     }
     //Llamando a la funcion
     init();
