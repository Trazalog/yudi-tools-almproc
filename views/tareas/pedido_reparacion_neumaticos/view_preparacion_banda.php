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
    debugger
$('select[name="tipo_banda"]').val($('select[name="banda_yudica"]').val()).trigger('change');

$('select[name="medida"]').val($('select[name="medidas_yudica"]').val()).trigger('change');

$('select[name="marca"]').val($('select[name="marca_yudica"]').val()).trigger('change');
$('#motivo_cambio').hide();

}


$('#view').on('select2:select', function (e) {
    $('#motivo_cambio').show();
});



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
        var info_id = $('#form-dinamico .frm').attr('data-ninfoid');
        console.log('info_id:' + info_id);
         console.log('Formulario Guardado con exito -function cerrarTareaform');
        }

        return bandera; 
  }
    

function cerrarTarea() {
    debugger;

    var frm_info_id = $('#form-dinamico .frm').attr('data-ninfoid');

   var gardado = cerrarTareaform();

    if(!gardado){
     return;
    }

    var id = $('#taskId').val();

    var dataForm = new FormData($('#generic_form')[0]);
   
    dataForm.append('frm_info_id', frm_info_id);


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
		}, 6000);
    
        },
        error: function(data) {
            alert("Error");
        }
    });
debugger;
}
</script>