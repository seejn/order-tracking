@extends('layout.main')
@extends('links.csslink')
@extends('links.jslink')
@section('title','Assign Order')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('order') }}">Order</a></li>
    <li class="breadcrumb-item font-weight-bolder"><a href="#">Assign Order</a></li>
@endsection

@section('content')
<div class="row">
    <div class=" col-md-9 p-0  border-end border-success-subtle">
        <form action="{{ route('assign_order') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="action" value="assign_order">
            <div class="m-auto" style="width: 90%;">
        
        
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
                    <label for="">Employees</label>
                    <select class="form-select" name="employee_id" aria-label="Default select example">
                        <option selected disabled>Select Employee</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee -> id }}">{{ $employee -> name }}</option>
                        @endforeach
                    </select>
                </div>
        

                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Assign Quantity</label>
                    <input type="number" name="assigned_quantity" class="form-control" id="formGroupExampleInput" placeholder="Enter Quantity">
                </div>
        
        
                <div class="mb-3">
                    <label for="formGroupExampleInput" class="form-label">Set Rate</label>
                    <input type="number" name="rate" class="form-control" id="formGroupExampleInput" placeholder="Enter Rate for Employee">
                </div>
                <div class="modal-footer">
                    <a href="{{ route('order') }}" class="btn btn-secondary mx-2">
                        <i class="fa-solid fa-ban"></i>
                        Cancel
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-check"></i>
                        Assign
                    </button>
                </div>
            </div>
        </form>  
    </div>

    <div class="col-md-3" id="emp_info">
        <h6 id="order"></h6>
        <h6 id="total_qty"></h6>
        <br>
        <h6>
            <i class="fa-solid fa-clipboard-user"></i>
            Assigned To: 
            <span class="badge bg-primary">0</span></h6>
        <div>

        </div>
    </div>
</div>

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
            url: '/order/getorder',
            type: 'POST',
            data: {
                'id':id,
                'action':'get_order'
            },
            dataType: 'json',
            success: function (response){
                $('#order').text(`Order: ${response.orders[0].order_name}`);
                $('#total_qty').text(` Remaining Quantity: ${response.quantity}`);
                $('#emp_info').children().last().empty();
                if(response.orders != null){
                    $('#emp_info .badge').text(response.orders.length);
                    $.each(response.orders,function(key,value){
                        $('#emp_info').children().last().append(`
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="card-title">
                                        <strong>
                                            ${value['emp_name']}    
                                        </strong>
                                    </div>
                                    <div class="card-text">Assigned Quantity: ${value['assigned_quantity']}</div>
                                </div>
                            </div>
                        `);
                    })
                }else{
                    $('#emp_info .badge').text(0);
                }


            },
            error: function(){
                alert("error");
            }
        })
    }
</script>
@endsection
