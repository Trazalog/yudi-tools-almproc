<style>
.frm-save {
    display: none;
}
</style>
<hr>
<input type="number" class="hidden" value="<?php echo $pema_id ?>" id="pemaId">
<h3>Preparacion y aplicación de Reparación <small>Detalle</small></h3>
<hr>

<!-- <form id="generic_form">
    <div class="form-group">
        <center>
            <h4 class="text-danger"> ¿Se Aprueba o Rechaza el Pedido de Materiales? </h4>
            <label class="radio-inline">
                <input type="radio" name="result" value="true"
                    onclick="$('#motivo').hide();$('#hecho').prop('disabled',false);"> Aprobar
            </label>
            <label class="radio-inline">
                <input id="rechazo" type="radio" name="result" value="false"
                    onclick="$('#motivo').show();$('#hecho').prop('disabled',false);"> Rechazar
            </label>
        </center>
    </div>

    <div id="motivo" class="form-group motivo">
        <textarea class="form-control" name="motivo_rechazo" placeholder="Motivo de Rechazo..."></textarea>
    </div>
</form> -->
<div id="form-dinamico" class="frm-new" data-form="5"></div>

<script>
$(document).ready(function(){
    $('#form-dinamico-cabecera button.frm-save').attr("disabled" , true);
});


detectarForm();
initForm();

function cerrarTareaform(){
    debugger;
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
    debugger;
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
            back();

        },
        error: function(data) {
            alert("Error");
        }
    });
debugger;
}
</script>