@extends('taskmaster::layouts.master')

@section('content')
   <div class="alert alert-info alert-dismissible fade show" role="alert"></div>

    <div class="container">
        
        <div class="form-row">

            <div class="col-md-8">
              <h1 class="lead">Projects</h1>
            </div>

            <div class="col-md-4">
                <button type="button" class="btn btn-outline-primary float-right" id="addBtn" data-target="#addModal" data-toggle="modal" >Add a new Project</button>
            </div>
        </div>

        <hr>
    	<table id="table_id" class="display">
		    <thead>
	            <tr>

	                <th>Project Name</th>
                    <th>Project Description</th>
                    <th>Actions</th>
	               
	            </tr>
		    </thead>
		        
		</table>
    </div>
    

    <!-- Modal for Adding -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add a project</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form  id="addForm" method="POST">
            @csrf
            <div class="modal-body">
              <p class="text-danger empty"><em>*Please fill all information below.</em></p>
              
              

              <div class="input-group input-group-lg mb-2">
                  <input type="text" name="projName" class="form-control" placeholder="Project Name">   
              </div>

              <textarea class="form-control" name="projDesc" rows="3" placeholder="Project Description." required></textarea>
              
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
             
                  <input type="hidden" name="date" id="dateAdd">
                  <button type="submit" class="btn btn-primary add">Save project</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal for Edditing -->

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit record</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form id ='editForm'>
          @csrf
              <div class="modal-body" id="editBody">

                  
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Save changes</button>
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
        "ajax": "{{route('project_dtb')}}",
        "columns": [
            { "data": "project_name" },
            { "data": "project_desc" },
            { "data": "actions" },
           
        ]
        } );

        //Adding
    $( "#addForm" ).submit(function( event ) {
        event.preventDefault();

        $.ajax({
          url:"{{route('addProj')}}",
          method:"POST",
          data: $("#addForm").serialize(),
          success:function(data){
            $('#addModal').modal('hide');
            dataTable.ajax.reload();
            
            $("#addForm")[0].reset();
            $('.empty').hide();
            $('.alert').append('<span id="alertMessage">Project Added!</span>');
            $('.alert').show();
            $(".alert").delay(4000).fadeOut(500);
            setTimeout(function(){
              $('#alertMessage').remove();
            }, 5000);
            
          }
              
        }); 
    });   


    //show edit form
  $(document).on('click','.edit',function(){
          var id = $(this).attr('projId');

          $.ajax({
            url:"{{route('editProj')}}",
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
          url:"{{route('saveEditProj')}}",
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
      var id = $(this).attr('projId');

      if(conf){
        $.ajax({
          url:"{{route('destroyProj')}}",
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
             alert('this record still has a task. Please delete it all then delete this project.');
         }

        });  
      }
    }); 

        // end
    });
    </script>
@endsection
