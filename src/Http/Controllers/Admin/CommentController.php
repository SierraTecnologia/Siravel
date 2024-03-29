<?php

namespace Siravel\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Siravel\Http\Controllers\Controller;
use Transmissor\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $comments = Comment::with('post')->paginate(10);

        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Comment $comment)
    {
        if($comment->user_id != auth()->user()->id && auth()->user()->is_admin == false) {
            flash()->overlay("You can't delete other peoples comment.");
            return redirect('/admin/posts');
        }

        $comment->delete();
        flash()->overlay('Comment deleted successfully.');

        return redirect('/admin/comments');
    }
}
