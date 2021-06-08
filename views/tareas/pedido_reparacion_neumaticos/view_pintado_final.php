<style>
    .frm-save {
        display: none;
    }
</style>
<hr>
<input type="number" class="hidden" value="" id="">
<h3>Pintado y Acabado Final <small>Detalle</small></h3>

<hr>
   
<form id="generic_form1">
 <div class="form-group">
        <center>
            <h4 class="text-danger"> ¿Se Aprueba Trabajo? </h4>
            <label class="radio-inline">
                <input type="radio" name="result" value="ok"
                    onclick="ocultarForm();"> Aprobar
            </label>
            <label class="radio-inline">
                <input id="rechazo" type="radio" name="" value=""
                    onclick="mostrarForm();"> Rechazar
            </label>
        </center>
    </div>
</form>
<br><br>
<hr>
<div id="form-dinamico" class="frm-new" data-form="7"></div>
<br><br>
<form id="generic_form">
    <div class="form-group">
     
 <label class="col-md-3 control-label" for="">Seleccione paso del proceso al que desea volver:</label>

    <div class="col-md-6">       
        <select id="" name="result" class="form-control" required>
            <option value="" disabled selected> - Seleccionar Paso del Proceso- </option>
            <option value="SCRAP"> - SCRAP - </option>
            <option value="RASPADO_ESCARIADO"> - RASPADO_ESCARIADO - </option>
            <option value="REVISION_INICIAL"> - REVISION_INICIAL - </option>
        </select>
     </div>   
        </div>     
</form>
<br><br>
<hr>
<script>

function mostrarForm(){


 detectarForm();
initForm();

$('#form-dinamico').show();
 $('#generic_form').show();
 
}

function ocultarForm(){
 $('#form-dinamico').hide();
 $('#generic_form').hide();

}

 $('#form-dinamico').hide();
 $('#generic_form').hide();



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
   var gardado = cerrarTareaform();

    if(!gardado){
     return;
    }

    var id = $('#taskId').val();

   

   if ( $("#rechazo").is(":checked")) {
    var dataForm = new FormData($('#generic_form')[0]);
   
    var frm_info_id = $('#form-dinamico .frm').attr('data-ninfoid');
    console.log('Sale: generic_form');
    console.log('Sale frm_info_id: '+frm_info_id);
    dataForm.append('frm_info_id', frm_info_id);

   } else {
    var dataForm = new FormData($('#generic_form1')[0]);

    var frm_info_id = $('#form-dinamico .frm').attr('data-ninfoid');
    console.log('Sale: generic_form1');
    console.log('Sale frm_info_id: '+frm_info_id);
    dataForm.append('frm_info_id', frm_info_id);
   }


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
