<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AssignOrder</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css
    ">
</head>
<body>
    
    <div class="container mt-3">


        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Assign Order</button>
        
        
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('assign_order') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="action" value="assign_order">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Assign Order</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">


                            <div class="mb-3">
                                <label for="">Employees</label>
                                <select class="form-select" name="employee_id" aria-label="Default select example">
                                    <option selected disabled>Select Employee</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee -> id }}">{{ $employee -> name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="mb-3">
                                <label for="">Orders</label>
                                <select class="form-select" onchange="init(this)" name="order_id" aria-label="Default select example">
                                    <option selected disabled>Select Order</option>
                                    @foreach ($orders as $order)
                                        <option value="{{ $order -> id }}">{{ $order -> name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="formGroupExampleInput" class="form-label">Quantity</label>
                                <input id="total_qty" disabled type="number" name="total_qty" class="form-control" id="formGroupExampleInput">
                            </div>

                            <div class="mb-3">
                                <label for="formGroupExampleInput" class="form-label">Assign Quantity</label>
                                <input type="number" name="assigned_quantity" class="form-control" id="formGroupExampleInput" placeholder="Enter Quantity">
                            </div>


                            <div class="mb-3">
                                <label for="formGroupExampleInput" class="form-label">Set Rate</label>
                                <input type="number" name="rate" class="form-control" id="formGroupExampleInput" placeholder="Enter Rate for Employee">
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
                <th scope="col">Order</th>
                <th scope="col">Employee</th>
                <th scope="col">Assigned Quantity</th>
                <th scope="col">Completed Quantity</th>
                <th scope="col">On Progress</th>
                <th scope="col">rate</th>
                <th scope="col">Amount</th>
                <th scope="col">Action</th>

            </tr>
            @if ($assign_orders -> count())
            @foreach ($assign_orders as $assign_order)

            <tr>
                <td>{{ $assign_order -> created_at }}</td>
                <td>{{ $assign_order -> order -> name }}</td>
                <td>{{ $assign_order -> employee -> name }}</td>
                <td>{{ $assign_order -> assigned_quantity }}</td>
                <td>{{ $assign_order -> completed_quantity }}</td>
                <td>{{ $assign_order -> on_progress }}</td>
                <td>{{ $assign_order -> rate }}</td>
                <td>{{ $assign_order -> amount }}</td>
                <td>
                    <button class="btn btn-primary disabled">Edit</button>
                    {{-- <a href="{{ route('employee.assign_order.delete', ['id' => $assign_order->id]) }}" class="btn btn-danger">Delete</a> --}}
                </td>
            </tr>

            @endforeach
            @else
                <tr>
                    <td>No Assigned Orders Found!!</td>
                </tr>
            @endif
        </table>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js
    "></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>

        function init(elem){
            getQuantity(elem[elem.selectedIndex].value);
        }
        function getQuantity(id){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/order/getquantity',
                type: 'POST',
                data: {
                    'id':id,
                    'action':'get_quantity'
                },
                dataType: 'json',
                success: function (response){
                    // alert(response.quantity);
                    $("#total_qty").val(response.quantity);
                },
                error: function(){
                    alert("error");
                }
            })
        }
    </script>
</body>
</html>