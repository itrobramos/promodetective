<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name')->whereIn('user_type_id', [1,2])->get();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $types = UserType::orderBy('type')->whereIn('id', [1,2])->get();

        return view('users.create', compact('types'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:users,name',
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'user_type_id' => ['required'],
            'password' => 'required',
        ],[
            'unique' => 'Registro duplicado, por favor revise los datos.',
        ]);

        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->user_type_id = $validatedData['user_type_id'];
        $user->password = Hash::make($validatedData['password']);

        $user->save();

        return redirect('/users')->with('success', 'El usuario ha sido creado correctamente.');
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('users.show');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $types = UserType::orderBy('type')->whereIn('id', [1,2])->get();
        return view('users.edit', compact('user', 'types'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'user_type_id' => 'required'
        ]);

        $user = User::findOrFail($id);
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->user_type_id = $validatedData['user_type_id'];
        

        if($request->input('password') != null){
            $user->password = Hash::make($request['password']);
        }

        $user->save();

        return redirect('/users')->with('success', 'El usuario ha sido actualizado correctamente.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/users')->with('success', 'El usuario ha sido eliminado correctamente.');
    }
}
