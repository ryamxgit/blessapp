<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->model('M_site','',TRUE);
		$this->load->helper('language');
		$this->load->helper('number');
		$this->load->helper('string');
		$this->load->helper('tools');
		$this->load->helper('form');
		$this->load->config('links');
	}

	public function index()
	{
		$data = array(
			'link_orig_bless' => $this->config->item('link_orig_bless'),
			'tabla_datos' => $this->getInputs(),
			'site_url' => $this->config->item('base_url'),
			'uribase' => 'blessapp'
		);
		$htmlData = array(
			'HEADER'		=> $this->parser->parse('header', $data, TRUE), 
			'BODY'                  => $this->parser->parse('body', $data, TRUE),
			'GOOGLE_ANALYTICS'	=> $this->parser->parse('googleAnalytics', $data, TRUE),
			'FOOTER'		=> $this->parser->parse('footer', $data, TRUE)
		);

		$out = $this->parser->parse('frontpage',$htmlData, TRUE);
		$this->output->set_output($out);
	}

	public function admin()
	{
		$this->load->library('grocery_CRUD');
		$this->grocery_crud->set_table('terapias');
		$out = $this->grocery_crud->render();
		$this->load->view('grocery_0', $out);
	}
	
	public function adminTerapias()
	{
		$this->load->library('grocery_CRUD');
		$this->grocery_crud->set_crud_url_path('/blessapp/adminTerapias');
		$this->grocery_crud->set_table('terapias');
		$this->grocery_crud->set_relation('duracion', 'horas_permitidas', 'dur_valor');
		$this->grocery_crud->display_as('duracion', 'duracion (en minutos)');
		$out = $this->grocery_crud->render();
		$this->load->view('grocery', $out);
	}

	public function adminTerapeuta()
	{
		$this->load->library('grocery_CRUD');
		$this->grocery_crud->set_crud_url_path('/blessapp/adminTerapeuta');
		$this->grocery_crud->set_table('terapeutas');
		$out = $this->grocery_crud->render();
		$this->load->view('grocery', $out);
	}

	private function getInputs()
	{
		$input = array();

		$input[] = array('text' => 'Cual es tu nombre?', 'input' => form_input('nane'));
		$input[] = array('text' => 'Cual es tu e-mail?', 'input' => form_input('mail'));
		$input[] = array('text' => 'Cual es tu numero de telefono?', 'input' => form_input('telefono'));
		$input[] = array('text' => 'Qu&eacute; terapia necesitas?', 'input' => $this->getTerapias());
		$input[] = array('text' => 'Quieres atenderte con algun terapeuta en particular?', 'input' => $this->getTerapeuta());
		$input[] = array('text' => 'Tienes alguna pregunta o comentario?', 'input' => form_input('comentario'));
		$input[] = array('text' => 'Para terminar pulsa el boton Enviar', 'input' => form_submit('enviar', 'Enviar'));

		return $input;
	}

	private function getTerapeuta() {
		$lista = $this->M_site->getTerapeuta();
		$html = '';
		$data = array();
		foreach($lista as $opt) {
			$data[$opt['id']] = $opt['nombre'];
		}
		return form_dropdown('terapeuta', $data);
	}

	private function getTerapias() {
		$lista = $this->M_site->getTerapias();
		$html = '';
		foreach($lista as $opt) {
			$html .= form_radio('terapia', $opt['id']);
			$html .= ' <span><a href="'.$opt['link'].'" target="_blank">'.$opt['nombre'].'</a>';
			$html .= ' ($ '.number_format($opt['valor'], 0, ',', '.').') '.$opt['duracion'].' minutos</span><br />';	
		}
		return $html; 
	}
	
}

/* End of file site.php */
/* Location: ./application/site/controllers/site.php */
