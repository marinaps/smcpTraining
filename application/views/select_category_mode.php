

 <div class="containermenu">

      <ol class="breadcrumb">
          <li><a href="<?php echo site_url();?>/main">Menu</a></li>
          <li> <a href="<?php echo site_url();?>/chat">Mode Menu</a></li>
          <li> <a href="<?php echo site_url();?>/chat/select_level">Level Menu</a></li>
          <li class="active">Select Category</li>
      </ol>
        
    <div class="col-lg-6 col-lg-offset-3">
      
        <div class="form-group">

              <h2>Select the category you want to train with:</h2>

              <div class="text-danger"> <?php echo $this->session->flashdata('flash_message'); ?></div>
              <div class="text-success"> <?php echo $this->session->flashdata('correct'); ?></div>
              <div class="confirm-div alert-success"></div>
   
              <?php echo form_open_multipart(site_url().'/chat/training_mode/'); ?>
         

              <h4 for="category_id">Category</h4>
               <div <?php echo (form_error('category_id') == '') ? '' : ' class="form-group has-error"'; ?>>
                      <select class="form-control" name="category_id" id="category_id">
                          <option value="">-- SELECT CATEGORY --</option>
                          <?php if(count($arrcategories)>0):?>
                            <?php foreach($arrcategories as $cat):?>
                              <option value="<?php echo $cat["id"];?>" ><?php echo $cat["number"]." ".$cat["description"];?>                              

                              </option>
                              
                            <?php endforeach;?>
                          <?php endif;?>
                      </select> <!-- end select -->
                      <div class="text-danger"> <?php echo form_error('category_id') ?></div>

                    
                      <span class="help-block"></span>
                     



              <div><input type="submit" value="Start" onclick="select('46')" class='btn btn-md btn-primary btn-block'/></div>

              </form>
        </div> <!-- /.form-group-->
    </div> <!-- /.col-lg-4 col-lg-offset-4-->
  </div> <!-- /.container-->



<script>
// assumes you're using jQuery
$(document).ready(function() {
$('.confirm-div').hide();
<?php if($this->session->flashdata('msg')){ ?>
$('.confirm-div').html('<?php echo $this->session->flashdata('msg'); ?>').show();
});
<?php } ?>



function select(id)
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;
    url = "<?php echo site_url('chat/training_mode/46')?>";
    
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {

            if(data.status) //if success close modal and reload ajax table
            {
                alert('holaa');
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
        }
    });
}
</script>



  </body>
</html>