jQuery(document).on('submit','#loginProfesor',function(event){
  
  event.preventDefault();
  
  jQuery.ajax({
    url:'../model/loginprofesor.php',
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
      
        location.href='../views/panelprofesor.php';
      
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

