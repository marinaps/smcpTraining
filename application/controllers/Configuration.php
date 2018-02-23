<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configuration extends CI_Controller {

	public $status; 
    public $roles;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('configuration_model','configuration');
        $this->load->library('form_validation');    
        $this->load->helper('form');  
        $this->load->helper('category_helper');
		$this->status = $this->config->item('status'); 
        $this->roles = $this->config->item('roles');   
	}

    /**
     * Metodo index que muestra la vista de las categorias
     * 
    */   
	public function index()
	{
		if(empty($this->session->userdata['email']))
        {
            redirect(site_url().'/main/login/');
        }            

        $titulo['titulo'] = "Configuration"; 
        $datos['arrcategories'] = $this->configuration->get_categories();
        
        $this->load->view('header', $titulo);
        $this->load->view('navbar');
        // cargamos la interfaz y le enviamos los datos
        $this->load->view('configuration_view', $datos);
	}


    
}
