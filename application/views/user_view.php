<script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>


   <div class="section">
      <div class="containermenu">

        <!-- Barra que indica la posicion dentro de pagina-->
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url();?>main">Menu</a></li>
            <li class="active">Students</li>
        </ol>

        <h2><center>Students Data</center></h2>
        <br/>

        <button class="btn btn-success" onclick="add_user()"><i class="glyphicon glyphicon-plus"></i> Add User</button>
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>

        <br/>
        <br/>

            <table id="table" class="table table-hover table-bordered colortablas" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th class="desktop">Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th style="width:125px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>

                <tfoot>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </tfoot>
            </table>
        </div> <!-- end containermenu -->
    </div> <!-- end section-->






<script type="text/javascript">

    var save_method; //for save method string
    var table;

    $(document).ready(function() {

        //datatables
        table = $('#table').DataTable({ 

            "responsive": true,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

           "columns": [ //Hace que las columnas se puedan o no ordenar
                {
                    "orderable": true,
                }, 
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
                },
                {
                    "orderable": false,
                }
            ],
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('user/ajax_list')?>",
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

/* Función para mostrar la grafica de los resultados del estudiante
    function graph(id)
    {
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
       
         //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('user/ajax_graph/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {
                $('#modal_graph').modal('show'); // show bootstrap modal
                $('.modal-title').text('Results'); // Set Title to Bootstrap modal title

                  // Codigo para la grafica 
                $(function () 
                { 
                    var myChart = Highcharts.chart('container', 
                    {
                        chart: {
                            
                        },
                        title: {
                            text: "Results"
                        },
                         xAxis: {
                            tytle: {
                                text: "Date"
                            },
                            type: 'datetime',
                            labels: {
                                formatter: function () { //le damos el formato que aparece debajo en la x
                                    return Highcharts.dateFormat('%d/%m/%y', this.value);
                                }
                        }},
                        yAxis: {
                            max: 100, //El eje y muestra como maximo el 100
                            title: {
                                text: "Grade"
                            }
                        },
                        plotOptions: {
                            line: {
                                dataLabels: {
                                    enabled: true
                                },
                                enableMouseTracking: true
                            }
                        },
                        legend: {
                            enabled: false //Con esto quitamos la leyenda que aparecia abajo
                        },
                        series : [{
                            name: 'Results',
                            data : data,                            
                        }]
                    });
                });
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('This user has no information');
            }
        });
    }
    */


    function add_user()
    {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_form').modal('show'); // show bootstrap modal
        $('.modal-title').text('Add User'); // Set Title to Bootstrap modal title
    }

    function edit_user(id)
    {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url : "<?php echo site_url('user/ajax_edit/')?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data)
            {

                $('[name="id"]').val(data.id);
                $('[name="first_name"]').val(data.first_name);
                $('[name="last_name"]').val(data.last_name);
                $('[name="email"]').val(data.email);
                $('[name="role"]').val(data.role);
                $('[name="status"]').val(data.status);
                
          
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Edit User'); // Set title to Bootstrap modal title

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
            url = "<?php echo site_url('user/ajax_add')?>";
        } else {
            url = "<?php echo site_url('user/ajax_update')?>";
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

    function delete_user(id)
    {
        if(confirm('Are you sure you want to delete this data?'))
        {
            // ajax delete data to database
            $.ajax({
                url : "<?php echo site_url('user/ajax_delete')?>/"+id,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status) //if success close modal and reload ajax table
                    { //if success reload ajax table
                        $('#modal_form').modal('hide');
                        reload_table();
                    }
                    else
                        alert('You cannot delete this user');
                    
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }
            });

        }
    }

</script>


<!-- Bootstrap modal para añadir nuevos alumnos-->
<div class="modal" id="modal_form" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">First Name</label>
                            <div class="col-md-9">
                                <input name="first_name" placeholder="First Name" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Last Name</label>
                            <div class="col-md-9">
                                <input name="last_name" placeholder="Last Name" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Email</label>
                            <div class="col-md-9">
                                <input name="email" placeholder="Email" class="form-control" type="email">
                                <span class="help-block"></span>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="control-label col-md-3">Role</label>
                             <div class="col-md-9">
                            <select name="role" class="form-control">
                            <option value="2">Student</option>
                            <option value="1">Admin </option>
                             <span class="help-block"></span>
                            </select>
                            </div>
                        </div>
                            <div class="form-group">
                            <label class="control-label col-md-3">Status</label>
                             <div class="col-md-9">
                            <select name="status" class="form-control">
                            <option value="approved">Approved </option>
                            <option value="pending">Pending</option>
                             <span class="help-block"></span>
                            </select>
                        </div> </div>
                        
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




<!-- Bootstrap modal para la grafica de los resutados-->
<div class="modal" id="modal_graph" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Results</h3>
            </div>
            <div class="modal-body form">
               <div id="container"></div>

            </div>
            <div class="modal-footer">
               
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->

</body>
</html>