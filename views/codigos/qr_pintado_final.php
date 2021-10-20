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
    <td class='thead-dark'>Medida</td>
    <td class='thead-dark'><?php echo $Medida ?></td>
  </tr>
  <tr>
    <td class='thead-dark'>Marca</td>
    <td class='thead-dark'><?php echo $Marca ?></td>
  </tr>
  <tr>
    <td class='thead-dark'>Serie</td>
    <td class='thead-dark'><?php echo $Serie ?></td>
  </tr>
  <tr>
    <td class='thead-dark'>E1</td>
    <td class='thead-dark'>E2</td>
  </tr>
  <tr>
    <td class='thead-dark'>F1</td>
    <td class='thead-dark'>F2</td>
  </tr>
  <tr>
    <td class='thead-dark'>G1</td>
    <td class='thead-dark'>G2</td>
  </tr>
  <tr>
    <td class='thead-dark'>H1</td>
    <td class='thead-dark'>H2</td>
  </tr>
  <tr>
    <td class='thead-dark'>I1</td>
    <td class='thead-dark'>I2</td>
  </tr>
</tbody>
</table>