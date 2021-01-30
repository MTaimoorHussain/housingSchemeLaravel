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
          <h3 class="card-title">Society Information</h3>
          @if(empty($data))
          <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Registration Form</button>
          @endif
        </div>
      </div>
      <br>
      <div class="card-body table-responsive p-0">
        <div class="container">
          <table id="table" class="table table-hover" >
            <thead>
              <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Registration No#</th>
                <th>Registration Date</th>
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

<div id="form_modal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="display: block;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Record</h4>
      </div>
      <div class="modal-body">
        <span id="form_result"></span>
        <form method="post" id="registration_form" class="form-horizontal">
          @csrf

          <div class="CarryInput" style="display: flex;">
            <div class="input-field col-md-6 col-sm-6 col-lg-6">
              <input type="text" name="name" id="name" class="form-control input" required="" />
              <label for="name" id="label">Name</label>
            </div>

            <div class="input-field col-md-6 col-sm-6 col-lg-6">
              <input type="text" name="slug" id="slug" class="form-control input" required=""/>
              <label for="slug" id="label">Short Name</label>
            </div>
          </div>

          <div class="CarryInput" style="display: flex;">
            <div class="input-field col-md-12 col-sm-12 col-lg-12">
              <input type="text" name="address" id="address" class="form-control input" required=""/>
              <label for="address" id="label">Address</label>
            </div>
          </div>

          <div class="CarryInput" style="display: flex;">
            <div class="input-field col-md-6 col-sm-6 col-lg-6">
              <input type="text" name="registration_no" id="registration_no" class="form-control input" required=""/>
              <label for="registration_no" id="label">Registration No#</label>
            </div>

            <div class="input-field col-md-6 col-sm-6 col-lg-6">
              <input type="date" name="registration_date" id="registration_date" class="form-control input" required=""/>
            </div>
          </div>

          <div class="CarryInput" style="display: flex;">
            <div class="input-field col-md-4 col-sm-4 col-lg-4">
              <select type="text" name="country" id="country" class="form-control input" required="">
                <option value="" selected="" disabled="">Select Country</option>
                @foreach($countries as $country)
                <option value="{{$country->id}}">{{$country->name}}</option>
                @endforeach
              </select>
            </div>

            <div class="input-field col-md-4 col-sm-4 col-lg-4">
              <select type="text" name="state" id="state" class="form-control input" required="">
                <option value="" selected="" disabled="">Select State</option>
              </select>
            </div>

            <div class="input-field col-md-4 col-sm-4 col-lg-4">
              <select type="text" name="city" id="city" class="form-control input" required="">
                <option value="" selected="" disabled="">Select City</option>
              </select>
            </div>
          </div>

          <br />
          <div class="modal-footer">
            <div class="form-group addButton" align="center">
              <input type="hidden" name="action" id="action" value="Add" />
              <input type="hidden" name="hidden_id" id="hidden_id" />
              <input type="button" class="btn btn-default" value="Close" data-dismiss="modal"/>
              <input type="submit" name="action_button" id="action_button" class="btn btn-success" value="Add" />
            </div>
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
        <button type="button" class="close delete_close" data-dismiss="modal">&times;</button>
        <h2 class="modal-heading">Confirmation</h2>
      </div>
      <div class="modal-body">
        <h4 align="center" style="margin:0;">Are you sure you want to remove this data?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
        <button type="button" class="btn btn-default cancel" data-dismiss="modal">Cancel</button>
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
      searching: false,
      
      ajax: 
      {
        url: "{{ route('society_registration.index') }}",
      },
      columns: [
      {
        data: 'name',
        name: 'name'
      },
      {
        data: 'address',
        name: 'address'
      },
      {
        data: 'registration_no',
        name: 'registration_no'
      },
      {
        data: 'registration_date',
        name: 'registration_date'
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
      $('#name').val('');
      $('.modal-title').text('Add Society Information');
      $('#action_button').val('Submit');
      $('#action').val('Add');
      $('#form_result').html('');
      $('#form_modal').modal('show');
    }
    );
    $('#registration_form').on('submit', function(event)
    {
      event.preventDefault();
      var action_url = '';
      if($('#action').val() == 'Add')
      {
        action_url = "{{ route('society_registration.store') }}";
      }
      if($('#action').val() == 'Edit')
      {
        action_url = "{{ route('society_registration.update') }}";
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
          if(data.added)
          {
            $('#registration_form')[0].reset();
            $('#table').DataTable().ajax.reload();
            $('#form_modal').modal('hide'); 
            Swal.fire(
              "Added!",
              "Society information successfully added.",
              "success"
              );
          }
          if(data.updated)
          {
            $('#registration_form')[0].reset();
            $('#table').DataTable().ajax.reload();
            $('#form_modal').modal('hide'); 
            Swal.fire(
              "Updated!",
              "Society information successfully updated.",
              "success"
              );
          }
          $('#form_result').html(html);
        }
      });
    }
    );
    $(document).on('click', '.edit', function()
    {
      var id = $(this).attr('id');
      $('#form_result').html('');
      $.ajax(
      {
        url:"society_registration/edit/"+id,
        dataType:"json",
        success:function(data)
        {
          $('#name').val(data.result.name);
          $('#slug').val(data.result.slug);
          $('#address').val(data.result.address);
          $('#registration_no').val(data.result.registration_no);
          $('#registration_date').val(data.result.registration_date);
          // $('#country').val(data.result.country_id);
          $('#hidden_id').val(id);
          $('.modal-title').text('Edit Society Information');
          $('#action_button').val('Update');
          $('#action').val('Edit');
          $('#form_modal').modal('show');
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
      url:"society_registration/destroy/"+user_id,
      beforeSend:function()
      {
        $('#ok_button').text('Deleting...');
        $('#ok_button').prop("disabled",true);
        $('.cancel').prop("disabled",true);
        $('.delete_close').hide();

      },
      success:function(data)
      {
        setTimeout(function(){
          $('#confirmModal').modal('hide');
          $('#ok_button').text('OK');
          $('#ok_button').prop("disabled",false);
          $('.cancel').prop("disabled",false);
          $('.delete_close').show();
          $('#table').DataTable().ajax.reload();
          Swal.fire(
           "Deleted!",
           "Society information successfully deleted.",
           "success"
           );
        }, 2000);
      }
    })
   });
    
    $('#country').on('change',function(){
      var country_id = $(this).val();

      $.ajax({
        url: '{{ route("get_states") }}',
        type: 'POST',
        data:
        {
          "_token": "{{ csrf_token() }}",
          "country_id": country_id
        },
        success: function(response)
        {
          $("#state").empty();
          $("#state").append("<option value='' disabled='' selected=''>Select State</option>");

          $.each(response, function(index, obj){
            $("#state").append("<option value="+response[index].id+">"+response[index].name+"</option>");
          });
        }
      });

    });

    $('#state').on('change',function(){
      var state_id = $(this).val();

      $.ajax({
        url: '{{ route("get_cities") }}',
        type: 'POST',
        data:
        {
          "_token": "{{ csrf_token() }}",
          "state_id": state_id
        },
        success: function(response)
        {
          $("#city").empty();
          $("#city").append("<option value='' disabled='' selected=''>Select City</option>");

          $.each(response, function(index, obj){
            $("#city").append("<option value="+response[index].id+">"+response[index].name+"</option>");
          });
        }
      });

    });

  });
</script>
@endsection