<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use LogsActivity, SoftDeletes;

    protected static $logUnguarded = true;

    public function user()
    {
        return $this->belongsto(User::class);
    }

    public function getUrl()
    {
        return route('image.show', ['id' => $this->id]);
    }
}
