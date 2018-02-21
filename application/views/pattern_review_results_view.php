

 <div class="containermenu">

  <ol class="breadcrumb">
    <li><a href="<?php echo site_url();?>main/">Menu</a></li>
    <li><a href="<?php echo site_url();?>result">Mode Menu Results</a></li>
    <li><a href="<?php echo site_url();?>result/training_mode">Level Results Menu</a></li>
    <li><a href="<?php echo site_url();?>result/pattern_level_results">Training Results Pattern Level</a></li>
    <li class="active">Test Pattern Review</li>
  </ol>

  <div class="dq-test-outer-wrapper">

    <div class="dq-test-title">Results Pattern level:
      <?php 
          if(isset($category)) 
          {
            echo $category['number']; 
            echo $category['description'];
          }
        ?>
    </div>
    <div id="testContent">

      <div class="question-section">

        <h2 class= "center">Score Obtained:  </h2>
        <h1 class= "with-score center"><span><?php echo $correct ?> / <?php echo $num_questions?></span></h1>  


        <!--///////////////////////////////  DISORDERED  ///////////////////////////////////-->
        <?php $num = 1; ?>
        <?php if($num_disordered) {  ?>
          <?php for ($x=0; $x <$num_disordered; $x++) {  ?>

              <h4><?=$num?>. <?=$enun_disordered?></h4> <!-- Muestra el numero y el enunciado de las preguntas desordenadas-->
              <?php $num++; ?>
              <?php if($results_disordered[$x]->correct == 0){ ?> 

                <p><?=$results_disordered[$x]->disordered?></p> 
                <p><span class="alert alert-danger" style="padding: 0%;">Your answer: <?=$results_disordered[$x]->answer?></span></p>
                <p><span class="alert alert-info" style="padding: 0%;">Correct answer: <?=$results_disordered[$x]->ordered?></span></p>
                 
              <?php } else { ?>
                <p><?=$results_disordered[$x]->disordered?></p> 
                <p><span class="alert alert-success" style="padding: 0%;">Your answer is correct: <?=$results_disordered[$x]->answer?></span></p>
          <?php }} ?>
        <?php } ?>


        <!--/////////////////////////////////   TRUE-FALSE    /////////////////////////////////-->

        <?php  if($num_truefalse) {  ?>
          <?php for ($x=0; $x <$num_truefalse; $x++) {  ?>

              <h4><?=$num?>. <?=$enun_tf?></h4> <!-- Muestra el numero y el enunciado de las preguntas true/false-->
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
            <?php }} ?>
        <?php } ?>


        <!--///////////////////////////////////   AUDIO-WRITE    ///////////////////////////////-->
        <?php  if($num_audiowrite) {  ?>
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

        <br><br>

        <input class="btn btn-primary btn-lg" type="submit" value="Go back to results" onclick="location.href='<?php echo site_url('result/pattern_level_results');?>/'" >   

      </div> <!-- question-section" -->
    </div> <!-- testContent -->
  </div> <!-- dq-test-outer-wrapper -->

</div> <!-- containermenu -->