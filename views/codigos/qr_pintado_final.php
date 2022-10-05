<style>

#numero_orden_final{
      margin-top:-1%;
     font-size:95px;
}

#codigoImage{
padding-top:23%;
padding-bottom: 0%;
padding-left:45%;
}

             #imagenYudi{
              padding-top:-5%;               
                width: 150px;
                height: 80px;
padding-left:0%;
              }   

             #contenedorImagenYudi{
            margin-top: -5% ;
                padding-left:35% ;
               padding-bottom: 0% ;
          }


 #tabla  {
             margin-top:3%; 
              width:550px ;
             height:300px ;
              border: 1px solid #000 ;
             font-size: 25px;
              }

</style>
<div class='row'>
<div class='col-md-12 col-sm-12 col-xs-12'>
<p id='numero_orden_final'><?php echo " ".$N_orden; ?></p>
</div>
<div class='col-md-12 col-sm-12 col-xs-12' id='contenedorImagenYudi'>

<img src="<?php echo base_url() ?>imagenes/yudica/logoYudica.png" alt="YUDICA NEUMATICOS" width="180" height="50" id='imagenYudi'>

 </div>

<div class='col-md-12 col-sm-12'>	
<table class="table table-hover table-bordered table-sm" id="tabla">
<thead>
  <tr>
    <td><strong>Cliente</strong></td>
    <td class='thead-dark'><strong><p><?php echo $Cliente ?></p></strong></td>
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