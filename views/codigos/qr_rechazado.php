<div class='row'>
	<div class='col-md-2'>
	<p><strong>N° de Orden: </strong><?php echo " ".$N_orden; ?></p>
	</div>
				<!-- <div class='col-md-8 col-sm-8 col-xs-12'>   width="250" height="50"-->
	<div class='col-md-7 col-sm-7 center-block' style="margin-bottom:10px;">
		<img class='center-block' src="<?php echo base_url() ?>imagenes/yudica/logoYudica.png" alt="YUDICA NEUMATICOS" width="125" height="25">
	</div>
	<div class='col-md-3'>
		<p> <?php echo date("d/m/Y") ?> </p>
	</div>
</div>
<table class='table table-bordered table-striped table-sm'>
		<thead class='thead-dark' bgcolor='#eeeeee'>
			<th>Cliente</th>
			<th>Medida</th>
			<th>Marca</th>
			<th>Serie</th>
		</thead>
		<tbody>
			<tr>
				<td><strong><?php echo $Cliente ?></strong></td>
				<td><strong><?php echo $Medida ?></strong></td>
				<td><strong><?php echo $Marca ?></strong></td>
				<td><strong><?php echo $Serie ?></strong></td>
			</tr>
		</tbody>
</table>
<table class='table table-bordered table-striped table-sm'>
		<thead class='thead-dark' bgcolor='#eeeeee'>
		<th>Motivo: </th>
		<th><?php echo $Motivo ?></th>
		</thead>
		<tbody>
		</tbody>
</table>
<div class='d-flex justify-content-center'>
  <h3 class='text-center'><strong>RECHAZADA</strong></h3>
</div>