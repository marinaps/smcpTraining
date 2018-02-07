<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public $status; 
    public $roles;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model','user');
		$this->status = $this->config->item('status'); 
        $this->roles = $this->config->item('roles');
	}


	/**
     * Metodo index que muestra la vista de los usuarios
     * 
    */ 
	public function index()
	{
		if(empty($this->session->userdata['email']))
		{
             redirect(site_url().'main/login/');
        }

        $data['titulo'] = "Users"; 

		$this->load->view('header', $data);
		$this->load->view('navbar');
		$this->load->view('user_view');
	}


	/**
     * Recibe el id de un usuario y devuelve los datos de su grafica
     * devuelve un array cuyo primer campo es la fecha de un examen convertida a unix
     * y cuyo segundo parametro es la nota de ese examen sobre 100%
     *
     * @return string con los datos de la fecha y la nota
     * @param string $id con el id del usuario
    */  
	public function ajax_graph($id)
	{
		$all_data = $this->user->get_graph_data($id);
		$group_by_data = $this->user->prueba($id);
		//$buscar = array_search('2017-07-08', $datafinal);
		//$matriz_fl = preg_grep("/2017-07-03/", $data[0]);

		$result = array();

		for ($i = 0; $i < sizeof($group_by_data); $i++)
		{
			if($group_by_data[$i]['total'] == 1)
			{
				//array_push($result, $group_by_data[$i]);
				foreach ($all_data as $key => $val) 
				{
			       if ($val['id'] == $group_by_data[$i]['id']) 
			       {
			       		array_push($result, $all_data[$key]);
			    	}
			    }
			}	
			else
			{
				/*foreach ($array as $key => $val) 
				{
			       if ($val['uid'] === $id) 
			       {
			           return $key;
			    	}
				}*/
			}	
	}
	for ($i = 0; $i < sizeof($result); $i++)
			{
			//Con esto hacemos que se almacene solo el dato, y no el objeto que develve sql
			$date[$i] = $result[$i]['date'];

			$grade = ($result[$i]['right']/$result[$i]['num_questions'])*100;
			//Con esto convertimos la fecha(dada en datetime por sql) a unix
			$timestamp = strtotime($date[$i]) * 1000;
			//En este array almacenamos la fecha y la nota en el siguiente formato:
			// [fecha, nota] para que pueda ser luego representado en la grafica
			$final[] = [$timestamp, $grade]; 
			}	
		//$final_data = $this->user->prueba($data);
		/*
		//Preparamos el array con los datos en un cierto formato: [fecha, nota]
		for ($i = 0; $i < sizeof($data); $i++)
		{
			//Con esto hacemos que se almacene solo el dato, y no el objeto que develve sql
			$date[$i] = $data[$i]['date'];

			$grade = ($data[$i]['right']/$data[$i]['num_questions'])*100;
			//Con esto convertimos la fecha(dada en datetime por sql) a unix
			$timestamp = strtotime($date[$i]) * 1000;
			//En este array almacenamos la fecha y la nota en el siguiente formato:
			// [fecha, nota] para que pueda ser luego representado en la grafica
			$result[] = [$timestamp, $grade]; 
		}*/

		echo json_encode($final);
	}

	
	/**
     * Metodo que muestra la tabla con los usuarios
     *
    */ 
	public function ajax_list()
	{
		$list = $this->user->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $user) 
		{
			$no++;
			$row = array();
			$row[] = $user->first_name;
			$row[] = $user->last_name;
			$row[] = $user->email;
			$row[] = $this->user->get_role($user->role)->role;
			$row[] = $user->status;

			if($this->session->userdata['id'] != $user->id)
			{
			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_user('."'".$user->id."'".')"><i class="glyphicon glyphicon-pencil"></i> </a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="delete" onclick="delete_user('."'".$user->id."'".')"><i class="glyphicon glyphicon-trash"></i> </a>';

				  //<a class="btn btn-sm btn-success" href="javascript:void(0)" title="graph" onclick="graph('."'".$user->id."'".')"> Graph</a>';
			}
			else
			{
				$row[] ='';
			}
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->user->count_all(),
						"recordsFiltered" => $this->user->count_filtered(),
						"data" => $data,
						);
		//output to json format
		echo json_encode($output);
	}


	/**
     * Recibe el id de un usuario y devuelve sus datos
     *
     * @return array con los datos del usuario
     * @param string $id con el id del usuario
    */  
	public function ajax_edit($id)
	{
		$data = $this->user->get_by_id($id);
		echo json_encode($data);
	}


	/**
     * Añade un nuevo usuario
     *
     * @return boolean true si el add se ha realizado correctamente
    */ 
	public function ajax_add()
	{
        $post = $this->input->post('email');             
                  
		$this->_validate(false);

		$data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'email' => $this->input->post('email'),
				'password' => md5($post),
				'role' => $this->input->post('role'),
				'status' =>$this->input->post('status'),
			);
		$insert = $this->user->save($data);
		echo json_encode(array("status" => TRUE));
	}


	/**
     * Realiza el update de una pregunta
     *
     * @return boolean true si el update se ha realizado correctamente
    */  
	public function ajax_update()
	{
		$this->_validate(true);
		$data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'email' => $this->input->post('email'),
				'role' => $this->input->post('role'),
				'status' => $this->input->post('status'),
			);
		$this->user->update(array('id' => $this->input->post('id')), $data);

		echo json_encode(array("status" => TRUE));
	}


	/**
     * Elimina un usuario dado el id
     *
     * @return boolean true si el delete se ha realizado correctamente
     * @param string $id id del usuario
    */ 
	public function ajax_delete($id)
	{
		if($this->user->get_user_info($id))
		{
			$this->user->delete_by_id($id);
			echo json_encode(array("status" => TRUE));

		}else
		{
			echo json_encode(array("status" => FALSE));
		}

		
	}


	/**
     * Valida los campos del input y devuelve los errores
     *
     * @return array con los datos del error
    */ 
	private function _validate($update)
	{
		$this->load->helper('email');

		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('first_name') == '')
		{
			$data['inputerror'][] = 'first_name';
			$data['error_string'][] = 'First name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('last_name') == '')
		{
			$data['inputerror'][] = 'last_name';
			$data['error_string'][] = 'Last name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('email') == '' || !valid_email($this->input->post('email') ))
		{
			if($this->input->post('email') == '')
			{
				$data['inputerror'][] = 'email';
				$data['error_string'][] = 'Email is required';
				$data['status'] = FALSE;
			}else
			{
				$data['inputerror'][] = 'email';
				$data['error_string'][] = 'Email must be valid';
				$data['status'] = FALSE;
			}
		}else
		{
			if(! $update) //Si es un update no hace esta comprobacion 
			{
				if($this->user->isDuplicate($this->input->post('email')))
				{
					$data['inputerror'][] = 'email';
					$data['error_string'][] = 'Email already exists. Choose another one please.';
					$data['status'] = FALSE;
				}
			}

		}
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}
