@extends('layout.main')
@extends('links.csslink')
@extends('links.jslink')
@section('title','Dashboard')

{{-- @section('breadcrumb')
    <li class="breadcrumb-item font-weight-bolder"><a href="/">Dashboard</a></li>
@endsection --}}


@section('content')
<div class="row justify-content-around ">

    <div class="card col-lg-2 bg-primary text-light">
        <div class="card-body">
            <h5 class="card-title">Total Order Count</h5>
            <p class="card-text">3</p>
        </div>
    </div>
    <div class="card col-lg-2 bg-success text-light">
        <div class="card-body">
            <h5 class="card-title">Completed Order Count</h5>
            <p class="card-text">0</p>
        </div>
    </div>
    <div class="card col-lg-2 bg-warning text-light">
        <div class="card-body">
            <h5 class="card-title">Pending Order Count</h5>
            <p class="card-text">3</p>
        </div>
    </div>
    <div class="card col-lg-2 bg-danger text-light">
        <div class="card-body">
            <h5 class="card-title">Damaged Order Count</h5>
            <p class="card-text">1</p>
        </div>
    </div>
</div>
<div class="form-group mt-5">
    <label for="orderStatus">Filter by Order Status:</label>
    <select class="form-control" id="orderStatus">
      <option>All</option>
      <option>Pending</option>
      <option>Completed</option>
      <!-- Add more options for different order statuses -->
    </select>
</div>
<table class="table mt-5">
    <thead>
      <tr>
        <th>Order ID</th>
        <th>Customer Name</th>
        <th>Order Status</th>
        <th>Order Date</th>
        <!-- Add more table headers as needed -->
      </tr>
    </thead>
    <tbody>
      <!-- Loop through the orders and display each order as a table row -->
      
      <tr>
        <td>22</td>
        <td>Shyam [ Jacket ]
        </td>
        <td>Pending</td>
        <td>2023-05-01</td>
      </tr>
      <tr>
        <td>21</td>
        <td>Krishna [ Rain Coat Order ]</td>
        <td>Pending</td>
        <td>2023-05-15</td>
      </tr>
      <tr>
        <td>20</td>
        <td>Shankhar Manufacturer [ Half pant ]
        </td>
        <td>Pending</td>
        <td>2023-05-15</td>
      </tr>
    </tbody>
  </table>
@endsection