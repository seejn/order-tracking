@extends('layout.main')
@extends('links.csslink')
@extends('links.jslink')
@section('title','Employee')

@section('content')
   
    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
        <i class="fa-solid fa-plus"></i>
        Add Employee
    </button>

    <!-- Modal 1 -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('employee.controller') }}" method="POST">
                    @csrf   
                    <input type="hidden" name="action" value="add_employee">
                
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Employee Information</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="formGroupExampleInput" placeholder="Enter Name">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label">Contact</label>
                            <div class="input-group">
                                <input type="text" name="contact" class="form-control" aria-label="Contact" placeholder="Enter Contact No.">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput2" class="form-label">Address</label>
                            <input type="text" name="address" class="form-control" id="formGroupExampleInput2" placeholder="Enter Address">
                        </div>
                        <div class="mb-3">
                            <label for="addformGroupExampleInput2" class="form-label">Date of Birth</label>
                            <input type="date" name="DOB" max="2004-12-30" class="form-control" id="formGroupExampleInput2">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fa-solid fa-xmark"></i>
                            Close
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="fa-solid fa-plus"></i>
                            Add
                        </button>
                    </div>
                </form>                            
            </div>
        </div>
    </div>

    <div class="row mx-0 mt-5 container justify-content-between">

        @foreach ($employees as $employee)
        
        <div class=" col-md-12 col-lg-6 px-4 mb-5">
            <div class=" employee-card">
                <div class="text-center">
                    <img src="{{ asset('storage/employee/avatar/user.png') }}" alt="Employee Photo" width="150px">
                    <br><br>
                    <h3 class="mb-0">{{ $employee -> name }}</h3>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Phone:</strong> {{ $employee -> contact }}</p>
                        <p><strong>Address:</strong> {{ $employee -> address }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Date of Birth:</strong> {{ date('j F, Y', strtotime($employee -> DOB))}}</p>
                        <p><strong>Pending Payment: </strong>Rs 70,000</p>
                    </div>
                    <button class="btn btn-info w-100">
                        <i class="fa-solid fa-circle-info"></i>
                        View Details
                    </button>
                    <div class="mt-3 d-flex justify-content-end py-3 px-0 border-top">
                        <a class="btn btn-primary me-1" href="{{ route('edit_employee_view', $employee -> id) }}">
                           <i class="fa-solid fa-pen-to-square"></i>
                            Edit
                        </a>
                        <button class="btn btn-danger ms-1">
                            <i class="fa-solid fa-trash"></i>
                            Remove
                        </button>
                    </div>
                </div>
            </div>
        </div>

        @endforeach

    </div>
    

@endsection