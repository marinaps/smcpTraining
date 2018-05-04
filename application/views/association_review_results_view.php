

 <div class="containermenu">

  <ol class="breadcrumb">
    <li><a href="<?php echo site_url();?>main/">Menu</a></li>
    <li><a href="<?php echo site_url();?>result">Mode Menu Results</a></li>
    <li><a href="<?php echo site_url();?>result/training_mode">Level Results Menu</a></li>
    <li><a href="<?php echo site_url();?>result/association_level_results">Training Results Association Level</a></li>
    <li class="active">Test Association Review</li>
  </ol>

  <div class="dq-test-outer-wrapper">
  
    <div class="dq-test-title">Results Association Level: 
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


        <!--///////////////////////////////  QUESTION-ANSWER  ///////////////////////////////////-->

        <?php  if($num_q_a) {  ?>

          <?php for ($x=0; $x <$num_q_a; $x++) {  ?>

              <?php if($results_questions[$x]->correct == 0){ ?> 
                <h4><?=$x+1?>. <?=$enun_q_a?> <?=$results_questions[$x]->statement?> </h4>
               <p>&nbsp;&nbsp;<span class="alert alert-danger" style="padding: 0%;">Your answer: <?=$results_questions[$x]->answer?></span></p>
               
               <p>&nbsp;&nbsp;<span class="alert alert-info" style="padding: 0%;">One of the possible answers is: <?=$correct_answers[$x]['answer']?></span></p>
                 
              <?php } else { ?>
                <p><?=$x+1?>.<?=$results_questions[$x]->statement?></p> 
                <p>&nbsp;&nbsp;<span class="alert alert-success" style="padding: 0%;">Your answer is correct: <?=$results_questions[$x]->answer?></span></p>

           <?php }} ?>
        <?php } ?>
      
        <br><br>

        <input class="btn btn-primary btn-lg" type="submit" value="Go back to results" onclick="location.href='<?php echo site_url('result/association_level_results');?>/'" >   

      </div> <!-- question-section" -->
    </div> <!-- testContent -->
  </div> <!-- dq-test-outer-wrapper -->

</div> <!-- containermenu -->