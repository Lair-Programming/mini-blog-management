<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // These are the columns allowed to be filled from a form.
    // Laravel blocks any other field, which protects against unwanted data.
    protected $fillable = [
        'title',
        'content',
        'status',
    ];
}
