<div class='row'>
	<div class='col-md-2'>
		<p> <?php echo $Num ?> </p>
	</div>
				<!-- <div class='col-md-8 col-sm-8 col-xs-12'> -->
	<div class='col-md-6 col-sm-6 col-xs-6' style="margin-bottom:5px;">
		<img class='center-block' src="<?php echo base_url() ?>imagenes/yudica/logoYudica.png" alt="YUDICA NEUMATICOS" width="100" height="25">
	</div>
	<div class='col-md-4'>
		<p> <?php echo date("d/m/Y") ?> </p>
	</div>
</div>
<div class='row'>
	<div class='col-md-4 col-sm-4'>
		<p>Cliente: <?php echo $Cliente ?> </p>
	</div>
</div>
<div class='col-md-12 col-sm-12'>
<table class='table table-bordered table-striped'>
		<thead class='thead-dark' bgcolor='#eeeeee'>
			<th>Trabajo</th>
			<tr>
			<td> <?php echo $Trabajo ?></td>
			</tr>
			<tr>
			<th>Medida</th>
			</tr>
			<tr>
			<td><?php echo $Medida ?></td>
			</tr>
			<tr>
			<th>Marca</th>
			</tr>
			<tr>
			<td> <?php echo $Marca ?></td>
			</tr>
			<tr>
			<th>Serie</th>
			</tr>
			<tr>
			<td> <?php echo $Serie ?></td>		
		</thead>
</table>
</div>