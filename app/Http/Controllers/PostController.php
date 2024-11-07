<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Media;
use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    use AuthorizesRequests;

    public function store(Request $request, Group $group)
    {

        $request->validate(['post' => 'required',]);
        Log::info($request);

        if (Auth::user()->hasRole('student')) {
            if (!Auth::user()->pivotData($group->id)->is_write_post) {
                return abort(403);
            }
        }

        $post = new Post();
        $post->text = $request->post;
        $post->group_id = $group->id;
        $post->user_id = Auth::id();
        $post->save();

        for($i=0; $i<count($request->input('files')); $i++) {
            Log::info(1);
        }

//        Log::info(...$request->files);
        foreach ($request->files as $file) {
            Log::info(1);
            $media = new Media();
            $media->name = $file['name'];
            $media->type = $file['type'];
            $media->path = $file['path'];
            $media->post_id = Auth::id();
            $media->save();
        }


        return redirect()->route('groups.show', $group)->with(['success' => 'تم الاضافة بنجاح']);
    }


    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $data = $request->validate([

        ]);

        $post->update($data);

        return $post;
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return response()->json();
    }
}
