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
    <li><a href="<?php echo site_url();?>chat/select_level">Level Menu</a></li>
    <li class="active">Training test</li>
  </ol>


  <div class="dq-test-outer-wrapper">
  
    <div class="dq-test-title">Results Training Association: <?php echo $category_name['number']?> <? echo $category_name['description'] ?></div>
    <div id="testContent">

      <div class="question-section">
        

        <h2 class= "center">Score Obtained:  </h2>
        <h1 class= "with-score center"><span><?php echo $correct ?> / <?php echo $num_questions?></span></h1>  


        <?php $array1= array();?>

        <!--///////////////////////////////  QUESTION-ANSWER  ///////////////////////////////////-->

        <?php  if(isset($question_answer)) {  ?>

          <?php for ($x=0; $x <$question_answer; $x++) {  ?>

              <p><?=$x+1?>.<?=$questions[$x][0]->statement?></p> <!-- Muestra la pregunta-->
              <?php if(! $respuestas[$x]->correct){ ?> <!-- Si la respuesta no es correcta muestra la respuesta dada y la correcta -->
                
                  <p><span class="alert alert-danger" style="padding: 0%;">Your answer: <?=$respuestas[$x]->answer?></span></p>
                  
                  <p><span class="alert alert-info" style="padding: 0%;">This is one of the possible answers: 
                  <?=$examples_answers[$x]?></span></p>
                 
              <?php } else { ?> <!-- Si la respuesta es correcta se muestra la respuesta dada -->
                
                  <p><span class="alert alert-success" style="padding: 0%;">Your answer is correct: <?=$respuestas[$x]->answer?></span></p>

           <?php }} ?>
        <?php } ?>

        <!--/////////////////////////////////   TRUE-FALSE    /////////////////////////////////-->

        <?php if (isset($true_false)) {  ?>

         <?php for ($x=$desordenadas; $x < ($desordenadas + $true_false); $x++) {  ?>

            <p><?=$x+1?>. <?=$questions[$x][0]->true_statement?></p>
            <p>&nbsp;&nbsp;&nbsp;<?=$questions[$x][0]->false_statement?></p>
            
        
            <?php if(! $respuestas[$x]->correct){ ?> <!-- Si la respuesta no es correcta muestra la respuesta dada y la correcta -->
              
             <p>&nbsp;&nbsp;<span class="alert alert-danger" style="padding: 0%;">Your answer: <?=$respuestas[$x]->answer?></span></p>
             <p>&nbsp;&nbsp;<span class="alert alert-danger" style="padding: 0%;">Correct answer: <?=$questions[$x][0]->true_statement?></span></p>
               
            <?php } else { ?> <!-- Si la respuesta es correcta se muestra la respuesta dada -->
              
              <p>&nbsp;&nbsp;<span class="alert alert-success" style="padding: 0%;">Your answer is correct: <?=$respuestas[$x]->answer?></span></p>
          
          <?php }} ?>
        <?php } ?>

        <!--///////////////////////////////////   AUDIO-WRITE    ///////////////////////////////-->

       <?php if (isset($true_false)) {  ?>

          <?php for ($x=($desordenadas + $true_false); $x < $num_questions; $x++) {  ?>
            
            <h3><?=$x+1?>.&nbsp;
              <?php $url= site_url()."audio_uploads/".$questions[$x][0]->audio; ?>

              <audio controls>
                    <source src="<?=$url?>" type="audio/ogg">
                    <source src="<?=$url?>" type="audio/mpeg">
                        Your browser does not support the audio element.
              </audio>
              </h3> 

            <?php if(! $respuestas[$x]->correct){ ?> <!-- Si la respuesta no es correcta muestra la respuesta dada y la correcta -->

              <p>&nbsp;&nbsp;<span class="alert alert-danger" style="padding: 0%;">Your answer: <?=$respuestas[$x]->answer?></span></p>
              <p>&nbsp;&nbsp;<span class="alert alert-danger" style="padding: 0%;">Correct answer: <?=$questions[$x][0]->statement?></span></p>
             
               
            <?php } else { ?> <!-- Si la respuesta es correcta se muestra la respuesta dada -->
              
              <p>&nbsp;&nbsp;<span class="alert alert-success" style="padding: 0%;">Your answer is correct: <?=$respuestas[$x]->answer?></span></p>   

          <?php }} ?>
        <?php } ?>

        <br><br>

        <input class="btn btn-primary btn-lg"  type="submit" value="Try again!" onclick="location.href='<?php echo site_url('chat/association_level');?>/<?php echo $category?>'" > 
        <input style="margin: 15px;" value="Exit" class="btn btn-danger btn-lg" type="submit" data-toggle="tooltip" data-placement="top" title="Exit without saving" onclick="location.href='<?php echo site_url('main/');?>'">


      </div> <!-- question-section" -->
    </div> <!-- testContent -->
  </div> <!-- dq-test-outer-wrapper -->

</div> <!-- containermenu -->