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
        $ci =& get_instance();
        $nom_tarea = $tarea->nombreTarea;
        $task_id = $tarea->taskId;
        $case_id = $tarea->caseId;
        $user_app = userNick();
        $aux_pedido = $ci->rest->callAPI("GET",REST_PRO."/pedidoTrabajo/xcaseid/".$case_id);
        $data_generico =json_decode($aux_pedido["data"]);
        $aux_pedido = $data_generico->pedidoTrabajo;
        

        
        if(isset($case_id)){
            
            $aux = new StdClass();
            $aux->color = 'success'; //primary //secondary // success // danger // warning // info // light // dark //white 
            $aux->texto = "N° Codigo:  $aux_pedido->cod_proyecto";
            $array['info'][] = $aux;

            $aux = new StdClass();
            $aux->color = 'primary';
            $aux->texto = "Objetivo:  $aux_pedido->objetivo   $aux_pedido->unidad_medida";
            $array['info'][] =$aux;

            $aux = new StdClass();
            $aux->color = 'warning';
            $aux->texto = "Estado: $aux_pedido->estado ";
            $array['info'][] = $aux;

            $aux = new StdClass();
            $aux->color = 'danger';
            $aux->texto = "Fecha Inicio: ".formatFechaPG( $aux_pedido->fec_inicio);
            $array['info'][] = $aux;

            $aux = new StdClass();
            $aux->color = 'default';
            $aux->texto = "Fecha Entrega: ".formatFechaPG( $aux_pedido->fec_entrega);
            $array['info'][] = $aux;

            $array['descripcion'] =  $aux_pedido->descripcion;
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
            
            //paso 1 quitado
        
                case 'Revisión Inicial':

                return $this->load->view(YUDIPROC . 'tareas/pedido_reparacion_neumaticos/view_aprueba_reparacion', $data, true);

                log_message('DEBUG', 'YUDI Reparacion view-Revisión Inicial->' . $tarea->nombreTarea);

                 break;
     
            //paso 3
                 case 'Raspado y Escariado':
 
                    
                     return $this->load->view(YUDIPROC . 'tareas/pedido_reparacion_neumaticos/view_escariado', $data, true);

                     log_message('DEBUG', 'YUDI Raspado y Escariado view-Escariado->' . $tarea->nombreTarea);
              
                     break;

            //paso 4
                case 'Relleno, Corte de  Banda y Embandado':
                      
             
                         return $this->load->view(YUDIPROC . 'tareas/pedido_reparacion_neumaticos/view_preparacion_banda', $data, true);
             
                         log_message('DEBUG', 'YUDI Reparacion view-Preparacion de Banda->' . $tarea->nombreTarea);
              

                         break;
                        
              //paso 5           
                case 'Autoclave':
 
                           
                         return $this->load->view(YUDIPROC . 'tareas/pedido_reparacion_neumaticos/view_vulcanizado', $data, true);

                         log_message('DEBUG', 'YUDI Reparacion view-Vulcanización en autoclave->' . $tarea->nombreTarea);
              
                         
             
                         break;  

              //paso 6
                case 'Pintado y acabado final':
 
                         
                         return $this->load->view(YUDIPROC . 'tareas/pedido_reparacion_neumaticos/view_pintado_final', $data, true);

                         log_message('DEBUG', 'YUDI Reparacion view-Pintado y acabado final->' . $tarea->nombreTarea);
              
             
                         break;   

              //paso 7           
                case 'Despacho':

    
                    return $this->load->view(YUDIPROC . 'tareas/pedido_reparacion_neumaticos/view_desmontaje', $data, true);

                    log_message('DEBUG', 'YUDI Reparacion view-Despacho->' . $tarea->nombreTarea);
        
        
                    break;            
                         
            default:
                                                 
            log_message('DEBUG', 'YUDI Default view-Default- Nombre de tarea>' . $tarea->nombreTarea);

                break;
        }
    }

// Guardar Pedido de Trabajo
public function guardarForms($data)
{
   // POST http://10.142.0.7:8280/services/PRODataService/pedidoTrabajo/tarea/form 
    $url = REST_PRO . '/pedidoTrabajo/tarea/form';
    $rsp = $this->rest->callApi('POST', $url, $data);
    return $rsp;
    
    if (!$rsp) {

        log_message('ERROR', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> ERROR AL FORM');

    } else {
        log_message('DEBUG', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> TODO OK');

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
 //paso 1
    case 'Revisión Inicial':       

    $data['_post_pedidotrabajo_tarea_form'] = array(

            "nom_tarea" => "$nom_tarea",
            "task_id" => $task_id,
            "usuario_app" => $user_app,
            "case_id" => $case_id,
            "info_id" => $form['frm_info_id']
    
        );
    
    
        $rsp = $this->Yudiproctareas->guardarForms($data);
    
        if (!$rsp) {
    
            log_message('ERROR', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> ERROR AL GUARDAR FORM - Revisión Inicial');
    
        } else {
            log_message('DEBUG', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> GUARDADO OK FORM - Revisión Inicial');
    
        }
                   
            $contrato["apruebaTrabajo"]  = $form['result'];

              return $contrato;
         
        break;
    
    //paso 3
        case 'Raspado y Escariado':
     
            
        log_message('DEBUG', 'YUDI Reparacion -Escariado');
    
               $contrato["apruebaEscariado"]  = $form['result'];
              
    
                  
             return $contrato;
         
        
        break;

 //paso 4 "Cabina" view_preparacion_banda
        case 'Relleno, Corte de  Banda y Embandado':
 
            log_message('DEBUG', 'YUDI Reparacion view-Preparacion de Banda->' . $tarea->nombreTarea);
    
            $data['_post_pedidotrabajo_tarea_form'] = array(
    
                "nom_tarea" => "$nom_tarea",
                "task_id" => $task_id,
                "usuario_app" => $user_app,
                "case_id" => $case_id,
                "info_id" => $form['frm_info_id']
               
        
            );
        
        
            $rsp = $this->Yudiproctareas->guardarForms($data);
        
            if (!$rsp) {
        
                log_message('ERROR', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> ERROR AL GUARDAR FORM - Preparacion de Banda');
        
            } else {
                log_message('DEBUG', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> GUARDADO OK FORM - Preparacion de Banda');
        
            }
    
            break;

          
    //paso 5
            case 'Autoclave':
 
                log_message('DEBUG', 'YUDI Reparacion view-Vulcanización en autoclave->' . $tarea->nombreTarea);
        
                $data['_post_pedidotrabajo_tarea_form'] = array(
        
                    "nom_tarea" => "$nom_tarea",
                    "task_id" => $task_id,
                    "usuario_app" => $user_app,
                    "case_id" => $case_id,
                    "info_id" => $form['frm_info_id']
                   
            
                );
            
            
                $rsp = $this->Yudiproctareas->guardarForms($data);
            
                if (!$rsp) {
            
                    log_message('ERROR', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> ERROR AL GUARDAR FORM - Vulcanización en autoclave');
            
                } else {
                    log_message('DEBUG', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> GUARDADO OK FORM - Vulcanización en autoclave');
            
                }
        
                break;

        //paso 6
                case 'Pintado y acabado final':
 
                    log_message('DEBUG', 'YUDI Reparacion view-Pintado y acabado final->' . $tarea->nombreTarea);
            
                    if ($form['result'] == 'ok') {

                        log_message('DEBUG', 'YUDI Reparacion -Pintado y acabado final contrato', json_encode($form['result'],true) );
     
                        $contrato["retornaAPaso"]  = $form['result'];
                            
                                  
                             return $contrato;
                
                        break;


                    }else {

                       
                        $data['_post_pedidotrabajo_tarea_form'] = array(
            
                            "nom_tarea" => "$nom_tarea",
                            "task_id" => $task_id,
                            "usuario_app" => $user_app,
                            "case_id" => $case_id,
                            "info_id" => $form['frm_info_id']
                           
                    
                        );
                    
                    
                        $rsp = $this->Yudiproctareas->guardarForms($data);
                    
                        if (!$rsp) {
                    
                            log_message('ERROR', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> ERROR AL GUARDAR FORM - Pintado y acabado final');
                    
                        } else {
                            log_message('DEBUG', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> GUARDADO OK FORM - Pintado y acabado final');
                    
                        }

                        log_message('DEBUG', 'YUDI Reparacion -Pintado y acabado final contrato', json_encode($form['result'],true) );
     
                        $contrato["retornaAPaso"]  = $form['result'];
                            
                                  
                             return $contrato;
                
                        break;
                    }

                   

case 'Despacho':
   

         log_message('DEBUG', 'YUDI Reparacion view- Reparacion -Despacho->' . $tarea->nombreTarea);
        
         $data['_post_pedidotrabajo_tarea_form'] = array(
 
             "nom_tarea" => "$nom_tarea",
             "task_id" => $task_id,
             "usuario_app" => $user_app,
             "case_id" => $case_id,
             "info_id" => $form['frm_info_id']
            
     
         );
     
     
         $rsp = $this->Yudiproctareas->guardarForms($data);
     
         if (!$rsp) {
     
             log_message('ERROR', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> ERROR AL GUARDAR FORM - YUDI -Despacho');
     
         } else {
             log_message('DEBUG', '#TRAZA | #BPM >> guardarForms asociado a la tarea >> GUARDADO OK FORM - YUDI -Despacho');
     
         }
     
            $contrato["controlTrabajoTerminado"]  = $form['result'];
        
              
         return $contrato;
 
         break;

            default:
                # code...
                break;
        }
    }

   
}