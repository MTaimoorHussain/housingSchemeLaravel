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
          <h3 class="card-title">Plot Categories</h3>
          <button type="button" name="create_record" id="create_record" class="btn btn-success btn-sm">Create Record</button>
        </div>
      </div>
      <br />
      <div class="card-body table-responsive p-0">
        <div class="container">
          <table id="table" class="table table-hover"">
            <thead>
              <tr>
                <th>Plot Type</th>
                <th>Category</th>
                <th>Area (Sq. Yards)</th>
                <th>Total Plots</th>
                <th>Action</>
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

<div id="form_modal" class="modal fade" role="dialog" data-keyboard="false" data-backdrop="static">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header" style="display: block;">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Record</h4>
      </div>
      <div class="modal-body">
        <span id="form_result"></span>
        <form method="post" id="plot_category_form" class="form-horizontal">
          @csrf

          <div class="CarryInput" style="display: flex;">


            <div class="input-field col-md-4 col-sm-4 col-lg-4">
              <select name="plot_type_id" id="plot_type_id" class="form-control input">
                <option value="" disabled="" selected="">Select Plot Type</option>
                @foreach ($plot_types as $plot_type)
                <option value="{{$plot_type->id}}">{{$plot_type->name}}</option>
                @endforeach
              </select>
            </div>

            <div class="input-field col-md-4 col-sm-4 col-lg-4">
              <input type="number" name="total_plots" id="total_plots" class="form-control input" required readonly=""/>
              <label for="total_plots" id="label">Total Plots</label>
            </div>

            <div class="input-field col-md-4 col-sm-4 col-lg-4">
              <input type="number" name="remaining_plots" id="remaining_plots" class="form-control input" required readonly=""/>
              <label for="remaining_plots" id="label">Remaining Plots</label>
            </div>

          </div><br>

          <div class="CarryInput" style="display: flex;">

            <div class="input-field col-md-4 col-sm-4 col-lg-4">
              <input type="text" name="name" id="name" class="form-control input" required />
              <label for="name" id="label">Category Name</label>
            </div>
            
            <div class="input-field col-md-4 col-sm-4 col-lg-4">
              <input type="text" name="area" id="area" class="form-control input" required />
              <label for="area" id="label">Area</label>
            </div>
            
            <div class="input-field col-md-4 col-sm-4 col-lg-4">
              <input type="number" name="no_of_plots" id="no_of_plots" class="form-control input" required />
              <label for="no_of_plots" id="label">No. Of Plots</label>
            </div>

          </div>

        </div><br />
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
        url: "{{ route('plotcategory.index') }}",
      },
      columns: [
      {
        data: 'plot_type_name.name',
        name: 'plot_type_name.name'
      },
      {
        data: 'name',
        name: 'name'
      },
      {
        data: 'area',
        name: 'area'
      },
      {
        data: 'no_of_plots',
        name: 'no_of_plots'
      },
      {
        data: 'action',
        name: 'action',
        orderable: false
      }
      ]
    });

    $('#create_record').click(function()
    {
      $('#plot_category_form')[0].reset();
      $('.modal-title').text('Add Plot Category');
      $('#action_button').val('Submit');
      $('#action').val('Add');
      $('#form_result').html('');
      $('#form_modal').modal('show');
    }
    );

    $('#plot_category_form').on('submit', function(event)
    {
      event.preventDefault();
      var action_url = '';

      if($('#action').val() == 'Add')
      {
        var action_url = "{{ route('plotcategory.store') }}";
      }
      if($('#action').val() == 'Edit')
      {
        var action_url = "{{ route('plotcategory.update') }}";
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
          $('#plot_category_form')[0].reset();
          $('#table').DataTable().ajax.reload();
          $('#form_modal').modal('hide'); 
          Swal.fire(
            "Added!",
            "Plot category successfully added.",
            "success"
            );
        }
        if(data.updated)
        {
          $('#plot_category_form')[0].reset();
          $('#table').DataTable().ajax.reload();
          $('#form_modal').modal('hide'); 
          Swal.fire(
            "Updated!",
            "Plot category successfully updated.",
            "success"
            );
        }
        $('#form_result').html(html);
      }
    });
    });

    $(document).on('click', '.edit', function(){
      var id = $(this).attr('id');
      $('#remaining_plots').val('');
      $('#form_result').html('');
      $.ajax({
        url:"plotcategory/edit/"+id,
        dataType:"json",
        success:function(data)
        {
          $('#plot_type_id').val(data.result.plot_type_id);
          if(data.prev_alloted_plot.alloted_plots != data.prev_alloted_plot.total_plots)
          {
            $('#total_plots').val(data.prev_alloted_plot.remaining_plots);
          }
          else
          {
            $('#total_plots').val(0);
          }
          $('#name').val(data.result.name);
          $('#area').val(data.result.area);
          $('#no_of_plots').val(data.result.no_of_plots);
          $('#hidden_id').val(id);
          $('.modal-title').text('Edit Plot Category');
          $('#action_button').val('Update');
          $('#action').val('Edit');
          $('#form_modal').modal('show');
        }
      })
    });
    var user_id;
    $(document).on('click', '.delete', function()
    {
      user_id = $(this).attr('id');
      $('#confirmModal').modal('show');
    }
    );
    $('#ok_button').click(function()
    {
      $.ajax(
      {
        url:"plotcategory/destroy/"+user_id,
        beforeSend:function()
        {
          $('#ok_button').text('Deleting...');
          $('#ok_button').prop("disabled",true);
          $('.cancel').prop("disabled",true);
          $('.delete_close').hide();
        },
        success:function(data)
        {
          setTimeout(function()
          {
            $('#confirmModal').modal('hide');
            $('#ok_button').text('OK');
            $('#ok_button').prop("disabled",false);
            $('.cancel').prop("disabled",false);
            $('.delete_close').show();
            $('#table').DataTable().ajax.reload();
            Swal.fire(
             "Deleted!",
             "Plot category successfully deleted.",
             "success"
             );
          }, 2000);
        }
      })
    });

    $('#plot_type_id').on('change',function()
    {
      $('#remaining_plots').val('');
      $('#no_of_plots').val('');
      var plot_type_id = $(this).val();
      $.ajax({
        url: '{{ route("get_total_plots_of_plot_type") }}',
        type: 'POST',
        data:
        {
          "_token": "{{ csrf_token() }}",
          "plot_type_id": plot_type_id
        },
        success: function(response)
        {
          if(response[0].remaining_plots == 0 && (response[0].total_plots != response[0].alloted_plots))
          {
            $('#total_plots').val(response[0].total_plots)
          }
          else
          {
            $('#total_plots').val(response[0].remaining_plots) 
          }
        }
      });
    });

    $('#no_of_plots').on('input',function(){
      var x = $('#total_plots').val();
      if(x != 0)
      {
        x = parseFloat(x);

        var y = $('#no_of_plots').val();
        y = parseFloat(y);

        if(Number.isNaN(x))
        {
          x = 0;
        }
        else if(Number.isNaN(y))
        {
          y = 0;
        }
        $('#remaining_plots').val(x-y);
      }
      else
      {
        Swal.fire(
          "Sorry",
          "No more plots left.",
          "error"
          );
        $('#form_modal').modal('hide'); 
      }
    });

  });
</script>
@endsection