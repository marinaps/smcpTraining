
     <nav class="navbar navbar-default navbar-fixed-top" id="demo-navbar">
        <div class="container">

            <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>

             <a href="<?php echo site_url();?>main"><img width="200" height="100" src="<?php echo base_url(); ?>assets/img/smcp.png" class="center-block " style= "margin-left: 40px;" alt="SMCP Training Logo"></a>
             
            </div><!-- /.navbar-header -->


        </div><!-- /.container-->
    </nav>  


  <div class="containermenu">
    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>main/login">Login</a></li>
        <li class="active">Reset password</li>
    </ol>
  </div>



<div class="col-lg-4 col-lg-offset-4">
    <h2>Reset your password</h2>
    <h5>Hello <strong><?php echo $firstName; ?></strong>, Please enter your new password below</h5>     
  
    <?php 
    $fattr = array('class' => 'form-signin');
    echo form_open(site_url().'main/reset_password/token/'.$token, $fattr); ?>
    <div class="form-group">
      <?php echo form_password(array('name'=>'password', 'id'=> 'password', 'placeholder'=>'Password', 'class'=>'form-control', 'value' => set_value('password'))); ?>
      <div class="text-danger"> <?php echo form_error('password') ?></div>
    </div>
    
    <div class="form-group">
      <?php echo form_password(array('name'=>'passconf', 'id'=> 'passconf', 'placeholder'=>'Confirm Password', 'class'=>'form-control', 'value'=> set_value('passconf'))); ?>
      <div class="text-danger"> <?php echo form_error('passconf') ?></div>
    </div>
    <?php echo form_hidden('user_id', $user_id);?>
    <?php echo form_submit(array('value'=>'Reset Password', 'class'=>'btn btn-lg btn-primary btn-block')); ?>
    <?php echo form_close(); ?>
    <div class="text-danger"> <?php echo $this->session->flashdata('flash_message'); ?></div>
   
</div>

</body>
</html>