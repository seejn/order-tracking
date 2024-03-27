<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\EmployeeModule;

class OrderController extends Controller
{
    //
    public function uploadAvatar(Request $request): string
    {
        $id = $request -> get('id');
        $path = $request -> file('avatar') -> store("order/avatars/$id");
        Order::where('id', $id) -> update(['avatar' => $path]);
        $msg = ['success', 'Avatar Uploaded Successfully!'];
        return $path;
    }

    public function uploadImage(Request $request): string
    {
        $id = $request -> get('id');
        $path = $request -> file('image') -> store("order/images/$id");
        $msg = ['success', 'Image Uploaded Successfully!'];
        return $path;
    }


    public function add(Request $request)
    {
        $order = Order::create([
            'name' => $request -> get('name'),
            'rate' => $request -> get('rate'),
            'quantity' => $request -> get('quantity'),
            'advance_payment' => $request -> get('advance_payment'),
        ]);

        EmployeeModule::create([
            'order_id' => $order -> id,
            'total_quantity' => $request -> get('quantity'),
        ]);

        $msg = ['success', 'New Order Added Successfully!'];
        return $msg;
    }

    public function delete(Request $request){
        Order::find($request->get('id'))->delete();
        $msg = ['danger', 'Order Deleted Successfully!'];
    }

    public function update(Request $request){

    }    

    public function index(Request $request)
    {
        switch($request -> get('action')){
            case 'add_order':
                $msg = $this -> add($request);
                break;

            case 'delete_order';
                $msg = $this -> delete($request);
                break;
                
            case 'upload_avatar':
                $msg = $this -> uploadAvatar($request);
                break;

            default:
                dd($request);
        }

        return redirect()->route('order')->with($msg[0], $msg[1]);
    }

}
