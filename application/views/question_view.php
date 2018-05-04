
<?php
  $categories = get_base_categories();
?>

    <div class="containermenu">
        <ol class="breadcrumb">
          <li><a href="<?php echo site_url();?>main">Menu</a></li>
          <li> <a href="<?php echo site_url();?>question">Question Menu</a></li>
          <li class="active">Questions</li>
        </ol>
    </div>

    <h3 style="text-align:center">Questions Data</h3>

    <div class="containermenu">
        
        <button class="btn btn-success" onclick="add_question()"><i class="glyphicon glyphicon-plus"></i>Add Question</button>
        <button class="btn btn-default" onclick="reload_table()"><i class="glyphicon glyphicon-refresh"></i> Reload</button>
        <a class="btn btn-default" href="<?php echo site_url();?>answer"><i class="glyphicon"></i> Go to Answers</a>
        <br />
        <br />
        <table id="table" class="table table-hover table-bordered colortablas" >
            <thead>
                <tr>
                    
                    <th>Question</th>
                    <th>Category</th>
                    <th class="desktop">Audio</th>
                    <th>Answers</th>
                    
                    <th style="width:125px;">Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>

            <tfoot>
            <tr>
                
                <th>Question</th>
                <th>Category</th>
                <th>Audio</th>
                <th>Answers</th>
                      
                <th>Action</th>
            </tr>
            </tfoot>
        </table>
    </div>


    <script type="text/javascript">
        /* Abrimos etiqueta de código Javascript */
        /* Partimos por definir una variable llamada posicionCampo. Esta variable servirá como índices para marcar cuantos campos se han agregado dinámicamente. La inicializamos en 1, ya que la primera llamada ocurrirá cuando no hayan campos agregados */
        var posicionCampo = 0;

        /* Declaramos la función addAnswers( ) para el formulario de añadir preguntas */
        function addAnswers_addform() 
        {
            /* Declaramos una variable llamada nuevaFila y a ella le asignamos la recuperación del elemento HTML designado por el id tablaUsuarios. En este caso, la tabla en la que manejamos los campos dinámicamente y llamamos a la función insertRow para agregar una fila */
            nuevaFila = document.getElementById("table_answers").insertRow(-1);
            /* Asignamos a la propiedad id de nuevaFila el valor de posicionCampo, que inicializamos en 1 */
            nuevaFila.id = posicionCampo;
            /* Luego en otra variable llamada nuevaCelda, agregaremos una celda a la tabla, mediante la función insertCell */
            nuevaCelda = nuevaFila.insertCell(-1);
            /* Con la celda creada, insertamos dinámicamente un campo de texto, el cual almacenaremos en un array llamado nombre, con una posición equivalente a la variable posicionCampo. Una vez terminado, repetimos la acción para el sitio Web y correo, asignando al array respectivo */
            nuevaCelda.innerHTML = "<td><div class='input-group'><input placeholder='answer "+(posicionCampo+1)+"' class=' form-control' type='text' size='80%' name='nombre[" + posicionCampo + "]'><span class='input-group-addon'><input type='checkbox' name='false-answer" + posicionCampo + "'> False</span><span class='input-group-btn'><button class='btn btn-danger' type='button' onclick='deleteAnswer(this)'>Delete</button></span></div></td>";
            nuevaCelda = nuevaFila.insertCell(-1);
            /* Finalmente añadimos una última celda para las acciones y ahí agregamos un botón llamado Eliminar, el cual al ser presionado (definiendo la propiedad onClick), llamará a una función eliminarUsuario, pasando como parámetro la fila correspondiente */
            /* Incrementamos el valor de posicionCampo para que empiece a contar de la fila siguiente */
            posicionCampo++;
        }

        /* Declaramos la función addAnswer( ) para el formulario de añadir respuestas */
        function addAnswers_editform() 
        {
            /* Declaramos una variable llamada nuevaFila y a ella le asignamos la recuperación del elemento HTML designado por el id tablaUsuarios. En este caso, la tabla en la que manejamos los campos dinámicamente y llamamos a la función insertRow para agregar una fila */
            nuevaFila = document.getElementById("table_answers_edit").insertRow(-1);
            /* Asignamos a la propiedad id de nuevaFila el valor de posicionCampo, que inicializamos en 1 */
            nuevaFila.id = posicionCampo;
            /* Luego en otra variable llamada nuevaCelda, agregaremos una celda a la tabla, mediante la función insertCell */
            nuevaCelda = nuevaFila.insertCell(-1);
            /* Con la celda creada, insertamos dinámicamente un campo de texto, el cual almacenaremos en un array llamado nombre, con una posición equivalente a la variable posicionCampo. Una vez terminado, repetimos la acción para el sitio Web y correo, asignando al array respectivo */
            nuevaCelda.innerHTML = "<td><div class='input-group'><input placeholder='answer "+(posicionCampo+1)+"' class=' form-control' type='text' size='80%' name='nombre_edit[" + posicionCampo + "]'><span class='input-group-addon'><input type='checkbox' name='false-answer_edit" + posicionCampo + "'> False</span><span class='input-group-btn'><button class='btn btn-danger' type='button' onclick='deleteAnswer(this)'>Delete</button></span></div></td>";
            nuevaCelda = nuevaFila.insertCell(-1);
            /* Finalmente añadimos una última celda para las acciones y ahí agregamos un botón llamado Eliminar, el cual al ser presionado (definiendo la propiedad onClick), llamará a una función eliminarUsuario, pasando como parámetro la fila correspondiente */
            /* Incrementamos el valor de posicionCampo para que empiece a contar de la fila siguiente */
            posicionCampo++;
        }


        /* Definimos la función deleteAnswer, la cual se encargará de quitar la fila completa del formulario. No es necesario hacer modificaciones sobre este código */
        function deleteAnswer(obj) 
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


var table;

$(document).ready(function() 
{
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
            "url": "<?php echo site_url('question/ajax_list')?>",
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


//Abre el formulario de añadir preguntas
function add_question()
{
    $('#form')[0].reset(); // reset form on modals
    $('.tablaUsuarios').on('hidden', function () {
        $.clearInput();
    });
    $('#table_answers tr').remove(); //elimina los campos al volver a abrir el modal
    posicionCampo = 0;
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#modal_form').modal('show'); // show bootstrap modal
    $('.modal-title').text('Add Question'); // Set Title to Bootstrap modal title
}
     

$.clearInput = function () {
        $('tablaUsuarios').document.getElementById("tablaUsuarios").deletetRow(1);
};
    

//Formulario para editar una pregunta
function edit_question(id)
{
    $('#form')[0].reset(); // reset form on modals
    $('#table_answers_edit tr').remove(); //elimina los campos al volver a abrir el modal
    posicionCampo = 0;
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string

     //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('question/ajax_edit/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
 
            $('[name="id_edit"]').val(data[0]['id']);
            $('[name="statement_edit"]').val(data[0]['statement']);
            $('[name="id_category_edit"]').val(data[0]['id_category']);
            $('[name="file_edit"]').val();
  
            $('#modal_edit').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title_edit').text('Edit Question'); // Set title to Bootstrap modal title
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });

}

function view_answers(id)
{
    $('#form')[0].reset(); // reset form on modals
    $('#table_answers_edit tr').remove(); //elimina los campos al volver a abrir el modal
    $('.form-group').removeClass('has-error'); // clear error class
    $('.help-block').empty(); // clear error string
    $('#myList li').remove();
    document.getElementById("mostar_error").style.display= "none";

     //Ajax Load data from ajax
    $.ajax({
        url : "<?php echo site_url('question/ajax_view_answers/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
            $num_answers = data['num_answers'];

            if($num_answers)
            {
                for (i = 0; i < $num_answers; i++) 
                {
                    if(data['answers'][i]['answer'].length > 80) //si la respuesta es larga se pone un texarea
                    {
                         campo = '<li> <label class="control-label">Answer '+(i+1)+'</label><div class="input-group col-md-11"><textarea class="form-control" id="campo' + i + '" name="nombree[' + i + ']"></textarea> <span class="input-group-addon"> <input class="form-check-input" type="checkbox" name="false-answer'+i+'"> False answer</span>  <span class="input-group-addon input-group-btn"><button class="btn btn-danger btn-sm" type="button" onclick="delete_answer('+data['answers'][i]['id']+')">Delete</button></span><input type="hidden" value="" name="id_answer'+i+'"/> </div></li>';
                    }
                    else
                    {
                         campo = '<li><label class="control-label">Answer '+(i+1)+'</label> <div class="input-group col-md-11"> <textarea class="form-control" rows=1 id="campo' + i + '" name="nombree[' + i + ']"> </textarea>    <span class="input-group-addon"> <input class="form-check-input" type="checkbox" name="false-answer'+i+'"> False answer</span>   <span class=" input-group-btn"><button class="btn btn-danger btn-sm" type="button" onclick="delete_answer('+data['answers'][i]['id']+')">Delete</button></span><input type="hidden" value="" name="id_answer'+i+'"/> </div></li>';
                    }

                    $("#myList").append(campo);
                    $('[name="nombree['+i+']"]').val(data['answers'][i]['answer']);
                    $('[name="id_answer'+i+'"]').val(data['answers'][i]['id']);


                    if(data['answers'][i]['correct'] == 0) 
                    {
                        $('[name="false-answer'+i+'"]').prop("checked", true);
                        $('[name="false-answer'+i+'"]').val(true);
                    }  
                }
            }else 
            {
                 document.getElementById("mostar_error").style.display= "inline";
            }

            
            $(".modal-title-answers").html("Question: ".concat(data['question_name']['statement']));
            $('[name="id_question"]').val(data['id_question']);

            $('#modal_answers').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Answers'); // Set title to Bootstrap modal title
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

    uploadURI = "<?php echo site_url('question/ajax_update_form')?>";

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


function update_answers()
{
    $('#btnSave').text('saving...'); //change button text
    $('#btnSave').attr('disabled',true); //set button disable 
    var url;

    url = "<?php echo site_url('question/ajax_update_answers')?>";
    
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
                $('#modal_answers').modal('hide');
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
   
    var uploadURI = $('#form').attr('action');
  

    var inputFile = $('input[name=file]');
     
      var fileToUpload = inputFile[0].files[0];
        // make sure there is file to upload
        if (fileToUpload != 'undefined') {
            // provide the form data
            // that would be sent to sever through ajax
            var formData = new FormData();
            formData.append("file", fileToUpload);
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
                    $('#modal_form').modal('hide');
                    
                    reload_table();
                }else 
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
                    alert('Error adding data');
                    $('#btnSave').text('save'); //change button text
                    $('#btnSave').attr('disabled',false); //set button enable 
                }
                  
            });
        }

    
}

function delete_answer(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('question/ajax_delete_answer')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_answers').modal('hide');
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}

function delete_audio(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('question/ajax_delete_audio')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                reload_table();
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                alert('Error deleting data');
            }
        });

    }
}


function delete_question(id)
{
    if(confirm('Are you sure delete this data?'))
    {
        // ajax delete data to database
        $.ajax({
            url : "<?php echo site_url('question/ajax_delete')?>/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {
                //if success reload ajax table
                $('#modal_form').modal('hide');
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

<!-- Bootstrap modal para añadir nuevas preguntas-->
<div class="modal" id="modal_form" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Question Form</h3>
            </div>
            <div class="modal-body form">

                <form action="<?php echo site_url('question/ajax_add');?>" method="post" id="form" class="form-horizontal" enctype="multipart/form-data">

                <input type="hidden" value="" name="id"/> 
                <div class="form-body">

                    <div class="form-group">
                        <label class="control-label col-md-2">Category</label>
                        <div class="col-md-10">
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
                             <span class="help-block"></span>
                        </div> 
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2">Question</label>
                        <div class="col-md-10">
                            <input name="statement" placeholder="question" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>
            

                    <div class="form-group">
                        <label class="control-label col-md-2">Upload Audio</label>
                        <div class="col-md-10">
                            <input  type="file" name="file" size="20" />
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2">Answer</label>
                        <div class="col-md-10">
                            <input name="answer" placeholder="answer" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>
              

                    <div class="form-group">
                        <table>
                            <tr>
                                <label class="control-label col-md-2">More answers: </label>
                            </tr>
                                
                            <td>
                                <input class="btn btn-sm btn-primary btn-block" type="button" onClick="addAnswers_addform()" value="add answers" ><br>
                            </td>
                        </table>
                    </div>


                    <div class="form-group">
                   
                        <div class="col-md-10">
                            <table id="table_answers"> 
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



  
  <!-- Bootstrap modal para el edit de las preguntas-->
<div class="modal" id="modal_edit" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Question edit</h3>

            </div>
            <div class="modal-body form">

                <form action="#" method="post" id="form" class="form-horizontal" enctype="multipart/form-data">

                <input type="hidden" value="" name="id_edit"/> 
                <div class="form-body">

                    <div class="form-group">
                        <label class="control-label col-md-2">Category</label>
                        <div class="col-md-10">
                            <select class="form-control" name="id_category_edit" id="id_category">
                            <option value="">-- SELECT CATEGORY --</option>
                                <?php if(count($categories)>0):?>
                                <?php foreach($categories as $cat):?>
                                <option value="<?php echo $cat["id"];?>" ><?php echo $cat["number"]." ".$cat["description"];?>

                                </option>
                                <?php select_tree_cat_id($cat["id"],1); ?>
                                <?php endforeach;?>
                                <?php endif;?>
                            </select> <!-- end select -->
                             <span class="help-block"></span>
                        </div> 
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-2">Question</label>
                        <div class="col-md-10">
                            <input name="statement_edit" placeholder="question" class="form-control" type="text">
                            <span class="help-block"></span>
                        </div>
                    </div>
            

                    <div class="form-group">
                        <label class="control-label col-md-2">Upload Audio</label>
                        <div class="col-md-10">
                            <input  type="file" name="file_edit" size="20" />
                            <span class="help-block"></span>
                        </div>
                    </div>

                </div>   

                  <table>
                    <tr>
                        <label class="control-label col-md-2" for="email">More answers: </label>
                    </tr>
                        
                    <td align="right">
                        <input class="btn btn-sm btn-primary btn-block" type="button" onClick="addAnswers_editform()" value="add answers" ><br>
                    </td>
            </table>

            <div class="form-group">
                    <table id="table_answers_edit"> 
                    <label class="control-label col-md-2"> </label>
                    </table>
            </div>


                </form>
            </div>
            
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="update()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
  


<!-- Bootstrap modal para el edit de las respuestas-->
<div class="modal" id="modal_answers" role="dialog" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title-answers">Question:</h3>

            </div>


            <div class="modal-body form">
                <form action="#" method="post" id="form" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-body">
                        <div class="form-group">
                        <div class="col-md-12">

                            <input type="hidden" value="" name="id_question"/> 

                            <label style="display: none"; id="mostar_error" class="control-label col-md-8">No answers uploaded</label>

                            <ul id="myList" class="" style="list-style-type: none">
                            
                            </ul>
                        </div>
                        </div>
                    </div>

                </form>
            </div>
        
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="update_answers()" class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
  

</body>
</html>