<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
{
    $query = $request->input('search');

    $users = User::when($query, function ($queryBuilder, $query) {
        return $queryBuilder->where('name', 'like', "%{$query}%")
                            ->orWhere('email', 'like', "%{$query}%");
    })->paginate(6);

    return view('users.index', compact('users'));
}


    public function edit(User $user)
    {

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
        ]);

        $user->update($request->all());

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
