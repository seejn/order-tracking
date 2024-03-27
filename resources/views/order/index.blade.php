@extends('layout.main')
@extends('links.csslink')
@extends('links.jslink')
@section('title','Order')

{{-- @section('breadcrumb')
    <li class="breadcrumb-item font-weight-bolder"><a href="#">Order</a></li>
@endsection --}}

@section('content')
{{-- <div class="card">
    <div class="card-body">
        <h5 class="card-title">Order Content</h5>
        <p class="card-text">Main content goes here.</p>
    </div>
</div> --}}

    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modal1">
        <i class="fa-solid fa-plus"></i>
        Add Order
    </button>

    <!-- Modal 1 -->
    <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('order.controller') }}" method="POST">
                    @csrf   
                    <input type="hidden" name="action" value="add_order">
                
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Order Information</h1>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="formGroupExampleInput" placeholder="Enter Name">
                        </div>
                        <div class="mb-3">
                            <label for="formGroupExampleInput" class="form-label">
                                Rate
                            </label>
                            <div class="input-group">
                                <span class="input-group-text">Rs</span>
                                <input type="text" name="rate" class="form-control" aria-label="Amount" value="{{ $default['rate'] }}">
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
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
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
    <div class="row justify-content-between">
    @if ($orders -> count())
        @foreach ($orders as $order)
        <div class="col-lg-6 col-md-12 px-2 mb-2 ">

            <div class="shadow card order-card">
                <div class="card-header">
                    <h5 class="card-title">{{ $order->name }}</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Order ID:</strong> {{ $order->id }}</p>
                            <p><strong>Date:</strong> {{ $order->created_at }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Advance Payment:</strong> Rs {{ $order -> advance_payment }}</p>
                        </div>
    
                        <div style="display: none;">
                            {{ $completed_rate =  round(($order->employeeModule->completed_quantity/$order->quantity)*100,2) }}
                            {{ $defect_rate = round(($order->employeeModule->defect_quantity/$order->quantity)*100,2) }}
                            {{ $remaining_rate = round((($order->employeeModule->total_quantity+$order->employeeModule->on_progress)/$order->quantity)*100,2) }}
                        </div>
    
                        <div class="col-12 mb-3">
                            @if ($order->quantity - ($order->employeeModule->completed_quantity + $order->employeeModule->defect_quantity) > 0)
                                    <p><strong>Status:</strong> <span class="badge bg-warning text-dark"> Pending</span></p>
                            @else
                                    <p><strong>Status:</strong> <span class="badge bg-success text-light"> Completed</span></p>
                            @endif
                            <div class="progress-bar-container">
                                <div class="progress" style="height: 30px;">
                                    <div class="progress-bar bg-success" style="width: {{ $completed_rate }}%;">{{ $completed_rate }}%</div>
                                    <div class="progress-bar bg-danger" style="width: {{ $defect_rate }}%;">{{ $defect_rate }}%</div>
                                    <div class="progress-bar bg-warning text-dark" style="width: {{ $remaining_rate }}%;">{{ $remaining_rate }}%</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <a href="{{ route('order.view_details', $order->id) }}" class="btn btn-info">
                                <i class="fa-solid fa-circle-info"></i>
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-muted text-right">
                    <button type="button" class="btn btn-primary">
                        <i class="fa-solid fa-pen-to-square"></i>
                        Edit
                    </button>
                    <button type="button" class="btn btn-danger">
                        <i class="fa-solid fa-trash"></i>
                        Delete
                    </button>
                </div>
            </div>
        </div>

        @endforeach
    </div>
    @else
        <div class="card order-card mb-3">
            <div class="card-header">
                <h5 class="card-title">No Orders Found</h5>
            </div>
        </div>
    @endif

@endsection