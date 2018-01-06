jQuery(document).on('submit','#loginAlumno',function(event){
  
  event.preventDefault();
  
  jQuery.ajax({
    url:'../model/loginalumno.php',
    type:'POST',
    dataType:'json',
    data:$(this).serialize(),
    beforeSend:function(){
      $('#ingresar').val('Ingresando...')
    }
  })
  .done(function(respuesta){
    console.log(respuesta);
    if (!respuesta.error) {
      
        location.href='../views/panelalumno.php';
      
    }else{
        document.getElementById("error").style.display = "block";
      setTimeout(function(){
        document.getElementById("error").style.display = "none";
      },2000);
      $('#ingresar').val('Ingresar');
    }
  })
  .fail(function(resp){
    console.log(resp.responseText);
  })
  .always(function(){
    console.log("complete")
  });
});

