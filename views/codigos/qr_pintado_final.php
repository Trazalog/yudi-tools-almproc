<style>

#numero_orden_final{
  margin-top:-15%; 
  font-size:90px;
  float: left;
  height:100px;
  margin-left:-5%;
  width: 300px;
}

#contenedorCodigo{
  float:right;
  margin-right: -1px;
  height:120px;
  width:130px;
} 
#imagenYudiFinal{
  width: 250px;
  height: 75px;
  float:left;
  margin-top:-70%;
  margin-left:-10%;
}
#tabla  {
  border: 1px solid #000 ;
  font-size: 25px;
}
#cliente_etiquetaFin{
    font-size: 30px;
}
.box{
  border-top:none;
}
</style>
<div class='row'>
  <div id="numOrdenEtiquetaFinal" class='col-md-6 col-sm-6 col-xs-6 box'>
    <p id='numero_orden_final'><?php echo " ".$N_orden; ?></p>
  </div>
  <div class='col-md-6 col-sm-6 col-xs-6' id='contenedorImagenYudi'>
    <img src="<?php echo base_url() ?>imagenes/yudica/logoYudica.png" width="150" height="80" alt="YUDICA NEUMATICOS" id='imagenYudiFinal'>
  </div>
  <div id="contenedorTablaEtiquetaFinal" class='col-md-12 col-sm-12'>	
    <table class="table table-hover table-bordered table-sm" id="tabla">
      <tbody>
        <tr>	
          <td class='thead-dark'><strong>Fecha Fin</strong></td>
          <td class='thead-dark'><strong><?php echo $Fecha_entrega ?></strong></td>
        </tr>
        <tr>
          <td><strong>Cliente</strong></td>
          <td class='thead-dark' id="cliente_etiquetaFin"><strong><p><?php echo $Cliente ?></p></strong></td>
        </tr>
        <tr>	
          <td class='thead-dark'><strong>Zona</strong></td>
          <td class='thead-dark'><strong><?php echo $Zona ?></strong></td>
        </tr>
        <tr>
          <td class='thead-dark'><strong>Medida</strong></td>
          <td class='thead-dark'><strong><?php echo $Medida ?></strong></td>
        </tr>
        <tr>
          <td class='thead-dark'><strong>Marca</strong></td>
          <td class='thead-dark'><strong><?php echo $Marca ?></strong></td>
        </tr>
        <tr>
          <td class='thead-dark'><strong>Banda</strong></td>
          <td class='thead-dark'><strong><?php echo $Banda ?></strong></td>
        </tr>
        <tr>
          <td class='thead-dark'><strong>Serie / N° interno</strong></td>
          <td class='thead-dark'><strong><?php echo $Serie ?></strong></td>
        </tr>
        <tr>
          <td class='thead-dark'><strong>Trabajo</strong></td>
          <td class='thead-dark'><strong><?php echo $Trabajo ?></strong></td>
        </tr>
        <tr>
          <td class='thead-dark'><strong>Cantidad</strong></td>
          <td class='thead-dark'><strong><?php echo $Num ?></strong></td>
        </tr>
        <tr>
          <td class='thead-dark'><strong>Pedido Tango</strong></td>
          <td class='thead-dark'><strong><?php echo $int_pedi_id ?></strong></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>