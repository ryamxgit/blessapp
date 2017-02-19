<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {
	var $uribase;
	var $listaTerapeutas;

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->model('M_site','',TRUE);
		$this->load->library('javascript');
		$this->load->helper('language');
		$this->load->helper('number');
		$this->load->helper('string');
		$this->load->helper('tools');
		$this->load->helper('form');
		$this->load->config('links');
		
		$this->uribase = 'blessapp';
	}

	public function index($body = '')
	{
		$data = array(
			'link_orig_bless' => $this->config->item('link_orig_bless'),
			'tabla_datos' => $this->getInputs(),
			'tabla_pivote' => json_encode($this->M_site->getPivote()),
			'tabla_terapeutas' => json_encode($this->listaTerapeutas),
			'site_url' => $this->config->item('base_url'),
			'uribase' => $this->uribase
		);
		if($body == '')
			$body = $this->parser->parse('body', $data, TRUE);
		$htmlData = array(
			'HEADER'		=> $this->parser->parse('header', $data, TRUE), 
			'BODY'                  => $body,
			'GOOGLE_ANALYTICS'	=> $this->parser->parse('googleAnalytics', $data, TRUE),
			'FOOTER'		=> $this->parser->parse('footer', $data, TRUE)
		);

		$out = $this->parser->parse('frontpage',$htmlData, TRUE);
		$this->output->set_output($out);
	}

	public function save() {
		if($this->M_site->insertCita() > 0) {
			$msj = '<p>Hemos recibido tu cita, quisieramos que pudieras confirmar esta cita al telefono XXXXXXX999</p>';
			$this->index($msj);
		}
		return;
	}

	public function admin($tipo='')
	{
		// if(!$this->sessionValidate()) return;
		switch($tipo) {
			case 'citas':
				$this->adminCitas();
				break;
			case 'terapias':
				$this->adminTerapias();
				break;
			case 'terapeuta':
				$this->adminTerapeuta();
				break;
			default:
				$this->load->library('grocery_CRUD');
				$this->grocery_crud->set_table('terapias');
				$out = $this->grocery_crud->render();
				$out->menu = $this->adminGetMenu();
				$this->load->view('grocery_0', $out);
		}
	}

	private function sessionValidate() {
		if(!isset($_SESSION['user'])) {
			// No hay sesion de LOGIN
			return;
		}
	}
	
	private function adminGetMenu() {
		$menu = array('menu' => array(
						array('titulo' => 'Citas', 'link' => '/'.$this->uribase.'/admin/citas'),
						array('titulo' => 'Terapias', 'link' => '/'.$this->uribase.'/admin/terapias'),
						array('titulo' => 'Terapeutas', 'link' => '/'.$this->uribase.'/admin/terapeuta'),
						array('titulo' => 'Agendas', 'link' => '/'.$this->uribase.'/admin/agendas')
					)
		);
		return $this->parser->parse('grocery_menu', $menu, true);
	}

	private function adminCitas()
	{
		$this->load->library('grocery_CRUD');
		$this->grocery_crud->set_crud_url_path('/'.$this->uribase.'/admin/citas');
		$this->grocery_crud->set_table('citas');
		$this->grocery_crud->set_relation('terapia', 'terapias', 'nombre');
		$this->grocery_crud->set_relation('terapeuta', 'terapeutas', 'nombre');
		$this->grocery_crud->unset_delete();
		$this->grocery_crud->unset_columns(array('anulado', 'atendido'));
		$this->grocery_crud->callback_column('confirmado', array($this, '_callback_cita_confirmado'));
		$out = $this->grocery_crud->render();
		$out->menu = $this->adminGetMenu();
		$this->load->view('grocery', $out);
	}
	
	private function adminTerapias()
	{
		$this->load->library('grocery_CRUD');
		$this->grocery_crud->set_crud_url_path('/'.$this->uribase.'/admin/terapias');
		$this->grocery_crud->set_table('terapias');
		$this->grocery_crud->set_relation('duracion', 'horas_permitidas', 'dur_valor');
		$this->grocery_crud->display_as('duracion', 'duracion (en minutos)');
		$out = $this->grocery_crud->render();
		$out->menu = $this->adminGetMenu();
		$this->load->view('grocery', $out);
	}

	private function adminTerapeuta()
	{
		$this->load->library('grocery_CRUD');
		$this->grocery_crud->set_crud_url_path('/'.$this->uribase.'/admin/terapeuta');
		$this->grocery_crud->set_table('terapeutas');
		$this->grocery_crud->set_relation_n_n('terapias', 'nxm_pivote', 'terapias', 'idp', 'idt', 'nombre', 'prioridad'); 
		$out = $this->grocery_crud->render();
		$out->menu = $this->adminGetMenu();
		$this->load->view('grocery', $out);
	}

	private function getInputs()
	{
		$input = array();

		$input[] = array('text' => 'Cual es tu nombre?', 'input' => form_input('nane', '', 'class="text"'));
		$input[] = array('text' => 'Cual es tu e-mail?', 'input' => form_input('mail', '', 'class="text"'));
		$input[] = array('text' => 'Cual es tu numero de telefono?', 'input' => form_input('telefono', '', 'class="text"'));
		$input[] = array('text' => 'Qu&eacute; terapia necesitas?', 'input' => $this->getTerapias());
		$input[] = array('text' => 'Quieres atenderte con algun terapeuta en particular?', 'input' => $this->getTerapeuta());
		$input[] = array('text' => 'Elije la hora que prefieras:', 'input' => form_input('cita', 'ABABAB')); 
		$input[] = array('text' => 'Tienes alguna pregunta o comentario?', 'input' => form_input('comentario','','class="text"'));
		$input[] = array('text' => 'Para terminar pulsa el boton Enviar', 'input' => form_submit('enviar', 'Enviar'));

		return $input;
	}

	private function getTerapeuta() {
		$lista = $this->M_site->getTerapeuta();
		$this->listaTerapeutas = $lista;
		$html = '';
		$data = array('0' => 'Escoga una opcion...');
		foreach($lista as $opt) {
			$data[$opt['id']] = $opt['nombre'];
		}
		return form_dropdown('terapeuta', $data, array(), 'id="terapeuta"');
	}

	private function getTerapias() {
		$lista = $this->M_site->getTerapias();
		$html = '';
		$extra = 'onclick="web.updTerapeutas(TERAPIA)"';
		foreach($lista as $opt) {
			$ext = str_replace('TERAPIA', $opt['id'], $extra);
			$html .= form_radio('terapia', $opt['id'], false,$ext);
			$html .= ' <span><a href="'.$opt['link'].'" target="_blank">'.$opt['nombre'].'</a>';
			$html .= ' ($ '.number_format($opt['valor'], 0, ',', '.').') '.$opt['duracion'].' minutos</span><br />';	
		}
		return $html; 
	}

	public  function _callback_cita_confirmado($val, $r) {
		if($val == 0)
			$txt = 'NO';
		else
			$txt = 'SI';
		return $txt;	
	}
	
}


/* End of file site.php */
/* Location: ./application/site/controllers/site.php */
