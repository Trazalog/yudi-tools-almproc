<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Entidad InfoCodigo encargada de obtener informacion
* para representar codigos QR o de Barras
*
* @autor Hugo Gallardo
*/
class InfoCodigos extends CI_Model
{
		function __construct()
		{
			parent::__construct();
		}

		/**
		* Devuelva info para reimpresion de etiqueta
		* @param
		* @return
		*/
		function reimpresionPedTrabajo($data)
		{     


		}

		/**
		*
		* @param
		* @return
		*/
		function getDataYudica($infoid)
		{
			http://10.142.0.13:8280/services/FRMDataService/formulario/471
			$aux = $this->rest->callAPI("GET",REST_FRM."/formulario/".$infoid);
			$aux =json_decode($aux["data"]);
			return $aux->formulario->items->item;

		}

}
