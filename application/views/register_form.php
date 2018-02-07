
<div class="container">  
  <div class="containermenu">

    <ol class="breadcrumb">
        <li><a href="<?php echo site_url();?>main/login">Login</a></li>
        <li class="active">Register</li>
    </ol>

    
    <div class="col-lg-6 col-lg-offset-3">
      <div class="form-group">

        <h2>Register form</h2>

          <div class="text-danger"> <?php echo $this->session->flashdata('flash_message'); ?></div>
          <div class="text-success"> <?php echo $this->session->flashdata('correct'); ?></div>

          <?php 
            echo form_open(site_url().'main/update_user_profile/');
              
            $email = $usuario->email;
            $id = $usuario->id;
            $name = $usuario->first_name;
            $surname = $usuario->last_name;

            echo "<div id=contenido>New name";
            echo "<br><input class='form-control' type=text name=name value='".$name."'>";
         
            echo "<br>";
            echo "New surname";
            echo "<br><input class='form-control' type=text name=surname value='".$surname."'>";
            
            echo "<input class='form-control' type=hidden name=id value='".$id."'>";

            echo "<br>";

            echo "New email";
            echo "<br><input class='form-control' type=text name=email value='".$email."'>";

            echo "<br><br>";
            echo "</div>";
            echo form_submit('modificar', 'Update', "class='btn btn-lg btn-primary btn-block'");
            echo form_close();
            echo "<br>";
           ?>
            
           <a href="<?php echo site_url();?>main/change_password_form" class="btn btn-lg btn-primary btn-block">Change password</a>

      </div> <!-- /.form-group-->
    </div> <!-- /.col-lg-4 col-lg-offset-4-->
  </div>  <!-- /.containermenu-->
  </div> <!-- /.container-->

  </body>
</html>