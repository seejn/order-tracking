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


        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Order</button>
        
        
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('order.controller') }}" method="POST">
                        @csrf   
                        <input type="hidden" name="action" value="add_order">
                    
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Order Information</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="formGroupExampleInput" class="form-label">Name</label>
                                <input type="text" name="name" class="form-control" id="formGroupExampleInput" placeholder="Enter Name">
                            </div>
                            <div class="mb-3">
                                <label for="formGroupExampleInput" class="form-label">Rate</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rs</span>
                                    <input type="text" name="rate" class="form-control" aria-label="Amount" value="{{ $default['rate'] }}">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="formGroupExampleInput2" class="form-label">Quantity</label>
                                <input type="text" name="quantity" class="form-control" id="formGroupExampleInput2" placeholder="Enter Quantity" value="{{ $default['quantity'] }}">
                            </div>
                            <div class="mb-3">
                                <label for="addformGroupExampleInput2" class="form-label">Advance Payment</label>
                                <input type="text" name="advance_payment" class="form-control" id="formGroupExampleInput2" placeholder="Enter Advance Payment" value="{{ $default['advance_payment'] }}">
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
                <th scope="col">Quantity</th>
                <th scope="col">Rate</th>
                <th scope="col">Advance </th>
                <th scope="col">Progress</th>
                <th scope="col">Action</th>

            </tr>
            @if ($orders -> count())
                @foreach ($orders as $order)

                <tr>
                    <td>{{ $order -> created_at }}</td>
                    <td>{{ $order -> name }}</td>
                    <td>{{ $order -> quantity }}</td>
                    <td>{{ $order -> rate }}</td>
                    <td>{{ $order -> advance_payment }}</td>
                    <td class="text-danger"> 0% ( pending )</td>
                    <td>
                        <button class="btn btn-primary disabled">Edit</button>
                        <form action="{{ route('order.controller') }}" method="POST">
                            @csrf
                            <input type="hidden" name="action" value="delete_order">
                            <input type="hidden" name="id" value="{{ $order->id }}">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>

                @endforeach    
            @else
                <tr>
                    <td>No Orders Found!!</td>
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