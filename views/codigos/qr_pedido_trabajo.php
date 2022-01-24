<div class='row'>
	<div class='col-md-4'>
		<p><strong>N° de Orden:</strong>  </p>
	</div>
				<!-- <div class='col-md-8 col-sm-8 col-xs-12'> -->
	<div class='col-md-12 col-sm-12 col-xs-12' style="margin-bottom:5px;" id='contenedorImageQR'>
		<img class='center-block' src="<?php echo base_url() ?>imagenes/yudica/logoYudica.png" alt="YUDICA NEUMATICOS" width="180" height="50">
	</div>
	<div class="col-md-2 col-md-offset-10">
		<p> <?php echo date("d/m/Y") ?> </p>
	</div>
</div>

</div>
<div class='col-md-12 col-sm-12'>	
<table class="table table-hover table-bordered table-sm" id="tabla">
<thead>
  <tr>
    <th><strong>Nombre de Cliente</strong></th>
    <th class='thead-dark'><strong><?php echo $Cliente ?></strong></th>
  </tr>
</thead>
<tbody>
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
    <td class='thead-dark'><strong>Banda</strong></td>
    <td class='thead-dark'><strong><?php echo $Banda ?></strong></td>
  </tr>
</tbody>
</table>
</div>