<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $this->authorize('viewAny', Comment::class);

        return Comment::all();
    }

    public function store(Request $request, Post $post)
    {
        $request->validate([
            'text' => 'required',
        ]);

        if(Auth::user()->hasRole('student')) {
            if(!Auth::user()->pivotData($post->group_id)->is_write_comment) {
                return abort(403);
            }
        }

        $comment = new Comment;
        $comment->text = $request->text;
        $comment->post_id = $post->id;
        $comment->user_id = Auth::id();
        $comment->save();


        return redirect()->route('groups.show', $post->group);
    }

    public function show(Comment $comment)
    {
        $this->authorize('view', $comment);

        return $comment;
    }

    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $data = $request->validate([

        ]);

        $comment->update($data);

        return $comment;
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return response()->json();
    }
}
