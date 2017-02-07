<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Fileupload extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        error_reporting(E_ALL | E_STRICT);
        $this->load->library('UploadHandler','','up');
		$this->load->model('M_dashboard','',TRUE);
    }

    function index()
    {
    }

    function delete($idArchivo){
	$file_name = $this->M_dashboard->deleteFileUpload($idArchivo);
	$this->up->deleteSingle(array($file_name), true);
	$log = $this->M_dashboard->saveLogPedidos($idArchivo,array($this->session->userdata('user_id'),'Archivo Eliminado'),array());
    }

    function agrega(){
		$id = 0;
		if (isset($_REQUEST['idPedido'])){
			$filename = $_FILES['files']['name'][0];
			$id = $this->M_dashboard->saveFileUpload($_REQUEST['idPedido'], $filename, 'ticket');
			$respuesta = $this->up->post(false, $id);
			//log_message('Error', var_export($respuesta));
			foreach ($respuesta['files'] as $res){
				if (isset($res->error)){
					$file_name = $this->M_dashboard->deleteFileUpload($id);
					$this->up->deleteSingle(array($file_name), true);
				}
				else{
					if (!isset($res->thumbnailUrl))
						$res->thumbnailUrl = base_url('assets/img/file.png');
					$this->M_dashboard->updateFileUpload($id, $res);
				}
			}
			echo json_encode($respuesta);
		}
		else {
			$idPedido = $this->session->userdata('idPedido');
			$this->session->unset_userdata('idPedido');
			$this->limpiaHuerfanos();
			echo $this->listaArchivos($idPedido);
		}
    }

    function agregaProducto($tipo_registro = 'ticket'){
    	$id = 0;
    	if (isset($_FILES['files'])){
    		$filename = $_FILES['files']['name'][0];
    		if (isset($_REQUEST['idPedido']))
    			$idProducto = $_REQUEST['idPedido'];
    		else
    			$idProducto = 0;
    		$id = $this->M_dashboard->saveFileUpload($idProducto, $filename, $tipo_registro);
    		$respuesta = $this->up->post(false, $id);
    		//log_message('Error', var_export($respuesta));
    		foreach ($respuesta['files'] as $res){
    			if (isset($res->error)){
    				$file_name = $this->M_dashboard->deleteFileUpload($id);
    				$this->up->deleteSingle(array($file_name), true);
    			}
    			else{
    				if (!isset($res->thumbnailUrl))
    					$res->thumbnailUrl = base_url('assets/img/file.png');
    				//echo json_encode($res); exit;
    				$this->M_dashboard->updateFileUpload($id, $res);
    				$log = $this->M_dashboard->saveLogPedidos($idProducto,array($this->session->userdata('user_id'),'Archivo Agregado'),array());
    			}
    		}
    
    		echo json_encode($respuesta);
    	}
    	else {
    		$idPedido = $this->session->userdata('idPedido');
    		$this->session->unset_userdata('idPedido');
    		$this->limpiaHuerfanos();
    		echo $this->listaArchivosPorTipo($idPedido, $tipo_registro);
    	}
    }
    
    
    function listaArchivos($idPedido = 0, $es_producto = false){
	$listado = $this->M_dashboard->getUploadFiles($idPedido, $es_producto);
	return json_encode($listado, JSON_NUMERIC_CHECK);
    }
    
    function listaArchivosPorTipo($idPedido = 0, $tipo_registro = 'ticket'){
    	$listado = $this->M_dashboard->getUploadFilesByType($idPedido, $tipo_registro);
    	return json_encode($listado, JSON_NUMERIC_CHECK);
    }
    
    function limpiaHuerfanos(){
    	$archivos = $this->M_dashboard->limpiaFileUpload($this->session->userdata('user_id'));
    	$this->up->deleteSingle($archivos, true);
    }
}
