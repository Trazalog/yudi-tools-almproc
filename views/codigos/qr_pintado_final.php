<style>
     #numero_orden_final{
        margin-top: -1%;
        font-size: 90px ;
        } 

    
              #imagenYudi{
                margin-top: -20% ;
                width: 120px;
                height: 70px;
              }   

              #contenedorImagenYudi{
                padding-top: -20% ;
                padding-left: 68% ;
                padding-bottom: 0% ;
              } 

              #tabla  {
              margin-top: -20%;
              width: 350px ;
              height: 400px ;
              border: 0,5px solid #000 ;
              
              }

</style>
<div class='row'>
	<div class='col-md-6 col-sm-6 col-xs-6'>
		<p id='numero_orden_final'><?php echo " ".$N_orden; ?></p>
	</div>
				<!-- <div class='col-md-8 col-sm-8 col-xs-12'> -->
	<div class='col-md-6 col-sm-6 col-xs-6' id='contenedorImagenYudi'>
		<img src="<?php echo base_url() ?>imagenes/yudica/logoYudica.png" alt="YUDICA NEUMATICOS" width="180" height="50" id='imagenYudi'>
	</div>

</div>
<div class='col-md-6 col-sm-6'>	
<table class="table table-hover table-bordered table-sm" id="tabla">
<thead>
  <tr id='tr_tabla'>
    <th id='tabla_th'><strong>Cliente</strong></th>
    <th class='thead-dark' id='tr_tabla'><strong><p id='nombreCliente'><?php echo $Cliente ?></p></strong></th>
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