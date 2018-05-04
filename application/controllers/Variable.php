<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Variable extends CI_Controller {

	public $status; 
    public $roles;

	public function __construct()
	{
		parent::__construct();

        $this->load->library('form_validation');   
		$this->load->model('variable_model','variable');
		$this->status = $this->config->item('status'); 
        $this->roles = $this->config->item('roles');
	}

	/**
     * Metodo index que muestra el menu de administracion de variables
     * 
    */  
	public function index()
	{
		if(empty($this->session->userdata['email']))
		{
            redirect(site_url().'main/login/');
        }            

        $titulo['titulo'] = "Variables"; 
        /*front page*/
        
        $this->load->view('header', $titulo);
        $this->load->view('navbar');
        $this->load->view('variables_view');
	}

	
	/**
     * Metodo que muestra la tabla con los tipos de variables
     *
    */  
	public function ajax_list()
	{
		$list = $this->variable->get_datatables();
		
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $variable) 
		{
			$no++;
			$row = array();
			
			$row[] = $variable->variable;
			$result = $this->variable->get_variables($variable->id);
			$var = "";
			foreach ($result as $name) 
			{
				$var = $var.' "'.$name['name'].'" ';
			}

			$row[] =  $var;

			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="view_variables('."'".$variable->id."'".')"><i class="glyphicon glyphicon-eye-open"></i> View variables</a>';

			if($variable->restricted)
				$row[] =  "restricted";
			else
				$row[] =  "non-restricted";


			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_variable('."'".$variable->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_type_variable('."'".$variable->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->variable->count_all(),
						"recordsFiltered" => $this->variable->count_filtered(),
						"data" => $data,
					);

		//Devuelve un array en formato json
		echo json_encode($output);
	}

	/**
     * Metodo que muestra la tabla de ayuda en los examenes con los tipos de variables
     *
    */  
	public function ajax_list_help()
	{
		$list = $this->variable->get_datatables_help();
		
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $variable) 
		{
			$no++;
			$row = array();
			
			$row[] = $variable->variable;
			$result = $this->variable->get_variables($variable->id);
			$var = "";
			foreach ($result as $name) 
			{
				$var = $var.' '.$name['name'].', ';
			}

			$row[] =  $var;
				
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->variable->count_all("help"),
						"recordsFiltered" => $this->variable->count_filtered("help"),
						"data" => $data,
					);

		//Devuelve un array en formato json
		echo json_encode($output);
	}


	/**
     * Realiza el update de un tipo de variable
     *
     * @return boolean true si el add se ha realizado correctamente
     * @param string $idvariable id de la pregunta
    */  
	public function ajax_update_form() 
	{	
		$this->_validate_update();
		$data = array(
				'variable' => $this->input->post('type_variable_edit'),
			);

		$this->variable->update(array('id' => $this->input->post('id_edit')), $data);

		$datos['error'] = '';
		$id_typevariable = $this->input->post('id_edit');

		if (isset($_POST['nombre_edit']))
		{
			$nombre = $_POST['nombre_edit'];
				   
			$i = 0;

		    foreach($nombre as $n) 
		    {  
		       $name = $nombre[$i];
		       if($name != '')
		       {
	       			$data = array(
	       							'name' => $name,
	       							'id_type_variable' => $id_typevariable,
	       							);
	       			$this->variable->insert_variable($data);
		       }
		       $i++;
		    }
		}

		if($datos['error'] != '')
        {	
	        
			echo json_encode(array("status" => 'error', "error" =>$datos['error']));
		}else
		{
			echo json_encode(array("status" => TRUE));
		}

	}

	/**
     * Añade un nuevo tipo de variable con sus variables de ejemplo
     *
     * @return boolean true si el add se ha realizado correctamente
    */  
	public function ajax_add() 
	{
		$this->_validate();
		$data = array(
				'variable' => $this->input->post('type_variable'),	
			);
		
		$this->db->insert('type_variable', $data);

		$id_type_variable = $this->db->insert_id();
		
		$variable = array(
				'id_type_variable' => $id_type_variable,
				'name' => $this->input->post('variable'),	
			);
		$this->db->insert('variable', $variable);

		if (isset($_POST['nombre']))
		{
			$nombre = $_POST['nombre'];
				   
			$i = 0;

		    foreach($nombre as $n) 
		    {  
		       $name = $nombre[$i];
		       if($name != '')
		       {
	      	 		$data = array(
	       							'name' => $name,
	       							'id_type_variable' => $id_type_variable,
	       							);
	       			$this->variable->insert_variable($data);
		       }
		       $i++;
		    }		   
		}
		echo json_encode(array("status" => TRUE ));
	}

	/**
     * Elimina un tipo de variable con todas sus variables dado el id 
     *
     * @return boolean true si el delete se ha realizado correctamente
     * @param string $id id del tipo de variable
    */  
	public function ajax_delete_type_variable($id) 
	{
		$this->variable->delete_type_variable_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	/**
     * Elimina una variable ejemplo dado su id
     *
     * @return boolean true si el delete se ha realizado correctamente
     * @param string $id id de la variable
    */  
	public function ajax_delete_variables($id)
	{
		$this->variable->delete_variable_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	/**
     * Realiza el update de las variables
     *
     * @return boolean true si el update se ha realizado correctamente
    */  
	public function ajax_update_variables()  
	{
		if (isset($_POST['nombree']))
		{
			$nombre = $_POST['nombree'];
				   
			$i = 0;

		    foreach($nombre as $n) 
		    {  
		       $name = $nombre[$i];
		       $id_variable = $this->input->post('id_variable'.$i);
		     	
		       if($name != '')
		       {      
	       			$data = array(
	       							'name' => $name,
	       							);
	       			$this->variable->update_variable($id_variable, $data);		      	 
		       }
		       $i++;
		    }		   
		}
		echo json_encode(array("status" => TRUE));
	}

	/**
     * Recibe el id de un tipo de variable y devuelve todas sus variables
     *
     * @return array con los las variables 
     * @param string $id id del tipo de variable
    */  
	public function ajax_view_variables($id)   
	{
		$data = $this->variable->get_variables($id);
		$num = count($data);

		$name = $this->variable->get_type_variable_name($id);

		$variable = array( 'variable1' => $data, 
                       'variable2' => $num,
                       'variable3' => $id,
                       'variable4' =>  $name
                       );
		echo json_encode($variable);
	}

	/**
     * Recibe el id de un tipo de variable y devuelve sus datos
     *
     * @return array con los datos del tipo de variable
     * @param string $id con el id del tipo de variable
    */  
	public function ajax_edit($id)
	{
		$data = $this->variable->edit($id);
		echo json_encode($data);
	}

	/**
     * Valida los campos del input y devuelve los errores cuando se añade un campo en el formulario
     * de añadir una nueva variable
     *
     * @return array con los datos del error
    */ 
	private function _validate()  //-------------------------
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('type_variable') == '')
		{
			$data['inputerror'][] = 'type_variable';
			$data['error_string'][] = 'The type of variable is required';
			$data['status'] = FALSE;
		}

		
		if($this->input->post('variable') == '')
		{
			$data['inputerror'][] = 'variable';
			$data['error_string'][] = 'The variable is required';
			$data['status'] = FALSE;
		}


		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

	/**
     * Valida los campos del input y devuelve los errores cuando se edita un campo en el update
     *
     * @return array con los datos del error
    */ 
	private function _validate_update()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('type_variable_edit') == '')
		{
			$data['inputerror'][] = 'type_variable_edit';
			$data['error_string'][] = 'The type of variable is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}
