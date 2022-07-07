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
<input type="number" class="hidden" value="" id="">
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


	function mostrarForm(){


			detectarForm();
			initForm();

			$('#form-dinamico').show();


			setTimeout(function(){ $('#generic_form').show() ; }, 8000);

			

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
		var bandera = true ;
if ( $("#rechazo").is(":checked")) {
		if ( $('input[name="bordes"]:checked').length == 0) {
		
		console.log("Error campos Obligatorios");
			Swal.fire(
				'Error...',
				'Debes completar los campos Obligatorios (*)',
				'error'
			)
		
		bandera = false;
		
		return bandera;

	}

	else if ( $('input[name="parche_pegado"]:checked').length == 0) {

	console.log("Error campos Obligatorios");
		Swal.fire(
			'Error...',
			'Debes completar los campos Obligatorios (*)',
			'error'
		)

		bandera = false;
		
		return bandera;

		}	

		else if ( $('input[name="globos"]:checked').length == 0) {
			
			console.log("Error campos Obligatorios");
				Swal.fire(
					'Error...',
					'Debes completar los campos Obligatorios (*)',
					'error'
				)

				bandera = false;
		
				return bandera;

		}

		else if ( $('input[name="tajeada"]:checked').length == 0) {
			
			console.log("Error campos Obligatorios");
				Swal.fire(
					'Error...',
					'Debes completar los campos Obligatorios (*)',
					'error'
				)

				bandera = false;
		
				return bandera;

		}

		else if ( $('input[name="extremos_pegados"]:checked').length == 0) {
			
			console.log("Error campos Obligatorios");
				Swal.fire(
					'Error...',
					'Debes completar los campos Obligatorios (*)',
					'error'
				)

				bandera = false;
		
				return bandera;

		}

		// else if ( $('input[name="pintado"]:checked').length == 0) {
			
		// 	console.log("Error campos Obligatorios");
		// 		Swal.fire(
		// 			'Error...',
		// 			'Debes completar los campos Obligatorios (*)',
		// 			'error'
		// 		)

		// 	bandera = false;
			
		// 	return bandera;

		// }
		
		else if ( $('#result option:selected').val() == 0) {
		
			console.log("Error campos Obligatorios");
				Swal.fire(
					'Error...',
					'Debes seleccione paso del proceso al que desea volver',
					'error'
				)

				bandera = false;
		
				return bandera;

		}
	}
}
	function cerrarTareaform(){
			debugger;
		
			if (ValidarCampos() == false) {
				
				Swal.fire(
					'Error...',
					'Validando Campos Obligatorios',
					'error'
				)

				return false;

			}
			 else{

			$('#form-dinamico .frm-save').click();
			var info_id = $('#form-dinamico .frm').attr('data-ninfoid');
			console.log('info_id:' + info_id);
			console.log('Formulario Guardado con exito -function cerrarTareaform');

			
			return true;

			}
		

			
					

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

<script>  // #HGallardo
	// oculta btn para imprimir
	$('#btnImpresion').hide();
  var band = 0;
  // Se peden hacer dos cosas: o un ajax con los datos o directamente
  // armar con los datos de la pantalla
  function modalCodigos(){
	  //supongo que entra
debugger;
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
              arraydatos.Medida = $('select[name="medidas_yudica"]').select2('data')[0].text;
              arraydatos.Marca = $('select[name="marca_yudica"]').select2('data')[0].text;
              arraydatos.Serie = $('#num_serie').val();
              arraydatos.Num = $('#num_cubiertas').val();
			 
			  arraydatos.Zona = $('#zona').val();
              arraydatos.Trabajo = $('#tipo_proyecto').val();
              arraydatos.Banda = $('select[name="banda_yudica"]').select2('data')[0].text;
			  
			// si la etiqueta es derechazo
		    arraydatos.Motivo = $('#motivo_rechazo').val();

          // info para grabar en codigo QR
          armarInfo(arraydatos);
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
