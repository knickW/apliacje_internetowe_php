<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Events\UserRoleUpdated;

class AdminController extends Controller
{
    public function index()
    {
        // Pobierz listę użytkowników i przekaż do widoku
        $users = User::all();
        return view('admin.index', compact('users'));
    }

    public function manageUsers()
    {
        // Pobierz listę użytkowników i przekaż do widoku
        $users = User::all();
        return view('admin.manage_users', compact('users'));
    }

    public function editUser($id)
    {
        // Pobierz użytkownika o danym ID
        $user = User::findOrFail($id);
        return view('admin.edit_user', compact('user'));
    }

    public function updateUser($id, Request $request)
    {
        // Pobierz użytkownika o danym ID
        $user = User::findOrFail($id);

        // Walidacja danych
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Aktualizuj dane użytkownika
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect()->route('admin.users')->with('success', 'Użytkownik zaktualizowany pomyślnie.');
    }

    public function deleteUser($id)
    {
        // Pobierz użytkownika o danym ID
        $user = User::findOrFail($id);

        // Usuń użytkownika
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'Użytkownik usunięty pomyślnie.');
    }

    public function blockUser(User $user)
    {
        $user->block();
        $user->save();
        event(new UserRoleUpdated($user));
        return redirect()->route('admin.users')->with('success', 'User blocked successfully.');
    }

    public function unblockUser(User $user)
    {
        $user->unblock();
        $user->save();
        event(new UserRoleUpdated($user));
        return redirect()->route('admin.users')->with('success', 'User unblocked successfully.');
    }
}
