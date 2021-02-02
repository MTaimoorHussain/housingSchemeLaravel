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
          <h3 class="card-title">Allotment</h3>
          <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Create Record</button>
        </div>
      </div>
      <br>
      <div class="card-body table-responsive p-0">
        <div class="container">
          <table id="table" class="table table-hover" >
            <thead>
              <tr>
                <th>Membership No</th>
                <th>Name</th>
                <th>CNIC</th>
                <th>Plot Type</th>
                <th>Plot Category</th>
                <th>Block No</th>
                <th>Plot No</th>
                <th>Plot Area</th>
                <th>Cost of land</th>
                <th>Allotment No</th>
                <th>Actions</th>
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
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="display: block;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Record</h4>
      </div>
      <div class="modal-body">
        <span id="form_result"></span>
        <form method="post" id="allotment_form" class="form-horizontal">
          @csrf

          {{-- <div class="CarryInput" style="display: flex;"> --}}
          
            <div class="row CarryInput">
            <div class="col-md-4 col-sm-4 col-lg-4">
              <label for="membership_no">Membership No#</label>
              <select name="membership_no" id="membership_no" class="form-control" required>
                <option>232343432</option>
                <option>545312121</option>
              </select>
              
              {{-- <input type="text" name="membership_no" id="membership_no" class="form-control" required /> --}}
            </div>


            <div class="input-field col-md-4 col-sm-4 col-lg-4">
              <label for="member_name">Name : </label>
              <input type="text" name="member_name" id="member_name" class="form-control" required />
            </div>

            <div class="input-field col-md-4 col-sm-4 col-lg-4">
              <label for="member_cnic_no">CNIC : </label>
              <select name="member_cnic_no" id="member_cnic_no" class="form-control" required>
                <option>5637642345</option>
                <option>6573456465</option>
              </select>
              {{-- <input type="text" name="member_cnic_no" id="member_cnic_no" class="form-control" required /> --}}
            </div>

          </div>


          <div class="row CarryInput">


            <div class="input-field col-md-3 col-sm-3 col-lg-3">
              <label for="plot_type_id">Plot Type : </label>
              <select name="plot_type_id" id="plot_type_id" class="form-control" required>
              <option>Commercial</option>
              <option>Residential</option>
              </select>
              {{-- <input type="text" name="plot_type_id" id="plot_type_id" class="form-control" required /> --}}
            </div>


            <div class="input-field col-md-3 col-sm-3 col-lg-3">
              <label for="plot_category_id">Plot Category : </label>
              <select name="plot_category_id" id="plot_category_id" class="form-control" required>
              <option>A-1</option>
              <option>A-2</option>
              </select>
              {{-- <input type="text" name="plot_category_id" id="plot_category_id" class="form-control" required /> --}}
            </div>

            <div class="input-field col-md-3 col-sm-3 col-lg-3">
              <label for="block_no">Block No# : </label>
              <select name="block_no" id="block_no" class="form-control" required>
                <option>1</option>
                <option>2</option>
              </select>
              {{-- <input type="text" name="block_no" id="block_no" class="form-control" required /> --}}
            </div>


            <div class="input-field col-md-3 col-sm-3 col-lg-3">
              <label for="plot_no">Plot No# : </label>
              <select name="plot_no" id="plot_no" class="form-control" required>
                <option>43</option>
                <option>54</option>
              </select>
              {{-- <input type="text" name="plot_no" id="plot_no" class="form-control" required /> --}}
            </div>

          </div>



          <div class="row CarryInput">

            <div class="input-field col-md-3 col-sm-3 col-lg-3">
              <label for="plot_area">Plot Size : </label>
              <input type="text" name="plot_area" id="plot_area" class="form-control" required />
            </div>


            <div class="input-field col-md-3 col-sm-3 col-lg-3">
              <label for="cost_of_land">Cost Of Land : </label>
              <input type="text" name="cost_of_land" id="cost_of_land" class="form-control" required />
            </div>


            <div class="input-field col-md-3 col-sm-3 col-lg-3">
              <label for="no_of_shares">No# Of Shares : </label>
              <input type="text" name="no_of_shares" id="no_of_shares" class="form-control" required />
            </div>


            <div class="input-field col-md-3 col-sm-3 col-lg-3">
              <label for="allotment_no">Allotment No# : </label>
              <input type="text" name="allotment_no" id="allotment_no" class="form-control" required />
            </div>
            

          </div>

          <br />
          <div class="modal-footer">
          <div class="form-group addButton" align="center">
            <input type="hidden" name="action" id="action" value="Add" />
            <input type="hidden" name="hidden_id" id="hidden_id" />
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
        url: "{{ route('allotment.index') }}",
      },
      columns: [
      {
        data: 'membership_no',
        name: 'membership_no'
      },
      {
        data: 'member_name',
        name: 'member_name'
      },
      {
        data: 'member_cnic_no',
        name: 'member_cnic_no'
      },
      {
        data: 'plot_category_id',
        name: 'plot_category_id'
      },
      {
        data: 'plot_type_id',
        name: 'plot_type_id'
      },
      {
        data: 'block_no',
        name: 'block_no'
      },
      {
        data: 'plot_no',
        name: 'plot_no'
      },
      {
        data: 'plot_area',
        name: 'plot_area'
      },
      {
        data: 'cost_of_land',
        name: 'cost_of_land'
      },
      {
        data: 'allotment_no',
        name: 'allotment_no'
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
      $('#membership_no').val('');
      $('#member_name').val('');
      $('#member_cnic_no').val('');
      $('#plot_type_id').val('');
      $('#plot_category_id').val('');
      $('#block_no').val('');
      $('#plot_no').val('');
      $('#plot_area').val('');
      $('#cost_of_land').val('');
      $('#allotment_no').val('');
      $('.modal-title').text('Add New Record');
      $('#action_button').val('Add');
      $('#action').val('Add');
      $('#form_result').html('');
      $('#formModal').modal('show');
    }
    );
    $('#allotment_form').on('submit', function(event)
    {
      event.preventDefault();
      var action_url = '';
      if($('#action').val() == 'Add')
      {
        var action_url = "{{ route('allotment.store') }}";
        $("#formModal").modal("hide");
        Swal.fire(
          "Added!",
          "Banks Listing successfully Added.",
          "success"
          );
      }
      if($('#action').val() == 'Edit')
      {
        var action_url = "{{ route('allotment.update') }}";
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
            $('#allotment_form')[0].reset();
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
        url:"allotment/edit/"+id,
        dataType:"json",
        success:function(data)
        {
          $('#membership_no').val(data.result.membership_no);
          $('#member_name').val(data.result.member_name);
          $('#member_cnic_no').val(data.result.member_cnic_no);
          $('#plot_type_id').val(data.result.plot_type_id);
          $('#plot_category_id').val(data.result.plot_category_id);
          $('#block_no').val(data.result.block_no);
          $('#plot_no').val(data.result.plot_no);
          $('#plot_area').val(data.result.plot_area);
          $('#cost_of_land').val(data.result.cost_of_land);
          $('#allotment_no').val(data.result.allotment_no);
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
      url:"allotment/destroy/"+user_id,
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
@endsection.