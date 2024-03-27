<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\EmployeeModule;
use App\Models\Order;
use App\Models\AssignOrder;

class EmployeeModuleController extends Controller
{
    //

    public static function updateTotalQuantity($order_id){

        $employee_module = EmployeeModule::where('order_id', $order_id)->first();
        $employee_module -> total_quantity = Order::find($order_id) -> quantity - AssignOrder::where('order_id',$order_id)->sum('assigned_quantity');
        return $employee_module -> save();

    }

    public static function updateOnProgress($order_id){

        $employee_module = EmployeeModule::where('order_id', $order_id)->first();
        $employee_module -> on_progress = AssignOrder::where('order_id', $order_id)->sum('on_progress');
        return $employee_module -> save();

    }

    
    public static function updateCompletedQuantity($order_id){

        $employee_module = EmployeeModule::where('order_id', $order_id)->first();
        $employee_module -> completed_quantity = AssignOrder::where('order_id', $order_id)->sum('completed_quantity');
        return $employee_module -> save();

    }


    public static function updateDefectQuantity($order_id){

        $employee_module = EmployeeModule::where('order_id', $order_id)->first();
        $employee_module -> defect_quantity = AssignOrder::where('order_id', $order_id)->sum('defect_quantity');
        return $employee_module -> save();

    }

    public function index(Request $request){

        $action = $request -> get('action');

        switch($action){
            case 'get_order':
                $orders = [];
                $quantity = EmployeeModule::where('order_id',$request -> get('id'))->first()->total_quantity;
                $assign_orders = AssignOrder::where('order_id',$request -> get('id'))->get();

                if(!$assign_orders->count()){
                    $orders = null;
                }
                else{
                    foreach($assign_orders as $o){
                        $order = [
                            'order_name' => $o -> order -> name,
                            'emp_name' => $o -> employee -> name,
                            'assigned_quantity' => $o -> assigned_quantity,
                        ];
                        $orders[] = $order;
                    }
                    // $orders = $assign_orders -> first() -> assigned_quantity;
                }


                return response()->json([
                    'quantity' => $quantity,
                    'orders' => $orders,
                ]);

                break;
            
            

        }

    }
}
