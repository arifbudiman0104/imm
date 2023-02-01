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
            return back()->with('status', 'comment-created');
        }
        return redirect()->route('login');
    }

    public function commentDestroy(Comment $comment)
    {
        if (Auth::user()->id == $comment->user_id || Auth::user()->is_admin) {
            $comment->delete();
            return back()->with('status', 'comment-deleted');
        }
        return back()->with('status', 'comment-delete-failed');
    }

    public function commentUpdate(Request $request, Comment $comment)
    {
        if (Auth::user()->id == $comment->user_id) {
            $request->validate([
                'text' => 'required|string|max:255'
            ]);
            $comment->text = $request->text;
            $comment->save();
            return back()->with('status', 'comment-updated');
        } else if (Auth::user()->is_admin) {
            $request->validate([
                'text' => 'required|string|max:255'
            ]);
            $comment->timestamps = false;
            $comment->text = $request->text;
            $comment->save();
            return back()->with('status', 'comment-updated-as-admin');
        }
        return back()->with('status', 'comment-update-failed');
    }

    public function commentReport(Comment $comment)
    {
        if (Auth::check()) {
            $comment->timestamps = false;
            $comment->incrementSpamCount();
            $comment->is_spam = true;
            $comment->save();
            return back()->with('status', 'comment-reported');
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
            return back()->with('status', 'comment-marked-not-spam');
        }
        return back()->with('status', 'comment-mark-not-spam-failed');
    }
}
