
    <div class="containermenu">

        <ol class="breadcrumb">
             <li><a href="<?php echo site_url();?>main/">Menu</a></li>
             <li class="active">Mode Menu</li>
        </ol>

            
        <div class="col-md-6 text-center margincolum" >

            <div class="menuprincipal" onclick="location.href='<?php echo site_url();?>chat/select_level'"> 
                <img class="margenimg" src="<?php echo base_url(); ?>assets/img/training_mode.svg">
                <h3>Training Mode</h3>
            </div>  <!-- /menuprincipal -->                                                                 
        </div><!-- /.col-md-4 col -->



        <div class="col-md-6 text-center margincolum" >

            <div class="menuprincipal" onclick="location.href='<?php echo site_url();?>chat/final_test'"> 
                <img class="margenimg" src="<?php echo base_url(); ?>assets/img/exam_mode.svg">
                <h3>Final Test Exam</h3>
            </div>  <!-- /menuprincipal -->                                                                        
        </div><!-- /.col-md-4 col -->



    <footer class="footer-demo section-dark">
        <div class="container">
            <nav class="pull-left">
             
            </nav>
            <div class="copyright pull-right">
               <!--  copyright -->
            </div>
        </div>
    </footer>

</body>
</html>