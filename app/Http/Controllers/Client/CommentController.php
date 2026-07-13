<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'content' => 'required|string|max:5000',
        ]);

        $comment = new Comment();
        $comment->post_id = $post->id;
        $comment->name = $validated['name'];
        $comment->email = $validated['email'];
        $comment->content = $validated['content'];
        
        if (Auth::check()) {
            $comment->user_id = Auth::id();
            if (Auth::user()->role_id == 1) {
                $comment->status = 1;
            } else {
                $comment->status = 0;
            }
        } else {
            $comment->status = 0;
        }
        $comment->save();

        return back()->with('success', 'Bình luận của bạn đã được gửi và đang chờ kiểm duyệt.');
    }
}
