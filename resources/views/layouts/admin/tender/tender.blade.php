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
            <th width="35%">Organization Name</th>
            <th width="35%">Department</th>
            <th width="35%">Tender Type</th>
            <th width="35%">Tender Notice</th>
            <th width="35%">City</th>
            <th width="35%">Email Address</th>
            <th width="35%">Phone Number</th>
            <th width="35%">Quoted Amount</th>
            <th width="35%">Current Date</th>
            <th width="35%">Time Duration</th>
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
        <form method="post" id="tender_form" class="form-horizontal">
          @csrf

          <div class="CarryInput" style="display: flex;">
            
            <div class="input-field col-md-6 col-sm-6 col-lg-6">
              <input type="text" name="tenderName" id="tenderName" class="input" required />
              <label for="tenderName" id="label">Organization Name : </label>
            </div>
            
            
            <div class="input-field col-md-6 col-sm-6 col-lg-6">
              <input type="text" name="tenderDepartment" id="tenderDepartment" class="input" required />
              <label for="tenderDepartment" id="label">Department : </label>
            </div>
            
          </div>

          <div class="CarryInput" style="display: flex;">
            
            <div class="input-field col-md-6 col-sm-6 col-lg-6">
              <input type="text" name="tenderType" id="tenderType" class="input" required />
              <label for="tenderType" id="label">Tender Type : </label>
            </div>
            
            
            <div class="input-field col-md-6 col-sm-6 col-lg-6">
              <input type="text" name="tenderNotice" id="tenderNotice" class="input" required />
              <label for="tenderNotice" id="label">Tender Notice : </label>
            </div>
            
          </div>

          <div class="CarryInput" style="display: flex;">
            
            <div class="input-field col-md-6 col-sm-6 col-lg-6">
              <input type="text" name="city" id="city" class="input" required />
              <label for="city" id="label">City : </label>
            </div>
            
            
            <div class="input-field col-md-6 col-sm-6 col-lg-6">
              <input type="text" name="email" id="email" class="input" required />
              <label for="email" id="label">Email Address : </label>
            </div>
            
          </div>

          <div class="CarryInput" style="display: flex;">
            
            <div class="input-field col-md-6 col-sm-6 col-lg-6">
              <input type="text" name="phoneNumber" id="phoneNumber" class="input" required />
              <label for="phoneNumber" id="label">Phone Number : </label>
            </div>
            
            
            <div class="input-field col-md-6 col-sm-6 col-lg-6">
              <input type="text" name="amount" id="amount" class="input" required />
              <label for="amount" id="label">Quoted Amount : </label>
            </div>
            
          </div>

          <div class="CarryInput" style="display: flex;">
            
            <div class="input-field col-md-6 col-sm-6 col-lg-6">
              <input type="text" name="date" id="date" class="input" required />
              <label for="date" id="label">Current Date : </label>
            </div>
            
            
            <div class="input-field col-md-6 col-sm-6 col-lg-6">
              <input type="text" name="timeDuration" id="timeDuration" class="input" required />
              <label for="timeDuration" id="label">Time Duration : </label>
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
     url: "{{ route('tender.index') }}",
    },
    columns: [
     {
      data: 'tenderName',
      name: 'tenderName'
     },
     {
      data: 'tenderDepartment',
      name: 'tenderDepartment'
     },
     {
      data: 'tenderType',
      name: 'tenderType'
     },
     {
      data: 'tenderNotice',
      name: 'tenderNotice'
     },
     {
      data: 'city',
      name: 'city'
     },
     {
      data: 'email',
      name: 'email'
     },
     {
      data: 'phoneNumber',
      name: 'phoneNumber'
     },
     {
      data: 'amount',
      name: 'amount'
     },
     {
      data: 'date',
      name: 'date'
     },
     {
      data: 'timeDuration',
      name: 'timeDuration'
     },
     {
      data: 'action',
      name: 'action',
      orderable: false
     }
    ]
   });
  
   $('#create_record').click(function(){
    $('#tenderName').val('');
    $('#tenderDepartment').val('');
    $('#tenderType').val('');
    $('#tenderNotice').val('');
    $('#city').val('');
    $('#email').val('');
    $('#phoneNumber').val('');
    $('#amount').val('');
    $('#date').val('');
    $('#timeDuration').val('');
    $('.modal-title').text('Add New Record');
    $('#action_button').val('Add');
    $('#action').val('Add');
    $('#form_result').html('');
  
    $('#formModal').modal('show');
   });
  
   $('#tender_form').on('submit', function(event){
    event.preventDefault();
    var action_url = '';
  
    if($('#action').val() == 'Add')
    {
     var action_url = "{{ route('tender.store') }}";
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
     var action_url = "{{ route('tender.update') }}";
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
  
       $('#tender_form')[0].reset();
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
      url:"tender/edit/"+id,
     dataType:"json",
     success:function(data)
     {
      $('#tenderName').val(data.result.tenderName);
      $('#tenderDepartment').val(data.result.tenderDepartment);
      $('#tenderType').val(data.result.tenderType);
      $('#tenderNotice').val(data.result.tenderNotice);
      $('#city').val(data.result.city);
      $('#email').val(data.result.email);
      $('#phoneNumber').val(data.result.phoneNumber);
      $('#amount').val(data.result.amount);
      $('#date').val(data.result.date);
      $('#timeDuration').val(data.result.timeDuration);
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
  url:"tender/destroy/"+user_id,
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