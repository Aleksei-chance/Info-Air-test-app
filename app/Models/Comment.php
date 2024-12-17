<?php

namespace App\Models;

use Core\Model;

class Comment extends Model
{
    protected $fillable = ['parent_id', 'nickname', 'content', 'updated_at'];
}
