<?php
class M_site extends CI_Model
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

    public function getTerapeuta() {
        $data     = array();
        $result   = $this->db->query($this->sql['s_terapeuta'], $data);
        $data     = $this->_get_result_array($result);
        return $data;   
    }
    public function getTerapias() {
        $data     = array();
        $result   = $this->db->query($this->sql['s_terapias'], $data);
        $data     = $this->_get_result_array($result);
        return $data;   
    }
    public function getPivote() {
	
	$data   = array();
	$result = $this->db->query($this->sql['s_pivote'], $data);
	$data   = $this->_get_result_array($result);
	
	return $this->procesaPivote($data);

    }
    public function procesaPivote($d) {
	$r = array();
	$nr = array();
	foreach($d as $v) { 
		if(!isset($r[$v['idt']]))
			$r[$v['idt']] = '';
		$r[$v['idt']] .= $v['idp'].',';
	}
	foreach($r as $k => $v) {
		if(substr($v, -1) == ',')
			$v = substr($v, 0, strlen($v)-1);
		$nr[$k] = $v;
	}
	return $nr;
    }

    public function insertCita() {
	if($_POST) {
		log_message('debug', 'Datos del POST:'.print_r($_POST, true));
		$datos = array();
		foreach($_POST as $k => $var) {
			if($k == 'enviar') continue;
			$datos[] = $var;
		}
		$this->db->query($this->sql['i_cita'], $datos);
		return $this->db->affected_rows();
	}
    
    }
}
?>
