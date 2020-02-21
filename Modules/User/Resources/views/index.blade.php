@extends('user::layouts.master')

@section('content') 
@if(session('success'))
    <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
         <strong>{{ session('success') }}</strong>
    </div>
@endif

    <p class="Lead">Welcome {{ $userDetails->first_name }} {{ $userDetails->last_name }}! You have # task(s) assigned</p>
    <hr>
    <table id="table_id" class="table table-bordered">
        <thead class="thead thead-dark">
              <tr>
                  <th>Project Name</th>
                  <th>Task</th>
                  <th>Due Date</th>
                  <th>Time</th>
                  <th>Status</th>
                   <th>Action</th>
              </tr>
        </thead>   
    </table>
@endsection
