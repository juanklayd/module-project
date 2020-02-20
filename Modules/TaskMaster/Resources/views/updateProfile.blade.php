@extends('taskmaster::layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Account') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        


		                <input type="text" name="firstName" class="form-control mb-2 " placeholder="First Name" required id="firstNameAdd" >

		                <input type="text" name="midName" class="form-control mb-2 firstNameEdit" placeholder="Middle Name" required id="firstNameAdd" >
		              
		                <input type="text" name="lastName" class="form-control lastNameEdit" placeholder="Last Name" required id="lastNameAdd" >
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection