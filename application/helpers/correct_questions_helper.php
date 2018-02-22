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
            $is_correct = TRUE;
            $entry = array(
                'answer' => $post,
                'correct' => TRUE
                );
        }else{
            $is_correct = FALSE;
            $entry = array(
                'answer' => $post,
                'correct' => FALSE
                );
        }
        //actualiza un entry con la respuesta y si es correcta o no
        $ci->chat->create_entry($id_exam, $id, $entry, 2);

        return $is_correct;
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
            $is_correct = TRUE;
            $entry = array(
                'answer' => $post,
                'correct' => TRUE
                );
        }else{
            $is_correct = FALSE;
            $entry = array(
                'answer' => $post,
                'correct' => FALSE
                );
        }

        //actualiza un entry con la respuesta y si es correcta o no
        $ci->chat->create_entry($id_exam, $id, $entry, 3);

        return $is_correct;
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
        $correct_answer = $ci->chat->correct_audio_write($id); 

        //comprueba si la respuesta dada es igual a la correcta
        if(strcasecmp(strtolower($post), strtolower($correct_answer->statement)) == 0 )
        {
            $is_correct = TRUE;
            $entry = array(
                'answer' => $post,
                'correct' => TRUE
                );
        }else{
            $is_correct = FALSE;
            $entry = array(
                'answer' => $post,
                'correct' => FALSE
                );
        }

        //crea la entry con la respuesta y si es o no correcta
        $ci->chat->create_entry($id_exam, $id, $entry, 4); 

        return $is_correct;
    }
}

//si no existe la función correct_variablequestions la creamos
if(!function_exists('correct_variablequestions'))
{
    /**
     * Funcion para corregir una frase con variables
     *  
     * @return boolean true si la respuesta es correcta
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
        $is_correct=FALSE;

        //va iterando por cada respuesta correcta que tiene la pregunta
        foreach ($correct_answers as $row)
        {   
            if( ! $is_correct)
            {
                //se comprueba si la respuesta es correcta llamando a la funcion validar_frase
                $is_correct = validar_frase($respuesta_dada, $row['answer']);
            }
        }

        $entry = array(
                'answer' => $respuesta_dada,
                'correct' => $is_correct
                );

        //crea la entry con la respuesta y si es o no correcta
        $ci->chat->create_entry($id_exam, $id, $entry, 1);

        return $is_correct;
    }
}


//si no existe la función validar_frase la creamos
if(!function_exists('validar_frase'))
{
    /**
     * Funcion para validar una frase
     *  
     * @return boolean true si la frase es correcta
     *
     * @param string $frasealumno con la frase dada
     * @param string $frasecorrecta con la frase correcta
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
                //si no son iguales entonces la respuesta es una respuesta incorrecta y se devuelve FALSE
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
            $is_correct = TRUE;

            //Se va iterando por cada porcion que hemos dividio la frase
            for ($i = 0; $i < $resultado && $is_correct; $i++) 
            {   
                //Si es una parte PAR entonces se trata de una parte que no tiene variables y entonces entra en el if
                if($i%2==0)
                {
                    /* //PRUEBAS
                    echo "resultado 1: ".$is_correct;
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
                        $is_correct = FALSE;
                    }
                    /*
                    echo strncmp(trim($porciones[$i]), trim(substr($frasealumno,$cont, $long[$i] )),$long[$i]);
                    echo "<br>";
                    echo "resultado 2: ".$is_correct;
                    echo "<br>"; */

                    //al final sumamos al contador la longitud de la parte que hemos validado.
                    $cont = $cont + $long[$i]; 
                }
                else 
                {  //si es una parte IMPAR indica que es una parte que contiene una variables y entonces entra enel else.

                    //la porcion contendra el nombre de la variables que se va a evaluar, por lo tanto se hace un switch para ver de que variable se trata.
                    switch ($porciones[$i]) 
                    {
                        case "atposition": 

                            //cogemos la parte del string de la frase del alumno que corresponde con un limite de 14 caracteres, ya que de las respuestas posibles el maximo numero de caracteres es de 14.

                            //trim —> Elimina espacio en blanco (u otro tipo de caracteres) del inicio y el final de la cadena

                            //se divide el string por cada espacio en blanco que encuentre. 

                            /*En el caso de que sea cape paloma(11 caracteres), como cogemos 14 caracteres explode nos lo dividiria en 3, pero solo nos quedariamos con las dos primeras, las que corresponden a cape y paloma.*/
                            $partes = explode(" ", trim(substr($frasealumno, $cont, 14 )));

                            //si al final tiene una coma la quita 
                            if(substr($partes[1], -1) == ',')
                                $partes[1] = substr($partes[1], 0, -1); 

                            //concatena las dos partes con un espacio entre medio
                            $result = $partes[0]." ".$partes[1];

                            //se envia a la funcion de validar y esta nos devuelve TRUE o FALSE dependiendo de si es correcta o no.
                            $is_correct=validate_restricted($porciones[$i], trim($result));

                            //al final sumamos al contador la longitud de la parte que hemos validado.
                            $cont = $cont + strlen(trim($result));
                            break;

                        case "beaufort":
            
                            //Cogemos la parte del string de la frase del alumno que corresponde con un limite de 2 caracteres, ya que beaufort son siempre 2 caracteres(de 0-12 es correcto).
                            $partes = explode(" ", substr($frasealumno, $cont, 2 ));

                            /* Puede ser que la frase tenga una coma detras y que el numero sea de una cifra
                              por lo tanto con esto vemos si hay una coma al final y si la hay se coge solo el numero  */
                            if(substr($partes[0], -1) == ',')
                                $partes[0] = substr($partes[0], 0, -1); 

                            $is_correct=validate_beaufort(trim($partes[0]));

                            $cont = $cont + strlen(trim($partes[0]));
                            break;

                        case "call sign":

                            $partes = explode(" ", trim(substr($frasealumno,$cont, 6 )));

                            //Si detras tiene una coma la quita 
                            if(substr($partes[0], -1) == ',')
                                $partes[0] = substr($partes[0], 0, -1); 

                            $is_correct=validate_callsign(trim($partes[0]));

                            $cont = $cont + strlen(trim($partes[0]));
                            break;

                        case "cardinal point": 

                            $partes = explode(" ", trim(substr($frasealumno, $cont, 3)));

                            //Si detras tiene una coma la quita 
                            if(substr($partes[0], -1) == ',')
                                $partes[0] = substr($partes[0], 0, -1); 
    
                            $is_correct=validate_restricted($porciones[$i], trim($partes[0]));

                            $cont = $cont + strlen(trim($partes[0]));
                            break;

                        case "charted name":

                            $partes = explode(" ", trim(substr($frasealumno, $cont, 5 )));

                            //Si detras tiene una coma la quita 
                            if(substr($partes[0], -1) == ',')
                                $partes[0] = substr($partes[0], 0, -1); 

                            $is_correct=validate_restricted($porciones[$i], trim($partes[0]));

                            $cont = $cont + strlen(trim($partes[0]));
                            break;

                        case "date":

                            //trim —> Elimina espacio en blanco (u otro tipo de caracteres) del inicio y el final de la cadena
                            /* la fecha mas larga tiene un maximo de 14 caracteres(mes september junto con un numero de dos cifras y el th: september 16th)*/
                            $partes = explode(" ", trim(substr($frasealumno, $cont, 14 )));

                            //Si la ultima parte(la del mes) tiene detras una coma la quita 
                            if(substr($partes[1], -1) == ',')
                                $partes[1] = substr($partes[1], 0, -1); 

                            $is_correct=validate_date(trim(substr($frasealumno,$cont, 14 )));

                            $cont = $cont + strlen(trim($partes[0])) + strlen(trim($partes[1])) + 1;
                            break;

                        case "datum":

                            $partes = explode(" ", trim(substr($frasealumno, $cont, 4)));

                            //Si detras tiene una coma la quita 
                            if(substr($partes[0], -1) == ',')
                                $partes[0] = substr($partes[0], 0, -1); 

                            $is_correct=validate_restricted($porciones[$i], trim($partes[0]));

                            $cont = $cont + strlen(trim($partes[0]));
                            break;

                        case "decimal":

                            $partes = explode(" ", trim(substr($frasealumno,$cont, 6 )));

                            //Si detras tiene una coma la quita 
                            if(substr($partes[0], -1) == ',')
                                $partes[0] = substr($partes[0], 0, -1); 

                            $is_correct=validate_decimal(trim($partes[0]));

                            $cont = $cont + strlen(trim($partes[0]));
                            break;

                        case "degrees":

                            /* Realiza una operación substr() multibyte de forma segura basada en el número de caracteres. 
                            Esto arregla los problemas con los caracteres especiales como los grados(º) */
                            $partes = explode(" ", trim(mb_substr($frasealumno, $cont, 6)));

                            //Si detras tiene una coma la quita 
                            if(mb_substr($partes[0], -1) == ',')
                                $partes[0] = mb_substr($partes[0], 0, -1); 

                            $is_correct=validate_degrees(trim($partes[0]));

                            $cont = $cont + strlen(trim($partes[0]));
                            break;

                        case "flag state":

                            $partes = explode(" ", trim(substr($frasealumno, $cont, 6)));

                            //Si detras tiene una coma la quita 
                            if(substr($partes[0], -1) == ',')
                                $partes[0] = substr($partes[0], 0, -1); 

                            $is_correct=validate_restricted($porciones[$i], trim($partes[0]));

                            $cont = $cont + strlen(trim($partes[0]));
                            break;

                        case "fromrefpoint":

                            $partes = explode(" ", trim(substr($frasealumno, $cont, 6)));

                            //Si detras tiene una coma la quita 
                            if(substr($partes[0], -1) == ',')
                                $partes[0] = substr($partes[0], 0, -1); 

                            $is_correct=validate_restricted($porciones[$i], trim($partes[0]));

                            $cont = $cont + strlen(trim($partes[0]));
                            break;

                        case "location aboard":

                            $partes = explode(" ", trim(substr($frasealumno, $cont, 17 )));

                            $aux = FALSE;

                            //Como pueden ser una dos o tres palabras, se va comprobando por partes

                            //se comprueba si se trata solo de una palabra 
                            if(!$aux)
                            {
                                //Si detras tiene una coma la quita 
                                if(substr($partes[0], -1) == ',')
                                    $partes[0] = substr($partes[0], 0, -1); 

                                $is_correct=validate_restricted($porciones[$i], trim($partes[0]));
                                if($is_correct)
                                {   
                                    $aux = TRUE;
                                    $cont = $cont + strlen(trim($partes[0]));
                                }
                            }

                            //se comprueba si son dos
                            if(!$aux) 
                            {
                                //Concatena las dos partes con un espacio entre medio
                                $result = $partes[0]." ".$partes[1];

                                 //Si detras tiene una coma la quita 
                                if(substr($result, -1) == ',')
                                    $result = substr($result, 0, -1); 

                                $is_correct=validate_restricted($porciones[$i], trim($result));

                                if($is_correct)
                                    {   
                                        $aux = TRUE;
                                        $cont = $cont + strlen(trim($result));
                                    }
                            }

                            //se comprueba si son 3
                            if(!$aux) 
                            {
                                //Concatena las dos partes con un espacio entre medio
                                $result = $partes[0]." ".$partes[1]." ".$partes[2];

                                 //Si detras tiene una coma la quita 
                                if(substr($result, -1) == ',')
                                    $result = substr($result, 0, -1); 

                                $is_correct=validate_restricted($porciones[$i], trim($result));

                                $cont = $cont + strlen(trim($result));
                            }
                            break;

                        case "loran": 

                            $partes = explode(" ", trim(substr($frasealumno, $cont, 5)));

                            //Si detras tiene una coma la quita 
                            if(substr($partes[0], -1) == ',')
                                $partes[0] = substr($partes[0], 0, -1); 

                            $is_correct=validate_restricted($porciones[$i], trim($partes[0]));

                            $cont = $cont + strlen(trim($partes[0]));
                            break;

                        case "mark type": 

                            $partes = explode(" ", trim(substr($frasealumno, $cont, 16 )));
                            $aux = FALSE;

                            //Como pueden ser una o dos palabras, se va comprobando por partes

                            //se comprueba si se trata solo de una palabra                             
                            if(!$aux)
                            {
                                //Si detras tiene una coma la quita 
                                if(substr($partes[0], -1) == ',')
                                    $partes[0] = substr($partes[0], 0, -1); 

                                $is_correct=validate_restricted($porciones[$i], trim($partes[0]));
                                if($is_correct)
                                {   
                                    $aux = TRUE;
                                    $cont = $cont + strlen(trim($partes[0]));
                                }
                            }
                            
                            //se comprueba si son dos
                            if(!$aux) 
                            {
                                //Concatena las dos partes con un espacio entre medio
                                $result = $partes[0]." ".$partes[1];

                                 //Si detras tiene una coma la quita 
                                if(substr($result, -1) == ',')
                                    $result = substr($result, 0, -1); 

                                $is_correct=validate_restricted($porciones[$i], trim($result));

                                $cont = $cont + strlen(trim($result));
                            }
                            break;

                        case "meteorological area": 

                            $partes = explode(" ", trim(substr($frasealumno, $cont, 5)));

                            //Si detras tiene una coma la quita 
                            if(substr($partes[0], -1) == ',')
                                $partes[0] = substr($partes[0], 0, -1); 

                            $is_correct=validate_restricted($porciones[$i], trim($partes[0]));

                            $cont = $cont + strlen(trim($partes[0]));
                            break;

                        case "mmsi": 

                            //Es 9 porque el numero de caracteres para el mmsi es siepre de 9
                            $partes = explode(" ", substr($frasealumno, $cont, 9 ));

                            $is_correct=validate_mmsi(trim($partes[0]));

                            $cont = $cont + strlen(trim($partes[0]));
                            break;

                        case "mv name": 

                            $partes = explode(" ", trim(substr($frasealumno,$cont, 8 )));

                            //Si detras tiene una coma la quita 
                            if(substr($partes[0], -1) == ',')
                                $partes[0] = substr($partes[0], 0, -1); 

                            $is_correct=validate_restricted($porciones[$i], trim($partes[0]));

                            $cont = $cont + strlen(trim($partes[0]));
                            break;

                        case "lightvessel name": 

                            $partes = explode(" ", trim(substr($frasealumno,$cont, 6 )));

                            //Si detras tiene una coma la quita 
                            if(substr($partes[0], -1) == ',')
                                $partes[0] = substr($partes[0], 0, -1); 

                            $is_correct=validate_restricted($porciones[$i], trim($partes[0]));

                            $cont = $cont + strlen(trim($partes[0]));
                            break;

                        case "number": 

                            $partes = explode(" ", trim(substr($frasealumno,$cont, 4 )));

                            //Si detras tiene una coma la quita 
                            if(substr($partes[0], -1) == ',')
                                $partes[0] = substr($partes[0], 0, -1); 

                            $is_correct=validate_number(trim($partes[0]));

                            $cont = $cont + strlen(trim($partes[0]));
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

                                    $is_correct=validate_restricted($porciones[$i], trim($parte));
                                    if($is_correct)
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

                                $is_correct = validate_restricted($porciones[$i], trim($result));

                                $cont = $cont + strlen(trim($result));
                            }
                            break;

                        case "port name": 

                            $partes = explode(" ", trim(substr($frasealumno,$cont, 6 )));

                            //Si detras tiene una coma la quita 
                            if(substr($partes[0], -1) == ',')
                                $partes[0] = substr($partes[0], 0, -1); 

                            $is_correct = validate_restricted($porciones[$i], trim($partes[0]));

                            $cont = $cont + strlen(trim($partes[0]));
                            break;

                        case "position":

                            //El maximo numero de caracteres para una posicion es de 32. 
                            //Primero separamos el string por espacios para asegurarnos que no hay caracteres de la siguiente palabra de la frase.
                            
                            $aux = explode(" ", trim(substr($frasealumno,$cont, 39 )));

                            //Una vez hecho esto ya tendremos la cadena con la posicion.
                            //La posicion se divide en dos partes: latitud y longitud, que estan seguidas, asi que para obtener cada parte separamos el string o bien por la N o por la S(norte o sur) que es lo que separa una parte de otra, y nos quedamos con las dos primeras partes(parte[0] y parte[1]).
                            
                            if(strpos($aux[0], 'N'))
                            {
                                $partes = explode("N", $aux[0]);
                            }
                            else
                            {
                                $partes = explode("S", $aux[0]);
                            }
                           
                            //Si la parte 2, la longitud, detras tiene una coma la quita 
                            if(substr($partes[1], -1) == ',')
                                $partes[1] = substr($partes[1], 0, -1); 

                            $is_correct = validate_position(trim($partes[0]), trim($partes[1]));

                            //concatena las dos partes con un espacio entre medio
                            $result = $partes[0]." ".$partes[1];
                            $cont = $cont + strlen(trim($result));
                            break;

                        case "pressure": 

                            $partes = explode(" ", trim(substr($frasealumno,$cont, 4 )));

                            //Si detras tiene una coma la quita 
                            if(substr($partes[0], -1) == ',')
                                $partes[0] = substr($partes[0], 0, -1); 

                            $is_correct = validate_pressure(trim($partes[0]));

                            $cont = $cont + strlen(trim($partes[0]));
                            break;

                        case "search pattern":

                            $partes = explode(" ", trim(substr($frasealumno, $cont, 6)));

                            //Si detras tiene una coma la quita 
                            if(substr($partes[0], -1) == ',')
                                $partes[0] = substr($partes[0], 0, -1); 

                            $is_correct = validate_restricted($porciones[$i], trim($partes[0]));

                            $cont = $cont + strlen(trim($partes[0]));
                            break;

                        case "speed":

                            $partes = explode(" ", trim(substr($frasealumno,$cont, 4 )));

                            //Si detras tiene una coma la quita 
                            if(substr($partes[0], -1) == ',')
                                $partes[0] = substr($partes[0], 0, -1); 

                            $is_correct = validate_speed(trim($partes[0]));

                            $cont = $cont + strlen(trim($partes[0]));
                            break;

                        case "station name":

                            $partes = explode(" ", trim(substr($frasealumno, $cont, 15 )));

                            //si al final tiene una coma la quita 
                            if(substr($partes[1], -1) == ',')
                                $partes[1] = substr($partes[1], 0, -1); 

                            //concatena las dos partes con un espacio entre medio
                            $result = $partes[0]." ".$partes[1];

                            //se envia a la funcion de validar y esta nos devuelve TRUE o FALSE dependiendo de si es correcta o no.
                            $is_correct = validate_restricted($porciones[$i], trim($result));

                            //al final sumamos al contador la longitud de la parte que hemos validado.
                            $cont = $cont + strlen(trim($result));
                            break;

                        case "time":

                            //Se coge la parte del string de la frase del alumno que corresponde con un limite de 4 caracteres, ya que la hora son siempre 4 caracteres. 
                            $is_correct=validate_time(substr($frasealumno, $cont, 4));

                            //Al final sumamos al contador la longitud de la parte que hemos validado.
                            $cont = $cont + strlen(substr($frasealumno, $cont, 4 ));
                            break;

                        case "vhf channel":

                            $partes = explode(" ", trim(substr($frasealumno,$cont, 2 )));

                             //Si detras tiene una coma la quita 
                            if(substr($partes[0], -1) == ',')
                                $partes[0] = substr($partes[0], 0, -1); 

                            $is_correct=validate_vhfchannel(trim($partes[0]));

                            $cont = $cont + strlen(trim($partes[0]));
                            break;

                        case "way point":

                            $partes = explode(" ", trim(substr($frasealumno, $cont, 3 )));

                            $is_correct = validate_restricted($porciones[$i], trim($partes[0]));

                            $cont = $cont + strlen(trim($partes[0]));
                            break;

                        case "weather event name":

                            $partes = explode(" ", trim(substr($frasealumno, $cont, 6)));

                            //Si detras tiene una coma la quita 
                            if(substr($partes[0], -1) == ',')
                                $partes[0] = substr($partes[0], 0, -1); 

                            $is_correct = validate_restricted($porciones[$i], trim($partes[0]));

                            $cont = $cont + strlen(trim($partes[0]));
                            break;


                        default:
                            $cont = $cont + strlen($porciones[$i]);
                    }
                }
            }
        }

        return $is_correct;

    }
}


//end application/helpers/ayuda_helper.php