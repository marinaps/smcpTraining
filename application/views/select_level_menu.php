
  <?php
      $categories = get_base_categories();
      $association = get_categories_with_questions();
      $pattern = get_categories_with_questions_pattern();
  ?>

    <div class="containermenu">

        <ol class="breadcrumb">
             <li><a href="<?php echo site_url();?>main/">Menu</a></li>
             <li><a href="<?php echo site_url();?>chat/">Mode Menu</a></li>
             <li class="active">Level Menu</li>
        </ol>

            
        <div class="col-md-4 text-center margincolum" >

          <div class="menuprincipal" onclick="select_category_pattern()" > 
            <img class="margenimg" src="<?php echo base_url(); ?>assets/img/easy.svg" >

            <h3>Pattern Level</h3>
          </div>  <!-- /menuprincipal -->
                                                                                 
        </div><!-- /.col-md-4 col -->

        <div class="col-md-4 text-center margincolum" >

            <div class="menuprincipal" title="mi_link" onclick="select_category_association()" > 
                <img class="margenimg" src="<?php echo base_url(); ?>assets/img/medium.svg" >
                <a href="#" data-toggle="popover" title="Popover Header" data-content="Some content inside the popover"></a>
                <h3>Association Level</h3>
            </div>  <!-- /menuprincipal -->
                                                                                 
        </div><!-- /.col-md-4 col -->

         <div class="col-md-4 text-center margincolum" >

            <div class="menuprincipal" onclick=""> 
                <img class="margenimg" src="<?php echo base_url(); ?>assets/img/hard.svg">
                <h3>Inter-Association Level</h3>
            </div>  <!-- /menuprincipal -->
                                                                                 
        </div><!-- /.col-md-4 col -->


<!-- modal form: PATTERN-->
<div id="categoriesmodal_pattern" class="modal" aria-labelledby="myModalLabel" aria-hidden="true" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
          <form id="form">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Select Category</h4>
              </div> <!-- end modal-header -->

              <div class="modal-body" id="myModalBody">

                <!--Este input id es para el update--> 
                <input type="hidden" class="form-control" id="id" name="id" placeholder="id" type="text"  />

                <div class="form-group">
                  <select class="form-control" name="category_id_pattern" id="category_id_pattern">
                    <option value="">-- CATEGORY --</option>
                      <?php if(count($categories)>0):?>
                        <?php foreach($categories as $cat):?>

                          <?php if(array_search($cat['id'], $pattern) !== false):?> <!-- Comprueba si la categoria base esta en el array de las categorias que tienen preguntas. Si esta la muestra.-->
                            <option value="<?php echo $cat["id"];?>" ><?php echo $cat["number"]." ".$cat["description"];?>
                              
                            </option>
                            <?php select_tree_cat_id_control($cat["id"],1,$pattern); ?>

                          <?php endif;?>
                        <?php endforeach;?>
                      <?php endif;?>
                  </select> <!-- end select -->
                      
                  <span class="help-block"></span>

                </div> <!-- end form-group -->
                     
                <div id="alert-msg"></div>

              </div> <!-- end modal-body -->

            <div class="modal-footer">
               <button type="button" id="btnSave" onclick="start()" class="btn btn-primary">Select</button>
                <input class="btn btn-danger" type="button" data-dismiss="modal" value="Cancel" />
            </div> <!-- end modal-footer -->
            
          </form> 
        </div> <!-- end modal content -->
    </div> <!-- end modal dialog -->
</div> <!-- end modal form -->


       

<!-- modal form: ASSOCIATION-->
<div id="categoriesmodal_association" class="modal" aria-labelledby="myModalLabel" aria-hidden="true" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
          <form id="form">

              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Select Category</h4>
              </div> <!-- end modal-header -->

              <div class="modal-body" id="myModalBody">

                <!--Este input id es para el update--> 
                <input type="hidden" class="form-control" id="id" name="id" placeholder="id" type="text"  />

                <div class="form-group">
                  <select class="form-control" name="category_id_association" id="category_id_association">
                    <option value="">-- CATEGORY --</option>
                      <?php if(count($categories)>0):?>
                        <?php foreach($categories as $cat):?>

                          <?php if(array_search($cat['id'], $association) !== false):?> <!-- Comprueba si la categoria base esta en el array de las categorias que tienen preguntas. Si esta la muestra.-->
                            <option value="<?php echo $cat["id"];?>" ><?php echo $cat["number"]." ".$cat["description"];?>
                              
                            </option>
                            <?php select_tree_cat_id_control($cat["id"],1,$association); ?>

                          <?php endif;?>
                        <?php endforeach;?>
                      <?php endif;?>
                  </select> <!-- end select -->
                      
                  <span class="help-block"></span>

                </div> <!-- end form-group -->
                     
                <div id="alert-msg"></div>

              </div> <!-- end modal-body -->

            <div class="modal-footer">
               <button type="button" id="btnSave" onclick="start()" class="btn btn-primary">Select</button>
                <input class="btn btn-danger" type="button" data-dismiss="modal" value="Cancel" />
            </div> <!-- end modal-footer -->
            
          </form> 
        </div> <!-- end modal content -->
    </div> <!-- end modal dialog -->
</div> <!-- end modal form -->



    <footer class="footer-demo section-dark">
        <div class="container">
            <nav class="pull-left">
             
            </nav>
            <div class="copyright pull-right">
               <!--  copyright -->
            </div>
        </div>
    </footer>



<!-- script con las funciones ajax -->
<script type="text/javascript">

  var level; //sirve para ver que nivel es

  function select_category_pattern()
  {
      level = 'pattern';
      $('#form')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#categoriesmodal_pattern').modal('show'); // show bootstrap modal
  }

   function select_category_association()
  {
      level = 'association';
      $('#form')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#categoriesmodal_association').modal('show'); // show bootstrap modal
  }




  function start()
  {
      $('#btnSave').attr('disabled',true); //set button disable 
      var url;

      if(level == 'pattern')
        url = '<?php echo site_url('chat/check_category')?>/'+ level;
      else
        url = '<?php echo site_url('chat/check_category')?>/'+level;
     
      // ajax adding data to database
      $.ajax({
          url : url,
          type: "POST",
          data: $('#form').serialize(),
          dataType: "JSON",
          success: function(data)
          {
              if(data.status) //if success close modal and reload page
              {
                  $('#categoriesmodal').modal('hide');
              
                  if(level == 'pattern')
                  {
                    window.location.href = '<?php echo site_url('chat/pattern_level')?>/'+ $('[name="category_id_pattern"]').val(); 
                  }
                  else
                  {
                    window.location.href = '<?php echo site_url('chat/association_level')?>/'+ $('[name="category_id_association"]').val(); 
                  
                  }
              }
              else
              {
                  for (var i = 0; i < data.inputerror.length; i++) 
                  {
                      $('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error'); //select parent to select div form-group class and add has-error class
                      $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                  }
              }
              $('#btnSave').text('Select'); //change button text
              $('#btnSave').attr('disabled',false); //set button enable 
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error selecting data');
              $('#btnSave').attr('disabled',false); //set button enable 

          }
      });
  }


</script>



</body>
</html>