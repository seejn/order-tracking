<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Index</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css
">
</head>
<body>
    <div class="container mt-3">


        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Employee</button>
        
        
        <!-- Modal -->
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
                                    <input type="text" name="contact" class="form-control" aria-label="Contact">
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="formGroupExampleInput2" class="form-label">Address</label>
                                <input type="text" name="address" class="form-control" id="formGroupExampleInput2" placeholder="Enter Address">
                            </div>
                            <div class="mb-3">
                                <label for="addformGroupExampleInput2" class="form-label">Date of Birth</label>
                                <input type="date" name="DOB" class="form-control" id="formGroupExampleInput2">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>                            
                </div>
            </div>
        </div>


        <table class="table mt-5">
            <tr>
                <th scope="col">Date</th>
                <th scope="col">Name</th>
                <th scope="col">Contact</th>
                <th scope="col">Address</th>
                <th scope="col">DOB</th>
                <th scope="col">Action</th>

            </tr>
            @if ($employees -> count())
                @foreach ($employees as $employee)

                <tr>
                    <td>{{ $employee -> created_at }}</td>
                    <td>{{ $employee -> name }}</td>
                    <td>{{ $employee -> contact }}</td>
                    <td>{{ $employee -> address }}</td>
                    <td>{{ $employee -> DOB }}</td>
                    <td>
                        <button class="btn btn-primary disabled">Edit</button>
                        <form action="{{ route('employee.controller') }}" method="POST">
                            @csrf
                            <input type="hidden" name="action" value="delete_employee">
                            <input type="hidden" name="id" value="{{ $employee->id }}">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>

                @endforeach    
            @else
                <tr>
                    <td>No Employees Found!!</td>
                </tr>
            @endif
            
        </table>

    </div>
{{-- 
    <form action="{{ route('order.controller') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="avatar">
        <input type="hidden" name="action" value="upload_avatar">
        <input type="hidden" name="id" value="9">
        <input type="submit">
    </form> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js
"></script>
</body>
</html>