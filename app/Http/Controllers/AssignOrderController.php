<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AssignOrder;
use App\Models\EmployeeModule;
use App\Models\Employee;

use App\Http\Controllers\EmployeeModuleController;

class AssignOrderController extends Controller
{
    //
    
    public function add(Request $request){
        $assign_order = AssignOrder::create([
            'order_id' => $request -> get('order_id'),
            'employee_id' => $request -> get('employee_id'),
            'assigned_quantity' => $request -> get('assigned_quantity'),
            'on_progress' => $request -> get('assigned_quantity'),
            'rate' => $request -> get('rate'),
        ]);
        $emp_id = $request -> get('employee_id');
        $emp_name = Employee::find($emp_id) -> name;
        
        EmployeeModuleController::updateTotalQuantity($request -> get('order_id'));
        EmployeeModuleController::updateOnProgress($request -> get('order_id'));
    
        $msg = ['success', "Order Successfully Assigned to $emp_name!"];
        return $msg;
    }

    public function submitOrder(Request $request){
        
        $order = AssignOrder::where('order_id',$request->get('order_id'))
        ->where('employee_id',$request->get('employee_id'))
        ->first();

        $order -> completed_quantity += $request -> get('completed_quantity');
        $order -> amount = $order -> completed_quantity * $order -> rate;
        $order -> defect_quantity += $request -> get('defect_quantity');
        $order -> on_progress -= ($request -> get('completed_quantity') + $request -> get('defect_quantity')); 
        $order -> save();

        EmployeeModuleController::updateOnProgress($request -> get('order_id'));
        EmployeeModuleController::updateCompletedQuantity($request -> get('order_id'));
        EmployeeModuleController::updateDefectQuantity($request -> get('order_id'));

        $msg = ['success','Order Successfully Recorded!'];
        return $msg;
    }

    public function index(Request $request){
        $action = $request -> get('action');

        switch($action){
            case 'assign_order':
                $msg = $this -> add($request);
                break;
            
            case 'getemployeeorder':
                $assign_orders = AssignOrder::where('employee_id',$request->get('id'))->get();
                
                if($assign_orders->isEmpty()){
                    return response()->json(['orders'=>null]);
                }

                foreach($assign_orders as $o){
                    $order['id'] = $o -> order_id;
                    $order['name'] = $o -> order -> name;
                    $order['on_progress'] = $o -> on_progress;
                    $orders[] = $order;
                }

                return response()->json(['orders'=>$orders]);
                break;

            case 'submit_order':
                $msg = $this -> submitOrder($request);
                return redirect()->route('submit_order_view')->with($msg[0],$msg[1]);
            
            default:
                dd($request);
        }

        return redirect()->route('assign_order_view')->with($msg[0], $msg[1]);
    }
}
