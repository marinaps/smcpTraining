<script>

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
    <li class="active">Final test</li>
  </ol>

  <div class="dq-test-outer-wrapper">
    <div class="dq-test-title">Results Final test</div>

    <div class="question-section" >
      
      
        <h2 class= "center">Score Obtained:  </h2>
        <h1 class= "with-score center"><span><?php echo $correct ?> / <?php echo $num_questions?></span></h1>  


        <?php $array1= array();?>
        <?php $num = 1; ?>

        <!--///////////////////////////////  DISORDERED  ///////////////////////////////////-->
        <?php if(isset($disordered_questions)) {  ?>
        <?php for ($x=0; $x <$desordenadas; $x++) {  ?>

            <h4><?=$num?>.<?=$enun_disordered?></h4>
            <?php $num++; ?>

            <p><?=$disordered_questions[$x][0]->disordered?></p> <!-- Muestra la frase desordenada-->
   
            <?php if(! $respuestas[$x]->correct){ ?> 

             <p><span class="alert alert-danger" style="padding: 0%;">Your answer: <?=$respuestas[$x]->answer?></span></p>
             <p><span class="alert alert-info" style="padding: 0%;">Correct answer: <?=$disordered_questions[$x][0]->ordered?></span></p>
               
            <?php } else { ?>
              
              <p><span class="alert alert-success" style="padding: 0%;">Your answer is correct: <?=$respuestas[$x]->answer?></span></p>
          
        <?php }}} ?>

        <!--/////////////////////////////////   TRUE-FALSE    /////////////////////////////////-->
        <?php if(isset($truefalse_questions)) {  ?>
         <?php for ($x=0, $y=(0+$desordenadas); $x < $true_false, $y < ($desordenadas + $true_false) ; $x++, $y++) {  ?>

            <h4><?=$num?>. <?=$enun_tf?></h4> <!-- Muestra el numero y el enunciado de las preguntas true/false-->
              <?php $num++; ?>
              <ul>
              <li><?=$truefalse_questions[$x][0]->true_statement?></li>
              <li><?=$truefalse_questions[$x][0]->false_statement?></li>
              </ul>
        
            <?php if(! $respuestas[$y]->correct){ ?> 
              
             <p><span class="alert alert-danger" style="padding: 0%;">Your answer: <?=$respuestas[$y]->answer?></span></p>
             <p><span class="alert alert-info" style="padding: 0%;">Correct answer: <?=$truefalse_questions[$x][0]->true_statement?></span></p>
               
            <?php } else { ?>
              
              <p><span class="alert alert-success" style="padding: 0%;">Your answer is correct: <?=$respuestas[$y]->answer?></span></p>
          
        <?php }}} ?>


        <!--///////////////////////////////////   AUDIO-WRITE    ///////////////////////////////-->
        <?php if(isset($audio)) {  ?>
          <?php for ($x=0, $y = (0 + $desordenadas + $true_false); $x < $audio, $y < $desordenadas + $true_false + $audio; $x++, $y++) {  ?>

              <h4><?=$num?>. <?=$enun_audio_write?>:&nbsp;&nbsp;
              <?php $num++; ?>
              <?php $url= site_url()."audio_uploads/".$audio_questions[$x][0]->audio;?>

              <audio controls>
                    <source src="<?=$url?>" type="audio/ogg">
                    <source src="<?=$url?>" type="audio/mpeg">
                        Your browser does not support the audio element.
              </audio>
              </h4> 

            <?php if(!$respuestas[$y]->correct){ ?> <!-- Si la respuesta no es correcta muestra la respuesta dada y la correcta -->

              <p><span class="alert alert-danger" style="padding: 0%;">Your answer: <?=$respuestas[$y]->answer?></span></p>
              <p><span class="alert alert-info" style="padding: 0%;">Correct answer: <?=$audio_questions[$x][0]->statement?></span></p>
             
               
            <?php } else { ?> <!-- Si la respuesta es correcta se muestra la respuesta dada -->
              
              <p><span class="alert alert-success" style="padding: 0%;">Your answer is correct: <?=$respuestas[$y]->answer?></span></p>   
          <?php }} ?>
        <?php } ?>


        <!--///////////////////////////////  QUESTION-ANSWER  ///////////////////////////////////-->
        <?php  if(isset($question_answer)) {  ?>
        <?php for ($x=0, $y = (0 + $desordenadas + $true_false + $audio); $x < $question_answer, $y < $desordenadas + $true_false + $audio + $question_answer; $x++, $y++) {  ?>

          <p><?=$num?>.<?=$questions[$x][0]->statement?></p> <!-- Muestra la pregunta-->
          <?php $num++; ?>

          <?php if(! $respuestas[$y]->correct){ ?> <!-- Si la respuesta no es correcta muestra la respuesta dada y la correcta -->
            
              <p><span class="alert alert-danger" style="padding: 0%;">Your answer: <?=$respuestas[$y]->answer?></span></p>
              
              <p><span class="alert alert-info" style="padding: 0%;">This is one of the possible answers: 
              <?=$examples_answers[$x]?></span></p>
             
          <?php } else { ?> <!-- Si la respuesta es correcta se muestra la respuesta dada -->
            
              <p><span class="alert alert-success" style="padding: 0%;">Your answer is correct: <?=$respuestas[$y]->answer?></span></p>

           <?php }} ?>
        <?php } ?>

    <input type="hidden" id="marina" value="<?php echo $id_examen?>">

        <br><br>
    <input class="btn btn-primary btn-lg" type="submit" value="Try again!" onclick="location.href='<?php echo site_url('chat/final_test/');?>' " >   
    <input style="margin: 15px;" value="Exit" class="btn btn-danger btn-lg" type="submit" data-toggle="tooltip" data-placement="top" title="Exit without saving" onclick="location.href='<?php echo site_url('main/');?>'">


<!-- PARA EL NUEVO CONTROLADOR DE TRY AGAIN
    <input class="btn btn-primary btn-lg" type="submit" value="Try again!" onclick="location.href='<?php echo site_url('chat/final_test_try_again/');?>/<?php echo $id_examen?>' " >   
    -->
 
   
    </div>
  </div>
</div>
</div>