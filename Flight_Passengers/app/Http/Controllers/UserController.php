<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;


class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = QueryBuilder::for(User::class)
            ->allowedFilters([
                id,
                name,
                email,
            ])
            ->allowedSorts(['id', 'name', 'email', 'created_at'])
            ->paginate($request->input('per_page', 15));

        return response($users);
    }

    // public function store(Request $request)
    // {
    //     // Validate the incoming request data
    //    $data= $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:users,email',
    //         'password' => 'required|string|min:8',
    //     ]);

    //     // Create a new user
    //     $user = User::create($data);

    //     return response($user, 201);
    // }

    public function update(Request $request, User $user)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $id,
            'password' => 'sometimes|required|string|min:8',
            'role' =>'nullable|existes:roles,name',
        ]);
        if($user){
            $user->assignRole($request->role);
            $data->unset($data['role']);
        }
        
        $data->update($data);

        //$user = User::findOrFail($id);

        // Update the user
        //$user->update([
            //'name' => $request->input('name', $user->name),
            //'email' => $request->input('email', $user->email),
            //'password' => $request->has('password') ? bcrypt($request->input('password')) : $user->password,
        //]);

        return response($user);
    }

    public function destroy($id)
    {
        // Find the user
        $user = User::findOrFail($id);

        // Delete the user
        $user->delete();

        return response(['success' => true, 'data' => null], Response::HTTP_NO_CONTENT);
    }
    public function assignRole(Request $request)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'role' => 'required|exists:roles,name',
        ]);

        if ($validator->fails()) {
            return response(['success' => true, 'data' => null], Response::HTTP_NO_CONTENT);
        }

        $user = User::find($request->user_id);
        if ($user) {
            $user->assignRole($request->role);
            return response()->json(['message' => 'Role assigned successfully.']);
        }

        return response(['message' => 'User not found.'], 404);
    }
}


