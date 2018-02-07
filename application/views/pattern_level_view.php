<script>

$(document).ready(function()
{
  $('[data-toggle="tooltip"]').tooltip(); 

  document.getElementById("myForm").reset();
  $("#login").click(function()
  {
    $(".login-section,.instruction-section").remove();
    $(".question-section").css("display","inline-block");
  }
  );
  
}); 

//Con esta funcion evitamos que el alumno pueda darle al boton de atras 
function nobackbutton(){
   window.location.hash="no-back-button";
   window.location.hash="Again-No-back-button" //chrome
   window.onhashchange=function(){window.location.hash="no-back-button";}
}

</script>

<body onload="nobackbutton();">


<div class="containermenu">

  <ol class="breadcrumb">
    <li><a href="<?php echo site_url();?>main/">Menu</a></li>
    <li><a href="<?php echo site_url();?>chat/">Mode Menu</a></li>
    <li><a href="<?php echo site_url();?>chat/select_level">Level Menu</a></li>
    <li class="active">Pattern level test</li>
  </ol>

  <div class="dq-test-outer-wrapper">
    <div class="dq-test-title">Training test: <?php echo $category_name['number']?> <? echo $category_name['description'] ?></div>
    
    <div id="testContent">
     
      <div class="half-width  login-section" style="margin:60px 0px;">
        <input type="button" id="login" value="Start" class="btn btn-primary btn-lg"" />
      </div>
   
      <div class="half-width instruction-section" style="margin:20px 0px;background:#f0f0f0;border-radius:5px;">
       
        <div style="font-size: 20px;font-weight:bold;margin-bottom: 10px;text-decoration:underline;">Instructions</div>
        <div id="testMeta" class="left">Number of questions : <?php echo $num_preguntas?></div>
        <div id="instruction" class="alert alert-danger">Do not refresh the page or press the backwards button in order to not lose the results.</div>
        <div id="instruction" class="alert alert-danger">Character size is programme sensitive.</div>

      </div>

      <div class="question-section display-none">

        <form autocomplete="off" id="myForm" method="post" action="<?php echo site_url();?>chat/result_display_pattern">

          <?php $num = 0;?>


          <!--///////////////////////////////  DISORDERED  ///////////////////////////////////-->

          <?php foreach($disordered_questions as $row) { ?> <!-- Muestra todas las preguntas del tipo desordenadas-->
         
              <?php $num = $num +1; ?> <!-- Esto es para que se muestre el numero empezando en 1 y no en 0 -->

              <h4><b><?=$num?>. <?=$enun_disordered?></b></h4> <!-- Muestra el numero y el enunciado de las preguntas desordenadas-->

              
              <p class="option question-tbl"> <?=$row->disordered?></p> <!-- Muestra la frase desordenada-->
              
              <input autocomplete="off" class="col-xs-12" type="input" required name="quizid<?=$num?>"><br>

              <input type="hidden" value="<?=$row->id?>" name="id<?=$num?>">
              <input type="hidden" value="disordered" name="type<?=$num?>"> <!-- Sirve para indicar el tipo de pregunta cuando se va a corregir-->
              <input type="hidden" value="<?=$row->id_category?>" name="categoria">
          <?php } ?>
          

          <!--/////////////////////////////////   TRUE-FALSE    /////////////////////////////////-->


          <?php foreach($tf_questions as $row) { ?>  <!-- Muestra todas las preguntas del tipo true/false -->

            <!-- Esto ordena de forma aleatoria la frase correcta y la incorrecta 
                   para que no se muestren siempre en el mismo orden -->
            <?php $ans_array = array($row->true_statement, $row->false_statement);
            shuffle($ans_array); ?>

            <?php $num = $num +1; ?> <!-- Esto es para que se muestre el numero empezando en 1 y no en 0 -->

            <h4><b><?=$num?>. <?=$enun_tf?></b></h4> <!-- Muestra el numero y el enunciado de las preguntas true/false-->
            
            
            <!-- Muestra los dos inputs de tipo radio con la frase correcta e incorrecta-->
            <input  type="radio" name="quizid<?=$num?>" value="<?=htmlspecialchars($ans_array[0], ENT_QUOTES)?>" required>  <?=$ans_array[0]?><br>
            <input type="radio" name="quizid<?=$num?>" value="<?=htmlspecialchars($ans_array[1], ENT_QUOTES)?>">  <?=$ans_array[1]?><br>
            
            <input type="hidden" value="<?=$row->id_category?>" name="categoria">
            <input type="hidden" value="truefalse" name="type<?=$num?>">   <!-- Sirve para indicar el tipo de pregunta cuando se va a corregir-->
            <input type="hidden" value="<?=$row->id?>" name="id<?=$num?>">
          <?php } ?>


            <!--///////////////////////////////////   AUDIO-WRITE    ///////////////////////////////-->


          <?php foreach($audio_write_questions as $row) { ?> <!-- Muestra todas las preguntas del tipo audio-->
         
              <?php $num = $num +1; ?> <!-- Esto es para que se muestre el numero empezando en 1 y no en 0 -->

              <h4><b><?=$num?>. <?=$enun_audio_write?>:&nbsp;&nbsp;
              <?php $url= site_url()."audio_uploads/".$row->audio; ?>

              <audio controls>
                    <source src="<?=$url?>" type="audio/ogg">
                    <source src="<?=$url?>" type="audio/mpeg">
                        Your browser does not support the audio element.
              </audio>
              </b></h4> 

              <input autocomplete="off" class="col-xs-12" type="input" name="quizid<?=$num?>" required" ><br>

              <input type="hidden" value="<?=$row->id?>" name="id<?=$num?>">
              <input type="hidden" value="audio_write" name="type<?=$num?>"> <!-- Sirve para indicar el tipo de pregunta cuando se va a corregir-->
              <input type="hidden" value="<?=$row->id_category?>" name="categoria">
          <?php } ?>
          

          <input type="hidden" value="<?= $category_id ?>" name="category_id">
          <input type="hidden" value="<?=$num_preguntas?>" name="cantidad">
          <br><br>
          <input type="submit" value="Finish" class="btn btn-primary" data-container="body" data-toggle="tooltip" data-placement="top" title="Finish and correct">
          <input style="margin:15px;" value="Exit" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Exit without saving" onclick="location.href='<?php echo site_url('main/');?>'">

        </form>

      </div>  
    </div> <!-- testContent -->

  </div> <!-- dq-test-outer-wrapper -->
</div> <!-- containermenu -->