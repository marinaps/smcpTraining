
  <?php
  $categories = get_base_categories();
  ?>

    <div class="containermenu">
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url();?>main">Menu</a></li>
          <li> <a href="<?php echo site_url();?>question">Question Menu</a></li>
          <li class="active">True/false Questions</li>
        </ol>
    </div>

    <h3><center>True/False Questions Data</center></h3>

    <div class="containermenu">

        <button class="btn btn-success" onclick="add_question()"><i class="glyphicon glyphicon-plus"></i>Add Question</button>
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <button class="btn btn-default" onclick="location.href='<?php echo site_url();?>upload/upload_truefalse'"><i class="glyphicon glyphicon-upload"></i> Upload file</button>
        <br />
        <br />
        <table id="table" class="table table-hover table-bordered colortablas" cellspacing="0" width="100%">
            <thead>
                <tr>
                    
                    <th>True</th>
                    <th>False</th>
                    <th class="desktop">Category</th>
                                     
                    
                    <th style="width:125px;">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>

            <tfoot>
            <tr>
                
                    <th>True</th>
                    <th>False</th>
                    <th>Category</th>
                    
                    
                   
                <th>Action</th>
            </tr>
            </tfoot>
        </table>
    </div>



<script type="text/javascript">

var save_method; //for save method string
var table;

$(document).ready(function() 
{
    //datatables
    table = $('#table').DataTable({ 

        "responsive": true,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        "columns": [  //Hace que las columnas se puedan o no ordenar
            {
                "orderable": true,
                
            }, 
            {
                "orderable": true,
                
            }, 
            {
                "orderable": false,
                
            },
            {
                "orderable": false,
                
            }
        ],

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('truefalsequestion/ajax_list')?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ -1 ], //last column
            "orderable": false, //set not orderable
        },
        ],

    });


    //set input/textarea/select event when change value, remove class error and remove text help block 
    $("input").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("textarea").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });
    $("select").change(function(){
        $(this).parent().parent().removeClass('has-error');
        $(this).next().empty();
    });

});



function add_question()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.tablaUsuarios').on('hidden', function () {
        $.clearInput();
});
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Question'); // Set Title to Bootstrap modal title

}

$.clearInput = function () {
        $('tablaUsuarios').document.getElementById("tablaUsuarios").deletetRow(1);
};
    

function edit_question(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

     //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('truefalsequestion/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {

            $('[name="id"]').val(data[0]['id']);
            $('[name="true"]').val(data[0]['true_statement']);
            $('[name="false"]').val(data[0]['false_statement']);
            $('[name="id_category"]').val(data[0]['id_category']);

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Question'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });


}

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('truefalsequestion/ajax_add')?>";
    } else {
        url = "<?php echo site_url('truefalsequestion/ajax_update')?>";
    }

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
                $('#modal_form').modal('hide');
                reload_table();
            }
            else
            {
                for (var i = 0; i < data.inputerror.length; i++) 
                {
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                }
            }
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 


        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error adding / update data');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });
}

function delete_question(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('truefalsequestion/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
                reload_table();
                alert('The data was deleted correctly');
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}

</script>

<!-- Bootstrap modal -->
<div class="modal" id="modal_form" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Question Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Category</label>
                             <div class="col-md-9">
                            <select class="form-control" name="id_category" id="id_category">
                          <option value="">-- SELECT CATEGORY --</option>
                          <?php if(count($categories)>0):?>
                            <?php foreach($categories as $cat):?>
                              <option value="<?php echo $cat["id"];?>" ><?php echo $cat["number"]." ".$cat["description"];?>

                              </option>
                              <?php select_tree_cat_id($cat["id"],1); ?>
                            <?php endforeach;?>
                          <?php endif;?>
                      </select> <!-- end select -->
                        </div> </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">True</label>
                            <div class="col-md-9">
                                <input name="true" placeholder="question" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="control-label col-md-3">False</label>
                            <div class="col-md-9">
                                <input name="false" placeholder="answer" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->


</body>
</html>