
<div class="containermenu">

  <ol class="breadcrumb">
    <li><a href="<?php echo site_url();?>main">Menu</a></li>
    <li> <a href="<?php echo site_url();?>question">Question Menu</a></li>
    <li class="active">Configuration</li>
  </ol>

  <?php
      $categories = get_base_categories();
      //echo var_dump($variable);
      //echo $final_test_categories[0]['id_category'];
  ?>

  <style type="text/css">

      .wrapper ul{
       list-style:none;
       }

  </style>

  <div class="col-lg-12">
    <div class="dq-category-outer-wrapper">
      <div class="dq-configuration-title">
        <p>The final test has the selected categories: </p>
        <p>If you want to change them, select the new ones and click on the button below update.</p>
      </div> <!-- dq-category-title -->
        <div id="testContent">
          <div class="category-section">
            
            <div class="wrapper">
              <!--Si hay categorias en la BD las muestra con un foreach recursivamente-->
              <?php if(count($categories)>0):?>
                <ul>
                  <?php foreach($categories as $cat):?>
                  <li><input class="form-check-input" type="checkbox" data-id="item" name="category<?=$cat['id']?>"/> <?php echo $cat["number"]." ".$cat["description"];?>
                      <!--<input class="form-check-input" type="hidden" value="<?=$cat['id']?>" name="category<?=$cat['id']?>">-->
                    
                    <?php
                      list_tree_cat_id_config($cat["id"]);
                    ?>
                  <?php endforeach;?>
                </ul>
              <?php else:?>
                <p class="alert alert-danger">No hay categorias</p>
              <?php endif;?>

            <button class="btn btn-success btn-lg" style="margin-left:50px;margin-top:20px;" onclick="update_categories()">Update categories</button>
      
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

$(document).ready(function() 
{
    //Utilizamos ajax para obtener las categorias que componen el final test actualmente
    url = "<?php echo site_url('configuration/ajax_get_categories_FT')?>";
    
    //Ajax Load data from ajax
    $.ajax({
        url : url,
        type: "GET",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            for (i = 0; i < data['tam']; i++) 
            {              
              $('[name="category'+data['categories'][i]['id_category']+'"]').prop("checked", true);
              $('[name="category'+data['categories'][i]['id_category']+'"]').val(true);   
            }
        },     
       
    });    

});
/*
function update_categories()
{
    var url;

    url = "<?php echo site_url('configuration/update_categories_FT')?>";
    
    // ajax adding data to database
    $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
            if(data.status) //if success close modal and reload ajax table
            {
                alert(data.marina);
            }
            

        },     
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error update answers');

        }
    });    
}*/

</script>


</body>
</html>
