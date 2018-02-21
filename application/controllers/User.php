<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public $status; 
    public $roles;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model','user');
		$this->load->model('main_model', 'main_model', TRUE);

		$this->load->library('form_validation'); 
		$this->load->library('email');     
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

        $clean = $this->security->xss_clean($post);
        $userInfo = $this->main_model->getUserInfoByEmail($clean);
            
 		//build token 
        $token = $this->main_model->insertToken($userInfo->id);                    
        $qstring = base64_encode($token);                    
        $url = site_url() . 'main/reset_password/token/' . $qstring;
        $data_email['link'] = $url; 
        $data_email['email'] = $post; 

		//Se crea el link para mandarlo por mail
        $message = $this->load->view('email_template_active_account', $data_email, TRUE);
        $this->email->from("smcptraining@gmail.com", 'SMCP-Training');
        $this->email->subject("Your accoount has been activated.");
        $this->email->to("m.pinasalva@gmail.com"); 
        $this->email->message($message);

        if($this->email->send())
        {
            //Si se envia correctamente se redirecciona a la pagina de login con el siguiente mensaje
            echo json_encode(array("status" => TRUE));
        }
        else 
        {
            echo json_encode(array("status" => FALSE));
            //echo "error: ".$this->email->print_debugger(array('headers'));
        }       
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


	public function email_unique($email)
    {
        
        if($this->user->isDuplicate($this->input->post('email')))
		{
        	$this->form_validation->set_message('email_unique', 'Email already exists. Choose another one please.');
        	return FALSE;
        }
        else
        {
             return TRUE;
        }
    }


	/**
     * Registro de un nuevo usuario
     *
     * El usuario rellena el formulario, si los campos son correctos crea el nuevo usuario con el estado "pending",
     * y manda un email al administrador para que este apruebe el estado y asi el nuevo usuario pueda acceder a su cuenta.
     *
     * @return 
    */ 
	public function newUser()
    {
        if(isset($_POST['record']) and $_POST['record'] == 'yes')
        {
            //Si existe el campo oculto llamado grabar creamos las validaciones
            $this->form_validation->set_rules('first_name','First Name','required|trim|xss_clean');
            $this->form_validation->set_rules('last_name','Last Name','required|trim|xss_clean');
            $this->form_validation->set_rules('email','Email','callback_email_unique|required|valid_email|trim|xss_clean');
            $this->form_validation->set_rules('password','Password','min_length[4]|required|trim|xss_clean');

            //Si hay alguna regla de las anteriores que no se cumple mostramos el mensaje
            //El %s sustituye los nombres que le hemos dado anteriormente, ejemplo,
            //si el nombre esta vacio, nos diria el nombre es requerido y el %s sera sustituido por el nombre del campo
          
            //Si algo no ha ido bien nos devolvera al register_form mostrando los errores
            if($this->form_validation->run() == FALSE) 
            {
                $data['titulo'] = "SMCP Training Register";  
                $this->load->view('header', $data);  
                $this->load->view('navbar_uca');          
                $this->load->view('register_form');

            }else
            {  
            	//Se almacenan los datos introducidos en el formulario
            	$data_email['first_name'] = $this->input->post('first_name');
				$data_email['last_name'] = $this->input->post('last_name');
				$data_email['email'] = $this->input->post('email');
				$data_email['password'] = $this->input->post('password');

            	//Se crea el usuario con el estado pending
				$data = array(
						'first_name' => $data_email['first_name'],
						'last_name' => $data_email['last_name'],
						'email' => $data_email['email'],
						'password' => md5($data_email['password']),
						'role' => "2",
						'status' => "pending",
					);
				$insert = $this->user->save($data);

				$id_user = $this->user->get_id_by_email($data_email['email']);
				//Se crea el link para mandarlo por mail
                $data_email['link'] = site_url().'/user/approveNewUser/'.$id_user->id;
                $message = $this->load->view('email_template_new_user', $data_email, TRUE);
                $this->email->from("smcptraining@gmail.com", 'SMCP-Training');
                $this->email->subject("A new user has created an account");
                $this->email->to("m.pinasalva@gmail.com"); 
                $this->email->message($message);

                if($this->email->send())
	            {
	                //Si se envia correctamente se redirecciona a la pagina de login con el siguiente mensaje
	                $this->session->set_flashdata('correct', 'The info has been sent to the admin. You will receive an email when your account is activated.');
	                redirect(site_url().'/main/login'); 
	            }
	            else 
	            {
	                //Si no, se redirecciona a la pagina de login con el siguiente mensaje
	                $this->session->set_flashdata('flash_message', 'There was a problem, try it later.');
	                redirect(site_url().'/main/login');

	                //echo "error: ".$this->email->print_debugger(array('headers'));
	            }       
            }
        }
    }


	/**
     * Aprueba el estado de un nuevo alumno
     *
     * El administrador recibe un email y al pulsar aprueba el estado del nuevo alumno.
     *
     * @param string $id id del usuario
    */ 
	public function approveNewUser($id)
	{
		$data = array(
				'status' => "approved",
			);
		$this->user->update(array('id' => $id), $data);

		$data_email['email'] = $this->user->get_email_by_id($id);
		$data_email['link'] = site_url();

		//Se crea el link para mandarlo por mail
        $message = $this->load->view('email_template_active_account', $data_email, TRUE);
        $this->email->from("smcptraining@gmail.com", 'SMCP-Training');
        $this->email->subject("Your account has been activated");
        $this->email->to("m.pinasalva@gmail.com"); 
        $this->email->message($message);   

         if($this->email->send())
	            {
	                //Si se envia correctamente se redirecciona a la pagina de login con el siguiente mensaje
	                $this->session->set_flashdata('correct', 'correct.');
	                redirect(site_url().'/main/login'); 
	            }
	            else 
	            {
	                //Si no, se redirecciona a la pagina de login con el siguiente mensaje
	                $this->session->set_flashdata('flash_message', 'There was a problem, try it later.');
	                redirect(site_url().'/main/login');

	                //echo "error: ".$this->email->print_debugger(array('headers'));
	            }    

		$this->session->set_flashdata('correct', 'The user was approved correctly.');
	    redirect(site_url().'/main/login');
	}

}
