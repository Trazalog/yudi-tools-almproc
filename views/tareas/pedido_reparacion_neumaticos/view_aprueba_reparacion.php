<style>
.frm-save {
    display: none;
}
</style>
<hr>
<input type="number" class="hidden" value="<?php echo $pema_id ?>" id="pemaId">
<h3>Limpieza y revisión inicial <small></small></h3>
<div id="nota_pedido">
   
</div>

<form id="generic_form">
    <div class="form-group">
        <center>
            <h4 class="text-danger"> ¿Se Aprueba Trabajo? </h4>
            <label class="radio-inline">
                <input type="radio" name="result" value="true"
                    onclick="$('#motivo').hide();$('#hecho').prop('disabled',false);"> Aprobar
            </label>
            <label class="radio-inline">
                <input id="rechazo" type="radio" name="result" value="false"
                    onclick="$('#motivo').show();$('#hecho').prop('disabled',false);"> Rechazar
            </label>
        </center>
    </div>
    <hr>

<br><br>
    <div class="form-group">
        <center>
            <h4 class="text-danger"> ¿Es Enparchado Menor? </h4>
            <label class="radio-inline">
                <input type="radio" name="result1" value="true"
                    onclick="$('#hecho').prop('disabled',false);"> Si
            </label>
            <label class="radio-inline">
                <input id="rechazo" type="radio" name="result1" value="false"
                    onclick="$('#hecho').prop('disabled',false);"> No
            </label>
        </center>
    </div>
    <br><br>
    <div id="motivo" class="form-group motivo">
        <textarea class="form-control" name="motivo_rechazo" placeholder="Motivo de Rechazo..."></textarea>
    </div>
</form>
<div class="frm-new" data-form=""></div>
<script>
$('#motivo').hide();
$('#hecho').prop('disabled', true);


//agrega form dinamico
//detectarForm();
//initForm();



//cargarPedidos();

// function cargarPedidos() {
//     var id = $('#pemaId').val();
//     $.ajax({
//         type: 'POST',
//         url: 'index.php/<?php echo ALM ?>Notapedido/getNotaPedidoId?id_nota=' + id,
//         success: function(data) {

//             $('tr.celdas').remove();
//             for (var i = 0; i < data.length; i++) {
//                 var tr = "<tr class='celdas'>" +
//                     "<td>" + data[i]['artDescription'] + "</td>" +
//                     "<td class='text-center'>" + data[i]['cantidad'] + "</td>" +
//                     "<td class='text-center'>" + data[i]['fecha'] + "</td>" +
//                     "</tr>";
//                 $('table#tabladetalle tbody').append(tr);
//             }
//             $('.table').DataTable();
//         },
//         error: function(result) {

//             console.log(result);
//         },
//         dataType: 'json'
//     });
// }

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
            back();

        },
        error: function(data) {
            alert("Error");
        }
    });

}
</script>