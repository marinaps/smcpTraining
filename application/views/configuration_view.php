
<div class="containermenu">

  <ol class="breadcrumb">
       <li><a href="<?php echo site_url();?>main/">Menu</a></li>
       <li class="active">Categories</li>
  </ol>

  <?php
      $categories = get_base_categories();
  ?>

  

  <style type="text/css">

      .wrapper ul{
       list-style:none;
       }

  </style>
  
  <div class="col-lg-10 col-lg-offset-1">
    <div class="dq-category-outer-wrapper">
      <div class="dq-category-title">Categories
      </div> <!-- dq-category-title -->
        <div id="testContent">
          <div class="category-section">
            
            <div class="wrapper">
              <!--Si hay categorias en la BD las muestra con un foreach recursivamente-->
              <?php if(count($categories)>0):?>
                <ul>
                  <?php foreach($categories as $cat):?>
                  <li><input type="checkbox" data-id="item" data-name="Item"/> <?php echo $cat["number"]." ".$cat["description"];?>
                      <input type="hidden" value="<?=$cat['id']?>">
                    
                    <?php
                      list_tree_cat_id_config($cat["id"]);
                    ?>
                  <?php endforeach;?>
                </ul>
              <?php else:?>
                <p class="alert alert-danger">No hay categorias</p>
              <?php endif;?>
            </div> <!-- wrapper -->
          </div> <!-- category-section -->
        </div> <!-- testContent -->
    </div> <!-- dq-category-outer-wrapper -->
  </div> <!-- col-lg-10 col-lg-offset-1 -->


  <footer class="footer-demo section-dark">
      <div class="container">
          <nav class="pull-left">
           
          </nav>
          <div class="copyright pull-right">
            
          </div>
      </div>
  </footer>

</div>


<script>
  //Para los checkbox anidados
  $('.wrapper').deepcheckbox();
</script>


</body>
</html>
