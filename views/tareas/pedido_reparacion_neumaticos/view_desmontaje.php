<style>
.frm-save {
    display: none;
}
</style>
<hr>
<input type="number" class="hidden" value="<?php echo $pema_id ?>" id="pemaId">
<h3>Despacho <small>Detalle</small></h3>
<hr>

<form id="generic_form">
    <div class="form-group">
    <label class="radio-inline">
                <input type="hidden" name="result" value="true">
    </div>

   
</form>
<div id="form-dinamico" class="frm-new" data-form="10"></div>
<br><br>
<script>

detectarForm();
initForm();

async function cerrarTarea() {
    wo();
    if (task.idUsuarioAsignado == '') {
        wc();
        notificar('Alerta','<b>Primero debe tomar la tarea</b>','warning');
        return;
    }
    var frm_info_id =  await frmGuardarConPromesa($('#form-dinamico').find('form'));
    var id = $('#taskId').val();
    var dataForm = new FormData($('#generic_form')[0]);
    dataForm.append('taskId', $('#taskId').val());
    dataForm.append('frm_info_id', frm_info_id);

    $.ajax({
        type: 'POST',
        data: dataForm,
        cache: false,
        contentType: false,
        processData: false,
        url: '<?php base_url() ?>index.php/<?php echo BPM ?>Proceso/cerrarTarea/' + id,
        success: function(data) {
                var fun = () => {linkTo('<?php echo BPM ?>Proceso/');}
                confRefresh(fun);
            },
            error: function(data) {
                error("Error",'Se produjo un error al cerrar la tarea');
            },
            complete: () => {
                wc();
            }
    });
}
</script>