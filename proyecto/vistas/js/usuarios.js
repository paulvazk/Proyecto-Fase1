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
               ]//botones para exportar en formatos 
          }).DataTable();
     }
     //Llamando a la funcion
     init();
