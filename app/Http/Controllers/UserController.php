<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', User::class);
        return view('pages.users.index', [
            'users' => User::where('id', '!=', auth()->user()->id)->get()
        ]);
    }

    public function create()
    {
        $this->authorize('create', User::class);

        return view('pages.users.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->avatar = 'avatar/default.png';
        $user->password = Hash::make('password');
        $user->save();

        $user->assignRole($request->role);

        return redirect()->route('users.show', $user)->with('success', 'User created.');
    }

    public function show(User $user)
    {
//        $this->authorize('view', $user);

        return view('pages.users.show', [
            'user' => $user
        ]);
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);

        return view('pages.users.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $request->validate([
            'name' => 'required|max:255',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->update();

        $user->syncRoles([]);
        $user->assignRole($request->role);

        return redirect()->route('users.show', $user)->with('success', 'User updated.');
    }

    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return redirect()->route('users.index')->with('success', 'User was successfully deleted');
    }

    public function changePassword(User $user, Request $request)
    {
        $this->authorize('update', $user);

        $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);

        $user->password = Hash::make($request->password);
        $user->update();

        if($request->has('is_profile')) {
            return redirect()->route('profile.show')->with('success', 'تم تغيير  كلم المرور');
        }else {
            return redirect()->route('users.show', $user)->with('success', 'تم تغيير  كلم المرور');
        }

    }
}
