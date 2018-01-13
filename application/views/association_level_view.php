
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

    //datatables
    table = $('#table').DataTable({ 

        "bLengthChange": false, //Esto elimina el campo para elegir cuantas filas se muestran. 
        "pageLength": 5,  //Esto limita el numero de filas que se muestran.
        "bFilter": false, //Esto elimina el campo de busqueda.
        "bInfo" : false,  //Esto elimina la informacion que aparece abajo de la cantidad de registros que hay.
        "autoWidth": false,
        //Esto sirve para dar una anchura diferente a cada columna
        "columns": [
            {
                "orderable": true,
                "width": 200,
            }, 
            {
                "orderable": false,
                
            }
        ],

        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('variable/ajax_list_help')?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable

        },
        ],

    });

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
    <li class="active">Association level test</li>
  </ol>

  <div class="dq-test-outer-wrapper">

    <div class="dq-test-title">Training test: <?php echo $category_name['number']?> <? echo $category_name['description'] ?>
        <!-- Boton de ayuda para las variables -->
        <button type="button" class="btn btn-warning pull-right" data-toggle="modal" data-target="#modal_form">Help 
          <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
        </button>
    </div>

    <div id="testContent">
     
      <div class="half-width  login-section" style="margin:60px 0px;">
        <input type="button" id="login" value="Start" class="btn btn-primary btn-lg"" />
      </div>
   
      <div class="half-width instruction-section" style="margin:30px 0px;background:#f0f0f0;border-radius:5px;">
       
        <div style="font-size: 20px;font-weight:bold;margin-bottom: 10px;text-decoration:underline;">Instructions</div>
        <div id="testMeta" class="left">Number of questions : <?php echo $num_preguntas?></div>
        <div id="instruction" class="left alert">Do not refresh the page or press the backwards button in order to not lose the results </div>

      </div>

      <div class="question-section display-none">

        <form autocomplete="off" id="myForm" method="post" action="<?php echo site_url();?>chat/result_display_association">

          <?php $num = 0; ?>


          <!--///////////////////////////////  QUESTION-ANSWER  ///////////////////////////////////-->


          <?php foreach($question_answer as $row) { ?> <!-- Muestra todas las preguntas-->
         
              <?php $num = $num +1; ?> <!-- Esto es para que se muestre el numero empezando en 1 y no en 0 -->
              <h4><?=$num?>. <?=$enun_q_a?> <?=$row->statement?></h4> <!-- Muestra el numero y el enunciado de las preguntas true/false-->
              
              <input autocomplete="off" class="col-xs-12 form-control" type="input" name="quizid<?=$num?>" required size="100"><br>

              <input type="hidden" value="<?=$row->id?>" name="id<?=$num?>">
              <input type="hidden" value="question_answer" name="type<?=$num?>"> <!-- Sirve para indicar el tipo de pregunta cuando se va a corregir-->
              <input type="hidden" value="<?=$row->id_category?>" name="categoria">
          <?php } ?>



          <input type="hidden" value="<?= $category_id ?>" name="exam_category">
          <input type="hidden" value="<?=$num_preguntas?>" name="cantidad">
          <br><br>
          <input type="submit" value="Finish" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Finish and correct">
          <input style="margin: 15px;" value="Exit" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Exit without saving" onclick="location.href='<?php echo site_url('main/');?>'">

        </form>

      </div>  
    </div> <!-- testContent -->

  </div> <!-- dq-test-outer-wrapper -->
</div> <!-- containermenu -->


<!-- Bootstrap modal para añadir nuevos alumnos-->
<div class="modal" id="modal_form" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Help Information</h3>
            </div>
            <div class="modal-body form">
            <p><strong>If you need to use one of these variables, on the right colum are some examples that you must use: </strong></p>
                 <table id="table" class="table table-hover table-bordered colortablas" cellspacing="0" width="100%">
                      <thead>
                          <tr>
                              <th>Variable</th>
                              <th>Examples</th>
                          </tr>
                      </thead>
                      <tbody>
                      </tbody>

                      <tfoot>
                      <tr>
                          <th>Variable</th>
                          <th>Examples</th>
                      </tr>
                      </tfoot>
                  </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

