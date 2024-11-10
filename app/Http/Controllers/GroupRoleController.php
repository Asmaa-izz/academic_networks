<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class GroupRoleController extends Controller
{
    use AuthorizesRequests;

    public function edit(Group $group)
    {
        $this->authorize('update', $group);

        return view('pages.groups.groupRole', [
            'group' => $group,
            'users' => $group->users,
        ]);
    }

    public function update(Group $group, Request $request)
    {
        $this->authorize('update', $group);

        foreach ($request->data as $id => $item) {
            if(array_key_exists('post', $item)) {
                $group->users()->updateExistingPivot($id, ['is_write_post' => true]);
            }else {
                $group->users()->updateExistingPivot($id, ['is_write_post' => false]);
            }

            if(array_key_exists('comment', $item)) {
                $group->users()->updateExistingPivot($id, ['is_write_comment' => true]);
            }else {
                $group->users()->updateExistingPivot($id, ['is_write_comment' => false]);
            }

            if(array_key_exists('content', $item)) {
                $group->users()->updateExistingPivot($id, ['is_share_content' => true]);
            }else {
                $group->users()->updateExistingPivot($id, ['is_share_content' => false]);
            }
        }

        return redirect()->route('groups.show', $group)->with('success', 'Group updated.');
    }
}
