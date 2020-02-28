
$('#tablaProductos').DataTable({
	"language": {
            "sProcessing":     "Procesando...",
			"sLengthMenu":     "Mostrar _MENU_ registros",
			"sZeroRecords":    "No se encontraron resultados",
			"sEmptyTable":     "Ningún dato disponible en esta tabla",
			"sInfo":           "registros del _START_ al _END_ de un total de _TOTAL_ registros",
			"sInfoEmpty":      "registros del 0 al 0 de un total de 0 registros",
			"sInfoFiltered":   "(total de _MAX_ registros)",
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
				"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
				"sSortDescending": ": Activar para ordenar la columna de manera descendente"
			}
        }
});
const fecha = document.getElementById('FechaReserva');
const mesa = document.getElementById('NroMesas');
fecha.addEventListener('change',(event)=>{
  event.preventDefault();
  var response;
  var request = new XMLHttpRequest();
  request.open('GET','http://localhost/RESTAURANT/Views/reservas/api/Mesas.php?fechaOpcion='+event.target.value,true);
  request.onreadystatechange = (e)=>{
	  if(request.readyState == 4){
		  if(request.status == 200){
			  response = request.response;
			  console.log(response);
			  mesa.innerHTML = response;
		  }
	  }
  }
  request.send();
  });
