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
          <h3 class="card-title">Plot Type</h3>
          <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Create Record</button>
        </div>
      </div>
      <br />
      <div class="card-body table-responsive p-0">
        <div class="container">
          <table id="table" class="table table-hover">
            <thead>
              <tr>
                <th>Plot Type</th>
                <th>Total Plots</th>
                <th>Action</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
      <br />
      <br />
    </div>
  </div>
</div>
</div>
</body>
</html>

<div id="formModal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="display: block;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Record</h4>
      </div>
      <div class="modal-body">
        <span id="form_result"></span>
        <form method="post" id="plottype_form" class="form-horizontal">
          @csrf

          <div class="CarryInput">

            <div class="row">
              <div class="input-field col-md-4 col-sm-4 col-lg-4">
                <select type="text" name="society_id" id="society_id" class="form-control input" required="">
                  <option value="" selected="" disabled="">Select Society</option>
                  @if(!empty($data))
                  <option value="{{$data->id}}">{{$data->name}}</option>
                  @endif
                </select>
              </div>

              <div class="input-field col-md-4 col-sm-4 col-lg-4">
                <input type="number" name="total_society_plots" id="total_society_plots" class="form-control input" required readonly=""/>
                <label for="total_society_plots" id="label">Society Plots</label>
              </div>

              <div class="input-field col-md-4 col-sm-4 col-lg-4">
                <input type="hidden" id="alloted_society_plots_in_plot_type"/>
                <input type="number" name="total_remaining_plots" id="total_remaining_plots" class="form-control input" required readonly=""/>
                <label for="total_remaining_plots" id="label">Remaining Plots</label>
              </div>

            </div><br>

            <div class="row">

              <div class="input-field col-md-6 col-sm-6 col-lg-6">
                <input type="text" name="plot_type_name" id="plot_type_name" class="form-control input" required />
                <label for="plot_type_name" id="label">Plot Type Name</label>
              </div>

              <div class="input-field col-md-6 col-sm-6 col-lg-6">
                <input type="number" name="total_plots" id="total_plots" class="form-control input" required />
                <label for="total_plots" id="label">Total Plots</label>
              </div>

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

<div id="confirmModal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
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

<!-- /.Container -->

<script>
  $(document).ready(function(){

    $('#table').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
       url: "{{ route('plottype.index') }}",
     },
     columns: [
     {
      data: 'name',
      name: 'name'
    },
    {
      data: 'total_plots',
      name: 'total_plots'
    },
    {
      data: 'action',
      name: 'action',
      orderable: false
    }
    ]
  });

    $('#create_record').click(function(){
      $('#plottype_form')[0].reset();
      $('.modal-title').text('New Plot Type');
      $('#action_button').val('Submit');
      $('#action').val('Add');
      $('#form_result').html('');
      $('#formModal').modal('show');
    });

    $('#plottype_form').on('submit', function(event){
      event.preventDefault();
      var action_url = '';

      if($('#action').val() == 'Add')
      {
       var action_url = "{{ route('plottype.store') }}";
     }

     if($('#action').val() == 'Edit')
     {
       var action_url = "{{ route('plottype.update') }}";
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
        $('#plottype_form')[0].reset();
        $('#table').DataTable().ajax.reload();
        $('#formModal').modal('hide'); 
        Swal.fire(
          "Added!",
          "Plot type successfully added.",
          "success"
          );
      }
      if(data.updated)
      {
        $('#plottype_form')[0].reset();
        $('#table').DataTable().ajax.reload();
        $('#formModal').modal('hide'); 
        Swal.fire(
          "Updated!",
          "Plot type successfully updated.",
          "success"
          );
      }
      $('#form_result').html(html);
    }
  });
   });

    $(document).on('click', '.edit', function(){
      var id = $(this).attr('id');
      $('#form_result').html('');
      $.ajax({
        url:"plottype/edit/"+id,
        dataType:"json",
        success:function(data)
        {
          $('#society_id').val(data.result.society_id);
          if(data.last_alloted_as_plot_type.alloted_society_plots_in_plot_type != data.last_alloted_as_plot_type.total_society_plots)
          {
            $('#total_society_plots').val(data.last_alloted_as_plot_type.alloted_society_plots_in_plot_type);
          }
          else
          {
            $('#total_society_plots').val(data.last_alloted_as_plot_type.remaining_society_plots);
            $('#alloted_society_plots_in_plot_type').val(data.last_alloted_as_plot_type.alloted_society_plots_in_plot_type);
          }
          $('#plot_type_name').val(data.result.name);
          $('#total_plots').val(data.result.total_plots);
          $('#hidden_id').val(id);
          $('.modal-title').text('Edit Plot Type');
          $('#action_button').val('Update');
          $('#action').val('Edit');
          $('#formModal').modal('show');
          if(data.last_alloted_as_plot_type.alloted_society_plots_in_plot_type == data.last_alloted_as_plot_type.total_society_plots)
          {
            $('#total_plots').on('input',function(){
              var x = $('#total_society_plots').val();
              var z = $('#alloted_society_plots_in_plot_type').val();
              console.log(x);
              console.log(z);
            });
          }
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
      url:"plottype/destroy/"+user_id,
      beforeSend:function(){
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
         "Plot type successfully deleted.",
         "success"
         );
      }, 2000);
     }
   })
   });

    $('#society_id').on('change',function(){
      var society_id = $(this).val();

      $.ajax({
        url: '{{ route("get_total_society_plots") }}',
        type: 'POST',
        data:
        {
          "_token": "{{ csrf_token() }}",
          "society_id": society_id
        },
        success: function(response)
        {
          if(response[0].remaining_society_plots == 0 && (response[0].total_society_plots != response[0].alloted_society_plots_in_plot_type))
          {
            $('#total_society_plots').val(response[0].total_society_plots)
          }
          else
          {
            $('#total_society_plots').val(response[0].remaining_society_plots) 
          }
        }
      });
    });

    $('#total_plots').on('input',function(){
      var x = $('#total_society_plots').val();
      if(x != 0)
      {
        x = parseFloat(x);

        var y = $('#total_plots').val();
        y = parseFloat(y);

        if(Number.isNaN(x))
        {
          x = 0;
        }
        else if(Number.isNaN(y))
        {
          y = 0;
        }
        $('#total_remaining_plots').val(x-y);
      }
      else
      {
        Swal.fire(
          "Sorry",
          "No more plots left.",
          "error"
          );
        $('#formModal').modal('hide'); 
      }
    });

  });
</script>
@endsection