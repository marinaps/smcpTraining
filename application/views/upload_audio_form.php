
 <div class="containermenu">

      <ol class="breadcrumb">
          <li><a href="<?php echo site_url();?>main">Menu</a></li>
          <li class="active">Upload audio</li>
      </ol>
        
    <div class="col-lg-6 col-lg-offset-3">
        
      <div class="form-group">

        

          <div class="text-danger"> <?php echo $this->session->flashdata('flash_message'); ?></div>
          <div class="text-success"> <?php echo $this->session->flashdata('correct'); ?></div>
          <div class="confirm-div alert-success"></div>



          <form action="<?php echo site_url('audio/upload');?>" method="post" id="form" class="form-horizontal" enctype="multipart/form-data">

            

            <h4 for="email">introduzca la frase:</h4>
            <input  type="text" name="frase" size="70" />
            <span class="help-block"></span>


            <?php if (isset($frase)) {echo $frase;}?> 

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