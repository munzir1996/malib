<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Owner;
use App\Http\Requests\API\OwnerStoreRequest as APIOwnerStoreRequest;
use App\Http\Requests\API\OwnerUpdateRequest as APIOwnerUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Owner as OwnerResource;
use Illuminate\Validation\ValidationException;

class OwnerAuthController extends Controller
{
    public function register(APIOwnerStoreRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

        $owner = Owner::create($data);

        return response()->json([
            'owner' => $owner->only(['id', 'name', 'email', 'phone', 'address']),
            'token' => $owner->createToken('owner-application')->plainTextToken
        ]);
        // return new OwnerResource($owner);
    }

    public function updateProfile(APIownerUpdateRequest $request)
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

        $owner = Owner::where('phone', $request->phone)->first();

        if (!$owner || !Hash::check($request->password, $owner->password)) {
            throw ValidationException::withMessages([
                'phone' => ['بيانات الاعتماد المقدمة غير صحيحة.'],
            ]);
        }

        return response()->json([
            'owner' => $owner->only(['id', 'name', 'email', 'phone', 'address']),
            'token' => $owner->createToken('owner-application')->plainTextToken
        ]);

    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->json('Logged out');
    }

    public function checkPhoneNumber(Request $request)
    {
        $request->validate([
            'phone' => 'required',
        ]);

        $owner = Owner::where('phone', $request->phone)->first();

        if (!$owner) {
            throw ValidationException::withMessages([
                'phone' => ['بيانات الاعتماد المقدمة غير صحيحة'],
            ]);
        }

        return response()->json([
            'id' => $owner->id,
        ]);

    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed',
            'id' => 'required'
        ]);

        $owner = Owner::where('id', $request->id)->first();

        if (!$owner) {
            throw ValidationException::withMessages([
                'phone' => ['لا يمكن إعادة تعيين كلمة المرور'],
            ]);
        }

        $owner->update([
            'password' => $request->password,
        ]);

        return response()->json([
            'message' => 'Password reset successfully',
            'token' => $owner->createToken('owner-application')->plainTextToken
        ]);

    }

}
