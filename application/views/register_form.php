
<div class="container">  
  <div class="containermenu">

    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>main/login">Login</a></li>
        <li class="active">Register</li>
    </ol>

    
    <div class="col-lg-6 col-lg-offset-3">
      <div class="form-group">

        <h3>Create your account</h3>

          <div class="text-danger"> <?php echo $this->session->flashdata('flash_message'); ?></div>
          <div class="text-success"> <?php echo $this->session->flashdata('correct'); ?></div>

          <?php echo form_open(site_url().'main/new_user/') ?>

              
                <label>First name</label>
                <div <?php echo (form_error('first_name') == '') ? '' : ' class="form-group has-error"'; ?>>
                <input type="text" class="form-control" id="first_name" name="first_name" 
                       value="<?php echo set_value('first_name') ?>"
                       placeholder="Introduce your first name">
                <div class="text-danger"> <?php echo form_error('first_name') ?></div>

              </div>

              <input type="hidden" name="record" value="yes" />

             
                <label>Last name</label>
                <div <?php echo (form_error('last_name') == '') ? '' : ' class="form-group has-error"'; ?>>
                <input type="text" class="form-control" id="last_name" name="last_name"
                       value="<?php echo set_value('last_name') ?>"
                       placeholder="Introduce your last name">
                <div class="text-danger"> <?php echo form_error('last_name') ?></div>

              </div>

             
                <label>Email</label>
                <div <?php echo (form_error('email') == '') ? '' : ' class="form-group has-error"'; ?>>
                <input type="email" class="form-control" id="email" name="email"
                       value="<?php echo set_value('email') ?>"
                       placeholder="Introduce your email">
                <small id="passwordHelpBlock" class="form-text text-muted">
                  This will be your username to login.
                </small>
                <div class="text-danger"> <?php echo form_error('email') ?></div>

              </div>

             
              <label>Password</label>
              <div <?php echo (form_error('password') == '') ? '' : ' class="form-group has-error"'; ?>>
                <input type="password" class="form-control" id="password" name="password" 
                       placeholder="Introduce your password">
                <div class="text-danger"> <?php echo form_error('password') ?></div>

              </div>
              

              <br/><button type="submit" class="btn btn-primary">Create an account</button>
          <?php echo form_close() ?>
          <p>Don't Have an Account? <a class="text-alert" href="<?php echo site_url();?>main/send">Sign up here</a></p>
           <!-- 
           <a href="<?php echo site_url();?>main/create_user" class="btn btn-lg btn-primary btn-block">Create an account</a>-->
      
      </div> <!-- /.form-group-->
    </div> <!-- /.col-lg-4 col-lg-offset-4-->
  </div>  <!-- /.containermenu-->
  </div> <!-- /.container-->

  </body>
</html>