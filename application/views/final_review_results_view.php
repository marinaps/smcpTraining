

 <div class="containermenu">

  <ol class="breadcrumb">
    <li><a href="<?php echo site_url();?>main/">Menu</a></li>
    <li><a href="<?php echo site_url();?>result">Mode Menu Results</a></li>
    <li><a href="<?php echo site_url();?>result/final_test_mode">Final Test Results</a></li>
    <li class="active">Final Test</li>
  </ol>


  <div class="dq-test-outer-wrapper">
  
    <div class="dq-test-title">Results Final test</div>
    <div id="testContent">

      <div class="question-section">

        <h2 class= "center">Score Obtained:  </h2>
        <h1 class= "with-score center"><span><?php echo $correct ?> / <?php echo $num_questions?></span></h1>  

         <?php $num = 1; ?>

        <!--///////////////////////////////  DISORDERED  ///////////////////////////////////-->
        <?php if(isset($results_disordered)) {  ?>
        <?php for ($x=0; $x <$num_disordered; $x++) {  ?>

            <!-- Muestra el numero y el enunciado-->
            <h4><?=$num?>.<?=$enun_disordered?></h4>
            <?php $num++; ?>

            <p><?=$results_disordered[$x]->disordered?></p> <!-- Muestra la frase desordenada-->

            <?php if($results_disordered[$x]->correct == 0){ ?>
             <p><span class="alert alert-danger" style="padding: 0%;">Your answer: <?=$results_disordered[$x]->answer?></span></p>
             <p><span class="alert alert-info" style="padding: 0%;">Correct answer: <?=$results_disordered[$x]->ordered?></span></p>
               
            <?php } else { ?>
              <p><span class="alert alert-success" style="padding: 0%;">Your answer is correct: <?=$results_disordered[$x]->answer?></span></p>

        <?php }}} ?>

        <!--/////////////////////////////////   TRUE-FALSE    /////////////////////////////////-->
        <?php if(isset($results_truefalse)) {  ?>
         <?php for ($x=0, $y=(0+$num_disordered); $x < $num_truefalse, $y < ($num_disordered + $num_truefalse) ; $x++, $y++) {  ?>
            <!-- Muestra el numero y el enunciado de las preguntas true/false-->
            <h4><?=$num?>. <?=$enun_tf?></h4> 
              
              <?php $num++; ?>

              <ul>
              <li><?=$results_truefalse[$x]->true_statement?></li>
              <li><?=$results_truefalse[$x]->false_statement?></li>
              </ul>
            
            <?php if($results_truefalse[$x]->correct == 0){ ?> 

              <p><span class="alert alert-danger" style="padding: 0%;">Your answer: <?=$results_truefalse[$x]->answer?></span></p>
              <p><span class="alert alert-info" style="padding: 0%;">Correct answer: <?=$results_truefalse[$x]->true_statement?></span></p>
               
            <?php } else { ?>
          
              <p><span class="alert alert-success" style="padding: 0%;">Your answer is correct: <?=$results_truefalse[$x]->answer?></span></p>

          <?php }}} ?>


          <!--///////////////////////////////////   AUDIO-WRITE    ///////////////////////////////-->
        <?php  if(isset($num_audiowrite)) {  ?>
          <?php for ($x=0; $x < $num_audiowrite; $x++) {  ?>

              <h4><?=$num?>. <?=$enun_audio_write?>:&nbsp;&nbsp;
              <?php $num++; ?>
              <?php $url= site_url()."audio_uploads/".$results_audiowrite[$x]->audio; ?>

              <audio controls>
                    <source src="<?=$url?>" type="audio/ogg">
                    <source src="<?=$url?>" type="audio/mpeg">
                        Your browser does not support the audio element.
              </audio>
              </h4> 

            <?php if(! $results_audiowrite[$x]->correct){ ?> <!-- Si la respuesta no es correcta muestra la respuesta dada y la correcta -->

              <p>&nbsp;&nbsp;<span class="alert alert-danger" style="padding: 0%;">Your answer: <?=$results_audiowrite[$x]->answer?></span></p>
              <p>&nbsp;&nbsp;<span class="alert alert-info" style="padding: 0%;">Correct answer: <?=$results_audiowrite[$x]->statement?></span></p>
             
               
            <?php } else { ?> <!-- Si la respuesta es correcta se muestra la respuesta dada -->
              
              <p>&nbsp;&nbsp;<span class="alert alert-success" style="padding: 0%;">Your answer is correct: <?=$results_audiowrite[$x]->answer?></span></p>   
          <?php }} ?>
        <?php } ?>


        <!--///////////////////////////////  QUESTION-ANSWER  ///////////////////////////////////-->
        <?php if(isset($num_q_a)) {  ?>

          <?php for ($x=0; $x <$num_q_a; $x++) {  ?>

          <h4><?=$num?>. <?=$enun_q_a?> <?=$results_questions[$x]->statement?> </h4>
            <?php $num++; ?>

              <?php if($results_questions[$x]->correct == 0){ ?> 
                
               <p>&nbsp;&nbsp;<span class="alert alert-danger" style="padding: 0%;">Your answer: <?=$results_questions[$x]->answer?></span></p>
               
               <p>&nbsp;&nbsp;<span class="alert alert-info" style="padding: 0%;">One of the possible answers is: <?=$correct_answers[$x]['answer']?></span></p>
                 
              <?php } else { ?>
                <p>&nbsp;&nbsp;<span class="alert alert-success" style="padding: 0%;">Your answer is correct: <?=$results_questions[$x]->answer?></span></p>

           <?php }} ?>
        <?php } ?>

        <br><br>

        <input class="btn btn-primary btn-lg" type="submit" value="Go back to results" onclick="location.href='<?php echo site_url('result/final_test_mode');?>/'" >   

      </div> <!-- question-section" -->
    </div> <!-- testContent -->
  </div> <!-- dq-test-outer-wrapper -->

</div> <!-- containermenu -->