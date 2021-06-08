<style>
.frm-save {
    display: none;
}
</style>
<hr>
<input type="number" class="hidden" value="<?php echo $pema_id ?>" id="pemaId">
<h3>Despacho <small>Detalle</small></h3>
<hr>

<form id="generic_form">
    <div class="form-group">
    <label class="radio-inline">
                <input type="hidden" name="result" value="true">
    </div>

   
</form>
<div id="form-dinamico" class="frm-new" data-form="10"></div>
<br><br>
<script>

detectarForm();
initForm();



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