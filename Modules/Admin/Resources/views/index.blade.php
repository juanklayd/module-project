@extends('admin::layouts.master')

@section('content')
<div class="alert alert-info alert-dismissible fade show" role="alert"></div>

        <hr>
        <div class="row">
            <div class="col-md-8">
              <h1 class=" lead">User accounts</h1>
            </div>
            <div class="col-md-4">

            </div>
        </div>
        <hr>
    	<table id="table_id" class="table table-bordered">
		    <thead class="thead thead-dark">
	            <tr>
                  <th>Profile Picture</th>
                  <th>User Name</th>
	                <th>First Name</th>
	                <th>Last Name</th>
                  <th>Middle Name</th>
                  <th>Actions</th>
	            </tr>
		    </thead>
		        
		</table>



    <!-- Modal for Edditing -->

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title lead" id="exampleModalLabel">Edit record</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id ='editForm'>
          @csrf
              <div class="modal-body" id="editBody">

                  
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-outline-primary">Save changes</button>
              </div>
          </form>
        </div>
      </div>
    </div>



    <script type="text/javascript">

    $.ajaxSetup({
    headers: {
       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
          var token = $("input[name='_token']").val();

    $(document).ready(function(){

        $('.alert').hide();
        $('.empty').hide();
        $('.emptyUpdate').hide();

        var dataTable= $('#table_id').DataTable( {
        "ajax": "{{route('usersShow')}}",
        "columns": [
            { "data": "profile_picture" },
            { "data": "username" },
            { "data": "first_name" },
            { "data": "last_name" },
            { "data": "mid_name" },
            { "data": "actions" },
        ]
        } );



    //show edit form
  $(document).on('click','.edit',function(){
          var id = $(this).attr('userId');

          $.ajax({
            url:"{{route('editUser')}}",
            method:"POST",
            data:{
              id:id,
              _token:token
            },
            success:function(data){
              $('#editModal').modal('show');
             
              $('#editBody').html(data);
             
            }   
          });  
        });

    //update
      $( "#editForm" ).submit(function( event ) {
         event.preventDefault();
         
        $.ajax({
          url:"{{route('saveEditUser')}}",
          method:"POST",
          data: $("#editForm").serialize(),
          
          success:function(data){
            $('#editModal').modal('hide');
            
            dataTable.ajax.reload();

            $('.empty').hide();
            $('.alert').append('<span id="alertMessage">Record Updated!</span>');
            $('.alert').show();
            $(".alert").delay(4000).fadeOut(500);
            setTimeout(function(){
              $('#alertMessage').remove();
            }, 5000);
            
          }
              
        }); 
      });

      //delete
       $(document).on('click','.destroy',function(){
      var conf = confirm('Are you sure you want to delete this record?');
      var id = $(this).attr('userid');

      if(conf){
        $.ajax({
          url:"{{route('destroyUser')}}",
          method:"POST",
          data:{
            id:id,
            _token:token
          },
          success:function(data){
            dataTable.ajax.reload();
            $('.alert').append('<span id="alertMessage">Record deleted!</span>');
            $('.alert').show();
            $(".alert").delay(4000).fadeOut(500);
            setTimeout(function(){
              $('#alertMessage').remove();
            }, 5000);
          },
          error: function(jqxhr, status, exception) {
             alert(name+' still has a task/project. Please remove all of his/her task/project to delete this record.');
         }

        });  
      }
    }); 

        // end
    });
    </script>
@endsection
