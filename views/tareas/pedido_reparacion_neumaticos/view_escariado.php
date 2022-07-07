<?php	// #HGallardo
    // carga el modal de impresion de QR
    $this->load->view( COD.'componentes/modal');
?>
<style>
.frm-save {
    display: none;
}
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
                    onclick="$('#form-dinamico-rechazo').hide();$('#hecho').prop('disabled',false); $('#btnImpresion').hide();"> Si
            </label>
            <!-- <label class="radio-inline">
                <input id="rechazo" type="radio" name="result" value="false"
                    onclick="$('#motivo').show();$('#hecho').prop('disabled',false); $('#btnImpresion').show();"> No
            </label> -->
            <label class="radio-inline">
                <input id="rechazo" type="radio" name="result" value="false"
                    onclick="ocultarForm()"> Rechazar
            </label>
        </center>
    </div>

    <!-- <div id="motivo" class="form-group motivo">
        <textarea class="form-control" name="motivo_rechazo" placeholder="Motivo de Rechazo..."></textarea>
    </div> -->
</form>
<div id="form-dinamico-rechazo" class="frm-new" data-form="51"></div>
<br><br>
<button type="" class="btn btn-primary habilitar" data-dismiss="modal" id="btnImpresion" onclick="modalCodigos()">Impresion</button>
<br><br><br>

<script>

  $('#titulo').hide();
  $('#comprobante').hide();
   // $('#motivo').show();
  $('#form-dinamico-rechazo').hide();

  $('#btnImpresion').hide();

	// $('#motivo').hide();
	// $('#hecho').prop('disabled', true);

function ocultarForm(){

detectarForm();
initForm();

 // $('#motivo').show();
  $('#form-dinamico-rechazo').show();

  $('#comprobante').show();
  $('#hecho').prop('disabled',false);
  $('#form-dinamico').hide();
  $('#titulo').hide();
  // muestra btn para imprimir
  $('#btnImpresion').show();

}

function cerrarTareaform(){
    debugger;
    var bandera = true ;

    if ($('#rechazo').prop('checked') && $('#motivo_rechazo .form-control').val() == '') {
        Swal.fire(
					'Oops...',
					'Debes completar los campos Obligatorios (*)',
					'error'
				)
                bandera = false;
       return bandera;
			}

    else{

    $('#form-dinamico-rechazo .frm-save').click();
        var info_id = $('#form-dinamico-rechazo .frm').attr('data-ninfoid');
        console.log('info_id:' + info_id);
         console.log('Formulario Guardado con exito -function cerrarTareaform');
        }

        return bandera; 
  }


	function cerrarTarea() {
			debugger;
			if ($('#rechazo').prop('checked') && $('#motivo_rechazo .form-control').val() == '') {
					alert('Completar Motivo de Rechazo');
					return;
			}
		
   var gardado = cerrarTareaform();

    if(!gardado){
     return;
    }

    var id = $('#taskId').val();
	console.log(id);


    var frm_info_id = $('#form-dinamico-rechazo .frm').attr('data-ninfoid');

    var dataForm = new FormData($('#generic_form')[0]);
   
    dataForm.append('frm_info_id', frm_info_id);

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

// si es rechazado el pedido debe llenar el input motivo
var rechazo = $("#motivo_rechazo").val();
if ((rechazo == undefined) || (rechazo == "")) {
  Swal.fire(
          'Error!',
          'Por favor complete el campo Motivo de Rechazo...',
          'error'
      )

  return;
}

if (band == 0) {
  debugger;
    // configuracion de codigo QR
    var config = {};
        config.titulo = "Revision Inicial";
        config.pixel = "2";
        config.level = "S";
        config.framSize = "2";
    // info para immprimir  medidas_yudica
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
}
// llama modal con datos e img de QR ya ingresados
verModalImpresion();

band = 1;
}
  function armarInfo(arraydatos){

    $("#infoEtiqueta").load("<?php echo base_url(YUDIPROC); ?>/infocodigo/rechazado", arraydatos);
  }
</script>