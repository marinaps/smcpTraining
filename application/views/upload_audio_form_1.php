
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



         

            <?php if (isset($frase)) {echo $frase;}?> 

     
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