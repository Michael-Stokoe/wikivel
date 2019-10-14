<?php

namespace App\Models;

use App\Models\Traits\HasContent;
use Spatie\Activitylog\Traits\LogsActivity;
use Artisanry\Commentable\Traits\HasComments;
use Artisanry\Commentable\Models\Comment as BaseComment;

class Comment extends BaseComment
{
    use
        // LogsActivity, // Application not ready for this yet.
        HasContent;

    public $contentField = 'body';

    public function comment($data, $creator, $parent = null)
    {
        $commentableModel = BaseComment::class;

        $comment = (new $commentableModel())->createComment($this, $data, $creator);

        if (!empty($parent)) {
            $parent->appendNode($comment);
        }

        return $comment;
    }

    public function comments()
    {
        return $this->morphMany(static::class, 'commentable');
    }

    public function getUrl()
    {
        return route('comment.show', ['id' => $this->id]);
    }
}
