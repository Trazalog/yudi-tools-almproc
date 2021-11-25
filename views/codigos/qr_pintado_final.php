<div class='row'>
	<div class='col-md-2'>
		<p> <?php echo $Num ?> </p>
	</div>
				<!-- <div class='col-md-8 col-sm-8 col-xs-12'> -->
	<div class='col-md-8 col-sm-8 center-block' style="margin-bottom:10px;">
		<img class='center-block' src="<?php echo base_url() ?>imagenes/yudica/logoYudica.png" alt="YUDICA NEUMATICOS" width="250" height="50">
	</div>
	<div class='col-md-2'>
		<p> <?php echo date("d/m/Y") ?> </p>
	</div>
</div>


<table class='table table-bordered table-striped'>
<thead>
  <tr>
    <th class='thead-dark'>Cliente</th>
    <th class='thead-dark'><?php echo $Cliente ?></th>
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