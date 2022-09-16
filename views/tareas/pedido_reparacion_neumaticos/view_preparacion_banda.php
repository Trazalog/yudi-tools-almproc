<style>
.frm-save {
    display: none;
}
</style>
<hr>
<input type="number" class="hidden" value="" id="">
<h3>Cabina <small>Detalle</small></h3>
<hr>

<div id="form-dinamico" class="frm-new" data-form="6"></div>

<script>

detectarForm();
initForm();


$('#view').ready(function() {
wo();
    alertify.success("Cargando datos en la vista aguarde...");
    
    setTimeout(function() {
        wc();    
        tomarDatos();
}, 9000);
   
    
});


function tomarDatos(){
    $('select[name="tipo_banda"]').val($('select[name="banda_yudica"]').val()).trigger('change');
    $('select[name="medida"]').val($('select[name="medidas_yudica"]').val()).trigger('change');
    $('select[name="marca"]').val($('select[name="marca_yudica"]').val()).trigger('change');
    $('#motivo_cambio').closest('div').hide();
}


$('#view').on('select2:select', function (e) {
    $('#motivo_cambio').closest('div').show();
});



async function cerrarTareaform(){
    var bandera = {};
    bandera.status = true ;
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