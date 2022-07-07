<style>
	 #modalBodyCodigos{

		font-size: 100% ;
		}
     #numero_orden{
        margin-top: -1%;
        font-size: 60px ;
        } 

      #tabla1  {
              margin-top: -5%;
               width: 100% ;
              height: 100% ; 
              border: 2px solid #000 ;
			  border-left: 2px solid #000 ; 
			  font-size: 16px ;
              }

			  #tabla2  {
              margin-top: 5%;
               width: 100% ;
              height: 100% ; 
              border: 2px solid #000 ;
			  border-left: 2px solid #000 ; 
			  font-size: 16px ;
              }		  
              
			  #tabla1 td {
                     border: 2px solid #000 ; 
				
              } 

			  #tabla1  th {
                     border: 2px solid #000 ; 
				
              } 

			  #tabla1 tr {
                     border: 2px solid #000 ; 
				
              } 

			  #contenedorImagenYudi_rechazo{
                padding-top: -20% ;
                padding-left: 3% ;
                padding-bottom: 0% ;
              } 
			  #codigoImage{
				padding-top: 7%;
                 padding-bottom: 3% ; 
                padding-left: 75% ;
              }
           
</style>
<div class='row'>
	<div class='col-md-2' id="div_numero">
	<p id='numero_orden'><?php echo " ".$N_orden; ?></p>
	</div>
</div>
<table class='table table-bordered table-striped table-sm tabla' id='tabla1'>
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
<table class='table table-bordered table-striped table-sm' id='tabla2'>
		<thead class='thead-dark' bgcolor='#eeeeee'>
		<th>Motivo: </th>
		<th><?php echo $Motivo ?></th>
		</thead>
		<tbody>
		</tbody>
</table>
<div class='d-flex justify-content-center center-block' id='rechazada'>
  <h1 class='text-center center-block'><strong>RECHAZADA</strong></h1>
</div>
<div class='d-flex justify-content-center center-block'  id='contenedorImagenYudi_rechazo'>
		<img class='center-block' src="<?php echo base_url() ?>imagenes/yudica/logoYudica.png" alt="YUDICA NEUMATICOS" width="125" height="25">
	</div>