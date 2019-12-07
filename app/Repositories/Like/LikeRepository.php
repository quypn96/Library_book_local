<?php

namespace App\Repositories\Like;

use App\Repositories\EloquentRepository;
use App\Models\Like;
use App\User;
use Illuminate\Http\Request;

class LikeRepository extends EloquentRepository
{

    public function getModel()
    {
        return Like::class;
    }

    public function like(Request $request)
    {
        $like = $request->user()->likes()->create([
            "book_id" => $request->id
        ]);

        return true;
    }

    public function unlike(Request $request, $id)
    {
        $unlike = $request->user()->likes()->where('book_id', $id)->delete();

        return true;
    }
}
