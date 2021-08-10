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
				$data = $this->input->post();
				if ( $data['tipoImpresion'] == 'reimpresion' ){

					//TODO: MAPEAR LOS DATOS PARA REHUSARLOS MODALES Y LLAMAR VIEW
					$data = $this->mapeoDatos($data['info_id']);
				}
				$this->load->view('codigos/qr_revision_inicial', $data);
		}

		/**
		* Devuelve vista para impresion de codigo QR de la tarea revision inicial
		* @param
		* @return
		*/
		function pintadoFinal()
		{
			$data = $this->input->post();
			$this->load->view('codigos/qr_pintado_final', $data);

		}

		/**
		* Devuelve footer para impresion de codigo QR de la tarea revision inicial
		* @param
		* @return
		*/
		function pintadoFinalFooter()
		{
			$data = $this->input->post();
			$this->load->view('codigos/qr_pintado_final_footer', $data);

		}

		/**
		* Devuelva info para reimpresion de etiqueta
		* @param
		* @return
		*/
		function reimpresionPedTrabajo()
		{
			$datos = $this->input->post();
			$dataSesion = $this->session->userdata();

			// traer datos de yudica modelo
			$datosModal = $this->reimpresionPedTrabajo($datos['infoid']);


		}

		/**
		*	Obtiene y devuelve datos para reimpresion
		* @param int infoid
		* @return array con datos mapeado para dibujar modal y codigo QR
		*/
		function mapeoDatos($infoid)
		{     
			$data= $this->InfoCodigos->getDataYudica($infoid);

			// arraydatos.Cliente
			// arraydatos.Medida
			// arraydatos.Marca
			// arraydatos.Serie
			// arraydatos.Num
			foreach ($data as $value) {
				switch ($value->name) {
					// case 'value':
					// 	# code...
					// 	break;
					case 'marca_yudica':
								$datos['Marca'] = $value->valor;
								break;
					case 'medidas_yudica':
								$datos['Medida'] = $value->valor;
								break;
					case 'num_serie':
								$datos['Serie'] = $value->valor;
								break;
					case 'num_cubiertas':
								$datos['Num'] = $value->valor;
								break;

						default:

								break;
				}
			}

			$datos['Cliente'] = "";
			return $datos;
		}

}