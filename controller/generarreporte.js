jQuery(document).on('submit','#generarReporte',function(event){
  
  event.preventDefault();
  
  jQuery.ajax({
    url:'../model/generarreporte.php',
    type:'POST',
    dataType:'json',
    data:$(this).serialize(),
    beforeSend:function(){
      $('#generar').val('Generando...')
    }
  })
  .done(function(respuesta){
    console.log(respuesta);
    if (!respuesta.error) {
      
        location.href='../model/generarreporte.php';
      
    }else{
        document.getElementById("error").style.display = "block";
      setTimeout(function(){
        document.getElementById("error").style.display = "none";
      },3000);
      $('#generar').val('Generar');
    }
  })
  .fail(function(resp){
    console.log(resp.responseText);
  })
  .always(function(){
    console.log("complete")
  });
});

