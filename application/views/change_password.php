

 <div class="container">
  <div class="containermenu">

      <ol class="breadcrumb">
          <li><a href="<?php echo site_url();?>main">Menu</a></li>
          <li><a href="<?php echo site_url();?>main/profile">Profile</a></li>
          <li class="active">Change password</li>
      </ol>

      <div class="col-lg-6 col-lg-offset-3">
          <h3>Change your password</h3>
          <h5>Hello <a class="text-alert" ><?php echo $firstName; ?></a>, Please enter your new password below</h5>      
          <?php 
          $fattr = array('class' => 'form-signin');
          echo form_open(site_url().'main/change_password/'); ?> 

          <div class="form-group">
             <?php echo form_password(array('name'=>'password', 'id'=> 'password', 'placeholder'=>'Password', 'class'=>'form-control', 'value' => set_value('password'))); ?>
             <div class="text-danger"> <?php echo form_error('password') ?></div>
          </div>

          <div class="form-group">
             <?php echo form_password(array('name'=>'passconf', 'id'=> 'passconf', 'placeholder'=>'Confirm Password', 'class'=>'form-control', 'value'=> set_value('passconf'))); ?>
             <div class="text-danger"> <?php echo form_error('passconf') ?></div>
          </div>

          <?php echo form_hidden('user_id', $user_id);?>
          <?php echo form_submit(array('value'=>'Change Password', 'class'=>'btn btn-lg btn-primary btn-block')); ?>
          <?php echo form_close(); ?>

          <div class="text-danger"> <?php echo $this->session->flashdata('flash_message'); ?></div>
          
      </div><!-- /.col-lg-4 col-lg-offset-4-->
  </div><!-- /.containermenu-->
</div><!-- /.container-->


</body>
</html>