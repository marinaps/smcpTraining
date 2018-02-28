<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//si no existe la función invierte_date_time la creamos
if(!function_exists('get_base_categories'))
{
    /**
     * Obtiene todas las categorias base, es decir, todas aquellas cullo id padre sea null
     *
     * @return array con todas las categorias base
    */ 
    function get_base_categories()
    {
        $ci =& get_instance();
        $data= array();
        $ci->db->select('*');
        $ci->db->from('category');
        $ci->db->where('id_parent_category', NULL);
        $query = $ci->db->get();
        $data=$query->result_array();
        
        return $data;
    }
}

if(!function_exists('get_categories_with_questions'))
{
    /**
     * Devuelve un array con todos los ids de las categorias que tienen preguntas
     *
     * @return array con todos los ids de las categorias que contienen preguntas
    */ 
    function get_categories_with_questions()
    {
        $ci =& get_instance();
        $data= array();
        $ci->db->select('id_category');
        $ci->db->from('question');
        $ci->db->group_by("id_category"); 
        $query = $ci->db->get();
        $data=$query->result_array(); //Obtiene los ids de las categorias que tienen preguntas

        $datos = array();

        foreach ($data as $key) //Recorre cada categoria que tiene preguntas para buscar los ids de los padres
        {
            array_push($datos, $key['id_category']); //Almacena primero el id de la categoria que tiene preguntas
            
            $parents_ids = get_parents_ids($key['id_category']); //Obtiene todos los ids de los padres de esa categoria
            
            foreach ($parents_ids as $valor) //Recorre cada padre y mira si ya está almacenado en el array
            {
                if(array_search($valor, $datos) === false) //Si no esta almacenado lo guarda en el array
                {
                    array_push($datos, $valor);
                }     
            }
        }
        
        return $datos;
    }
}

if(!function_exists('get_categories_with_questions_pattern'))
{
    /**
     * Devuelve un array con todos los ids de las categorias que tienen preguntas
     *
     * @return array con todos los ids de las categorias que contienen preguntas
    */ 
    function get_categories_with_questions_pattern()
    {
        $ci =& get_instance();

        $audio_questions= array();
        $ci->db->select('id_category');
        $ci->db->from('question');
        $ci->db->where('audio IS NOT NULL');
        $ci->db->group_by("id_category"); 
        $query = $ci->db->get();
        $audio_questions=$query->result_array(); //Obtiene los ids de las categorias que tienen preguntas de audio

        $tf_questions= array();
        $ci->db->select('id_category');
        $ci->db->from('true_false_statement');
        $ci->db->group_by("id_category"); 
        $query = $ci->db->get();
        $tf_questions=$query->result_array(); //Obtiene los ids de las categorias que tienen preguntas de true/false

        $disordered_questions= array();
        $ci->db->select('id_category');
        $ci->db->from('disordered_statement');
        $ci->db->group_by("id_category"); 
        $query = $ci->db->get();
        $disordered_questions=$query->result_array(); //Obtiene los ids de las categorias que tienen preguntas desordenadas

        $resultado = array_merge($audio_questions, $tf_questions, $disordered_questions);

        $datos = array();


        foreach ($resultado as $key) //Recorre cada categoria que tiene preguntas para buscar los ids de los padres
        {
            array_push($datos, $key['id_category']); //Almacena primero el id de la categoria que tiene preguntas
            
            $parents_ids = get_parents_ids($key['id_category']); //Obtiene todos los ids de los padres de esa categoria
            
            foreach ($parents_ids as $valor) //Recorre cada padre y mira si ya está almacenado en el array
            {
                if(array_search($valor, $datos) === false) //Si no esta almacenado lo guarda en el array
                {
                    array_push($datos, $valor);
                }     
            }
        }
        
        return $datos;
    }
}

if(!function_exists('get_parents_ids'))
{
    /**
     * Dado un id de una categoria, devuelve un array con todos los ids de los padres de esa categoria
     *
     * @return array con todos los ids de los padres de la categoria dada
     * @param string $id_category id de la categoria 
    */ 
    function get_parents_ids($id_category)
    {
        $id_parent_category = get_parent_id($id_category);

        $data= array();
        while($id_parent_category != NULL)
        {
            array_push($data, $id_parent_category);
            $id_parent_category = get_parent_id($id_parent_category);
        }
          
        return $data;
    }
}

if(!function_exists('get_parent_id'))
{
    /**
     * Dado un id de una categoria, devuelve el id del padre de esa categoria
     *
     * @return string con el id d el padre de la categoria dada
     * @param string $id_category id de la categoria 
    */ 
    function get_parent_id($id_category)
    {
        $ci =& get_instance();
        $ci->db->select('id_parent_category');
        $ci->db->from('category');
        $ci->db->where('id', $id_category);
        $query = $ci->db->get();
        
        return $query->row()->id_parent_category;
    }
}

if(!function_exists('get_children_ids'))
{
    /**
     * Dado un id de una categoria, devuelve los ids de los hijos que tienen preguntas
     *
     * @return array $result_categories con los ids de los hijos que tienen preguntas
     * @param string $id_category id de la categoria 
    */ 
    function get_children_ids($id_category)
    {
        $categories_with_questions = get_categories_with_questions(); //Obtiene los ids de las categorias con preguntas

        $subs = get_cats_by_cat_id($id_category); //Obtiene los hijos de la categoria dada(solo hijos directos)
        
        $result_categories = array(); //Array para almacenar el resultado
        array_push($result_categories, $id_category); //Se introduce en el array el id de la categoria dada

        $aux = array();

        if(count($subs)>0)
        {
            foreach($subs as $s) //Se va recorriendo los hijos directos
            {   
                //Si el id coincide alguno de los ids que tienen preguntas entonces se introduce en el array resultado
               if(array_search($s['id'], $categories_with_questions) !== false) 
               {    
                    array_push($result_categories, $s['id']);
                
                    $aux = get_children_rec($s['id']); //Se va almacenando todos los hijos de cada id
                    
                    //Se recorren cada uno de los ids y si estan en categories_with_questions y ademas no estan en el array resultado entonces se almacena
                    foreach($aux as $ss)
                    { 
                        if(array_search($ss, $categories_with_questions) !== false && array_search($ss, $result_categories) === false) 
                        {  
                            array_push($result_categories, $ss);
                        }
                    }
               }
            }
        }

       return $result_categories;
    }
}


if(!function_exists('get_children_ids_pattern'))
{
    /**
     * Dado un id de una categoria, devuelve los ids de los hijos que tienen preguntas
     *
     * @return array $result_categories con los ids de los hijos que tienen preguntas
     * @param string $id_category id de la categoria 
    */ 
    function get_children_ids_pattern($id_category)
    {
        $categories_with_questions = get_categories_with_questions_pattern(); //Obtiene los ids de las categorias con preguntas

        $subs = get_cats_by_cat_id($id_category); //Obtiene los hijos de la categoria dada(solo hijos directos)
        
        $result_categories = array(); //Array para almacenar el resultado
        array_push($result_categories, $id_category); //Se introduce en el array el id de la categoria dada

        $aux = array();

        if(count($subs)>0)
        {
            foreach($subs as $s) //Se va recorriendo los hijos directos
            {   
                //Si el id coincide alguno de los ids que tienen preguntas entonces se introduce en el array resultado
               if(array_search($s['id'], $categories_with_questions) !== false) 
               {    
                    array_push($result_categories, $s['id']);
                
                    $aux = get_children_rec($s['id']); //Se va almacenando todos los hijos de cada id
                    
                    //Se recorren cada uno de los ids y si estan en categories_with_questions y ademas no estan en el array resultado entonces se almacena
                    foreach($aux as $ss)
                    { 
                        if(array_search($ss, $categories_with_questions) !== false && array_search($ss, $result_categories) === false) 
                        {  
                            array_push($result_categories, $ss);
                        }
                    }
               }
            }
        }

       return $result_categories;
    }
}


if(!function_exists('get_children_rec'))
{
    /**
     * Dado un id de una categoria, devuelve los ids de todos sus hijos
     *
     * @return array $aux con los ids de los hijos
     * @param string $id_category id de la categoria 
    */ 
    function get_children_rec($id_category)
    {
        $subs = get_cats_by_cat_id($id_category);

        static $aux = array(); 

        if(count($subs)>0)
        {
            foreach($subs as $s)
            {      
                array_push($aux, $s['id']);
                get_children_rec($s['id'], $aux);  
            }
        }
        return $aux;
    }
}


if(!function_exists('get_cat_by_id'))
{
    function get_cat_by_id($id)
    {
        $ci =& get_instance();
       
        $ci->db->select('*');
        $ci->db->from('category');
        $ci->db->where('id', $id);
        $query = $ci->db->get();

        $data=$query->result_array();
        return $data;
    }
}


if(!function_exists('select_tree_cat_id'))
{
    function select_tree_cat_id($id,$level)
    {
        $subs = get_cats_by_cat_id($id);
        if(count($subs)>0){
            foreach($subs as $s){
                echo "<option value=\"$s[id]\" > ".str_repeat('&nbsp;', $level)."$s[number]".""." $s[description] </option>";
                select_tree_cat_id($s["id"],$level+3);
            }
        }
    }
}


if(!function_exists('get_cats_by_cat_id'))
{
    /**
     * Devuelve todas las categorias hijas de la categoria dada
     *
     * @return array $data con todos los ids de los hijos
     * @param string $id id de la categoria
    */ 
    function get_cats_by_cat_id($id)
    {
        $ci =& get_instance();

        $ci->db->select('*');
        $ci->db->from('category');
        $ci->db->where('id_parent_category', $id);
    
        $query = $ci->db->get();

        $data=$query->result_array();
        return $data;
    }
}

if(!function_exists('list_tree_cat_id'))
{
    function list_tree_cat_id($id)
    {
        $subs = get_cats_by_cat_id($id);
        if(count($subs)>0){
            echo "<ul>";
            foreach($subs as $s){
                echo "<li>  $s[number]"." "."$s[description] ";
                ?> 
             <a href="javascript:void(0)" title="Edit" onclick="delete_category(<?php echo $s['id']?>)"><i class="glyphicon glyphicon-trash"></i></a>
             <a href="javascript:void(0)" title="Edit" onclick="edit_category(<?php echo $s['id']?>)"><i class="glyphicon glyphicon-pencil"></i></a>
             </li>
             <?php 
                list_tree_cat_id($s["id"]);
            }
            echo "</ul>";
        }
    }
}


if(!function_exists('select_tree_cat_id_control'))
{
    /**
     * Comprueba si las subcategorias tienen preguntas, en tal caso muestra la categoria en el select
     *
     * @param string $id_category id de la categoria 
     * @param string $level numero de espacios que se repiten para la separacion al mostrarlas
     * @param array $categorias con los ids de las categorias que tienen preguntas
    */ 
    function select_tree_cat_id_control($id_category,$level,$categorias)
    {
        $subs = get_cats_by_cat_id($id_category);
        if(count($subs)>0)
        {
            foreach($subs as $s)
            {   
                //Si la categoria esta en el array significa que la categoria tiene preguntas, y por tanto la muestra como opcion
                if(array_search($s['id'], $categorias) !== false) 
                {
                    echo "<option value=\"$s[id]\" > ".str_repeat('&nbsp;', $level)."$s[number]".""." $s[description] </option>";
                    select_tree_cat_id_control($s["id"], $level+3, $categorias);
                }
            }
        }
    }
}




/** --------------------------------------------------
    Funciones para el controller de configuracion
-----------------------------------------------------  */


if(!function_exists('list_tree_cat_id_config'))
{
    function list_tree_cat_id_config($id)
    {
        $subs = get_cats_by_cat_id($id);
        if(count($subs)>0){
            echo "<ul>";
            foreach($subs as $s)
            {
                echo "<li><input type='checkbox' data-id='item' name='category$s[id]'/> $s[number]"." "."$s[description]";
                echo "<input type='hidden' value='$s[id]' name='category$s[id]'>";
                list_tree_cat_id_config($s["id"]);
            }
             echo "</li>";
            echo "</ul>";
        }
    }
}




//end application/helpers/ayuda_helper.php