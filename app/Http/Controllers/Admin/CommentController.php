<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with(['post', 'user', 'parent'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.pages.comments.index', compact('comments'));
    }

    public function approve($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->status = 1;
        $comment->save();

        return back()->with('success', 'Đã duyệt bình luận thành công.');
    }

    public function reply(Request $request, $id)
    {
        $parent = Comment::findOrFail($id);

        $validated = $request->validate([
            'content' => 'required|string|max:5000',
        ]);

        $reply = new Comment();
        $reply->post_id = $parent->post_id;
        $reply->salon_id = $parent->salon_id;
        $reply->parent_id = $parent->id;
        $reply->name = Auth::user()->name ?? 'Quản trị viên';
        $reply->email = Auth::user()->email ?? 'admin@gmail.com';
        $reply->user_id = Auth::id();
        $reply->content = $validated['content'];
        $reply->status = 1;
        $reply->save();

        return back()->with('success', 'Đã gửi phản hồi thành công.');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return back()->with('success', 'Đã xóa bình luận thành công.');
    }
}
