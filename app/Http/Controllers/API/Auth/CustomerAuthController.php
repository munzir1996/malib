<?php

namespace App\Http\Controllers\API\Auth;

use App\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\CustomerStoreRequest as APICustomerStoreRequest;
use App\Http\Requests\API\CustomerUpdateRequest as APICustomerUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Http\Resources\Customer as CustomerResource;

class CustomerAuthController extends Controller
{
    public function register(APICustomerStoreRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

        $customer = Customer::create($data);

        return response()->json([
            'customer' => $customer->only(['id', 'name', 'email', 'phone', 'address']),
            'token' => $customer->createToken('customer-application')->plainTextToken
        ]);
        // return new CustomerResource($customer);
    }

    public function updateProfile(APICustomerUpdateRequest $request)
    {
        $data = $request->validated();

        if ($request->filled('password')) {
            $data['password'] = Hash::make($data['password']);
        }

        auth()->user()->update($data);

        return response()->json(auth()->user()->only(['id', 'name', 'email', 'phone', 'address']));
    }

    public function login(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'password' => 'required',
        ]);

        $customer = Customer::where('phone', $request->phone)->first();

        if (!$customer || !Hash::check($request->password, $customer->password)) {
            throw ValidationException::withMessages([
                'phone' => ['بيانات الاعتماد المقدمة غير صحيحة.'],
            ]);
        }

        return response()->json([
            'customer' => $customer->only(['id', 'name', 'email', 'phone', 'address']),
            'token' => $customer->createToken('customer-application')->plainTextToken
        ]);

    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json('Customer Logged out');
    }

    public function checkPhoneNumber(Request $request)
    {
        $request->validate([
            'phone' => 'required',
        ]);
        $customer = Customer::where('phone', $request->phone)->first();

        if (!$customer) {
            throw ValidationException::withMessages([
                'phone' => ['بيانات الاعتماد المقدمة غير صحيحة'],
            ]);
        }

        return response()->json([
            'id' => $customer->id,
        ]);

    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed',
            'id' => 'required'
        ]);

        $customer = Customer::where('id', $request->id)->first();

        if (!$customer) {
            throw ValidationException::withMessages([
                'phone' => ['لا يمكن إعادة تعيين كلمة المرور'],
            ]);
        }

        $customer->update([
            'password' => $request->password,
        ]);

        return response()->json([
            'message' => 'Password reset successfully',
            'token' => $customer->createToken('customer-application')->plainTextToken
        ]);

    }


}
