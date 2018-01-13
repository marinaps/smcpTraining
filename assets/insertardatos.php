<?php


$link = mysqli_connect("localhost","root","root");
mysqli_select_db($link, "user-registration");


   $nombre = $_POST['nombre'];
   
    
    $i = 0;
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
    foreach($nombre as $n) {  

       if( mysqli_query($link, 'INSERT INTO answer (answer) VALUES("'.$nombre[0].'")'))
       		echo "bien hecho";
       	else
       		echo "han ocurrido fallos";
        $i++;
    }


 
?>