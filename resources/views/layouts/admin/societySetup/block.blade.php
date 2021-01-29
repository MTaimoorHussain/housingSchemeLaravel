@extends('layouts.admin.master')




@section('content')

<!-- Container -->
  <div class="container">    
    
     <!-- Row -->
     <div class="row">
      <!-- Col-md-12 -->
      <div class="col-md-12">
        <div class="card mt-4">  
  
      <div class="card-header">
        <div align="right" style="padding-top: 2% !important">
          <h3 class="card-title">Blocks</h3>
          <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Create Record</button>
        </div>
      </div>
    <br />
    <div class="card-body table-responsive p-0">
      <div class="container">
      <table id="user_table" class="table table-hover"">
        <thead>
          <tr>
            <th width="35%">Plot Category</th>
            <th width="35%">Block</th>
            <th width="35%">Description</th>
            <th widths="30%">Action</th>
          </tr>
        </thead>
      </table>
    </div>
    <br />
    <br />
  </div>
</div>
</div>
</div>
</div>
</body>
</html>

<div id="formModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="display: block;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Record</h4>
      </div>
      <div class="modal-body">
        <span id="form_result"></span>
        <form method="post" id="block_form" class="form-horizontal">
          @csrf

          <div class="CarryInput" style="display: flex;">
            
            <div class="input-field col-md-6 col-sm-6 col-lg-6">
                <select name="plot_category" id="plot_category" class="input form-control">
                    @foreach ($PlotCategories as $PlotCategory)
                      <option>{{$PlotCategory->CatName}}</option>
                    @endforeach
                  </select>
            </div>
            
            
            <div class="input-field col-md-6 col-sm-6 col-lg-6">
              <input type="text" name="blockName" id="blockName" class="input" required />
              <label for="blockName" id="label">Block Name : </label>
            </div>
            
          </div>

          <div class="CarryInput">

            <div class="input-field col-md-12 col-sm-12 col-lg-12">
                <input type="text" name="description" id="description" class="input" required />
                <label for="description" id="label">Description : </label>
            </div>
  
            </div>  
          
          <br />
          <div class="form-group addButton" align="center">
            <input type="hidden" name="action" id="action" value="Add" />
            <input type="hidden" name="hidden_id" id="hidden_id" />
            <input type="submit" name="action_button" id="action_button" class="btn btn-success" value="Add" />
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div id="confirmModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="display: block;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h2 class="modal-heading">Confirmation</h2>
      </div>
      <div class="modal-body">
        <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>


<!-- /.Container -->

<script>
  $(document).ready(function(){
    
   $('#user_table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
     url: "{{ route('block.index') }}",
    },
    columns: [
     {
      data: 'plot_category',
      name: 'plot_category'
     },
     {
      data: 'blockName',
      name: 'blockName'
     },
     {
      data: 'description',
      name: 'description'
     },
     {
      data: 'action',
      name: 'action',
      orderable: false
     }
    ]
   });
  
   $('#create_record').click(function(){
    $('#plot_category').val('');
    $('#blockName').val('');
    $('#description').val('');
    $('.modal-title').text('Add New Record');
    $('#action_button').val('Add');
    $('#action').val('Add');
    $('#form_result').html('');
  
    $('#formModal').modal('show');
   });
  
   $('#block_form').on('submit', function(event){
    event.preventDefault();
    var action_url = '';
  
    if($('#action').val() == 'Add')
    {
     var action_url = "{{ route('block.store') }}";
  //    alert(action_url);
  $("#formModal").modal("hide");
              Swal.fire(
              "Added!",
              "Banks Listing successfully Added.",
              "success"
              );
    }
  
    if($('#action').val() == 'Edit')
    {
     var action_url = "{{ route('block.update') }}";
     $("#formModal").modal("hide");
              Swal.fire(
              "Updated!",
              "Banks Listing successfully updated.",
              "success"
              );
    }
  
    $.ajax({
     url: action_url,
     method:"POST",
     data:$(this).serialize(),
     dataType:"json",
     success:function(data)
     {
       
      var html = '';
      if(data.errors)
      {
       html = '<div class="alert alert-danger">';
       for(var count = 0; count < data.errors.length; count++)
       {
        html += '<p>' + data.errors[count] + '</p>';
       }
       html += '</div>';
      }
      if(data.success)
      {
  
       $('#block_form')[0].reset();
       $('#user_table').DataTable().ajax.reload();
      }
      $('#form_result').html(html);
     }
    });
   });
  
   $(document).on('click', '.edit', function(){
    var id = $(this).attr('id');
  //   alert(id);
    $('#form_result').html('');
    $.ajax({
      url:"block/edit/"+id,
     dataType:"json",
     success:function(data)
     {
      $('#plot_category').val(data.result.plot_category);
      $('#blockName').val(data.result.blockName);
      $('#description').val(data.result.description);
      $('#hidden_id').val(id);
      $('.modal-title').text('Edit Record');
      $('#action_button').val('Edit');
      $('#action').val('Edit');
      $('#formModal').modal('show');
     }
    })
   });
  
  

  
    var user_id;


$(document).on('click', '.delete', function(){
 user_id = $(this).attr('id');
 $('#confirmModal').modal('show');
});

$('#ok_button').click(function(){
 $.ajax({
  url:"block/destroy/"+user_id,
  beforeSend:function(){
   $('#ok_button').text('Deleting...');
   },
  success:function(data)
  {
   setTimeout(function(){

    $('#confirmModal').modal('hide');
    $('#ok_button').text('OK');
    $('#user_table').DataTable().ajax.reload();
    Swal.fire(
           "Deleted!",
           "Banks Listing successfully Deleted.",
           "success"
           );

    
     }, 2000);
  }
 })
});
  
  
  
  });
</script>
@endsection