<style>
#numero_orden{
  margin-top: -1%;
  font-size: 60px ;
}
#imagenYudi{
  width: 100px;
  height: 50px;
}   
#tabla  {
  border: 1px solid #000 ;
  font-size: 16px ;
}
#contenedorCodigo{
  text-align: center;
}
</style>
<div class='row'>
	<div id="numOrdenEtiquetaFinal" class='col-md-6 col-sm-6 col-xs-6'>
		<p id='numero_orden'><?php echo " ".$N_orden; ?></p>
	</div>
	<div class='col-md-6 col-sm-6 col-xs-6' id='contenedorImagenYudiPedidoTrabajo'>
		<img src="<?php echo base_url() ?>imagenes/yudica/logoYudica.png" alt="YUDICA NEUMATICOS" id='imagenYudi'>
	</div>
  <div id="contenedorTablaPedidoTrabajo" class='col-md-12 col-sm-12'>	
    <table class="table table-hover table-bordered table-sm" id="tabla">
      <tbody>
        <tr>
          <td class='thead-dark'><strong>Cliente</strong></td>
          <td class='thead-dark'><strong><p><?php echo $Cliente ?></p></strong></td>
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
      </tbody>
    </table>
  </div>
</div>