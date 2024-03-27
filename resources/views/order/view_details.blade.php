@extends('layout.main')
@extends('links.csslink')
@extends('links.jslink')
@section('title','Order Detail Page')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('order') }}">Order</a></li>
    <li class="breadcrumb-item font-weight-bolder"><a href="#">View Details</a></li>
@endsection

@section('content')

<div class="card order-card">
    <div class="card-header">
        <h5 class="card-title">{{ $order->name }}</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>Order ID:</strong> {{ $order->id }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Advance Amount: </strong>Rs {{ $order->advance_payment }}</p>
                <p><strong>Date:</strong> {{ $order->created_at }}</p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-12">
                @if ($order->quantity - ($order->employeeModule->completed_quantity + $order->employeeModule->defect_quantity) > 0)
                        <p><strong>Status:</strong> <span class="badge bg-warning text-dark"> Pending</span></p>
                @else
                        <p><strong>Status:</strong> <span class="badge bg-success text-light"> Completed</span></p>
                @endif
            </div>
            <div style="display: none;">
                {{ $completed_rate =  round(($order->employeeModule->completed_quantity/$order->quantity)*100,2) }}
                {{ $defect_rate = round(($order->employeeModule->defect_quantity/$order->quantity)*100,2) }}
                {{ $remaining_rate = round((($order->employeeModule->total_quantity+$order->employeeModule->on_progress)/$order->quantity)*100,2) }}
            </div>
            
            <div class="col-12">
                <div class="progress-bar-container">
                    <div class="progress" style="height: 30px;">
                        <div class="progress-bar bg-success" style="width: {{ $completed_rate }}%;">{{ $completed_rate }}%</div>
                        <div class="progress-bar bg-danger" style="width: {{ $defect_rate }}%;">{{ $defect_rate }}%</div>
                        <div class="progress-bar bg-warning text-dark" style="width: {{ $remaining_rate }}%;">{{ $remaining_rate }}%</div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <p><strong>Ordered Quantity:</strong> {{ $order->quantity }}</p>
                <p><strong>Completed:</strong> {{ $order->employeeModule->completed_quantity }} <span class="badge bg-success text-light"> {{ $completed_rate }}%</span></p>
                <p><strong>Remaining:</strong> {{ $order->employeeModule->total_quantity+$order->employeeModule->on_progress }} <span class="badge bg-warning text-dark"> {{ $remaining_rate }}%</span></p>
            </div>
            <div class="col-md-6">
                
                <p><strong>On Progress:</strong> {{ $order->employeeModule->on_progress }}</p>
                <p><strong>Damaged:</strong> {{ $order->employeeModule->defect_quantity }} <span class="badge bg-danger text-light"> {{ $defect_rate }}%</span></p>
            </div>
        </div>
        <hr>
        <h6 class="btn btn-outline-dark my-3">
            <i class="fa-solid fa-clipboard-user"></i>
            Order Assigned To: 
            <span class="badge bg-primary text-light">{{ $order->assignOrder->count() }}</span>
        </h6>
        <div class="row">
            @foreach($order->assignOrder as $o)
            <ul class="col-lg-6 col-md-12 shadow list-group mb-3">
    
                <div style="display: none;">
                    {{ $completed_rate =  round(($o->completed_quantity/$o->assigned_quantity)*100,2) }}
                    {{ $defect_rate = round(($o->defect_quantity/$o->assigned_quantity)*100,2) }}
                    {{ $remaining_rate = round(($o->assigned_quantity - ($o->completed_quantity + $o->defect_quantity))/$o->assigned_quantity*100,2) }}
                </div>
                <li class="list-group-item p-3">
                    <div class="row">
                        <h5 class="mb-3 text-center font-weight-bolder">
                            <i class="fa-solid fa-user"></i>
                            {{ $o->employee->name }}
                        </h5>
                        <hr>
                        <div class="col-md-6">
                            <p>Assigned Quantity: {{ $o->assigned_quantity }}</p>
                            <p>Completed: {{ $o->completed_quantity }}  <span class="badge bg-success text-light"> {{ $completed_rate }}%</span></p>
                        </div>
                        <div class="col-md-6 text-right">
                            <p>Remaining: {{ $o->assigned_quantity - ($o->completed_quantity + $o->defect_quantity) }} <span class="badge bg-warning text-dark"> {{ $remaining_rate }}%</span></p>
                            <p>Damaged: {{ $o->defect_quantity }} <span class="badge bg-danger text-light"> {{ $defect_rate }}%</span></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
    
                        <div class="col-12">
                            @if ($o->assigned_quantity - ($o->completed_quantity + $o->defect_quantity) > 0)
                                    <p>Status: <span class="badge bg-warning text-dark"> Pending</span></p>
                            @else
                                    <p>Status: <span class="badge bg-success text-light"> Completed</span></p>
                            @endif
                            <div class="progress" style="height: 15px;">
                                <div class="progress-bar bg-success" style="width: {{ $completed_rate }}%;">{{ $completed_rate }}%</div>
                                <div class="progress-bar bg-danger" style="width: {{ $defect_rate }}%;">{{ $defect_rate }}%</div>
                                <div class="progress-bar bg-warning text-dark" style="width: {{ $remaining_rate }}%;">{{ $remaining_rate }}%</div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-end mt-2">
                        <button type="button" class="btn btn-primary">
                            <i class="fa-solid fa-pen-to-square"></i>
                            Edit
                        </button>
                    </div>
                </li>
            </ul>
            @endforeach
        </div>
    </div>
    <div class="card-footer text-muted text-right">
        <button type="button" class="btn btn-danger">
            <i class="fa-solid fa-trash"></i>
            Delete This Order
        </button>
    </div>
</div>

@endsection
