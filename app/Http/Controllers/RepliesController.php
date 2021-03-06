<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReplyRequest;
use Auth;

class RepliesController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

	public function store(ReplyRequest $request,Reply $reply){
		$reply->content = $request->cont;
        $reply->user_id = Auth::id();
        $reply->topic_id = $request->topic_id;
        $reply->save();

		// return redirect()->route('replies.show', $reply->id)->with('message', '发表评论成功.');
		return redirect()->to($reply->topic->link())->with('message', '发表评论成功.');
	}

	public function destroy(Reply $reply){
		$this->authorize('destroy', $reply);
		$reply->delete();
		return redirect()->to($reply->topic->link())->with('message', '删除评论成功.');
	}
}