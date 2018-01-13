
<div class="containermenu">

  <ol class="breadcrumb">
       <li><a href="<?php echo site_url();?>main/">Menu</a></li>
       <li class="active">Categories</li>
  </ol>

  <?php
      $categories = get_base_categories();
  ?>
  
  <div class="col-lg-10 col-lg-offset-1">
    <!--Botón para añadir nueva categoria-->
    <button onclick="add_category()" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i>Add category</button>

    <div class="dq-category-outer-wrapper">
      <div class="dq-category-title">Categories</div>
      <div id="testContent" >

       <div class="category-section">
        <!--Si hay categorias en la BD las muestra con un foreach recursivamente-->
        <?php if(count($categories)>0):?>
            <ul>
              <?php foreach($categories as $cat):?>
                <li><?php echo $cat["number"]." ".$cat["description"];?> 
                    <a onclick="delete_category(<?php echo $cat['id']?>)"><i class='glyphicon glyphicon-trash'></i></a>
                    <a onclick="edit_category(<?php echo $cat['id']?>)"><i class='glyphicon glyphicon-pencil'></i></a>
                </li>
                <?php
                list_tree_cat_id($cat["id"]);
                ?>
              <?php endforeach;?>
            </ul>
          <?php else:?>
            <p class="alert alert-danger">No hay categorias</p>
        <?php endif;?>
        </div>
      </div>


    </div>
  </div>
</div>


<footer class="footer-demo section-dark">
    <div class="container">
        <nav class="pull-left">
         
        </nav>
        <div class="copyright pull-right">
          
        </div>
    </div>
</footer>


<!-- modal form -->
<div id="categoriesmodal" class="modal" aria-labelledby="myModalLabel" aria-hidden="true" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">

          <form id="form" >
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">New Category</h4>
              </div> <!-- end modal-header -->

              <div class="modal-body" id="myModalBody">

                  <!--Este input id es para el update--> 
                  <input type="hidden" class="form-control" id="id" name="id" placeholder="id" type="text"  />
                    
                  <div class="form-group">
                      <label for="number">Number</label>
                      
                      <input class="form-control" id="number" name="number" placeholder="Number of categoy" type="text"  />
                      <span class="help-block"></span>
                  </div> <!-- end form-group -->
                  
                  <div class="form-group">
                      <label for="email">Name</label>
                      <input class="form-control" id="name" name="name" placeholder="Name of category" type="text"/>
                      <span class="help-block"></span>
                  </div> <!-- end form-group -->

                   <div class="form-group">
                      <label for="category_id">Parent Category</label>
                      <select class="form-control" name="category_id" id="category_id">
                          <option value="">-- PARENT CATEGORY --</option>
                          <?php if(count($categories)>0):?>
                            <?php foreach($categories as $cat):?>
                              <option value="<?php echo $cat["id"];?>" ><?php echo $cat["number"]." ".$cat["description"];?>
                                 

                              </option>
                              <?php select_tree_cat_id($cat["id"],1); ?>
                            <?php endforeach;?>
                          <?php endif;?>
                      </select> <!-- end select -->
                    </div> <!-- end form-group -->

                  <div id="alert-msg"></div>
              </div> <!-- end modal-body -->

            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <input class="btn btn-danger" type="button" data-dismiss="modal" value="Cancel" />
            </div> <!-- end modal-footer -->
            
            </form> <!-- end form -->

        </div> <!-- end modal content -->
    </div> <!-- end modal dialog -->
</div> <!-- end modal form -->


<!-- script con las funciones ajax -->
<script type="text/javascript">

  function add_category()
  {
      save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string
      $('#categoriesmodal').modal('show'); // show bootstrap modal
      $('.modal-title').text('Add category'); // Set Title to Bootstrap modal title
  }

  function edit_category(id)
  {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals
      $('.form-group').removeClass('has-error'); // clear error class
      $('.help-block').empty(); // clear error string

       //Ajax Load data from ajax
      $.ajax({
          url : "<?php echo site_url('category/ajax_edit/')?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data)
          {
              $('[name="id"]').val(data[0]['id']);
              $('[name="number"]').val(data[0]['number']);
              $('[name="name"]').val(data[0]['description']);
              $('[name="category_id"]').val(data[0]['id_parent_category']);
              
              $('#categoriesmodal').modal('show'); // show bootstrap modal when complete loaded
              $('.modal-title').text('Edit Category'); // Set title to Bootstrap modal title

          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error get data from ajax');
          }
      });
  }

  function save()
  {
      $('#btnSave').text('saving...'); //change button text
      $('#btnSave').attr('disabled',true); //set button disable 
      var url;

      if(save_method == 'add') {
          url = "<?php echo site_url('category/ajax_add')?>";
      } else {
          url = "<?php echo site_url('category/ajax_update')?>";
      } 

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
                  location.reload();
              }
              else
              {
                  for (var i = 0; i < data.inputerror.length; i++) 
                  {
                      $('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error'); //select parent to select div form-group class and add has-error class
                      $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                  }
              }
              $('#btnSave').text('save'); //change button text
              $('#btnSave').attr('disabled',false); //set button enable 
          },
          error: function (jqXHR, textStatus, errorThrown)
          {
              alert('Error adding / update data');
              $('#btnSave').text('save'); //change button text
              $('#btnSave').attr('disabled',false); //set button enable 

          }
      });
  }

  function delete_category(id)
  {
      if(confirm('Are you sure delete this data?'))
      {
          // ajax delete data to database
          $.ajax({
              url : "<?php echo site_url('category/delete_category')?>/"+id,
              type: "POST",
              dataType: "JSON",
              success: function(data)
              {
                  //if success reload page 
                  alert('Category deleted');
                  location.reload();
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  alert('Error deleting category');
                  location.reload();
              }
          });
      }
  }
</script>

</body>
</html>
