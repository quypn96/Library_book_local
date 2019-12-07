<?php

namespace App\Repositories\Comment;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;

interface CommentRepositoryInterface
{
    public function getModel();

    public function createByUser(CommentRequest $request);
}
