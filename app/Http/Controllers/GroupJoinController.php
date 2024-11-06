<?php

namespace App\Http\Controllers;

use App\Models\GroupJoin;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupJoinController extends Controller
{
    use AuthorizesRequests;

    public function store(Request $request)
    {
        $request->validate([
            'group_id' => 'required',
        ]);

        $groupJoin = GroupJoin::where('group_id', $request->group_id)->where('user_join', '=', Auth::id())->first();
        if($groupJoin) {
            $groupJoin->joined_at = null;
            $groupJoin->update();
        }else {
            $groupJoin = new GroupJoin();
            $groupJoin->group_id = $request->group_id;
            $groupJoin->user_join = Auth::id();
            $groupJoin->save();
        }

        return redirect()->route('home');
    }

    public function update(GroupJoin $groupJoin)
    {

        $groupJoin->user_accept = Auth::id();
        $groupJoin->joined_at = Carbon::now();
        $groupJoin->update();

        $groupJoin->group->users()->attach($groupJoin->user_join);

        return redirect()->route('home')->with('success', 'Approval user');
    }

}
