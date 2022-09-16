<style>
.frm-save {
    display: none;
}
</style>
<hr>
<input type="number" class="hidden" value="<?php echo $pema_id ?>" id="pemaId">
<h3>Vulcanización en autoclave <small>Detalle</small></h3>

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
<div id="form-dinamico" class="frm-new" data-form="3"></div>

<script>

detectarForm();
initForm();


async function cerrarTareaform(){
    var bandera = {};
    bandera.status = true;

    if (!frm_validar('#form-dinamico')) {
        wc();
    	error('Oops...','Debes completar los campos Obligatorios (*)');
        bandera.status = false;
    }else{
        var newInfoID = await frmGuardarConPromesa($('#form-dinamico').find('form'));
        bandera.info_id = newInfoID;
    }

    return new Promise((resolve) => {resolve(bandera)});
}
    

async function cerrarTarea() {
    wo();
    var rsp = await cerrarTareaform();

    if(!rsp.status) {
        wc();
        error('Error','Se produjo un error al guardar el formulario asociado.');
        return;
    }

    var id = $('#taskId').val();
    var dataForm = new FormData($('#generic_form')[0]);
    dataForm.append('frm_info_id', rsp.info_id);

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