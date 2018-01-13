
  <div class="container">

      <ol class="breadcrumb">
          <li><a href="<?php echo site_url();?>main/login">Login</a></li>
          <li class="active">Forgot password</li>
      </ol>


      <div class="col-lg-4 col-lg-offset-4">
          <h2>Forgot Password</h2>
          <p>Please enter your email address and we'll send you instructions on how to reset your password</p>
          
          <?php $fattr = array('class' => 'form-signin');
               echo form_open(site_url().'main/forgot/', $fattr); ?>
          
          <div class="form-group">
            <?php echo form_input(array(
                'name'=>'email', 
                'id'=> 'email', 
                'placeholder'=>'Email', 
                'class'=>'form-control', 
                'value'=> set_value('email'))); ?>
            <div class="text-danger"> <?php echo form_error('email') ?></div>
            <div class="text-danger"> <?php echo $this->session->flashdata('flash_message'); ?></div>            
          </div>
          <?php echo form_submit(array('value'=>'Submit', 'class'=>'btn btn-lg btn-primary btn-block')); ?>
          <?php echo form_close(); ?>    
      </div>
  </div>

</body>
</html>