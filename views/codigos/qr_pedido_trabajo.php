<style>
#numero_orden{
   font-size: 40px;
  float: left;
  margin-top:-15%;
  height:50px;
  width: 100px;
  margin-bottom:10%;
}
#imagenYudi{
    width: 110px;
  height: 40px;
  float:left;
  margin-top:-30%;
  margin-left:-110%;
}
#tabla  {
  border: 1px solid #000;
  width:100%;
  font-size: 18px ;
}
#contenedorCodigo{
  float:right;
  margin-top:3%;
  margin-right:10%;
  height:90px;
  width:100px;
}
#cliente{
  font-size: 18px;
}
</style>
<div class='row'>
	<div id="numOrdenEtiquetaPedidoTrabajo" class='col-md-6 col-sm-6 col-xs-6'>
		<p id='numero_orden'><?php echo " ".$N_orden; ?></p>
	</div>
	<div class='col-md-6 col-sm-6 col-xs-6' id='contenedorImagenYudiPedidoTrabajo'>
		<img src="<?php echo base_url() ?>imagenes/yudica/logoYudica.png" alt="YUDICA NEUMATICOS" id='imagenYudi'>
	</div>
  <div id="contenedorTablaPedidoTrabajo" class='col-md-12 col-sm-12'>	
    <table class="table table-hover table-bordered" id="tabla">
      <tbody>
      <tr>
          <td class='thead-dark'><strong>Fecha inicio</strong></td>
          <td class='thead-dark'><strong><?php echo $Fecha_inicio ?></strong></td>
        </tr>
        <tr>
          <td class='thead-dark'><strong>Cliente</strong></td>
          <td class='thead-dark' id="cliente"><strong><p><?php echo $Cliente ?></p></strong></td>
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
          <td class='thead-dark'><strong>Prioridad</strong></td>
          <td class='thead-dark'><strong><?php echo $Prioridad ?></strong></td>
        </tr>
        <tr>
          <td class='thead-dark'><strong>Pedido Tango</strong></td>
          <td class='thead-dark'><strong><?php echo $int_pedi_id?></strong></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>