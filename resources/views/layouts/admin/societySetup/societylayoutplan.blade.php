@extends('layouts.admin.master')




@section('content')

<!-- Container -->
<div class="container">
  
  <div class="container">    
    
    <div align="right" style="padding-top: 2% !important">
      <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Create Record</button>
    </div>
    <br />
    <div class="table-responsive">
      <table id="user_table" class="table table-hover"">
        <thead>
          <tr>
            <th width="35%">Plot Type</th>
            <th width="35%">No. Of Plots</th>
            <th widths="30%">Action</th>
          </tr>
        </thead>
      </table>
    </div>
    <br />
    <br />
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
        <form method="post" id="societylayoutplan_form" class="form-horizontal">
          @csrf

          <div class="CarryInput">
            
            <div class="input-field col-md-12 col-sm-12 col-lg-12">
                <select name="plotTypeName" id="plotTypeName" class="input">
                    @foreach ($plotTypes as $plotType)
                      <option>{{$plotType->plotType}}</option>
                    @endforeach
                </select>
            </div>
            
          </div>

          <div class="CarryInput">
            
            <div class="input-field col-md-12 col-sm-12 col-lg-12">
              <input type="text" name="noOfPlots" id="noOfPlots" class="input" required />
              <label for="noOfPlots" id="label">No. Of Plots : </label>
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

</div>
<!-- /.Container -->

<script>
  $(document).ready(function(){
    
   $('#user_table').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
     url: "{{ route('societylayoutplan.index') }}",
    },
    columns: [
     {
      data: 'plotTypeName',
      name: 'plotTypeName'
     },
     {
      data: 'noOfPlots',
      name: 'noOfPlots'
     },
     {
      data: 'action',
      name: 'action',
      orderable: false
     }
    ]
   });
  
   $('#create_record').click(function(){
    $('#plotTypeName').val('');
    $('#noOfPlots').val('');
    $('.modal-title').text('Add New Record');
    $('#action_button').val('Add');
    $('#action').val('Add');
    $('#form_result').html('');
  
    $('#formModal').modal('show');
   });
  
   $('#societylayoutplan_form').on('submit', function(event){
    event.preventDefault();
    var action_url = '';
  
    if($('#action').val() == 'Add')
    {
     var action_url = "{{ route('societylayoutplan.store') }}";
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
     var action_url = "{{ route('societylayoutplan.update') }}";
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
  
       $('#societylayoutplan_form')[0].reset();
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
      url:"societylayoutplan/edit/"+id,
     dataType:"json",
     success:function(data)
     {
      $('#plotTypeName').val(data.result.plotTypeName);
      $('#noOfPlots').val(data.result.noOfPlots);
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
  url:"societylayoutplan/destroy/"+user_id,
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