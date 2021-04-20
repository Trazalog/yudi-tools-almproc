<style>
.frm-save {
    display: none;
}
</style>
<hr>
<input type="number" class="hidden" value="<?php echo $pema_id ?>" id="pemaId">
<h3>Desmontaje <small>Detalle</small></h3>
<hr>

<form id="generic_form">
    <div class="form-group">
        <center>
            <h4 class="text-danger"> ¿Trabajo Correcto? </h4>
            <label class="radio-inline">
                <input type="radio" name="result" value="true"
                    onclick="$('#motivo').hide();$('#hecho').prop('disabled',false);"> Si
            </label>
            <label class="radio-inline">
                <input id="rechazo" type="radio" name="result" value="false"
                    onclick="$('#motivo').show();$('#hecho').prop('disabled',false);"> No
            </label>
        </center>
    </div>

    <div id="motivo" class="form-group motivo">
        <textarea class="form-control" name="motivo_rechazo" placeholder="Motivo de Rechazo..."></textarea>
    </div>
</form>
<!-- <div class="frm-new" data-form=""></div> -->

<script>
$(document).ready(function(){
 //   $('#form-dinamico-cabecera button.frm-save').attr("disabled" , true);
});

 $('#motivo').hide();
 $('#hecho').prop('disabled', true);


function cerrarTarea() {

    if ($('#rechazo').prop('checked') && $('#motivo .form-control').val() == '') {
        alert('Completar Motivo de Rechazo');
        return;
    }

    var id = $('#taskId').val();

    var dataForm = new FormData($('#generic_form')[0]);

    $.ajax({
        type: 'POST',
        data: dataForm,
        cache: false,
        contentType: false,
        processData: false,
        url: '<?php base_url() ?>index.php/<?php echo BPM ?>Proceso/cerrarTarea/' + id,
        success: function(data) {
            //wc();
            //back();
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