<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');
		$this->load->model('M_dashboard','',TRUE);
		$this->load->library('grocery_CRUD');
		$this->load->library('ion_auth');
		$this->lang->load('auth');
		$this->load->helper('language');
		$this->load->helper('number');
		$this->load->helper('string');
		$this->load->helper('tools');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
		$this->lang->load('auth');
	}

	public function index()
	{
		if (!$this->ion_auth->logged_in())
		{
			//redirect them to the login page
			redirect('dashboard/login', 'refresh');
		} 
		else 
		{
			$data = array();
			$navigation['menu'] = $this->M_dashboard->getMenu();
			$user = $this->ion_auth->user()->row();
			$data['USERNAME'] = $user->first_name;
			$htmlData = array(
					'HEAD_INFO' 		=> $this->parser->parse('include/head', $data, TRUE), 
					'HEADER'		=> $this->parser->parse('include/header', $data, TRUE), 
					'USER_INFO'		=> $this->parser->parse('include/userInfo', $data, TRUE), 
					'NAVIGATION'		=> $this->parser->parse('include/navigation', $navigation, TRUE), 
					'RIBBON'		=> $this->parser->parse('include/ribbon', $data, TRUE), 
					'SHORTCUT'		=> $this->parser->parse('include/shortcutArea', $data, TRUE), 
					'ALL_PAGE_SCRIPTS'	=> $this->parser->parse('include/javascripts', $data, TRUE),
					'GOOGLE_ANALYTICS'	=> $this->parser->parse('include/googleAnalytics', $data, TRUE),
					'FOOTER'		=> $this->parser->parse('include/footer', $data, TRUE)
					);

			$out = $this->parser->parse('frontpage',$htmlData, TRUE);
			$this->output->set_output($out);
		}
	}
	
	
	/*
	 * getPost atiende las solicitudes externas (desde el sitio frontend)
	 */
	public function getPost($comando=null,$params=null){
		switch($comando){
			case 'buscarCliente':
				$salida = 0;
				if ($this->input->post('rut'))
				{
					$resultado = $this->M_dashboard->getDatosclteFromClientes($this->input->post('rut'));
					if ($resultado)
						$salida = json_encode($resultado[0]);
				}
				else
					$salida = "FALTA RUT";
				$this->output->set_output($salida);
				break;
			case 'buscarProducto':
				$salida = 0;
				if ($this->input->post('folio'))
				{
					$resultado = $this->M_dashboard->buscaProducto($this->input->post('folio'));
					if ($resultado)
					{
						$temp = array('producto' => array(
										'clave_activacion' => $resultado['clave_activacion'],
										'tipo_producto' => $resultado['tipo_producto'],
										'descripcion' => $resultado['descripcion'],
										'serie' => $resultado['serie'],
										'modelo' => $resultado['modelo'],
										'marca' => $resultado['marca'],
										'color' => $resultado['color']
									),
									'cliente' => array(
										'rut'	=> $resultado['rut'],
										'nombre'	=> $resultado['nombre'],
										'paterno'	=> $resultado['paterno'],
										'materno'	=> $resultado['materno'],
										'telefono_casa'	=> $resultado['telefono_casa'],
										'telefono_movil'	=> $resultado['telefono_movil'],
										'direccion'	=> $resultado['direccion']
									) 
						);
						$salida = json_encode($temp);
					}
				}
				else
					$salida = "FALTA FOLIO";
				$this->output->set_output($salida);
				break;
			case 'validaCliente':
				$salida = 0;
				$this->form_validation->set_rules('rut', 'Rut', 'required|xss_clean');
				$this->form_validation->set_rules('clave', 'Clave', 'required|xss_clean');

				if ($this->form_validation->run() == true)
				{
					$datosCliente = $this->M_dashboard->getDatosclteFromClientes($this->input->post('rut'));
					if ($datosCliente)
					{
						$validacion = $this->M_dashboard->validaCliente($datosCliente[0]['id'], $this->input->post('clave'));
						if ($validacion)
							$salida = json_encode($datosCliente[0]);
						else
							$salida = 1;
					}
				}
				if($salida == 0)	
					$salida = validation_errors() ? validation_errors : 'Se produjo un error inesperado!';
				$this->output->set_output($salida);
				break;
			case 'cambioClave':
				$salida = 0;
				$this->form_validation->set_rules('rut', 'Rut', 'required|xss_clean');
				$this->form_validation->set_rules('clave', 'Clave', 'required|xss_clean');
				$this->form_validation->set_rules('nueva_clave', 'Nueva clave', 'required|xss_clean');
				if($this->form_validation->run() == true)
				{
					$datosCliente = $this->M_dashboard->getDatosclteFromClientes($this->input->post('rut'));
					if ($datosCliente)
					{
						$idCliente = $datosCliente[0]['id'];
						$idProducto = $this->M_dashboard->validaCliente($idCliente, $this->input->post('clave'));
						if ($idProducto)
						{
							if ($this->M_dashboard->cambiaClave($idProducto, $this->input->post('nueva_clave')))
								$salida = "OK";
							else
								$salida = 2;
						}
						else
							$salida = 1;
					} 
				}
				if($salida == 0)
					$salida = validation_errors() ? validation_errors : 'Se produjo un error inesperado!';
				$this->output->set_output($salida);
				break;
			case 'modificaActivacion':
				$salida = 0;
				if ($this->input->post('folio'))
				{
					$datosProducto = $this->M_dashboard->getFolioFromProductoIndividual($this->input->post('folio'));
					if (is_array($datosProducto))
					{
						$claveActivacion = $datosProducto[0]['clave_activacion'];
						if ($claveActivacion != '')
						{
							$idProducto = $datosProducto[0]['id'];
							$config['upload_path'] = './files/';
							$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
							$config['max_size']	= '10000';
							$config['max_width']  = '2048';
							$config['max_height']  = '1024';
							$this->load->library('upload', $config);
							if ( ! $this->upload->do_upload("archivo"))
								$salida = 2;
							else
							{
								$datosArchivo = $this->upload->data();	
								$idArchivo = $this->M_dashboard->saveFileUpload($idProducto, $datosArchivo['file_name'], 'activacion', 0);
								/* updateFileUpload($idArchivo, $datosArchivo);
								 * $datosArchivo->name, $datosArchivo->size, $datosArchivo->type, $datosArchivo->thumbnailUrl, $datosArchivo->url, $datosArchivo->deleteUrl
								 */
								//Falta Agregar Otros Valores del Archivo
								$datos['tipo_producto'] = $this->input->post('tipo_producto');
								$datos['marca'] = $this->input->post('marca');
								$datos['modelo'] = $this->input->post('modelo');
								$datos['serie'] = $this->input->post('serie');
								$datos['descripcion'] = $this->input->post('descripcion');
								$datos['color'] = $this->input->post('color');
								/*
								if ($this->M_dashboard->updateProductoIndividual($this->input->post('folio'), $datos))
									$salida = "OK";
								else
									$salida = 2;
								*/
								$this->M_dashboard->updateProductoIndividual($this->input->post('folio'), $datos);
								$salida = "OK";
							}
						}
						else
							$salida = 1;
					}
				}
				else
					$salida = "FALTA FOLIO";
				$this->output->set_output($salida);
				break;
			default:
				$this->output->set_output("ERROR");
		}
	}

	public function getAjax($comando=null,$params=null){
		
		if (!$this->ion_auth->logged_in())
		{
			//redirect them to the login page
			echo "notlogged";
			return;
		}
		$dataGrafico = array();
		$total_pedidos = $this->getPedidos();
		$dataGrafico['totalventas'] = $total_pedidos['total'];
		$dataGrafico['totalventasprecio'] = precio($total_pedidos['total_precio']);

		$data = array('base_url' => base_url());
		// Se comenta la siguiente Linea, que despliega informacion en la parte superior de los Ajax
		/* $data['GRAFICASRIBBON'] = $this->parser->parse('include/graficasRibbon', $dataGrafico, TRUE); */	
		$data['GRAFICASRIBBON'] = "";

		// TODO: Falta validar el $comando, si no existe como archivo mostrar una vista en blanco.

		switch($comando){
			case 'userProfile' :
				$string = $this->parser->parse('ajax/ajax_'.$comando, $data, TRUE);				
				$this->output->set_output($string);
			break;
			case 'dashboard' :
				$string = $this->parser->parse('ajax/ajax_'.$comando, $data, TRUE);				
				$this->output->set_output($string);
			break;
			case 'configuraciones' :				
				$string = $this->parser->parse('ajax/ajax_'.$comando, $data, TRUE);				
				$this->output->set_output($string);
			break;
			// ######### Grupos ########### //
			case 'grupos' :
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
				$this->data['groups'] = $this->ion_auth->groups()->result_array();
				$this->data['GRAFICASRIBBON'] = $data['GRAFICASRIBBON'];
				$string = $this->parser->parse('ajax/ajax_'.$comando, $this->data, TRUE);				
				$this->output->set_output($string);
			break;
			case 'crearGrupo' :
				if ($_POST) {
					$tables = $this->config->item('tables','ion_auth');
					//validate form input
					$this->form_validation->set_rules('name', 'Nombre', 'required|is_unique['.$tables['groups'].'.name]|xss_clean');
					$this->form_validation->set_rules('description', 'Descripcion', 'required|xss_clean');

					if ($this->form_validation->run() == true)
					{
						$group_name = strtolower($this->input->post('name'));
						$group_description = $this->input->post('description');
						$additional_data = array();
					}
					if ($this->form_validation->run() == true && $this->ion_auth->create_group($group_name, $group_description, $additional_data))
					{
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						echo "OK";
					}else{
						// retorna por error en validaciones
						$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
						echo $this->data['message'];
					}
				}
				else
				{
					$this->data['GRAFICASRIBBON'] = $data['GRAFICASRIBBON'];
					$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
					$string = $this->parser->parse('ajax/ajax_'.$comando, $this->data, TRUE);
					$this->output->set_output($string);	
				}
				
			break;
			case 'editarGrupo' :
				if ($_POST) {
					$tables = $this->config->item('tables','ion_auth');
					//validate form input
					$this->form_validation->set_rules('name', 'Nombre', 'required|xss_clean');
					$this->form_validation->set_rules('description', 'Descripcion', 'required|xss_clean');

					if ($this->form_validation->run() == true)
					{
						$group_name = strtolower($this->input->post('name'));
						$group_description = $this->input->post('description');
						$additional_data = array();
					}
					$group_id = $params;
					if ($this->form_validation->run() == true && $this->ion_auth->update_group($group_id, $group_name, $group_description, $additional_data))
					{
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						echo "OK";
					}else{
						// retorna por error en validaciones
						$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
						echo $this->data['message'];
					}
				}
				else
				{
					$group = $this->ion_auth->group($params)->row();
					$this->data['group_name'] = $group->name;
					$this->data['group_description'] = $group->description;
					$this->data['group_id'] = $group->id;
					$this->data['GRAFICASRIBBON'] = $data['GRAFICASRIBBON'];
					$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
					$string = $this->parser->parse('ajax/ajax_'.$comando, $this->data, TRUE);
					$this->output->set_output($string);	
				}
				
			break;
			case 'eliminarGrupo' :
					$string = 'error';
					$id_grupo = $this->input->post('id_group_elimina');
					$proceso = $this->ion_auth->delete_group($id_grupo);
					if($proceso)
						$string = 'OK';
					$this->output->set_output($string);															
			break;

			//####### USUARIOS ########//
			case 'usuarios' :
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
				//list the users
				$this->data['users'] = $this->ion_auth->users()->result();
				foreach ($this->data['users'] as $k => $user)
				{
					$this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
				}
				$this->data['GRAFICASRIBBON'] = $data['GRAFICASRIBBON'];
				$string = $this->parser->parse('ajax/ajax_'.$comando, $this->data, TRUE);				
				$this->output->set_output($string);
			break;
			case 'crearUsuario' :
				if ($_POST) {
					$tables = $this->config->item('tables','ion_auth');
					$perfil = NULL;
					//validate form input
					$this->form_validation->set_rules('firstname', 'Nombre', 'required|xss_clean');
					$this->form_validation->set_rules('lastname', 'Apellido', 'required|xss_clean');
					$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique['.$tables['users'].'.email]');
					$this->form_validation->set_rules('phone', 'Telefono', 'required|xss_clean');
					$this->form_validation->set_rules('company', 'Compañia', 'required|xss_clean');
					$this->form_validation->set_rules('password', 'Contraseña', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[passwordConfirm]');
					$this->form_validation->set_rules('passwordConfirm', 'Repetir Contraseña', 'required');

					if ($this->form_validation->run() == true)
					{
						$username = strtolower($this->input->post('firstname')) . ' ' . strtolower($this->input->post('lastname'));
						$email    = strtolower($this->input->post('email'));
						$password = $this->input->post('password');
						$additional_data = array(
							'first_name' => $this->input->post('firstname'),
							'last_name'  => $this->input->post('lastname'),
							'company'    => $this->input->post('company'),
							'phone'      => $this->input->post('phone')
						);
						$perfil = $this->input->post('perfil');
					}
					if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data, $this->input->post('groups'), $perfil))
					{
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						echo "OK";
					}else{
						// retorna por error en validaciones
						$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
						echo $this->data['message'];
					}
				}
				else
				{
					$groups=$this->ion_auth->groups()->result_array();
					$perfiles=$this->ion_auth->perfiles()->result_array();
					$comboPerfiles = array('0' => '');
					foreach ($perfiles as $per)
						$comboPerfiles[$per['id']] = $per['name'];
					$this->data['GRAFICASRIBBON'] = $data['GRAFICASRIBBON'];
					$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
					$this->data['groups'] = $groups;
					$this->data['perfiles'] = $comboPerfiles;
					$string = $this->parser->parse('ajax/ajax_'.$comando, $this->data, TRUE);
					$this->output->set_output($string);	
				}
				
			break;
			case 'editarUsuario' :				
				if ($_POST) {
					$tables = $this->config->item('tables','ion_auth');
					//validate form input
					$this->form_validation->set_rules('firstname', 'Nombre', 'required|xss_clean');
					$this->form_validation->set_rules('lastname', 'Apellido', 'required|xss_clean');
					$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
					$this->form_validation->set_rules('phone', 'Telefono', 'required|xss_clean');
					$this->form_validation->set_rules('company', 'Compañia', 'required|xss_clean');
					$this->form_validation->set_rules('password', 'Contraseña', 'min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[passwordConfirm]');
					$this->form_validation->set_rules('passwordConfirm', 'Repetir Contraseña', '');

					if ($this->form_validation->run() == true)
					{
						$username = strtolower($this->input->post('firstname')) . ' ' . strtolower($this->input->post('lastname'));
						$email    = strtolower($this->input->post('email'));
						$additional_data = array(
							'username'   => $username,
							'email'      => $email,
							'password'   => $this->input->post('password'),
							'first_name' => $this->input->post('firstname'),
							'last_name'  => $this->input->post('lastname'),
							'company'    => $this->input->post('company'),
							'phone'      => $this->input->post('phone'),
						);
						$perfil = $this->input->post('perfil');
					}
					if ($this->form_validation->run() == true && $this->ion_auth->update($params, $additional_data, $this->input->post('groups'), $perfil))
					{
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						echo "OK";
					}else{
						// retorna por error en validaciones
						$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
						echo $this->data['message'];
					}
				}
				else
				{
					if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $params)))
					{
						//redirect('auth', 'refresh');
						echo "notlogged";
					}
					$user = $this->ion_auth->user($params)->row();
					$groups=$this->ion_auth->groups()->result_array();
					$perfiles=$this->ion_auth->perfiles()->result_array();
					$comboPerfiles = array('0' => '');
					foreach ($perfiles as $per)
						$comboPerfiles[$per['id']] = $per['name'];
					$currentGroups = $this->ion_auth->get_users_groups($params)->result();
					$currentPerfil = $this->ion_auth->get_perfil($user->user_id);
					$this->data['email'] = $user->email;
					$this->data['firstname'] = $user->first_name;
					$this->data['lastname'] = $user->last_name;
					$this->data['company'] = $user->company;
					$this->data['phone'] = $user->phone;
					$this->data['currentGroups'] = $currentGroups;
					$this->data['groups'] = $groups;
					$this->data['perfiles'] = $comboPerfiles;
					$this->data['perfil_id'] = $currentPerfil;
					$this->data['user_id'] = $user->user_id;

					//log_message('PHP', $params ." *** ". print_r($user,true));

					$this->data['GRAFICASRIBBON'] = $data['GRAFICASRIBBON'];
					$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
					$string = $this->parser->parse('ajax/ajax_'.$comando, $this->data, TRUE);
					$this->output->set_output($string);	
				}
				
			break;
			case 'desactivarUsuario' :
					$string = 'error';
					$id_user = $this->input->post('id_user');
					$proceso = $this->ion_auth->deactivate($id_user);
					if($proceso)
						$string = 'OK';
					$this->output->set_output($string);								
			break;		
			case 'activarUsuario' :
					$string = 'error';
					$id_user = $this->input->post('id_user_activa');
					$proceso = $this->ion_auth->activate($id_user);
					if($proceso)
						$string = 'OK';
					$this->output->set_output($string);												
			break;
			case 'eliminarUsuario' :
					$string = 'error';
					$id_user = $this->input->post('id_user_elimina');
					$proceso = $this->ion_auth->delete_user($id_user);
					if($proceso)
						$string = 'OK';
					$this->output->set_output($string);															
			break;
			// ######################### //

			// ######### Perfiles ########### //
			case 'perfiles' :
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
				//list the users
				$this->data['perfiles'] = $this->ion_auth->perfiles()->result_array();
				$acciones = $this->ion_auth->acciones()->result_array();
				$arregloAcciones = array();
				foreach ($acciones as $ac)
					$arregloAcciones[$ac['id']] = $ac['name'];
				$arregloAcciones[0] = "--";
				foreach ($this->data['perfiles'] as $k => $perfil)
				{
					$this->data['perfiles'][$k]['accion'] = $arregloAcciones[$perfil['id_accion']];
				}
				//log_message('PHP', print_r($this->data,true));
				$this->data['GRAFICASRIBBON'] = $data['GRAFICASRIBBON'];
				$string = $this->parser->parse('ajax/ajax_'.$comando, $this->data, TRUE);				
				$this->output->set_output($string);
			break;
			case 'crearPerfil' :
				if ($_POST) {
					$tables = $this->config->item('tables','ion_auth');
					//validate form input
					$this->form_validation->set_rules('name', 'Nombre', 'required|is_unique['.$tables['perfiles'].'.name]|xss_clean');
					$this->form_validation->set_rules('description', 'Descripcion', 'required|xss_clean');

					if ($this->form_validation->run() == true)
					{
						$perfil_name = $this->input->post('name');
						$perfil_description = $this->input->post('description');
						$perfil_accion = $this->input->post('accion');
						
					}
					if ($this->form_validation->run() == true && $this->ion_auth->create_perfil($perfil_name, $perfil_description, $perfil_accion))
					{
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						echo "OK";
					}else{
						// retorna por error en validaciones
						$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
						echo $this->data['message'];
					}
				}
				else
				{
					$estados=$this->ion_auth->estados()->result_array();
					$this->data['GRAFICASRIBBON'] = $data['GRAFICASRIBBON'];
					$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
					$acciones = $this->ion_auth->acciones()->result_array();
					$comboAcciones = array('0' => '');
					foreach ($acciones as $ac)
						$comboAcciones[$ac['id']] = $ac['name'];
					$this->data['acciones'] = $comboAcciones;
					$string = $this->parser->parse('ajax/ajax_'.$comando, $this->data, TRUE);
					$this->output->set_output($string);	
				}
				
			break;
			case 'editarPerfil' :
				if ($_POST) {
					$tables = $this->config->item('tables','ion_auth');
					//validate form input
					$this->form_validation->set_rules('name', 'Nombre', 'required|xss_clean');
					$this->form_validation->set_rules('description', 'Descripcion', 'required|xss_clean');

					if ($this->form_validation->run() == true)
					{
						$perfil_name = $this->input->post('name');
						$perfil_description = $this->input->post('description');
						$perfil_accion = $this->input->post('accion');
						$additional_data = array();
					}
					$perfil_id = $params;
					$datos = array('name' => $perfil_name, 'descripcion' => $perfil_description, 'id_accion' => $perfil_accion);
					if ($this->form_validation->run() == true && $this->ion_auth->update_perfil($perfil_id, $datos))
					{
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						echo "OK";
					}else{
						// retorna por error en validaciones
						$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
						echo $this->data['message'];
					}
				}
				else
				{
					$perfil = $this->ion_auth->perfil($params)->row();
					$this->data['perfil_name'] = $perfil->name;
					$this->data['perfil_description'] = $perfil->descripcion;
					$this->data['perfil_id'] = $perfil->id;
					$acciones = $this->ion_auth->acciones()->result_array();
					$comboAcciones = array('0' => '');
					foreach ($acciones as $ac)
						$comboAcciones[$ac['id']] = $ac['name'];
					$this->data['currentAccion'] = $this->ion_auth->get_accion_perfil($perfil->id);
					$this->data['acciones']  = $comboAcciones;
					$currentEstados = $this->ion_auth->get_estados_perfil($perfil->id)->result();
					$estados=$this->ion_auth->estados()->result_array();
					$this->data['GRAFICASRIBBON'] = $data['GRAFICASRIBBON'];
					$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
				/*	$this->data['currentEstados'] = $currentEstados;
					$this->data['estados'] = $estados;*/
					$string = $this->parser->parse('ajax/ajax_'.$comando, $this->data, TRUE);
					$this->output->set_output($string);	
				}
				
			break;
			case 'eliminarPerfil' :
					$string = 'error';
					$id_perfil = $this->input->post('id_perfil_elimina');
					$proceso = $this->ion_auth->delete_perfil($id_perfil);
					if($proceso)
						$string = 'OK';
					$this->output->set_output($string);															
			break;
			// ######################### //

			// ######### Estados de PRODUCTO ########### //
			case 'estados_productos':
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
				//list the users
				$this->data['estados_producto'] = $this->ion_auth->estados_producto()->result_array();
				//log_message('PHP', print_r($this->data,true));
				$this->data['GRAFICASRIBBON'] = $data['GRAFICASRIBBON'];
				$string = $this->parser->parse('ajax/ajax_'.$comando, $this->data, TRUE);				
				$this->output->set_output($string);
			break;
			// ######################### //

			// ######### Estados ########### //
			case 'estados' :
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
				//list the users
				$this->data['estados'] = $this->ion_auth->estados()->result_array();
				//log_message('PHP', print_r($this->data,true));
				$this->data['GRAFICASRIBBON'] = $data['GRAFICASRIBBON'];
				$string = $this->parser->parse('ajax/ajax_'.$comando, $this->data, TRUE);				
				$this->output->set_output($string);
			break;
			case 'crearEstado' :
				if ($_POST) {
					$tables = $this->config->item('tables','ion_auth');
					//validate form input
					$this->form_validation->set_rules('name', 'Nombre', 'required|is_unique['.$tables['estados'].'.nombre]|xss_clean');

					if ($this->form_validation->run() == true)
					{
						$estado_name = $this->input->post('name');
						$additional_data = array();
					}
					if ($this->form_validation->run() == true && $this->ion_auth->create_estado($estado_name, $additional_data))
					{
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						echo "OK";
					}else{
						// retorna por error en validaciones
						$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
						echo $this->data['message'];
					}
				}
				else
				{
					$this->data['GRAFICASRIBBON'] = $data['GRAFICASRIBBON'];
					$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
					$string = $this->parser->parse('ajax/ajax_'.$comando, $this->data, TRUE);
					$this->output->set_output($string);	
				}
				
			break;
			case 'editarEstado' :
				if ($_POST) {
					$tables = $this->config->item('tables','ion_auth');
					//validate form input
					$this->form_validation->set_rules('name', 'Nombre', 'required|xss_clean');

					if ($this->form_validation->run() == true)
					{
						$estado_name = $this->input->post('name');
						$additional_data = array();
					}
					$estado_id = $params;
					if ($this->form_validation->run() == true && $this->ion_auth->update_estado($estado_id, $estado_name, $additional_data))
					{
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						echo "OK";
					}else{
						// retorna por error en validaciones
						$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
						echo $this->data['message'];
					}
				}
				else
				{
					$estado = $this->ion_auth->estado($params)->row();
					$this->data['estado_name'] = $estado->nombre;
					$this->data['estado_id'] = $estado->id;
					$this->data['GRAFICASRIBBON'] = $data['GRAFICASRIBBON'];
					$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
					$string = $this->parser->parse('ajax/ajax_'.$comando, $this->data, TRUE);
					$this->output->set_output($string);	
				}
				
			break;
			case 'desactivarEstado' :
					$string = 'error';
					$id_estado = $this->input->post('id_estado');
					$proceso = $this->ion_auth->deactivate_estado($id_estado);
					if($proceso)
						$string = 'OK';
					$this->output->set_output($string);								
			break;		
			case 'activarEstado' :
					$string = 'error';
					$id_estado = $this->input->post('id_estado_activa');
					$proceso = $this->ion_auth->activate_estado($id_estado);
					if($proceso)
						$string = 'OK';
					$this->output->set_output($string);												
			break;
			case 'eliminarEstado' :
					$string = 'error';
					$id_estado = $this->input->post('id_estado_elimina');
					$proceso = $this->ion_auth->delete_estado($id_estado);
					if($proceso)
						$string = 'OK';
					$this->output->set_output($string);															
			break;
			// ######################### //
			// ######### Seguros ########### //
			case 'seguros' :
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
				//list the users
				$this->data['seguros'] = $this->ion_auth->seguros()->result_array();
				//log_message('PHP', print_r($this->data,true));
				$this->data['GRAFICASRIBBON'] = $data['GRAFICASRIBBON'];
				$string = $this->parser->parse('ajax/ajax_'.$comando, $this->data, TRUE);
				/*	$lista_mails = $this->M_dashboard->getListaCorreosByPerfil(2); //se los debe enviar a aprobador
					print_r($lista_mails, TRUE);				*/
				$this->output->set_output($string);
				break;
			case 'crearSeguro' :
				if ($_POST) {
					$tables = $this->config->item('tables','ion_auth');
					//validate form input
					$this->form_validation->set_rules('name', 'Nombre', 'required|is_unique['.$tables['seguros'].'.name]|xss_clean');
					$this->form_validation->set_rules('description', 'Descripcion', 'required|xss_clean');
						
					if ($this->form_validation->run() == true)
					{
						$seguro_name = $this->input->post('name');
						$seguro_description = $this->input->post('description');
						$additional_data = array("id_aseguradora" => $this->input->post('id_aseguradora'), "fecha_creacion" => date("Y-m-d H:i"));
					}
					if ($this->form_validation->run() == true && $this->ion_auth->create_seguro($seguro_name, $seguro_description, $additional_data))
					{
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						echo "OK";
					}else{
						// retorna por error en validaciones
						$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
						echo $this->data['message'];
					}
				}
				else
				{
					$this->data['GRAFICASRIBBON'] = $data['GRAFICASRIBBON'];
					$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
					$string = $this->parser->parse('ajax/ajax_'.$comando, $this->data, TRUE);
					$this->output->set_output($string);
				}
					
				break;
			case 'editarSeguro' :
				if ($_POST) {
					$tables = $this->config->item('tables','ion_auth');
					//validate form input
					$this->form_validation->set_rules('name', 'Nombre', 'required|xss_clean');
					$this->form_validation->set_rules('description', 'Descripcion', 'required|xss_clean');
						
					if ($this->form_validation->run() == true)
					{
						$seguro_name = $this->input->post('name');
						$seguro_description = $this->input->post('description');
						$additional_data = array("id_aseguradora" => $this->input->post('id_aseguradora'));
					}
					$seguro_id = $params;
					if ($this->form_validation->run() == true && $this->ion_auth->update_seguro($seguro_id, $seguro_name, $seguro_description, $additional_data))
					{
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						echo "OK";
					}else{
						// retorna por error en validaciones
						$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
						echo $this->data['message'];
					}
				}
				else
				{
					$seguro = $this->ion_auth->seguro($params)->row();
					$this->data['seguro_name'] = $seguro->name;
					$this->data['seguro_description'] = $seguro->description;
					$this->data['seguro_id'] = $seguro->id;
					$this->data['seguro_id_aseguradora'] = $seguro->id_aseguradora;
					$this->data['GRAFICASRIBBON'] = $data['GRAFICASRIBBON'];
					$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
					$string = $this->parser->parse('ajax/ajax_'.$comando, $this->data, TRUE);
					$this->output->set_output($string);
				}
					
				break;
			case 'eliminarSeguro' :
				$string = 'error';
				$id_seguro = $this->input->post('id_seguro_elimina');
				$proceso = $this->ion_auth->delete_seguro($id_seguro);
				if($proceso)
					$string = 'OK';
				$this->output->set_output($string);
				break;
					
			// ######### Empresas ########### //
			case 'empresas' :
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
				//list the users
				$this->data['empresas'] = $this->ion_auth->empresas()->result_array();
				//log_message('PHP', print_r($this->data,true));
				$this->data['GRAFICASRIBBON'] = $data['GRAFICASRIBBON'];
				$string = $this->parser->parse('ajax/ajax_'.$comando, $this->data, TRUE);
				$this->output->set_output($string);
				break;
			case 'crearEmpresa' :
				if ($_POST) {
					$tables = $this->config->item('tables','ion_auth');
					//validate form input
					$this->form_validation->set_rules('name', 'Nombre', 'required|is_unique['.$tables['groups'].'.name]|xss_clean');
					$this->form_validation->set_rules('description', 'Descripcion', 'required|xss_clean');
			
					if ($this->form_validation->run() == true)
					{
						$empresa_name = $this->input->post('name');
						$empresa_description = $this->input->post('description');
						$additional_data = array();
					}
					if ($this->form_validation->run() == true && $this->ion_auth->create_empresa($empresa_name, $empresa_description, $additional_data))
					{
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						echo "OK";
					}else{
						// retorna por error en validaciones
						$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
						echo $this->data['message'];
					}
				}
				else
				{
					$this->data['GRAFICASRIBBON'] = $data['GRAFICASRIBBON'];
					$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
					$string = $this->parser->parse('ajax/ajax_'.$comando, $this->data, TRUE);
					$this->output->set_output($string);
				}
			
				break;
			case 'editarEmpresa' :
				if ($_POST) {
					$tables = $this->config->item('tables','ion_auth');
					//validate form input
					$this->form_validation->set_rules('name', 'Nombre', 'required|xss_clean');
					$this->form_validation->set_rules('description', 'Descripcion', 'required|xss_clean');
			
					if ($this->form_validation->run() == true)
					{
						$empresa_name = $this->input->post('name');
						$empresa_description = $this->input->post('description');
						$additional_data = array();
					}
					$empresa_id = $params;
					if ($this->form_validation->run() == true && $this->ion_auth->update_empresa($empresa_id, $empresa_name, $empresa_description, $additional_data))
					{
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						echo "OK";
					}else{
						// retorna por error en validaciones
						$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
						echo $this->data['message'];
					}
				}
				else
				{
					$empresa = $this->ion_auth->empresa($params)->row();
					$this->data['empresa_name'] = $empresa->name;
					$this->data['empresa_description'] = $empresa->description;
					$this->data['empresa_id'] = $empresa->id;
					$this->data['GRAFICASRIBBON'] = $data['GRAFICASRIBBON'];
					$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
					$string = $this->parser->parse('ajax/ajax_'.$comando, $this->data, TRUE);
					$this->output->set_output($string);
				}
			
				break;
			case 'eliminarEmpresa' :
				$string = 'error';
				$id_empresa = $this->input->post('id_empresa_elimina');
				$proceso = $this->ion_auth->delete_empresa($id_empresa);
				if($proceso)
					$string = 'OK';
				$this->output->set_output($string);
				break;
					
			case 'web' :
				$rows = $this->webcontent();
				$data['datos'] = $rows;
				$string = $this->parser->parse('ajax/ajax_'.$comando, $data, TRUE);				
				$this->output->set_output($string);
			break;
			case 'pedidos' :
				$rows = $this->pedidos();
				$data['datos'] = $rows;
				$string = $this->parser->parse('ajax/ajax_'.$comando, $data, TRUE);				
				$this->output->set_output($string);
			break;
			case 'editWebcontent' :
				$rows = $this->editWebcontent($params);
				$ocultar = 'style="display:none;"';
				$categorias = $this->convertToOptionanArray($this->getCategorias(), $rows['categoria']);
				log_message('PHP', '*'.$rows['link_descarga'].'*');
				$data2 = array('base_url' => base_url(), 'id' => $params, 'data' => $rows['contenido'], 'nombre' => $rows['nombre'],'imagen1' => $rows['imagen1'],
							  'video1' => $rows['video1'],'valor1' => $rows['valor1'], 'categorias' => $categorias, 'link_descarga' => trim($rows['link_descarga']),
							  'id_categoria' => $rows['id_categoria']
							  );
				$data = array_merge($data, $data2);
				$string = $this->parser->parse('ajax/ajax_'.$comando, $data, TRUE);				
				$this->output->set_output($string);
			break;
			case 'editPedidosPerfil' :
				$rows = $this->editPedidoscontent($params);
				$categorias = $this->convertToOptionanArray($this->getEstadosPedidos(), $rows['estado']);
				$log = $this->M_dashboard->getLogPedidosById($params);
				//log_message('PHP', 'log: ' . print_r($log,true));
				$data2 = array('base_url' => base_url(), 'id' => $params, 'nombre' => $rows['nombre'], 
								'correo' => $rows['correo'], 'telefono' => $rows['telefono'],'direccion' => $rows['direccion'],
								'cantidad' => $rows['cantidad'], 'estados' => $categorias, 'data' => '', 'tipo' => $rows['tipo'],
								'mensaje' => $log, 'precio' => $rows['precio']
							);
				$data = array_merge($data, $data2);
				$this->session->set_userdata('idPedido', $params);
				$string = $this->parser->parse('ajax/ajax_'.$comando, $data, TRUE);				
				$this->output->set_output($string);
			break;
			case 'editPedidoscontent' :
				$rows = $this->editPedidoscontent($params);
				$categorias = $this->convertToOptionanArray($this->getEstadosPedidos(), $rows['estado']);
				$log = $this->M_dashboard->getLogPedidosById($params);
				//log_message('PHP', 'log: ' . print_r($log,true));
				$data2 = array('base_url' => base_url(), 'id' => $params, 'nombre' => $rows['nombre'], 
								'correo' => $rows['correo'], 'telefono' => $rows['telefono'],'direccion' => $rows['direccion'],
								'cantidad' => $rows['cantidad'], 'estados' => $categorias, 'data' => '', 'tipo' => $rows['tipo'],
								'mensaje' => $log, 'precio' => $rows['precio']
							);
				$data = array_merge($data, $data2);
				$string = $this->parser->parse('ajax/ajax_'.$comando, $data, TRUE);				
				$this->output->set_output($string);
			break;
			case 'saveEditedWebcontent' : // FROM POST
				if($_POST['video1']){
					$_POST['video1'] = str_replace("https://www.youtube.com/watch?v=", "//www.youtube.com/embed/", $_POST['video1']);
				}
				$data = array($_POST['data'],$_POST['nombre'], $_POST['categoria'], $_POST['imagen1'], $_POST['video1'], $_POST['valor1'], $_POST['link_descarga']) ; // <<<<=== Esto hay que arreglarlo....
				$result = $this->saveWebcontent($params, $data);
				if($result)
					echo "OK";
				else
					echo "Error";
			break;
			case 'saveEditedPedidoscontent' : // FROM POST
				$tempo ="";
				if($_POST['data'] != ""){
					$tempo .= "Comentario: ".$_POST['data']."<BR>";
				}
				if($_POST['cantidad'] != ""){
					$tempo .= "Cantidad: " . $_POST['cantidad']."<br>";
				}
				if($_POST['estado'] != ""){
					$est = $this->M_dashboard->getestadoFromId($_POST['estado']);
					$tempo .= "Estado: " . $est[0]['nombre']; //$_POST['estado'];
				}

				$data['data'] = $tempo;
				$data2 = array($_POST['cantidad'], $_POST['estado']);
				$result = $this->savePedidoscontent($params, $data,$data2);
				if($result)
					echo "OK";
				else
					echo "Error";
			break;
			case 'crearPedido':
				if ($_POST){
					//$tables = $this->config->item('tables','ion_auth');
					$this->form_validation->set_rules('nombre', 'Nombre', 'required|xss_clean');
					$this->form_validation->set_rules('correo', 'Correo', 'required|valid_email|xss_clean');
					$this->form_validation->set_rules('telefono', 'Telefono', 'required|xss_clean');
					$this->form_validation->set_rules('direccion', 'Direccion', 'required|xss_clean');
					$this->form_validation->set_rules('precio', 'Precio', 'required|xss_clean');
					$this->form_validation->set_rules('tipo', 'Tipo', 'required|xss_clean');
					$this->form_validation->set_rules('cantidad', 'Cantidad', 'required|xss_clean');
					
					if ($this->form_validation->run() == true)
					{
						$ingreso['nombre'] = $this->input->post('nombre');
						$ingreso['correo'] = $this->input->post('correo');
						$ingreso['telefono'] = $this->input->post('telefono');
						$ingreso['direccion'] = $this->input->post('direccion');
						$ingreso['precio'] = $this->input->post('precio');
						$ingreso['cantidad'] = $this->input->post('cantidad');
						$ingreso['tipo'] = $this->input->post('tipo');
						$ingreso['estado'] = $this->input->post('estado');
						$accion = $this->ion_auth->accion_por_nombre('Call Center')->row();
						$ingreso['accion'] = $accion->id;
						$ingreso['fecha_ing'] = date('Y-m-d H:i:s');
					}
					if ($this->form_validation->run() == true && ($id = $this->ion_auth->create_pedido($ingreso)))
					{
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						$log = $this->M_dashboard->saveLogPedidos($id,array($this->session->userdata('user_id'),'Pedido Creado'),array());
						echo "OK";
					}else{
						// retorna por error en validaciones
						$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
						echo $this->data['message'];
					}
				}
				else
				{
					$estados = $this->ion_auth->estados(true)->result_array();
					foreach ($estados as $es)
						$comboAcciones[$es['id']] = $es['nombre'];
					$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
					$data['estados'] = $comboAcciones;
					$string = $this->parser->parse('ajax/ajax_'.$comando, $data, TRUE);
					$this->output->set_output($string);
				}
			break;
			case 'verPedidos' :
				$rows = $this->editPedidoscontent($params);
		                $log = $this->M_dashboard->getLogPedidosById($params);
		                $data['idPerfil'] = $this->session->userdata('idPerfil');
		                if (!isset($nombrePerfil))
		                    $nombrePerfil = $this->ion_auth->perfil($this->session->userdata('idPerfil'))->row();               
		                $data2 = array('base_url' => base_url(), 'id' => $params, 'nombre' => $rows['nombre'],
		                        'correo' => $rows['correo'], 'telefono' => $rows['telefono'],'direccion' => $rows['direccion'],
		                        'cantidad' => $rows['cantidad'], 'estado' => $rows['estado'], 'data' => '', 'tipo' => $rows['tipo'],
		                        'mensaje' => $log, 'precio' => $rows['precio']
		                );
		                $data['nombrePerfil'] = $nombrePerfil->name;
		                $data = array_merge($data, $data2);
		                $this->session->set_userdata('idPedido', $params);
		                $string = $this->parser->parse('ajax/ajax_'.$comando, $data, TRUE);
		                $this->output->set_output($string);
	                break;
			case 'rechazaPedido':
				$result = $this->ion_auth->cambiaAccion($params, '-');
				$nombrePerfil = $this->ion_auth->perfil($this->session->userdata('idPerfil'))->row();
				$log = $this->M_dashboard->saveLogPedidos($params,array($this->session->userdata('user_id'),'Pedido Rechazado por '.$nombrePerfil->name.'<br />Motivo:<br />'.$_POST['motivo']),array());
				if($result)
					echo "OK";
				else
					echo "Error";
				break;
			case 'apruebaPedido':
				$this->ion_auth->cambiaAccion($params, '+', false);
				$nombrePerfil = $this->ion_auth->perfil($this->session->userdata('idPerfil'))->row();
				$log = $this->M_dashboard->saveLogPedidos($params,array($this->session->userdata('user_id'),'Pedido Aprobado por '.$nombrePerfil->name),array());
				$comando = 'perfilCambio';
			case 'perfilCambio':
				$rows = $this->pedidosPerfil($this->session->userdata('idPerfil'), 'id');
				$data['datos'] = $rows;
				$data['idPerfil'] = $this->session->userdata('idPerfil');
				if (!isset($nombrePerfil))
					$nombrePerfil = $this->ion_auth->perfil($this->session->userdata('idPerfil'))->row();
				$data['nombrePerfil'] = $nombrePerfil->name;
				$string = $this->parser->parse('ajax/ajax_'.$comando, $data, TRUE);				
				$this->output->set_output($string);
			break;
			case 'crearProducto':
				if ($_POST){
                    			$this->form_validation->set_rules('nombre', 'Nombre', 'required|xss_clean');
                    			$this->form_validation->set_rules('observacion', 'Observaciones y Consideraciones', 'required|xss_clean');
                    			$this->form_validation->set_rules('tipo_kit', 'Tipo de Kit', 'required|xss_clean');
                    			$this->form_validation->set_rules('seguro_asociado', 'Seguro Asociado', 'required|xss_clean');
                    			$this->form_validation->set_rules('tipo_etiqueta', 'Tipo de Etiqueta', 'required|xss_clean');
                    			if ($this->form_validation->run() == true) {
                        			$accion = $this->M_dashboard->getWebContent('s_getIdAccionCreador');
                        			$idOwner = $this->ion_auth->get_user_id();
                        			$id_accion_creador = $accion[0]['id'];
                        			$ingreso['nombre'] = $this->input->post('nombre');
                        			$ingreso['observacion'] = $this->input->post('observacion');
                        			$ingreso['tipo_kit'] = $this->input->post('tipo_kit');
                        			$ingreso['tipo_etiqueta'] = $this->input->post('tipo_etiqueta');
                        			if($ingreso['tipo_kit'] == 6)
                        				$ingreso['cantidad_folios'] = $this->input->post('grupo_bienes') * 10;	
                        			else
                        				$ingreso['cantidad_folios'] = $this->input->post('cantidad_folios');
                        			$ingreso['folio_final'] = $this->input->post('folio_final');
                        			$ingreso['accion'] = $id_accion_creador;
                        			$ingreso['id_user'] = $idOwner;
                    			}
					if ($this->form_validation->run() == true && ($id = $this->ion_auth->create_producto($ingreso))) {
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						$this->M_dashboard->updateIdFileUpload($id, $this->session->userdata('user_id'),'producto');
						$log = $this->M_dashboard->saveLogProductos($id,array($this->session->userdata('user_id'),'Producto Creado'),array());
						echo "OK";
					} else {
						// retorna por error en validaciones
						$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
						echo $this->data['message'];
					}
				} else {
					$array_tipo_kits = $this->M_dashboard->getTipoKits();
					$array_seguros = $this->M_dashboard->getSegurosAsociados();
					$data['sel_tipo_kits'] = $this->convertToOptionanArray($array_tipo_kits);
					$data['sel_seguros'] = $this->convertToOptionanArray($array_seguros);
					$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
					$this->session->set_userdata('idPedido','0');
					$string = $this->parser->parse('ajax/ajax_'.$comando, $data, TRUE);
					$this->output->set_output($string);
				}
			break;
			case 'editarProducto':
				$accion = $this->M_dashboard->getWebContent('s_getIdAccionCreador');
				$id_accion_creador = $accion[0]['id'];
				if ($_POST){                	
					//$tables = $this->config->item('tables','ion_auth');
					//$this->form_validation->set_rules('nombre', 'Nombre', 'required|xss_clean');
					$this->form_validation->set_rules('observacion', 'Observaciones y Consideraciones', 'required|xss_clean');
					$this->form_validation->set_rules('tipo_kit', 'Tipo de Kit', 'required|xss_clean');
					$this->form_validation->set_rules('seguro_asociado', 'Seguro Asociado', 'required|xss_clean');
					$this->form_validation->set_rules('tipo_etiqueta', 'Tipo de Etiqueta', 'required|xss_clean');
					if ($this->form_validation->run() == true) {
						//$ingreso['nombre'] = $this->input->post('nombre');
						$ingreso['observacion'] = $this->input->post('observacion');
						$ingreso['tipo_kit'] = $this->input->post('tipo_kit');
						$ingreso['seguro_asociado'] = $this->input->post('seguro_asociado');
						$ingreso['tipo_etiqueta'] = $this->input->post('tipo_etiqueta');                        
						//$ingreso['cantidad_folios'] = $this->input->post('cantidad_folios');
						if($ingreso['tipo_kit'] == 6)
							$ingreso['cantidad_folios'] = $this->input->post('grupo_bienes') * 10;	
						else
							$ingreso['cantidad_folios'] = $this->input->post('cantidad_folios');                        
						$ingreso['accion'] = $id_accion_creador;
					}
					if ($this->form_validation->run() == true && ($id = $this->ion_auth->update_producto($ingreso, $this->input->post('idProducto')))) {
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						$this->M_dashboard->updateIdFileUpload($id, $this->session->userdata('user_id'), 'producto');
						$log = $this->M_dashboard->saveLogProductos($id,array($this->session->userdata('user_id'),'Producto Editado'),array());
						echo "OK";
					} else {
						// retorna por error en validaciones
						$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
						echo $this->data['message'];
					}                   
				} else {
					$id = $params;
					$datos = $this->M_dashboard->datosVerProducto($id);
					$array_tipo_kits = $this->M_dashboard->getTipoKits();                    
					$array_seguros = $this->M_dashboard->getSegurosAsociados();                    
					$array_tipo_etiqueta = array(
                                                0 => array('id' => 'Alfanumerico', 'nombre' => 'Alfanumerico'),
                                                1 => array('id' => 'Numerico', 'nombre' => 'Numerico')
                                       	);                       
					$datos['sel_tipo_kits'] = $this->convertToOptionanArray($array_tipo_kits, $datos['tipo_kit']);                    
					$datos['sel_seguros'] = $this->convertToOptionanArray($array_seguros, $datos['seguro_asociado']);                   
					$datos['sel_tipo_etiqueta'] = $this->convertToOptionanArray($array_tipo_etiqueta, $datos['tipo_etiqueta']);
					$datos['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
					$datos['GRAFICASRIBBON'] = $data['GRAFICASRIBBON'];
					$datos['id_producto'] = $id;
					$accionUsuario = $this->ion_auth->get_accion_perfil($this->session->userdata('idPerfil'));
					if ($accionUsuario == $id_accion_creador){
						$datos['puede_editar'] = true;
					} else {
						$datos['puede_editar'] = false;
					}
					$accionFinal = $this->M_dashboard->getWebContent('s_getIdAccionFinal');
					$id_accion_final = $accionFinal[0]['id'];
					if ($accionUsuario == $id_accion_final) {
						$datos['finaliza'] = true;
						//Obtener los subproductos
						$individuales = $this->M_dashboard->getListaProductoIndividual($id);
						if (!$individuales)
							$individuales = array();
						$datos['individuales'] = $individuales;
					} else {
						$datos['finaliza'] = false;
					}
					$id_accion_imprenta = $this->ion_auth->get_accion_por_perfil(3);
					if ($accionUsuario == $id_accion_imprenta){
						$datos['imprenta'] = true;
						$folios = $this->M_dashboard->getFolioImprenta($id);
						$datos['folio_inicial'] = $folios[0]['folio'];
						$datos['folio_final'] = $folios[1]['folio'];
					} else
						$datos['imprenta'] = false;
					$id_accion_aprueba = $this->ion_auth->get_accion_por_perfil(2);
					if ($accionUsuario == $id_accion_aprueba){
						$datos['aprueba'] = true;
						$datos['empresas'] = $this->M_dashboard->getEmpresas(true);
					} else
						$datos['aprueba'] = false;
					$datos['puede_comentar'] = $this->ion_auth->puede_comentar($this->session->userdata('idPerfil'));
					$this->session->set_userdata('idPedido',$id);
					$string = $this->parser->parse('ajax/ajax_'.$comando, $datos, TRUE);
					$this->output->set_output($string);
				}
			break;
			case 'verProducto':
				$id = $params;
				$datos = $this->M_dashboard->datosVerProducto($id);
				if(!$datos) {
					$this->output->set_output('ERR_PRODZERO');
					return;
				}
				$datos['message'] = validation_errors() ? validation_errors() : '';
				$datos['GRAFICASRIBBON'] = $data['GRAFICASRIBBON'];
				$datos['id_producto'] = $id;
				$this->session->set_userdata('idPedido',$id);
				$string = $this->parser->parse('ajax/ajax_'.$comando, $datos, TRUE);
				$this->output->set_output($string);
			break;
			case 'rechazaProducto':
				$datos_producto = $this->M_dashboard->datosVerProducto($params);
				if(!$datos_producto)
				{
					$this->output->set_output('Producto indicado no pudo ser ubicado por causa desconocida');
					return;
				}
				log_message('PHP', 'Datos del producto:'.print_r($datos_producto, true));
				$result = $this->ion_auth->rechazaProducto($params);
				$nombrePerfil = $this->ion_auth->perfil($this->session->userdata('idPerfil'))->row();
				$data_mail = $this->obtieneComentarioPerfil($this->session->userdata('idPerfil'), 'rechazar'); //obtiene comentario y lista correos por perfil				
				$array_envio = array(
									'name' => $nombrePerfil->name,
									'comment' => $data_mail['comentario'].$datos_producto['nombre'],
									'email'	=> $data_mail['correos']
								);				

				$log = $this->M_dashboard->saveLogProductos($params,array($this->session->userdata('user_id'),'Producto Rechazado por '.$nombrePerfil->name.'<br />Motivo:<br />'.$_POST['motivo']),array());
				if($result){
					$resp = $this->enviaMails("contacto",$array_envio);	
					echo "OK";
				}	
				else
					echo "Error";
			break;
			case 'finalizarProducto':
				/*$desde = intval($_POST['desde_folio']);
				$hasta = intval($_POST['hasta_folio']);
				if (isset($_POST['individuales'])){
					Hacer la logica que se resuelva despues de la Reunion
					 for ($i=$desde;$i <= $hasta; $i++){
			
					}
				}*/
				$this->ion_auth->cambiaAccion($_POST['idProducto'], '+', true);
				$nombrePerfil = $this->ion_auth->perfil($this->session->userdata('idPerfil'))->row();
				$datos_producto = $this->M_dashboard->datosVerProducto($_POST['idProducto']);
				$data_mail = $this->obtieneComentarioPerfil($this->session->userdata('idPerfil'), 'aprobar'); //al finalizar igual esta aprobando				
				$array_envio = array(
									'name' => $nombrePerfil->name,
									'comment' => $data_mail['comentario'].$datos_producto['nombre'],
									'email'	=> $data_mail['correos']
								);				
				$resp = $this->enviaMails("contacto",$array_envio);				
				//$log = $this->M_dashboard->saveLogProductos($params,array($this->session->userdata('user_id'),'Producto Finalizado por '.$nombrePerfil->name),array());
				echo 'OK';
			break;
			case 'apruebaProducto':
				$this->ion_auth->cambiaAccion($params, '+', true);
				//$accion = $this->M_dashboard->getWebContent('s_getIdAccionCreador');
				$datos_producto = $this->M_dashboard->datosVerProducto($params);
				$id_accion_aprobador = $this->ion_auth->get_accion_por_perfil(2);
				if ($id_accion_aprobador == $this->ion_auth->get_accion_perfil($this->session->userdata('idPerfil'))) {
					/* Crear Folios */
					$this->M_dashboard->creaProductoIndividual($params, $datos_producto['tipo_etiqueta']);
				}
				$nombrePerfil = $this->ion_auth->perfil($this->session->userdata('idPerfil'))->row();
				$log = $this->M_dashboard->saveLogProductos($params,array($this->session->userdata('user_id'),'Producto Aprobado por '.$nombrePerfil->name, ''),array());
				
				$data_mail = $this->obtieneComentarioPerfil($this->session->userdata('idPerfil'), 'aprobar');				
				$array_envio = array(
									'name' => $nombrePerfil->name,
									'comment' => $data_mail['comentario'].$datos_producto['nombre'],
									'email'	=> $data_mail['correos']
								);				
				$resp = $this->enviaMails("contacto",$array_envio);				
				$comando = 'perfilProducto';
			case 'perfilProducto':
				$rows = $this->productosPerfil($this->session->userdata('idPerfil'), 'id');
				$accion = $this->M_dashboard->getWebContent('s_getIdAccionCreador');
				$id_accion = $accion[0]['id'];
				$accionUsuario = $this->ion_auth->get_accion_perfil($this->session->userdata('idPerfil'));
				if ($accionUsuario == $id_accion){
					$data['puede_crear'] = true;
				}
				else{
					$data['puede_crear'] = false;
				}
				$data['datos'] = $rows;
				if (!isset($nombrePerfil))
					$nombrePerfil = $this->ion_auth->perfil($this->session->userdata('idPerfil'))->row();
				$data['nombrePerfil'] = $nombrePerfil->name;
				$string = $this->parser->parse('ajax/ajax_'.$comando, $data, TRUE);
				$this->output->set_output($string);
				break;
			case 'editarFolios':
				if ($this->input->post()){
					if ($this->input->post('rechaza'))
						$this->M_dashboard->cambiaEstadoFolio($this->input->post('rechaza'),'rechazado');
					if ($this->input->post('aprueba'))
						$this->M_dashboard->cambiaEstadoFolio($this->input->post('aprueba'),'aprobado');
				}
				echo 'OK';
				break;
			case 'activaKit':
				$registro = 1; //con error, NO SE ENCUENTRA FOLIO
				if ($_POST) {
					$activa['nombre'] = $this->input->post('nombre');
					$activa['rut'] = $this->input->post('rut');
					$activa['email'] = $this->input->post('email');
					$activa['telefono'] = $this->input->post('telefono');
					$activa['direccion'] = $this->input->post('direccion');
					$n_kit = $this->input->post('n_kit');
				}
				else
				{
					$valor = rand(100, 999);
					$activa['nombre'] = 'nombre_'.$valor;
					$activa['rut'] = 'rut_'.$valor;
					$activa['email'] = 'email_'.$valor;
					$activa['direccion'] = 'direccion_'.$valor;
					$activa['telefono'] = 'fono_'.$valor;
					$n_kit = isset($params) ? $params : $valor;
				}
			
				$n_folio = $this->M_dashboard->getFolioFromProductoIndividual($n_kit);
				if(is_array($n_folio)){ //existe folio, se debe registrar cliente
					if($n_folio[0]['id_cliente'] == '' && $n_folio[0]['clave_activacion'] == ''){
						$clave_activacion = random_string('alnum',20);
						//verificar que existe rut en tabla clte
						$existe_Rutcliente = $this->M_dashboard->getRutClienteById($n_folio[0]['id_cliente']);
						//si existe usar ese id clte para el update de la tabla producto_individualk
						if(is_array($existe_Rutcliente)){ //El cliente ya esta en la tabla gq_cliente
							$actualiza_producto = $this->M_dashboard->setIdclienteProductoIndividual($n_folio[0]['id_cliente'], $clave_activacion, $n_folio[0]['id']);
						}
						else{
							//si no existe hago el insert de los datos y el id que me devuelva hago el update en tabla producto_individual
							$registro = $this->M_dashboard->saveCliente($activa);
							if(is_array($registro)){
								$actualiza_producto = $this->M_dashboard->setIdclienteProductoIndividual($registro['id_clte'], $clave_activacion, $n_folio[0]['id']);
								$registro = 0; 
							}
							else
								$registro = 2; //ERROR EN BASE DE DATOS AL GRABAR CLIENTE
						}
					}
					else
						$registro = 3; //ERROR KIT YA ACTIVO
				}
				switch($registro){
					case 1:
						$salida = 'No existe Folio (kit)';
						$registro = $this->M_dashboard->saveCliente($activa);
						$save_activacion_fallida = $this->M_dashboard->saveActivacionFallida($registro['id_clte'], $n_kit);
						break;
					case 2:
						$salida = 'Error en Base de Datos, intente nuevamente';
						break;
					case 3:
						$salida = 'Kit ya activo';
						$save_activacion_fallida = $this->M_dashboard->saveActivacionFallida($n_folio[0]['id_cliente'], $n_folio[0]['folio']);
						break;
					default:
						$salida = 'Su clave es '.$clave_activacion;
						break;
				}
			
				$data['parametro'] = $registro;
				$data['mensaje'] = $salida;
				$string = $this->parser->parse('ajax/ajax_'.$comando, $data, TRUE);
				$this->output->set_output($string);
				break;
			case 'activaciones':
				$activaciones = $this->M_dashboard->getActivaciones();
				$data['datos'] = false;
				if (!isset($nombrePerfil))
					$nombrePerfil = $this->ion_auth->perfil($this->session->userdata('idPerfil'))->row();
				$data['nombrePerfil'] = $nombrePerfil->name;
				if (!empty($activaciones)){
					foreach ($activaciones as $a){
						$data['datos'] .= '<tr>';
						$data['datos'] .= '<td>'.$a['rut'].'</td>';
						$data['datos'] .= '<td>'.$a['nombre'].'</td>';
						$data['datos'] .= '<td>'.$a['email'].'</td>';
						$data['datos'] .= '<td>'.$a['telefono'].'</td>';
						$data['datos'] .= '<td>'.$a['folio'].'</td>';
						$data['datos'] .= '<td>'.$a['categoria'].'</td>';
						$data['datos'] .= '<td><div><nav><a href="getAjax/editarActivacion/'.$a['id_producto_individual'].'"><i class="fa fa-fw fa-edit "></i></a></nav></div></td>';
						$data['datos'] .= '</tr>';
					}
					$data['hayDatos'] = true;
				}
				else{
					$data['datos'] = "<tr><td colspan='7' align='center'>- Sin Activaciones Ingresadas -</td></tr>";
					$data['hayDatos'] = false;
				}
				$string = $this->parser->parse('ajax/ajax_'.$comando, $data, TRUE);
				$this->output->set_output($string);
				break;				
			case 'crearActivacion':
				if ($_POST){
					$registro = 1;
					$this->form_validation->set_rules('rut', 'RUT', 'required|xss_clean');
					$this->form_validation->set_rules('nombre', 'Nombre', 'required|xss_clean');
					$this->form_validation->set_rules('email', 'Email', 'required|xss_clean');
					$this->form_validation->set_rules('folio', 'Folio', 'required|xss_clean');
					if ($this->form_validation->run() == true)
					{
						$cliente['nombre'] = $this->input->post('nombre');
						$cliente['paterno'] = $this->input->post('paterno');
						$cliente['materno'] = $this->input->post('materno');
						$cliente['rut'] = forzarGuionRUT($this->input->post('rut'));						
						$cliente['email'] = $this->input->post('email');
						$cliente['direccion'] = $this->input->post('direccion');
						$cliente['ciudad'] = $this->input->post('ciudad');
						$cliente['region'] = $this->input->post('region');
						$cliente['comuna'] = $this->input->post('comuna');
						$cliente['telefono_casa'] = $this->input->post('telefono_casa');
						$cliente['telefono_movil'] = $this->input->post('telefono_movil');
						$producto['descripcion'] = $this->input->post('descripcion');
						$producto['tipo_producto'] = $this->input->post('tipo_producto');
						$producto['serie'] = $this->input->post('serie');
						$producto['marca'] = $this->input->post('marca');
						$producto['modelo'] = $this->input->post('modelo');
						$producto['color'] = $this->input->post('color');
						$producto['folio'] = $this->input->post('folio');
					}
					else{
						// retorna por error en validaciones
						$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
						echo $this->data['message']; exit;
					}
					$n_folio = $this->M_dashboard->getFolioFromProductoIndividual($producto['folio']);
					if(is_array($n_folio)){ //existe folio, se debe registrar cliente
						if($n_folio[0]['id_cliente'] == '' && $n_folio[0]['clave_activacion'] == ''){
							$clave_activacion = $this->generarCodigo(4);
							//verificar que existe rut en tabla clte
							$existe_Rutcliente = $this->M_dashboard->getRutClienteById($n_folio[0]['id_cliente']);
							if ($this->input->post('id_cliente') != "0") //el clte ya existe
							{
								$idCliente = $this->input->post('id_cliente');
								$datos_producto_individual = $this->M_dashboard->getProductosIndividualByRut($idCliente); //trae por id
								$clave_activacion = $datos_producto_individual[0]['clave_activacion'];
								$this->M_dashboard->updateClienteCompleto($idCliente, $cliente);
							}
							else {								
								$clave_activacion = $this->generarCodigo(4);
								$registro = $this->M_dashboard->saveClienteCompleto($cliente);
								$idCliente = $registro['id'];
							}
							//echo('clave: '.$clave_activacion);die();
							$idProducto = $n_folio[0]['id'];
							$actualiza_producto = $this->M_dashboard->setIdclienteProductoIndividual($idCliente, sha1($clave_activacion), $idProducto);
							$registro = 0;
										
							$array_envio = array(
									'name' => $cliente['nombre'].' '.$cliente['paterno'],
									'comment' => 'Su clave de Activación es '.$clave_activacion,
									'email'	=> $cliente['email'] //'hdandres23@gmail.com' //correo de cliente
								);				
							$resp = $this->enviaMails("contacto",$array_envio);											
						}
						else
							$registro = 3; //ERROR KIT YA ACTIVO
					}
					switch($registro){
						case 1:
							//$salida = 'No existe Folio (kit)';
							$salida = 'OK';
							$registro = $this->M_dashboard->saveClienteCompleto($cliente);
							$producto['id_cliente'] = $registro['id'];
							$producto['motivo_falla'] = "Folio No Existente";
							$idActivacionFallida = $this->M_dashboard->saveActivacionFallida2($producto);
							$this->M_dashboard->updateIdFileUpload($idActivacionFallida, $this->session->userdata('user_id'), 'activacion');
							break;
						case 2:
							$salida = 'Error en Base de Datos, intente nuevamente';
							break;
						case 3:
							//$salida = 'Kit ya activo';
							$salida = 'OK';
							$registro = $this->M_dashboard->saveClienteCompleto($cliente);
							$producto['id_cliente'] = $registro['id'];
							$producto['motivo_falla'] = "Folio ya Utilizado";
							$idActivacionFallida = $this->M_dashboard->saveActivacionFallida2($producto);
							$this->M_dashboard->updateIdFileUpload($idActivacionFallida, $this->session->userdata('user_id'), 'activacion');
							break;
						default:
							//Guardar datos de producto
							$folio = $producto['folio'];
							unset($producto['folio']);
							$datos = array(
										'id_cliente' => $idCliente,
										'id_producto' => $idProducto
									);
							$this->M_dashboard->updateIdFileUpload($idProducto, $this->session->userdata('user_id'), 'activacion');
							$this->M_dashboard->updateProductoIndividual($folio, $producto);
							$salida = $clave_activacion;
							break;
					}						
					$data['parametro'] = $registro;
					$data['mensaje'] = $salida;
					echo $salida;
				}
				else{
					$data['message'] = '';
					$categorias = $this->M_dashboard->getTipoProductos();
					$data['categorias'] = array_merge(array("" => "- Seleccione el Tipo de Producto -"), $categorias);
					$regiones = $this->M_dashboard->getRegiones();
					$data['regiones'] = array_merge(array("0" => "- Seleccione la Region -"), $regiones);
					$string = $this->parser->parse('ajax/ajax_'.$comando, $data, TRUE);
					$this->output->set_output($string);					
				}
				break;
			case 'editarActivacion':
				if ($_POST){
					$registro = 1;
					$this->form_validation->set_rules('nombre', 'Nombre', 'required|xss_clean');
					$this->form_validation->set_rules('email', 'Email', 'required|xss_clean');
					if ($this->form_validation->run() == true)
					{
						$cliente['nombre'] = $this->input->post('nombre');
						$cliente['paterno'] = $this->input->post('paterno');
						$cliente['materno'] = $this->input->post('materno');
						$idCliente = $this->input->post('id_cliente');
						$cliente['email'] = $this->input->post('email');
						$cliente['direccion'] = $this->input->post('direccion');
						$cliente['ciudad'] = $this->input->post('ciudad');
						$cliente['region'] = $this->input->post('region');
						$cliente['comuna'] = $this->input->post('comuna');
						$cliente['telefono_casa'] = $this->input->post('telefono_casa');
						$cliente['telefono_movil'] = $this->input->post('telefono_movil');
						$producto['descripcion'] = $this->input->post('descripcion');
						$producto['serie'] = $this->input->post('serie');
						$producto['marca'] = $this->input->post('marca');
						$producto['modelo'] = $this->input->post('modelo');
						$producto['color'] = $this->input->post('color');
						$idProducto = $this->input->post('id_producto_individual');
						$folio  = $this->input->post('folio');
						$this->M_dashboard->updateClienteCompleto($idCliente, $cliente);
						$this->M_dashboard->updateIdFileUpload($idProducto, $this->session->userdata('user_id'), 'activacion');
						$this->M_dashboard->updateProductoIndividual($folio, $producto);
						echo "OK";
					}
					else
						echo "Error al validar los campos";
				}
				else{
					$datosActivacion = $this->M_dashboard->getActivacion($params);
					if ($datosActivacion)
						$data = array_merge($datosActivacion, $data);
					$data['message'] = '';
					$data['id_producto_individual'] = $params;
					$categorias = $this->M_dashboard->getTipoProductos();
					$data['categorias'] = array_merge(array("" => "- Seleccione el Tipo de Producto -"), $categorias);
					$regiones = $this->M_dashboard->getRegiones();
					$data['arregloRegiones'] = array_merge(array("0" => "- Seleccione la Region -"), $regiones);
					$data['arregloComunas'] = $this->M_dashboard->getComunas($data['region']);
					$data['arregloMarcas'] = $this->M_dashboard->getMarcas($data['tipo_producto']);
					$this->session->set_userdata('idPedido',$params);
					$string = $this->parser->parse('ajax/ajax_'.$comando, $data, TRUE);
					$this->output->set_output($string);
				}
				break;
			case 'buscaRut':
				if ($_POST){
					$rut = str_replace ( array(".","-"), "", $this->input->post('rut') );
					$rutG = substr($rut, 0, -1) . '-' . substr ( $rut, -1 );                    											
					if($salida = $this->M_dashboard->getDatosclteFromClientes($rut))
						echo json_encode($salida);
					elseif($salida = $this->M_dashboard->getDatosclteFromClientes($rutG))
						echo json_encode($salida);
						
				}
				break;			
			case 'buscaFolio':
				if ($_POST){
					$folio = $this->input->post('folio');
					$salida = $this->M_dashboard->getFolioFromProductoIndividual($folio);
					if (!$salida)
					{
						//Valida que el Folio Exista
						$salida = array('resultado' => 'Folio Inexistente');
					}
					else
					{
						$salida = $salida[0];
						$tipo = $this->input->post('tipo');
						if ($tipo == 'activacion')
						{
							//Valida que el Folio no se encuentre activo
							if ($salida['clave_activacion'] != '')
								$salida['resultado'] = "Ese Folio ya se encuentra Activado";
							else {
								switch ($salida['estado'])
								{
									case 'dado por robo':
										$salida['resultado'] = "Ese Folio se encuentra reportado como Robado";
										break;
									case 'disponible':
									case 'rechazado':
										$salida['resultado'] = "Ese Folio no se encuentra aprobado. Contactar con el Supervisor";
										break;
									case 'aprobado':
										$salida['resultado'] = "OK";
										break;
									default:
										$salida['resultado'] = "Estado no Reconocido. Contactar con el Supervisor";
										break;
								}
							}
						}
						else  /* Viene desde Robo */
						{
							if ($salida['clave_activacion'] == '')
								$salida['resultado'] = "Ese Folio no ha sido Activado";
							else
							{
								if ($salida['id_cliente'] != $this->input->post('id_cliente'))
								{
									$salida['resultado'] = "Ese Folio está asociado a otro usuario";
								}
								else
								{
									switch ($salida['estado'])
									{
										case 'dado por robo':
											$salida['resultado'] = "Ese Folio ya se encuentra reportado como Robado";
											break;
										case 'disponible':
										case 'rechazado':
											$salida['resultado'] = "Ese Folio no se encuentra aprobado. Contactar con el Supervisor";
											break;
										case 'aprobado':
											$salida['resultado'] = "OK";
											break;
										default:
											$salida['resultado'] = "Estado no Reconocido. Contactar con el Supervisor";
											break;
									}
								}
							}
						}
					}
					echo json_encode($salida);
				}
				
			case 'buscaComuna':
				if ($this->input->post('idRegion'))
				{
					$comunas = $this->M_dashboard->getComunas($this->input->post('idRegion'));
					echo json_encode($comunas);
				}
				break;
			case 'buscaMarca':
				if ($this->input->post('idCategoria'))
				{
					$marcas = $this->M_dashboard->getMarcas($this->input->post('idCategoria'));
					echo json_encode($marcas);
				}
				break;
			case 'detalleFolios':
				$datos['GRAFICASRIBBON'] = $data['GRAFICASRIBBON'];
				$id_and_estado = explode("_", $params);
					
				$foliosProducto = $this->M_dashboard->getFoliosProductoByEstado($id_and_estado);
				log_message('PHP', '[C] En '.$comando.' llegan estas filas:'.print_r($foliosProducto, true));
				if($foliosProducto)
					$rows = $this->tablaFoliosProducto($foliosProducto, $id_and_estado[1]);
				else
					$rows = '<tr><td>Sin datos...</td>
						<td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td>
						<td>&nbsp;</td><td>&nbsp;</td>
						</tr>';
				$datos['datos'] = $rows;
				$datos['id_folio'] = $id_and_estado[0];
				$string = $this->parser->parse('ajax/ajax_'.$comando, $datos, TRUE);
				$this->output->set_output($string);
				break;
			case 'robos':
				$data['esFiscal'] = false;
				if ($this->session->userdata('idPerfil') == -1)
					$robos = $this->M_dashboard->getRobos(1);
				else {
					$robos = $this->M_dashboard->getRobos($this->ion_auth->get_accion_perfil($this->session->userdata('idPerfil')));
					$accion = $this->M_dashboard->getWebContent('s_getIdAccionFiscalia');
					$id_accion_fiscal = $accion[0]['id'];
					$accionUsuario = $this->ion_auth->get_accion_perfil($this->session->userdata('idPerfil'));
					if ($accionUsuario == $id_accion_fiscal)
						$data['esFiscal'] = true;
				}
				$data['datos'] = false;
				if (!isset($nombrePerfil))
					$nombrePerfil = $this->ion_auth->perfil($this->session->userdata('idPerfil'))->row();
				$data['nombrePerfil'] = $nombrePerfil->name;
				if (!empty($robos)){
					foreach ($robos as $a){
						$data['datos'] .= '<tr>';
						$data['datos'] .= '<td>'.$a['rut'].'</td>';
						$data['datos'] .= '<td>'.$a['nombre'].'</td>';
						$data['datos'] .= '<td>'.$a['email'].'</td>';
						$data['datos'] .= '<td>'.$a['telefono'].'</td>';
						$data['datos'] .= '<td>'.$a['folio'].'</td>';
						$data['datos'] .= '<td>'.$a['fecha'].'</td>';
						$data['datos'] .= '<td>'.$a['estado'].'</td>';
						if ($a['accion'] == $this->ion_auth->get_accion_perfil($this->session->userdata('idPerfil')))
							$data['datos'] .= '<td><div><nav><a href="getAjax/editarRobo/'.$a['id_robo'].'"><i class="fa fa-fw fa-edit "></i></a></nav></div></td>';
						else
							$data['datos'] .= '<td><div><nav><a href="getAjax/verRobo/'.$a['id_robo'].'"><i class="fa fa-fw fa-eye "></i></a></nav></div></td>';
						$data['datos'] .= '</tr>';
					}
					$data['hayDatos'] = true;
				}
				else{
					$data['datos'] = "<tr><td colspan='7' align='center'>- Sin Robos Ingresados, Pendientes -</td></tr>";
					$data['hayDatos'] = false;
				}
				$string = $this->parser->parse('ajax/ajax_'.$comando, $data, TRUE);
				$this->output->set_output($string);
				break;
			case 'reportaRobo':
				$registro = 1; //con error de datos
				if ($_POST) {
                    			$cliente['rut'] = forzarGuionRut($this->input->post('rut'));											
					$cliente['nombre'] = $this->input->post('nombre');
					$cliente['paterno'] = $this->input->post('paterno');
					$cliente['materno'] = $this->input->post('materno');
					$cliente['email'] = $this->input->post('email');
					$cliente['telefono_casa'] = $this->input->post('telefono_casa');
					$cliente['telefono_movil'] = $this->input->post('telefono_movil');
					$cliente['direccion'] = $this->input->post('direccion');
					$cliente['region'] = $this->input->post('region');
					$cliente['ciudad'] = $this->input->post('ciudad');

					$robo['lugar']    = $this->input->post('lugar');
					$robo['dia']    = $this->input->post('dia');
					$robo['hora']    = $this->input->post('hora');
					$robo['tipo_bien']    = $this->input->post('tipo_bien');
					$robo['marca']    = $this->input->post('marca');
					$robo['modelo']    = $this->input->post('modelo');
					$robo['descripcion']    = $this->input->post('descripcion');
					$datos_clte = $this->M_dashboard->getDatosclteFromClientes($cliente['rut']);
					//pendiente ver si esta repetido el robo
					if(is_array($datos_clte)){ //cliente existe
						//obtengo registros de producto_individual, todo el que tenga clave_activacion <> vacio esta activo
						$datos_productos = $this->M_dashboard->getProductosIndividualByRut($datos_clte[0]['id']);
						$robo['id_cliente'] = $datos_clte[0]['id'];
					}
					else{
						$graba_clte = $this->M_dashboard->saveClienteCompleto($cliente);
						if ($graba_clte)
							$robo['id_cliente'] = $graba_clte['id'];
						else
							$registro = 2;
					}
						
					$graba_robo = $this->M_dashboard->saveReporteRobo($robo);
					if($graba_robo)
						$registro = 0; //'Su clave es '.$clave_activacion; activacion correcta
					else
						$registro = 2; //ERROR EN BASE DE DATOS AL GRABAR robo
						
					switch($registro){
						case 1:
							$salida = 'ERROR datos formulario';
							break;
						case 2:
							$salida = 'Error en Base de Datos, Grabando ROBO';
							break;
						default:
							$log = $this->M_dashboard->saveLogRobo($params,array($this->session->userdata('user_id'),'Creación de Reporte de Robo hecha por el usuario'),array());
							$salida = 'Reporte almacenado correctamente';
							break;
					}						
					//$n_kit = $this->input->post('n_kit');
				}
				else
				{
					$valor = rand(100, 999);
					$cliente['rut'] = 'rut_'.$valor;
					$cliente['nombre'] = 'Andres_'.$valor;
					$cliente['paterno'] = 'paterno_'.$valor;
					$cliente['materno'] = 'materno_'.$valor;
					$cliente['email'] = 'email_'.$valor;
					$cliente['telefono_casa'] = 'fono_'.$valor;
					$cliente['telefono_movil'] = 'celu_'.$valor;
					$cliente['direccion'] = 'direccion_'.$valor;
					$cliente['region'] = 'region_'.$valor;
					$cliente['ciudad'] = 'ciudad_'.$valor;
					 
			
					$robo['lugar']    = 'lugar_'.$valor;
					$robo['dia']    = '01-01-2014';
					$robo['hora']    = '12:00:00';
					$robo['tipo_bien']    = 'tipo_bien_'.$valor;
					$robo['marca']    = 'marca_'.$valor;
					$robo['modelo']    = 'modelo_'.$valor;
					$robo['descripcion'] = 'descripcion_'.$valor;
					//$n_kit = isset($params) ? $params : $valor;
				}
				 
				$data['parametro'] = $registro;
				$data['mensaje'] = $salida;
				$string = $this->parser->parse('ajax/ajax_'.$comando, $data, TRUE);
				$this->output->set_output($string);
				break;
			case 'crearRobo':
				if ($_POST){
					$robo['lugar']    = $this->input->post('lugar');
					$robo['dia']    = $this->input->post('dia');
					$robo['hora']    = $this->input->post('hora');
					$robo['folio']    = $this->input->post('folio');
					$robo['id_cliente']    = $this->input->post('id_cliente');

					$graba_robo = $this->M_dashboard->saveReporteRobo($robo);
					if($graba_robo){
						$producto['estado'] = 'dado por robo';
						$this->M_dashboard->updateProductoIndividual($this->input->post('folio'),$producto);
						$this->M_dashboard->updateIdFileUpload($graba_robo, $this->session->userdata('user_id'), 'robo');
						$log = $this->M_dashboard->saveLogRobo($graba_robo,array($this->session->userdata('user_id'),'Creación de Reporte de Robo'),array());
						$nombrePerfil = $this->ion_auth->perfil($this->session->userdata('idPerfil'))->row();
						$data_fiscalia = $this->obtieneComentarioPerfil($this->session->userdata('idPerfil').'F', 'aprobar');				
						$data_clte = $this->obtieneComentarioPerfil($this->session->userdata('idPerfil').'C', 'aprobar');				
						$array_envio_fiscalia = array(
									'name' => $nombrePerfil->name,
									'comment' => $data_fiscalia['comentario'].$robo['folio'],
									'email'	=> $data_fiscalia['correos']
								);				
						$resp = $this->enviaMails("contacto",$array_envio_fiscalia);
						$array_envio_clte = array(
									'name' => $nombrePerfil->name,
									'comment' => $data_clte['comentario'].$robo['folio'],
									'email'	=> $data_clte['correos']
								);				
						$resp = $this->enviaMails("contacto",$array_envio_clte);

						$salida = 'OK';
					}
					else
						$salida = "Error al Guardar el Robo";
					echo $salida;
				}
				else{
					$data['message'] = '';
					$categorias = $this->M_dashboard->getTipoProductos();
					$data['categorias'] = array_merge(array("" => "- Seleccione el Tipo de Producto -"), $categorias);
					$regiones = $this->M_dashboard->getRegiones();
					$data['regiones'] = array_merge(array("0" => "- Seleccione la Region -"), $regiones);
					$string = $this->parser->parse('ajax/ajax_'.$comando, $data, TRUE);
					$this->output->set_output($string);
				}
				break;
			case 'editarRobo':
				if ($_POST){
					if ($this->input->post('lugar'))
						$robo['lugar']    = $this->input->post('lugar');
					if ($this->input->post('dia'))
						$robo['dia']    = $this->input->post('dia');
					if ($this->input->post('hora'))
						$robo['hora']    = $this->input->post('hora');
					if ($this->input->post('gestion'))
						$robo['gestion'] = $this->input->post('gestion'); 
					$id_robo = $this->input->post('id_robo');

					$graba_robo = $this->M_dashboard->updateReporteRobo($id_robo,$robo);
					if($graba_robo)
						$this->M_dashboard->updateIdFileUpload($id_robo, $this->session->userdata('user_id'), 'robo');
					if($this->input->post('data'))
						$tempo = "Comentario: ".$this->input->post('data')."<BR>";
					else
						$tempo = 'Edición de Reporte de Robo';
					$log = $this->M_dashboard->saveLogRobo($id_robo,array($this->session->userdata('user_id'),$tempo),array());
					$salida = 'OK';
					echo $salida;
				}
				else{
					$this->session->set_userdata('idPedido', $params);
					$data = array_merge($data, $this->M_dashboard->getRobo($params));
					$data['message'] = '';
					$data['mensaje'] = $this->M_dashboard->getLogRoboById($params);
					$data['arregloFecha'] = explode("-",$data['dia']);
					$categorias = $this->M_dashboard->getTipoProductos();
					$data['categorias'] = array_merge(array("" => "- Seleccione el Tipo de Producto -"), $categorias);
					$regiones = $this->M_dashboard->getRegiones();
					$data['arregloRegiones'] = array_merge(array("0" => "- Seleccione la Region -"), $regiones);
					$data['arregloComunas'] = $this->M_dashboard->getComunas($data['region']);
					$data['arregloMarcas'] = $this->M_dashboard->getMarcas($data['tipo_producto']);
					$data['esFiscal'] = false;
					$accion = $this->M_dashboard->getWebContent('s_getIdAccionFiscalia');
					$id_accion_fiscal = $accion[0]['id'];
					$accionUsuario = $this->ion_auth->get_accion_perfil($this->session->userdata('idPerfil'));
					if ($accionUsuario == $id_accion_fiscal)
						$data['esFiscal'] = true;						
					$string = $this->parser->parse('ajax/ajax_'.$comando, $data, TRUE);						
					$this->output->set_output($string);
				}
				break;
			case 'apruebaRobo':
				$this->ion_auth->cambiaAccionPorTipo($params, '+', 'robo');
				//$accion = $this->M_dashboard->getWebContent('s_getIdAccionCreador');
				//$id_accion_aprobador = $this->ion_auth->get_accion_por_perfil(2);
				//$nombrePerfil = $this->ion_auth->perfil($this->session->userdata('idPerfil'))->row();
				//$log = $this->M_dashboard->saveLogProductos($params,array($this->session->userdata('user_id'),'Producto Aprobado por '.$nombrePerfil->name, ''),array());
				/* $comando = 'robo';
				$string = $this->parser->parse('ajax/ajax_'.$comando, $data, TRUE);
				$this->output->set_output($string); */
				$nombrePerfil = $this->ion_auth->perfil($this->session->userdata('idPerfil'))->row();
				$log = $this->M_dashboard->saveLogRobo($params,array($this->session->userdata('user_id'),'Reporte de Robo Aprobado por '.$nombrePerfil->name),array());				
				$this->getAjax('robos','');
				break;
     			case 'rechazaRobo':
                		$this->ion_auth->rechazaRobo($params);
                		$nombrePerfil = $this->ion_auth->perfil($this->session->userdata('idPerfil'))->row();
                		$log = $this->M_dashboard->saveLogRobo($params,array($this->session->userdata('user_id'),'Reporte de Robo Rechazado por '.$nombrePerfil->name.'<br />Motivo:<br />'.$_POST['motivo']),array());
                		if($log)
                		    echo "OK";
                		else
                		    echo "Error";
                		break;

			case 'verRobo':
				$data = array_merge($data, $this->M_dashboard->getRobo($params));
				$data['message'] = '';
				$this->session->set_userdata('idPedido',$params);
				$categorias = $this->M_dashboard->getTipoProductos();
				$marcas = $this->M_dashboard->getMarcas($data['tipo_producto']);
				$data['tipo_producto'] = $categorias[$data['tipo_producto']];
				$regiones = $this->M_dashboard->getRegiones();
				$comunas = $this->M_dashboard->getComunas($data['region']);
				$data['region'] = $regiones[$data['region']];
				$data['comuna'] = $comunas[$data['comuna']];
				$data['marca'] = $marcas[$data['marca']];
				$data['mensaje'] = $this->M_dashboard->getLogRoboById($params);
				$string = $this->parser->parse('ajax/ajax_'.$comando, $data, TRUE);
				$this->output->set_output($string);
				break;
			case 'buscar':
				if ($_POST)
				{
					switch ($params){
						case 'robo':
							$temp = $this->input->post('fecha_desde');
							if ($temp != '')
								$fecha1 = implode("-",array_reverse(explode("/",$temp)));
							else
								$fecha1 = '';
							$temp = $this->input->post('fecha_hasta');
							if ($temp != '')
								$fecha2 = implode("-",array_reverse(explode("/",$temp)));
							else
								$fecha2 = '';
							if (($fecha1 == '') && ($fecha2 == ''))
								$resultado = false;
							else
								$resultado = $this->M_dashboard->buscaRobo($fecha1, $fecha2);
							if ($resultado)
							{
								$salida = array();
								$salida['robos'] = array();
								foreach ($resultado as $r)
								{
									$salida['robos'][] = array('folio' => $r['folio'], 'lugar' => $r['lugar'], 'fecha' => $r['fecha'], 'rut' => $r['rut'], 'nombre_cliente' => $r['nombre_cliente']);	
								}
								$string = $this->parser->parse('ajax/ajax_buscarRobo', $salida, TRUE);
							}
							else
								$string = $this->parser->parse('ajax/ajax_sinResultado', array(), TRUE);
							$this->output->set_output($string);
							break;
						case 'producto':
							$folio = $this->input->post('folio');
							$resultado = $this->M_dashboard->buscaProducto($folio);
							if ($resultado)
								$string = $this->parser->parse('ajax/ajax_buscarProducto', $resultado, TRUE);
							else
								$string = $this->parser->parse('ajax/ajax_sinResultado', array(), TRUE);
							$this->output->set_output($string);
							break;
						case 'cliente':
							$rut = $this->input->post('rut');
							$nombre = $this->input->post('nombre');
							$resultado = $this->M_dashboard->buscaCliente($rut, $nombre);
							if ($resultado)
							{
								$salida = array();
								$salida['clientes'] = array();
								$salida['productos'] = array();
								$rut = '';
								foreach ($resultado as $r)
								{
									if ($rut != $r['rut'])
									{
										$rut = $r['rut'];
										$sin_producto = false;
										if ($r['folio'] == '')
											$sin_producto = true;
										$salida['clientes'][] = array('rut' => $r['rut'], 'nombre' => $r['nombre'], 'paterno' => $r['paterno'], 'email' => $r['email'], 'sin_producto' => $sin_producto);										
									}
									if ($r['folio'] != '')
										$salida['productos'][$rut][] = array('folio' => $r['folio'], 'clave_activacion' => $r['clave_activacion'], 'nombre_kit' => $r['nombre_kit']);
								}
								$string = $this->parser->parse('ajax/ajax_buscarCliente', $salida, TRUE);
							}
							else
								$string = $this->parser->parse('ajax/ajax_sinResultado', array(), TRUE);
							$this->output->set_output($string);
							break;
					}
					// Realizar la Busqueda Segun los diferentes Criterios
				}
				else {
					$string = $this->parser->parse('ajax/ajax_'.$comando, $data, TRUE);
					$this->output->set_output($string);						
				}
				break;
			default:
				$string = $this->parser->parse('ajax/ajax_'.$comando, $data, TRUE);				
				$this->output->set_output($string);
		}
	}

	public function convertToOptionanArray($array, $selected = null){
		$salida = '';
		$optSelected = "";
		foreach ($array as $key) {
			if($selected != null){
				if($selected == $key['nombre'])
					$optSelected = "SELECTED";
				else
					$optSelected = "";
			}	
			$salida .= "<option value='".$key['id']."' $optSelected>" . $key['nombre'] . '</option>';
		}
		return $salida;

	}
	public function getPedidos(){
		$salida = $this->M_dashboard->getPedidos();
		return $salida;
	}
	public function getCategorias(){
		$salida = $this->M_dashboard->getCategorias();
		return $salida;
	}
	
	public function getEstadosPedidos(){
		$salida = $this->M_dashboard->getEstadosPedidos();
		return $salida;
	}

	public function saveWebcontent($id,$data){
		$salida = $this->M_dashboard->saveContentById($id,$data);
		return $salida;
	}
	public function savePedidoscontent($id,$data,$data2){
		$user = $this->ion_auth->user()->row();
		$log = $this->M_dashboard->saveLogPedidos($id,array($user->id,$data['data']),array());
		$salida = $this->M_dashboard->savePedidoscontent($id,$data2);
		return $salida;
	}

	public function editWebcontent($id){
		$salida = $this->M_dashboard->getContentById($id,'s_getcontentbyid');
		return $salida;
	}
	public function editPedidoscontent($id){
		$salida = $this->M_dashboard->getContentById($id,'s_getpedidosbyid');
		return $salida;
	}

	public function webcontent(){
		$salida = $this->M_dashboard->getWebContent('s_webcontent');
		$row = "";
		foreach($salida as $key){
			$row .= "<tr>";
			$k = "";
			foreach($key as $k => $v){
				$row .= "<td>".$v."</td>"; 
				if($k == "id")
					$id = $v;
			}
			$row .= "<td align='center'><nav><a href='getAjax/editWebcontent/$id'><i class='fa fa-fw fa-edit '></i></a> <!-- <a href='getAjax/delWebcontent/$id'><i class='fa fa-fw fa-times-circle'></i></a> --></nav></td>";
			$row .= "</tr>";
		}
		return $row;
	}

	public function pedidos(){
		$salida = $this->M_dashboard->getWebContent('s_pedidos');
		$row = "";
		
		foreach($salida as $key){
			$row .= "<tr>";
			$k = "";
			foreach($key as $k => $v){
				if ($k == 'accion_id') continue;
				if($k == 'precio')
					$v = '$'.precio($v);
				$row .= "<td>".$v."</td>"; 
				if($k == "id") // separa el ID para poder usarlo abajo
					$id = $v;
			}
			$row .= "<td align='center'><nav><a href='getAjax/editPedidoscontent/$id'><i class='fa fa-fw fa-edit '></i></a><!-- <a href='getAjax/delPedidoscontent/$id'><i class='fa fa-fw fa-times-circle'></i></a>--></nav></td>";
			$row .= "</tr>";
		}
		return $row;
	}

	public function productosPerfil($perfil_id = '', $tipo = 'id', $despliegue = 0){
		$row = "";
		if ($perfil_id != '') {
			if ($tipo == 'id')
				$accion = $this->ion_auth->get_accion_perfil($perfil_id);
			/*
				$estados = $this->ion_auth->get_estados_perfil($perfil_id)->result_array();
			else
				$estados = $this->ion_auth->get_estados_perfil_nombre($perfil_id)->result_array();
			
			$idEstados = array();
			foreach ($estados as $es)
				$idEstados[] = $es['id'];
			$estados = implode(",",$idEstados);
			$salida = $this->M_dashboard->getContentByEstado($estados);
			*/
			$salida = $this->M_dashboard->getWebContent('s_productos_perfil');
			if (!empty($salida)){
				foreach($salida as $key){
					$row .= "<tr>";
					$k = "";
					$puedeEditar = false;
					foreach($key as $k => $v){
						switch ($k) {
							case 'accion':
								if ($v == $accion) 
									$puedeEditar = true;
							break;
							case 'id': // separa el ID para poder usarlo abajo
								$id = $v;
							default:
								$row .= "<td>".$v."</td>";
						}
					}
					$row .= $puedeEditar?"<td align='center'><nav><a href='getAjax/editarProducto/".$id."'><i class='fa fa-fw fa-edit '></i></a><!-- <a href='getAjax/delPedidoscontent/$id'><i class='fa fa-fw fa-times-circle'></i></a>--></nav></td>":"<td align='center'><nav><a href='getAjax/verProducto/".$id."'><i class='fa fa-fw fa-eye '></i></a></nav></td>";
					$row .= "</tr>";
				}
			}
		}
		if ($despliegue == 0)
			return $row;
		else
			$this->output->set_output($row);
	}

	public function pedidosPerfil($perfil_id = '', $tipo = 'id', $despliegue = 0){
		$row = "";
		if ($perfil_id != '') {
			$accion = $this->ion_auth->get_accion_perfil($perfil_id);
			if ($tipo == 'id'){
				$estados = $this->ion_auth->get_estados_perfil($perfil_id)->result_array();
			}
			else
				$estados = $this->ion_auth->get_estados_perfil_nombre($perfil_id)->result_array();
			$idEstados = array();
			foreach ($estados as $es)
				$idEstados[] = $es['id'];
			$estados = implode(",",$idEstados);
			$salida = $this->M_dashboard->getWebContent('s_pedidos_perfil');
				
			foreach($salida as $key){
				$row .= "<tr>";
				$k = "";
				$puedeEditar = false;
				foreach($key as $k => $v){
					switch ($k) {
						case 'accion_id':
						if ($v == $accion)
							$puedeEditar = true;
						break;
						case 'id':
						$id = $v;
						$row .= "<td>".$v."</td>";
						break;
						case 'precio':
						$v = '$'.precio($v);
						default:
						$row .= "<td>".$v."</td>";
					}
				}
				$row .= $puedeEditar?"<td align='center'><nav><a href='getAjax/editPedidosPerfil/".$id."'><i class='fa fa-fw fa-edit '></i></a><!-- <a href='getAjax/delPedidoscontent/$id'><i class='fa fa-fw fa-times-circle'></i></a>--></nav></td>":"<td align='center'><nav><a href='getAjax/verPedidos/".$id."'><i class='fa fa-fw fa-eye '></i></a></nav></td>";
				$row .= "</tr>";
			}
		}
		if ($despliegue == 0)
			return $row;
		else
			$this->output->set_output($row);
	}

	public function obtieneComentarioPerfil($id_perfil, $accion)
	{		
		if($accion == 'aprobar'){
			switch ($id_perfil) {
				case '2F':
					#reporte Robo a fiscalia
				    $salida = 'Se reporta Robo con folio: ';
				    break;
				case '2C':
					#reporte Robo a Cliente
				    $salida = 'Ud ha reportado Robo de producto con folio: ';
				    break;				    
				case '4':
					# Crear producto
					$salida = 'Se crea Producto: '; 
					$lista_mails = $this->M_dashboard->getListaCorreosByPerfil(7); //se los debe enviar a aprobador					
					//log_message('ERROR', 'separados , :'.$lista_mails);
					break;			
				case '7':	
					# aprueba producto
					$salida = 'Se aprueba Producto: '; 
					$lista_mails = $this->M_dashboard->getListaCorreosByPerfil(5); //se los debe enviar a imprenta	
					break;						
				case '5':	
					# producto Impreso
					$salida = 'Proceso de impresión listo para Producto: '; 
					$lista_mails = $this->M_dashboard->getListaCorreosByPerfil(6); //se los debe enviar a revision	
					break;										
				case '6':	
					# producto revisado
					$salida = 'Finaliza proceso de revisión para Producto: '; 
					$lista_mails = $this->M_dashboard->getListaCorreosByPerfil(4); //se los debe enviar a creador	
					break;														
				default:
					$salida = '';
					break;
			}
		}
		else{
			switch ($id_perfil) {
				/*case '4':
					# Crear producto
					$salida = 'Se crea Producto: '; 
					break;			*/
				case '7':	
					# aprueba producto
					$salida = 'Aprobación, rechaza Producto: '; 
					$lista_mails = $this->M_dashboard->getListaCorreosByPerfil(4); //se los debe enviar a creador
					break;						
				case '5':	
					# producto Impreso
					$salida = 'Imprenta ha rechazado el Producto: '; 
					$lista_mails = $this->M_dashboard->getListaCorreosByPerfil(7); //se los debe enviar a aprobador
					break;										
				case '6':	
					# producto revisado
					$salida = 'Revisión rechaza Producto: ';
					$lista_mails = $this->M_dashboard->getListaCorreosByPerfil(5); //se los debe enviar a imprenta
					break;														
				default:
					$salida = '';
					break;
			}			
		}
		if($lista_mails = '')
			$lista_mails = 'gaston.quezada@gqtech.cl, jcasanova@gqtech.cl';

		$resp['comentario'] = $salida;
		$resp['correos'] = $lista_mails;
		return $resp;
	}

	function generarCodigo($longitud) 
	{
 		$key = '';
 		$pattern = '1234567890';
 		$max = strlen($pattern)-1;
 		for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
 		return $key;
	}

	public function enviaMails($tipo=null,$aux=null)
	{
		if($tipo == "contacto"){
			$idtipo = 37;
			$_POST = $aux;
		}	

		if($tipo == null){
			echo "ERROR";
			return false;
		}

		if(count($_POST) > 1)
		{			
			//$log = $this->M_inicio->guardaLog($_POST);
			if(isset($_POST['comment1']))
				$_POST['comment'] = $_POST['comment1'];
			
			$busca_tpl = $this->M_dashboard->getContentById($idtipo, 's_getcontentbyid');
			
			$cuerpo_mail = $busca_tpl['contenido'];
			$cuerpo_mail = "<html><head><title>Info Producto Protegido</title></head><body>" . $cuerpo_mail . "</body></html>";
			$cuerpo_mail = @str_replace("{NOMBRE}", $_POST['name'], $cuerpo_mail);
			$cuerpo_mail = @str_replace("{COMENTARIO}", $_POST['comment'], $cuerpo_mail);
			$cuerpo_mail = @str_replace("{EMAIL}", $_POST['email'], $cuerpo_mail);
			

			if($tipo == "tienda"){
				$cont = $this->M_dashboard->getContentById($_POST['id'], 's_getcontentbyid');
				$precioProducto = $cont['valor1'];
				$productos = '<ul><li>'. $_POST['tipo'] . ' $' . precio($precioProducto) . ', Cantidad: ' . $_POST['cantidad'] . ' </li></ul>';
				$cuerpo_mail = @str_replace("{PRODUCTOS}", $productos, $cuerpo_mail);
				$cuerpo_mail = @str_replace("{DIRECCION}", $_POST['direccion'], $cuerpo_mail);
				$cuerpo_mail = @str_replace("{TELEFONO}", $_POST['telefono'], $cuerpo_mail);
				$cuerpo_mail = @str_replace("{EMAIL}", $_POST['email'], $cuerpo_mail);
			}
			$to = $_POST['email']; // corre1, vorre2, corre2
			$headers = "MIME-Version: 1.0" . "\r\n";
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			$headers .= 'From: Contacto <contacto@productoprotegido.cl>' . "\r\n";
			$subject = "Informacion Producto Protegido";
			
			$resultado = mail($to,$subject,$cuerpo_mail,$headers);
			
			if($tipo == "tienda"){
				$cont = $this->M_dashboard->getContentById(39, 's_getcontentbyid');
			}elseif ($tipo == "contacto") {
				$cont = $this->M_dashboard->getContentById(40, 's_getcontentbyid');
			}
			$mails = $cont['contenido'];
			$titulo = str_replace("Mails para", "", $cont['nombre']);

			$mailinfo = mail($mails,$titulo,$cuerpo_mail,$headers);


			if($resultado)
				return "OK";
			else
				return "ERROR";
		}
	}

	public function gc(){
			$crud = new grocery_CRUD();
			//$crud->set_theme('datatables');
			$crud->set_table('gq_menu')
				 ->columns('id_menu','nombre_menu','link','id_padre','pos_menu','id_perfil','creada');
			$output = $crud->render();		
			$kk = $this->load->view('example.php',$output);
	}

	// Funciones de Autentificacion //
	function login()
	{
		$this->data['title'] = "Login";

		//validate form input
		$this->form_validation->set_rules('identity', 'Identity', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == true)
		{
			//check to see if the user is logging in
			//check for "remember me"
			$remember = (bool) $this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
			{
				//if the login is successful
				//redirect them back to the home page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				$this->session->set_userdata('idPerfil',$this->ion_auth->get_perfil($this->session->userdata('user_id'))); 
				redirect('/dashboard/ ', 'refresh');
			}
			else
			{
				//if the login was un-successful
				//redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('dashboard/login', 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}
		else
		{
			//the user is not logging in so display the login page
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['identity'] = array('name' => 'identity',
				'id' => 'identity',
				'type' => 'text',
				'value' => $this->form_validation->set_value('identity'),
			);
			$this->data['password'] = array('name' => 'password',
				'id' => 'password',
				'type' => 'password',
			);
			$out = $this->parser->parse('login',$this->data, TRUE);
			$this->output->set_output($out);
		}
	}

	function logout()
	{
		$this->data['title'] = "Logout";

		//log the user out
		$logout = $this->ion_auth->logout();

		//redirect them to the login page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect('dashboard/login', 'refresh');
	}

	private function subirArchivo($archivo)
	{
		$config['upload_path'] = './files/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
		$config['max_size']	= '10000';
		$config['max_width']  = '2048';
		$config['max_height']  = '1024';
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload($archivo))
			return false;
		else
			return true;
	}

	public function tablaFoliosProducto($array_data, $tipo){
		$row = "";
		if($tipo == 'gestionado'){
			foreach($array_data as $key => $valor){
				$row .= "<tr>";
				$row .= "<td>".$valor['folio']."</td>";
				$row .= "<td>".$valor['tipo_producto']."</td>";
				$row .= "<td>".$valor['descripcion']."</td>";
				$row .= "<td>".$valor['estado']."</td>";
				$row .= "<td>".$valor['rut']."</td>";
				$row .= "<td>".$valor['nombre'].' '.$valor['paterno']."</td>";
				$row .= "</tr>";
			}
		}
		else{
			foreach($array_data as $key => $valor){
				$row .= "<tr>";
				$row .= "<td>".$valor['folio']."</td>";
				$row .= "<td>".$valor['tipo_producto']."</td>";
				$row .= "<td>".$valor['descripcion']."</td>";
				$row .= "<td>".$valor['estado']."</td>";
				$row .= "<td>&nbsp;</td>";
				$row .= "<td>&nbsp;</td>";
				$row .= "</tr>";
			}
		}
	
		return $row;
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
