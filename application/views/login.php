      

  <div class="container">
    <div class="row">
     
      <div class="col-md-7">
        <div class="jumbotron">
          <img  src="<?php echo base_url(); ?>assets/img/smcp_small.png" class="center-block img-responsive" alt="Logo SMCP">
          
          <!--
          <p>
           Application of computer technologies in the evaluation and learning of the Standard Marine Communication Phrases
          </p>
          -->
          <h4>Computer-based Tool for the Standard Marine Communication Phrases Training and Assessment</h4>
        </div> <!-- /.jumbotron -->
      </div> <!-- /.col-md-6 -->

      <div class="col-md-5">
        <div class="form-group col-md-10 col-md-offset-1">
         
          <h2 style="text-align:center; margin-bottom: 50px; margin-top: 50px;">Welcome! Please login</h2>

          
          <?php $fattr = array('class' => 'form-signin');
              echo form_open(site_url().'main/login/', $fattr); ?>
          
          <label>Email</label>
          <div <?php echo (form_error('email') == '') ? '' : ' class="form-group has-error"'; ?>>
            <?php echo form_input(array(
              'name'=>'email', 
              'id'=> 'email', 
              'placeholder'=>'Email', 
              'class'=>'form-control', 
              'value'=> set_value('email'))); ?>
            <div class="text-danger"> <?php echo form_error('email') ?></div>
          </div><br/>
         
          <label>Password</label>
          <div <?php echo (form_error('password') == '') ? '' : ' class="form-group has-error"'; ?>>
            <?php echo form_password(array(
              'name'=>'password', 
              'id'=> 'password', 
              'placeholder'=>'Password', 
              'class'=>'form-control', 
              'value'=> set_value('password'))); ?>
            <div class="text-danger"> <?php echo form_error('password') ?></div>
          </div>
        </div>

        <div class="form-group col-md-10 col-md-offset-1">
            <?php echo form_submit(array('value'=>'Let me in!', 'class'=>'btn btn-primary btn-large')); ?>
            <?php echo form_close(); ?>
             <div class="text-danger"> <?php echo $this->session->flashdata('flash_message'); ?></div>
             <div class="text-success"> <?php echo $this->session->flashdata('correct'); ?></div>
            
            <p><br/>Click <a class="text-danger" href="<?php echo site_url();?>main/forgot">here</a> if you forgot your password.</p>
        </div>
      </div> <!-- /.col-md-6 -->
    </div> <!-- /.row -->
  </div> <!-- /.container-fluid -->

  <script>

  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-90305206-1', 'auto');
  ga('send', 'pageview');

</script>

  </body>
</html>