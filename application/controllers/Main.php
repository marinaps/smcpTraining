<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
        
    public $status; 
    public $roles;

    function __construct(){
        parent::__construct();
        $this->load->model('main_model', 'main_model', TRUE);
        $this->load->library('form_validation');  
        $this->load->library('email');     
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->status = $this->config->item('status'); 
        $this->roles = $this->config->item('roles');
    }      
    
    /**
     * Metodo index que muestra el menu de inicio
     *
     * Segun el tipo de usuario muestra el menu del profesor o del alumno
    */  
	public function index()
	{   
        if(empty($this->session->userdata['email']))
        {
            redirect(site_url().'main/login/');
        }
        $data['titulo'] = "SMCP Training Home"; 
        //Si es un administrador entonces le muestra la vista del profesor
        if($this->session->userdata['role'] == "1")
        {
                       
            /*front page*/ 
            $this->load->view('header', $data);  
            $this->load->view('navbar');          
            $this->load->view('teacher_menu');
        }
        else //Si no muestra la vista del alumno
        {
            /*front page*/ 
            $this->load->view('header', $data);  
            $this->load->view('navbar');          
            $this->load->view('student_menu');
        }  
    }
    
    /**
     * Metodo de login
     *
     * Muestra la página de inicio con el formulario del login
    */    
    public function login()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');    
        $this->form_validation->set_rules('password', 'Password', 'required'); 
        
        if($this->form_validation->run() == FALSE) 
        {
            $data['titulo'] = "SMCP Training Login";  
            $this->load->view('header', $data);
            $this->load->view('navbar_uca');
            $this->load->view('login');
            
        }else
        {
            $post = $this->input->post();  
            //$clean = $this->security->xss_clean($post);
            
            $userInfo = $this->main_model->checkLogin($post);
            
            if(!$userInfo)
            {
                $this->session->set_flashdata('flash_message', 'The login was unsucessful');
                redirect(site_url().'main/login');
            }     

            foreach($userInfo as $key=>$val)
            {
                $this->session->set_userdata($key, $val);
            }
            redirect(site_url().'main/');
        }  
    }

    /**
     * Metodo de registro (pagina de login)
     *
     * Muestra el formulario de registro de un nuevo usuarios
     *
    */   
    public function register()
    {
        $data['titulo'] = "SMCP Training Register";  
        $this->load->view('header', $data);  
        $this->load->view('navbar_uca');          
        $this->load->view('register_form');
    }

    /**
     * Metodo de logout
     *
     * Destruye la sesion y redirige a la pagina de login
     *
    */    
    public function logout()
    {
        $this->session->sess_destroy();
        redirect(site_url().'main/login/');
    }

    /**
     * Metodo para recuperar la contraseña si se ha olvidado (Página de login)
     *
     * Comprueba si el email dado corresponde a algun usuario, en tal caso
     * crea una url y la manda por mail para que el usuario pueda recuperar la contraseña.
     *
    */
    public function forgot()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email'); 
        
        if($this->form_validation->run() == FALSE) 
        {
            $data['titulo'] = "Forgot password";  

            $this->load->view('header', $data);
            $this->load->view('navbar_uca');
            $this->load->view('forgot_password');

        }else
        {
            $email = $this->input->post('email');  
            $clean = $this->security->xss_clean($email);
            $userInfo = $this->main_model->getUserInfoByEmail($clean);
            
            if(!$userInfo)
            {
                //Si el email no esta en la bd
                $this->session->set_flashdata('flash_message', 'We cant find your email address');
                redirect(site_url().'main/forgot');
            }   
            
            if($userInfo->status != $this->status[1])
            { 
                //Si el estado del usuario no esta aprobado por el admin
                $this->session->set_flashdata('flash_message', 'Your account is not in approved status');
                redirect(site_url().'main/forgot');
            }
            
            $this->main_model->deleteOldToken($userInfo->id);

            //build token 
            $token = $this->main_model->insertToken($userInfo->id);                    
            $qstring = base64_encode($token);                    
            $url = site_url() . 'main/reset_password/token/' . $qstring;
            $data['link'] = $url; 

            //Para cargar la vista que se va a enviar por correo
            $message = $this->load->view('email_template_forgot_password',$data, TRUE);

            //Configuracion del email
            $this->email->from("smcptraining@gmail.com", 'SMCP-Training');
            $this->email->subject("You have requested to change your password");
            $this->email->to("m.pinasalva@gmail.com"); 
            $this->email->message($message);

            if($this->email->send())
            {
                //Si se envia correctamente se redirecciona a la pagina de login con el siguiente mensaje
                $this->session->set_flashdata('correct', 'The instructions have been sent to your email address. Do not forget to check your SPAM folder.');
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
        

    /**
     * Metodo que dado una url permite resetear la contraseña (Página de login)
     *
     * Comprueba si la url concuerda con alguna de la base datos, en tal caso
     * recupera los datos del usuario y le solicita una nueva contraseña
     *
    */  
    public function reset_password()
    {
        $token = base64_decode($this->uri->segment(4));       
        $cleanToken = $this->security->xss_clean($token);
        
        $user_info = $this->main_model->isTokenValid($cleanToken); //either false or array();               
        
        if(!$user_info)
        {
            $this->session->set_flashdata('flash_message', 'Reset password link expired, please click reset password again to receive new reset link.');
            redirect(site_url().'main/login');
        }   

        $data = array(
            'firstName'=> $user_info->first_name, 
            'email'=>$user_info->email, 
            'user_id'=>$user_info->id, 
            'token'=>base64_encode($token)
        );
       
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');              
        
        if ($this->form_validation->run() == FALSE) 
        {   
            $title['titulo'] = "Reset password";  

            $this->load->view('header', $title);
            $this->load->view('reset_password', $data);
            
        }else
        {
            $deletetoken = base64_decode($data['token']);
            $this->main_model->deleteToken($deletetoken);

            $post = $this->input->post(NULL, TRUE);                
            $cleanPost = $this->security->xss_clean($post);                
            $hashed = $cleanPost['password'];                
            $cleanPost['password'] = $hashed;
            unset($cleanPost['passconf']); 

            if(!$this->main_model->updatePassword($cleanPost))
            {
                $this->session->set_flashdata('flash_message', 'There was a problem updating your password');
                redirect(site_url().'/main/reset_password');  

            }else
            {
                $this->session->set_flashdata('correct', 'Your password has been updated. You may now login');
                redirect(site_url().'main/login');   
            }                
        }
    }       


    /**
     * Metodo que muestra el perfil con los datos del usuario
     *
    */  
    public function profile()
    {
        if(empty($this->session->userdata['email']))
        {
            redirect(site_url().'main/login/');
        }         

        $data = $this->session->userdata; 
        $title['titulo'] = "Profile";  

        $User_ = $this->main_model->getUserInfoByEmail($data["email"]);
        $this->load->view('header', $title);
        $this->load->view('navbar');
        $this->load->view('profile', array('usuario'=>$User_));

    }

    /**
     * Metodo que actualiza los datos de un usuario
     *
     * Al pulsar sobre update, se actualizan los datos del usuario
     * por los nuevos que se han introducido en el formulario. 
     *
    */  
    public function update_user_profile()
    {
        if(empty($this->session->userdata['email']))
        {
            redirect(site_url().'main/login/');
        }     
            
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');         
        $array = $this->input->post();
                
        if($this->form_validation->run() != false)
        {
            $userInfo = $this->main_model->updateUserInfo($array);             
                     
            if(!$userInfo)
            {
                $this->session->set_flashdata('flash_message', 'There was a problem updating your record');
                redirect(site_url().'/main/profile');

            }else
            {
       
                $this->session->set_flashdata('correct', 'Your profile has been updated');
                redirect(site_url().'/main/profile');
            }
        }
    }

    /**
     * Metodo que muestra un formulario para modificar la contraseña una vez
     * iniciada una sesion. 
     *
    */  
    public function change_password_form()
    {
        if(empty($this->session->userdata['email']))
        {
            redirect(site_url().'main/login/');
        }

        $email = $this->session->userdata['email'];
        $clean = $this->security->xss_clean($email);
        $user_info = $this->main_model->getUserInfoByEmail($clean);
        

        $data = array(
            'firstName'=> $user_info->first_name, 
            'email'=>$user_info->email, 
            'user_id'=>$user_info->id, 
        );

        $title['titulo'] = "Change password";  

        $this->load->view('header', $title);
        $this->load->view('navbar');
        $this->load->view('change_password', $data);
    }

    /**
     * Metodo que modifica la contraseña una vez iniciada una sesion
     *
    */ 
    public function change_password()
    {
        if(empty($this->session->userdata['email']))
        {
            redirect(site_url().'main/login/');
        }

        $email = $this->session->userdata['email'];
        $clean = $this->security->xss_clean($email);
        $user_info = $this->main_model->getUserInfoByEmail($clean);
        

        $data = array(
            'firstName'=> $user_info->first_name, 
            'email'=>$user_info->email, 
            'user_id'=>$user_info->id, 
        );

        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');          
        
        if($this->form_validation->run() == FALSE) 
        {   
            $title['titulo'] = "Modify password";  
            $this->load->view('header', $title);
            $this->load->view('navbar');
            $this->load->view('change_password', $data);
          
        }else
        {                 
            $post = $this->input->post(NULL, TRUE);                
            $cleanPost = $this->security->xss_clean($post);                
            $hashed =$cleanPost['password'];                
            $cleanPost['password'] = $hashed;
            unset($cleanPost['passconf']);  

            if(!$this->main_model->updatePassword($cleanPost))
            {
                $this->session->set_flashdata('flash_message', "<div style='color:red;'>There was a problem updating your password.</div>");
                redirect(site_url().'main/change_password_form', 'refresh');  

            }else
            {
                $this->session->set_flashdata('flash_message', "<div style='color:green;'>Your password has been updated. You may now login</div>");
                redirect(site_url().'main/login', 'refresh');   
            }
        }
    }
}