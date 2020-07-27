<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();

        return inertia()->render('Dashboard/users/index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        return inertia()->render('Dashboard/users/create');
    }

    public function store(Request $request)
    {

        $request->validated();

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'phone' => $request->phone,
            'alt_phone' => $request->alt_phone,
            'address' => $request->address,
            'balance' => $request->balance,
            'password' => Hash::make($request->password),
        ]);

        session()->flash('toast', [
            'type' => 'success',
            'message' => 'تم أضافة المستخدم'
        ]);

        return redirect()->route('users.index');

    }

    public function edit(User $user)
    {
        return inertia()->render('Dashboard/users/edit', ['user' => $user]);
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validated();

        if ($request->filled('password')) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        session()->flash('toast', [
            'type' => 'success',
            'message' => 'تم تعديل المستخدم'
        ]);

        return redirect()->route('users.index');

    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
        session()->flash('toast', [
            'type' => 'success',
            'message' => 'تم حذف المستخدم'
        ]);
    }
}
