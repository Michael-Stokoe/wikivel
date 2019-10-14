<?php

namespace App\Http\Controllers\Web;

use Log;
use Auth;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Artisanry\Commentable\Models\Comment as BaseComment;

class CommentController extends Controller
{
    public function replyToComment($id)
    {
        $originalComment = Comment::find($id);

        if (!$originalComment) {
            abort(404);
        }

        $commentable_type = Comment::class;
        $commentable_id = $id;

        $redirectTo = request()->input('redirectTo');

        return view('comments.reply', [
            'originalComment' => $originalComment,
            'commentable_type' => $commentable_type,
            'commentable_id' => $commentable_id,
            'redirect_to' => $redirectTo
        ]);
    }

    public function store(Request $request)
    {
        $commentable_type = $request->input('commentable_type');
        $commentable_id = $request->input('commentable_id');

        $record = $commentable_type::where('id', $commentable_id)->first();

        $commentTitle = $request->input('comment_title');
        $commentBody = $request->input('comment_body');

        $parent = null;

        if ($commentable_type === Comment::class) {
            $parent = $record;
        }

        $record->comment(
            [
                'title' => $commentTitle,
                'body' => $commentBody
            ],
            Auth::user(),
            $parent
        );

        if ($commentable_type === Comment::class) {
            $redirectTo = request()->input('redirect_to');

            if ($redirectTo) {
                return redirect($redirectTo);
            }

            return redirect()->back();
        }

        return redirect($record->getUrl());
    }

    public function deleteComment($id, Request $request)
    {
        $comment = Comment::where('id', $id)->first();

        if (!$comment) {
            abort(404);
        }

        $comment->delete();

        return redirect()->back();
    }

    public function reportComment($id)
    {
        $comment = Comment::where('id', $id)->first();

        if (!$comment) {
            abort(404);
        }

        return view('comments.report', [
            'id' => $id,
            'comment' => $comment
        ]);
    }

    public function storeReportComment($id, Request $request)
    {
        $comment = Comment::where('id', $id)->first();

        if (!$comment) {
            abort(404);
        }

        $body = $comment->body;

        Log::alert(
            sprintf(
                'User %d reported comment ID: [%d] | Body: [%s]',
                Auth::id(),
                $id,
                $body
            )
        );

        return redirect()->back()->with('comment_reported_msg', 'Comment reported, thankyou.');
    }

    public function showComment($id)
    {
        $comment = Comment::where('id', $id)->first();

        if (!$comment) {
            abort(404);
        }

        return view('comments.show', [
            'comment' => $comment,
        ]);
    }
}
