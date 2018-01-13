
  <?php
  $categories = get_base_categories();
  ?>


    <div class="containermenu">

        <ol class="breadcrumb">
             <li><a href="<?php echo site_url();?>main/">Menu</a></li>
             <li><a href="<?php echo site_url();?>result/">Mode Menu Results</a></li>
             <li class="active">Level Results Menu</li>
        </ol>

            
        <div class="col-md-4 text-center margincolum" >

          <div class="menuprincipal" onclick="location.href='<?php echo site_url();?>result/pattern_level_results'" > 
            <img class="margenimg" src="<?php echo base_url(); ?>assets/img/easy.svg" >

            <h3>Pattern Level</h3>
          </div>  <!-- /menuprincipal -->
                                                                                 
        </div><!-- /.col-md-4 col -->

        <div class="col-md-4 text-center margincolum" >

            <div class="menuprincipal" title="mi_link" onclick="location.href='<?php echo site_url();?>result/association_level_results'" > 
                <img class="margenimg" src="<?php echo base_url(); ?>assets/img/medium.svg" >
                <a href="#" data-toggle="popover" title="Popover Header" data-content="Some content inside the popover"></a>
                <h3>Association Level</h3>
            </div>  <!-- /menuprincipal -->
                                                                                 
        </div><!-- /.col-md-4 col -->

         <div class="col-md-4 text-center margincolum" >

            <div class="menuprincipal" onclick=""> 
                <img class="margenimg" src="<?php echo base_url(); ?>assets/img/hard.svg">
                <h3>Inter-Association Level</h3>
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