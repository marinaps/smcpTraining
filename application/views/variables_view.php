

    <div class="containermenu">
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url();?>main">Menu</a></li>
          <li> <a href="<?php echo site_url();?>question">Question Menu</a></li>
          <li class="active">Variables</li>
        </ol>
    </div>

    <h3><center>Variables Data</center></h3>

    <div class="containermenu">


        <button class="btn btn-success" onclick="add_type_variable()"><i class="glyphicon glyphicon-plus"></i>Add Variable</button> 
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <br />
        <br />
        <table id="table" class="table table-hover table-bordered colortablas" cellspacing="0" width="100%">
            <thead>
                <tr>
                    
                    <th>Type of variable</th>
                    <th>Variables</th>
                    <th>Variables</th>
                    <th style="width:125px;">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>

            <tfoot>
            <tr>
                
                <th>Type of variable</th>
                <th>Variables</th>
                <th>Variables</th>
                <th>Action</th>
            </tr>
            </tfoot>
        </table>
    </div>


    <script type="text/javascript" language="javascript">
        /* Abrimos etiqueta de código Javascript */
        /* Partimos por definir una variable llamada posicionCampo. Esta variable servirá como índices para marcar cuantos campos se han agregado dinámicamente. La inicializamos en 1, ya que la primera llamada ocurrirá cuando no hayan campos agregados */
        var posicionCampo = 0;

        /* Declaramos la función addAnswers( ) para el formulario de añadir preguntas */
        function addVariables_addform() 
        {
            /* Declaramos una variable llamada nuevaFila y a ella le asignamos la recuperación del elemento HTML designado por el id tablaUsuarios. En este caso, la tabla en la que manejamos los campos dinámicamente y llamamos a la función insertRow para agregar una fila */
            nuevaFila = document.getElementById("table_variables").insertRow(-1);
            /* Asignamos a la propiedad id de nuevaFila el valor de posicionCampo, que inicializamos en 1 */
            nuevaFila.id = posicionCampo;
            /* Luego en otra variable llamada nuevaCelda, agregaremos una celda a la tabla, mediante la función insertCell */
            nuevaCelda = nuevaFila.insertCell(-1);
            /* Con la celda creada, insertamos dinámicamente un campo de texto, el cual almacenaremos en un array llamado nombre, con una posición equivalente a la variable posicionCampo. Una vez terminado, repetimos la acción para el sitio Web y correo, asignando al array respectivo */
            nuevaCelda.innerHTML = "<td><div class='input-group'><input placeholder='variable "+(posicionCampo+1)+"' class=' form-control' type='text' size='80%' name='nombre[" + posicionCampo + "]'><span class='input-group-btn'><button class='btn btn-danger' type='button' onclick='deleteVariable(this)'>Delete</button></span></div></td>";
            nuevaCelda = nuevaFila.insertCell(-1);
            /* Finalmente añadimos una última celda para las acciones y ahí agregamos un botón llamado Eliminar, el cual al ser presionado (definiendo la propiedad onClick), llamará a una función eliminarUsuario, pasando como parámetro la fila correspondiente */
            /* Incrementamos el valor de posicionCampo para que empiece a contar de la fila siguiente */
            posicionCampo++;
        }

        /* Declaramos la función addAnswer( ) para el formulario de añadir respuestas */
        function addVariables_editform() 
        {
            /* Declaramos una variable llamada nuevaFila y a ella le asignamos la recuperación del elemento HTML designado por el id tablaUsuarios. En este caso, la tabla en la que manejamos los campos dinámicamente y llamamos a la función insertRow para agregar una fila */
            nuevaFila = document.getElementById("table_variables_edit").insertRow(-1);
            /* Asignamos a la propiedad id de nuevaFila el valor de posicionCampo, que inicializamos en 1 */
            nuevaFila.id = posicionCampo;
            /* Luego en otra variable llamada nuevaCelda, agregaremos una celda a la tabla, mediante la función insertCell */
            nuevaCelda = nuevaFila.insertCell(-1);
            /* Con la celda creada, insertamos dinámicamente un campo de texto, el cual almacenaremos en un array llamado nombre, con una posición equivalente a la variable posicionCampo. Una vez terminado, repetimos la acción para el sitio Web y correo, asignando al array respectivo */
            nuevaCelda.innerHTML = "<td><div class='input-group'><input placeholder='variable "+(posicionCampo+1)+"' class=' form-control' type='text' size='80%' name='nombre_edit[" + posicionCampo + "]'><span class='input-group-btn'><button class='btn btn-danger' type='button' onclick='deleteVariable(this)'>Delete</button></span></div></td>";
            nuevaCelda = nuevaFila.insertCell(-1);
            /* Finalmente añadimos una última celda para las acciones y ahí agregamos un botón llamado Eliminar, el cual al ser presionado (definiendo la propiedad onClick), llamará a una función eliminarUsuario, pasando como parámetro la fila correspondiente */
            /* Incrementamos el valor de posicionCampo para que empiece a contar de la fila siguiente */
            posicionCampo++;
        }


        /* Definimos la función deleteAnswer, la cual se encargará de quitar la fila completa del formulario. No es necesario hacer modificaciones sobre este código */
        function deleteVariable(obj) 
        {
            var oTr = obj;
            posicionCampo--;
            while(oTr.nodeName.toLowerCase() != 'tr') {
                oTr=oTr.parentNode;
            }
            var root = oTr.parentNode;
            root.removeChild(oTr);
        }
        /* Cerramos el código Javascript */
    </script>


  


<script type="text/javascript">

var save_method; //for save method string
var table;

$(document).ready(function() 
{
    //datatables
    table = $('#table').DataTable({ 

        "autoWidth": false,
        //Esto sirve para dar una anchura diferente a cada columna
        "columns": [
            {
                "orderable": true,
                "width": 200,
            }, 
            {
                "orderable": false,
                
            }, 
            {
                "orderable": false,
                "width": 100,
            },
            {
                "orderable": false,
                "width": 120,
            }
        ],

        "responsive": true,
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.

        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('variable/ajax_list')?>",
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


//Abre el formulario de añadir un tipo de variable
function add_type_variable()
{
    save_method = 'add';
    $('#form')[0].reset(); // reset form on modals
    $('.tablaUsuarios').on('hidden', function () {
        $.clearInput();
    });
    $('#table_variables tr').remove(); //elimina los campos al volver a abrir el modal
    posicionCampo = 0;
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add variable'); // Set Title to Bootstrap modal title
}
     

$.clearInput = function () {
        $('tablaUsuarios').document.getElementById("tablaUsuarios").deletetRow(1);
};
    

//Formulario para editar un tipo de variable
function edit_variable(id)
{
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals
    $('#table_variables_edit tr').remove(); //elimina los campos al volver a abrir el modal
    posicionCampo = 0;
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

     //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('variable/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
            $('[name="id_edit"]').val(data[0]['id']);
            $('[name="type_variable_edit"]').val(data[0]['variable']);
  
            $('#modal_edit').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title_edit').text('Edit variable'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });

}

//Abre el formulario para ver todas las variables de un tipo de variable
function view_variables(id)
{
    $('#form')[0].reset(); // reset form on modals
    $('#modal_variables tr').remove(); //elimina los campos al volver a abrir el modal
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#myList li').remove();
    document.getElementById("mostar_error").style.display= "none";

     //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('variable/ajax_view_variables/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $num_answers = data['variable2'];

            if($num_answers)
            {
                for (i = 0; i < $num_answers; i++) 
                {
                    
                    campo = '<li><label class="control-label">Variable '+(i+1)+'</label> <div class="input-group col-md-11"><input type="text" class="form-control" rows=1 id="campo' + i + '" name="nombree[' + i + ']"><span class=" input-group-btn"><button class="btn btn-danger"  type="button" onclick="delete_variables('+data['variable1'][i]['id']+')">Delete</button></span></div><input type="hidden" value="" name="id_variable'+i+'"/> </li>';
                    
                    $("#myList").append(campo);
                    $('[name="nombree['+i+']"]').val(data['variable1'][i]['name']);
                    $('[name="id_variable'+i+'"]').val(data['variable1'][i]['id']);


                    if(data['variable1'][i]['correct'] == 0) 
                    {
                        $('[name="false-answer'+i+'"]').prop("checked", true);
                        $('[name="false-answer'+i+'"]').val(true);
                    }  
                }
            }else 
            {
                 document.getElementById("mostar_error").style.display= "inline";
            }

            
            $(".modal-title-variables").html("Type of variable: ".concat(data['variable4']['variable']));
            $('[name="id_type_variable"]').val(data['variable3']);

            $('#modal_variables').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Variables'); // Set title to Bootstrap modal title
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


function update()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 

    uploadURI = "<?php echo site_url('variable/ajax_update_form')?>";

    var inputFile = $('input[name=file_edit]');
     
      var fileToUpload = inputFile[0].files[0];
        // make sure there is file to upload
        if (fileToUpload != 'undefined') {
            // provide the form data
            // that would be sent to sever through ajax
            var formData = new FormData();
            formData.append("file_edit", fileToUpload);
             var other_data = $('form').serializeArray();
            $.each(other_data,function(key,input){
                formData.append(input.name,input.value);
            });
            
            
            // now upload the file using $.ajax
            $.ajax({
                url: uploadURI,
                type: 'post',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(data)
                {
                if(data.status) //if success close modal and reload ajax table
                {
                    
                    $('#modal_edit').modal('hide');
                    reload_table();
                }
                else 
                {
                    if(data.status == 'error')
                    {
                        alert(data.error);
                    }
                    else
                    {
                        for (var i = 0; i < data.inputerror.length; i++) 
                        {
                           
                                $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                                $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                        }
                    }
                }
                $('#btnSave').text('save'); //change button text
                $('#btnSave').attr('disabled',false); //set button enable 
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error edit data');
                    $('#btnSave').text('save'); //change button text
                    $('#btnSave').attr('disabled',false); //set button enable 
                }
                  
            });
        }
}



//Funcion para hacer el update del formulario donde se muestran todas las variables de un tipo de variable
function update_variables()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo site_url('variable/ajax_update_variables')?>";
    
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
                $('#modal_variables').modal('hide');
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
            alert('Error update answers');
            $('#btnSave').text('save'); //change button text
            $('#btnSave').attr('disabled',false); //set button enable 

        }
    });    
}



function save()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    var url;

    if(save_method == 'add') {
        url = "<?php echo site_url('variable/ajax_add')?>";
    } else {
        url = "<?php echo site_url('variable/ajax_update_form')?>";
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
                $('#modal_edit').modal('hide');
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



//Elimina un tipo de variable y todas sus variables asociadas
function delete_type_variable(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('variable/ajax_delete_type_variable')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}



//Elimina una variable
function delete_variables(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('variable/ajax_delete_variables')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_variables').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}



</script>

  
<!-- Bootstrap modal para añadir nuevos tipos de variables-->
<div class="modal" id="modal_form" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Variable Form</h3>
            </div>
            <div class="modal-body form">

                <form method="post" id="form" class="form-horizontal" enctype="multipart/form-data">

                <input type="hidden" value="" name="id"/> 
                <div class="form-body">

                    <div class="form-group">
                        <label class="control-label col-md-2">Type of Variable</label>
                        <div class="col-md-10">
                            <input name="type_variable" placeholder="type of variable" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-2">Variable</label>
                        <div class="col-md-10">
                            <input name="variable" placeholder="variable" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>
              

                    <div class="form-group">
                        <table>
                            <tr>
                                <label class="control-label col-md-2">More variables: </label>
                            </tr>
                                
                            <td>
                                <input class="btn btn-sm btn-primary btn-block" type="button" onClick="addVariables_addform()" value="add variables" ><br>
                            </td>
                        </table>
                    </div>


                    <div class="form-group">
                   
                        <div class="col-md-10">
                            <table id="table_variables"> 
                            <label class="control-label col-md-2"> </label>
                            </table>
                        </div>
                    </div>

                </div>
                </form>  

            </div>
            
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Add</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->



<!-- Bootstrap modal para el edit de las variables-->
<div class="modal" id="modal_variables" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title-variables">Type of variable:</h3>

            </div>


            <div class="modal-body form">
                <form action="#" method="post" id="form" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-body">
                        <div class="form-group">
                        <div class="col-md-12">

                            <input type="hidden" value="" name="id_typequestion"/> 

                            <label style="display: none"; id="mostar_error" class="control-label col-md-8">No variables uploaded</label>

                            <ul id="myList" class="" style="list-style-type: none">
                            
                            </ul>
                        </div>
                        </div>
                    </div>

                </form>
            </div>
           
            
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="update_variables()" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
  

 
<!-- Bootstrap modal para el edit de los tipos de variables-->
<div class="modal" id="modal_edit" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Variable Form</h3>
            </div>
            <div class="modal-body form">

                <form method="post" id="form" class="form-horizontal" enctype="multipart/form-data">

                <input type="hidden" value="" name="id_edit"/> 
                <div class="form-body">

                    <div class="form-group">
                        <label class="control-label col-md-2">Type of Variable</label>
                        <div class="col-md-10">
                            <input name="type_variable_edit" placeholder="type of variable" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>
              

                    <div class="form-group">
                        <table>
                            <tr>
                                <label class="control-label col-md-2">More variables: </label>
                            </tr>
                                
                            <td>
                                <input class="btn btn-sm btn-primary btn-block" type="button" onClick="addVariables_editform()" value="add variables" ><br>
                            </td>
                        </table>
                    </div>


                    <div class="form-group">
                   
                        <div class="col-md-10">
                            <table id="table_variables_edit"> 
                            <label class="control-label col-md-2"> </label>
                            </table>
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