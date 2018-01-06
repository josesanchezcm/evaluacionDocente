jQuery(document).on('submit','#enviarformulario',function(event){
  
  event.preventDefault();
  
  jQuery.ajax({
    url:'../model/enviarformulario.php',
    type:'POST',
    dataType:'json',
    data:$(this).serialize(),
    beforeSend:function(){
      $('#btnEnviarForm').val('Enviando...')
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
      $('#btnEnviarForm').val('Enviar Formulario');
    }
  })
  .fail(function(resp){
    console.log(resp.responseText);
  })
  .always(function(){
    console.log("complete")
  });
});