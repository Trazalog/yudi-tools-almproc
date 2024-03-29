<style>
.frm-save {
    display: none;
}
input[type=radio]{
  transform:scale(1.6);
}
</style>
<hr>
<!-- <input type="number" class="hidden" value="<?php // echo $pema_id ?>" id="pemaId"> -->

<?php // #HGallardo
    // carga el modal de impresion de QR
    $this->load->view( COD.'componentes/modalYudica');
?>

<h3>Revisión Inicial <small></small></h3>
<form id="generic_form">
    <div class="form-group">
        <center>
            <h3 class="text-danger"> ¿Se Aprueba Trabajo? </h3>
            <label class="radio-inline">
                <input id="aprobar" type="radio" name="result" value="true"
                    onclick="mostrarForm();"> Aprobar
            </label>
            <label class="radio-inline">
                <input id="rechazo" type="radio" name="result" value="false"
                    onclick="ocultarForm()"> Rechazar
            </label>
        </center>
    </div>
    <hr>

    <br>
 
</form>

<h4 id="titulo">Seleccione Parche a Utilizar <small></small></h4>
<div id="form-dinamico" class="frm-new" data-form="9"></div>
<div id="form-dinamico-rechazo" class="frm-new" data-form="51"></div>

<button type="" class="btn btn-primary habilitar" data-dismiss="modal" id="btnImpresion" onclick="modalCodigos()">Impresion</button>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Datos del Comprobante</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div id="comprobante" class="form-group motivo">
        <table class="table" id="tbl_comprobante">
          <thead>
            <tr>
              <th scope="col">Numero de cubiertas</th>
              <th scope="col">Numero de pedido</th>
              <th scope="col">Cliente</th>
              <th scope="col">Medida</th>
              <th scope="col">Marca</th>
              <th scope="col">N° de Serie</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><input id="num_cubiertas" name="num_cubiertas" type="text" value="" class="form-control input-md"></td>
              <td><input id="num_pedido" name="num_pedido" type="text" value="" class="form-control input-md"></td>
              <td><input id="medidas_yudica" name="medidas_yudica" type="text" value="" class="form-control input-md"></td>
              <td><input id="marca_yudica" name="marca_yudica" type="text" value="" class="form-control input-md"></td>
              <td><input id="num_serie" name="num_serie" type="text" value="" class="form-control input-md"></td>
              <td><input id="banda_yudica" name="banda_yudica" type="text" value="" class="form-control input-md"></td>
            </tr>
        
          </tbody>
        </table>
        <br><br><br>
        <a type="button" href="<?php echo base_url();?>" class="btn btn-primary" target="_blank">Imprimir comprobante de Rechazo</a>

      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>

  function getFormData(){
    var array_form = {};
    $('#form-dinamico-cabecera').find(':input').each(function() {
      array_form[this.name] = this.value;

      });

    $.each(array_form, function( index, value ) {
        console.log( index + ": " + value );
 
    });


  }

  getFormData();

  function mostrarForm(){

      detectarForm();
      initForm();

      $('#form-dinamico').show();
      $('#titulo').show();
      $('#form-dinamico-rechazo').hide();
      $('#comprobante').hide();
      // oculta btn para imprimir
      $('#btnImpresion').hide();
  }

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

  $('#form-dinamico').hide();
  $('#titulo').hide();
  $('#comprobante').hide();
   // $('#motivo').show();
   $('#form-dinamico-rechazo').show();

  $('#btnImpresion').hide();


  async function cerrarTareaform(){
    var bandera = {};
    bandera.status = true;

    if($("#rechazo").is(":checked") || $("#aprobar").is(":checked")){
      if ( $("#rechazo").is(":checked")) {
        bandera.formulario = "#form-dinamico-rechazo";
        if (!frm_validar(bandera.formulario)) {
          bandera.status = false;
        }else{
          $('#form-dinamico-rechazo .frm').attr('id','rechazo-form');
          var newInfoID = await frmGuardarConPromesa($('#form-dinamico-rechazo').find('form'));
          bandera.status = true;
          bandera.info_id = newInfoID;
        } 
      }else{
        bandera.formulario = "#form-dinamico";
        if (!frm_validar('#form-dinamico')) {
          bandera.status = false;
        }else{
          var newInfoID = await frmGuardarConPromesa($('#form-dinamico').find('form'));
          bandera.status = true;
          bandera.info_id = newInfoID;
        }
      }
    }else{
      bandera.status = false;
    }
  return new Promise((resolve) => {resolve(bandera)});
}

async function cerrarTarea() {
  if ($("#rechazo").is(":checked") && $('#motivo_rechazo').val() == '') {
    error('Error!','Por favor complete el campo motivo de rechazo...');
    return;
  }
  wo();
  var rsp = await cerrarTareaform();

  if(!rsp.status) {
    wc();
    error('Oops...','Debes completar los campos Obligatorios (*)');
    return;
  }
  var id = $('#taskId').val();

  var dataForm = new FormData($('#generic_form')[0]);
  dataForm.append('taskId', $('#taskId').val());
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

<script>  // #HGallardo
  var band = 0;
  // Se peden hacer dos cosas: o un ajax buscando datos o directamente
  // armar con los datos de la pantalla
  function modalCodigos(){
    debugger;
    // si es rechazado el pedido debe llenar el input motivo
    if (!frm_validar('#form-dinamico-rechazo')) {
      error('Error!','Por favor complete el campo Motivo de Rechazo...');
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

    $("#infoEtiqueta").load("<?php echo base_url(YUDIPROC); ?>/Infocodigo/rechazado", arraydatos);
  }
</script>