<?php
class Chat_model extends CI_Model {

    public $status; 
    public $roles;
    
    function __construct(){
        //Call the Model constructor
        parent::__construct();        
        $this->status = $this->config->item('status');
        $this->roles = $this->config->item('roles');
    }    
    

    /**
     * Devuelve un array con todas las categorias almacenadas en la BD
     *
     * @return array con las categorias
    */ 
    public function get_categories()
    {

        $query = $this->db->get('category');
        return $query->result_array();
    }


    /**
     * Devuelve 5 preguntas desordenadas para el training mode dada una categoria
     *
     * @return array of objects con las preguntas 
     * @param string $idcategory id de la categoria de las preguntas
    */ 
    public function get_disordered_questions_by_category($idcategories)
    {
        $this->db->select('*');
        $this->db->from('disordered_statement');
        //$this->db->where('id_category', $idcategories);
        $this->db->where_in('id_category', $idcategories);
        $this->db->order_by('rand()');
        $this->db->limit(5);
        $query = $this->db->get();
        $questions = $query->result(); 
        
        return $questions;
    }

    /**
     * Devuelve 5 preguntas true/false para el training mode dada una categoria
     *
     * @return array of objects con las preguntas 
     * @param string $idcategory id de la categoria de las preguntas
    */ 
    public function get_tf_questions_by_category($idcategory)
    {
        $this->db->select('*');
        $this->db->from('true_false_statement');
        $this->db->where_in('id_category', $idcategory);
        $this->db->order_by('rand()');
        $this->db->limit(5);
        $query = $this->db->get();
        $questions = $query->result(); 
        
        return $questions;
    }

    /**
     * Devuelve 5 preguntas de tipo question para el training mode dada una categoria
     *
     * @return array of objects con las preguntas 
     * @param string $idcategory id de la categoria de las preguntas
    */ 
    public function get_audio_write_questions_by_category($idcategory)
    {
        $this->db->select('*');
        $this->db->from('question');
        $this->db->where_in('id_category', $idcategory);
        $this->db->where('audio IS NOT NULL');
        $this->db->order_by('rand()');
        $this->db->limit(5);
        $query = $this->db->get();
        $questions = $query->result(); 
        
        return $questions;
    }

    /**
     * Devuelve 5 preguntas de tipo question para el training mode dada una categoria
     *
     * @return array of objects con las preguntas 
     * @param string $idcategory id de la categoria de las preguntas
    */ 
    public function get_question_by_category($idcategory)
    {
        $this->db->select('*');
        $this->db->from('question');
        $this->db->where_in('id_category', $idcategory);
        $this->db->order_by('rand()');
        $this->db->limit(5);
        $query = $this->db->get();
        $questions = $query->result(); 
        
        return $questions;
    }


    /** FINAL TEST
     * Devuelve 5 preguntas desordenadas para el final test mode
     *
     * @return array of objects con las preguntas 
    */ 
    public function get_disordered_questions($num_questions=3, $ids=NULL)
    {
        if($ids != NULL)
        {
            $this->db->select('*');
            $this->db->from('disordered_statement');
            $this->db->where_in('id_category', $ids);
            $this->db->order_by('rand()');
            $this->db->limit($num_questions);
            $query = $this->db->get();
            $questions = $query->result(); 
        }else
        {
            $this->db->select('*');
            $this->db->from('disordered_statement');
            $this->db->order_by('rand()');
            $this->db->limit($num_questions);
            $query = $this->db->get();
            $questions = $query->result(); 
        }
        
        return $questions;
    }

    /** FINAL TEST
     * Devuelve 5 preguntas desordenadas para el final test mode
     *
     * @return array of objects con las preguntas 
    */ 
    public function get_disordered_questions_by_ids($ids)
    {
        if($ids !=null)
        {
            $this->db->select('*');
            $this->db->from('disordered_statement');
            $this->db->where_in('id', $ids);
            $this->db->order_by('rand()');
            $query = $this->db->get();
            $questions = $query->result(); 
            
            return $questions;
        }
    }


   

    /** FINAL TEST
     * Devuelve 5 preguntas true/false para el final test mode
     *
     * @return array of objects con las preguntas 
    */ 
    public function get_tf_questions($num_questions=3, $ids=NULL)
    {
        if($ids != NULL)
        {
            $this->db->select('*');
            $this->db->from('true_false_statement');
            $this->db->where_in('id_category', $ids);
            $this->db->order_by('rand()');
            $this->db->limit($num_questions);
            $query = $this->db->get();
            $questions = $query->result(); 
        }else
        {
            $this->db->select('*');
            $this->db->from('true_false_statement');
            $this->db->order_by('rand()');
            $this->db->limit($num_questions);
            $query = $this->db->get();
            $questions = $query->result(); 
        }
        
        return $questions;
    }

    /** FINAL TEST
     * Devuelve 5 preguntas true/false para el final test mode
     *
     * @return array of objects con las preguntas 
    */ 
    public function get_tf_questions_by_ids($ids)
    {
        if($ids !=null)
        {
            $this->db->select('*');
            $this->db->from('true_false_statement');
            $this->db->where_in('id', $ids);
            $this->db->order_by('rand()');
            $query = $this->db->get();
            $questions = $query->result(); 
        
        return $questions;
        }
    }


    /** FINAL TEST
     * Devuelve 5 preguntas con audio para el final test mode
     *
     * @return array of objects con las preguntas 
    */ 
    public function get_audio_questions($num_questions=3, $ids=NULL)
    {
        if($ids != NULL)
        {
            $this->db->select('*');
            $this->db->from('question');
            $this->db->where('audio IS NOT NULL');
            $this->db->where_in('id_category', $ids);
            $this->db->order_by('rand()');
            $this->db->limit($num_questions);
            $query = $this->db->get();
            $questions = $query->result(); 
        }else
        {
            $this->db->select('*');
            $this->db->from('question');
            $this->db->where('audio IS NOT NULL');
            $this->db->order_by('rand()');
            $this->db->limit($num_questions);
            $query = $this->db->get();
            $questions = $query->result(); 
        }
        
        return $questions;
    }

      /** FINAL TEST
     * Devuelve 5 preguntas con audio para el final test mode
     *
     * @return array of objects con las preguntas 
    */ 
    public function get_audio_questions_by_ids($ids)
    {
        if($ids !=null)
        {
            $this->db->select('*');
            $this->db->from('question');
            $this->db->where('audio IS NOT NULL');
            $this->db->where_in('id', $ids);
            $this->db->order_by('rand()');
            $query = $this->db->get();
            $questions = $query->result(); 
            
            return $questions;
        }
    }

    /** FINAL TEST
     * Devuelve 5 preguntas de tipo question para el final test mode
     *
     * @return array of objects con las preguntas 
     * @param string $idcategory id de la categoria de las preguntas
    */ 
    public function get_questions($num_questions=3, $ids=NULL)
    {
        if($ids != NULL)
        {
            $this->db->select('*');
            $this->db->from('question');
            $this->db->where_in('id_category', $ids);
            $this->db->order_by('rand()');
            $this->db->limit($num_questions);
            $query = $this->db->get();
            $questions = $query->result(); 
        }else
        {
            $this->db->select('*');
            $this->db->from('question');
            $this->db->order_by('rand()');
            $this->db->limit($num_questions);
            $query = $this->db->get();
            $questions = $query->result(); 
        
        }
        
        return $questions;
    }

    /** FINAL TEST
     * Devuelve 5 preguntas de tipo question para el final test mode
     *
     * @return array of objects con las preguntas 
     * @param string $idcategory id de la categoria de las preguntas
    */ 
    public function get_questions_by_ids($ids)
    {
        if($ids !=null)
        {
            $this->db->select('*');
            $this->db->from('question');
            $this->db->where_in('id', $ids);
            $this->db->order_by('rand()');
            $query = $this->db->get();
            $questions = $query->result(); 
            
            return $questions;
        }
    }


    /** 
     * Crea un nuevo examen y sus entries para el nivel pattern
     *
     * @return string id del examen que se ha creado
     * @param array of objects $questions array con las preguntas del examen
    */
    public function createexam_pattern($id_category)
    {
        //Crea un array con el id de usuario e indicando que no se trata de un final test sino del training mode
        $data = array(
                'id_user' => $this->session->userdata['id'],
                'final_test' => false,
                'level' => '1',
                'id_category' => $id_category

            );

        $this->db->insert('exam', $data); //Crea e inserta el examen en la BD
        $idexamen = $this->db->insert_id(); //Recupera el id del examen para utilizarlo en los entries
        

        return $idexamen;
    }

    /** 
     * Crea un nuevo examen y sus entries para el nivel association
     *
     * @return string id del examen que se ha creado
     * @param array of objects $questions array con las preguntas del examen
    */
    public function createexam_association($id_category)
    {
        //Crea un array con el id de usuario e indicando que no se trata de un final test sino del training mode
        $data = array(
                'id_user' => $this->session->userdata['id'],
                'final_test' => false,
                'level' => '2',
                'id_category' => $id_category
            );

        $this->db->insert('exam', $data); //Crea e inserta el examen en la BD
        $idexamen = $this->db->insert_id(); //Recupera el id del examen para utilizarlo en los entries
        
        /*
        if(count($questions['question_answer']))
        {
            foreach($questions['question_answer'] as $row) //Por cada pregunta crea un entry
            {
                $datos = array(
                        'id_exam' => $idexamen,
                        'id_question' => $row->id,
                        'id_type_question' => 1
                    );
                $this->db->insert('entry', $datos);
            }
        }*/
        /*
        if(count($questions['tf_questions']))
        {
            foreach($questions['tf_questions'] as $row) //Por cada pregunta true/false crea un entry
            {
                $datos = array(
                        'id_exam' => $idexamen,
                        'id_question' => $row->id,
                        'id_type_question' => 3
                    );
                $this->db->insert('entry', $datos);
            }
        }

        if(count($questions['audio_write_questions']))
        {
            foreach($questions['audio_write_questions'] as $row) //Por cada pregunta true/false crea un entry
            {
                $datos = array(
                        'id_exam' => $idexamen,
                        'id_question' => $row->id,
                        'id_type_question' => 1
                    );
                $this->db->insert('entry', $datos);
            }
        }*/


        return $idexamen;
    }

    /**
     * Crea un nuevo examen y sus entries
     *
     * @return string id del examen que se ha creado
     * @param array of objects $questions array con las preguntas del examen
    */
    public function create_final_exam()
    {
        $data = array(
                'id_user' => $this->session->userdata['id'],
                'final_test' => true
            );

        $this->db->insert('exam', $data);
        $idexamen = $this->db->insert_id();
        
        return $idexamen;
    }


    /**
     * Devuelve la respuesta correcta dado el id de una pregunta
     *
     * @return object con la respuesta correcta
     * @param string $id id de la pregunta
    */
    public function correct_disordered($id)
    {
        $this->db->select('ordered');
        $this->db->from('disordered_statement');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $answer = $query->row(); 

        return $answer;
    }

    /**
     * Devuelve la respuesta correcta dado el id de una pregunta
     *
     * @return object con la respuesta correcta
     * @param string $id id de la pregunta
    */
    public function correct_truefalse($id)
    {
        $this->db->select('true_statement');
        $this->db->from('true_false_statement');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $answer = $query->row(); 

        return $answer;
    }

    /**
     * Devuelve la frase/pregunta dado el id de una pregunta
     *
     * @return object con la respuesta correcta
     * @param string $id id de la pregunta
    */
    public function correct_audio_write($id)
    {
        $this->db->select('statement');
        $this->db->from('question');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $answer = $query->row(); 

        return $answer;
    }

    /**
     * Devuelve todas las respuestas correctas de la frase/pregunta dado el id de una pregunta
     *
     * @return object con la respuesta correcta
     * @param string $idquestion id de la pregunta
    */
    public function get_correct_answers($idquestion)
    {
        $this->db->select('answer');
        $this->db->from('answer');
        $this->db->where('id_question', $idquestion);
        $this->db->where('correct', '1');
        $query = $this->db->get();
        $answer = $query->result_array();

        return $answer;
    }
    

    /**
     * Devuelve una respuesta correcta al azar de una pregunta segun su id
     *
     * @return object con la respuesta correcta
     * @param string $idquestion id de la pregunta
    */
    public function get_one_correct_answer($idquestion)
    {
        $this->db->select('answer');
        $this->db->from('answer');
        $this->db->where('id_question', $idquestion);
        $this->db->where('correct', '1');
        $this->db->order_by('id', 'RANDOM');
        $this->db->limit(1);
        $query = $this->db->get();
        $answer = $query->row_array();

        return $answer;
    }

    /**
     * Devuelve el id del tipo de variables, dada el nombre de la variable
     *
     * @return object con la respuesta correcta
     * @param string $variable id de la pregunta
    */
    public function get_id_type_variable($variable)
    {
        $this->db->select('id');
        $this->db->from('type_variable');
        $this->db->where('variable', $variable);
        
        $result = $this->db->get();
        $sol = $result->row();


        return $sol;
    }

    /**
     * Devuelve una de las variables correctas almacenadas en la bd de la frase/pregunta dado el id de una pregunta
     *
     * @return object con la respuesta correcta
     * @param string $variable id de la pregunta
    */
    public function get_variable_example($id_variable)
    {
        $this->db->select('name');
        $this->db->from('variable');
        $this->db->where('id_type_variable', $id_variable);
        
        $result = $this->db->get();
        $sol = $result->row();

        return $sol;
    }


    /** NO SE UTILIZA
     *
     * Actualiza un entry dado el id de una pregunta
     *
     * @param string $id_exam id del examen al que pertenece la entry
     * @param string $id id de la pregunta
     * @param string $entry 
    */
    public function update_entry($id_exam, $id, $entry)
    {
        $this->db->where('id_exam', $id_exam);
        $this->db->where('id_question', $id);
        $this->db->update('entry', $entry); 
    }

    /**
     * Crea un entry dado el id de una pregunta
     *
     * @param string $id_exam id del examen al que pertenece la entry
     * @param string $id id de la pregunta
     * @param string $entry 
    */
    public function create_entry($id_exam, $id, $entry, $type_question)
    {
        $datos = array(
                        'id_exam' => $id_exam,
                        'id_question' => $id,
                        'id_type_question' => $type_question,
                        'answer' => $entry['answer'],
                        'correct' => $entry['correct']
                    );
        $this->db->insert('entry', $datos);

    }


    /**
     * Actualiza un examen dado su id
     *
     * @param string $id_exam id del examen que se quiere actualizar
     * @param string $correctas numero de respuestas correctas
     * @param string $num_preguntas numero de preguntas
    */
    public function update_exam($id_exam, $correctas, $num_preguntas, $likert)
    {
        $exam = array(
            'num_questions' => $num_preguntas,
            'right' => $correctas,
            'wrong' => $num_preguntas - $correctas,
            'likert' => $likert
            );

        $this->db->where('id', $id_exam);
        $this->db->update('exam', $exam); 
    }


    /**
     * Devuelve una pregunta de tipo disordered cuyo id sea igual al recibido 
     *
     * @return array of object con la pregunta
     * @param string $id id de la pregunta
    */
    public function get_disordered_byid($id)
    {
        $this->db->select('*');
        $this->db->from('disordered_statement');
        $this->db->where('id', $id);
       
        $query = $this->db->get();
        $questions = $query->result(); 
        

        return $questions;
    }

    
    /**
     * Devuelve una pregunta de tipo true/false cuyo id sea igual al recibido 
     *
     * @return array of object con la pregunta
     * @param string $id id de la pregunta
    */
    public function get_truefalse_byid($id)
    {
        $this->db->select('*');
        $this->db->from('true_false_statement');
        $this->db->where('id', $id);
       
        $query = $this->db->get();
        $questions = $query->result(); 
        
        return $questions;
    }

    /**
     * Devuelve una pregunta de tipo question cuyo id sea igual al recibido 
     *
     * @return array of object con la pregunta
     * @param string $id id de la pregunta
    */
    public function get_question_byid($id)
    {
        $this->db->select('*');
        $this->db->from('question');
        $this->db->where('id', $id);
       
        $query = $this->db->get();
        $questions = $query->result(); 
        
        return $questions;
    }



    /** NO SE UTILIZA CREO
     * Devuelve una pregunta de tipo question cuyo id sea igual al recibido 
     *
     * @return array of object con la pregunta
     * @param string $id id de la pregunta
    */
    public function get_question_byid_final($id)
    {
        $this->db->select('*');
        $this->db->from('question');
        $this->db->where('id', $id);
       
        $query = $this->db->get();
        $questions = $query->result(); 
        
        return $questions;
    }

    /** 
     * Devuelve todas las entries de un examen dado el id del examen
     *
     * @return array of object con las entries
     * @param string $id_exam id de la pregunta
    */
   public function get_entries_respuestas($id_exam)
   {
        $this->db->select('*');
        $this->db->from('entry');
        $this->db->where_in('id_exam', $id_exam);
        $this->db->order_by("id", "asc"); 
        $query = $this->db->get();
        $questions = $query->result(); 
        
        return $questions;
   }

   /** 
     * Devuelve las preguntas que ha fallado el alumno en el examen con el id dado
     *
     * @return array of object con las preguntas que ha fallado el alumno
     * @param string $id_exam id del examen que el alumno ha hecho
    */
   public function get_try_again_questions($id_exam)
   {
        $this->db->select('*');
        $this->db->from('entry');
        $this->db->where_in('id_exam', $id_exam);
        $this->db->where('correct', 0);
        //$this->db->order_by("id", "asc"); 
        $query = $this->db->get();
        $questions = $query->result_array(); 
        
        return $questions;
   }
   
    /**
     * Devuelve todas las disordered questions de un examen dado su id
     *
     * @return object con las entries del examen
     * @param string $id_exam id del examen
    */ 
    public function get_disordered_results($id_exam)
    {
        $this->db->select('disordered_statement.id, disordered_statement.ordered, disordered_statement.disordered, disordered_statement.id_category');
        $this->db->from('disordered_statement');
        $this->db->join('entry', 'entry.id_question = disordered_statement.id');
        $this->db->where('entry.id_exam', $id_exam);
        $this->db->where('entry.id_type_question', '2');
        $this->db->order_by('rand()');

        $query = $this->db->get();

        return $query->result();
    }

    /**
     * Devuelve todas las true false questions de un examen dado su id
     *
     * @return object con las entries del examen
     * @param string $id_exam id del examen
    */ 
    public function get_truefalse_results($id_exam)
    {
        $this->db->select('true_false_statement.id, true_false_statement.true_statement, true_false_statement.false_statement, true_false_statement.id_category');
        $this->db->from('true_false_statement');
        $this->db->join('entry', 'entry.id_question = true_false_statement.id');
        $this->db->where('entry.id_exam', $id_exam);
        $this->db->where('entry.id_type_question', '3');
        $this->db->order_by('rand()');
        $query = $this->db->get();

        return $query->result();
    }

    /**
     * Devuelve todas las audio write questions de un examen dado su id
     *
     * @return object con las entries del examen
     * @param string $id_exam id del examen
    */ 
    public function get_audiowrite_results($id_exam)
    {
        $this->db->select('question.id, question.statement, question.id_category, question.audio');
        $this->db->from('question');
        $this->db->join('entry', 'entry.id_question = question.id');
        $this->db->where('entry.id_exam', $id_exam);
        $this->db->where('entry.id_type_question', '4');
        $this->db->order_by('rand()');
        $query = $this->db->get();

        return $query->result();
    }

    /**
     * Devuelve todas las entries de un examen dado su id
     *
     * @return object con las entries del examen
     * @param string $id_exam id del examen
    */ 
    public function get_q_a_results($id_exam)
    {
        $this->db->select('question.id, question.statement, question.id_category, question.audio');
        $this->db->from('question');
        $this->db->join('entry', 'entry.id_question = question.id');
        $this->db->where('entry.id_exam', $id_exam);
        $this->db->where('entry.id_type_question', '1');
        $this->db->order_by('rand()');
        $query = $this->db->get();

        return $query->result();
    }

    /** 
     * Devuelve el id de una categoria dado el numero de la categoria
     *
     * @return array of objects el id de la categoria
     * @param string $num_category numero de la categoria 
    */ 
    public function get_category_id($num_category)
    {
            $this->db->select('id');
            $this->db->from('category');
            $this->db->where_in('number', $num_category);
            $query = $this->db->get();
            
            return $query->row_array();
    }

    /** 
     * Devuelve el nombre de una categoria dado el id de la categoria
     *
     * @return array of objects con el nombre de la categoria
     * @param string $category_id id de la categoria 
    */ 
    public function get_category_name($category_id)
    {
            $this->db->select('number, description');
            $this->db->from('category');
            $this->db->where_in('id', $category_id);
            $query = $this->db->get();
            
            return $query->row_array();
    }
    
}
