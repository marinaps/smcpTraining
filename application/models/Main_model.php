<?php
class Main_model extends CI_Model {

    public $status; 
    public $roles;
    
    function __construct(){
        // Call the Model constructor
        parent::__construct();        
        $this->status = $this->config->item('status');
        $this->roles = $this->config->item('roles');
    }       


    /**
     * Devuelve los datos de un usuario dado su email
     *
     * @return object con los datos del usuario
     * @param string $email email del usuario 
    */ 
    public function getUserInfoByEmail($email)
    {
        $q = $this->db->get_where('users', array('email' => $email), 1);  

        if($this->db->affected_rows() > 0)
        {
            $row = $q->row();
            return $row;
        }else
        {
            error_log('no user found getUserInfo('.$email.')');
            return false;
        }
    }
    
    /**
     * Actualiza los datos del usuario
     *
     * @return object con los datos actualizados del usuario
     * @param array $post con los datos del usuario
    */ 
    public function updateUserInfo($post)
    {
        $data = array(
               'first_name' => $post['name'],
               'last_name' => $post['surname'],
               'last_login' => date('Y-m-d h:i:s A'), 
               'status' => $this->status[1]
            );
        $this->db->where('id', $post['id']);
        $this->db->update('users', $data); 
        $success = $this->db->affected_rows(); 
        
        if(!$success)
        {
            error_log('Unable to updateUserInfo('.$post['id'].')');
            return false;
        }
        
        $user_info = $this->getUserInfo($post['id']); 
        return $user_info; 
    }

    /**
     * Comprueba los datos de inicio de sesion de un usuario
     *
     * @return true si los datos coinciden con alguno de los almacenados en la BD
     * @param array $post con el mail y la contraseña introducidas por el usuario
    */ 
    public function checkLogin($post)
    {
            
        $this->db->select('*');
        $this->db->where('email', $post['email']);
        $query = $this->db->get('users'); 

        if ($query->num_rows() > 0)
            $userInfo = $query->row();  
        else 
            return false;
        
        if(md5($post['password']) != $userInfo->password OR $userInfo->status !='approved')
        {
            error_log('Unsuccessful login attempt('.$post['email'].')');
            return false; 
        }
        
        $this->updateLoginTime($userInfo->id);
        
        unset($userInfo->password);
        return $userInfo; 
    }

    /**
     * Actualiza la hora de login de un usuario dado su id
     *
     * @param string $id id del usuario
    */ 
    public function updateLoginTime($id)
    {
        $this->db->where('id', $id);
        $this->db->update('users', array('last_login' => date('Y-m-d h:i:s A')));
    }

    /**
     * Actualiza la contraseña de un usuario
     *
     * @return true si se ha actualizado con exito
     * @param array $post con los datos del usuario y la nueva contraseña
    */ 
    public function updatePassword($post)
    {   
        $this->db->where('id', $post['user_id']);
        $this->db->update('users', array('password' => md5($post['password']))); 
        
        $success = $this->db->affected_rows(); 
        
        if(!$success)
        {
            error_log('Unable to updatePassword('.$post['user_id'].')');
            return false;
        }        
        return true;
    } 

    /**
     * Crea e inserta un nuevo token para la url en la BD 
     *
     * @return string con el token creado
     * @param string $user_id id del usuario
    */  
    public function insertToken($user_id)
    {   
        $token = substr(sha1(rand()), 0, 30); 
        $date = date('Y-m-d');
        
        $string = array(
                'token'=> $token,
                'user_id'=>$user_id,
                'created'=>$date
            );
        $query = $this->db->insert_string('tokens',$string);
        $this->db->query($query);

        return $token;
        
    }

    /**
     * Elimina un token de la BD
     *
     * @param string $token token que se quiere eliminar
    */  
    public function deleteToken($token)
    {   
        $this->db->from('tokens');
        $this->db->where('token', $token);
        $this->db->delete('tokens');
    }

    /**
     * Elimina el token antiguo del usuario indicado
     *
     * Cuando se crea un nuevo token de un usuario se borra(si lo hay) el token antiguo
     *
     * @param string $user_id id del usuario del que se quiere borrar el token
    */  
    public function deleteOldToken($user_id)
    {   
        $this->db->from('tokens');
        $this->db->where('user_id', $user_id);
        $this->db->delete('tokens');
    }

    /**
     * Comprueba si un token esta en la BD o no
     *
     * @return boolean true si el token coincide con alguno de la BD
     * @param string $token token que se quiere comprobar
    */ 
    public function isTokenValid($token)
    {
        $q = $this->db->get_where('tokens', array('token' => $token), 1); 

        if($this->db->affected_rows() > 0)
        {
            $row = $q->row();             
            
            $created = $row->created;
            $createdTS = strtotime($created);
            $today = date('Y-m-d'); 
            $todayTS = strtotime($today);
            
            if($createdTS != $todayTS)
            {
                return false;
            }
            
            $user_info = $this->getUserInfo($row->user_id);

            return $user_info;
            
        }else
            return false; 
    }  
    
}
