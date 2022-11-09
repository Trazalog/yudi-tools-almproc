<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* Entidad Infocodigo encargada de obtener informacion
* para representar codigos QR o de Barras
*
* @autor Hugo Gallardo
*/
class Infocodigo extends CI_Controller {

	function __construct()
	{
			parent::__construct();
			$this->load->model(YUDIPROC.'Infocodigos');
	}

	/**
	*  Devuelve vista para impresion de codigo QR de la tarea Pedido de Trabajo
	* @param array con datos para modal
	* @return view
	*/
	function pedidoTrabajo()
	{
		$data = $this->input->post();
		$this->load->view('codigos/qr_pedido_trabajo', $data);
	}

	/**
	* Devuelve vista para impresion de codigo QR de la tarea revision inicial
	* @param array con datos de la view
	* @return view 
	*/
	function rechazado()
	{
			$data = $this->input->post();
			$this->load->view('codigos/qr_rechazado', $data);
	}

	/**
	*  Devuelve vista para impresion de codigo QR de la tarea Pedido de Trabajo
	* @param array con datos para modal
	* @return view
	*/
	function pedidoTrabajoFinal(){
		$this->load->model(BPM.'Pedidotrabajos');
		$data = $this->input->post();
		$forms = $this->Pedidotrabajos->getFormularios($data['N_orden'])['data'][0]->forms->form;
		$i = 0;
		while ($i < count($forms)) {
			if(strpos($forms[$i]->nom_tarea, "Embandado")){
				$info_id_embandado = $forms[$i]->info_id;
			}
			++$i;
		}		
		#Si ya paso por embandado, uso los valores de ese formulario
		if(!empty($info_id_embandado)){
			$dataEmbandado = $this->Infocodigos->getDataYudica($info_id_embandado);
			foreach ($dataEmbandado as $value) {
				switch ($value->name) {
					case 'marca':
						$valor= $value->valor;
						$resultado_str = str_replace(empresa()."-marca_yudica", "", $valor);	
						$data['Marca'] = $resultado_str;
						break;
					case 'tipo_banda':
						$valor= $value->valor;
						$resultado_str = str_replace(empresa()."-banda_yudica", "", $valor);	
						$data['Banda'] = $resultado_str;
						break;
					default:
						break;
				}
			}
		}
		$this->load->view('codigos/qr_pintado_final', $data);
	}

	/**
	* Devuelve footer para impresion de codigo QR de la tarea revision inicial
	* @param array con datos de la view
	* @return view
	*/
	function pedidoTrabajoFooter()
	{
		$this->load->view('codigos/qr_pintado_final_footer');
	}

	/**
	*	Obtiene y devuelve datos para reimpresion
	* @param int petr_id; info_id
	* @return array con datos mapeado para dibujar modal y codigo QR
	*/
	function mapeoDatos($petr_id,$info_id){
		$this->load->model(BPM.'Pedidotrabajos');
		$forms = $this->Pedidotrabajos->getFormularios($petr_id)['data'][0]->forms->form;
		$i = 0;
		while ($i < count($forms)) {
			if(strpos($forms[$i]->nom_tarea, "Embandado")){
				$info_id_embandado = $forms[$i]->info_id;
			}
			++$i;
		}
		$dataPedido = $this->Infocodigos->getDataYudica($info_id);
		foreach ($dataPedido as $value) {
			switch ($value->name) {
				case 'zona':
					$datos['Zona'] = $value->valor;
					break;
				case 'marca_yudica':
					$valor= $value->valor;
					$resultado_str = str_replace(empresa()."-marca_yudica", "", $valor);	
					$datos['Marca'] = $resultado_str;
					break;
				case 'medidas_yudica':
					$valor= $value->valor;
					$resultado_str = str_replace(empresa()."-medidas_yudica", "", $valor);	
					$datos['Medida'] = $resultado_str;
					break;
				case 'banda_yudica':
					$valor= $value->valor;
					$resultado_str = str_replace(empresa()."-banda_yudica", "", $valor);	
					$datos['Banda'] = $resultado_str;
					break;
				case 'num_serie':
					$datos['Serie'] = $value->valor;
					break;
				case 'num_cubiertas':
					$datos['Num'] = $value->valor;
					break;
				case 'tipt_id':
					$datos['Trabajo'] = $value->valor;
					break;
				default:
					break;
			}
		}
		#Si ya paso por embandado, uso los valores de ese formulario
		if(!empty($info_id_embandado)){
			$dataEmbandado = $this->Infocodigos->getDataYudica($info_id_embandado);
			foreach ($dataEmbandado as $value) {
				switch ($value->name) {
					case 'marca':
						$valor= $value->valor;
						$resultado_str = str_replace(empresa()."-marca_yudica", "", $valor);	
						$datos['Marca'] = $resultado_str;
						break;
					case 'tipo_banda':
						$valor= $value->valor;
						$resultado_str = str_replace(empresa()."-banda_yudica", "", $valor);	
						$datos['Banda'] = $resultado_str;
						break;
					default:
						break;
				}
			}
		}
		echo json_encode($datos);
	}
}