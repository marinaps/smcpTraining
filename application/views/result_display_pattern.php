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
  
    <div class="dq-test-title">Results Training Pattern: <?php echo $category_name['number']?> <? echo $category_name['description'] ?></div>
    <div id="testContent">

      <div class="question-section">
        

        <h2 class= "center">Score Obtained:  </h2>
        <h1 class= "with-score center"><span><?php echo $correct ?> / <?php echo $num_questions?></span></h1>  

         <?php  
         $var = $_SESSION['contador'];
         $var++;
         $this->session->set_flashdata('contador', $var);
         ?>

        <?php $num = 1; ?>
        <!--///////////////////////////////  DISORDERED  ///////////////////////////////////-->
        <?php if($disordered_questions) {  ?>
        <?php for ($x=0; $x <$desordenadas; $x++) {  ?>

            <h4><?=$num?>. <?=$enun_disordered?></h4> <!-- Muestra el numero y el enunciado de las preguntas desordenadas-->
            <?php $num++; ?>

            <?php if(! $respuestas[$x]->correct){ ?> <!-- Si la respuesta no es correcta muestra la respuesta dada y la correcta -->
                
                <p><?=$disordered_questions[$x][0]->answer?></p> <!-- Muestra la frase desordenada-->

              
                <p>&nbsp;&nbsp;<span class="alert alert-danger" style="padding: 0%;">Your answer: <?=$respuestas[$x]->answer?></span></p>
                <p>&nbsp;&nbsp;<span class="alert alert-info" style="padding: 0%;">Correct answer: <?=$examples_answers[$x]?></span></p>
               
            <?php } else { ?> <!-- Si la respuesta es correcta se muestra la respuesta dada -->
              
                <p>&nbsp;&nbsp;<span class="alert alert-success" style="padding: 0%;">Your answer is correct: <?=$respuestas[$x]->answer?></span></p>
        <?php }}   }?>

        <!--/////////////////////////////////   TRUE-FALSE    /////////////////////////////////-->

        <?php if(isset($truefalse_questions)) {  ?>
         <?php for ($x=0, $y=(0+$desordenadas); $x < $true_false, $y < ($desordenadas + $true_false) ; $x++, $y++) {  ?>

            <h4><?=$num?>. <?=$enun_tf?></h4> <!-- Muestra el numero y el enunciado de las preguntas true/false-->
              <?php $num++; ?>
              <ul>
              <li><?=$truefalse_questions[$x][0]->true_statement?></li>
              <li><?=$truefalse_questions[$x][0]->false_statement?></li>
              </ul>
        
            <?php if(! $respuestas[$y]->correct){ ?> <!-- Si la respuesta no es correcta muestra la respuesta dada y la correcta -->
              
             <p>&nbsp;&nbsp;<span class="alert alert-danger" style="padding: 0%;">Your answer: <?=$respuestas[$y]->answer?></span></p>
             <p>&nbsp;&nbsp;<span class="alert alert-info" style="padding: 0%;">Correct answer: <?=$truefalse_questions[$x][0]->true_statement?></span></p>
               
            <?php } else { ?> <!-- Si la respuesta es correcta se muestra la respuesta dada -->
              
              <p>&nbsp;&nbsp;<span class="alert alert-success" style="padding: 0%;">Your answer is correct: <?=$respuestas[$y]->answer?></span></p>
          
        <?php }}   }?>

        <!--///////////////////////////////////   AUDIO-WRITE    ///////////////////////////////-->
        
        <?php if($audio_questions) {  ?>

          <?php for ($x=0, $y = (0 + $desordenadas + $true_false); $x < $audio, $y < $num_questions; $x++, $y++) {  ?>
            
            <h4><?=$num?>. <?=$enun_audio_write?>:&nbsp;&nbsp;
            <?php $num++; ?>

              <?php $url= site_url()."audio_uploads/".$audio_questions[$x][0]->audio; ?>

              <audio controls>
                    <source src="<?=$url?>" type="audio/ogg">
                    <source src="<?=$url?>" type="audio/mpeg">
                        Your browser does not support the audio element.
              </audio>
              </h4> 

            <?php if(! $respuestas[$y]->correct){ ?> <!-- Si la respuesta no es correcta muestra la respuesta dada y la correcta -->

              <p>&nbsp;&nbsp;<span class="alert alert-danger" style="padding: 0%;">Your answer: <?=$respuestas[$y]->answer?></span></p>
              <p>&nbsp;&nbsp;<span class="alert alert-info" style="padding: 0%;">Correct answer: <?=$audio_questions[$x][0]->statement?></span></p>
             
               
            <?php } else { ?> <!-- Si la respuesta es correcta se muestra la respuesta dada -->
              
              <p>&nbsp;&nbsp;<span class="alert alert-success" style="padding: 0%;">Your answer is correct: <?=$respuestas[$y]->answer?></span></p>   
        <?php }}  }?>

        <br><br>

        <input class="btn btn-primary btn-lg"  type="submit" value="Try again!" onclick="location.href='<?php echo site_url('chat/pattern_level');?>/<?php echo $category?>'" > 
        <input style="margin: 15px;" value="Exit" class="btn btn-danger btn-lg" type="submit" data-toggle="tooltip" data-placement="top" title="Exit without saving" onclick="location.href='<?php echo site_url('main/');?>'">


      </div> <!-- question-section" -->
    </div> <!-- testContent -->
  </div> <!-- dq-test-outer-wrapper -->

 <div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3>Cabecera de la ventana</h3>
           </div>
           <div class="modal-body">
              <h4>Texto de la ventana</h4>
              Mas texto en la ventana.    
       </div>
           <div class="modal-footer">
          <a href="#" data-dismiss="modal" class="btn btn-danger">Cerrar</a>
           </div>
      </div>
   </div>
</div>
</div> <!-- containermenu -->

<!-- Para mostrar modal al cargar la pagina

<script>
   $(document).ready(function()
   {
      $("#mostrarmodal").modal("show");
   });
</script>

-->