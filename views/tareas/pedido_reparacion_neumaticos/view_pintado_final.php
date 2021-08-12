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
    $this->load->view( COD.'componentes/modal');
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
<form id="generic_form"></form>
    <div class="form-group">
     
				<label class="col-md-3 control-label" for="">Seleccione paso del proceso al que desea volver:</label>

				<div class="col-md-6">
						<select id="" name="result" class="form-control" required>
								<option value="" disabled selected> - Seleccionar Paso del Proceso- </option>
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

	function mostrarForm(){


			detectarForm();
			initForm();

			$('#form-dinamico').show();
			$('#generic_form').show();

			// oculta btn para imprimir
      $('#btnImpresion').hide();

	}

	function ocultarForm(){
			$('#form-dinamico').hide();
			$('#generic_form').hide();

			// oculta btn para imprimir
      $('#btnImpresion').show();

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

<script>  // #HGallardo
	// oculta btn para imprimir
	$('#btnImpresion').hide();
  var band = 0;
  // Se peden hacer dos cosas: o un ajax con los datos o directamente
  // armar con los datos de la pantalla
  function modalCodigos(){

      if (band == 0) {
          // configuracion de codigo QR
          var config = {};
              config.titulo = "Pintado y Acabado Final";
              config.pixel = "5";
              config.level = "L";
              config.framSize = "2";
          // info para immprimir
          var arraydatos = {};
              arraydatos.Cliente = $('#cliente').val();
              arraydatos.Medida = $('select[name="medidas_yudica"] option:selected').val();
              arraydatos.Marca = $('select[name="marca_yudica"] option:selected').val();
              arraydatos.Serie = $('#num_serie').val();
              arraydatos.Num = $('#num_cubiertas').val();
          // info para grabar en codigo QR
          armarInfo(arraydatos);
          // agrega codigo QR al modal impresion
          getQR(config, arraydatos);

      }
      // llama modal con datos e img de QR ya ingresados
      verModalImpresion();

      band = 1;
  }

  function armarInfo(arraydatos){

    $("#infoEtiqueta").load("<?php echo base_url(YUDIPROC); ?>/Infocodigo/pedidoTrabajo", arraydatos);
    $("#infoFooter").load("<?php echo base_url(YUDIPROC); ?>/Infocodigo/pedidoTrabajoFooter");
  }
</script>
