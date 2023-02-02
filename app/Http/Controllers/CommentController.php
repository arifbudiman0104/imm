<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function commentStore(Request $request)
    {
        if (Auth::check()) {
            $request->validate([
                'text' => 'required|string|max:255',
            ]);
            Comment::create([
                'post_id' => $request->post_id,
                'user_id' => Auth::user()->id,
                'text' => $request->text,
            ]);
            // dd($request->all());
            // return back()->with('status', 'comment-created');
            return back()->with('success', 'Comment created successfully!');
        }
        return redirect()->route('login');
    }

    public function commentDestroy(Comment $comment)
    {
        if (Auth::user()->id == $comment->user_id || Auth::user()->is_admin) {
            $comment->delete();
            return back()->with('success', 'Comment deleted successfully!');
        }
        return back()->with('warning', 'You are not authorized to delete this comment!');
    }

    public function commentUpdate(Request $request, Comment $comment)
    {
        if (Auth::user()->id == $comment->user_id) {
            $request->validate([
                'text' => 'required|string|max:255'
            ]);
            $comment->text = $request->text;
            $comment->save();
            return back()->with('success', 'Comment updated successfully!');
        } else if (Auth::user()->is_admin) {
            $request->validate([
                'text' => 'required|string|max:255'
            ]);
            $comment->timestamps = false;
            $comment->text = $request->text;
            $comment->save();
            return back()->with('success', 'As admin, comment updated successfully!');
        }
        return back()->with('warning', 'You are not authorized to update this comment!');
    }

    public function commentReport(Comment $comment)
    {
        if (Auth::check()) {
            $comment->timestamps = false;
            $comment->incrementSpamCount();
            $comment->is_spam = true;
            $comment->save();
            return back()->with('success', 'Comment reported successfully!');
        }
        return redirect()->route('login');
        // return back()->with('status', 'comment-report-failed');
    }

    public function commentMarkNotSpam(Comment $comment)
    {
        if (Auth::user()->is_admin) {
            $comment->timestamps = false;
            $comment->spam_count = 0;
            $comment->is_spam = false;
            $comment->save();
            return back()->with('success', 'Comment marked as not spam successfully!');
        }
        return back()->with('warning', 'You are not authorized to mark this comment as not spam!');
    }
}
