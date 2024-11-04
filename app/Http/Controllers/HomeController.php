<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::user()->hasRole('doctor')) {
            $data = Post::with(['group', 'user'])->whereHas('group', function ($q) {
                return $q->where('user_id', Auth::user()->id);
            })->orderBy('created_at', 'desc')->get();
        }else {
            $data = Post::with(['group', 'user'])->whereHas('group', function ($q) {
                return $q->whereHas('users', function ($q2) {
                    return $q2->where('user_id', Auth::user()->id);
                });
            })->orderBy('created_at', 'desc')->get();
        }

        return view('pages.home', [
            'doctor_count' => User::whereHas('roles', function ($query) {
                $query->where('name', 'doctor');
            })->count(),
            'student_count' => User::whereHas('roles', function ($query) {
                $query->where('name', 'student');
            })->count(),
            'groups_count' => Group::count(),
            'posts_count' => Post::count(),

            'data' => $data,
        ]);
    }
}
