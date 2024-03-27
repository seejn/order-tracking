@extends('layout.main')
@extends('links.csslink')
@extends('links.jslink')
@section('title','Edit Employee Information')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('employee') }}">Employee</a></li>
    <li class="breadcrumb-item font-weight-bolder"><a href="#">Edit Employee Information</a></li>
@endsection

@section('content')
<div class="row">
    <div class=" col-md-12 p-0">
        <form action="{{ route('employee.controller') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="action" value="edit_employee">
            <input type="hidden" name="id" value="{{ $employee -> id }}">
            <div class="m-auto" style="width: 90%;">
        
        
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">
                        <i class="fa-solid fa-user"></i>
                        Full Name
                    </label>
                    <input type="text" class="form-control" name="name" value="{{ $employee -> name }}"  id="formGroupExampleInput" placeholder="Enter Name">
                </div>
        
        
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">
                        <i class="fa-solid fa-phone"></i>
                        Contact
                    </label>
                    <input type="number" name="contact" class="form-control" value="{{ $employee -> contact }}" id="formGroupExampleInput" placeholder="Enter Contact Number">
                </div>


                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">
                        <i class="fa-solid fa-location-dot"></i>
                        Address
                    </label>
                    <input type="text" name="address" class="form-control" value="{{ $employee -> address }}" id="formGroupExampleInput" placeholder="Enter Address">
                </div>


                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">
                        <i class="fa-solid fa-calendar-days"></i>
                        Date of Birth
                    </label>
                    <input type="date" name="DOB" max="2005-01-01" value="{{ $employee -> DOB }}" class="form-control" id="formGroupExampleInput" placeholder="MM/DD/YYYY">
                </div>

                <div class="modal-footer">
                    <a href="{{ route('employee') }}" class="btn btn-secondary me-3">
                        <i class="fa-solid fa-ban"></i>
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-pen"></i>
                        Apply Changes
                    </button>
                </div>
            </div>
        </form>  
    </div>

</div>

@endsection
