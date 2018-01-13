<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//si no existe la función correct_disordered la creamos
if(!function_exists('correct_disordered'))
{
    /**
     * Funcion para corregir una frase desordenada
     *  
     * @return boolean true si la respuesta es correcta
     *
     * @param string $id con el id de la pregunta
     * @param string $post con la respuesta dada por el alumno
     * @param string $id_exam con el id del examen
     */
    function correct_disordered($id, $post, $id_exam)
    {
        $ci =& get_instance();

        //se obtiene la respuesta correcta
        $correct_answer = $ci->chat->correct_disordered($id);
        //comprueba si la respuesta dada es igual a la correcta
        if(strcasecmp(strtolower($post), strtolower($correct_answer->ordered)) == 0 )
        {
            $es_correcta = TRUE;
            $entry = array(
                'answer' => $post,
                'correct' => TRUE
                );
        }else{
            $es_correcta = FALSE;
            $entry = array(
                'answer' => $post,
                'correct' => FALSE
                );
        }
        //actualiza un entry con la respuesta y si es correcta o no
        $ci->chat->create_entry($id_exam, $id, $entry, 2);

        return $es_correcta;
    }
}

//si no existe la función correct_truefalse la creamos
if(!function_exists('correct_truefalse'))
{
    /**
     * Funcion para corregir una frase true/false
     *  
     * @return boolean true si la respuesta es correcta
     *
     * @param string $id con el id de la pregunta
     * @param string $post con la respuesta dada por el alumno
     * @param string $id_exam con el id del examen
     */
    function correct_truefalse($id, $post, $id_exam)
    {
        
        $ci =& get_instance();
        
        //se obtiene la respuesta correcta
        $correct_answer = $ci->chat->correct_truefalse($id);

        //comprueba si la respuesta dada es igual a la correcta
        if(strcasecmp(strtolower($post), strtolower($correct_answer->true_statement)) == 0 )
        {
            $es_correcta = TRUE;
            $entry = array(
                'answer' => $post,
                'correct' => TRUE
                );
        }else{
            $es_correcta = FALSE;
            $entry = array(
                'answer' => $post,
                'correct' => FALSE
                );
        }

        //actualiza un entry con la respuesta y si es correcta o no
        $ci->chat->create_entry($id_exam, $id, $entry, 3);

        return $es_correcta;
    }
}


//si no existe la función correct_audioquestions la creamos
if(!function_exists('correct_audioquestions'))
{
    /**
     * Funcion para corregir una frase con audio
     *  
     * @return boolean true si la respuesta es correcta
     *
     * @param string $id con el id de la pregunta
     * @param string $post con la respuesta dada por el alumno
     * @param string $id_exam con el id del examen
     */
    function correct_audioquestions($id, $post, $id_exam)
    {
         
        $ci =& get_instance();

        //se obtiene la respuesta correcta
        $correct_answerr = $ci->chat->correct_audio_write($id); 

        //comprueba si la respuesta dada es igual a la correcta
        if(strcasecmp(strtolower($post), strtolower($correct_answerr->statement)) == 0 )
        {
            $es_correcta = TRUE;
            $entry = array(
                'answer' => $post,
                'correct' => TRUE
                );
        }else{
            $es_correcta = FALSE;
            $entry = array(
                'answer' => $post,
                'correct' => FALSE
                );
        }

        //crea la entry con la respuesta y si es o no correcta
        $ci->chat->create_entry($id_exam, $id, $entry, 4); 

        return $es_correcta;
    }
}

//si no existe la función correct_variablequestions la creamos
if(!function_exists('correct_variablequestions'))
{
    /**
     * Funcion para corregir una frase con variables
     *  
     * @return boolean true si la hora es correcta
     *
     * @param string $id con el id de la pregunta
     * @param string $id_exam con el id del examen
     * @param string $respuesta_dada con la respuesta dada por el alumno
     */
    function correct_variablequestions($id, $id_exam, $respuesta_dada)
    {
        $ci =& get_instance();

        //array para almacenar todas las respuestas correctas
        $correct= array();
        //devuelve todas las respuestas correctas de la pregunta dada, por el id. 
        $correct_answers = $ci->chat->get_correct_answers($id); 

        $correct = array_merge($correct, $correct_answers);
        //array_push($this->data['correct_answers'], $correct_answers); 
        
        /*----------------------------------------------------------------------------*/
        /*
            Esto se hace para obtener una respuesta al azar que sea correcta para mostrar al alumno como ejemplo.
        */

        //obtiene una respuesta correcta al azar de la pregunta con el id dado
        $answer = $ci->chat->get_one_correct_answer($id);

        //si la respuesta tiene una variable entra en el if
        if(strpos($answer['answer'], '$'))
        {
            //se separa la frase por los signos de $ donde esta la/las variables
            //puede haber mas de una variable en una misma frase
            $porciones = explode("$", $answer['answer']);
            //num es el tamaño del array porciones
            $num = count($porciones); 

            for ($j = 0; $j < $num; $j++) 
            {   
                //si se trata de una parte impar entonces es donde va una variable
                /* en este if lo que se hace es ver que tipo de variable se trata y busca un ejemplo de ella para sustituirla */
                if($j%2 != 0)
                {   
                    //obtiene el id de la variable, dada por su nombre
                    $id_type_variable = $ci->chat->get_id_type_variable($porciones[$j]);
                    //obtiene un ejemplo de esa variable, dada por su id
                    $variable_example = $ci->chat->get_variable_example($id_type_variable->id);
                    //sustituye el ejemplo de la variable en la frase
                    $answer['answer'] = str_replace("$".$porciones[$j]."$", $variable_example->name, $answer['answer']);                         
                }
            }
            $ci->data['examples_answers'][] =  $answer['answer'];

        }
        //si la respuesta no tiene variable, se utiliza directamente como respuesta ejemplo
        else
        {
            $ci->data['examples_answers'][] =  $answer['answer'];
        }
        /*----------------------------------------------------------------------------*/
        
        //se inicializa a FALSE
        $es_correcta=FALSE;

        //va iterando por cada respuesta correcta que tiene la pregunta
        foreach ($correct_answers as $row)
        {   
            if( ! $es_correcta)
            {
                //se comprueba si la respuesta es correcta llamando a la funcion validar_frase
                $es_correcta = validar_frase($respuesta_dada, $row['answer']);
            }
        }

        if($es_correcta)
        {
            $correctas = TRUE;
            $entry = array(
                'answer' => $respuesta_dada,
                'correct' => TRUE
                );
        }
        else
        {
            $incorrectas = FALSE;
            $entry = array(
                'answer' => $respuesta_dada,
                'correct' => FALSE
                );
        }

        //crea la entry con la respuesta y si es o no correcta
        $ci->chat->create_entry($id_exam, $id, $entry, 1);

        return $es_correcta;
    }
}


//si no existe la función validar_frase la creamos
if(!function_exists('validar_frase'))
{
    /**
     * Funcion para validar una frase
     *  
     * @return boolean true si la hora es correcta
     */
 function validar_frase($frasealumno, $frasecorrecta)
    {
        $findme   = '$';
        //devuelve FALSE si no encuentra un $ en la frase, es decir, que se trataria de una frase sin variable
        $pos = strpos($frasecorrecta, $findme); 

        //Comprueba si es una frase con variable(tiene $) o sin variable(no tiene $)
        if ($pos === FALSE) 
        {   
            //Aqui se comprueban las frases que NO tienen variables

            $respuesta = TRUE; //Se inicializa a TRUE

            //comprueba si la respuesta dada es igual a la correcta
            //con strtolower se convierten las cadenas primero a minuscula y luego se compara si son iguales
            if(strcasecmp(strtolower($frasealumno), strtolower($frasecorrecta)) != 0 )
            { 
                //si no son iguales entonces la respuesta es una respuesta no correcta y se devuelve FALSE
                $respuesta = FALSE;
            }

            return $respuesta;

        }else 
        {
            //Aqui se comprueban las frases que SI tienen variables

            //Divide la frase correcta en varios strings por cada $ que contenga la frase
            $porciones = explode("$", $frasecorrecta);
            $resultado = count($porciones); //tamaño del array(es decir en cuantos strings se ha divido la frase)
                
            for ($i = 0; $i < $resultado; $i++) //averigua el tamaño de cada porcion
            {
                $long[$i] = strlen($porciones[$i]);
            }

            $cont = 0; //este contador va sumando los caracteres de los strings de las partes para poder avanzar
            $verdadero = TRUE;

            //Se va iterando por cada porcion que hemos dividio la frase
            for ($i = 0; $i < $resultado && $verdadero; $i++) 
            {   
                //echo "________________________________________";
                //echo "<br>";

                //Si es una parte PAR entonces se trata de una parte que no tiene variables y entonces entra en el if
                if($i%2==0)
                {
                    /* //PRUEBAS
                    echo "resultado 1: ".$verdadero;
                    echo "<br>";

                    echo "___frase: ". trim($porciones[$i]);
                    echo "<br>";
                    echo var_dump( trim($porciones[$i]));
                    echo "<br>";
                    echo "___alumno: ".substr( trim($frasealumno),$cont, $long[$i]);
                    echo "<br>";
                    echo var_dump(trim(substr( $frasealumno,$cont, $long[$i])));
                    echo "<br>";
                    echo "<br>";
                    echo "___parte ".$i.": "; 
                    */


                    //El substr devuelve la parte de la frase del alumno desde cont hasta lo que ocupa la parte que estamos validando, es dicer, $long[$i].
                    //Luego comparamos esta parte que hemos obtenido de la frase dada por el alumno con la parte de la frase correcta que estamos validando.
                    if(strncmp (trim($porciones[$i]), trim(substr($frasealumno,$cont, $long[$i])),  $long[$i]) != 0)
                    {
                        //Si las partes no son iguales entonces devuelvo FALSE para indicar que la frase no es correcta.
                        $verdadero = FALSE;
                    }
                    /*
                    echo strncmp(trim($porciones[$i]), trim(substr($frasealumno,$cont, $long[$i] )),$long[$i]);
                    echo "<br>";
                    echo "resultado 2: ".$verdadero;
                    echo "<br>"; */

                    //Al final sumamos al contador la longitud de la parte que hemos validado.
                    $cont = $cont + $long[$i]; 
                }
                else 
                {  //Si es una parte IMPAR indica que es una parte que contiene una variables y entonces entra enel else.

                    //la porcion contendra el nombre de la variables que se va a evaluar, por lo tanto se hace un switch para ver de que variable se trata.
                    switch ($porciones[$i]) 
                    {
                        case "time":
                            //Es un 4 porque la hora siempre son 4 caracteres.

                            //Cogemos la parte del string de la frase del alumno que corresponde con un limite de 4 caracteres, ya que la hora son siempre 4 caracteres. 

                            //Se envia a la funcion de validar las horas y esta nos devuelve TRUE o FALSE dependiendo de si es una hora correcta o no.
                            $verdadero=validate_time(substr($frasealumno,$cont, 4));

                            /*
                            echo "----Parte impar----".$i.": ".substr($frasealumno,$cont, 4 );
                            echo "<br>";
                            echo "----resultado de porciones impares:----".$porciones[$i];
                            echo "<br>";
                            echo "----HA ENTRADOOO hour----";
                            echo var_dump($verdadero);
                            echo "<br>";
                            echo "<br>"; */

                            //Al final sumamos al contador la longitud de la parte que hemos validado.
                            $cont = $cont + strlen(substr($frasealumno,$cont, 4 ));

                            //echo $cont;
                            //echo "<br>";
                            break;

                        case "beaufort":
                            //Es un 2 porque el maximo numero de caracteres posible es 2(de 0-12 es correcto)

                            //Cogemos la parte del string de la frase del alumno que corresponde con un limite de 2 caracteres, ya que beaufort son siempre 2 caracteres. 
                            $partes = explode(" ", substr($frasealumno,$cont, 2 ));

                            /* Puede ser que la frase tenga una coma detras y que el numero sea de una cifra
                              por lo tanto se cogera el numero y la coma, con esto vemos si hay una coma al final
                              y si la hay se coge solo el numero  */
                            if(substr($partes[0], -1) == ',')
                                $partes[0] = substr($partes[0], 0, -1); 

                            /*
                            echo "<br>";
                            echo "partes: ".$partes['0'];
                            echo "<br>";
                            echo "----resultado de porciones impares:----".$porciones[$i];
                            echo "<br>"; */

                            $verdadero=validate_beaufort(trim($partes[0]));

                            //echo "----HA ENTRADOOO beaufort----". $verdadero." _";
                            //echo var_dump($verdadero);
                            //echo "<br>";

                            $cont = $cont + strlen(trim($partes[0]));
                            break;
                        
                        case "cardinalpoint": //HAY QUE HACERLO

                            $partes = explode(" ", trim(substr($frasealumno, $cont, 3)));

                            //Si detras tiene una coma la quita 
                            if(substr($partes[0], -1) == ',')
                                $partes[0] = substr($partes[0], 0, -1); 
    

                            $verdadero=validate_cardinalpoint(trim($partes[0]));

                            $cont = $cont + strlen(trim($partes[0]));
                            break;

                        case "mmsi":

                            //echo "----Parte impar----".$i.": ".substr($frasealumno,$cont, 8 );

                            //Es 8 porque el numero de caracteres para el mmsi es siepre de 8
                            $partes = explode(" ", substr($frasealumno,$cont, 8 ));

                            /*
                            echo "<br>";
                            echo $partes['0'];
                            echo "<br>";
                            echo "----resultado de porciones impares:----".$porciones[$i];
                            echo "<br>"; */

                            $verdadero=validate_MMSI(trim($partes[0]));

                            //echo "----HA ENTRADOOO direction----". $verdadero." _";
                            //echo var_dump($verdadero);
                            //echo "<br>";

                            $cont = $cont + strlen(trim($partes[0]));
                            break;

                        case "date":

                            //echo "----Parte impar----".$i.": ".substr($frasealumno,$cont, 18 );
                            //trim — Elimina espacio en blanco (u otro tipo de caracteres) del inicio y el final de la cadena

                            //Se coge
                            $partes = explode(" ", trim(substr($frasealumno,$cont, 14 )));

                            //Si la ultima parte(la del mes) tiene detras una coma la quita 
                            if(substr($partes[1], -1) == ',')
                                $partes[1] = substr($partes[1], 0, -1); 

                            //echo "<br>";
                            //echo $partes[0];
                            //echo "<br>";
                            //echo "----resultado de porciones impares:----".$porciones[$i];
                            //echo "<br>";

                            $verdadero=validate_date(trim(substr($frasealumno,$cont, 14 )));

                            //echo "----HA ENTRADOOO date----". $verdadero." _";
                            //echo var_dump($verdadero);
                            //echo "<br>";

                            $cont = $cont + strlen(trim($partes[0])) + strlen(trim($partes[1])) + 1;
                            break;

                          case "number":

                            //echo "----Parte impar----".$i.": ".substr($frasealumno,$cont, 4 );

                            $partes = explode(" ", trim(substr($frasealumno,$cont, 4 )));

                            //Si detras tiene una coma la quita 
                            if(substr($partes[0], -1) == ',')
                                $partes[0] = substr($partes[0], 0, -1); 

                            /*
                            echo "<br>";
                            echo $partes[0];
                            echo "<br>";
                            echo "----resultado de porciones impares:----".$porciones[$i];
                            echo "<br>"; */

                            $verdadero=validate_number(trim($partes[0]));

                            //echo "----HA ENTRADOOO number----". $verdadero." _";
                            //echo var_dump($verdadero);
                            //echo "<br>";

                            $cont = $cont + strlen(trim($partes[0]));
                            break;

                        case "speed":

                            //echo "----Parte impar----".$i.": ".substr($frasealumno,$cont, 4 );

                            $partes = explode(" ", trim(substr($frasealumno,$cont, 4 )));

                            //Si detras tiene una coma la quita 
                            if(substr($partes[0], -1) == ',')
                                $partes[0] = substr($partes[0], 0, -1); 

                            /*
                            echo "<br>";
                            echo $partes[0];
                            echo "<br>";
                            echo "----resultado de porciones impares:----".$porciones[$i];
                            echo "<br>"; */

                            $verdadero=validate_speed(trim($partes[0]));

                            //echo "----HA ENTRADOOO number----". $verdadero." _";
                            //echo var_dump($verdadero);
                            //echo "<br>";
                            $cont = $cont + strlen(trim($partes[0]));
                            break;

                        case "vhf channel":

                            //echo "----Parte impar----".$i.": ".substr($frasealumno,$cont, 2 );

                            $partes = explode(" ", trim(substr($frasealumno,$cont, 2 )));

                             //Si detras tiene una coma la quita 
                            if(substr($partes[0], -1) == ',')
                                $partes[0] = substr($partes[0], 0, -1); 

                            /*
                            echo "<br>";
                            echo $partes[0];
                            echo "<br>";
                            echo "----resultado de porciones impares:----".$porciones[$i];
                            echo "<br>"; */

                            $verdadero=validate_vhfchannel_hourswithin(trim($partes[0]));

                            //echo "----HA ENTRADOOO vhf channel----". $verdadero." _";
                            //echo var_dump($verdadero);
                            //echo "<br>";

                            $cont = $cont + strlen(trim($partes[0]));
                            break;

                        case "hours within":

                            //echo "----Parte impar----".$i.": ".substr($frasealumno,$cont, 2 );

                            $partes = explode(" ", trim(substr($frasealumno,$cont, 2 )));

                             //Si detras tiene una coma la quita 
                            if(substr($partes[0], -1) == ',')
                                $partes[0] = substr($partes[0], 0, -1); 

                            /*
                            echo "<br>";
                            echo $partes[0];
                            echo "<br>";
                            echo "----resultado de porciones impares:----".$porciones[$i];
                            echo "<br>"; */

                            $verdadero=validate_vhfchannel_hourswithin(trim($partes[0]));

                            //echo "----HA ENTRADOOO vhf channel----". $verdadero." _";
                            //echo var_dump($verdadero);
                            //echo "<br>";

                            $cont = $cont + strlen(trim($partes[0]));
                            break;
                        
                        case "mvname":

                            //echo "----Parte impar----".$i.": ".substr($frasealumno,$cont, 8 );

                            $partes = explode(" ", trim(substr($frasealumno,$cont, 8 )));

                            //Si detras tiene una coma la quita 
                            if(substr($partes[0], -1) == ',')
                                $partes[0] = substr($partes[0], 0, -1); 

                            /*
                            echo "<br>";
                            echo $partes[0];
                            echo "<br>";
                            echo "----resultado de porciones impares:----".$porciones[$i];
                            echo "<br>"; */

                            $verdadero=validate_mvname(trim($partes[0]));

                            //echo "----HA ENTRADOOO name----". $verdadero." _";
                            //echo var_dump($verdadero);
                            //echo "<br>";

                            $cont = $cont + strlen(trim($partes[0]));
                            break;

                        case "charted name":

                            //echo "----Parte impar----".$i.": ".substr($frasealumno,$cont, 5 );

                            $partes = explode(" ", trim(substr($frasealumno,$cont, 5 )));

                            //Si detras tiene una coma la quita 
                            if(substr($partes[0], -1) == ',')
                                $partes[0] = substr($partes[0], 0, -1); 

                            $verdadero=validate_charted_name(trim($partes[0]));

                            $cont = $cont + strlen(trim($partes[0]));
                            break;

                        case "atposition": 

                            $partes = explode(" ", trim(substr($frasealumno,$cont, 14 )));

                            //Si detras tiene una coma la quita 
                            if(substr($partes[1], -1) == ',')
                                $partes[1] = substr($partes[1], 0, -1); 

                            //Concatena las dos partes con un espacio entre medio
                            $result = $partes[0]." ".$partes[1];

                            $verdadero=validate_at_position(trim($result));

                            $cont = $cont + strlen(trim($result));
                            break;

                        case "search pattern":

                            $partes = explode(" ", trim(substr($frasealumno, $cont, 6)));

                            //Si detras tiene una coma la quita 
                            if(substr($partes[0], -1) == ',')
                                $partes[0] = substr($partes[0], 0, -1); 

                            $verdadero=validate_search_pattern(trim($partes[0]));

                            $cont = $cont + strlen(trim($partes[0]));
                            break;

                        case "datum":

                            $partes = explode(" ", trim(substr($frasealumno, $cont, 4)));

                            //Si detras tiene una coma la quita 
                            if(substr($partes[0], -1) == ',')
                                $partes[0] = substr($partes[0], 0, -1); 

                            $verdadero=validate_datum(trim($partes[0]));

                            $cont = $cont + strlen(trim($partes[0]));
                            break;

                        case "course":

                            /* Realiza una operación substr() multibyte de forma segura basada en el número de caracteres.
                               Esto arregla los problemas con los caracteres especiales como los grados(º)*/
                            $partes = explode(" ", trim(mb_substr($frasealumno, $cont, 6)));

                            //Si detras tiene una coma la quita 
                            if(mb_substr($partes[0], -1) == ',')
                                $partes[0] = mb_substr($partes[0], 0, -1); 

                            $verdadero=validate_bearing_course(trim($partes[0]));

                            $cont = $cont + strlen(trim($partes[0]));
                            break;

                         case "bearing": //Es igual que course

                            /* Realiza una operación substr() multibyte de forma segura basada en el número de caracteres.
                               Esto arregla los problemas con los caracteres especiales como los grados(º)*/
                            $partes = explode(" ", trim(mb_substr($frasealumno, $cont, 6)));

                            //Si detras tiene una coma la quita 
                            if(mb_substr($partes[0], -1) == ',')
                                $partes[0] = mb_substr($partes[0], 0, -1); 

                            $verdadero=validate_bearing_course(trim($partes[0]));

                            $cont = $cont + strlen(trim($partes[0]));
                            break;

                        case "frequency":

                            $partes = explode(" ", trim(substr($frasealumno,$cont, 10 )));

                             //Si detras tiene una coma la quita 
                            if(substr($partes[1], -1) == ',')
                                $partes[1] = substr($partes[1], 0, -1); 

                            $verdadero=validate_frequency(trim(substr($frasealumno,$cont, 10 )));

                            $cont = $cont + strlen(trim($partes[0])) + strlen(trim($partes[1])) +1;
                            break;

                        case "distance":

                            $partes = explode(" ", trim(substr($frasealumno,$cont, 6 )));

                            //Si detras tiene una coma la quita 
                            if(substr($partes[0], -1) == ',')
                                $partes[0] = substr($partes[0], 0, -1); 

                            $verdadero=validate_distance(trim($partes[0]));

                            $cont = $cont + strlen(trim($partes[0]));
                            break;

                        case "call sign":

                            $partes = explode(" ", trim(substr($frasealumno,$cont, 6 )));

                            //Si detras tiene una coma la quita 
                            if(substr($partes[0], -1) == ',')
                                $partes[0] = substr($partes[0], 0, -1); 

                            $verdadero=validate_callsign(trim($partes[0]));

                            $cont = $cont + strlen(trim($partes[0]));
                            break;

                        case "name lightvessel":

                            $partes = explode(" ", trim(substr($frasealumno,$cont, 6 )));

                            //Si detras tiene una coma la quita 
                            if(substr($partes[0], -1) == ',')
                                $partes[0] = substr($partes[0], 0, -1); 

                            $verdadero=validate_namelightvessel(trim($partes[0]));

                            $cont = $cont + strlen(trim($partes[0]));
                            break;

                        case "waypoint":

                            $partes = explode(" ", trim(substr($frasealumno,$cont, 3 )));

                            //Si detras tiene una coma la quita 
                            if(substr($partes[0], -1) == ',')
                                $partes[0] = substr($partes[0], 0, -1); 

                            $verdadero=validate_waypoint(trim($partes[0]));

                            $cont = $cont + strlen(trim($partes[0]));
                            break;

                        case "type":

                            $partes = explode(" ", trim(substr($frasealumno,$cont, 15 )));
                            $result = FALSE;

                            //Primero comprueba las partes por separado
                            foreach ($partes as $parte) 
                            {   
                                if(!$result)
                                {
                                    //Si detras tiene una coma la quita 
                                    if(substr($parte, -1) == ',')
                                        $parte = substr($parte, 0, -1); 

                                    $verdadero=validate_type(trim($parte));
                                    if($verdadero)
                                    {   
                                        $result = TRUE;
                                        $cont = $cont + strlen(trim($parte));
                                    }
                                }
                            }

                            if(!$result) //Y luego las junta
                            {
                                //Concatena las dos partes con un espacio entre medio
                                $result = $partes[0]." ".$partes[1];
                                //Si detras tiene una coma la quita 
                                if(substr($result, -1) == ',')
                                    $result = substr($result, 0, -1); 

                                $verdadero=validate_type(trim($result));

                                $cont = $cont + strlen(trim($result));
                            }
                            break;

                        case "fromport":

                            $frase = trim(substr($frasealumno,$cont, 13 ));

                            //Si detras tiene una coma la quita 
                            if(substr($frase, -1) == ',')
                                $frase = substr($frase, 0, -1); 

                            $verdadero=validate_fromport(trim($frase));

                            $cont = $cont + strlen(trim($frase));
                            break;

                        case "object":

                            $partes = explode(" ", trim(substr($frasealumno,$cont, 24 )));
                            $result = FALSE;

                            //Primero comprueba las partes por separado
                            foreach ($partes as $parte) 
                            {   
                                if(!$result)
                                {
                                    //Si detras tiene una coma la quita 
                                    if(substr($parte, -1) == ',')
                                        $parte = substr($parte, 0, -1); 

                                    $verdadero=validate_object(trim($parte));
                                    if($verdadero)
                                    {   
                                        $result = TRUE;
                                        $cont = $cont + strlen(trim($parte));
                                    }
                                }
                            }

                            if(!$result) //Y luego las junta
                            {
                                //Concatena las dos partes con un espacio entre medio
                                $result = $partes[0]." ".$partes[1];

                                 //Si detras tiene una coma la quita 
                                if(substr($result, -1) == ',')
                                    $result = substr($result, 0, -1); 

                                $verdadero=validate_object(trim($result));

                                $cont = $cont + strlen(trim($result));
                            }
                            break;

                        case "location aboard":

                            $partes = explode(" ", trim(substr($frasealumno,$cont, 24 )));

                            $aux = FALSE;

                            //Primero comprueba las partes por separado
                            foreach ($partes as $parte) 
                            {   
                                if(!$aux)
                                {
                                    //Si detras tiene una coma la quita 
                                    if(substr($parte, -1) == ',')
                                        $parte = substr($parte, 0, -1); 

                                    $verdadero=validate_locationaboard(trim($parte));
                                    if($verdadero)
                                    {   
                                        $aux = TRUE;
                                        $cont = $cont + strlen(trim($parte));
                                    }
                                }
                            }

                            if(!$aux) //Y luego las junta
                            {
                                //Concatena las dos partes con un espacio entre medio
                                $result = $partes[0]." ".$partes[1];

                                 //Si detras tiene una coma la quita 
                                if(substr($result, -1) == ',')
                                    $result = substr($result, 0, -1); 

                                $verdadero=validate_locationaboard(trim($result));

                                if($verdadero)
                                    {   
                                        $aux = TRUE;
                                        $cont = $cont + strlen(trim($result));
                                    }
                            }
                            
                            if(!$aux) //Y luego las junta
                            {
                                //Concatena las dos partes con un espacio entre medio
                                $result = $partes[0]." ".$partes[1]." ".$partes[2];

                                 //Si detras tiene una coma la quita 
                                if(substr($result, -1) == ',')
                                    $result = substr($result, 0, -1); 

                                $verdadero=validate_locationaboard(trim($result));

                                $cont = $cont + strlen(trim($result));
                            }
                            break;


                        default:
                            $cont = $cont + strlen($porciones[$i]);
                    }

                   
                }
            }
        }

        return $verdadero;
    }
}


//end application/helpers/ayuda_helper.php