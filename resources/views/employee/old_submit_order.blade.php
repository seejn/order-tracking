<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SubmitOrder</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css
    ">
</head>
<body>
    
    <div class="container mt-3">


        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Submit Order</button>
        
        
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('submit_order') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="action" value="submit_order">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Submit Order</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="mb-3">
                                <label for="">Employees</label>
                                <select class="form-select" onchange="getEmployeeOrder(this)" name="employee_id" aria-label="Default select example">
                                    <option selected disabled>Select Employee</option>
                                    @foreach ($employees as $employee)
                                        <option value="{{ $employee -> id }}">{{ $employee -> name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="mb-3">
                                <label for="">Assigned Orders (<span id="employees_order_count">0</span>)</label>
                                <select class="form-select" name="order_id" aria-label="Default select example">
                                    <option selected disabled>Select Order</option>
                                    
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="formGroupExampleInput" class="form-label">Completed Quantity</label>
                                <input type="number" name="completed_quantity" class="form-control" id="formGroupExampleInput" value="0" placeholder="Enter Completed Quantity">
                            </div>


                            <div class="mb-3">
                                <label for="formGroupExampleInput" class="form-label">Defect Quantity</label>
                                <input type="number" name="defect_quantity" class="form-control" id="formGroupExampleInput" value="0" placeholder="Enter Defect Quantity">
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

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js
    "></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>

        function getEmployeeOrder(elem){
            let id = elem[elem.selectedIndex].value;
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/employee/assigned_order',
                type: 'POST',
                data: {
                    'id':id,
                    'action':'getemployeeorder'
                },
                dataType: 'json',
                success: function (response){

                    $('select[name=order_id]').children().remove();
                    if(response.orders){
                        // alert(response.orders.length);
                        $("#employees_order_count").text(response.orders.length);
                        $.each(response.orders, function(key,value){
    
                            $('select[name=order_id]').append(`<option value='${value['id']}'>${value['name']} Remaining: ${value['on_progress']}</option>`);
                        });
                    }else{
                        $("#employees_order_count").text(0);
                    }

                },
                error: function(){
                    alert("error");
                }
            })
        }
    </script>
</body>
</html>