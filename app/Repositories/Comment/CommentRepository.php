<?php

namespace App\Repositories\Comment;

use App\Repositories\EloquentRepository;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\User;
use App\Repositories\Comment\CommentRepositoryInterface;

class CommentRepository extends EloquentRepository implements CommentRepositoryInterface
{

    public function getModel()
    {
        return Comment::class;
    }

    public function createByUser(CommentRequest $request)
    {
        $data = $request->only([
            'content',
            'book_id',
            'parent_id'
        ]);
        if ($request->has('parent_id')) {
            $data['parent_id'] = (int) $data['parent_id'];
        }
        if (!$request->has('book_id')) {
            $data['book_id'] = 0;
        }
        $data['book_id'] = (int) $data['book_id'];
        $comment = $request->user()->comments()->create($data);

        return $comment;
    }

}
