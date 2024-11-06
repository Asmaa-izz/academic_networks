<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupJoin;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $groups = Group::with(['groupJoin' => function ($q) {
            $q->where('user_join', '=', Auth::id())->where('joined_at', '=', null);
        }, 'users'])->get();

        $groupsJoin = GroupJoin::with(['group','userJoin'])->where('joined_at', '=', null)->get();

        return view('pages.home', [
            'doctor_count' => User::whereHas('roles', function ($query) {
                $query->where('name', 'doctor');
            })->count(),
            'student_count' => User::whereHas('roles', function ($query) {
                $query->where('name', 'student');
            })->count(),
            'groups_count' => Group::count(),
            'posts_count' => Post::count(),
            'groups' => $groups,
            'groupsJoin' => $groupsJoin,
        ]);
    }
}
