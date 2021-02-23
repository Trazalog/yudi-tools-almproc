<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Yudiproctareas extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        // $this->load->model(ALM . 'Ordeninsumos');
        // $this->load->model(ALM . 'Notapedidos');
        // $this->load->model(ALM . 'new/Pedidosmateriales');
        // $this->load->model(ALM . 'Pedidoextra');

    }

    public function map($tarea)
    {
        $case_id = $tarea->caseId;

        $array = array();
       // $rsp = $this->getInfoPedMateriales($tarea->caseId);

        if(!$rsp['data']){
            return $array;
        }

        $infoPema = $rsp['data'];
        
        if(isset($infoPema->pema_id)){
            
            $aux = new StdClass();
            $aux->color = 'warning';
            $aux->texto = "N° Pedido: $infoPema->pema_id";
            $array['info'][] = $aux;

            $aux = new StdClass();
            $aux->color = 'warning';
            $aux->texto = "Lote: $infoPema->lote_id";
            $array['info'][] =$aux;

            $aux = new StdClass();
            $aux->color = 'warning';
            $aux->texto = "Estado: $infoPema->estado";
            $array['info'][] = $aux;

            $aux = new StdClass();
            $aux->color = 'default';
            $aux->texto = "Fecha: ".formatFechaPG($infoPema->fecha);
            $array['info'][] = $aux;

            $array['descripcion'] = $infoPema->justificacion?$infoPema->justificacion:'Pedido Materiales sin Justificación';
        }else{

          //  $data = $this->Notapedidios->getXCaseId($tarea->caseId);

            $aux = new StdClass();
            $aux->color = 'warning';
            $aux->texto = "N° Pedido: ".$data['pema_id'];
            $array['info'][] = $aux;

            $aux = new StdClass();
            $aux->color = 'warning';
            $aux->texto = "Estado: ".$data['estado'];
            $array['info'][] = $aux;

            $aux = new StdClass();
            $aux->color = 'default';
            $aux->texto = "Fecha: ".formatFechaPG($data['fecha']);
            $array['info'][] = $aux;

            $aux = new StdClass();
            $aux->color = 'default';
            $aux->texto = "Justificacion: ".$data['justificacion'];
            $array['info'][] = $aux;

        }


        return $array;
    }

     public function getXCaseId($tarea)
    {
        $case_id = $tarea->caseId;

        $aux = $ci->rest->callAPI("GET",REST_PRO."/pedidoTrabajo/xcaseid/".$case_id);
        $data_generico =json_decode($aux["data"]);
        $aux = $data_generico->pedidoTrabajo;
        return $aux;
    }
   

    public function desplegarCabecera($tarea)
    {
        $resp = infoproceso($tarea);
        return $resp;
    }

    public function desplegarVista($tarea)
    {
        switch ($tarea->nombreTarea) {
            
            case 'Recepción':

                // $data['pema_id'] = $this->Notapedidos->getXCaseId($tarea->caseId)['pema_id'];
 
                 return $this->load->view(YUDIPROC . 'tareas/pedido_reparacion_neumaticos/view_recepcion', $data, true);
                                             
                 log_message('DEBUG', 'YUDI Reparacion view-Recepción->' . $tarea->nombreTarea);

                 break;
 
            
                case 'Limpieza y revisión inicial':

                return $this->load->view(YUDIPROC . 'tareas/pedido_reparacion_neumaticos/view_aprueba_reparacion', $data, true);

                log_message('DEBUG', 'YUDI Reparacion view-Limpieza y revisión inicial->' . $tarea->nombreTarea);
                 break;
     
                 case 'Escariado':
 
                   
                     return $this->load->view(YUDIPROC . 'tareas/pedido_reparacion_neumaticos/view_escariado', $data, true);

                     log_message('DEBUG', 'YUDI Reparacion view-Escariado->' . $tarea->nombreTarea);
              
                     break;
 
                 case 'Preparacion y aplicación de Reparación':
 
                     
                         return $this->load->view(YUDIPROC . 'tareas/pedido_reparacion_neumaticos/view_preparacion', $data, true);

                         log_message('DEBUG', 'YUDI Reparacion view-Preparacion y aplicación de Reparación->' . $tarea->nombreTarea);
              
                         
         
                         break;
 
                case 'Preparacion de Banda':
 
             
                         return $this->load->view(YUDIPROC . 'tareas/pedido_reparacion_neumaticos/view_preparacion_banda', $data, true);
             
                         log_message('DEBUG', 'YUDI Reparacion view-Preparacion de Banda->' . $tarea->nombreTarea);
              

                         break;
                        
                case 'Embandado':
 
                
                         return $this->load->view(YUDIPROC . 'tareas/pedido_reparacion_neumaticos/view_embandado', $data, true);
             
                         log_message('DEBUG', 'YUDI Reparacion view-Embandado->' . $tarea->nombreTarea);
              

                         break; 
                     
                case 'Montaje':
 
                      
                         return $this->load->view(YUDIPROC . 'tareas/pedido_reparacion_neumaticos/view_montaje', $data, true);
             
                         log_message('DEBUG', 'YUDI Reparacion view-Montaje->' . $tarea->nombreTarea);
              

                         break; 
 
                case 'Raspado':
 
                                       
                         return $this->load->view(YUDIPROC . 'tareas/pedido_reparacion_neumaticos/view_raspado', $data, true);

                         log_message('DEBUG', 'YUDI Reparacion view-Raspado->' . $tarea->nombreTarea);
              
             
                         break; 
                         
                case 'Vulcanización en autoclave':
 
                           
                         return $this->load->view(YUDIPROC . 'tareas/pedido_reparacion_neumaticos/view_vulcanizado', $data, true);

                         log_message('DEBUG', 'YUDI Reparacion view-Vulcanización en autoclave->' . $tarea->nombreTarea);
              
                         
             
                         break;  
 
                case 'Desmontaje':
 
            
                         return $this->load->view(YUDIPROC . 'tareas/pedido_reparacion_neumaticos/view_desmontaje', $data, true);

                         log_message('DEBUG', 'YUDI Reparacion view-Desmontaje->' . $tarea->nombreTarea);
              
             
                         break; 
 
                case 'Pintado y acabado fina':
 
                         
                         return $this->load->view(YUDIPROC . 'tareas/pedido_reparacion_neumaticos/view_pintado_final', $data, true);

                         log_message('DEBUG', 'YUDI Reparacion view-Pintado y acabado final->' . $tarea->nombreTarea);
              
             
                         break;               
                         
            default:
                # code...
                break;
        }
    }

// Guardar guardar Pedido de Trabajo
public function guardarForms($data)
{
   // POST http://10.142.0.7:8280/services/PRODataService/pedidoTrabajo/tarea/form 
    $url = REST_PRO . '/pedidoTrabajo/tarea/form';
    $rsp = $this->rest->callApi('POST', $url, $data);
    return $rsp;
    
    if (!$rsp) {

        log_message('ERROR', '#TRAZA | #BPM >> guardarForms  >> ERROR AL FORM');

    } else {
        log_message('DEBUG', '#TRAZA | #BPM >> guardarForms  >> TODO OK');

    }

}

    



    public function getContrato($tarea, $form)
    {
     $ci =& get_instance();
     $nom_tarea = $tarea->nombreTarea;
     $task_id = $tarea->taskId;
     $case_id = $tarea->caseId;
     $user_app = userNick();
     $aux = $ci->rest->callAPI("GET",REST_PRO."/pedidoTrabajo/xcaseid/".$case_id);
     $data_generico =json_decode($aux["data"]);
     $aux = $data_generico->pedidoTrabajo;


        switch ($tarea->nombreTarea) {

    case 'Recepción':
               
               
                $data['_post_pedidotrabajo_tarea_form'] = array(

                    "nom_tarea" => "$nom_tarea",
                    "task_id" => $task_id,
                    "usuario_app" => $user_app,
                    "case_id" => $case_id,
                    "info_id" => $aux->info_id
                   
            
                );
            
            
                $rsp = $this->Yudiproctareas->guardarForms($data);
            
                if (!$rsp) {
            
                    log_message('ERROR', '#TRAZA | #BPM >> guardarForms  >> ERROR AL GUARDAR FORM');
            
                } else {
                    log_message('DEBUG', '#TRAZA | #BPM >> guardarForms  >> TODO OK');
            
                }
            
              
    break;

    case 'Preparacion y aplicación de Reparación':
 
        log_message('DEBUG', 'YUDI Reparacion view-Preparacion y aplicación de Reparación->' . $tarea->nombreTarea);

        $data['_post_pedidotrabajo_tarea_form'] = array(

            "nom_tarea" => "$nom_tarea",
            "task_id" => $task_id,
            "usuario_app" => $user_app,
            "case_id" => $case_id,
            "info_id" => $info_id
           
    
        );
    
    
        $rsp = $this->Yudiproctareas->guardarForms($data);
    
        if (!$rsp) {
    
            log_message('ERROR', '#TRAZA | #BPM >> guardarForms  >> ERROR AL GUARDAR FORM');
    
        } else {
            log_message('DEBUG', '#TRAZA | #BPM >> guardarForms  >> TODO OK');
    
        }

        break;


  case 'Preparacion de Banda':
 
            log_message('DEBUG', 'YUDI Reparacion view-Preparacion de Banda->' . $tarea->nombreTarea);
    
            $data['_post_pedidotrabajo_tarea_form'] = array(
    
                "nom_tarea" => "$nom_tarea",
                "task_id" => $task_id,
                "usuario_app" => $user_app,
                "case_id" => $case_id,
                "info_id" => $info_id
               
        
            );
        
        
            $rsp = $this->Yudiproctareas->guardarForms($data);
        
            if (!$rsp) {
        
                log_message('ERROR', '#TRAZA | #BPM >> guardarForms  >> ERROR AL GUARDAR FORM');
        
            } else {
                log_message('DEBUG', '#TRAZA | #BPM >> guardarForms  >> TODO OK FORM');
        
            }
    
            break;

    case 'Vulcanización en autoclave':
 
                log_message('DEBUG', 'YUDI Reparacion view-Vulcanización en autoclave->' . $tarea->nombreTarea);
        
                $data['_post_pedidotrabajo_tarea_form'] = array(
        
                    "nom_tarea" => "$nom_tarea",
                    "task_id" => $task_id,
                    "usuario_app" => $user_app,
                    "case_id" => $case_id,
                    "info_id" => $info_id
                   
            
                );
            
            
                $rsp = $this->Yudiproctareas->guardarForms($data);
            
                if (!$rsp) {
            
                    log_message('ERROR', '#TRAZA | #BPM >> guardarForms  >> ERROR AL GUARDAR FORM');
            
                } else {
                    log_message('DEBUG', '#TRAZA | #BPM >> guardarForms  >> TODO OK FORM');
            
                }
        
                break;

                case 'Pintado y acabado fina':
 
                    log_message('DEBUG', 'YUDI Reparacion view-Pintado y acabado final->' . $tarea->nombreTarea);
            
                    $data['_post_pedidotrabajo_tarea_form'] = array(
            
                        "nom_tarea" => "$nom_tarea",
                        "task_id" => $task_id,
                        "usuario_app" => $user_app,
                        "case_id" => $case_id,
                        "info_id" => $info_id
                       
                
                    );
                
                
                    $rsp = $this->Yudiproctareas->guardarForms($data);
                
                    if (!$rsp) {
                
                        log_message('ERROR', '#TRAZA | #BPM >> guardarForms  >> ERROR AL GUARDAR FORM');
                
                    } else {
                        log_message('DEBUG', '#TRAZA | #BPM >> guardarForms  >> TODO OK FORM');
                
                    }
            
                    break;
    

case 'Limpieza y revisión inicial':
       
    log_message('DEBUG', 'YUDI Reparacion -Limpieza y revisión inicial ');

           $contrato["apruebaTrabajo"]  = $form['result'];
          $contrato["esEmparchadoMenor"]  = $form['result1'];

          return $contrato;
     
    
    break;

    

case 'Escariado':

    log_message('DEBUG', 'YUDI Reparacion -Escariado');

           $contrato["apruebaEscariado"]  = $form['result'];
          $contrato["esEmparchadoMenor"]  = $form['result1'];

              
         return $contrato;
     
    
    break;


case 'Desmontaje':
   
    log_message('DEBUG', 'YUDI Reparacion -Desmontaje');
     
    $contrato["controlTrabajoTerminado"]  = $form['result'];
        
              
         return $contrato;
     
    
    break;

            default:
                # code...
                break;
        }
    }

    public function getInfoPedMateriales($caseId)
    {
        $resource = '/pedidoMateriales';

        $url = REST_ALM . $resource . '/' . $caseId;

        $rsp = $this->rest->callAPI('GET', $url);

        if ($rsp['status']) {

            $rsp['data'] = json_decode($rsp['data'])->info;
           
        }

        return $rsp;
    }

    public function pedidoNormal($pemaId)
    {
        //? DEBE EXISTIR LA NOTA DE PEDIDO
        $contract = [
            'pIdPedidoMaterial' => $pemaId,
        ];

        $rsp['data'] = $this->bpm->lanzarProceso(BPM_PROCESS_ID_PEDIDOS_NORMALES, $contract);

        $this->Notapedidos->setCaseId($pemaId, $rsp['data']['caseId']);

        return $this->Pedidosmateriales->setEstado($pemaId, 'Creada');
    }

    public function pedidoExtraordinario($ot = 1)
    {
        $pedidoExtra = 'Soy un Pedido';
        //? SE DEBE CORRESPONDER CON UN ID EN LA TABLE ORDEN_TRABAJO SINO NO ANDA

        $contract = [
            'pedidoExtraordinario' => $pedidoExtra,
        ];

        $data = $this->bpm->lanzarProceso(BPM_PROCESS_ID_PEDIDOS_EXTRAORDINARIOS, $contract);

        $peex['case_id'] = $data['data']['caseId'];
        $peex['fecha'] = date("Y-m-d");
        $peex['detalle'] = $pedidoExtra;
        $peex['ortr_id'] = $ot;
        $peex['empr_id'] = empresa();

        return $this->Pedidoextra->set($peex);
    }
}
