

 <div class="containermenu">

      <ol class="breadcrumb">
          <li><a href="<?php echo site_url();?>main">Menu</a></li>
          <li> <a href="<?php echo site_url();?>question">Question Menu</a></li>
          <li> <a href="<?php echo site_url();?>truefalsequestion">True/false Question</a></li>
          <li class="active">Upload True/false qustions</li>
      </ol>
        
    <div class="col-lg-6 col-lg-offset-3">
      
      <div class="form-group">

        <h2>Upload True/false questions</h2>

        <div class="text-danger"> <?php echo $this->session->flashdata('flash_message'); ?></div>
        <div class="text-success"> <?php echo $this->session->flashdata('correct'); ?></div>
        <div class="confirm-div alert-success"></div>

        <?php echo form_open_multipart(site_url().'upload/upload_truefalse/'); ?>
   

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

              <h4 for="email">Select File:</h4>
              <div <?php echo (form_error('userfile') == '') ? '' : ' class="form-group has-error"'; ?>>
              <input  type="file" name="userfile" size="20" />
              <span class="help-block"></span>
              <div class="text-danger"> <?php echo form_error('userfile') ?></div>

              <div class="text-danger"> <?php echo $error ?></div>
              
              <div><input type="submit" value="Submit "class='btn btn-lg btn-primary btn-block'"" /></div>

        </form>
      </div> <!-- /.form-group-->
    </div> <!-- /.col-lg-4 col-lg-offset-4-->
  </div> <!-- /.container-->


           
<script>
// assumes you're using jQuery
$(document).ready(function() 
{
  $('.confirm-div').hide();
  <?php if($this->session->flashdata('msg')){ ?>
  $('.confirm-div').html('<?php echo $this->session->flashdata('msg'); ?>').show();

<?php } ?>
  });

</script>

  </body>
</html>