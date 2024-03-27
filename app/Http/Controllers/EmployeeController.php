<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    //
    public function uploadAvatar(Request $request, $id): string
    {
        $id = $request -> get('id');
        $path = $request -> file('avatar') -> store("employee/avatars/$id");
        Employee::where('id', $id) -> update(['avatar' => $path]);
        $msg = ['success', 'Avatar Uploaded Successfully!'];
        return $path;
    }

    public function uploadImage(Request $request, $id): string
    {
        $id = $request -> get('id');
        $path = $request -> file('image') -> store("employee/images/$id");
        $msg = ['success', 'Image Uploaded Successfully!'];
        return $path;
    }

    public function add(Request $request)
    {
        $employee = Employee::create([
            'name' => $request -> get('name'),
            'contact' => $request -> get('contact'),
            'address' => $request -> get('address'),
            'DOB' => $request -> get('DOB'),
        ]);
        $msg = ['success', 'New Employee Added Successfully!'];
        return $msg;
    }

    public function edit(Request $request)
    {
        // dd($request);
        $id = $request -> get('id');
        $name = $request -> get('name');
        Employee::where('id', $id)->update([
            'name' => $request->input('name'),
            'contact' => $request->input('contact'),
            'address' => $request->input('address'),
            'DOB' => $request->input('DOB'),
            // Add more fields as needed
        ]);
        $msg = ["success", "$name's Profile Updated Successfully!"];
        return $msg;
    }

    public function delete(Request $request){
        Employee::find($request->get('id'))->delete();
        $msg = ["danger", "Employee Removed Successfully!"];

        return $msg;
    }

    public function index(Request $request)
    {
        switch($request -> get('action')){
            case 'add_employee':
                $msg = $this -> add($request);
                break;

            case 'delete_employee';
                $msg = $this -> delete($request);
                break;
            
            case 'upload_avatar':
                $msg = $this -> uploadAvatar($request);
                break;
                
            case 'edit_employee':
                $msg = $this -> edit($request);
                break;
                
            default:
                dd($request);
        }

        return redirect()->route('employee')->with($msg[0],$msg[1]);
    }
}
