<hr>
<input type="number" class="hidden" value="<?php echo $pema_id ?>" id="pemaId">
<h3>Escariado <small></small></h3>


<form id="generic_form">
    <div class="form-group">
        <center>
            <h4 class="text-danger"> ¿Continua Trabajo? </h4>
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

<script>

$('#motivo').hide();
$('#hecho').prop('disabled', true);


function cerrarTarea() {
debugger;
    if ($('#rechazo').prop('checked') && $('#motivo .form-control').val() == '') {
        alert('Completar Motivo de Rechazo');
        return;
    }

    var id = $('#taskId').val();
console.log(id);

    var dataForm = new FormData($('#generic_form')[0]);

    dataForm.append('taskId', $('#taskId').val());

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