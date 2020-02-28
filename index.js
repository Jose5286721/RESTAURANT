const fecha = document.getElementById('FechaReserva');
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
            }
        }
    }
    request.send();
});