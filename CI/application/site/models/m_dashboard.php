<?php
class M_dashboard extends CI_Model
{
    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
        $this->datos = $this->load->database();
        $this->load->library('consultas',$this);
    }
    // returns an object
    function _get_result($data){
        if($data->num_rows() > 0)
            return $data->result();
        else
            return false;
    }
    // returns an array
    function _get_result_array($data){
        if($data->num_rows() > 0)
            return $data->result_array();
        else
            return false;
    }
    // returns the amount of affected rows
    function _get_affected_rows(){
        if($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }
    // returns the number of rows
    function _get_num_rows($data){
        return $data->num_rows();
    }

    public function getMenuAdmin(){
    	/* Se Genera el Menu para el Admin  */
    	$datos = array(0);
    	$sql = $this->sql['s_trae_menus'];
    	$result = $this->db->query($sql,$datos);
    	$data = $this->_get_result_array($result);
    	$enlaces = array();
    	foreach ($data as $key => $value) {
    		$enlaces[] = $value['link'];
    		$result = $this->db->query($this->sql['s_trae_menus'],$value['id_menu']);
    		$data2  = $this->_get_result_array($result);
    		if($this->_get_num_rows($result) > 0){
    			foreach ($data2 as $keyx => $valuex) {
    				$valuex['nombre_submenu'] = $valuex['nombre_menu'];
    				$valuex['link_submenu'] = $valuex['link'];
    				$valuex['icono_submenu'] = $valuex['icono_menu'];
    				$data2[$keyx] = $valuex;
    			}
    			$data[$key]['sub_menu'][]['items'] = $data2;
    		}else{
    			$data[$key]['sub_menu'] = array();
    		}
    	}
    	$menuOriginal = $data;
    	/* Se genera el Menu con las otras opciones */
    	$sql = $this->sql['s_trae_otros_menus'];
    	$contenedor = array(
    			'id_menu' => 0,
    			'nombre_menu' => 'Otros Men&uacute;s',
    			'link' => '#',
    			'icono_menu' => 'plus-circle',
    			'id_padre' => 0,
    			'sub_menu' => array(array('items' => array()))    			
    			);
    	$data = array();
    	$result = $this->db->query($sql,$datos);
    	$listado = $this->_get_result_array($result);
    	foreach ($listado as $key => $value) {
    		if (!in_array($value['link'], $enlaces))
    		{
    			$enlaces[] = $value['link'];
	    		$result = $this->db->query($this->sql['s_trae_menus'],$value['id_menu']);
	    		$data2  = $this->_get_result_array($result);
	    		if($this->_get_num_rows($result) > 0){
	    			foreach ($data2 as $keyx => $valuex) {
	    				$valuex['nombre_submenu'] = $valuex['nombre_menu'];
	    				$valuex['link_submenu'] = $valuex['link'];
	    				$valuex['icono_submenu'] = $valuex['icono_menu'];
	    				$data2[$keyx] = $valuex;
	    			}
	    			$data[$key]['sub_menu'][]['items'] = $data2;
	    		}else{
	    			$data[$key]['sub_menu'] = array();
	    			$data[$key]['nombre_submenu'] = $value['nombre_menu'];
	    			$data[$key]['link_submenu'] = $value['link'];
	    			$data[$key]['icono_submenu'] = $value['icono_menu'];
	    		}
    		}
    	}
    	$contenedor['sub_menu'][0]['items'] = $data;
    	array_splice($menuOriginal, 1, 0, array($contenedor));
    	return $menuOriginal;
    }
        
    public function getMenu(){
		if ($this->session->userdata('idPerfil')){
			if ($this->session->userdata('idPerfil') == -1)
				return $this->getMenuAdmin();
			else
			{
				$sql = $this->sql['s_trae_menus_perfil'];
				$datos = array(0, $this->session->userdata('idPerfil'));
			}
		}
		else{
			//return $this->getMenuAdmin();
			$sql = $this->sql['s_trae_menus'];
			$datos = array(0);
		}
    	$result = $this->db->query($sql,$datos);
        $data = $this->_get_result_array($result);
        foreach ($data as $key => $value) {
                $result = $this->db->query($this->sql['s_trae_menus'],$value['id_menu']);
                $data2  = $this->_get_result_array($result);
                if($this->_get_num_rows($result) > 0){
                     foreach ($data2 as $keyx => $valuex) {
                         $valuex['nombre_submenu'] = $valuex['nombre_menu'];
                         $valuex['link_submenu'] = $valuex['link'];
                         $valuex['icono_submenu'] = $valuex['icono_menu'];
                         $data2[$keyx] = $valuex;
                    }
                    $data[$key]['sub_menu'][]['items'] = $data2;
                }else{
                    $data[$key]['sub_menu'] = array();
                }
        }
        return $data;
    }
    public function getCategorias() {
        $data     = array();
        $result   = $this->db->query($this->sql['s_getCategorias'],$data);
        $data     = $this->_get_result_array($result);
        return $data;   
    }
    public function getPedidos() {
        $data     = array();
        $result   = $this->db->query($this->sql['s_getPedidos'],$data);
        $data     = $this->_get_result_array($result);
        $data     = $data[0];
        return $data;   
    }
	public function getEstadosPedidos() {
        $data     = array();
        $result   = $this->db->query($this->sql['s_getEstadosPedidos'],$data);
        $data     = $this->_get_result_array($result);
        return $data;   
    }

    public function getTipoKits() {
    	$data     = array();
    	$result   = $this->db->query($this->sql['s_getTipoKits'],$data);
    	$data     = $this->_get_result_array($result);
    	return $data;
    }

    public function getSegurosAsociados() {
        $data     = array();
        $result   = $this->db->query($this->sql['s_getSeguros'],$data);
        $data     = $this->_get_result_array($result);
        //$data[0] = array('id' => 0, 'nombre' => 'Seleccione...');
        return $data;
    }    
    
    public function getWebContent($tipo, $data = array()) {
		$result   = $this->db->query($this->sql[$tipo],$data);
		$data     = $this->_get_result_array($result);
		return $data;	
	}
    public function getContentById($id,$tabla){
        $data   = $id;
        $result = $this->db->query($this->sql[$tabla],$data);
        $data   = $this->_get_result_array($result);
        return $data[0];
    }
    public function getContentByEstado($estados = '') {
		$data     = array();
		$texto    = str_replace('%%%',$estados, $this->sql['s_pedidosByEstado']);
		$result   = $this->db->query($texto);
		$data     = $this->_get_result_array($result);
		return $data;	
	}

	public function saveContentById($id,$data){
		$data     = array_merge((array)$data,(array)$id);
        $result   = $this->db->query($this->sql['u_savecontentbyid'],$data);
        $data     = $this->_get_affected_rows($result);
        return $data;
	}
    public function getestadoFromId($id){
        $data     = array();
        $result   = $this->db->query($this->sql['getestadoFromId'],$id);
        $data     = $this->_get_result_array($result);
        return $data;   
    }
    public function saveLogPedidos($id,$data,$data2)
    {
        $data1     = array_merge((array)$id,(array)$data);
        $data2     = array_merge((array)$data2,(array)$id);
        $result   = $this->db->query($this->sql['i_logpedidos'],$data1);
        $data     = $this->_get_affected_rows($result);
        return $data;
    }
    public function getLogPedidosById($id){
        $data   = $id;
        $result = $this->db->query($this->sql['s_getLogPedidosById'],$data);
        $data   = $this->_get_result_array($result);
        return $data;
    }

    public function saveLogProductos($id,$data,$data2)
    {
    	$data1     = array_merge((array)$id,(array)$data);
    	$data2     = array_merge((array)$data2,(array)$id);
    	$result   = $this->db->query($this->sql['i_logproductos'],$data1);
    	$data     = $this->_get_affected_rows($result);
    	return $data;
    }
    
    public function getLogProductosById($id){
    	$data   = $id;
    	$result = $this->db->query($this->sql['s_getLogProductosById'],$data);
    	$data   = $this->_get_result_array($result);
    	return $data;
    }
    
    public function saveLogRobo($id,$data,$data2)
    {
    	$data1     = array_merge((array)$id,(array)$data);
    	$data2     = array_merge((array)$data2,(array)$id);
    	$result   = $this->db->query($this->sql['i_logrobos'],$data1);
    	$data     = $this->_get_affected_rows($result);
    	return $data;
    }
    
    public function getLogRoboById($id){
    	$data   = $id;
    	$result = $this->db->query($this->sql['s_getLogRobosById'],$data);
    	$data   = $this->_get_result_array($result);
    	return $data;
    }
    
    public function savePedidoscontent($id, $data){
        $data1    = array_merge((array)$data,(array)$id);
        $result   = $this->db->query($this->sql['u_savepedidosbyid'],$data1);
        return true;
    }

    public function saveFileUpload($idPedido = 0, $nombre = '', $tipo_registro = 'ticket', $user_id = ''){
    	if ($user_id == '')
    		$user_id = $this->session->userdata('user_id');
		$result = $this->db->query("insert into gq_archivos (id_pedido, nombre, user_id, tipo_registro) values (?, ?, ?, ?)",array($idPedido, $nombre, $user_id, $tipo_registro));
		$id = $this->db->insert_id();
		return $id;
    }

    public function updateIdFileUpload($idPedido = 0, $user_id = 0, $tipo_registro = 'ticket'){
    	$result = $this->db->query("update gq_archivos set id_pedido = ? where id_pedido = 0 and user_id = ? and tipo_registro = ?",array($idPedido, $user_id, $tipo_registro));
    }
    
    public function updateFileUpload($idArchivo, $datos){
	$result = $this->db->query("update gq_archivos set nombre = ?, size = ?, type = ?, url = ?, thumbnailUrl = ?, deleteUrl = ?  where id = ?", array($datos->name, $datos->size, $datos->type, $datos->url, $datos->thumbnailUrl, $datos->deleteUrl, $idArchivo));
    }

    public function deleteFileUpload($idArchivo = 0){
	$result = $this->db->query("select nombre from gq_archivos where id = ?",$idArchivo);
	$data = $this->_get_result_array($result);
	$nombre = $data[0]['nombre'];
	$result = $this->db->query("delete from gq_archivos where id = ?",$idArchivo);	
	return $nombre;
    }

    public function getUploadFiles($idPedido = 0, $es_producto = false){
	$result = $this->db->query("select a.id, a.nombre as name, a.size, a.type, a.url, a.thumbnailUrl, a.deleteUrl, 'POST' as deleteType, concat(b.first_name,' ', b.last_name) as nombreUsuario from gq_archivos as a join users as b on (a.user_id = b.id) where a.id_pedido = ? and a.es_producto = ?", array($idPedido, $es_producto));
	return array("files" => $this->_get_result_array($result));
    }
    
    public function getUploadFilesByType($idPedido = 0, $tipo_registro = 'ticket'){
    	$result = $this->db->query("select a.id, a.nombre as name, a.size, a.type, a.url, a.thumbnailUrl, a.deleteUrl, 'POST' as deleteType, concat(b.first_name,' ', b.last_name) as nombreUsuario from gq_archivos as a join users as b on (a.user_id = b.id) where a.id_pedido = ? and a.tipo_registro = ?", array($idPedido, $tipo_registro));
    	return array("files" => $this->_get_result_array($result));
    }

    public function limpiaFileUpload($user_id = 0){
    	$result = $this->db->query("select nombre from gq_archivos where id_pedido = 0 and user_id = ?",$user_id);
    	$archivos = array();
    	foreach ($result->result_array() as $row){
    		$archivos[] = $row['nombre'];
    	}
    	$result->free_result();
    	$result = $this->db->query("delete from gq_archivos where user_id = ? and id_pedido = 0",$user_id);
    	return $archivos;
    }
    
    public function creaProductoIndividual($idProducto = 0, $tipo_etiqueta){
    	$datos = $this->getContentById($idProducto,'s_getproductosbyid');
        if($tipo_etiqueta == 'Numerico')
            $choice = 'numeric';
        else
            $choice = 'alnum';
    	for ($i=0; $i < intval($datos['cantidad_folios']); $i++){
    		$folio = random_string($choice,10);
    		$result = $this->db->query('insert into gq_producto_individual (id_producto, folio, estado, fecha_creacion) values (?,?,"disponible", now())',array($idProducto, $folio));
    	}
    }
    
    public function cambiaEstadoFolio($idFolios = array(), $estado = 'aprobado'){
    	if (!empty($idFolios)){
    		$listado = implode(",", $idFolios);
    		$this->db->query("update gq_producto_individual set estado = ? where id in (".$listado.")", $estado);
    	}
    }
    
    public function datosVerProducto($idProducto = 0){
    	if ($idProducto != 0){
    		$salida = $this->getContentById($idProducto,'s_getproductosbyid');
		if(!$salida)
			return false;
    		$salida['aprobado'] = '0';
    		$salida['rechazado'] = '0';
    		$salida['disponible'] = '0';
    		$salida['gestionado'] = '0';
    		$result = $this->db->query('select count(*) as total, estado from gq_producto_individual where id_producto = ? and idestado > 0 group by estado', $idProducto);
    		foreach ($result->result_array() as $fila) {
				if($fila['estado'] == 'dado por robo')
					$salida['gestionado'] = $fila['total'];
				else
    					$salida[$fila['estado']] = $fila['total'];
    		}
    		return $salida;
    	}
	else
		return false;
    }
    
    public function getFoliosProductoByEstado($data_prod){
    	if($data_prod[1] == 'gestionado')
    		$result = $this->db->query($this->sql['s_getFoliosGestionados'],$data_prod[0]);
    	else
    		$result = $this->db->query($this->sql['s_getFoliosByEstado'],array($data_prod[0], $data_prod[1]));
    
    	if ($result->num_rows() > 0){
		log_message('PHP', '[M] Registros devueltos:'.print_r($result->result_array(), true));
    		return $result->result_array();
    	}
    	else{
    		return false;
    	}
    }
    
    public function getListaProductoIndividual($idProducto = 0){
    	$result = $this->db->query("select * from gq_producto_individual where id_producto = ? and estado = 'disponible'", $idProducto);
    	if ($result->num_rows() > 0){
    		return $result->result_array();
    	}
    	else{
    		return false;
    	}
    }

    public function getFolioFromProductoIndividual($id){
    	$data     = false;
    	$result   = $this->db->query($this->sql['s_getIdKitProductos'],$id);
    	if ($result->num_rows() > 0){
    		$data     = $result->result_array();
    	}
    	return $data;
    }
    
    public function getFolioImprenta($id){
    	$data     = false;
    	$result   = $this->db->query($this->sql['s_getFoliosImprenta'],array($id,$id));
    	if ($result->num_rows() > 0){
    		$data     = $result->result_array();
    	}
    	return $data;
    }
    
    public function getActivacion($id = 0){
    	$salida = false;
    	if ($id != 0){
    		$result = $this->db->query($this->sql['s_getActivacion'], $id);
    		if ($result->num_rows() > 0){
    			$salida = $result->row_array();
    		}
    	}
    	return $salida;
    }
    
    public function getEmpresas($paraDropbox = true){
    	$data     = false;
    	$result   = $this->db->query($this->sql['s_getEmpresas']);
    	if ($result->num_rows() > 0){
    		if ($paraDropbox){
    			$data['0'] = ' - Seleccione La Empresa - ';
    			foreach ($result->result() as $row)
    				$data[$row->id] = $row->name;
    		}
    		else
    			$data     = $result->result_array();
    	}
    	return $data;
    }

    public function getSeguros($paraDropbox = true){
        $data     = false;
        $result   = $this->db->query($this->sql['s_getSeguros']);
        if ($result->num_rows() > 0){
            if ($paraDropbox){
                $data['0'] = ' - Seleccione Seguro - ';
                foreach ($result->result() as $row)
                    $data[$row->id] = $row->name;
            }
            else
                $data     = $result->result_array();
        }
        return $data;
    }    
    
    public function getTipoProductos()
    {
    	$salida = false;
    	$result = $this->db->query($this->sql['s_getTipoProductos']);
    	if ($result->num_rows() > 0)
    	{    		
    		foreach ($result->result_array() as $fila)
    		{
    			$salida[$fila['codigo_categoria']] = $fila['categoria'];
    		}
    	}
    	return $salida;
    }

    
    public function getRegiones()
    {
    	$salida = false;
    	$result = $this->db->query($this->sql['s_getRegiones']);
    	if ($result->num_rows() > 0)
    	{
    		foreach ($result->result_array() as $fila)
    		{
    			$salida[$fila['id_region']] = $fila['region'];
    		}
    	}
    	return $salida;
    }

    public function getComunas($idRegion = 0)
    {
    	$salida = false;
    	if ($idRegion != 0)
    	{
    		$result = $this->db->query($this->sql['s_getComunas'], $idRegion);
    		if ($result->num_rows() > 0)
    			foreach ($result->result_array() as $fila)
    				$salida[$fila['id_comuna']] = $fila['nombre'];
    	}
    	return $salida;
    }
    
    public function getMarcas($idCategoria = "")
    {
    	$salida = false;
    	if ($idCategoria != "")
    	{
    		$result = $this->db->query($this->sql['s_getMarcas'], $idCategoria);
    		if ($result->num_rows() > 0)
    			foreach ($result->result_array() as $fila)
    				$salida[$fila['id']] = $fila['marca'];
    	}
    	return $salida;
    }
    
    public function getRutClienteById($id){
    	$data     = false;
    	$result   = $this->db->query($this->sql['s_getRutClienteById'],$id);
    	if ($result->num_rows() > 0){
    		$data     = $result->result_array();
    	}
    	return $data;
    }
    
    public function saveCliente($data)
    {
    	$salida = false;
    	 
    	$result   = $this->db->query($this->sql['i_savecliente'],$data);
    	if($this->_get_affected_rows($result) == 1){
    		$salida['id_clte'] = $this->db->insert_id();
    	}
    
    	//$salida['clave'] = ($this->_get_affected_rows($result) == 1) ? $data['clave_activacion'] : 0;
    	return $salida;
    }
    
    public function saveActivacionFallida($id_clte, $n_kit)
    {
    	$data['id_clte'] = $id_clte;
    	$data['n_kit'] = $n_kit;
    	$result   = $this->db->query($this->sql['i_saveActivacionFallida'],$data);
    	$salida     = $this->_get_affected_rows($result);
    	return $salida;
    }
    
    public function saveActivacionFallida2($datosProducto = array())
    {
    	if (!empty($datosProducto)){
    		$result = $this->db->insert('gq_activacion_fallida', $datosProducto);
    		$salida = $this->_get_affected_rows($result);
    	}
    	else{
    		$salida = false;
    	}
    	return $salida;
    }
    
    public function getActivaciones(){
    	$salida = false;
    	$result = $this->db->query($this->sql['s_getActivaciones']);
    	if ($result->num_rows() > 0){
    		$salida = $result->result_array();
    	}
    	return $salida;
    }
    
    public function setIdclienteProductoIndividual($id_clte, $clave_activacion, $id_registro)
    {
    	$data['id_clte']     = $id_clte;
    	$data['clave']     = $clave_activacion;
    	$data['id'] = $id_registro;
    	$result   = $this->db->query($this->sql['u_saveIdclteClaveProductoIndividual'],$data);
    	$salida     = $this->_get_affected_rows($result);
    	return $salida;
    }
    
    public function updateProductoIndividual($folio = '', $datos = array()){
    	if (!empty($datos))
    	{
    		$this->db->where('folio', $folio);
    		$this->db->update('gq_producto_individual',$datos);
    	}
    }
    

    public function getDatosclteFromClientes($rut)
    {
    	$salida = false;
    	$result = $this->db->query($this->sql['s_getDatosclteFromClientes'],$rut);
    	if ($result->num_rows() > 0){
    		$salida = $result->result_array();
    	}
    	return $salida;
    }
    
    public function getProductosIndividualByRut($rut)
    {
    	$salida = false;
    	$result = $this->db->query($this->sql['s_getProductosIndividualByRut'],$rut);
    	if ($result->num_rows() > 0){
    		$salida = $result->result_array();
    	}
    	return $salida;
    }
    
    public function saveClienteCompleto($data = array())
    {
    	$salida = false;
    	if (!empty($data)){
    		//$result   = $this->db->query($this->sql['i_saveclientecompleto'],$data);
    		date_default_timezone_set('America/Santiago');
    		$fechaActual = date("Y-m-d H:i");
    		$data['fecha_creacion'] = $fechaActual;
	    	$result   = $this->db->insert('gq_cliente',$data);
	    	if($this->db->affected_rows() > 0){
	    		$salida['id'] = $this->db->insert_id();
	    	}
    	}    	 
    	//$salida['clave'] = ($this->_get_affected_rows($result) == 1) ? $data['clave_activacion'] : 0;
    	return $salida;
    }
    
    public function updateClienteCompleto($id = 0, $data = array())
    {
    	$salida = false;
    	if (!empty($data) && ($id != 0))
    	{
    		$this->db->where('id', $id);
    		$this->db->update('gq_cliente',$data);
    		$salida = true;
    	}
    	return $salida;
    }
    
    public function saveReporteRobo($data)
    {
    	$salida = false;
    
    	//$result   = $this->db->query($this->sql['i_savereporterobo'],$data);
    	date_default_timezone_set('America/Santiago');
    	$fechaActual = date("Y-m-d H:i");
    	$data['fecha_creacion'] = $fechaActual;
    	$fechaRobo = array_reverse(explode("-",$data['dia']));
    	$data['dia'] = implode("-", $fechaRobo);
    	$result = $this->db->insert('gq_robo',$data);
    	if($this->_get_affected_rows($result) == 1){
    		$salida = $this->db->insert_id();
    	}
    	 
    	//$salida['clave'] = ($this->_get_affected_rows($result) == 1) ? $data['clave_activacion'] : 0;
    	return $salida;
    }
    
    public function updateReporteRobo($id_robo = 0, $data = array())
    {
    	$salida = false;
    	if ($id_robo != 0)
    	{
	    	$this->db->where('id_robo',$id_robo);
	    	if (isset($data['dia'])){
		    	$fechaRobo = array_reverse(explode("-",$data['dia']));
		    	$data['dia'] = implode("-", $fechaRobo);
	    	}
	    	$result = $this->db->update('gq_robo',$data);
	    	//if($this->_get_affected_rows($result) == 1){
	    	if ($result){
	    		$salida = true;
	    	}
    	}
    	return $salida;
    }
    
    public function updateActivacionFallida($idActivacion = '', $datos = array())
    {
    	if ($idActivacion != '')
    	{
    		$this->db->where('id_activacion_fallida', $idActivacion);
    		$this->db->update('gq_activacion_fallida', $datos);
    	}
    }  
    public function getRobos($accion = 1){
    	$salida = array();
    	$result = $this->db->query($this->sql['s_getRobos'], $accion);
    	if ($result->num_rows() > 0){
    		$salida = $result->result_array();
    	}
    	return $salida;
    }
    
    public function getRobo($id = 0)
    {
    	$salida = false;
    	if ($id != 0)
    	{
    		$result = $this->db->query($this->sql['s_getRobo'],$id);
    		if ($result->num_rows() > 0)
    			$salida = $result->row_array();
    	}
    	return $salida;
    }
    
    public function getListaCorreosByPerfil($id_perfil)
    {
        $resp = '';
        $result = $this->db->query($this->sql['s_getMailsByPerfil'], $id_perfil);
        if ($result->num_rows() > 0){
            $salida = $result->result_array();
            log_message('ERROR', 'data_query: '.print_r($salida, true));
            foreach ($salida as $key => $value) {
                $resp[] = $value['email'];
            }
            $resp = implode(",", $resp);
        }        
        return $resp;
    }

    public function buscaCliente($rut = '', $nombre = '')
    {
    	$salida = false;
    	$query = "select a.rut, a.nombre, a.paterno, a.email, b.folio, b.clave_activacion, c.nombre as nombre_kit 
    				from gq_cliente as a left join gq_producto_individual as b on (a.id = b.id_cliente) left join gq_productos as c on (b.id_producto = c.id) where ";
    	$conector = " or ";
    	$tiene_rut = false;
    	if ($rut != '')
    	{
			$query .= "a.rut = '".$rut."'";
			$tiene_rut = true;
    	}    		
    	if ($nombre != ''){
    		if ($tiene_rut)
    			$query .= $conector;
    		$query .= "a.nombre like '%".$this->db->escape_like_str($nombre)."%'".$conector."a.paterno like '%".$this->db->escape_like_str($nombre)."%'".$conector."a.materno like '%".$this->db->escape_like_str($nombre)."%'";    		
    	}
    	$query .= " order by a.rut";
    	if ($tiene_rut || $nombre != '')
    	{
    		$result = $this->db->query($query);
    		if ($result->num_rows() > 0)
    		{
    			$salida = $result->result_array();
    		}
    	}	
    	return $salida;
    }
    
    public function buscaProducto($folio = '')
    {
    	$salida = false;
    	if ($folio != '')
    	{
    		$result = $this->db->query($this->sql['s_buscaProducto'],$folio);
    		if ($result->num_rows() > 0)
    			$salida = $result->row_array();
    	}
    	return $salida;
    }
    
    public function buscaRobo($fecha1 = '', $fecha2 = '')
    {
    	$salida = false;
    	$query = "select a.folio, a.lugar, concat(date_format(dia,'%d/%m/%Y'),' ',hora) as fecha, b.rut, concat(b.nombre, ' ', b.paterno) as nombre_cliente from gq_robo as a join gq_cliente as b on (a.id_cliente = b.id) where a.dia ";
    	if (($fecha1 != '') && ($fecha2 != ''))
    	{
    		$query .= "between ".$this->db->escape($fecha1)." and ".$this->db->escape($fecha2);
    	}
    	else
    	{
    		if ($fecha1 != '')
    			$query .= " >= ".$this->db->escape($fecha1);
    		else
    			$query .= " <= ".$this->db->escape($fecha2);
    	}
    	$query .= " order by a.dia asc";
    	$result = $this->db->query($query);
    	if ($result->num_rows() > 0)
    		$salida = $result->result_array();
    	return $salida;
    }
    
    public function validaCliente($idCliente = '', $clave = '')
    {
    	$salida = false;
    	if (($idCliente != '') && ($clave != ''))
    	{
    		$result = $this->db->query("select id from gq_producto_individual where id_cliente = ? and clave_activacion = ?", array($idCliente, $clave));
    		if ($result->num_rows() > 0)
    		{
    			$fila = $result->row();
    			$salida = $fila->id;
    		}
    	}
    	return $salida;
    }
    
    public function cambiaClave($idProducto = '', $clave = '')
    {
    	$salida = false;
    	if ($idProducto != '')
    		$salida = $this->db->query("update gq_producto_individual set clave_activacion = ? where id = ?", array($clave, $idProducto));    		
    	return $salida;
    }
}
?>
