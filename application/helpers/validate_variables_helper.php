<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


//si no existe la función validate_restricted la creamos
if(!function_exists('validate_restricted'))
{
    /**
     * Funcion para validar las variables que son restrictivas.
     * Distingue entre mayusculas y minusculas.
     *
     * @return boolean true si la variable es correcta
     *
     * @param string $typevariable con el tipo de variable(nombre de la variable, ex: charted name)
     * @param string $variable con la variable dada por el alumno
     */
    function validate_restricted($typevariable, $variable)
    {
        $ci =& get_instance();

        //obtiene el id de la variable charted name
        $data= array();
        $ci->db->select('id');
        $ci->db->from('type_variable');
        $ci->db->where('variable', $typevariable);
        $query = $ci->db->get();
        $data=$query->row()->id; 

        //se busca si existe la variable $chartedname en la tabla variable y cuyo id corresponta con la variable charted name
        $ci->db->select('*');
        $ci->db->from('variable');
        $ci->db->where('name like BINARY', $variable); //binary lo que hace es que distinga las mayusculas y minusculas
        $ci->db->where('id_type_variable', $data);
        $result = $ci->db->get();

        if($result->num_rows() != 0)
            return TRUE;
        else
            return FALSE;

    }
}

//si no existe la función validate_beaufort la creamos
if(!function_exists('validate_beaufort'))
{
    /**
     * Funcion para validar el force beaufort
     * Numerico 0-12
     * @return boolean true si force beaufort es correcto
     *
     * @param string $beaufort con la variable dada por el alumno
     */
    function validate_beaufort($beaufort)
    {
        if($beaufort < 0 || $beaufort >12)
            return FALSE;
        else 
            return TRUE;
    }
}

//si no existe la función validate_callsign la creamos
if(!function_exists('validate_callsign'))
{
    /**
     * Funcion para validar el distintivo de llamada
     * Alphanumeric (e.g EDBA5)
     * Rango mínimo 4 caracteres, rango máximo 6 caracteres.
     *
     * @return boolean true si call sign es correcto
     *
     * @param string $callsign con la variable dada por el alumno
     */
    function validate_callsign($callsign)
    {
        // ctype_alnum devuelve TRUE si cada caracter de texto es o bien uno letra o un dígito, FALSE de lo contrario.
        if (ctype_alnum($callsign) && strlen($callsign) >=4 && strlen($callsign) <=6) 
            return TRUE;
        else
            return FALSE;
    }
}

//si no existe la función validate_date la creamos
if(!function_exists('validate_date'))
{
    /**
     * Funcion para validar la fecha. Ex: april 18th.
     * Num caracteres max 14(cuando tiene dos cifras el num) y 13(cuando tiene una cifra)
     *
     * @return boolean true si date es correcto
     *
     * @param string $date con la variable dada por el alumno
     */
    function validate_date($date)
    {
        $parts = explode(" ", $date);     

        /* 
            $parts[0] contiene el mes
            $parts[1] contiene el numero
        */ 
        
        //comprueba si al final la fecha tiene una coma(ej october 12th,).
        if(substr($parts[1], -1) == ',')
            $parts[1] = substr($parts[1], 0, -1); //en el caso de que tenga una coma se le quita


        //esto separa el numero ($parts[1]) de la terminacion(st, nd, rd, th)
        if(strlen($parts[1]) == 4)
        {
            //si la cadena tiene 4 caracteres entonces nos quedamos con los dos primeros
            $number = substr($parts[1], 0, 2); 
        }else
        {
            //Si la cadena tiene 3 caracteres entonces nos quedamos con el primero
            $number = substr($parts[1], 0, 1);
        }

        //Array con todos los posibles numeros
        $array_nums = array("1st", "2nd", "3rd", "4th", "5th", "6th", "7th" , "8th", "9th", "10th", "11th",
            "12th", "13th", "14th", "15th", "16th", "17th", "18th", "19th", "20th", "21st", "22nd", "23rd",
            "24th", "25th", "26th", "27th", "28th", "29th", "30th", "31st");

        //Array con todos los posibles meses y cuantos dias tiene cada uno
        $array_months = array("January" => 31, "February" => 29, "March" => 31, "April" =>30, "May" => 31,
                    "June" => 30, "July" => 31, "August" => 31, "September" => 30, "October" => 31,
                    "November" => 30, "December" => 31);

        //si la parte del numero no esta en el array de numeros devuelve FALSE
        if ( ! in_array($parts[1], $array_nums)) {
            echo "en el primero";
            return FALSE;

        }elseif( ! array_key_exists($parts[0], $array_months)) { 
            //si la parte del mes no esta en el array de los meses devuelve FALSE
           //array_key_exists() devuelve TRUE si la key dada existe en el array
            echo "en el segundo";
            return FALSE;

        }elseif ( $number > $array_months[$parts[0]]  ) {
            //si el numero que hemos separado antes de las terminaciones es mayor que el maximo numero de dias que tiene ese mes devuelve FALSE
            echo "en el tercero";
            return FALSE;
        }

        //si no cumple nada de lo anterior entonces devuelve TRUE
        return TRUE;
    }
}

//si no existe la función validate_decimal la creamos
if(!function_exists('validate_decimal'))
{
    /**
     * Funcion para validar los numeros decimales
     * Numeric (e.g. 1213,5 )
     * Rango mínimo 1 dígito y máximo 5 dígitos (6 caracteres)
     * 
     * @return boolean true si decimal es correcto
     *
     * @param string $decimal con la variable dada por el alumno
     */
    function validate_decimal($decimal)
    {
        if($decimal > 0 && $decimal < 9999 && strlen($decimal) <=6 && !strpos($decimal, '.'))
            return TRUE;
        else
            return FALSE;
    }
}

//si no existe la función validate_degrees la creamos
if(!function_exists('validate_degrees'))
{
    /**
     * Funcion para validar los grados
     * Minimo: 3 números (4 caracteres) y máximo: 4 números (5 caracteres)
     * Cantidad máxima: 360º. Ejemplo: 005º y 140,5º
     * 
     * @return boolean true si degrees es correcto
     *
     * @param string $degrees con la variable dada por el alumno
     */
    function validate_degrees($degrees)
    {
        $aux   = 'º';
        $pos_degrees = strpos($degrees, $aux);
       
       //si pos_degrees no tiene el º de los grados devuelve falso
        if ($pos_degrees === FALSE) 
        {  
            return FALSE;
        }
        else
        { 
            //devuelve la cadena sin el ultimo caracter(º).
            $sin_degrees = mb_substr($degrees, 0, -1);  

            //si los grados tienen coma puede llegar solo a 359 grados.
            if(strpos($sin_degrees, ',')) 
            {
                $pattern_1="/^(00[1-9]|0[1-9][0-9]|[1-2][0-9][0-9]|3[0-5][0-9])$/";
                $pattern_2="/^([1-9])$/";

                $parts = explode(",", $sin_degrees);

                if(preg_match($pattern_1, $parts[0]) && preg_match($pattern_2, $parts[1]) )
                    return TRUE;
                return FALSE;

            }
            else //si no tiene coma puede llegar a 360 grados
            {
                $pattern_3="/^(00[1-9]|0[1-9][0-9]|[1-2][0-9][0-9]|3[0-5][0-9]|360)$/";

                //preg_match() devuelve 1 si pattern coincide con el subject dado(en este caso con sin_degrees), 0 si no, o FALSE si ocurrió un error.
                if(preg_match($pattern_3, $sin_degrees))
                    return TRUE;
                return FALSE;
            }
        }        
    }
}

//si no existe la función validate_mmsi la creamos
if(!function_exists('validate_mmsi'))
{
    /**
     * Funcion para validar el MMSI
     * Numerico: 8 numeros siempre
     * 
     * @return boolean true si mmsi es correcto
     *
     * @param string $mmsi con la variable dada por el alumno
     */
    function validate_mmsi($mmsi)
    {
        if (ctype_digit($mmsi) && strlen($mmsi) == 9)
        {
            return TRUE;
        }
        return FALSE;
    }
}

//si no existe la función validate_number la creamos
if(!function_exists('validate_number'))
{
    /**
     * Funcion para validar un numero entero
     * Numerico: maximo 4 caracteres
     * 
     * @return boolean true si number es correcto
     *
     * @param string $number con la variable dada por el alumno
     */
    function validate_number($number)
    {
        if (ctype_digit($number) && strlen($number) <= 4)
        {
            return TRUE;
        }
        return FALSE;
    }
}

//si no existe la función validate_position la creamos
if(!function_exists('validate_position'))
{
    /**
     * Funcion para validar la posicion
     * 2 dígitos º + 4 dígitos ’ + 4 dígitos ’’ N + 3 dígitos º + 4 dígitos’+ 4 dígitos’’ W 
     * 
     * @return boolean true si position es correcto
     *
     * @param string $position con la variable dada por el alumno
     */
    function validate_position($latitud, $longitud)
    {
        //guarda el punto cardinal del final(en este caso N o S)
        $cardinal_latitud = substr($latitud, -1); 
        //quita al string $latitud el punto cardinal y las dos comillas de los segundos
        $latitud_sincomillas = substr($latitud, 0, -3); 

        //separamos por º para obtener los grados
        //ahora $grados_lat[0] contendra los grados y $grados_lat[1] contendra el resto del string
        $grados_lat = explode("º", $latitud);

        //separamos por ' para obtener los minutos
        //el if esta para diferenciar los diferentes tipos de comas
        if (strpos($grados_lat[1], "'") === false) 
            $minutos_lat = explode("’", $grados_lat[1]);
        else
            $minutos_lat = explode("'", $grados_lat[1]);

        //obtenemos los segundos
        $segundos_lat = $minutos_lat[1];

        //comprueba que el punto cardinal sea N o S, de lo contrario devolvera FALSE
        if(strcmp($cardinal_latitud, "N") !== 0 && strcmp($cardinal_latitud, "S") !== 0)   
        {
            return FALSE;
        }  

        if( $grados_lat[0] < 0 || $grados_lat[0] > 90)
        {
            return FALSE;
        }

        if( $minutos_lat[0] < 0 || $minutos_lat[0] > 60)
        {
            return FALSE;
        }

        if( $segundos_lat < 0 || $segundos_lat > 60)
        {
            return FALSE;
        }

        //guarda el punto cardinal del final 
        $cardinal_longitud = substr($longitud, -1); 

        //quita al string $latitud el punto cardinal y las dos comillas de los segundos
        $longitud_sincomillas = substr($longitud, 0, -3); 

        //separamos por º para obtener los grados
        $grados_lon = explode("º", $longitud);

        //separamos por ' para obtener los minutos
        //el if esta para diferenciar los diferentes tipos de comas
        if (strpos($grados_lon[1], "'") === false) 
            $minutos_lon = explode("’", $grados_lon[1]);
        else
            $minutos_lon = explode("'", $grados_lon[1]);

        //obtenemos los segundos
        $segundos_lon = $minutos_lon[1];

        if(strcmp($cardinal_longitud, "E") !== 0 && strcmp($cardinal_longitud, "W") !== 0) 
        {
             return FALSE;
        }  
        
        //comprueba que los grados esten entre 0 y 360
        //ademas que tenga 3 cifras(ej: 005º)
        //y que no contenga decimales(que no tenga ninguna coma ",")
        if( $grados_lon[0] < 0 || $grados_lon[0] > 360 || strlen($grados_lon[0]) != 3 || strpos($grados_lon[0], ","))
        {
            return FALSE;
        }

        if( $minutos_lon[0] < 0 || $minutos_lon[0] > 60)
        {
            return FALSE;
        }

        if( $segundos_lon < 0 || $segundos_lon > 60)
        {
            return FALSE;
        }

        //si no cumple ninguna de las sentencias anteriores entonces la posicion sera correcta y se devolvera TRUE
        return TRUE;
    }
}

//si no existe la función validate_pressure la creamos
if(!function_exists('validate_pressure'))
{
    /**
     * Funcion para validar pressure
     * Numerico: maximo 4 caracteres. Desde 0 1300
     * 
     * @return boolean true si pressure es correcto
     *
     * @param string $pressure con la variable dada por el alumno
     */
    function validate_pressure($pressure)
    {
        if ($pressure >= 0 && $pressure <= 1300 && ctype_digit($pressure))
        {
            return TRUE;
        }
        return FALSE;
    }
}

//si no existe la función validate_pressure la creamos
if(!function_exists('validate_pressure'))
{
    /**
     * Funcion para validar pressure
     * Numerico: maximo 4 caracteres. Desde 0 1300
     * 
     * @return boolean true si pressure es correcto
     *
     * @param string $pressure con la variable dada por el alumno
     */
    function validate_pressure($pressure)
    {
        if ($pressure >= 0 && $pressure <= 1300 && ctype_digit($pressure))
        {
            return TRUE;
        }
        return FALSE;
    }
}

//si no existe la función validate_speed la creamos
if(!function_exists('validate_speed'))
{
    /**
     * Funcion para validar la velocidad
     * Numerico: maximo 4 caracteres. Máximo : 35-40 nudos. 
     * 
     * @return boolean true si speed es correcto
     *
     * @param string $speed con la variable dada por el alumno
     */
    function validate_speed($speed)
    {
        //strpos evita que se introduzca una velocidad con un punto en vez de una coma
        if ($speed < 0 || $speed > 40 || strpos($speed, '.'))
        {
            return FALSE;
        }
        return TRUE;
    }
}

//si no existe la función validate_hours la creamos
if(!function_exists('validate_time'))
{
    /**
     * Funcion para validar una hora en formato: hhmm. Desde 0000 hours hasta 2359 
     *  
     * @return boolean true si la hora es correcta
     *
     * @param string $hours con la variable dada por el alumno
     */
    function validate_time($hours)
    {
        $pattern="/^([0-1][0-9]|[2][0-3])([0-5][0-9])$/";

        //preg_match() devuelve 1 si pattern coincide con el subject dado(en este caso con time), 0 si no, o FALSE si ocurrió un error.
        if(preg_match($pattern,$hours))
            return TRUE;
        return FALSE;
    }
}

//si no existe la función validate_vhfchannel la creamos
if(!function_exists('validate_vhfchannel'))
{
    /**
     * Funcion para validar el vhf channel
     * Numerico: maximo 2 caracteres. Desde 1 a 99
     *  
     * @return boolean true si la hora es correcta
     *
     * @param string $hours con la variable dada por el alumno
     */
    function validate_vhfchannel($vhfchannel)
    {
        if (is_numeric($vhfchannel) && strlen($vhfchannel) <= 2 && $vhfchannel != 0)
        {
            return TRUE;
        }
        return FALSE;
    }
}


//end application/helpers/ayuda_helper.php