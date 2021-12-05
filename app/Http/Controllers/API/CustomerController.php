<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Customer as CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'cpf' => 'required',
            'license_plate' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'data' => $validator->errors()
            ], 400);
        }

        $customer = new Customer;
        $customer->fill($request->all());
        $customer->save();

        Log::info("Customer ID {$customer->id} created successfully.");

        return response()->json(new CustomerResource($customer), 201);
    }

    public function show($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json([
                'message' => 'Record not found'
            ], 404);
        }

        return response()->json(new CustomerResource($customer));
    }

    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json([
                'message' => 'Record not found'
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'phone' => 'required',
            'cpf' => 'required',
            'license_plate' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'data' => $validator->errors()
            ], 400);
        }

        $customer->fill($request->all());
        $customer->save();

        Log::info("Customer ID {$customer->id} updated successfully.");

        return response()->json(new CustomerResource($customer));
    }

    public function destroy($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json([
                'message' => 'Record not found'
            ], 404);
        }

        $customer->delete();

        Log::info("Customer ID {$customer->id} deleted successfully.");
    }

    public function searchByLicensePlateLastNumber($lastNumber)
    {
        $customers = Customer::where(DB::raw('substring(placa_carro, -1)'), '=', $lastNumber)->get();

        if ($customers->isEmpty()) {
            return response()->json([
                'message' => 'No records found'
            ], 404);
        }

        return response()->json(CustomerResource::collection($customers));
    }
}
