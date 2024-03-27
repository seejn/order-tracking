@extends('layout.main')
@extends('links.csslink')
@extends('links.jslink')
@section('title','Submit Order')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('order') }}">Order</a></li>
    <li class="breadcrumb-item font-weight-bolder"><a href="#">Submit Order</a></li>
@endsection

@section('content')
<form action="{{ route('submit_order') }}" method="POST" style="width: 90%; margin: 0 auto;" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="action" value="submit_order">
    <div class="modal-body">

        <div class="mb-3">
            <label for="">Employee</label>
            <select class="form-select" onchange="getEmployeeOrder(this)" name="employee_id" aria-label="Default select example">
                <option selected disabled>Select Employee</option>
                @foreach ($employees as $employee)
                    <option value="{{ $employee -> id }}">{{ $employee -> name }}</option>
                @endforeach
            </select>
        </div>


        <div class="mb-3">
            <label for="">Assigned Orders <span id="employees_order_count" class="badge badge-primary">0</span></label>
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
        <a href="{{ route('order') }}" class="btn btn-secondary mx-2">
            <i class="fa-solid fa-ban"></i>
            Cancel
        </a>
        <button type="submit" class="btn btn-primary">
            <i class="fa-solid fa-pen"></i>
            Save changes
        </button>
    </div>
</form> 

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
                        if(value['on_progress'] > 0){
                            $('select[name=order_id]').append(`<option value='${value['id']}'>${value['name']} Remaining: ${value['on_progress']}</option>`);
                        }
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
@endsection
