<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Group::class);

        $groups = Group::withCount('posts')->where('user_id', '=', Auth::id())->get();
        return view('pages.groups.index', [
            'groups' => $groups,
        ]);
    }

    public function create()
    {
        $this->authorize('create', Group::class);

        return view('pages.groups.create', [
            'students' => User::whereHas('roles', function ($query) {
                return $query->where('name', 'student');
            })->get(),
        ]);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Group::class);

        $request->validate([
            'name' => 'required|max:255',
        ]);

        $group = new Group();
        $group->name = $request->name;
        $group->user_id = Auth::id();
        $group->save();

        if($request->manager) {
            $group->users()->attach($request->manager, ['is_admin' => true]);
        }

        foreach ($request->members as $user) {
            if($user !== $request->manager) {
                $group->users()->attach($user, ['is_admin' => false]);
            }
        }

        return redirect()->route('groups.show', $group)->with('success', 'Group created.');
    }

    public function show(Group $group)
    {
        $this->authorize('view', $group);

        $posts = Post::withCount('comments')->with(['user', 'comments'])->where('group_id', '=', $group->id)
            ->orderBy('created_at', 'desc')->get();

        $topUsers =   User::select('users.*')
            ->selectRaw('COUNT(posts.id) as posts_count') // إضافة عمود لعدد المنشورات
            ->join('posts', 'users.id', '=', 'posts.user_id')
            ->where('posts.group_id', $group->id)
            ->groupBy('users.id')
            ->havingRaw('COUNT(posts.id) > 0') // تأكد من وجود منشورات
            ->orderByRaw('COUNT(posts.id) DESC')
            ->limit(10) // يمكنك تغيير العدد حسب الحاجة
            ->get();

        $user = Auth::user();
        if($user->hasRole('student')) {
            $isWritePost = $user->pivotData($group->id)->is_write_post ?? false;
            $isWriteComment = $user->pivotData($group->id)->is_write_comment ?? false;
        }

        return view('pages.groups.show', [
            'group' => $group->load(['users', 'user']),
            'posts' => $posts,
            'topUsers' => $topUsers,
            'isWritePost' => $isWritePost ?? true,
            'isWriteComment' => $isWriteComment ?? true,
        ]);
    }

    public function edit(Group $group)
    {
        $this->authorize('update', $group);

        return view('pages.groups.edit', [
            'group' => $group,
            'students' => User::whereHas('roles', function ($query) {
                return $query->where('name', 'student');
            })->get(),
        ]);
    }

    public function update(Request $request, Group $group)
    {
        $this->authorize('update', $group);

        $request->validate([
            'name' => 'required|max:255',
        ]);

        $group->name = $request->name;
        $group->update();

        $group->users()->detach();
        $group->admin()->detach();

        if($request->manager) {
            $group->users()->attach($request->manager, ['is_admin' => true]);
        }

        foreach ($request->members as $user) {
            if($user !== $request->manager) {
                $group->users()->attach($user, ['is_admin' => false]);
            }
        }

        return redirect()->route('groups.show', $group)->with('success', 'Group updated.');
    }

    public function destroy(Group $group)
    {
        $this->authorize('delete', $group);

        $group->delete();

        return redirect()->route('groups.index')->with('success', 'Group was successfully deleted');
    }

    public function myGroups()
    {
        $groups = Group::withCount('posts')
            ->whereHas('users', function ($q) {
                return $q->where('user_id', Auth::id());
            })->get();
        return view('pages.groups.myGroup', [
            'groups' => $groups,
        ]);
    }
}
