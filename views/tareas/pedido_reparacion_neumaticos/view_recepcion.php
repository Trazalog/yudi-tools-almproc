<input type="number" class="hidden" value="<?php echo $pema_id ?>" id="pemaId">
<h3>Pedido De Reparación de Neumaticos <small>Detalle</small></h3>

<hr>

<div id="form-dinamico" class="frm-new" data-form="35"></div>

<script>
$(document).ready(function(){
   // $('#form-dinamico-cabecera button.frm-save').attr("disabled" , true);
});


detectarForm();
initForm();

function cerrarTareaform(){

    var bandera = true ;

    if (!frm_validar('#form-dinamico')) {
  
    	console.log("Error al guardar Formulario");
				Swal.fire(
					'Oops...',
					'Debes completar los campos Obligatorios (*)',
					'error'
				)
   bandera = false;
       return bandera;

    }
    else{

    $('#form-dinamico .frm-save').click();
        var info_id = $('.frm').attr('data-ninfoid');
        console.log('info_id:' + info_id);
         console.log('Formulario Guardado con exito -function cerrarTareaform');
        }

        return bandera; 
  }
    

function cerrarTarea() {
 
   var gardado = cerrarTareaform();

    if(!gardado){
     return;
    }

    var id = $('#taskId').val();

    var dataForm = new FormData($('#generic_form')[0]);

 //   dataForm.append('pema_id', $('#pemaId').val());


    $.ajax({
        type: 'POST',
        data: dataForm,
        cache: false,
        contentType: false,
        processData: false,
        url: '<?php base_url() ?>index.php/<?php echo BPM ?>Proceso/cerrarTarea/' + id,
        success: function(data) {
            //wc();
         //   back();
        
            linkTo('<?php echo BPM ?>Proceso/');   
            
            setTimeout(() => {
            Swal.fire(
                
                    'Perfecto!',
                    'Se Finalizó la Tarea Correctamente!',
                    'success'
                )
		  }, 13000);
    
        },
        error: function(data) {
            alert("Error");
        }
    });

}
</script>