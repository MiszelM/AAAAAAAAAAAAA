<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query()->with('roles');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        
        if (in_array($request->sort, ['id ASC','name ASC', 'email ASC'])) {
            $query->orderBy($request->sort_ascending);
        }

        if (in_array($request->sort, ['id DESC','name DESC', 'email DESC'])) {
            $query->orderBy($request->sort_descending);
        }

        return view('users.index', [
            'users' => $query->paginate(10)->withQueryString(),
            'roles' => Role::all(),
        ]);
    }

    public function updateRole(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        $user->syncRoles([$request->role]);

        return redirect()->back()->with('success', 'Rola została zmieniona');
    }
}