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
		<thead class='thead-dark' bgcolor='#eeeeee'>
			<th>Cliente</th>
			<th>Medida</th>
			<th>Marca</th>
			<th>Serie</th>
		</thead>
		<tbody>
			<tr>
				<td> <?php echo $Cliente ?> </td>
				<td> <?php echo $Medida ?> </td>
				<td> <?php echo $Marca ?> </td>
				<td> <?php echo $Serie ?> </td>
			</tr>
		</tbody>
</table>

<div class='d-flex justify-content-center'>
  <h1 class='text-center'>RECHAZADA</h1>
</div>