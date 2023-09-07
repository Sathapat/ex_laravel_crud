<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return response()->json($customers);
    }

    public function show($id)
    {
        $customer = Customer::find($id);
        return response()->json($customer);
    }

    public function search(Request $request)
    {
        // $customer = Customer::find($id);
        $keyword = $request->query('keyword');
        if($keyword == '') {
            $customers = Customer::all();
        } else {
            $customers = Customer::where('first_name', 'LIKE', '%'.$keyword.'%')
            ->orWhere('last_name', 'LIKE', '%'.$keyword.'%')
            ->orWhere('email', 'LIKE', '%'.$keyword.'%')
            ->orWhere('phone', 'LIKE', '%'.$keyword.'%')->get();
        }
        return response()->json($customers);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => '400',
                'message' => $validator->errors()
            ], 400);
        } else {
            Customer::create($request->all());
            return response()->json([
                'status' => '200',
                'message' => 'Data inserted successfully!!'
            ], 200);
        }
    }

    public function update(int $id, Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => '400',
                'message' => $validator->errors()
            ], 400);
        } else {
            Customer::find($id)->update($request->all());
            return response()->json([
                'status' => '200',
                'message' => 'Data updated successfully!!'
            ], 200);
        }
    }

    public function destroy($id)
    {
        Customer::find($id)->delete($id);
        return response()->json([
            'status' => '200',
            'message' => 'Data deleted successfully!!'
        ], 200);
    }
}
