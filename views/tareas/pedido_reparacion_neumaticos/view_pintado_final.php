<style>
    .frm-save {
        display: none;
    }
    input[type=radio]{
        transform:scale(1.6);
    }
</style>

<?php // #HGallardo
    // carga el modal de impresion de QR
    $this->load->view( COD.'componentes/modalYudica');
?>

<hr>
<input type="text" class="hidden" value="<?php echo $Marca?>" id="marcaEmbandado">
<input type="text" class="hidden" value="<?php echo $Banda?>" id="bandaEmbandado">
<input type="text" class="hidden" value="<?php echo $Medida?>" id="medidaEmbandado">
<input type="hidden" id="empresaSeleccionada" value='<?php echo empresa(); ?>'>
<h3>Pintado y Acabado Final <small>Detalle</small></h3>

<hr>
   
<form id="generic_form1">
 <div class="form-group">
        <center>
            <h4 class="text-danger"> ¿Se Aprueba Trabajo? </h4>
            <label class="radio-inline">
                <input type="radio" name="result" id="Aprobar" value="ok"
                    onclick="ocultarForm();"> Aprobar
            </label>
            <label class="radio-inline">
                <input type="radio" name="result"  id="rechazo" value=""
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
						<select id="result" name="result" class="form-control" required>
								<option value="0" disabled selected> - Seleccionar Paso del Proceso- </option>
								<option value="SCRAP"> - SCRAP - </option>
								<option value="RASPADO_ESCARIADO"> - RASPADO_ESCARIADO - </option>
								<option value="REVISION_INICIAL"> - REVISION_INICIAL - </option>
                <option value="CABINA"> - CABINA - </option>
						</select>
				</div>
    </div>
</form>

<br><br>
<hr>

<button type="" class="btn btn-primary habilitar" data-dismiss="modal" id="btnImpresion" onclick="modalCodigos()">Impresion</button>

<script>
$('#form-dinamico').hide();
$('#generic_form').hide();
detectarForm();
initForm();

function mostrarForm(){
	$('#form-dinamico').show();
	$('#generic_form').show();
	// oculta btn para imprimir
	$('#btnImpresion').hide();
}

function ocultarForm(){
	$('#generic_form').hide();

	$('#form-dinamico').hide();
	$('#generic_form').hide();

	// oculta btn para imprimir
	$('#btnImpresion').show();

}

//validar campos obligatorios del formulario dinamico
function ValidarCampos(){
	debugger;
	var empresa = $('#empresaSeleccionada').val();
	var bandera = true;
	if ( $("#rechazo").is(":checked")) {
		if ( $('input[name="' + empresa + '-bordes"]:checked').length == 0) {
			error('Error...','Debes completar los campos Obligatorios (*)');
			bandera = false;
			return bandera;
		}else if ( $('input[name="' + empresa + '-parche_pegado"]:checked').length == 0) {
			error('Error...','Debes completar los campos Obligatorios (*)');
			bandera = false;
			return bandera;
		}else if ( $('input[name="' + empresa + '-globos"]:checked').length == 0) {
			error('Error...','Debes completar los campos Obligatorios (*)');
			bandera = false;
			return bandera;
		}else if ( $('input[name="' + empresa + '-tajeada"]:checked').length == 0) {
			error('Error...','Debes completar los campos Obligatorios (*)');
			bandera = false;
			return bandera;
		}else if ( $('input[name="' + empresa + '-extremos_pegados"]:checked').length == 0) {
			error('Error...','Debes completar los campos Obligatorios (*)');
			bandera = false;
			return bandera;
		}else if ( $('input[name="' + empresa + '-pintado"]:checked').length == 0) {
			error('Error...','Debes completar los campos Obligatorios (*)');
			bandera = false;
			return bandera;
		}else if ( $('#result option:selected').val() == 0) {
			error('Error...','Debes seleccione paso del proceso al que desea volver');
			bandera = false;
			return bandera;
		}
	}else{
		if(!$("#Aprobar").is(":checked")){
			bandera = false;
		}
	}
	return bandera;
}
async function cerrarTareaform(){
	var respuesta = {};
    respuesta.status = true;
	if (ValidarCampos() == false) {
		wc();
		error('Error...','Validando Campos Obligatorios');
		respuesta.status = false;
	}else{
		var newInfoID = await frmGuardarConPromesa($('#form-dinamico').find('form'));
        respuesta.info_id = newInfoID;
	}
	return new Promise((resolve) => {resolve(respuesta)});
}	

async function cerrarTarea() {
	wo();
  	var rsp = await cerrarTareaform();

	if(!rsp.status){
		return;
	}
	
	var id = $('#taskId').val();
	if ( $("#rechazo").is(":checked")) {
		var dataForm = new FormData($('#generic_form')[0]);
		dataForm.append('frm_info_id', rsp.info_id);
	} else {
		var dataForm = new FormData($('#generic_form1')[0]);
		dataForm.append('frm_info_id', rsp.info_id);
	}

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

<script>  // #HGallardo
	// oculta btn para imprimir
	$('#btnImpresion').hide();
  var band = 0;
  // Se peden hacer dos cosas: o un ajax con los datos o directamente
  // armar con los datos de la pantalla
  function modalCodigos(){
	  //supongo que entra
      if (band == 0) {
          // configuracion de codigo QR
          var config = {};
              config.titulo = "Pintado y Acabado Final";
              config.pixel = "2";
              config.level = "S";
              config.framSize = "2";
          // info para immprimir
          var arraydatos = {};
		 	  arraydatos.N_orden = $('#petr_id').val();
              arraydatos.Cliente = $('#cliente').val();
              arraydatos.Medida = (_isset($('#medidaEmbandado').val())) ? $('#medidaEmbandado').val() : $('select[name="medidas_yudica"]').select2('data')[0].text;
              arraydatos.Marca = (_isset($('#marcaEmbandado').val())) ? $('#marcaEmbandado').val() : $('select[name="marca_yudica"]').select2('data')[0].text;
              arraydatos.Serie = $('#num_serie').val();
              arraydatos.Num = $('#num_cubiertas').val();
			  arraydatos.fec_entrega = $('#fec_entrega').val();
			  arraydatos.Zona = $('#zona').val();
              arraydatos.Trabajo = $('#tipo_proyecto').val();
              arraydatos.Banda = (_isset($('#bandaEmbandado').val())) ? $('#bandaEmbandado').val() : $('select[name="banda_yudica"]').select2('data')[0].text;
			  
			// si la etiqueta es derechazo
		    arraydatos.Motivo = $('#motivo_rechazo').val();

          // info para grabar en codigo QR
          armarInfo(arraydatos);
		  console.log(arraydatos);
          // agrega codigo QR al modal impresion
          getQR(config, arraydatos, 'codigosQR/Traz-comp-Yudica');

      }
      // llama modal con datos e img de QR ya ingresados
      verModalImpresion();

      band = 1;
  }

  function armarInfo(arraydatos){

    $("#infoEtiqueta").load("<?php echo base_url(YUDIPROC); ?>/Infocodigo/pedidoTrabajoFinal", arraydatos);
    $("#infoFooter").load("<?php echo base_url(YUDIPROC); ?>/Infocodigo/pedidoTrabajoFooter");
  }
</script>
