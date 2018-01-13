
 <div class="containermenu">

      <ol class="breadcrumb">
          <li><a href="<?php echo site_url();?>main">Menu</a></li>
          <li> <a href="<?php echo site_url();?>question">Question Menu</a></li>
          <li> <a href="<?php echo site_url();?>disorderedquestion">Jumbled phrases</a></li>
          <li class="active">Upload Jumbled phrases</li>
      </ol>
        
    <div class="col-lg-6 col-lg-offset-3">
        
      <div class="form-group">

        <h2>Upload Jumbled phrases</h2>

          <div class="text-danger"> <?php echo $this->session->flashdata('flash_message'); ?></div>
          <div class="text-success"> <?php echo $this->session->flashdata('correct'); ?></div>
          <div class="confirm-div alert-success"></div>

          <?php echo form_open_multipart(site_url().'upload/upload_disordered/'); ?>

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
            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
              <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
              <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="userfile"></span>
              <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
            </div>
            <span class="help-block"></span>
            <div class="text-danger"> <?php echo form_error('userfile') ?></div>
            <div class="text-danger"> <?php echo $error ?></div>

            <div><input type="submit" value="Submit "class='btn btn-lg btn-primary btn-block'"" /></div>

          </form>
        </div> <!-- /.form-group-->
    </div> <!-- /.col-lg-4 col-lg-offset-4-->
  </div> <!-- /.container-->



<script>

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