<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');   
        $this->load->model('upload_model','uploadd');
    }


    /**
     * Muestra la vista de la subida de un csv para las preguntas desordenadas
     * 
    */ 
    public function upload_disordered()
    {
        if(empty($this->session->userdata['email']))
        {
            redirect(site_url().'main/login/');
        } 

        $this->form_validation->set_rules('category_id', 'Category', 'required');

        if(empty($_FILES) || $_FILES['userfile']['error'] == 4)
        {
        $this->form_validation->set_rules('userfile','File','required');
        }  

        if($this->form_validation->run() == FALSE) 
        {
            $titulo['titulo'] = "Upload questions"; 
            $datos['arrcategories'] = $this->uploadd->get_categories();
            $datos['error'] = "";
            
            $this->load->view('header', $titulo);
            $this->load->view('navbar');
            // cargamos  la interfaz y le enviamos los datos
            $this->load->view('upload_disordered_questions',  $datos);     
        }else
        {         
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'csv';
            $config['max_size'] = '100';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';
            $titulo['titulo'] = "Upload questions"; 
            //$category_id = $this->input->post('category_id');

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('userfile'))
            {   
                
                $this->load->view('header', $titulo);
                $this->load->view('navbar');

                $datos['arrcategories'] = $this->uploadd->get_categories();
                $datos['error'] = $this->upload->display_errors();

                $this->load->view('upload_disordered_questions',  $datos);
                
            }
            else
            {

                $questions = $this->uploadd->uploadDisordered($this->input->post('category_id'));
                if($questions > 0)
                    $this->uploadd->addquestions($this->input->post('category_id'), $questions);
                $this->session->set_flashdata('msg', 'The file has been correctly uploaded');
                redirect(site_url().'upload/upload_disordered');
            }
        }
    }


    /**
     * Muestra la vista de la subida de un csv para las preguntas de v/f
     * 
    */ 
    public function upload_truefalse()
    {
        if(empty($this->session->userdata['email']))
        {
            redirect(site_url().'/main/login/');
        } 

        $this->form_validation->set_rules('category_id', 'Category', 'required');

        if(empty($_FILES) || $_FILES['userfile']['error'] == 4)
        {
            $this->form_validation->set_rules('userfile','File','required');
        }  

        if($this->form_validation->run() == FALSE) 
        {
            $titulo['titulo'] = "Upload questions"; 
            $datos['arrcategories'] = $this->uploadd->get_categories();
            $datos['error'] = "";
            
            $this->load->view('header', $titulo);
            $this->load->view('navbar');
            // cargamos  la interfaz y le enviamos los datos
            $this->load->view('upload_truefalse_questions',  $datos);
                
        }else
        {         
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'csv';
            $config['max_size'] = '100';
            $config['max_width']  = '1024';
            $config['max_height']  = '768';
            $titulo['titulo'] = "Upload questions"; 
            //$category_id = $this->input->post('category_id');

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('userfile'))
            {    
                $this->load->view('header', $titulo);
                $this->load->view('navbar');

                $datos['arrcategories'] = $this->uploadd->get_categories();
                $datos['error'] = $this->upload->display_errors();

                $this->load->view('upload_truefalse_questions',  $datos);
            }else
            {

                $this->uploadd->uploadTruefalse($this->input->post('category_id'));
                $this->session->set_flashdata('msg', 'The file has been correctly uploaded');
                redirect(site_url().'upload/upload_truefalse');
            }
        }    
    }
}




