<?php

use Illuminate\Support\Facades\Route;

use App\Models\Order;
use App\Models\Employee;
use App\Models\AssignOrder;

use App\Http\Controllers\OrderController;
use App\Http\Controllers\AssignOrderController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeModuleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    return view('welcome');
})->name('login');

Route::get('/dashboard', function () {

    return view('dashboard');
})->name('dashboard');


// Orders
Route::get('/order', function () {     
    $order = new Order();
    // dd($order -> getDefaultColumnName('quantity'));
    $default = Array(
        'quantity' => $order -> getDefaultColumnName('quantity'),
        'rate' => $order -> getDefaultColumnName('rate'),
        'advance_payment' => $order -> getDefaultColumnName('advance_payment'),
    );

    $orders = Order::all()->reverse();
    return view('order.index', compact('default', 'orders'));
}) -> name('order');


Route::get('/order/details/{id}', function ($id) {
    $order = Order::find($id);
    // dd($order->assignorder->first());
    return view('order.view_details', compact('order'));
}) -> name('order.view_details');

Route::get('/order/assign_view', function(){
    $employees = Employee::all();
    $orders = Order::all();
    $assign_orders = AssignOrder::all();

    return view('order.assign_order', compact('employees','orders','assign_orders'));
})->name('assign_order_view');


Route::get('/order/submit_view', function(){
    $employees = Employee::all();
    $orders = Order::all();

    return view('order.submit_order', compact('employees','orders'));
})->name('submit_order_view');

Route::post('/order/submit',[AssignOrderController::class,'index'])->name('submit_order');
Route::post('/order/controller',[OrderController::class, 'index'])->name('order.controller');
Route::post('/order/assign',[AssignOrderController::class, 'index'])->name('assign_order');
Route::post('/order/getorder',[EmployeeModuleController::class, 'index'])->name('order.getorder');




// Employees
Route::get('/employee', function () {  

    
    // dd($order -> getDefaultColumnName('quantity'));

    $employees = Employee::all()->reverse();
    return view('employee.index', compact('employees'));
}) -> name('employee');

Route::get('/employee/edit_view/{id}', function($id){  

    $employee = Employee::find($id);
    // dd($employee);
    return view('employee.edit_employee', compact('employee'));
}) -> name('edit_employee_view');

Route::post('/employee/assigned_order', [AssignOrderController::class,'index'])->name('employee.assigned_order');
Route::post('/employee/controller',[EmployeeController::class, 'index'])->name('employee.controller');

