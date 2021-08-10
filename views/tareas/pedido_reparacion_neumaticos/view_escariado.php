<?php	// #HGallardo
    // carga el modal de impresion de QR
    $this->load->view( COD.'componentes/modal');
?>
<style>
input[type=radio]{
  transform:scale(1.6);
}
</style>
<hr>
<input type="number" class="hidden" value="<?php echo $pema_id ?>" id="pemaId">
<h3>Escariado <small></small></h3>


<form id="generic_form">
    <div class="form-group">
        <center>
            <h3 class="text-danger"> ¿Continua Trabajo? </h3>
            <label class="radio-inline">
                <input type="radio" name="result" value="true"
                    onclick="$('#motivo').hide();$('#hecho').prop('disabled',false); $('#btnImpresion').hide();"> Si
            </label>
            <label class="radio-inline">
                <input id="rechazo" type="radio" name="result" value="false"
                    onclick="$('#motivo').show();$('#hecho').prop('disabled',false); $('#btnImpresion').show();"> No
            </label>
        </center>
    </div>

    <div id="motivo" class="form-group motivo">
        <textarea class="form-control" name="motivo_rechazo" placeholder="Motivo de Rechazo..."></textarea>
    </div>
</form>

<button type="" class="btn btn-primary habilitar" data-dismiss="modal" id="btnImpresion" onclick="modalCodigos()">Impresion</button>
<br><br><br>
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
			}, 6000);
			

					},
					error: function(data) {
							alert("Error");
					}
			});

	}
</script>


<script>  // #HGallardo

  $('#btnImpresion').hide();
	var band = 0;
  // Se peden hacer dos cosas: o un ajax con los datos o directamente
  // armar con los datos de la pantalla
  function modalCodigos(){

      if (band == 0) {
          // configuracion de codigo QR
          var config = {};
              config.titulo = "Revision Inicial";
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
      }
      // llama modal con datos e img de QR ya ingresados
      verModalImpresion();

      band = 1;
  }

  function armarInfo(arraydatos){

    $("#infoEtiqueta").load("<?php echo base_url(YUDIPROC); ?>/infoCodigo/pintadoFinal", arraydatos);
  }
</script>