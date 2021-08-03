<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Entidad InfoCodigo encargada de obtener informacion
* para representar codigos QR o de Barras
*
* @autor Hugo Gallardo
*/
class InfoCodigo extends CI_Controller {

		function __construct()
		{
				parent::__construct();
				$this->load->model(YUDIPROC.'InfoCodigos');
		}

		/**
		* Devuelve vista para impresion de codigo QR de la tarea revision inicial
		* @param
		* @return
		*/
		function revisionInicial()
		{
			$this->load->view('codigos/qr_revision_inicial');
			
		}


}