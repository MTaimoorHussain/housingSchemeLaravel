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
          <h3 class="card-title">Banks Listing</h3>
          <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Create Record</button>
        </div>
      </div>
      <br>
      <div class="card-body table-responsive p-0">
        <div class="container">
          <table id="table" class="table table-hover" >
            <thead>
              <tr>
                <th>Code</th>
                <th>Bank</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>
          <br>
        </div>
      </div>
    </div>
  </div>
  <!-- Col-md-12 -->
</div>
<!-- End Row -->
</div>
<!-- End Container -->

<div id="formModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="display: block;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Record</h4>
      </div>
      <div class="modal-body">
        <span id="form_result"></span>
        <form method="post" id="allbank_form" class="form-horizontal">
          @csrf

          <div class="CarryInput" style="display: flex;">

            <div class="input-field col-md-6 col-sm-6 col-lg-6">
              <input type="text" name="slug" id="slug" class="input" required />
              <label for="slug" id="label">Code : </label>
            </div>


            <div class="input-field col-md-6 col-sm-6 col-lg-6">
              <input type="text" name="name" id="name" class="input" required />
              <label for="name" id="label">Bank : </label>
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
  $(document).ready(function()
  {
    $('#table').DataTable(
    {
      processing: true,
      serverSide: true,
      ajax: 
      {
        url: "{{ route('allbank.index') }}",
      },
      columns: [
      {
        data: 'slug',
        name: 'slug'
      },
      {
        data: 'name',
        name: 'name'
      },
      {
        data: 'action',
        name: 'action',
        orderable: false
      }
      ]
    }
    );
    $('#create_record').click(function()
    {
      $('#slug').val('');
      $('#name').val('');
      $('.modal-title').text('Add New Record');
      $('#action_button').val('Add');
      $('#action').val('Add');
      $('#form_result').html('');
      $('#formModal').modal('show');
    }
    );
    $('#allbank_form').on('submit', function(event)
    {
      event.preventDefault();
      var action_url = '';
      if($('#action').val() == 'Add')
      {
        var action_url = "{{ route('allbank.store') }}";
        $("#formModal").modal("hide");
        Swal.fire(
          "Added!",
          "Banks Listing successfully Added.",
          "success"
          );
      }
      if($('#action').val() == 'Edit')
      {
        var action_url = "{{ route('allbank.update') }}";
        $("#formModal").modal("hide");
        Swal.fire(
          "Updated!",
          "Banks Listing successfully updated.",
          "success"
          );
      }

      $.ajax(
      {
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
            $('#allbank_form')[0].reset();
            $('#table').DataTable().ajax.reload();
          }
          $('#form_result').html(html);
        }
      }
      );
    }
    );
    $(document).on('click', '.edit', function()
    {
      var id = $(this).attr('id');
      $('#form_result').html('');
      $.ajax(
      {
        url:"allbank/edit/"+id,
        dataType:"json",
        success:function(data)
        {
          $('#slug').val(data.result.slug);
          $('#name').val(data.result.name);
          $('#hidden_id').val(id);
          $('.modal-title').text('Edit Record');
          $('#action_button').val('Edit');
          $('#action').val('Edit');
          $('#formModal').modal('show');
        }
      }
      )
    }
    );
    var user_id;
    $(document).on('click', '.delete', function()
    {
      user_id = $(this).attr('id');
      $('#confirmModal').modal('show');
    }
    );
    $('#ok_button').click(function(){
     $.ajax(
     {
      url:"allbank/destroy/"+user_id,
      beforeSend:function()
      {
        $('#ok_button').text('Deleting...');
      },
      success:function(data)
      {
        setTimeout(function(){
          $('#confirmModal').modal('hide');
          $('#ok_button').text('OK');
          $('#table').DataTable().ajax.reload();
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