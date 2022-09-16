<?php	// #HGallardo
    // carga el modal de impresion de QR
    $this->load->view( COD.'componentes/modalYudica');
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
            <h3 class="text-danger"> ¿Continúa trabajo? </h3>
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
  detectarForm();
  initForm();

  $('#titulo').hide();
  $('#comprobante').hide();
  $('#form-dinamico-rechazo').hide();
  $('#btnImpresion').hide();

function ocultarForm(){
  $('#form-dinamico-rechazo').show();
  $('#comprobante').show();
  $('#hecho').prop('disabled',false);
  $('#form-dinamico').hide();
  $('#titulo').hide();
  // muestra btn para imprimir
  $('#btnImpresion').show();
}

async function cerrarTareaform(){  
  var bandera = {};
  bandera.status = true;
  if ($('#rechazo').prop('checked') && $('#motivo_rechazo .form-control').val() == '') {
    wc();
    error('Oops...','Debes completar los campos Obligatorios (*)');
    bandera.status = false;
  }else{
    var newInfoID = await frmGuardarConPromesa($('#form-dinamico-rechazo').find('form'));
    bandera.info_id = newInfoID;
  }
  return new Promise((resolve) => {resolve(bandera)});
}


async	function cerrarTarea() {
  if(!frm_validar('#form-dinamico-rechazo')){
    error('Error..','Debes completar los campos obligatorios (*)');
    return;
  }

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
  dataForm.append('taskId', $('#taskId').val());
  
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