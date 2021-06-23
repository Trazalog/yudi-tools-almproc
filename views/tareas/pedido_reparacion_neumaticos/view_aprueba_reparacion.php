<style>
    .frm-save {
        display: none;
    }
</style>
<hr>
<!-- <input type="number" class="hidden" value="<?php // echo $pema_id ?>" id="pemaId"> -->
<h3>Revisión Inicial <small></small></h3>
<form id="generic_form">
    <div class="form-group">
        <center>
            <h4 class="text-danger"> ¿Se Aprueba Trabajo? </h4>
            <label class="radio-inline">
                <input type="radio" name="result" value="true"
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
 
    <div id="motivo" class="form-group motivo">
        <textarea class="form-control" name="motivo_rechazo" placeholder="Motivo de Rechazo..."></textarea>
    </div>
</form>
<h4 id="titulo">Seleccione Parche a Utilizar <small></small></h4>
<div id="form-dinamico" class="frm-new" data-form="9"></div>


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
      <td><input id="num_pedido" name="num_pedido" type="text" value="14141" class="form-control input-md"></td>
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

debugger;


  function getFormData(){

   var array_form = {};
   $('#form-dinamico-cabecera').find(':input').each(function() {
    array_form[this.name] = this.value;

    });

 $.each(array_form, function( index, value ) {
    console.log( index + ": " + value );
    debugger;


// if (index =="num_cubiertas" ) {

//     $('#num_cubiertas').val(value);
    
// } 
// if else (index =="medidas_yudica" ) {

// $('#medidas_yudica').val(value);

// } 

// if else (index =="marca_yudica" ) {

// $('#marca_yudica').val(value);

// } 

// if else (index =="num_serie" ) {

// $('#num_serie').val(value);

// } 

// if else (index =="banda_yudica" ) {

// $('#banda_yudica').val(value);

// } 

// else {

// }

   
});


                 }


getFormData();

//$('#tbl_comprobante').append('<tr><td></td><td >'+ config[this.name]+'</td><td>'+ config[this.name]+'</td><td>'+ config[this.name]+'</td></tr>')
</script>
									


<script>



function mostrarForm(){


detectarForm();
initForm();


$('#form-dinamico').show();
$('#titulo').show();
$('#motivo').hide();
$('#comprobante').hide();
}

function ocultarForm(){

$('#motivo').show();
$('#comprobante').show();
$('#hecho').prop('disabled',false);
$('#form-dinamico').hide();
$('#titulo').hide();
// 
//Modal de Imprimir Comprobante Maqueta
//$('#exampleModal').modal('show');

}

$('#form-dinamico').hide();
 $('#titulo').hide();
 $('#comprobante').hide();
$('#motivo').hide();
 


function cerrarTarea() {

 var frm_info_id = $('#form-dinamico .frm').attr('data-ninfoid');

    if ($('#rechazo').prop('checked') && $('#motivo .form-control').val() == '') {
        alert('Completar Motivo de Rechazo');
        return;
    }

    var id = $('#taskId').val();
console.log(id);

    var dataForm = new FormData($('#generic_form')[0]);

    dataForm.append('taskId', $('#taskId').val());

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
         //   back();
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